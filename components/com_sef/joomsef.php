<?php
/**
 * SEF module for Joomla!
 *
 * @author      $Author: michal $
 * @copyright   ARTIO s.r.o., http://www.artio.cz
 * @package     JoomSEF
 * @version     $Name$, ($Revision: 4994 $, $Date: 2005-11-03 20:50:05 +0100 (??t, 03 XI 2005) $)
 */

// security check to ensure this file is being included by a parent file
if (!defined('_VALID_MOS')) die('Direct Access to this location is not allowed.');

global $database, $URI, $my, $option, $index, $base;

// debugging on/off
$debug = (bool) @$_REQUEST['debugSEF'];

// hack in mos database as required
if (!is_object(@$database)) {
    $database = new database($GLOBALS['mosConfig_host'], $GLOBALS['mosConfig_user'], $GLOBALS['mosConfig_password'], $GLOBALS['mosConfig_db'], $GLOBALS['mosConfig_dbprefix']);
}

$REQUEST = $SRU = $_SERVER['REQUEST_URI'];
if ($debug) {
    $GLOBALS['JOOMSEF_DEBUG']['INDEX'] = $index;
    $GLOBALS['JOOMSEF_DEBUG']['BASE'] = $base;
    $GLOBALS['JOOMSEF_DEBUG']['QUERY_STRING'] = $_SERVER['QUERY_STRING'];
    $GLOBALS['JOOMSEF_DEBUG']['REQUEST'] = $REQUEST;
    $GLOBALS['JOOMSEF_DEBUG']['URI'] = $URI;
}

// Redirection check for nonSEF URLs
if ($sefConfig->nonSefRedirect &&                                   // nonSefRedirect is ON
(strpos($_SERVER['REQUEST_URI'], $base.$index.'?') !== false) &&    // request uri has ?
($index != 'index2.php') &&                                         // site isn't index2.php
(count($_POST) == 0))                                              // POST is empty
{
    $lnk = sefRelToAbs(str_replace($base, '', $_SERVER['REQUEST_URI']));

    if( strpos($lnk, 'index.php?') === false ) {
        // Seems the URL is SEF, let's redirect
        $f = $l = '';
        if (!headers_sent($f, $l)) {
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$lnk);
            header("Connection: close");
            exit();
        } else headers_sent_error($f, $l, $GLOBALS['mosConfig_live_site'].$_SERVER['QUERY_STRING'], @$option);
    }
}

// check the URL nesting
switch ($URI->path) {
    case $base:
    case $base.$index: {
        $option = isset($_GET['option']) ? $_GET['option'] : isset($_REQUEST['option']) ? $_REQUEST['option'] : null;

        if (is_null($option)) {
            $GLOBALS['JOOMSEF_DEBUG']['REDIRECT_INDEX'] = 0;

            // fix those funky polls by ensuring we have an Itemid for the homepage
            $query = "SELECT `id`,`link` FROM #__menu WHERE `menutype` = 'mainmenu' AND `published` > 0 AND `link` LIKE '%com_frontpage%' LIMIT 1";
            $database->setQuery($query);

            if (($row = $database->loadRow())) {
                $GLOBALS['JOOMSEF_DEBUG']['REDIRECT_INDEX'] = 1;
                $_GET['Itemid'] = $_REQUEST['Itemid'] = $Itemid = $row[0];
                $_SERVER['QUERY_STRING'] = $QUERY_STRING  = str_replace('index.php?', '', $row[1])."&Itemid=$Itemid";
                $REQUEST_URI = $GLOBALS['mosConfig_live_site'].'/index.php?'.$QUERY_STRING;
                $_SERVER['REQUEST_URI'] = $REQUEST_URI;

                $matches = array();
                if (preg_match("/option=([a-zA-Z_0-9]+)/", $QUERY_STRING, $matches)) {
                    $_GET['option'] = $_REQUEST['option'] = $option = $matches[1];
                }
                if (preg_match("/id=([0-9]+)/", $QUERY_STRING, $matches)) {
                    $_GET['id'] = $_REQUEST['id'] = $id = $matches[1];
                }
                if (preg_match("/task=([a-zA-Z_0-9]+)/", $QUERY_STRING, $matches)) {
                    $_GET['task'] = $_REQUEST['task'] = $task = $matches[1];
                }
                unset($matches);

                $GLOBALS['JOOMSEF_DEBUG']['ROW'] = $row;
                $GLOBALS['JOOMSEF_DEBUG']['QUERY_STRING'] = $QUERY_STRING;
                $GLOBALS['JOOMSEF_DEBUG']['REQUEST_URI']  = $REQUEST_URI;

                $f = $l = '';
                if (!headers_sent($f, $l)) {
                    header('HTTP/1.0 200 OK');
                }
                else headers_sent_error($f, $l, $GLOBALS['mosConfig_live_site'].$_SERVER['QUERY_STRING'], @$option);
            }

            // if MetaBot is installed ...
            $database->setQuery("SELECT id FROM #__mambots WHERE element = 'joomsef_metabot' AND folder = 'system' AND published = 1");
            if ($database->loadResult()) {
                // ... and frontpage has meta tags
                $database->setQuery("SELECT * FROM #__redirection WHERE oldurl = '' OR oldurl = '$index' LIMIT 1");
                if (!is_null($database->loadObject($sefRow))) {
                    if (@$sefRow->metatitle)  $GLOBALS['sefMetaTags']['title']     = $sefRow->metatitle;
                    if (@$sefRow->metadesc)   $GLOBALS['sefMetaTags']['metadesc']  = $sefRow->metadesc;
                    if (@$sefRow->metakey)    $GLOBALS['sefMetaTags']['metakey']   = $sefRow->metakey;
                    if (@$sefRow->metalang)   $GLOBALS['sefMetaTags']['lang']      = $sefRow->metalang;
                    if (@$sefRow->metarobots) $GLOBALS['sefMetaTags']['robots']    = $sefRow->metarobots;
                    if (@$sefRow->metagoogle) $GLOBALS['sefMetaTags']['googlebot'] = $sefRow->metagoogle;
                }
            }
        }
        break;
    }
    case '': {
        die(_COM_SEF_STRANGE.' URI->path='.$URI->path.":<br />".basename(__FILE__)."-".__LINE__);
    }
    default: {
        // lets process the URL

        // strip out the base
        $path = preg_replace('/^'.preg_quote($base, '/').'/', '', $URI->path);
        // path should never start with /
        $path = preg_replace('/^'.preg_quote('/', '/').'/', '', $path);
        // split path into array
        $path_array = explode('/', $path);

        // find appropriate extension handler
        $ext = getExt($path_array);

        $sef_ext_class = 'sef_'.$ext['name'];
        if ($sef_ext_class != 'sef_joomsef') {
            // do our space conversion
            // then find our suffix (.html) and strip it off,
            // SEF Advance extensions don't want the suffix
            // and some them require the spaces
            foreach ($path_array as $i => $pathdata) {
                //$path_array[$i] = $pathdata = str_replace($sefConfig->replacement, ' ', $pathdata);
                if ($sefConfig->suffix && strpos($pathdata, $sefConfig->suffix) !== false) {
                    $path_array[$i] = str_replace($sefConfig->suffix, '', $pathdata);
                }
            }
        }

        if ($debug) {
            $GLOBALS['JOOMSEF_DEBUG']['EXT'] = $ext;
            $GLOBALS['JOOMSEF_DEBUG']['SEF_EXT'] = $sef_ext_class;
            $GLOBALS['JOOMSEF_DEBUG']['PATH'] = $path;
        }

        // set php show_error settings to prevent notices breaking headers
        $displayErrors = ini_get('display_errors');
        ini_set('display_errors', 0);

        // instantiate class that will take care about URL conversion
        if($ext['path'] != $GLOBALS['mosConfig_absolute_path'].'/components/com_sef/sef_ext.php') {
            require_once($ext['path']);
        }

        // also instantiate our own - always
        includeSef(true);

        eval("\$sef_ext = new $sef_ext_class;");
        $pos = 0;

        if (isset($_REQUEST['option'])) {
            $pos = array_search($_REQUEST['option'], $path_array);
            if ($pos === false) $pos = 0;
        }

        if ($sef_ext_class != 'sef_content'
        && $sef_ext_class != 'sef_component'
        && $pos == 0) {
            array_unshift($path_array, 'option');
        }

        if ($debug) {
            $GLOBALS['JOOMSEF_DEBUG']['POS'] = $pos;
            $GLOBALS['JOOMSEF_DEBUG']['PATH_ARRAY'] = $path_array;
        }

        // Revert the SEF url to non-SEF
        $_SEF_SPACE   = $sefConfig->replacement;
        $QUERY_STRING = $sef_ext->revert($path_array, $pos);

        ini_set('display_errors', $displayErrors);

        if ($debug) {
            $GLOBALS['JOOMSEF_DEBUG']['REVERTED'] = $QUERY_STRING;
        }

        // append the original query string because some components
        // (like SMF Bridge and SOBI2) use it
        if( !empty($URI->querystring) ) {
            foreach($URI->querystring as $name => $value) {
                if (empty($QUERY_STRING)) {
                    $QUERY_STRING = $name.'='.$value;
                }
                else {
                    $QUERY_STRING .= '&'.$name.'='.$value;
                }
            }

            // Let's save the variables from query string, we'll use them later
            // in sefRelToAbs as nonSefVars (because JoomFish's language
            // selection module creates duplicates without this)
            $GLOBALS['JOOMSEF_NONSEFVARS'] = $URI->querystring;
        }

        if ($debug) var_dump($GLOBALS['JOOMSEF_DEBUG']);

        if (is_valid($QUERY_STRING)) {
            // Set anchor without extras.
            $anchor = ($URI->anchor) ? '#'.$URI->anchor : '';

            $_SERVER['QUERY_STRING'] = $QUERY_STRING = str_replace('&?', '&', $QUERY_STRING./*(isset($QS) ? $QS : '').*/$anchor);
            $REQUEST_URI = $GLOBALS['mosConfig_live_site'].'/index.php?'.$QUERY_STRING;
            $_SERVER['REQUEST_URI'] = $REQUEST_URI;

            // Make sure to set option variable.
            $matches = array();
            if (preg_match("/option=([a-zA-Z_0-9]+)/", $QUERY_STRING, $matches)) {
                $_GET['option'] = $_REQUEST['option'] = $option = $matches[1];
            }
            unset($matches);

            // Add variables to GLOBALS only if RG_EMULATION is set to 1
            if( RG_EMULATION == 1 ) {
                while (list($key, $value) = each($_REQUEST)) {

                    // Since this is very dangerous operation, let's set only those variables
                    // that doesn't begin with mosConfig_
                    if( (substr($key, 0, 10) != 'mosConfig_') ) {
                        $GLOBALS[$key] = $value;
                    }
                }
            }

            $f = $l = '';
            if (!headers_sent($f, $l)) {
                header('HTTP/1.0 200 OK');
            }
            else headers_sent_error($f, $l, $GLOBALS['mosConfig_live_site']."/index.php?".$_SERVER['QUERY_STRING'], @$option);
        }
        // bad URL, so check to see if we've seen it before
        else {
            // Maybe we need to redirect to index2.php
            if( substr($QUERY_STRING, 0, 10) == 'index2.php' ) {
                mosRedirect($mosConfig_live_site.'/'.$QUERY_STRING);
                exit();
            }

            // 404 recording (only if enabled)
            if ($sefConfig->record404) {
                $query = "SELECT * FROM #__redirection WHERE oldurl = '".$path."'";
                $database->setQuery($query);
                $results = $database->loadObjectList();

                if ($results) {
                    // we have it, so update counter
                    $database->setQuery("UPDATE #__redirection SET cpt=(cpt+1) WHERE oldurl = '".$path."'");
                    $database->query();
                }
                else {
                    // record the bad URL
                    $query = 'INSERT INTO `#__redirection` (`cpt`, `oldurl`, `newurl`, `dateadd`) '
                    . ' VALUES ( \'1\', \''.$path.'\', \'\', CURDATE() );'
                    . ' ';
                    $database->setQuery($query);
                    $database->query();
                }
            }

            // redirect to the error page
            // you MUST create a static content page with the title 404 for this to work properly
            $mosmsg = 'FILE NOT FOUND: '.$path;
            $_GET['mosmsg'] = $_REQUEST['mosmsg'] = $mosmsg;
            $option = 'com_content';
            $task = 'view';

            if ($sefConfig->page404 == '0') {
                $sql='SELECT id  FROM #__content WHERE `title`="404"';
                $database->setQuery($sql);

                if (($id = $database->loadResult())) {
                    $Itemid = null; /*Beat: was wrong: =$id : the $Itemid represents the menuId, and $id the contentId ! */
                    $_SERVER['QUERY_STRING'] = "option=com_content&task=view&id=$id&Itemid=$id&mosmsg=$mosmsg";
                    $_SERVER['REQUEST_URI'] = $GLOBALS['mosConfig_live_site']."/index.php?".$_SERVER['QUERY_STRING'];
                    $_GET['option'] = $_REQUEST['option'] = $option;
                    $_GET['task'] = $_REQUEST['task'] = $task;

                    /*Beat: was wrong: $_GET['Itemid'] = $_REQUEST['Itemid'] = $Itemid; */
                    unset($_GET['Itemid']);
                    unset($_REQUEST['Itemid']);
                    $_GET['id'] = $_REQUEST['id'] = $id;
                }
                else {
                    die(_COM_SEF_DEF_404_MSG.$mosmsg."<br>URI:".$_SERVER['REQUEST_URI']);
                }
            }
            elseif ($sefConfig->page404 == '9999999') {
                //redirect to frontpage
                $front404 = 1;
            }
            else{
                $id = $Itemid  = $sefConfig->page404;
                $_SERVER['QUERY_STRING'] = "option=com_content&task=view&id=$id&Itemid=$id&mosmsg=$mosmsg";
                $_SERVER['REQUEST_URI'] = $GLOBALS['mosConfig_live_site'].'/index.php?'.$_SERVER['QUERY_STRING'];
                $_GET['option'] = $_REQUEST['option'] = $option;
                $_GET['task'] = $_REQUEST['task'] = $task;
                $_GET['Itemid'] = $_REQUEST['Itemid'] = $Itemid;
                $_GET['id'] = $_REQUEST['id'] = $id;
            }

            $f = $l = '';
            if (!headers_sent($f, $l)) {
                header('HTTP/1.0 404 NOT FOUND');
                if (isset($front404) && $front404) mosRedirect( $GLOBALS['mosConfig_live_site'] );
            }
            else headers_sent_error($f, $l, sefRelToAbs($GLOBALS['mosConfig_live_site'].'/index.php?'.$_SERVER['QUERY_STRING']), @$option);
        } // end bad url
    } //
}

if ($debug) {
    $GLOBALS['JOOMSEF_DEBUG']['SERVER_QUERY_STRING'] = $_SERVER['QUERY_STRING'];
    $GLOBALS['JOOMSEF_DEBUG']['SERVER_REQUEST_URI']  = $_SERVER['REQUEST_URI'];
}

/**
 * Check if own extension exists for a component.
 * This can be either db or nodb version.
 *
 * @param  string $component  Component name
 * @param  bool   $noDB       Testing for non-db version?
 * @return object
 */
function existOwnExt($option, $noDB = false)
{
    if (!$noDB) {
        return is_readable($GLOBALS['mosConfig_absolute_path'].'/components/com_sef/sef_ext/'.$option.'.php');
    }
    else {
        $path = $GLOBALS['mosConfig_absolute_path'].'/components/com_sef/sef_ext_nodb/'.$option.'.php';
        return is_readable($path) ? $path : false;
    }
}

/**
 * Does the component in question has own (3rd party) sef extension?
 * Returns DB select result if found or null.
 *
 * @param  string $component  Component name
 * @return object
 */
function exist3rdExt($option)
{
    $path = $GLOBALS['mosConfig_absolute_path']."/components/$option/sef_ext.php";
    return is_readable($path) ? $path : false;
}

/**
 * Tries to find the component from first URL part
 *
 * @param string $component
 * @return string
 */
function testComponent($component)
{
    global $database, $sefConfig;

    $debug = 0;

    // Try to find the component in user defined extension titles
    // Load the list of titles (original language)
    $database->setQuery("SELECT file, title FROM #__sefexts WHERE title != ''");
    $rows = $database->loadObjectList('title');

    // Load the list of titles (JoomFish translations)
    if( !is_null($rows) && class_exists('JoomFish') ) {
        $database->setQuery("SELECT l.value AS title, s.file AS file FROM #__jf_content AS l INNER JOIN #__sefexts AS s ON s.id = l.reference_id WHERE l.reference_table = 'sefexts' AND l.reference_field = 'title' AND l.published > 0");
        $rows2 = $database->loadObjectList('title');

        if( !is_null($rows2) )  $rows = array_merge($rows, $rows2);
    }

    // Remove special characters from titles
    if( !is_null($rows) ) {
        foreach($rows as $k => $v) {
            $k2 = titleToLocation($k);
            if( !isset($rows[$k2]) )    $rows[$k2] = $v;
        }
    }

    // If component is found, return it
    if( isset($rows[$component]) ) {
        $result = new stdClass();
        $result->name = str_replace('.xml', '', $rows[$component]->file);

        $database->setQuery("SELECT id FROM #__menu WHERE link LIKE 'index.php?option={$result->name}%' AND published > 0");
        $result->id = $database->loadResult();

        return $result;
    }

    // Component not found in custom titles, let's search through the menu
    // Load the list of menu items
    $database->setQuery("SELECT name, link, id FROM #__menu WHERE published > 0 AND link LIKE 'index.php?option=com_%'");
    $rows = $database->loadObjectList('name');

    // Load the list of translated menu items, if JoomFish is present
    if( !is_null($rows) && class_exists('JoomFish') ) {
        $database->setQuery("SELECT l.value AS name, m.link AS link, m.id as id FROM #__jf_content AS l INNER JOIN #__menu AS m ON m.id = l.reference_id WHERE l.reference_table = 'menu' AND l.reference_field = 'name' AND l.published > 0 AND m.published > 0 AND m.link LIKE 'index.php?option=com_%'");
        $rows2 = $database->loadObjectList('name');

        if( !is_null($rows2) )  $rows = array_merge($rows, $rows2);
    }

    // Remove special characters from titles
    if( !is_null($rows) ) {
        foreach($rows as $k => $v) {
            $k2 = titleToLocation($k);
            if( !isset($rows[$k2]) )    $rows[$k2] = $v;
        }
    }

    // If component is found, return it
    if( isset($rows[$component]) ) {
        $name = str_replace('index.php?option=', '', $rows[$component]->link);
        $pos = strpos($name, '&');
        if( $pos > 0 )  $name = substr($name, 0, $pos);
        $rows[$component]->name = $name;

        return $rows[$component];
    }

    // Component not found
    $componentObj = new stdClass();
    $componentObj->name = $component;

    return $componentObj;
}

/**
 * Determine what class use to convert URLs.
 *
 * @param  array $urlArray
 * @return string
 */
function getExt($urlArray)
{
    global $database, $sefConfig;

    $ext = array();
    $ext['path'] = $GLOBALS['mosConfig_absolute_path'].'/components/com_sef/sef_ext.php';

    // test if component with given name can be found
    $component = testComponent($urlArray[0]);

    // if found our own plug-in, use it
    // 1st test for nodb version
    if (($path = existOwnExt($component->name, true))) {
        $_GET['option'] = $_REQUEST['option'] = $option = $component->name;
        $_GET['Itemid'] = $_REQUEST['Itemid'] = $Itemid = $component->id;
        $ext['path'] = $path;
    }
    // then test db version
    elseif (existOwnExt($component->name, false)) {
        $option = 'com_joomsef';
    }
    // otherwise try to find 3rd party sef_ext
    elseif (($path = exist3rdExt($component->name))) {
        $_GET['option'] = $_REQUEST['option'] = $option = $component->name;
        $_GET['Itemid'] = $_REQUEST['Itemid'] = $Itemid = $component->id;
        $ext['path'] = $path;
    }
    // built-in component ext
    elseif ((strpos($urlArray[0], 'com_') !== false) or ($urlArray[0] == 'component')) {
        $_GET['option'] = $_REQUEST['option'] = $option = 'com_component';
    }
    // built-in content ext
    elseif($urlArray[0] == 'content') {
        $_GET['option'] = $_REQUEST['option'] = $option = 'com_content';
    }
    // otherwise use default handler
    else $option = 'com_joomsef';

    $ext['name'] = str_replace('com_', '', $option);
    return $ext;
}

/**
 * Validates the query string
 *
 * @param  string $string
 * @return bool
 */
function is_valid($string)
{
    global $base, $index;

    // David: removed || $string == '' in revision 281, was causing problems with 404 page
    if (strcmp($string, $index) == 0 || strcmp($string, $base.$index) == 0) {
        $state = true;
    }
    else {
        $state = false;
        includeSef(true);
        $sef_ext = new sef_joomsef();
        $option = (isset($_GET['option'])) ? $_GET['option'] : (isset($_REQUEST['option'])) ? $_REQUEST['option'] : null;

        $vars = array();
        if (is_null($option)) {
            parse_str($string, $vars);
            if (isset($vars['option'])) {
                $option = $vars['option'];
            }
        }

        switch ($option) {
            case is_null($option): break;
            case 'login':		/*Beat: makes this also compatible with CommunityBuilder login module*/
            case 'logout': {
                $state = true;
                break;
            }
            default: {
                if (is_valid_component($option)){
                    if ($option != 'com_content' | $option != 'content') {
                        $state = true;
                    }
                    else {
                        $title = $sef_ext->getContentTitles($_REQUEST['task'], $_REQUEST['id']);
                        //die(count($title));
                        if (count($title) > 0) $state = true;
                    }
                }
            }
        }
    }

    return $state;
}

/**
 * Check whether object is a valid component.
 *
 * @param  object $this
 * @return bool
 */
function is_valid_component($this)
{
    $state = false;
    $path = $GLOBALS['mosConfig_absolute_path'] .'/components/';

    if (is_dir($path) && $contents = opendir($path)) {
        while (($node = readdir($contents)) !== false) {
            if ($node != '.' && $node != '..'
            && is_dir($path.'/'.$node) && $this == $node) {
                $state = true;
                break;
            }
        }
    }
    return $state;
}

/**
 * Rewrite relative URL to absolute.
 *
 * @param  string $string
 * @return string
 */
function sefRelToAbs($string)
{
    global $database, $sefConfig, $_SEF_SPACE, $mosConfig_db, $mainframe, $mosConfig_lang, $_MAMBOTS, $jsCache;

    // Trigger onSefStart patches
    $_MAMBOTS->trigger('onSefStart');

    $debug = 0;
    $prevLang = ''; // For correct title translations

    // Check if this is site root.
    if ($string == $GLOBALS['mosConfig_live_site']
    || $string == $GLOBALS['mosConfig_live_site'].'/'
    || $string == $GLOBALS['mosConfig_live_site'].'/index.php') {
        // Trigger onSefEnd patches
        $_MAMBOTS->trigger('onSefEnd');
        return $GLOBALS['mosConfig_live_site'];
    }

    $newstring = str_replace($GLOBALS['mosConfig_live_site'].'/', '', $string);

    // If this appears to be SEO-able URL, work with it.
    if (((!strcasecmp(substr($newstring, 0, 9), 'index.php')) || (!strcasecmp(substr($newstring, 0, 10), 'index2.php')))
    && !preg_match('~^(([^:/?#]+):)~i', $newstring)
    && !preg_match('~this\.options\[selectedIndex\]\.value~i', $newstring))
    //&& !eregi('^(([^:/?#]+):)', $newstring)
    //&& !eregi('this\.options\[selectedIndex\]\.value', $newstring))
    {
        // Replace & character variations.
        $string = str_replace(array('&amp;', '&#38;'), array('&', '&'), $newstring);

        // Remove bad characters at the end (just for sure)
        $string = trim($string, '?&');

        if (class_exists('JoomFish')) {
            // Add lang if configured to and it is missing
            if ($sefConfig->alwaysUseLang && strpos($string, 'lang=') === false) {
                // Handle the anchor
                $matches = array();
                if( preg_match('/(#.*)$/', $string, $matches) ) {
                    $anchor = $matches[1];
                    $string = str_replace($anchor, '', $string);
                }
                unset($matches);

                // Add the lang variable
                $string .= ((strpos($string, '?') !== false) ? '&' : '?');
                $string .= 'lang='.SEFTools::getLangCode();

                if( isset($anchor) ) {
                    $string .= $anchor;
                    unset($anchor);
                }
            }

            // Handle URLs with empty lang variable
            if( eregi('lang=(&|$)', $string) ) {
                if($sefConfig->alwaysUseLang) {
                    $string = str_replace('lang=', 'lang='.SEFTools::getLangCode(), $string);
                } else {
                    $string = SEFTools::RemoveVariable($string, 'lang');
                }
            }

            // Get the URL's language and set it as mosConfig_lang (for correct translation)
            $matches = array();
            $iso = '';
            if( preg_match('/lang=([^&]*)/', $string, $matches) ) {
                $iso = $matches[1];
                $urlLang = SEFTools::getLangName($iso);
                if( $mosConfig_lang != $urlLang ) {
                    $prevLang = $mosConfig_lang;
                    $mosConfig_lang = $urlLang;
                }
            }

            // Set the live_site according to language
            if ($sefConfig->langPlacement == _COM_SEF_LANG_DOMAIN) {
                if( $iso != '' ) {
                    $langId = SEFTools::getLangId($iso);
                    if( isset($sefConfig->langDomain[$langId]) )
                    $langOverride = $sefConfig->langDomain[$langId];
                }
            }
        }

        $URI = new Net_URL($string);

        if (count($URI->querystring) > 0) {
            // Import new vars here.
            $option = null;
            $task = null;
            $sid = null;
            extract($URI->querystring, EXTR_REFS);
        }
        else {
            // Trigger onSefEnd patches
            $_MAMBOTS->trigger('onSefEnd');
            restoreLang($prevLang);
            return $URI->url;
        }

        // is there a named anchor attached to $string? If so, strip it off, we'll put it back later.
        if ($URI->anchor) $string = str_replace('#'.$URI->anchor, '', $string);

        if ($debug) {
            $GLOBALS['JOOMSEF_DEBUG']['sefRelToAbs'][$string]= $URI;
            $debugString = $string;
        }

        //if (!((isset($task) ? ((@$task == "new") | (@$task == "edit")) : false)) && isset($option)   ) {
        if (isset($option) && @$task != 'edit') {
            /*Beat: sometimes task is not set, e.g. when $string = "index.php?option=com_frontpage&Itemid=1" */
            switch ($option) {
                // Skipped extensions.
                case (in_array($option, $sefConfig->skip)): {
                    $sefstring = str_replace('&', '&amp;', $string);
                    //$skipThis = true;
                    break;
                }
                // Non-cached extensions.
                case (in_array($option, $sefConfig->nocache)): {
                    $sefstring = 'component/';
                    foreach($URI->querystring as $key => $value) {
                        $sefstring .= "$key,$value/";
                    }
                    $sefstring = str_replace('option/', '', $sefstring);
                    break;
                }
                // Default handler.
                default: {
                    // If component has its own sef_ext plug-in included.
                    // However, prefer own plugin if exists (added by Michal, 28.11.2006)
                    if (file_exists($GLOBALS['mosConfig_absolute_path']."/components/$option/sef_ext.php")
                    && !file_exists($GLOBALS['mosConfig_absolute_path']."/components/com_sef/sef_ext/$option.php")) {
                        // Load the plug-in file.
                        require_once($GLOBALS['mosConfig_absolute_path']."/components/$option/sef_ext.php");
                        // Load our sef also to provide general functions.
                        includeSef(true);

                        $_SEF_SPACE = $sefConfig->replacement;
                        //$longurl = ($sefConfig->useAlias == 1);
                        //$lowerCase = $sefConfig->lowerCase;
                        $className = str_replace('com_', 'sef_', $option);
                        eval("\$sef_ext = new $className;");
                        $title[] = getMenuTitle($option, null);
                        $string = str_replace('&', '&amp;', $string);
                        $sefstring = $sef_ext->create($string);

                        if ($sefstring == $string) {
                            // Trigger onSefEnd patches
                            $_MAMBOTS->trigger('onSefEnd');
                            restoreLang($prevLang);
                            return $string;
                        }
                        else {
                            $sefstring = str_replace(' ', $_SEF_SPACE, $sefstring);
                            $sefstring = str_replace(' ', '', titleToLocation($title[0]).'/'.$sefstring.(($sefstring != '') ? $sefConfig->suffix : ''));
                            $sefstring = str_replace('/'.$sefConfig->suffix, $sefConfig->suffix, $sefstring);
                        }
                    }
                    // Component has no own sef extension.
                    else {
                        includeSef(true);

                        // Try to load the extension class
                        if (file_exists($GLOBALS['mosConfig_absolute_path'].'/components/com_sef/sef_ext/'.$option.'.php')) {
                            require_once($GLOBALS['mosConfig_absolute_path'].'/components/com_sef/sef_ext/'.$option.'.php');
                            $class = 'sefext_'.$option;
                        } else {
                            $class = 'sef_joomsef';
                        }
                        $sef_ext = new $class();

                        // Let the extension change the url and options
                        $string = $sef_ext->beforeCreate($string, $URI->querystring);

                        // Ensure that the session IDs are removed
                        // If set to
                        if (isset($sid) && !$sefConfig->dontRemoveSid) $string = SEFTools::RemoveVariable($string, 'sid');
                        // Ensure that the mosmsg are removed.
                        if (isset($mosmsg)) $string = SEFTools::RemoveVariable($string, 'mosmsg');

                        // Override Itemid if set to
                        $params = SEFTools::getExtParams($option);
                        $override = $params->get('itemid', '0');
                        $overrideId = $params->get('overrideId', '');
                        if( ($override != '0') && ($overrideId != '') ) {
                            if( strpos($string, 'Itemid=') ) {
                                $string = eregi_replace('Itemid=[^&]*', 'Itemid='.$overrideId, $string);
                            } else {
                                $string .= (strpos($string, '?') ? '&' : '?').'Itemid='.$overrideId;
                            }
                        }

                        // Clean Itemid if desired.
                        // David: only if overriding is disabled
                        if (isset($sefConfig->excludeSource) && $sefConfig->excludeSource && ($override == '0') && isset($Itemid)) {
                            $string = SEFTools::RemoveVariable($string, 'Itemid');
                        }

                        // Clean remaining characters.
                        $string = trim($string, '&?');
                        $string = str_replace('&&', '&', $string);

                        $anchor = (isset($URI->anchor)) ? '#'.$URI->anchor : '';
                        $URI = new Net_URL($string.$anchor);
                        extract($URI->querystring, EXTR_REFS);

                        // Let's reorder the variables in non-sef url first so they
                        // are in alphabetical order (some components create for
                        // the same page urls with different variables order)
                        // -- except option which should be first (changed in 1.3.4)
                        $string = SEFTools::sortURLvars($string);

                        // Try to get url from cache
                        if( $sefConfig->useCache ) {
                            $sefstring = $jsCache->GetSefUrl($string);
                        }
                        if( !$sefConfig->useCache || !$sefstring ) {
                            // Check if the url is already saved in the database.
                            if (!($sefstring = $sef_ext->getSefUrlFromDatabase($string))) {
                                if( $sefConfig->disableNewSEF ) {
                                    $sefstring = $string;
                                } else {
                                    // Rewrite the URL now.
                                    $sefstring = $sef_ext->create($string, $URI->querystring);
                                }
                            }
                        }
                        // Reconnect the sid to the url.
                        if (isset($sid) && !$sefConfig->dontRemoveSid) $sefstring .= (strpos($sefstring, '?') !== false ? '&' : '?').'sid='.$sid;
                        // Reconnect mosmsg to the url.
                        if (isset($mosmsg)) {
                            // Check if the mosmsg isn't already encoded properly
                            if( urlencode($mosmsg) == urlencode(urldecode($mosmsg)) ) {
                                $mosmsg = urlencode($mosmsg);
                            }
                            $sefstring .= (strpos($sefstring, '?') !== false ? '&' : '?').'mosmsg='.$mosmsg;
                        }
                        // Reconnect ItemID to the url.
                        // David: only if extension doesn't set its own Itemid through overrideId parameter
                        if (isset($sefConfig->excludeSource) && $sefConfig->excludeSource && $sefConfig->reappendSource && ($override == '0') && isset($Itemid)) {
                            $sefstring .= (strpos($sefstring, '?') !== false ? '&amp;' : '?').'Itemid='.urlencode($Itemid);
                            //$URI->anchor .= (($URI->anchor) ? '-' : '').urlencode('ii'.$Itemid);
                        }

                        // Let the extension change the resulting SEF url
                        $sefstring = $sef_ext->afterCreate($sefstring);
                    }
                }
            }
            if ($debug){ $GLOBALS['JOOMSEF_DEBUG']['sefRelToAbs']['SEF_EXT'][$debugString] = $sef_ext;}
            if (isset($sef_ext)) unset($sef_ext);

            $string = (isset($langOverride) ? $langOverride : $GLOBALS['mosConfig_live_site']).'/'.$sefstring.(($URI->anchor)? '#'.$URI->anchor : '');
        }
        //$ret = (!isset($skipThis) || !$skipThis) ? ($sefConfig->lowerCase ? strtolower($string) : $string) : $string;
        $ret = $string;
        $ret = str_replace('itemid', 'Itemid', $ret);
    }

    if (!isset($ret)) $ret = $string;
    if ($debug) $GLOBALS['JOOMSEF_DEBUG']['sefRelToAbs']['RET'][$debugString] = $ret;

    // Trigger onSefEnd patches
    $_MAMBOTS->trigger('onSefEnd');
    restoreLang($prevLang);
    return $ret;
}

/**
 * If given language is different from actual joomla's one, select it
 *
 * @param string $lang
 */
function restoreLang($lang) {
    global $mosConfig_lang;

    if( ($lang != '') && ($lang != $mosConfig_lang) ) {
        $mosConfig_lang = $lang;
    }
}

/**
 * Convert title to URL name.
 *
 * @param  string $title
 * @return string
 */
function titleToLocation(&$title)
{
    global $sefConfig;

    // remove accented characters
    // $title = strtr($title,
    //'�������������������������������������ݍ�������������������������������',
    //'SOZsozzAuRAAAALCCCEEEEIIDDNNOOOORUUUUYTsraaaalccceeeeiiddnnooooruuuuyt-');
    // Replace non-ASCII characters.
    $title = strtr($title, $sefConfig->getReplacements());

    // remove quotes, spaces, and other illegal characters
    $title = preg_replace(array('/\'/', '/[^a-zA-Z0-9\-!.,+]+/', '/(^_|_$)/'), array('', $sefConfig->replacement, ''), $title);

    return $sefConfig->lowerCase ? strtolower($title) : $title;
}

/**
 * If headers were already sent, output this error message.
 *
 * @param string $file
 * @param int $line
 * @param string $url
 * @param string $option
 */
function headers_sent_error($file, $line, $url, $option)
{
    die("<br />Error: headers already sent in ".basename($file)." on line $line.<br />Stopped at line ".__LINE__." in ".basename(__FILE__).": HEADERS ALREADY SENT (200)<br />URL=".@$url.":<br />OPTION=".@$option.":");
}

/**
 * Returns the custom menu title for a component
 * or null if it's not set
 *
 * @param  string $option
 * @return string
 */
function getCustomMenuTitle($option) {
    global $database, $sefConfig, $mosConfig_lang;
    static $titles;

    $jfTranslate = $sefConfig->translateNames ? ', id' : '';

    if( !isset($titles) )   $titles = array();
    if( !isset($titles[$mosConfig_lang]) ) {
        $database->setQuery("SELECT file, title$jfTranslate FROM #__sefexts");
        $titles[$mosConfig_lang] = $database->loadObjectList('file');
    }

    $file = $option.'.xml';
    if( isset($titles[$mosConfig_lang][$file]->title) ) {
        return $titles[$mosConfig_lang][$file]->title;
    } else {
        return null;
    }
}

/**
 * Returns the title for a component
 *
 * @param string $option
 * @param string $task
 * @param string $id
 * @param string $string
 * @return string
 */
function getMenuTitle($option, $task, $id = null, $string = null)
{
    global $database, $sefConfig;

    $debug = 0;

    // JF translate extension.
    $jfTranslate = $sefConfig->translateNames ? ', id' : '';

    if( $title = getCustomMenuTitle($option) ) {
        return $title;
    }

    if (isset($string)) {
        $sql = "SELECT name$jfTranslate FROM #__menu WHERE `link` = '$string' AND `published` > 0";
    }
    elseif (isset($id) && $id != 0) {
        $sql = "SELECT name$jfTranslate FROM #__menu WHERE `id` = '$id' AND `published` > 0";
    }
    else {
        // Search for direct link to component only
        $sql = "SELECT name$jfTranslate FROM #__menu WHERE `link` = 'index.php?option=$option' AND `published` > 0";
    }

    $database->setQuery($sql);
    $rows = @$database->loadObjectList();

    if ($debug) {
        echo('<pre>');
        $GLOBALS['JOOMSEF_DEBUG']['getMenuTitle']['ROWS-'.$option.'-'.$task] = $rows;
        echo('</pre>');
    }

    if ($database->getErrorNum()) die($database->stderr());
    elseif (@count($rows) > 0) {
        if (!empty($rows[0]->name)) $title = $rows[0]->name;
    }
    else {
        $title = str_replace('com_', '', $option);

        if( !isset($string) && !isset($id) ) {
            // Try to extend the search for any link to component
            $sql = "SELECT name$jfTranslate FROM #__menu WHERE `link` LIKE 'index.php?option=$option%' AND `published` > 0";
            $database->setQuery($sql);
            $rows = @$database->loadObjectList();
            if ($database->getErrorNum()) die($database->stderr());
            elseif (@count($rows) > 0) {
                if (!empty($rows[0]->name)) $title = $rows[0]->name;
            }
        }
    }

    return $title;
}

?>
