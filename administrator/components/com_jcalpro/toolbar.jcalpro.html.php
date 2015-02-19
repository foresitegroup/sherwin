<?php
/*
**********************************************
JCal Pro v1.5.3
Copyright (c) 2006-2007 Anything-Digital.com
**********************************************
JCal Pro is a fork of the existing Extcalendar component for Joomla!
(com_extcal_0_9_2_RC4.zip from mamboguru.com). 
Extcal (http://sourceforge.net/projects/extcal) was renamed 
and adapted to become a Mambo/Joomla! component by 
Matthew Friedman, and further modified by David McKinnis
(mamboguru.com) to repair some security holes. 

This file is based on toolbar.extcalendar.html.php v1.9 (2005/02/16) by stingrey.

This program is free software; you can redistribute it and/or modify 
it under the terms of the GNU General Public License as published by 
the Free Software Foundation; either version 2 of the License, or 
(at your option) any later version.

This header must not be removed. Additional contributions/changes
may be added to this header as long as no information is deleted.
**********************************************

$File: toolbar.jcalpro.html.php $

Revision date: 02/20/2007

**********************************************
Get the latest version of JCal Pro at:
http://dev.anything-digital.com//
**********************************************
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
* @package Mambo
* @subpackage Extcalendar
*/
class TOOLBAR_extcalendar {
	/**
	* Draws the menu for to Edit settings
	*/
	        function _THEMES() {
    		mosMenuBar::startTable();
    		mosMenuBar::makeDefault();
				mosMenuBar::spacer();
    		mosMenuBar::custom('installtheme', 'upload.png', 'upload_f2.png', 'Install',false);
    		mosMenuBar::spacer();
    		mosMenuBar::custom('cancel', 'cancel.png', 'cancel_f2.png', 'Cancel', false);
    		mosMenuBar::endTable();
        }
        function _EDIT_THEMES() {
    		global $id;

    		mosMenuBar::startTable();
    		mosMenuBar::custom('savetheme', 'save.png', 'save_f2.png', 'Save', false);
    		mosMenuBar::spacer();
    		if ( $id ) {
    			// for existing content items the button is renamed `close`
    			mosMenuBar::custom('canceledit', 'cancel.png', 'cancel_f2.png', 'Close', false);
    		} else {
         	mosMenuBar::custom('canceledit', 'cancel.png', 'cancel_f2.png', 'Cancel', false);
    		}
    		mosMenuBar::spacer();
    		mosMenuBar::help( 'screen.mambots.edit' );
    		mosMenuBar::endTable();
    	}
  function _INSTALL( $element )
  {    		
		if( $element == 'themes' )
		{            	
    	mosMenuBar::startTable();
    	//mosMenuBar::custom('showthemes', 'new.png', 'new_f2.png', 'Themes', false);
    	//mosMenuBar::spacer();
    	mosMenuBar::custom('removetheme', 'delete.png', 'delete_f2.png', 'Uninstall', false);
    	mosMenuBar::spacer();
    	mosMenuBar::custom('cancel', 'cancel.png', 'cancel_f2.png', 'Cancel', false);
    	mosMenuBar::endTable();
		}
  }
	
	function _EDIT() {
		mosMenuBar::startTable();
		mosMenuBar::spacer();
		mosMenuBar::save('saveSettings');
		mosMenuBar::spacer();
		mosMenuBar::cancel('cancelEditSettings');
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}
	function _DEFAULT() {
		mosMenuBar::startTable();
		if (is_callable(array('mosMenuBar', 'editListX'))) {
            mosMenuBar::editListX('editSettings','Settings');
        } else { 
			mosMenuBar::editList('editSettings','Settings');
		}
		mosMenuBar::custom('showthemes', 'new.png', 'new_f2.png', 'Themes', false);
    mosMenuBar::spacer();
		
		mosMenuBar::custom('categories','move.png','move_f2.png','Categories',false);
		mosMenuBar::endTable();
	}
	
	function _DOCUMENTATION() {
		mosMenuBar::startTable();
		mosMenuBar::spacer();
		mosMenuBar::cancel();
		mosMenuBar::endTable();
	}
	
	function _ABOUT() {
		mosMenuBar::startTable();
		mosMenuBar::spacer();
		mosMenuBar::cancel();
		mosMenuBar::endTable();
	}
	
	function _IMPORT() {
		mosMenuBar::startTable();
		mosMenuBar::spacer();
		mosMenuBar::cancel();
		mosMenuBar::endTable();
	}
	
	/* Events toolbars */	
	function EDIT_EVENTS_MENU ( )
  {
		mosMenuBar::startTable();
		mosMenuBar::save();
		mosMenuBar::cancel();
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	} 

	function EVENTS_MENU ( )
	{
		mosMenuBar::startTable();
		mosMenuBar::publishList();
		mosMenuBar::unpublishList();
		mosMenuBar::addNew('new', 'Add');
		mosMenuBar::editList();
		mosMenuBar::deleteList();
		mosMenuBar::cancel('cancelToMain', 'Cancel');
		mosMenuBar::endTable();	
	}	
}

/**
* @package Mambo
* @subpackage Extcalendar
*/
class TOOLBAR_extcalendarCategories {
	/**
	* Draws the menu for to Edit a category
	*/
	function _EDITCATEGORY() {
		mosMenuBar::startTable();
		mosMenuBar::spacer();
		mosMenuBar::save('saveCategory');
		mosMenuBar::spacer();
		mosMenuBar::cancel('cancelEditCategory');
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}
	function _DEFAULTCATEGORIES() {
		mosMenuBar::startTable();
		if (is_callable(array('mosMenuBar', 'addNewX'))) {
			mosMenuBar::addNewX('newCategory');
        } else { 
			mosMenuBar::addNewX('newCategory');
		}
		mosMenuBar::publishList();
		mosMenuBar::unpublishList();
		if (is_callable(array('mosMenuBar', 'editListX'))) {
			mosMenuBar::editListX('editCategory');
        } else { 
			mosMenuBar::editList('editCategory');
		}
		mosMenuBar::deleteList('','deleteCategories');
		mosMenuBar::spacer();
    mosMenuBar::custom('cancel', 'cancel.png', 'cancel_f2.png', 'Cancel', false);
		mosMenuBar::endTable();
	}
}

?>