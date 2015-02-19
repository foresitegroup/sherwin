<?php
/**
* @version $Id: mambot.class.php 393 2005-10-08 13:37:52Z akede $
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
defined( '_VALID_MOS' ) or die( 'Restricted access' );

// Load mosInstaller.
require_once($mosConfig_absolute_path.'/administrator/components/com_installer/installer.class.php');

/**
 * Module installer
 * 
 * @package     Joomla
 * @subpackage  Installer
 */
class mosInstallerSef extends mosInstaller
{

    /**
     * Custom install method.
     * 
 	 * @param boolean True if installing from directory
	 */
    function install($p_fromdir = null)
    {
        global $mosConfig_absolute_path, $database;

        if (!$this->preInstallCheck($p_fromdir, 'sef_ext')) {
            return false;
        }

        $xmlDoc 	= $this->xmlDoc();
        $mosinstall =& $xmlDoc->documentElement;
        $installPath = $mosConfig_absolute_path.'/components/com_sef/sef_ext/';

        // Set some vars
        $e = &$mosinstall->getElementsByPath('name', 1);
        $this->elementName($e->getText());

        $this->elementDir(mosPathName($mosConfig_absolute_path.'/components/com_sef/sef_ext'));

        if (!file_exists($this->elementDir()) && !mosMakePath($this->elementDir())) {
            $this->setError(1, 'Failed to create directory "'.$this->elementDir().'"');
            return false;
        }

        if ($this->parseFiles('files', 'sef_ext', 'No file is marked as SEF Extension file') === false) {
            return false;
        }

        // Insert extension into database
        $query = "SELECT file"
        . "\n FROM #__sefexts"
        . "\n WHERE file = " . $database->Quote( basename($this->installFilename()) )
        ;
        $database->setQuery( $query );
        $id = $database->loadResult();

        if(!$id) {
            $database->setQuery("INSERT INTO #__sefexts (file) VALUES(".$database->Quote( basename($this->installFilename()) ).")");
            if (!$database->query()) {
                $this->setError( 1, 'SQL error: ' . $database->stderr( true ) );
                return false;
            }
        }

        // Remove already created URLs for this extension from database
        $component = preg_replace('/.xml$/', '', $this->installFilename());
        $query = "DELETE FROM `#__redirection` WHERE (`newurl` LIKE '%option=$component&%' OR `newurl` LIKE '%option=$component')";
        $database->setQuery($query);
        if (!$database->query()) {
            $this->setError( 1, 'SQL error: ' . $database->stderr( true ) );
            return false;
        }

		// Are there any SQL queries??
		$query_element = &$mosinstall->getElementsByPath('install/queries', 1);
		if (!is_null($query_element)) {
			$queries = $query_element->childNodes;
			foreach($queries as $query)
			{
				$database->setQuery( $query->getText());
				if (!$database->query())
				{
					$this->setError( 1, "SQL Error " . $database->stderr( true ) );
					return false;
				}
			}
		}

        // Is there an installfile
        $installfile_elemet = &$mosinstall->getElementsByPath('installfile', 1);

        if (!is_null($installfile_elemet)) {
            // check if parse files has already copied the install.component.php file (error in 3rd party xml's!)
            if (!file_exists($installPath.$installfile_elemet->getText())) {
                if(!$this->copyFiles($this->installDir(), $installPath, array($installfile_elemet->getText())))  			{
                    $this->setError( 1, 'Could not copy PHP install file.');
                    return false;
                }
            }
            $this->hasInstallfile(true);
            $this->installFile($installfile_elemet->getText());
        }

        if ($e = &$mosinstall->getElementsByPath('description', 1)) {
            $this->setError(0, $this->elementName().'<p>'.$e->getText().'</p>');
        }

        if ($this->hasInstallfile()) {
            if (is_file($installPath.'/'.$this->installFile())) {
                require_once($installPath.'/'.$this->installFile());
                $ret = com_install();
                if ($ret != '') $this->setError(0, $ret);
            }
        }
        return $this->copySetupFile('front');
    }

    /**
 	 * Custom install method
 	 * 
 	 * @param int The id of the module
	 * @param string The URL option
	 * @param int The client id
	 */
    function uninstall($id, $option, $client = 0)
    {
        global $mosConfig_absolute_path, $database;

        $basepath = $mosConfig_absolute_path.'/components/com_sef/sef_ext/';
        $xmlfile  = $basepath.$id;
        $ext = str_replace('.xml', '', $id);

        // see if there is an xml install file, must be same name as element
        if (file_exists($xmlfile)) {
            $this->i_xmldoc = new DOMIT_Lite_Document();
            $this->i_xmldoc->resolveErrors(true);

            if ($this->i_xmldoc->loadXML($xmlfile, false, true)) {
                $mosinstall =& $this->i_xmldoc->documentElement;
                // get the files element
                $files_element =& $mosinstall->getElementsByPath('files', 1);
                if (!is_null( $files_element )) {
                    $files = $files_element->childNodes;
                    foreach ($files as $file) {
                        // delete the files
                        $filename = $file->getText();
                        if (file_exists( $basepath . $filename )) {
                            $parts = pathinfo( $filename );
                            $subpath = $parts['dirname'];
                            if ($subpath != '' && $subpath != '.' && $subpath != '..') {
                                echo '<br />Deleting: '.$basepath.$subpath;
                                $result = deldir(mosPathName($basepath.$subpath.'/'));
                            } else {
                                echo '<br />Deleting: '. $basepath . $filename;
                                $result = unlink( mosPathName ($basepath . $filename, false));
                            }
                            echo intval( $result );
                        }
                    }

                    // remove XML file from front
                    echo "Deleting XML File: $xmlfile";
                    @unlink(  mosPathName ($xmlfile, false ) );

                    // define folders that should not be removed
                    $sysFolders = array(
                    'content',
                    'search'
                    );
                    if (!in_array( $row->folder, $sysFolders )) {
                        // delete the non-system folders if empty
                        if (count( mosReadDirectory( $basepath ) ) < 1) {
                            deldir( $basepath );
                        }
                    }
                }
            }
        }
        
        // Remove the extension's texts
        $query = "DELETE FROM `#__sefexttexts` WHERE `extension` = '$ext'";
        $database->setQuery($query);
        $database->query();

        if ($row->iscore) {
            HTML_installer::showInstallMessage( $row->name .' is a core element, and cannot be uninstalled.<br />You need to unpublish it if you don\'t want to use it',
            'Uninstall -  error', $this->returnTo( $option, 'mambot', $client ) );
            exit();
        }

        return true;
    }

}
?>