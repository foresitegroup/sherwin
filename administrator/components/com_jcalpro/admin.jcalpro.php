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

This program is free software; you can redistribute it and/or modify 
it under the terms of the GNU General Public License as published by 
the Free Software Foundation; either version 2 of the License, or 
(at your option) any later version.

This header must not be removed. Additional contributions/changes
may be added to this header as long as no information is deleted.
**********************************************

$File: admin.jcalpro.php$

Revision date: 02/20/2007

**********************************************
Get the latest version of JCal Pro at:
http://dev.anything-digital.com//
**********************************************
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

// ensure user has access to this function
if (!($acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'all' )
		| $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'com_jcalpro' ))) {
	mosRedirect( 'index2.php', _NOT_AUTH );
}

require_once( $mainframe->getPath( 'admin_html' ) );
require_once( $mainframe->getPath( 'class' ) );

$comp_path = $mosConfig_absolute_path.'/administrator/components/com_jcalpro';

require_once( $comp_path.'/themes/themes.php' );
//require_once( $comp_path.'/languages/languages.php' );
require_once( $comp_path.'/installer/installer.php' );

//$task =  (!isset($task) || ($task == '')) ? "showSettings" : $task;
$cid = mosGetParam( $_POST, 'cid', mosGetParam( $_REQUEST, 'cat_id', array(0) ) );
if (is_array($cid)) foreach ($cid as $key => $id) $cid[$key] = intval($id);
else $cid = array(intval($cid));

require_once( $comp_path.'/admin.config.inc.php');

if ( trim ( $section ) != "" && $task != 'cancelToMain')
{
	include_once ( $comp_path. '/includes/' . $section . '.php' );
}
else
{
	switch ($task) {
		case 'theme':
			$theme = mosGetParam( $_GET, 'theme' );
			$file = mosGetParam( $_GET, 'file' );
			$path = 'mambots/editors/jce/jscripts/tiny_mce/themes/'.$theme.'/'.$file;
			include_once $mosConfig_absolute_path . DIRECTORY_SEPARATOR . $path;
			break;
		
		case 'main':
			HTML_JCEAdmin::showAdmin();
			break;
			
		case 'save':
			saveconfig();
			break;
		
		case 'config':
			global $client, $eid;
				mosRedirect( 'index2.php?option=com_mambots&client=' . $client . '&task=editA&hidemainmenu=1&id=' . $eid. '' );
			break;
	
		case 'editlayout':
			global $client, $eid;
				editLayout( $option, $client );
	  break;
	
		case 'savelayout':
			saveLayout( $option, $client );
		break;
	
		case 'applyaccess':
			applyAccess( $cid, $option, $client );
		break;
	
		case 'showthemes':
		case 'themes':
			global $client, $eid;
			viewThemes( $option, $client );                
		break;
		
		case 'default':
			defaultTemplate( $cid[0], $option, $client );
		break;
		
		case 'newtheme':
		case 'edittheme':	
			//editThemes( $option, $id, $client );
		break;
	
		case 'savetheme':
		case 'applytheme':
			saveThemes( $option, $client, $task );
		break;
	
		case 'canceledit':
			cancelEdit( $option, $client );
		break;
	
		case 'removetheme':
			removeTheme( $cid[0], $option, $client );
		break;
	
		case 'installtheme':
			global $client;
			mosRedirect( 'index2.php?option=com_jcalpro&client=' . $client . '&task=install&element=themes' );
		break;
		
		case 'install':
			global $client, $eid;
			
			$CONFIG_EXT['ADMIN_PATH'] = $mosConfig_absolute_path . "/administrator/components/com_jcalpro/";        // Your admin file system path
		
			extcalInstaller( $option, $client, 'show' );
		break;
		
		case 'uploadfile':
			extcalInstaller( $option, $client, 'uploadfile' );
		break;
		
		case 'installfromdir':
			extcalInstaller( $option, $client, 'installfromdir' );
		break;
		
		case 'remove':
			extcalInstaller( $option, $client, 'remove' );
		break;	
	
		case 'categories':
			switchToCategoriesPage();
			break;
	
		case 'newCategory':
			newCategory( $option );
			break;
	
		case 'editCategory':
			editCategory( $cid[0], $option );
			break;
	
		case 'saveCategory':
			saveCategory( $option );
			break;
	
		case 'cancelEditCategory':
			cancelEditCategory( $option );
			break;
	
		case 'showCategories':
			showCategories( $option );
			break;
			
		case 'deleteCategories':
			deleteCategories( $option, $cid );
			break;
			
		case 'publish':
			publishCategories( $option, $cid, 1 );
			break;
			
		case 'unpublish':
			publishCategories( $option, $cid, 0 );
			break;
	
		case 'editSettings':
			editSettings( $option );
			break;
	
		case 'saveSettings':
			saveSettings( $option );
			break;
	
		case 'cancelEditSettings':
			cancelEditSettings( $option );
			break;
			
		case 'about':
			showSettings( $option );
		break;
		
		case 'documentation':
			documentation( $option );
		break;
		
		case 'import':
			import( $option );
		break;
		
		case 'importCalendar':
			importCalendar( $option );
		break;		
			
		default:
			HTML_extcalendar::showAdmin();
			break;
	}
}


function switchToCategoriesPage() {
	mosRedirect( 'index2.php?option=com_jcalpro&task=showCategories' );
}

function import ( )
{
	global $database, $mainframe, $mosConfig_lang, $mosConfig_db, $mosConfig_dbprefix;
	
	$query = "show tables";
	$database->setQuery( $query );
	
	$database->query();
	
	$rows = $database->loadObjectList();
	
 	$cals = array ();

 	

 	foreach ( $rows as $key => $value ) 
 	{	
 		$name = "Tables_in_$mosConfig_db";
 		
 		if ( $value->$name == $mosConfig_dbprefix . 'extcal_categories' )
		{
			$cals[$key]['id'] = 'extcal';
			$cals[$key]['name'] = 'Ext Calendar';
		}
	}
	
	HTML_extcalendar::import( $cals );
}



function importCalendar ( )
{	
	global $database, $mainframe, $mosConfig_lang;
	
	if (!function_exists('htmlspecialchars_decode')) 
	{
		function htmlspecialchars_decode ( $str ) 
		{
			$trans = get_html_translation_table(HTML_SPECIALCHARS);
	
			$decode = ARRAY();
			foreach ( $trans AS $char=>$entity ) 
			{
				$decode[$entity] = $char;
			}
	
	     $str = strtr($str, $decode);
	
	     return $str;
		}
	}
	
	$id = mosGetParam( $_GET, 'id' );
	
	if ( $id = 'extcal' )
	{
		$cal[0]['newTable'] = 'categories';
		$cal[0]['oldTable'] = 'categories';
		$cal[0]['fields'] = array ( 
			'cat_id' => 'cat_id', 
			'cat_parent' => 'cat_parent',
			'cat_name' => 'cat_name', 
			'description' => 'description', 
			'color' => 'color', 
			'bgcolor' => 'bgcolor',
			'options' => 'options',
			'published' => 'published',
			'checked_out' => 'checked_out',
			'checked_out_time' => 'checked_out_time'
		);
		
		/*$cal[1]['newTable'] = 'config';
		$cal[1]['oldTable'] = 'config';
		$cal[1]['fields'] = array ( 
			'name' => 'name', 
			'value' => 'value',
			'checked_out' => 'checked_out', 
			'checked_out_time' => 'checked_out_time'			
		);
		*/
		
		$cal[2]['newTable'] = 'events';
		$cal[2]['oldTable'] = 'events';
		$cal[2]['fields'] = array ( 
			'extid' => 'extid', 
			'title' => 'title',
			'description' => 'description', 
			'contact' => 'contact', 
			'url' => 'url', 
			'email' => 'email',
			'cat' => 'cat',
			'day' => 'day',
			'month' => 'month',
			'year' => 'year',
			'approved' => 'approved',
			'start_date' => 'start_date',		
			'end_date' => 'end_date',
			'recur_type' => 'recur_type',
			'recur_val' => 'recur_val',
			'recur_end_type' => 'recur_end_type',
			'recur_count' => 'recur_count',
			'recur_until' => 'recur_until'
		);
	} 
			
		foreach ( $cal as $calKey => $calValue ) 
	 	{
			$query = "
				SELECT 
					* 
				FROM
					#__" . $id . "_" . $cal[$calKey]['oldTable'] . "
			";
			
			$database->setQuery( trim ( $query ) );
		
			$database->query();
			
			$vals = $database->loadObjectList();
			
			foreach ( $vals as $valsKey => $valsValue ) 
		 	{
		 		$notFirst = 0;
		 		
		 		$query = "INSERT INTO #__jcalpro_" . $cal[$calKey]['newTable'] . "
				";
				
				foreach ( $cal[$calKey]['fields'] as $fieldsKey => $fieldsValue ) 
		 		{	
		 			if ( preg_match ( "/default\(([[:alnum:]]*)\)/", $fieldsValue, $matches ) )
		 			{
		 				$setValue = $matches[1];
		 			}
		 			else
		 			{
		 				$setValue = $valsValue->$fieldsValue;
		 			}
		 			
		 			$setValue = preg_replace ( '@\[B\](.*)\[/B\]@', '<strong>${1}</strong>', $setValue );
		 			$setValue = preg_replace ( '@\[I\](.*)\[/I\]@', '<i>${1}</i>', $setValue );
		 			$setValue = preg_replace ( '@\[U\](.*)\[/U\]@', '<u>${1}</u>', $setValue );
		 			
		 			$setValue = preg_replace ( '@\[LEFT\](.*)\[/LEFT\]@', '<div align="left">${1}</div>', $setValue );
		 			$setValue = preg_replace ( '@\[CENTER\](.*)\[/CENTER\]@', '<div align="center">${1}</div>', $setValue );
		 			$setValue = preg_replace ( '@\[RIGHT\](.*)\[/RIGHT\]@', '<div align="right">${1}</div>', $setValue );
		 			
		 			$setValue = preg_replace ( '@\[URL=(.*)\](.*)\[/URL\]@', '<a href="${1}">${2}</a>', $setValue );
		 			$setValue = preg_replace ( '@\[IMG\](.*)\[/IMG\]@', '<img src="${1}">', $setValue );
		 			
		 			$setValue = htmlspecialchars_decode ( $setValue );
		 			
		 			if ( $notFirst == 1 )
		 			{	 			
		 				$query .= ", " . $fieldsKey . " = '" . addslashes ( $setValue ) . "'";
		 			}
		 			else
		 			{
		 				$query .= " SET " . $fieldsKey . " = '" . addslashes ( $setValue ) . "'";
		 			}
		 			
		 			$notFirst = 1;
		 		}
		 		
		 		$database->setQuery( $query );
		
				$database->query ( );
				
				echo mysql_error ( );
			
		 		$queries["jos_jcalpro_" . $cal[$calKey]['newTable']][]  = $query; 
			}
		}
	
	HTML_extcalendar::importCalendar( $queries );
}


function showSettings( $option ) {
	global $database, $mainframe, $mosConfig_lang;

	$query = "SELECT * FROM #__jcalpro_config";
	$database->setQuery( $query );

	if(!$result = $database->query()) {
		echo $database->stderr();
		return;
	}
	$rows = $database->loadObjectList();
	HTML_extcalendar::showSettings( $rows, $option );
}

function documentation ( $option )
{
	HTML_extcalendar::documentation( );
}


function editSettings( $option ) {
	global $database, $mainframe, $mosConfig_absolute_path, $mosConfig_live_site, $my, $mosConfig_lang, $CONFIG_EXT, $THEME_DIR,
	 $today, $zone_stamp, $DB_DEBUG, $ME, $REFERER, $lang_date_format, $lang_settings_data, $lang_info, $theme_info, $lang_general, $lang_config_data, $comp_path;

	$query = "SELECT ec.*, u.name as editor FROM #__jcalpro_config as ec "
	. "\n LEFT JOIN #__users AS u ON u.id = ec.checked_out";
	$database->setQuery( $query );

	if(!$result = $database->query()) {
		echo $database->stderr();
		return;
	}
	
	require_once($CONFIG_EXT['ADMIN_PATH'].'admin.config.inc.php');
	
	foreach($lang_config_data as $element) {
		if ((is_array($element))) {
			$row = new mosExtCalendarSettings($database);
			$row->load( $element[1] );
			$row->checkout( $my->id );
		}
	}
	
	HTML_extcalendar::editSettings( $option );
	include( $comp_path.'/admin_settings.php');
}

function saveSettings( $option ) {
	global $database, $mainframe, $mosConfig_absolute_path, $mosConfig_live_site, $my, $mosConfig_lang, $CONFIG_EXT, $THEME_DIR,
	 $today, $zone_stamp, $DB_DEBUG, $ME, $REFERER, $lang_date_format, $lang_settings_data, $lang_info, $theme_info, $lang_general, $lang_config_data;

	require_once($CONFIG_EXT['ADMIN_PATH'].'admin.config.inc.php');

	foreach($lang_config_data as $element) {
		if ((is_array($element))) {
			//if ((!isset($_POST[$element[1]]))) die("Missing config value for '{$element[1]}'". __FILE__ . __LINE__);
			$value = addslashes($_POST[$element[1]]);
			extcal_db_query("UPDATE #__jcalpro_config SET value = '$value' WHERE name = '{$element[1]}'");
			$row = new mosExtCalendarSettings($database);
			$row->load( $element[1] );
			$row->checkin();
		}
	}
	
	$msg = 'Saved New Settings';

	mosRedirect( 'index2.php?option=com_jcalpro', $msg );
}

function cancelEditSettings() {
	global $database;
	
	$checkInQuery = "SELECT * FROM #__jcalpro_config";
	$database->setQuery( $checkInQuery );
	$rows = $database->loadObjectList();
	
 	foreach($rows as $key => $value) {
		$row = new mosExtCalendarSettings($database);
		$row->load( $value->name );
		$row->checkin();
	}
	
	mosRedirect( 'index2.php?option=com_jcalpro', 'Cancelled Settings Change' );
}

function showCategories( $option ) {
	global $database, $mainframe, $mosConfig_lang, $mosConfig_list_limit;

	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
	$limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );

	// get the total number of records
	$database->setQuery( "SELECT count(*) FROM #__jcalpro_categories" );
	$total = $database->loadResult();

	require_once( $GLOBALS['mosConfig_absolute_path'] . '/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit );

	$query = "SELECT c.*, u.name as editor FROM #__jcalpro_categories as c "
	. "\n LEFT JOIN #__users AS u ON u.id = c.checked_out"
	. "\nORDER BY c.cat_name LIMIT $pageNav->limitstart,$pageNav->limit";
	$database->setQuery( $query );

	if(!$result = $database->query()) {
		echo $database->stderr();
		return;
	}
	$rows = $database->loadObjectList();
	HTML_extcalendar::showCategories( $rows, $pageNav, $option );
}

function newCategory( $option ) {
	global $database, $mainframe, $mosConfig_absolute_path, $mosConfig_live_site, $my, $mosConfig_lang, $CONFIG_EXT, $THEME_DIR, $form,
	 $today, $zone_stamp, $DB_DEBUG, $ME, $REFERER, $lang_date_format, $lang_settings_data, $lang_info, $theme_info, $lang_general,
	 $lang_config_data, $template_cat_form, $lang_cat_admin_data, $errors;

	require_once($CONFIG_EXT['ADMIN_PATH'].'admin.config.inc.php');
	HTML_extcalendar::editCategory( $option );

	$form['published'] = 1;	
	$form['adminapproved'] = true;
	$form['userapproved'] = false;	

	$form['color'] = "#505054";

	pageheader('', '', false);
	display_cat_form('index2.php','add',$form);
	echo '
		   <input type="hidden" name="option" value="'.$option.'">
		   <input type="hidden" name="task" value="initial">
		 </form>
	';
	
	// footer
	//pagefooter();
}

function editCategory( $cat_id, $option ) {
	global $database, $mainframe, $mosConfig_absolute_path, $mosConfig_live_site, $my, $mosConfig_lang, $CONFIG_EXT, $THEME_DIR, $form,
	 $today, $zone_stamp, $DB_DEBUG, $ME, $REFERER, $lang_date_format, $lang_settings_data, $lang_info, $theme_info, $lang_general,
	 $lang_config_data, $template_cat_form, $lang_cat_admin_data, $errors;

	require_once($CONFIG_EXT['ADMIN_PATH'].'admin.config.inc.php');
	HTML_extcalendar::editCategory( $option );
	
	$query = "SELECT * FROM #__jcalpro_categories WHERE cat_id = '$cat_id'";
	$database->setQuery( $query );
	$formObject = $database->loadObjectList();
	$form = get_object_vars( $formObject[0] );
	
	$form['userapproved'] = $form['options'] & 1;
	$form['adminapproved'] = $form['options'] & 2;

	pageheader('', '', false);
	display_cat_form('index2.php','edit',$form);
	echo '
		   <input type="hidden" name="option" value="'.$option.'">
		   <input type="hidden" name="task" value="initial">
		 </form>
	';
	
	// footer
	pagefooter();
}

function cancelEditCategory( $option ) {
	global $database;
	
	$row = new mosExtCalendarCategories($database);
	$row->bind( $_POST );
	$row->checkin();
	
	mosRedirect( "index2.php?option=$option&task=showCategories", 'Cancelled Categories Change' );
}

function saveCategory( $option ) {
	global $database;
	
	$row = new mosExtCalendarCategories( $database );

	if (!$row->bind( $_POST )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	if (!$row->check()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	
	$admin_auto_approve = (isset($_POST['adminapproved']))?1:0;
	$user_auto_approve = (isset($_POST['userapproved']))?1:0;
	$row->options = $user_auto_approve + $admin_auto_approve*2;
	
	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	$row->checkin();
	
	mosRedirect( "index2.php?option=$option&task=showCategories", 'Saved Categories Change' );
}


/**
* Publishes or Unpublishes one or more categories
* @param array An array of unique category id numbers
* @param integer 0 if unpublishing, 1 if publishing
* @param string The name of the current user
*/
function publishCategories( $option, $cid=null, $publish=1 ) {
	global $database, $my;

	if (!is_array( $cid )) {
		$cid = array();
	}

	if (count( $cid ) < 1) {
		$action = $publish ? 'publish' : 'unpublish';
		echo "<script> alert('Select a category to $action'); window.history.go(-1);</script>\n";
		exit;
	}

	$cids = implode( ',', $cid );

	$query = "UPDATE #__jcalpro_categories SET published='$publish'"
	. "\nWHERE cat_id IN ($cids) AND (checked_out=0 OR (checked_out='$my->id'))"
	;
	$database->setQuery( $query );
	if (!$database->query()) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}

	if (count( $cid ) == 1) {
		$row = new mosExtCalendarCategories( $database );
		$row->checkin( $cid[0] );
	}

	mosRedirect( 'index2.php?option='.$option.'&task=showCategories' );
}

function deleteCategories( $option, $cid ) {
	global $database;
	if (count( $cid )) {
		$cids = implode( ',', $cid );
		$database->setQuery( "DELETE FROM #__jcalpro_categories WHERE cat_id IN ($cids)" );
		if (!$database->query()) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		}
	}
	mosRedirect( 'index2.php?option='.$option.'&task=showCategories', 'Delete Successful' );
}

?>
