<?php
/**
* @version $Id: mambot.php 2924 2006-03-27 06:58:11Z akede $
* @package Joomla
* @subpackage Installer
* @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
* */

// no direct access
defined('_VALID_MOS') or die('Restricted access');

// ensure user has access to this function
/*if (!$acl->acl_check( 'administration', 'install', 'users', $my->usertype, $element . 's', 'all')) {
mosRedirect( 'index2.php', _NOT_AUTH );
}*/

require_once($mosConfig_absolute_path.'/administrator/components/com_installer/admin.installer.html.php');
require_once($sefAdminPath.'installer/sefext.html.php');
require_once($mosConfig_absolute_path.'/includes/domit/xml_domit_lite_include.php' );

/*HTML_installer::showInstallForm('Install new SEF Extensions', $option, 'sefext', '', dirname(__FILE__));
HTML_sefext::showWritable();
showInstalledExts($option);*/

function showInstalledExts($_option)
{
    global $mosConfig_absolute_path;

    // path to mambot directory
    $extBaseDir	= mosPathName(mosPathName($mosConfig_absolute_path).'components/com_sef/sef_ext');
    $exts = array();

    $dir = dir($extBaseDir);
    while (false !== ($entry = $dir->read())) {
        if (substr($entry, -4) == '.xml') {
            $exts[] = array('id' => $entry);
        }
    }
    $dir->close();

    $n = count($exts);
    for ($i = 0; $i < $n; $i++) {
        $ext =& $exts[$i];
        // xml file for module

        $xmlDoc = new DOMIT_Lite_Document();
        $xmlDoc->resolveErrors(true);
        if (!$xmlDoc->loadXML($extBaseDir.$ext['id'], false, true)) {
            continue;
        }

        $root = &$xmlDoc->documentElement;
        if ($root->getTagName() != 'mosinstall') {
            continue;
        }
        if ($root->getAttribute('type') != 'sef_ext') {
            continue;
        }

        $element            = &$root->getElementsByPath('name', 1);
        $ext['name']        = $element ? $element->getText() : '';

        $element 			 = &$root->getElementsByPath('creationDate', 1);
        $ext['creationdate'] = $element ? $element->getText() : '';

        $element 			= &$root->getElementsByPath('author', 1);
        $ext['author']		= $element ? $element->getText() : '';

        $element 			= &$root->getElementsByPath('copyright', 1);
        $ext['copyright']	= $element ? $element->getText() : '';

        $element 			= &$root->getElementsByPath('authorEmail', 1);
        $ext['authorEmail']	= $element ? $element->getText() : '';

        $element 			= &$root->getElementsByPath('authorUrl', 1);
        $ext['authorUrl']	= $element ? $element->getText() : '';

        $element 			= &$root->getElementsByPath('version', 1);
        $ext['version']		= $element ? $element->getText() : '';
    }

    HTML_sefext::showInstalledExts($exts, $_option);
}
?>