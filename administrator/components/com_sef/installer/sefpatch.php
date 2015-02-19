<?php
/**
* @version $Id: sefpatch.php 2924 2006-03-27 06:58:11Z akede $
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
require_once($sefAdminPath.'installer/sefpatch.html.php');
require_once($mosConfig_absolute_path.'/includes/domit/xml_domit_lite_include.php' );

/*HTML_installer::showInstallForm('Install new SEF Extensions', $option, 'sefext', '', dirname(__FILE__));
HTML_sefext::showWritable();
showInstalledExts($option);*/

function showInstalledPatches($_option) {
    global $database, $mosConfig_absolute_path;

    $query = "SELECT id, name, element, client_id"
    . "\n FROM #__mambots"
    . "\n WHERE iscore = 0 AND folder = 'sefpatch'"
    . "\n ORDER BY name"
    ;
    $database->setQuery( $query );
    $rows = $database->loadObjectList();

    // path to mambot directory
    $mambotBaseDir	= mosPathName( mosPathName( $mosConfig_absolute_path ) . "mambots" );

    $n = count($rows);
    for ($i = 0; $i < $n; $i++) {
        $row = &$rows[$i];
        // xml file for module
        $xmlfile = $mambotBaseDir. '/sefpatch/' . $row->element .".xml";

        $xmlDoc = new DOMIT_Lite_Document();
        $xmlDoc->resolveErrors(true);
        if (!$xmlDoc->loadXML($xmlfile, false, true)) {
            continue;
        }

        $root = &$xmlDoc->documentElement;
        if ($root->getTagName() != 'mosinstall') {
            continue;
        }
        if ($root->getAttribute('type') != 'mambot') {
            continue;
        }

        $element 			= &$root->getElementsByPath('creationDate', 1);
        $row->creationdate 	= $element ? $element->getText() : '';

        $element 			= &$root->getElementsByPath('author', 1);
        $row->author 		= $element ? $element->getText() : '';

        $element 			= &$root->getElementsByPath('copyright', 1);
        $row->copyright 	= $element ? $element->getText() : '';

        $element 			= &$root->getElementsByPath('authorEmail', 1);
        $row->authorEmail 	= $element ? $element->getText() : '';

        $element 			= &$root->getElementsByPath('authorUrl', 1);
        $row->authorUrl 	= $element ? $element->getText() : '';

        $element 			= &$root->getElementsByPath('version', 1);
        $row->version 		= $element ? $element->getText() : '';
    }

    HTML_sefpatch::showInstalledPatches($rows, $_option);
}
?>