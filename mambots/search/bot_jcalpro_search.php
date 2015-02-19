<?php

/*
**********************************************
JCal Pro Search Mambot v1.5.1
Copyright (c) 2006 Anything-Digital.com
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

* Search Mambot
*
* Revision date: 03/20/2007
*
* Module for displaying upcoming events in connection with the JCal Pro
* component. The component must be installed before this module will work. 
* There are some options for this module, which can be set in the 
* "Parameters" section of the module in Administration.
*

**********************************************
Get the latest version of JCal Pro at:
http://dev.anything-digital.com//
**********************************************
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
$_MAMBOTS->registerFunction( 'onSearch', 'botSearchEM' );

function botSearchEM( $text, $phrase='', $ordering='' ) {
  global $database,$my;
  
  $gids = array(
    "Super Administrator"=>25,
    "Admin"=>24,
    "Manager"=>23,
    "Publisher"=>21,
    "Editor"=>20,
    "Author"=>19,
    "Registered"=>18,
    ""=>0,
  );
  
  $levels = array(
    "super administrator"=>25,
    "administrator"=>24,
    "manager"=>23,
    "publisher"=>21,
    "editor"=>20,
    "author"=>19,
    "registered"=>18,
    "public frontend"=>0,

    "default"=>0,
  );
  
  $text = trim( $text );
  if ($text == '') {
    return array();
  }
	$wheres = array();
	switch ($phrase) {
		case 'exact':
			$wheres2 = array();
			$wheres2[] = "LOWER(b.title) LIKE '%$text%'";						
			$wheres2[] = "LOWER(b.description) LIKE '%$text%'";
			$wheres2[] = "LOWER(c.cat_name) LIKE '%$text%'";
			$wheres2[] = "LOWER(c.description) LIKE '%$text%'";
			$where = '(' . implode( ') OR (', $wheres2 ) . ')';
			break;
		case 'all':
		case 'any':
		default:
			$words = explode( ' ', $text );
			$wheres = array();
			foreach ($words as $word) {
				$wheres2 = array();
			$wheres2[] = "LOWER(b.title) LIKE '%$text%'";						
			$wheres2[] = "LOWER(b.description) LIKE '%$text%'";
			$wheres2[] = "LOWER(c.cat_name) LIKE '%$text%'";
			$wheres2[] = "LOWER(c.description) LIKE '%$text%'";
				$wheres[] = implode( ' OR ', $wheres2 );
			}
			$where = '(' . implode( ($phrase == 'all' ? ') AND (' : ') OR ('), $wheres ) . ')';
			break;
	}

	switch ($ordering) {
		case 'newest':
		default:
			$order = 'start_date DESC';
			break;
		case 'oldest':
			$order = 'start_date ASC';
			break;
		case 'popular':
			$order = '';
			break;
		case 'alpha':
			$order = 'title';
			break;
		case 'category':
			$order = '';
			break;
	}

  $database->loadObject( $Item );
  $ItemName = !empty( $Item->name ) ? $Item->name : "Calendar Event";
  $Itemid = !empty( $Item->id ) ? $Item->id : "1";

  
  $query = "SELECT title as title,"
               . "\n    b.start_date AS created," 
               . "\n    b.description as text,"              
               . "\n    '$ItemName'  as section,"
               . "\n    CONCAT('index.php?option=com_jcalpro&Itemid=99999999&extmode=view&extid=',extid) as href,"
               . "\n    b.cat as category,"
               . "\n    c.level as level,"
               . "\n    '3' as browsernav"
                 . "\n FROM #__jcalpro_events AS b LEFT JOIN #__jcalpro_categories AS c ON c.cat_id=b.cat"
               . "\n WHERE $where"
		  . "\n AND approved=1";

  $database->setQuery( $query );
  $data = $database->loadObjectList();
  $row = array();

  foreach( $data as $item )
    {
      if( $levels[$item->level] <= $gids[$my->usertype] )
        {
          $item->created = strftime(_DATE_FORMAT_LC,strtotime($item->created));
          $item->text = html_entity_decode($item->text);
          $row[] = $item;
        }
    }
    
  return $row;
}

?>
