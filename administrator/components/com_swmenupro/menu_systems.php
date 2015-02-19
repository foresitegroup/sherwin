<?php
/**
* swmenupro v4.0
* http://swonline.biz
* Copyright 2006 Sean White
**/


define( "_VALID_MOS", 1 );

require_once( '../../includes/auth.php' );



$database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix );
$database->debug( $mosConfig_debug );

global $mosConfig_live_site;

?>

	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> SWmenuPro Menu Systems info</TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
</HEAD>

<BODY>
<h3>Trans Pop-Out Menu System</h3>
<b>Advanced Positioning:</b> Top menu items can be aligned vertically or horizontally.  Submenus can slide right, left, up or down.
 Whole menu can be positioned left, center, or right of where the module is published.
<br /><b>Auto Resizing:</b> Top menu and sub menu item widths and heights can be made to autoresize,
 making it an ideal choise for horizontal menu bars. Sub menus also automatically reposition if they would otherwise be off the page.
<br /><b>Sliding Sub Menus:</b> Sub menus slide out and in from parent menu elements.
 Sub menu indicator also shows sub menu items that contain child menus. 
<br /><B>Browser Friendly:</B> Top menu items will even display correctly in non-javascript enabled browsers.
<h3>myGosu Pop-Out Menu System</h3>
<b>Advanced Positioning:</b> Top menu items can be aligned vertically or horizontally.
Whole menu can be positioned left, center, or right of where the module is published.
<br /><b>Auto Resizing:</b> Top menu and sub menu item widths and heights can be made to autoresize, 
making it an ideal choise for horizontal menu bars.
<br /><b>Better Borders:</b> Can accurately specify borders for whole top menu and sub menus as well as item borders 
for top menu  and sub menu items
<br /><b>Browser Friendly:</b> Top menu items will even display correctly in non-javascript enabled browsers.
<h3>Tigra Pop-Out Menu System</h3>
The tigra popout menu system is a dynamic popout menu system with advanced positioning features. Can be  aligned vertically or horizontally.  Whole menu can be positioned Absolutely from the top left of the browser window, or Relatively to where the module is published
<br /><b>Browser Friendly:</b> Works fast in most modern javascript enabled browsers.
<h3>Click Menu System</h3>
Dynamic click menu is a vertically aligned menu system which will open a submenu underneath a top menu item automatically upon mouse clicking the top item.
<br /><b>Borders:</b> Can specify borders for normal and mouse over states.
<br /><b>Browser Friendly:</b> Works fast in most modern javascript enabled browsers and shows top menu items in non-javascript browsers
<h3>Tree Menu System</h3>
Dynamic tree menu system is a vertically alligned tree menu system. Parent(folder) items automatically open sub menus when clicked on.

<h3>Horizontal Tab Menu System</h3>
This is a complete non javascript CSS horizontal tab or button  menu system which should work well in most browsers.
This menu system will synchonise with any other mambo or myGosu with Active menu sytems on the same page. 

<h3>Dynamic Tab Menu System</h3>
A horizontal row of top menu items that automatically display a horizontal row of submenu items when they are moused over.

<center><a href="#" onClick="window.close()"><b>Close Window</b></a></center>
</BODY>
</HTML>

    <?php

?>
 
    
 
