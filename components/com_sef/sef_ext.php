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

global $_SEF_SPACE, $lowerCase;

/**
 * SEF Component class.
 */
class sef_component
{

    /**
     * Revert to original URL.
     *
     * @param  array $url_array
     * @param  int $pos
     * @return string
     */
    function revert(&$url_array, $pos)
    {
        global $_SEF_SPACE;

        $QUERY_STRING = '';

        if (strcspn ($url_array[1], ',') == strlen($url_array[1])) {
            // This is a nocache url
            $x = 0;
            $c = count($url_array);
            while ($x < $c) {
                if (isset($url_array[$x]) && $url_array[$x] != '' && isset($url_array[$x + 1]) && $url_array[$x + 1] != '') {
                    $_GET[$url_array[$x]] = $_REQUEST[$url_array[$x]] = $url_array[$x + 1];
                    $QUERY_STRING .= '&'.$url_array[$x].'='.$url_array[$x + 1];
                }
                $x += 2;
            }
        }
        else {
            //This is a default mambo SEF url for a component
            foreach($url_array as $value) {
                $temp = explode(',', $value);
                if (isset($temp[0]) && $temp[0] != '' && isset($temp[1]) && $temp[1] != '') {
                    $_GET[$temp[0]] = $_REQUEST[$temp[0]] = $temp[1];
                    $QUERY_STRING .= "&$temp[0]=$temp[1]";
                }
            }
        }
        return str_replace('&option', 'option', $QUERY_STRING);
    }
}

/**
 * SEF content class.
 *
 */
class sef_content
{

    /**
     * Revert the content URLs.
     *
     * @param  array $url_array
     * @param  int $pos
     * @return string
     */
    function revert(&$url_array, $pos)
    {
        $_GET['option'] = $_REQUEST['option'] = $option = 'com_content';
        $c = count(array_filter($url_array)) - strval($pos);

        switch ($c) {
            //$option/$task/$sectionid/$id/$Itemid/$limit/$limitstart
            case 7: {
                $task = $url_array[$pos + 1];
                $sectionid = $url_array[$pos + 2];
                $id = $url_array[$pos + 3];
                $Itemid = $url_array[$pos + 4];
                $limit = $url_array[$pos + 5];
                $limitstart = $url_array[$pos + 6];
                break;
            }
            // $option/$task/$id/$Itemid/$limit/$limitstart
            case 6: {
                $task = $url_array[$pos + 1];
                $id = $url_array[$pos + 2];
                $Itemid = $url_array[$pos + 3];
                $limit = $url_array[$pos + 4];
                $limitstart = $url_array[$pos + 5];
                break;
            }
            // $option/$task/$sectionid/$id/$Itemid
            case 5: {
                $task = $url_array[$pos + 1];
                $sectionid = $url_array[$pos + 2];
                $id = $url_array[$pos + 3];
                $Itemid = $url_array[$pos + 4];
                break;
            }
            // $option/$task/$id/$Itemid
            case 4: {
                $task = $url_array[$pos + 1];
                $id = $url_array[$pos + 2];
                $Itemid = $url_array[$pos + 3];
                break;

            }
            // $option/$task/$id
            case 3: {
                $task = $url_array[$pos + 1];
                $id = $url_array[$pos + 2];
                break;

            }
            // $option/$task
            case 2: {
                $task = $url_array[$pos + 1];
            }
        }
        //$QUERY_STRING = "option=com_content&task=$task&sectionid=$sectionid&id=$id&Itemid=$Itemid&limit=$limit&limitstart=$limitstart";
        $_GET['task'] = $_REQUEST['task'] = $task;
        $QUERY_STRING = "option=com_content&task=$task";
        if (@$sectionid) {
            $_GET['sectionid'] = $_REQUEST['sectionid'] = $sectionid;
            $QUERY_STRING .= "&sectionid=$sectionid";
        }
        if (@$id) {
            $_GET['id'] = $_REQUEST['id'] = $id;
            $QUERY_STRING .= "&id=$id";
        }
        if (@$Itemid) {
            $_GET['Itemid'] = $_REQUEST['Itemid'] = $Itemid;
            $QUERY_STRING .= "&Itemid=$Itemid";
        }
        if (@$limit) {
            $_GET['limit'] = $_REQUEST['limit'] = $limit;
            $_GET['limitstart'] = $_REQUEST['limitstart'] = $limitstart;
            $QUERY_STRING .= "&limit=$limit&limitstart=$limitstart";
        }
        return $QUERY_STRING;
    }

}

class sef_joomsef
{

    var $debugString;
    var $nonSefVars;
    var $ignoreVars;

    function beforeCreate($url) {
        return $url;
    }

    function afterCreate($sef) {
        return $sef;
    }

    /**
     * Try to load SEF URL from redirection table.
     *
     * @param  string $url  Original Joomla! URL
     * @return mixed        Found SEF URL or false if not found
     */
    function getSefUrlFromDatabase(&$url) {
        global $database, $sefConfig;

        // David (284): ignore Itemid if set to
        $vars = array();
        $where = '';
        parse_str(str_replace('index.php?', '', $url), $vars);

        // Get the extension's ignoreSource parameter
        if( isset($vars['option']) ) {
            $params = SEFTools::getExtParams($vars['option']);
            $extIgnore = $params->get('ignoreSource', 2);
        } else {
            $extIgnore = 2;
        }
        $ignoreSource = ($extIgnore == 2 ? $sefConfig->ignoreSource : $extIgnore);
        if( !$ignoreSource && isset($vars['Itemid']) ) {
            $where = " AND Itemid = '".$vars['Itemid']."'";
        }

        $query = "SELECT oldurl FROM #__redirection WHERE newurl = '".addslashes(SEFTools::RemoveVariable(urldecode($url), 'Itemid'))."'" . $where;
        $database->setQuery($query);
        $result = $database->loadresult();

        return !empty($result) ? $result : false;
    }

    /**
     * Create SEF URL.
     *
     * @param  string $string
     * @param  array $vars
     * @return string
     */
    function create($string, &$vars)
    {
        global $database, $sefConfig;

        $debug = 0;

        $self = isset($_SERVER['ORIG_SCRIPT_NAME']) ? $_SERVER['ORIG_SCRIPT_NAME'] : (isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : $_SERVER['PHP_SELF']);
        $index = str_replace($GLOBALS['mosConfig_live_site'], '', $self);
        $base  = dirname($index);
        $base .= ($base == '/') ? '' : '/';

        // Extract variables array into single vars.
        extract($vars);

        if ($debug) {
            $this->debugString = $string;
            $GLOBALS['JOOMSEF_DEBUG']['CLASS_SEF_JOOMSEF'][$this->debugString]['VARS'] = $vars;
        }

        // Plug-in system.
        if (file_exists($GLOBALS['mosConfig_absolute_path'].'/components/com_sef/sef_ext/'.$option.'.php')) {
            include($GLOBALS['mosConfig_absolute_path'].'/components/com_sef/sef_ext/'.$option.'.php');
        }
        else {
            $title = array();
            $title[] = getMenuTitle($option, @$task);
            $title[] = '/';
            $string = sef_joomsef::sefGetLocation($string, $title, @$task, @$limit, @$limitstart, @$lang);
        }
        return $string;
    }

    /**
     * Return reverted URL in Joomla format.
     *
     * @param  array $url_array
     * @param  int $pos
     * @return string
     */
    function revert(&$url_array, $pos = 0)
    {
        global $database, $sefConfig, $mosConfig_MetaDesc, $mosConfig_MetaKeys, $jsCache;

        // debuggin on/off
        $debug = (bool) @$_REQUEST['debugSEF'];

        $QUERY_STRING = '';

        $req = str_replace('option/', '', implode('/', (array) $url_array));
        if ($debug) $GLOBALS['JOOMSEF_DEBUG']['CLASS_SEF_JOOMSEF']['INITIAL_REQ'] = $req;

        // Removed by michal
        // This was causing problems with custom redirects.
        // verify trailing slash and default filename if there is one
        /*if (!eregi($sefConfig->addFile.'$', $req) && !eregi($sefConfig->suffix.'$', $req)) {
        //if there should be a filename add it on
        $req = $req.$sefConfig->addFile;
        }
        if (!eregi('/'.$sefConfig->addFile.'$', $req) && !eregi($sefConfig->suffix.'$', $req)) {
        //no suffix or filename entered so make sure there is a slash
        if (eregi($sefConfig->addFile.'$', $req)) $req = substr($req, 0, strlen($req) - strlen($sefConfig->addFile)).'/'.$sefConfig->addFile;
        }*/
        //$req = str_replace('//', '/', $req);

        if (substr($req, 0, 1) == '/') $req = substr($req, 1);

        if ($debug) $GLOBALS['JOOMSEF_DEBUG']['CLASS_SEF_JOOMSEF']['REQ'] = $req;
        //$sql="SELECT oldurl, newurl FROM #__redirection WHERE oldurl LIKE '".$req."' LIMIT 1";
        $sql = "SELECT * FROM #__redirection WHERE `oldurl` = '".$req."' AND `newurl` != '' LIMIT 1";
        $database->setQuery($sql);

        // Try to use cache
        if ($sefConfig->useCache) {
            $row = $jsCache->getNonSefUrl($req);
        }
        else {
            $row = null;
        }
        if ($row) {
            // Cache worked
            $fromCache = true;
        }
        else {
            // URL isn't in cache or cache disabled
            $fromCache = false;
            $row = null;
            $database->loadObject($row);
        }

        // if trailing slash transiting is allowed
        if ($sefConfig->transitSlash && $row === false) {
            $isSlash = substr($req, -1) == '/';
            $req = $isSlash ? substr($req, 0, -1) : $req.'/';

            // try to load again with trailing slash
            $sql = "SELECT * FROM #__redirection WHERE `oldurl` = '".$req."' AND `newurl` != '' LIMIT 1";
            $database->setQuery($sql);

            // Try to use cache
            if ($sefConfig->useCache) {
                $row = $jsCache->getNonSefUrl($req);
            } else {
                $row = null;
            }
            if ($row) {
                // Cache worked
                $fromCache = true;
            }
            else {
                // URL isn't in cache or cache disabled
                $fromCache = false;
                $row = null;
                $database->loadObject($row);
            }
        }

        if ($row) {
            // Use the already created URL
            $string = $row->newurl;
            if( isset($row->Itemid) && ($row->Itemid != '') ) {
                $string .= (strpos($string, '?') ? '&' : '?') . 'Itemid=' . $row->Itemid;
            }

            // update the count
            $database->setQuery("UPDATE #__redirection SET cpt=(cpt+1) WHERE `newurl` = '".$row->newurl."'");
            $database->query();
            $string = str_replace( '&amp;', '&', $string );
            $QUERY_STRING = str_replace('index.php?', '', $string);
            parse_str($QUERY_STRING, $vars);
            // $QUERY_STRING = str_replace( '&', '&amp;', $QUERY_STRING);
            if ($debug) {
                $GLOBALS['JOOMSEF_DEBUG']['CLASS_SEF_JOOMSEF']['QUERY_STRING'] = $QUERY_STRING;
                $GLOBALS['JOOMSEF_DEBUG']['CLASS_SEF_JOOMSEF']['VARS']= $vars;
            }
            $_GET = array_merge($_GET, $vars);
            $_REQUEST = array_merge($_REQUEST, $vars);

            // Prepare the meta tags array for MetaBot
            if ($row->metatitle)  $GLOBALS['sefMetaTags']['title'] = $row->metatitle;
            if ($row->metadesc)   $GLOBALS['sefMetaTags']['metadesc'] = $row->metadesc;
            if ($row->metakey)    $GLOBALS['sefMetaTags']['metakey'] = $row->metakey;
            if ($row->metalang)   $GLOBALS['sefMetaTags']['lang'] = $row->metalang;
            if ($row->metarobots) $GLOBALS['sefMetaTags']['robots'] = $row->metarobots;
            if ($row->metagoogle) $GLOBALS['sefMetaTags']['googlebot'] = $row->metagoogle;

            // If cache is enabled but URL isn't in cache yet, add it
            if ($sefConfig->useCache && !$fromCache) {
                $jsCache->addUrl($row->newurl, $row->oldurl, $row->cpt + 1, $row->Itemid, $row->metatitle, $row->metadesc, $row->metakey, $row->metalang, $row->metarobots, $row->metagoogle);
            }
        } elseif( $sefConfig->useMoved ) {
            // URL not found, let's try the Moved Permanently table
            $row = null;
            $database->setQuery("SELECT * FROM `#__sefmoved` WHERE `old` = '$req'");
            $database->loadObject($row);

            if($row) {
                // URL found, let's update the lastHit in table and redirect
                $database->setQuery("UPDATE `#__sefmoved` SET `lastHit` = NOW() WHERE `id` = '$row->id'");
                $database->query();

                $f = $l = '';
                if (!headers_sent($f, $l)) {
                    // Let's build absolute URL from our link
                    if( strstr($row->new, $GLOBALS['mosConfig_live_site']) === false ) {
                        $url = $GLOBALS['mosConfig_live_site'];
                        if( substr($url, -1, 1) != '/' )        $url .= '/';
                        if( substr($row->new, 0, 1) == '/' )    $row->new = substr($row->new, 1);
                        $url .= $row->new;
                    } else {
                        $url = $row->new;
                    }

                    // Use the link to redirect
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$url);
                    header("Connection: close");
                    exit();
                } else {
                    $url = $GLOBALS['mosConfig_live_site'].$_SERVER['QUERY_STRING'];
                    die("<br />Are we debugging?<br />Headers sent by ".basename($f)." on line ".$l.".<br />Killed at line ".__LINE__." in ".basename(__FILE__).": HEADERS ALREADY SENT (200)<br />URL=".@$url.":<br />OPTION=".@$option.":");
                }
            }
        }

        return $QUERY_STRING;
    }

    /**
     * Get SEF titles of content items.
     *
     * @param  string $task
     * @param  int $id
     * @return string
     */
    function getContentTitles($task, $id)
    {
        global $database, $sefConfig;

        $title = array();
        // JF translate extension.
        $jfTranslate = $sefConfig->translateNames ? ', `id`' : '';

        switch ($task) {
            case 'section':
            case 'blogsection': {
                if (isset($id)) $sql = "SELECT title AS section$jfTranslate FROM #__sections WHERE id = $id";
                break;
            }
            case 'category':
            case 'blogcategory':
                if (isset($id)) {
                    if ($sefConfig->showSection || !$sefConfig->showCat) {
                        $sql = 'SELECT s.title AS section'.($jfTranslate ? ', s.id' : '')
                        .($sefConfig->showCat ? ', c.title AS category'.($jfTranslate ? ', c.id' : '') : '')
                        .' FROM #__categories as c '
                        .'LEFT JOIN #__sections AS s ON c.section = s.id '
                        .'WHERE c.id = '.$id;
                    }
                    else $sql = "SELECT title AS category$jfTranslate FROM #__categories WHERE id = $id";
                }
                break;
            case 'view':
                if (isset($id)) {
                    if ($sefConfig->useAlias) {
                        // verify title alias is not empty
                        $database->setQuery("SELECT title_alias$jfTranslate FROM #__content WHERE id = $id");
                        $title_field = $database->loadResult() ? 'title_alias' : 'title';
                    }
                    else $title_field = 'title';
                    if ($sefConfig->showSection || !$sefConfig->showCat) {
                        $sql = 'SELECT '.($sefConfig->showSection ? 's.title AS section'.($jfTranslate ? ', s.id AS section_id' : '').', ' : '').
                        ($sefConfig->showCat ? 'c.title AS category'.($jfTranslate ? ', c.id AS category_id' : '').', ' : '').
                        'a.'.$title_field.' AS title'.($jfTranslate ? ', a.id' : '').' FROM #__content as a'.
                        ' LEFT JOIN #__sections AS s ON a.sectionid = s.id '.
                        ($sefConfig->showCat ? ' LEFT JOIN #__categories AS c ON a.catid = c.id ' : '').
                        ' WHERE a.id = '.$id;
                    }
                    else {
                        $sql = 'SELECT '.($sefConfig->showCat ? 'c.title AS category'.($jfTranslate ? ', c.id AS category_id' : '').', ' : '')
                        .'a.'.$title_field.' AS title'.($jfTranslate ? ', a.id' : '').' FROM #__content as a'.
                        ($sefConfig->showCat ? ' LEFT JOIN #__categories AS c ON a.catid = c.id ' : '').
                        ' WHERE a.id = '.$id;
                    }
                }
                break;
            default:
                $sql = '';
        }

        if ($sql) {
            $row = null;
            $database->setQuery($sql);
            $database->loadObject($row);

            if (isset($row->section)) {
                $title[] = $row->section;
                if ($task == 'section') $title[] = '/';
            }
            if (isset($row->category)) {
                $title[] = $row->category;
                if ($task == 'category') $title[] = '/';
            }
            if (isset($row->title)) $title[] = $row->title;
        }
        return $title;
    }

    /**
	 * Transfers the $title array of URL components to the real URL
	 * and stores it in the database if needed.
	 *
	 * @param  string $url
	 * @param  array $title
	 * @param  string $task
	 * @param  int $limit
	 * @param  int $limitstart
	 * @param  string $lang
	 * @param  array $nonSefVars       Variables that will be excluded if set to in configuration
	 * @param  array $ignoreSefVars    Variables that will be always excluded
	 * @return string SEF URL
	 */
    function sefGetLocation($url, &$title, $task = null, $limit = null, $limitstart = null, $lang = null, $nonSefVars = null, $ignoreSefVars = null)
    {
        global $database, $sefConfig, $mosConfig_lang, $jsCache;

        $debug = 0;

        // shorten the url for storage and for consistency
        $url = str_replace('&amp;', '&', $url);

        // Parse URL variables to array, we'll need them
        $vars = array();
        parse_str(str_replace('index.php?', '', $url), $vars);

        // Remove the menu title if set to for this component
        if( isset($vars['option']) && in_array($vars['option'], $sefConfig->dontShowTitle) ) {
            if( (count($title) > 1) &&
            ((count($title) != 2) || ($title[1] != '/')) &&
            ($title[0] == getMenuTitle(@$vars['option'], @$vars['task'], @$vars['Itemid'])) )
            {
                array_shift($title);
            }
        }

        // Get all the titles ready for urls.
        $location = array();
        foreach($title as $titlePart) {
            if (strlen($titlePart) == 0) continue;
            $location[] = titleToLocation($titlePart);
        }

        // Remove unwanted characters.
        $finalstrip = explode('|', $sefConfig->stripthese);
        $takethese = str_replace('|', '', $sefConfig->friendlytrim);

        $imptrim = implode('/', $location);

        if (!is_null($task)) {
            $task = str_replace($sefConfig->replacement.'-'.$sefConfig->replacement, $sefConfig->replacement, $task);
            $task = str_replace($finalstrip, '', $task);
            $task = trim($task,$takethese);
        }

        $imptrim = str_replace($sefConfig->replacement.'-'.$sefConfig->replacement, $sefConfig->replacement, $imptrim);
        $suffixthere = 0;
        $regexSuffix = str_replace('.', '\.', $sefConfig->suffix);
        if (eregi($regexSuffix.'$', $imptrim)) {
            $suffixthere = strlen($sefConfig->suffix);
        }

        $imptrim = str_replace($finalstrip, $sefConfig->replacement, substr($imptrim, 0, strlen($imptrim) - $suffixthere));
        $imptrim = str_replace($sefConfig->replacement.$sefConfig->replacement, $sefConfig->replacement, $imptrim);

        $suffixthere = 0;
        if (eregi($regexSuffix.'$', $imptrim)) {
            $suffixthere = strlen($sefConfig->suffix);
        }

        $imptrim = trim(substr($imptrim, 0, strlen($imptrim) - $suffixthere), $takethese);

        $location = str_replace('//', '/', $imptrim.(!is_null($task) ? '/'.$task.$sefConfig->suffix : ''));
        $location = str_replace('//', '/', str_replace('/'.$sefConfig->replacement, '/', $location));

        // Check if the location isn't too long for database storage and truncate it in that case
        $suffixthere = 0;
        $maxlen = 240;  // leave some space for language and numbers
        if (eregi($regexSuffix.'$', $location)) {
            $suffixthere = strlen($sefConfig->suffix);
        }
        if( strlen($location) > $maxlen ) {
            $location = substr($location, 0, $maxlen - $suffixthere);
            if( $suffixthere > 0 ) {
                $location .= $sefConfig->suffix;
            }
        }

        if ($debug) $GLOBALS['JOOMSEF_DEBUG']['CLASS_SEF_JOOMSEF']['sefGetLocation'][$url] = $location;

        // Attempt to intelligently detect page 0 of multi-page urls.
        // They don't really need to be added.
        // Michal -- they are needed - otherwise the first page of the list may not work (e.g. VM)
        /*if (isset($limitstart) && $limitstart == 0) {
        $url = preg_replace('/\&limit=[0-9]+\&limitstart=0/', '', $url);
        }*/

        // Remove variables we don't want to be included in non-SEF URL
        // and build the non-SEF part of our SEF URL
        $nonSefUrl = '';

        // nonSefVars - variables to exclude only if set to in configuration
        if ($sefConfig->appendNonSef && isset($nonSefVars)) {
            foreach ($nonSefVars as $name => $value) {
                $url = SEFTools::RemoveVariable($url, $name, $value);
                if (strlen($nonSefUrl) > 0) $nonSefUrl .= '&'.$name.'='.$value;
                else $nonSefUrl = '?'.$name.'='.$value;
            }
        }

        // If there are global variables to exclude, add them to ignoreSefVars array
        if( !empty($GLOBALS['JOOMSEF_NONSEFVARS']) ) {
            if( !empty($ignoreSefVars) ) {
                $ignoreSefVars = array_merge($GLOBALS['JOOMSEF_NONSEFVARS'], $ignoreSefVars);
            } else {
                $ignoreSefVars = $GLOBALS['JOOMSEF_NONSEFVARS'];
            }
        }

        // ignoreSefVars - variables to exclude allways
        if (isset($ignoreSefVars)) {
            foreach ($ignoreSefVars as $name => $value) {
                $url = SEFTools::RemoveVariable($url, $name, $value);
                if (strlen($nonSefUrl) > 0) $nonSefUrl .= '&'.$name.'='.$value;
                else $nonSefUrl = '?'.$name.'='.$value;
            }
        }

        // Allways remove Itemid and store it in a separate column
        if( isset($vars['Itemid']) ) {
            $Itemid = $vars['Itemid'];
            $url = SEFTools::RemoveVariable($url, 'Itemid');
        }

        // make sure url vars are sorted correctly
        $url = SEFTools::sortURLvars($url);

        // check for non-sef url first and avoid repeative lookups
        // we only want to look for title variations when adding new
        // this should also help eliminate duplicates.

        // David (284): ignore Itemid if set to
        if( isset($vars['option']) ) {
            $params = SEFTools::getExtParams($vars['option']);
            $extIgnore = $params->get('ignoreSource', 2);
        } else {
            $extIgnore = 2;
        }
        $ignoreSource = ($extIgnore == 2 ? $sefConfig->ignoreSource : $extIgnore);

        $where = '';
        if( !$ignoreSource && isset($Itemid) ) {
            $where .= " AND Itemid = '".$Itemid."'";
        }
        $query = "SELECT oldurl FROM #__redirection WHERE newurl = '".addslashes(urldecode($url))."'" . $where;
        $database->setQuery($query);

        if( $sefConfig->useCache ) {
            $realloc = $jsCache->GetSefUrl($url, @$Itemid);
        }
        if( !$sefConfig->useCache || !$realloc ) {
            $realloc = $database->loadResult();
        }
        if( !$realloc && ($sefConfig->langPlacement == _COM_SEF_LANG_DOMAIN) ) {
            // Try to find the url without lang variable
            $query = "SELECT oldurl FROM #__redirection WHERE newurl = '".addslashes(SEFTools::RemoveVariable(urldecode($url), 'lang'))."'" . $where;
            $database->setQuery($query);

            if( $sefConfig->useCache ) {
                $realloc = $jsCache->GetSefUrl(SEFTools::RemoveVariable($url, 'lang'), @$Itemid);
            }
            if( !$sefConfig->useCache || !$realloc ) {
                $realloc = $database->loadResult();
            }
        }

        // Found a match, so we are done.
        if ($realloc) {
            // Return found URL with non-SEF part appended
            if( ($nonSefUrl != '') && (strstr($realloc, '?')) )
            $nonSefUrl = str_replace('?', '&', $nonSefUrl);

            return $realloc.$nonSefUrl;
        }
        // This is new, so we need to insert it to database
        else {
            $iteration = 1;
            $realloc = null;
            $prevPagenum = null;

            $suffixMust = false;
            // Add lang to suffix, if set to.
            if (class_exists('JoomFish') && isset($lang) && $sefConfig->langPlacement == _COM_SEF_LANG_SUFFIX) {
                $suffix = '_'.$lang.$sefConfig->suffix;
                $suffixMust = true;
            }
            if (!isset($suffix)) $suffix = $sefConfig->suffix;
            $addFile = $sefConfig->addFile;
            if (($pos = strrpos($addFile, '.')) !== false) $addFile = substr($addFile, 0, $pos);

            do {
                // In case the created SEF URL is already in database for different non-SEF URL,
                // we need to distinguish them by using numbers, so let's find the first unused URL

                if (substr($location, -1) == '/' || strlen($location) == 0) {
                    if ($sefConfig->pagetext) {
                        if (!is_null($limit)) {
                            $pagenum = $limitstart / $limit;
                            $pagenum++;
                            // Make sure we do not end in infite loop here.
                            if ($prevPagenum == $pagenum) $pagenum = $iteration;
                            $prevPagenum = $pagenum;
                        }
                        else $pagenum = $iteration;

                        if (strpos($sefConfig->pagetext, '%s') !== false) {
                            $page = str_replace('%s', $pagenum == 1 ? $addFile : $pagenum, $sefConfig->pagetext).$suffix;
                        }
                        else $page = $sefConfig->pagetext.($pagenum == 1 ? $addFile : $sefConfig->pagerep.$pagenum).$suffix;

                        $temploc = $location.($pagenum == 1 && !$suffixMust ? '' : $page);
                    }
                    else $temploc = $location.($iteration == 1 ? ($suffixMust ? $sefConfig->pagerep.$suffix : '') : $sefConfig->pagerep.$iteration.$suffix);
                }
                elseif ($suffix) {
                    if  ($sefConfig->suffix != '/') {
                        if (eregi($regexSuffix, $location)) {
                            $temploc = preg_replace('/'.$regexSuffix.'/', '', $location).($iteration == 1 ? $suffix : $sefConfig->pagerep.$iteration.$suffix);
                        }
                        else $temploc = $location.($iteration == 1 ? $suffix : $sefConfig->pagerep.$iteration.$suffix);
                    }
                    else $temploc = $location.($iteration == 1 ? $suffix : $sefConfig->pagerep.$iteration.$suffix);
                }
                else $temploc = $location.($iteration == 1 ? ($suffixMust ? $sefConfig->pagerep.$suffix : '') : $sefConfig->pagerep.$iteration.$suffix);

                // Add language to path if set to.
                if (class_exists('JoomFish') && isset($lang) && $sefConfig->langPlacement == _COM_SEF_LANG_PATH) {
                    $slash = ($temploc != '' && $temploc[0] == '/');
                    $temploc = $lang.($slash || strlen($temploc) > 0  ? '/' : '').$temploc;
                }

                if ($sefConfig->addFile) {
                    if (!eregi($regexSuffix.'$', $temploc) && substr($temploc, -1) == '/') {
                        $temploc .= $sefConfig->addFile;
                    }
                }

                // Convert to lowercase if set to.
                if ($sefConfig->lowerCase) $temploc = strtolower($temploc);

                // see if we have a result for this location
                $sql = "SELECT newurl, Itemid FROM #__redirection WHERE oldurl = '".$temploc."'";
                $database->setQuery($sql);

                if ($iteration > 9999) {
                    die('Too many pages.');
                }

                $row = null;
                $database->loadObject($row);
                // We found a record...
                if ($row != false) {
                    if( $ignoreSource || (!$ignoreSource && (!isset($Itemid) || $row->Itemid == $Itemid)) ) {
                        // ... check that it matches original URL
                        if ($row->newurl == $url) {
                            // found the matching object
                            // it probably should have been found sooner
                            // but is checked again here just for CYA purposes
                            // and to end the loop
                            $realloc = $temploc;
                        }
                        else if( $sefConfig->langPlacement == _COM_SEF_LANG_DOMAIN ) {
                            // Check if the urls differ only by lang variable
                            if( SEFTools::RemoveVariable($row->newurl, 'lang') == SEFTools::RemoveVariable($url, 'lang') ) {
                                $database->setQuery("UPDATE #__redirection SET newurl = '".SEFTools::RemoveVariable($row->newurl, 'lang')."' WHERE oldurl = '".$temploc."'");
                                $database->query();
                                $realloc = $temploc;
                            }
                        }
                    }
                    // else, didn't find it, increment and try again
                }
                // URL not found, try to search among 404s
                else {
                    $query = "SELECT `id` FROM #__redirection WHERE `oldurl` = '$temploc' AND `newurl` = ''";
                    $database->setQuery($query);
                    $id = $database->loadResult();

                    // If 404 exists, rewrite it to the new URL
                    if (!is_null($id)) {
                        $sqlId = ((isset($Itemid) && $Itemid != '') ? ", `Itemid` = '$Itemid'" : '');
                        $query = "UPDATE #__redirection SET `newurl` = '".mysql_escape_string(urldecode($url))."'$sqlId WHERE `id` = '$id'";
                        $database->setQuery($query);

                        // If error occured.
                        if (!$database->query()) var_dump($query);
                    }
                    // Save it in the database as new record
                    else {
                        $col = $val = '';
                        if( isset($Itemid) && ($Itemid != '') ) {
                            $col = ', Itemid';
                            $val = ", '$Itemid'";
                        }
                        $query = 'INSERT INTO #__redirection (oldurl, newurl'.$col.') '.
                        "VALUES ('".$temploc."', '".mysql_escape_string(urldecode($url))."'$val)";
                        $database->setQuery($query);

                        // If error occured.
                        if (!$database->query()) var_dump($query);
                    }
                    $realloc = $temploc;
                }
                $iteration++;
            } while (is_null($realloc));
        }
        // Return created URL with non-SEF part appended
        if( ($nonSefUrl != '') && (strstr($realloc, '?')) )
        $nonSefUrl = str_replace('?', '&', $nonSefUrl);

        return $realloc.$nonSefUrl;
    }

    /**
     * Returns the Joomla category for given id
     *
     * @param int $catid
     * @return string
     */
    function getCategories($catid)
    {
        global $debug, $database, $sefConfig;
        $jfTranslate = $sefConfig->translateNames ? ', `id`' : '';

        if (empty($cat_table)) $cat_table = "#__categories";

        // Let's find the Joomla category name for given category ID
        if (isset($catid) && $catid != 0){
            if ($debug){
                $GLOBALS['JOOMSEF_DEBUG']['CLASS_SEF_JOOMSEF'][$this->debugString]['CAT_TABLE'] = $cat_table;
                $GLOBALS['JOOMSEF_DEBUG']['CLASS_SEF_JOOMSEF'][$this->debugString]['CATID'] = $catid;
            }
            $query = "SELECT name$jfTranslate FROM $cat_table WHERE id = $catid";
            $database->setQuery($query);
            $rows = $database->loadObjectList();

            if ($database->getErrorNum()) die($database->stderr());
            elseif (@count($rows) > 0 && !empty($rows[0]->name)) $title = $rows[0]->name;
        }
        return $title;
    }

}

// For backwards compatibility with 3rd party extensions
class sef_404 extends sef_joomsef {

}

// Define sef functions for some Joomla! extensions
if( !function_exists('sefencode') ) {
    function sefencode($string) {
        global $sefConfig;

        $string = urlencode($string);
        $string = eregi_replace("%2F", "%10", $string);
        if ($sefConfig->lowerCase) {
            $string = strtolower($string);
        }
        return $string;
    }
}

if( !function_exists('sefdecode') ) {
    function sefdecode($string) {
        global $sefConfig;
        $string = eregi_replace("%10", "%2F", $string);
        $string = urldecode($string);
        $string = addslashes($string);
        return $string;
    }
}

?>
