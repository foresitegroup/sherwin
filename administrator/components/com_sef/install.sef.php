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

function com_install()
{
    global $database, $mosConfig_absolute_path;

    // Change SB menu icon.
	$database->setQuery("SELECT id FROM #__components WHERE admin_menu_link = 'option=com_sef'");
	$id = $database->loadResult();

	// Set new admin menu image.
	$database->setQuery("UPDATE #__components " .
                        "SET admin_menu_img  = '../administrator/components/com_sef/images/icon.png'" .
                        "WHERE id='$id'");
	$database->query();
	
	// Install JoomSEF MetaBot.
	if (!is_dir($mosConfig_absolute_path.'/mambots/system')) {
	    @mkdir($mosConfig_absolute_path.'/mambots/system', null, true);
	}
	rename($mosConfig_absolute_path.'/administrator/components/com_sef/bots/joomsef_metabot.php', $mosConfig_absolute_path.'/mambots/system/joomsef_metabot.php');
	rename($mosConfig_absolute_path.'/administrator/components/com_sef/bots/joomsef_metabot.xml.tmp', $mosConfig_absolute_path.'/mambots/system/joomsef_metabot.xml');
	@rmdir($mosConfig_absolute_path.'/administrator/components/com_sef/bots');
	$database->setQuery("INSERT INTO #__mambots
	                    (id, name, element, folder, access, ordering, published, iscore, client_id, checked_out, checked_out_time, params)
	                    VALUES ('', 'ARTIO JoomSEF MetaBot', 'joomsef_metabot', 'system', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', 'rewrite_keywords=1\nrewrite_description=1\nprefer_joomsef_title=1\nuse_sitename=2\nsitename_sep=&nbsp;-&nbsp;')");
	$database->query();
	
	// Install content elements if JoomFish is present
    if (file_exists($mosConfig_absolute_path . '/administrator/components/com_joomfish/config.joomfish.php')) { 
        @rename( "$mosConfig_absolute_path/administrator/components/com_sef/contentelements/sefext.titles.xml", "$mosConfig_absolute_path/administrator/components/com_joomfish/contentelements/sefext.titles.xml"); 
        @rename( "$mosConfig_absolute_path/administrator/components/com_sef/contentelements/sefext.texts.xml", "$mosConfig_absolute_path/administrator/components/com_joomfish/contentelements/sefext.texts.xml"); 
        @rename( "$mosConfig_absolute_path/administrator/components/com_sef/contentelements/translationJSextensionFilter.php", "$mosConfig_absolute_path/administrator/components/com_joomfish/contentelements/translationJSextensionFilter.php"); 
    }
    else {
        @unlink( "$mosConfig_absolute_path/administrator/components/com_sef/contentelements/sefext.titles.xml" );
        @unlink( "$mosConfig_absolute_path/administrator/components/com_sef/contentelements/sefext.texts.xml" );
        @unlink( "$mosConfig_absolute_path/administrator/components/com_sef/contentelements/translationJSextensionFilter.php" );
    }
	
    ob_start();

    echo '<div class="quote" style="text-align: center;">';
    echo '<h1>ARTIO JoomSEF installed succesfully!</h1>';
    echo '<h3>You must first edit the configuration, enable it and save before it will become active.</h3>';
    $readdocs = '<p class="message">Please scroll down and read the documentation.<br/>There is still extra configuration that you need to complete for ';
    if (!(strpos($_SERVER['SERVER_SOFTWARE'], 'Microsoft-IIS') === false)) {
        echo $readdocs.'IIS.</p>';
    }
    else {
        $htaccess = "
DirectoryIndex index.php
RewriteEngine On
RewriteBase /

RewriteCond %{REQUEST_URI} ^(/component/option,com) [NC,OR]
RewriteCond %{REQUEST_URI} (/|\.htm|\.php|\.html|/[^.]*)$  [NC]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule (.*) index.php

########## Begin - Rewrite rules to block out some common exploits
## If you experience problems on your site block out the operations listed below
## This attempts to block the most common type of exploit `attempts` to Joomla! 
#                              
# Block out any script trying to set a mosConfig value through the URL
RewriteCond %{QUERY_STRING} mosConfig_[a-zA-Z_]{1,21}(=|\%3D) [OR]
# Block out any script trying to base64_encode crap to send via URL
RewriteCond %{QUERY_STRING} base64_encode.*\(.*\) [OR]
# Block out any script that includes a <script> tag in URL
RewriteCond %{QUERY_STRING} (\<|%3C).*script.*(\>|%3E) [NC,OR]
# Block out any script trying to set a PHP GLOBALS variable via URL
RewriteCond %{QUERY_STRING} GLOBALS(=|\[|\%[0-9A-Z]{0,2}) [OR]
# Block out any script trying to modify a _REQUEST variable via URL
RewriteCond %{QUERY_STRING} _REQUEST(=|\[|\%[0-9A-Z]{0,2})
# Send all blocked request to homepage with 403 Forbidden error!
RewriteRule ^(.*)$ index.php [F,L]
# 
########## End - Rewrite rules to block out some common exploits
	";

        //if (substr(PHP_OS, 0, 3) == 'WIN') {
        //	echo '<p class="error">Found apache on windows, .htaccess is an illegal filename for this system.<br/>You must complete the rest of the configuration manually.</p>';
        //	echo $readdocs."the apache .htaccess file.</p>";
        //}
        //else{
        echo '<p style="text-align: center;">Checking for .htaccess in Joomla! root...<br />';
        if(!file_exists($GLOBALS['mosConfig_absolute_path'].DIRECTORY_SEPARATOR.'.htaccess')){
            echo 'not found.</p>';
            $file = fopen($GLOBALS['mosConfig_absolute_path'].DIRECTORY_SEPARATOR.'.htaccess', 'w+');
            if(!$file){
                echo '<p style="text-align: center;" class="error">Unable to create .htaccess file in your Joomla! root. Please create this file yourself and add the following lines:<br/><pre>'.htmlspecialchars($htaccess).'</pre>';
            }
            else{
                fwrite($file, $htaccess);
                fclose($file);
                echo "Successfully created .htaccess file in your Joomla! root with the following content:<br/><pre>".htmlspecialchars($htaccess)."</pre>";
            }
            echo "Please check that the RewriteBase directive path is set correctly and matches your configuration.";
        }
        else {
            echo '<span class="error">Found existing .htaccess in Joomla! root.</span></p>';
            echo $readdocs.'the apache .htaccess file</p>';
        }
        echo '</div>';
    }

    include($GLOBALS['mosConfig_absolute_path'].'/administrator/components/com_sef/readme.inc.html');

    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
?>
