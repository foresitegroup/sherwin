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

$debug = 0;
// IIS patch.
if (isset($_SERVER['HTTP_X_REWRITE_URL'])) {
    $_SERVER['REQUEST_URI'] = $_SERVER['HTTP_X_REWRITE_URL'];
}
// OpenSEF patch.
define('_OPENSEF', 1);

if ($mosConfig_sef) {
    // Load patches
    $_MAMBOTS->loadBotGroup('sefpatch');

    // Trigger onSefLoad patches
    $_MAMBOTS->trigger('onSefLoad');

    $sefDirAdmin = $GLOBALS['mosConfig_absolute_path'].'/administrator/components/com_sef/';

    // Load language file.
    if (file_exists($sefDirAdmin.'language/'.$mosConfig_lang.'.php')){
        include($sefDirAdmin.'language/'.$mosConfig_lang.'.php');
    }
    else {
        include($sefDirAdmin.'language/english.php');
    }

    // load config data
    $sef_config_class = $sefDirAdmin.'sef.class.php';
    $sef_config_file  = $sefDirAdmin.'config.sef.php';

    if (!is_readable($sef_config_file)) die(_COM_SEF_NOREAD."($sef_config_file)<br />"._COM_SEF_CHK_PERMS);
    if (is_readable($sef_config_class)) require_once($sef_config_class);
    else die(_COM_SEF_NOREAD."( $sef_config_class )<br />"._COM_SEF_CHK_PERMS);

    $sefConfig = new SEFConfig();

    // check for kind of SEF or no SEF at all
    // test if this is Joomla! style URL
    if (strstr($_SERVER['REQUEST_URI'], 'index.php/content/')
    || strstr($_SERVER['REQUEST_URI'], '/content/')
    || strstr($_SERVER['REQUEST_URI'], 'index.php/component/option,')
    || strstr($_SERVER['REQUEST_URI'], '/component/option,')) {
        require_once('functions.php');
        decodeurls_mambo();
    }
    // or TIM style url
    elseif (strstr($_SERVER['REQUEST_URI'], 'index.php/view/')) {
        require_once('functions.php');
        decodeurls_tim();
    }
    // otherwise operate as with JoomSEF URL
    else {
    }

    if ($sefConfig->enabled) {
        // Load the cache if set to
        global $jsCache;
        if( $sefConfig->useCache ) {
            require_once($GLOBALS['mosConfig_absolute_path'].'/components/com_sef/sef.cache.php');
            $jsCache = new sefCache($sefConfig->cacheSize, $sefConfig->cacheMinHits);
        } else {
            $jsCache = null;
        }

        $sefFile = $GLOBALS['mosConfig_absolute_path']."/components/com_sef/joomsef.php";
        if (is_readable($sefFile)) {
            // search matches for domain or alt domains
            $matches = array_merge($sefConfig->getAltDomain(), array($GLOBALS['mosConfig_live_site']));

            //$self = isset($_SERVER['ORIG_SCRIPT_NAME']) ? $_SERVER['ORIG_SCRIPT_NAME'] : (isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : $_SERVER['PHP_SELF']);
            if( isset($_SERVER['ORIG_SCRIPT_NAME']) && strstr($_SERVER['ORIG_SCRIPT_NAME'], '.php') != false ) {
                $self = $_SERVER['ORIG_SCRIPT_NAME'];
            } elseif( isset($_SERVER['SCRIPT_NAME']) && strstr($_SERVER['SCRIPT_NAME'], '.php') != false ) {
                $self = $_SERVER['SCRIPT_NAME'];
            } else {
                $self = $_SERVER['PHP_SELF'];
            }
            
            $index = str_replace($matches, '', $self);
            $base = strtr(dirname($index), '\\', '/');
            if ($base == '//') $base = '/';
            if (substr($base , -1) != '/' || $base == '') $base .= '/';
            $index = basename($index);

            $URI = array();
            if (isset($_SERVER['REQUEST_URI'])) {
                //strip out the base
                $REQUEST = str_replace($matches, '', $_SERVER['REQUEST_URI']);
                $REQUEST = preg_replace("/^".preg_quote($base, '/').'/', '', $REQUEST);
                $URI = new Net_URL($REQUEST);
            }
            else {
                $QUERY_STRING = isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : '';
                $URI = new Net_URL($index.$QUERY_STRING);
            }

            if ($debug) {
                echo('<pre>');
                print_r($URI);
                print_r($_SERVER);
                echo('</pre>');
                die();
            }

            // host name handling
            if (class_exists('JoomFish') && $sefConfig->langPlacement == _COM_SEF_LANG_DOMAIN) {
                // different domains for languages handling
                $found = false;
                foreach ($sefConfig->langDomain as $langId => $domain) {
                    if (strpos($domain, $URI->host) !== false ) {
                        // we found a matching domain
                        // get the language iso and set the lang variable
                        $database->setQuery("SELECT `iso`, `code` FROM `#__languages` WHERE `id`='$langId' AND `active`='1'");
                        $row = null;
                        $database->loadObject($row);
                        if (!$row) break;
                        $iso = $row->iso;

                        $_GET['lang'] = $iso;

                        // Set the live_site properly
                        $GLOBALS['mosConfig_live_site'] = $domain;
                        $GLOBALS['mosConfig_lang'] = $row->code;

                        include_once($sefFile);
                        //$found = true;
                        break;
                    }
                }
                /*if (!$found) {
                header('HTTP/1.0 301 Moved Permanently');
                header('Location: '.$GLOBALS['mosConfig_live_site']);
                }*/
            }
            else {
                // this makes problems when VM is configured so https URL is different from the
                // original Joomla! one
                // make sure host name matches our config, we need this later
                /*if (strpos($GLOBALS['mosConfig_live_site'], $URI->host) === false) {
                header('HTTP/1.0 301 Moved Permanently');
                header('Location: '.$GLOBALS['mosConfig_live_site']);
                }
                else*/ include_once($sefFile);
            }

            xmlParsing($URI->path, $base, $index, @$option);
        }
        else die(_COM_SEF_NOREAD."($sefFile)<br />"._COM_SEF_CHK_PERMS);
    }
    else {
        $mambo_sef = $GLOBALS['mosConfig_absolute_path'].'/includes/sef.php';
        if (is_readable($mambo_sef)) include($mambo_sef);
        else die(_COM_SEF_NOREAD."($mambo_sef)<br />"._COM_SEF_CHK_PERMS);
    }

    // Trigger onSefUnload patches
    $_MAMBOTS->trigger('onSefUnload');
}
else {
    // If SEF is disabled, sefRelToAbs returning the unchanged string needs to be defined

    /**
     * Translate URL.
     *
     * @param  string $string
     * @return string
     */
    function sefRelToAbs($string)
    {
        return $string;
    }

}
?>
