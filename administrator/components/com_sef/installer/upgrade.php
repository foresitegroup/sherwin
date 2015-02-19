<?php
/**
* @version $Id: admin.installer.php 4621 2006-08-21 16:40:39Z stingrey $
* @package Joomla
* @subpackage Installer
* @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined('_VALID_MOS') or die('Restricted access');

/**
 * Recursively deletes all the directory content and the directory itself
 *
 * @param string $dir
 * @return boolean
 */
function deldir($dir) {
    $current_dir = opendir($dir);
    $old_umask = umask(0);
    while ($entryname = readdir($current_dir)) {
        if ($entryname != '.' && $entryname != '..') {
            if (is_dir($dir.$entryname )) {
                deldir(mosPathName($dir.$entryname));
            }
            else {
                @chmod($dir.$entryname, 0777);
                @unlink($dir.$entryname);
            }
        }
    }
    umask($old_umask);
    closedir($current_dir);
    return @rmdir($dir);
}

upgrade();

/**
 * Upgrades the JoomSEF or its extension according to selected parameters
 *
 */
function upgrade()
{
    global $sefConfig, $database;

    $fromServer = mosGetParam($_REQUEST, 'fromServer', null);
    $extension = mosGetParam($_REQUEST, 'ext', null);

    if( !is_null($extension) && !file_exists($GLOBALS['mosConfig_absolute_path'].'/components/com_sef/sef_ext/'.$extension.'.php') ) {
        echo "<p class='error'>You are not allowed to upgrade this component.</p>";
        return;
    }

    $uploaddir = $GLOBALS['mosConfig_absolute_path'].'/media/';
    $uploadfile = $uploaddir.'upgradePack.zip';

    if (is_null($fromServer)) {
        echo "<p class='error'>"._COM_SEF_UPGRADE_BADSOURCE."</p>";
        return;
    }

    if ($fromServer == 1) {
        // Download ZIP from server
        if( is_null($extension) ) {
            $upgradeFile = @file_get_contents($sefConfig->serverUpgradeURL);
        } else {
            $upgradeFile = @file_get_contents(dirname($sefConfig->serverUpgradeURL).'/'.$extension.'.zip');
        }

        if ($upgradeFile == false) {
            echo "<p class='error'>"._COM_SEF_UPGRADE_CONNECTIONFAILED."</p>";
            return;
        }
        if (@!file_put_contents($uploadfile, $upgradeFile)) {
            echo "<p class='error'>"._COM_SEF_WRITE_FAILED."</p>";
            return;
        }
    }
    else {
        // Use the uploaded ZIP
        $userfile = mosGetParam($_FILES, 'userfile', null);
        if (!$userfile) {
            echo "<p class='error'>"._COM_SEF_UPLOAD_ERROR."</p>";
            return;
        }

        if (!@move_uploaded_file($userfile['tmp_name'], $uploadfile)) {
            echo "<p class='error'>"._COM_SEF_WRITE_FAILED."</p>";
            return;
        }
    }

    // Extract ZIP to temp folder
    global $extractdir;   // global so we can use it in AddFileOp to ensure that file exists
    $extractdir = mosPathName( $uploaddir.uniqid('upgrade_') );

    if (!extractZIP($uploadfile, $extractdir))
    return;

    // Create an array of upgrade files
    if( is_null($extension) ) {
        $curVersion = SEFTools::getSEFVersion();
    } else {
        $curVersion = SEFTools::getExtVersion($extension);
    }
    $upgradeDir = mosPathName($extractdir.'upgrade');
    //$upgradeFiles = @scandir($upgradeDir);

    // scandir replacement compatible with PHP4
    $upgradeFiles = array();
    $dh  = opendir($upgradeDir);
    while (false !== ($filename = readdir($dh))) {
        $upgradeFiles[] = $filename;
    }
    sort($upgradeFiles);

    if ($upgradeFiles == false) {
        echo "<p class='error'>"._COM_SEF_UPGRADE_BADPACKAGE."</p>";
        unlink($uploadfile);
        deldir($extractdir);
        return;
    }

    // Check if current version is upgradeable with downloaded package
    $reinstall = false;
    if (!in_array($curVersion.".php", $upgradeFiles)) {
        if( ($fromServer != 1) && is_null($extension) ) {
            // Check if current version is manually reinstalled with the same version package
            $xmlFile = $extractdir.'/sef.xml';
            $packVersion = upgradeGetXmlText($xmlFile, 'version');
            if( ($packVersion == $curVersion) && is_readable($upgradeDir.'/reinstall.php') ) {
                // Initiate the reinstall
                $reinstall = true;
                echo "<p class='message'>"._COM_SEF_REINSTALL."</p>";
            }
        }

        if( !$reinstall ) {
            echo "<p class='message'>"._COM_SEF_CANT_UPGRADE."</p>";
            unlink($uploadfile);
            deldir($extractdir);
            return;
        }
    }

    natcasesort($upgradeFiles);

    // Prepare arrays of upgrade operations and functions to manipulate them
    global $fileList, $sqlList, $scriptList, $fileError;
    $fileError = false;
    $fileList = array();
    $sqlList = array();
    $scriptList = array();

    if (!function_exists("AddFileOp")) {
        // Adds a file operation to $fileList
        // $joomlaPath - destination file path (e.g. '/administrator/components/com_sef/admin.sef.php')
        // $operation - can be 'delete' or 'upgrade'
        // $packagePath - source file path in upgrade package if $operation is 'upgrade' (e.g. '/admin.sef.php')
        function AddFileOp($joomlaPath, $operation, $packagePath = '')
        {
            global $fileList, $fileError, $extractdir;
            if ($operation != 'upgrade' && $operation != 'delete') {
                $fileError = true;
                echo "<p class='error'>"._COM_SEF_UPGRADE_INVALIDOPERATION.$operation."</p>";
                return;
            }

            /* Removed because the file doesn't have to be present if it will be deleted in some future version
             * This will be checked before running file operations
            if ($operation == 'upgrade' && ($packagePath == '' || !file_exists(mosPathName($extractdir.$packagePath, false)))) {
                $fileError = true;
                echo "<p class='error'>"._COM_SEF_UPGRADE_INVALIDFILE.mosPathName($extractdir.$packagePath, false)."</p>";
                return;
            }
            */
            $fileList[$joomlaPath] = new SEFUpgradeFile($operation, $packagePath);
        }
    }

    if (!function_exists('AddSQL')) {
        // Adds an SQL query to $sqlList
        function AddSQL($sql) {
            global $sqlList;
            $sqlList[] = $sql;
        }
    }

    if (!function_exists('AddScript')) {
        // Adds a script to $scriptList
        function AddScript($script) {
            global $scriptList;
            $scriptList[] = $script;
        }
    }

    if( !$reinstall ) {
        // Load each upgrade file starting with current version in ascending order
        foreach($upgradeFiles as $uFile) {
            if (!eregi("^[0-9]+\.[0-9]+\.[0-9]+\.php$", $uFile))
            continue;
            if (strnatcasecmp($uFile, $curVersion.".php") >= 0)
            require_once($upgradeDir.$uFile);
        }
    } else {
        // Create list of all files to upgrade
        require_once($upgradeDir.'/reinstall.php');
    }

    if ($fileError == false) {
        // set errors variable
        $errors = false;

        // First of all check if all the files are writeable
        foreach($fileList as $dest => $op) {
            $file = mosPathName($GLOBALS['mosConfig_absolute_path'].$dest, false);

            // Check if source file is present in upgrade package
            if( $op->operation == 'upgrade' ) {
                $from = mosPathName($extractdir.$op->packagePath, false);
                if( !file_exists($from) ) {
                    echo "<p class='error'>File {$op->packagePath} does not exist in upgrade package.</p>";
                    $errors = true;
                }
            }

            if( (($op->operation == 'delete')  && (file_exists($file))) ||
            (($op->operation == 'upgrade') && (!file_exists($file))) ) {

                // If the file is to be deleted or created, the file's directory must be writable
                $dir = dirname($file);
                if( !file_exists($dir) ) {
                    // We need to create the directory where the file is to be created
                    if( !mosMakePath('', $dir) ) {
                        echo "<p class='error'>Directory couldn't be created: $dir</p>";
                        $errors = true;
                    }
                }

                if( !is_writable($dir) ) {
                    if( !@chmod($dir, 0777) ) {
                        echo "<p class='error'>Directory not writeable: $dir</p>";
                        $errors = true;
                    }
                }
            }
            elseif( $op->operation == 'upgrade' ) {

                // The file itself must be writeable
                if( !is_writable($file) ) {
                    if( !@chmod($file, 0755) ) {
                        echo "<p class='error'>File not writeable: $file</p>";
                        $errors = true;
                    }
                }
            }
        }

        if( !$errors ) {
            // Execute SQL queries
            foreach($sqlList as $sql) {
                $database->setQuery($sql);
                if (!$database->query())
                echo "<p class='error'>"._COM_SEF_UPGRADE_SQLERROR."$sql</p>";
            }

            // Perform file operations
            foreach($fileList as $dest => $op) {
                if ($op->operation == 'delete') {
                    $file = mosPathName($GLOBALS['mosConfig_absolute_path'].$dest, false);
                    if( file_exists($file) ) {
                        $error = @unlink($file);
                        if (!$success) {
                            echo "<p class='error'>Could not delete file: $dest. Please, check the write permissions on this file.</p>";
                            $errors = true;
                        }
                    }
                }
                elseif ($op->operation == 'upgrade') {
                    $from = mosPathName($extractdir.$op->packagePath, false);
                    $to = mosPathName($GLOBALS['mosConfig_absolute_path'].$dest, false);
                    $destDir = dirname($to);

                    // Create the destination directory if needed
                    if( !file_exists($destDir) ) {
                        mosMakePath('', $destDir);
                    }

                    $success = @copy($from, $to);
                    if (!$success) {
                        echo "<p class='error'>Could not rewrite file: $dest. Please, check the write permissions on this file.</p>";
                        $errors = true;
                    }
                }
            }

            // Run scripts
            foreach($scriptList as $script) {
                $file = $extractdir.$script;
                if( !file_exists($file) ) {
                    echo "<p class='error'>Could not find script file: $file.</p>";
                    $errors = true;
                } else {
                    include( $file );
                }
            }
        }

        if (!$errors) {
            $what = (is_null($extension)) ? 'JoomSEF' : 'Extension '.$extension;
            echo "<p class='message'>$what successfuly upgraded.</p>";
        }
        else {
            echo "<p class='message'>Errors detected when upgrading JoomSEF. Please check the errors reported above and repeat the upgrade process.</p>";
        }
        echo "<font class=\"small\" align=\"left\"><a href=\"index2.php?option=com_sef&amp;task=showupgrade\">"._COM_SEF_BACK."</a></font>";
    }

    // Cleanup
    unlink($uploadfile);
    deldir($extractdir);
}

/**
 * Extracts ZIP archive
 *
 * @param string $archive
 * @param string $extractTo
 * @return bool
 */
function extractZIP($archive, $extractTo)
{
    global $mosConfig_absolute_path;

    if (!extension_loaded('zlib')) {
        echo "<p class='error'>Upgrade cannot continue before zlib is installed.</p>";
        return false;
    }

    $isWin = (substr(PHP_OS, 0, 3) == 'WIN');

    // Extract functions
    require_once($mosConfig_absolute_path.'/administrator/includes/pcl/pclzip.lib.php');
    require_once($mosConfig_absolute_path.'/administrator/includes/pcl/pclerror.lib.php');

    $zipfile = new PclZip($archive);

    if ($isWin) define('OS_WINDOWS', 1);
    else define('OS_WINDOWS', 0);

    $ret = $zipfile->extract(PCLZIP_OPT_PATH, $extractTo);
    if ($ret == 0) {
        echo "<p class='error'>Unrecoverable error ".$zipfile->errorName(true).".</p>";
        return false;
    }

    return true;
}

function upgradeGetXmlText($file, $variable) {
    global $mosConfig_absolute_path;

    // Load class if not loaded yet.
    if (!class_exists('DOMIT_Lite_Document')) {
        require_once($mosConfig_absolute_path.'/includes/domit/xml_domit_lite_include.php' );
    }

    // Try to find variable
    $value = null;
    if (is_readable($file)) {
        $xmlDoc = new DOMIT_Lite_Document();
        $xmlDoc->resolveErrors(true);

        if ($xmlDoc->loadXML($file, false, true)) {
            $root = &$xmlDoc->documentElement;
            $element = &$root->getElementsByPath($variable, 1);
            $value = $element ? $element->getText() : '';
        }
    }

    return $value;
}

?>
