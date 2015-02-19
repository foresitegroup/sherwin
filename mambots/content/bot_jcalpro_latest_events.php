<?php
/*
**********************************************
JCal Pro Latest Events Plugin v1.5.0
Copyright (c) 2007 Anything-Digital.com
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

* Latest Events Plugin
*
* Revision date: 02/19/2007
*
* Plugin for displaying upcoming events in connection with the JCal Pro
* component. The component must be installed before this module will work. 
* There are some options for this plugin, which can be set in the 
* "Parameters" section of the plugin in Administration.
*
*
* Once installed and published, include the following text in a
* content item:
*
* {jcal_latest}X{/jcal_latest}
*
* Where "X" is the event category or categories you want displayed in the
* content item. Use "0" or blank for events from all categories, "1" for 
* events from category 1, "1,2" for events from category 1 and 2, etc. 

**********************************************
Get the latest version of JCal Pro at:
http://dev.anything-digital.com//
**********************************************
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

$_MAMBOTS->registerFunction( 'onPrepareContent', 'jcal_latest' );
function jcal_latest( $published, &$row2, &$params, $page=0 ) {
   if (!$published) {
    $row2->text = preg_replace( "#{jcal_latest}(.*?){/jcal_latest}#s", "" , $row2->text );
    return;
  }
  
// Variables
global $database, $mainframe, $option, $task, $mosConfig_lang, $mosConfig_absolute_path, $mosConfig_live_site, $my, $Itemid;
$query = "SELECT id FROM #__mambots WHERE element = 'bot_jcalpro_latest_events' AND folder = 'content'";
$database->setQuery( $query );
$id = $database->loadResult();
$mambot = new mosMambot( $database );
$mambot->load( $id );
$params =& new mosParameters( $mambot->params );
  
  if (preg_match_all("#{jcal_latest}(\d+){/jcal_latest}#s", $row2->text, $matches, PREG_PATTERN_ORDER) > 0) {
	foreach ($matches[0] as $match) {
	  $_category_ = preg_replace("/{.+?}/", "", $match);
      if( is_readable("modules/mod_jcalpro_latest.php") ) {
        ob_start();
        $params->set('categories',$_category_);
		include( "modules/mod_jcalpro_latest.php" );
		$html = ob_get_contents();
        ob_end_clean();
	  }
	  $row2->text = preg_replace( "#{jcal_latest}".$_category_."{/jcal_latest}#s", $html , $row2->text );
    }
  }
}

?>
