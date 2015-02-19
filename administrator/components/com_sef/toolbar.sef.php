<?php
/**
 * SEF module for Joomla!
 *
 * @author      $Author: michal $
 * @copyright   ARTIO s.r.o., http://www.artio.cz
 * @package     JoomSEF
 * @version     $Name$, ($Revision: 4994 $, $Date: 2005-11-03 20:50:05 +0100 (??t, 03 XI 2005) $)
 */

// Security check to ensure this file is being included by a parent file.
if (!defined('_VALID_MOS')) die('Direct Access to this location is not allowed.');

require_once($mainframe->getPath('toolbar_html'));
require_once($mainframe->getPath('toolbar_default'));

switch (@$task) {
    case '':
    case 'uninstallext': {
        TOOLBAR_sef::_CPANEL();
        break;
    }
    case 'view301':
    case 'view': {
        if (@$_GET['section'] == 'config')
        TOOLBAR_sef::_NEW();
        else
        TOOLBAR_sef::_DEFAULT();
        break;
    }
    case 'showconfig':
    case 'edit':
    case 'editext': {
        TOOLBAR_sef::_EDIT();
        break;
    }
    case 'new': {
        TOOLBAR_sef::_NEW();
        break;
    }
    case 'installext': {
        TOOLBAR_sef::_INSTALL();
        break;
    }
    default: {
        TOOLBAR_sef::_INFO();
        break;
    }
}
?>