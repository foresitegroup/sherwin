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

function com_uninstall()
{
    global $database, $mosConfig_absolute_path;
    
    // Uninstall JoomSEF MetaBot
    @unlink($mosConfig_absolute_path.'/mambots/system/joomsef_metabot.php');
    @unlink($mosConfig_absolute_path.'/mambots/system/joomsef_metabot.xml');
    $database->setQuery("DELETE FROM #__mambots WHERE element = 'joomsef_metabot' AND folder='system'");
    $database->query();

    echo '<h3>ARTIO JoomSEF succesfully uninstalled.</h3>';
	if (substr(PHP_OS, 0, 3) == 'WIN') {
		$filename = "C:\Inetpub\wwwroot\web.config";
		echo '<p align="left">Please remember to remove '.$filename." and the Custom Error you created with the Internet Services Manager</p>";
	}
	else {
		$htaccess="
##
# @version $Id: htaccess.txt 2368 2006-02-14 17:40:02Z stingrey $
# @package Joomla
# @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
# @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
# Joomla! is Free Software
##

#####################################################
#  READ THIS COMPLETELY IF YOU CHOOSE TO USE THIS FILE
#
# The line just below this section: 'Options FollowSymLinks' may cause problems
# with some server configurations.  It is required for use of mod_rewrite, but may already
# be set by your server administrator in a way that dissallows changing it in
# your .htaccess file.  If using it causes your server to error out, comment it out (add # to
# beginning of line), reload your site in your browser and test your sef url's.  If they work,
# it has been set by your server administrator and you do not need it set here.
#
# Only use one of the two SEF sections that follow.  Lines that can be uncommented
# (and thus used) have only one #.  Lines with two #'s should not be uncommented
# In the section that you don't use, all lines should start with #
#
# For Standard SEF, use the standard SEF section.  You can comment out
# all of the RewriteCond lines and reduce your server's load if you
# don't have directories in your root named 'component' or 'content'
#
# If you are using a 3rd Party SEF or the Core SEF solution
# uncomment all of the lines in the '3rd Party or Core SEF' section
#
#####################################################

#####  SOLVING PROBLEMS WITH COMPONENT URL's that don't work #####
# SPECIAL NOTE FOR SMF USERS WHEN SMF IS INTEGRATED AND BRIDGED
# OR ANY SITUATION WHERE A COMPONENT's URL's AREN't WORKING
#
# In both the 'Standard SEF', and '3rd Party or Core SEF' sections the line:
# RewriteCond %{REQUEST_URI} ^(/component/option,com) [NC,OR] ##optional - see notes##
# May need to be uncommented.  If you are running your Joomla/Mambo from
# a subdirectory the name of the subdirectory will need to be inserted into this
# line.  For example, if your Joomla/Mambo is in a subdirectory called '/test/',
# change this:
# RewriteCond %{REQUEST_URI} ^(/component/option,com) [NC,OR] ##optional - see notes##
# to this:
# RewriteCond %{REQUEST_URI} ^(/test/component/option,com) [NC,OR] ##optional - see notes##
#
#####################################################

##  Can be commented out if causes errors, see notes above.
Options FollowSymLinks


#
#  mod_rewrite in use

RewriteEngine On

#  Uncomment following line if your webserver's URL
#  is not directly related to physical file paths.
#  Update Your Joomla/MamboDirectory (just / for root)

# RewriteBase /


########## Begin Standard SEF Section
## ALL (RewriteCond) lines in this section are only required if you actually
## have directories named 'content' or 'component' on your server
## If you do not have directories with these names, comment them out.
#
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
#RewriteCond %{REQUEST_URI} ^(/component/option,com) [NC,OR] 		##optional - see notes##
RewriteCond %{REQUEST_URI} (/|\.htm|\.php|\.html|/[^.]*)$  [NC]
RewriteRule ^(content/|component/) index.php
#
########## End Standard SEF Section


########## Begin 3rd Party or Core SEF Section
#
#RewriteCond %{REQUEST_URI} ^(/component/option,com) [NC,OR] 		##optional - see notes##
#RewriteCond %{REQUEST_URI} (/|\.htm|\.php|\.html|/[^.]*)$  [NC]
#RewriteCond %{REQUEST_FILENAME} !-f
#RewriteCond %{REQUEST_FILENAME} !-d
#RewriteRule (.*) index.php
#
########## End 3rd Party or Core SEF Section
	";
		$filename = $GLOBALS['mosConfig_absolute_path'] ."/.htaccess";
		echo '<p align="left">Please remember to edit '.$filename.' as shown below.</p>';
		echo '<p align="left">'.$htaccess.'</p>';
	}
}
?>