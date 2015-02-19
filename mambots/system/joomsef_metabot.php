<?php
/**
 * SEF module for Joomla!
 *
 * @author      $Author: michal $
 * @copyright   ARTIO s.r.o., http://www.artio.cz
 * @package     JoomSEF
 * @version     $Name$, ($Revision: 4994 $, $Date: 2005-11-03 20:50:05 +0100 (??t, 03 XI 2005) $)
 * @license     Released under the terms of the GNU General Public License
 */

// Security check to ensure this file is being included by a parent file.
if (!defined('_VALID_MOS')) die('Direct Access to this location is not allowed.');

$_MAMBOTS->registerFunction('onAfterStart', 'initMetaBot');
$_MAMBOTS->registerFunction('beforeHead', 'checkSEFTitle');
$_MAMBOTS->registerFunction('beforeHead', 'generateSEFMeta');

function initMetaBot()
{
    $metabot = getMetaBot();

    // if published
    if ($metabot->published) {

        // define own mainframe class
        class metaMainFrame extends mosMainFrame
        {

            function getHead()
            {
                global $_MAMBOTS, $mainframe;

                $_MAMBOTS->trigger('beforeHead');
                // PHP4 hack
                // (in PHP4 when Joomla's cache calls call_user_func_array,
                //  $this is not equal to global $mainframe, so we need to
                //  make sure the function is called on the right instance)
                return $mainframe->getParentHead();
            }
            
            // PHP4 hack
            function getParentHead() {
                return parent::getHead();
            }

            function appendMetaTag($name, $content, $rewrite = null)
            {
                if (!$content) return;
                global $mosConfig_MetaKeys, $mosConfig_MetaDesc;

                $params = getMetaBotParams();
                if (is_null($rewrite)) {
                    $rewrite = (bool) $params->get('rewrite_joomla');
                }

                $found = false;
                if ($rewrite) {
                    $n = count($this->_head['meta']);
                    for ($i = 0; $i < $n; $i++) {
                        if ($this->_head['meta'][$i][0] == $name) {
                            $oldContent = $this->_head['meta'][$i][1];
                            // do not allow defaults to be added
                            if ($oldContent) {
                                if ($name == 'description' && $content == $mosConfig_MetaDesc) return;
                                elseif ($name == 'keywords' && $content == $mosConfig_MetaKeys) return;
                            }

                            $this->_head['meta'][$i][1] = htmlspecialchars($content);
                            return;
                        }
                    }
                }

                return parent::appendMetaTag($name, $content);
            }

        }

        // now redefine mainframe
        global $mainframe, $option;
        $myframe = new metaMainFrame($mainframe->_db, $option, '.');

        foreach (get_object_vars($mainframe) as $key => $value) {
            $myframe->$key = $mainframe->$key;
        }

        //unset($mainframe);
        $mainframe = null;
        $mainframe = $myframe;
    }
}

function getMetaBot()
{
    static $metabot;

    // load params from DB
    if (is_null($metabot)) {
        global $database;

        // Get the mambot's parameters
        $query = "SELECT id FROM #__mambots WHERE element = 'joomsef_metabot' AND folder = 'system'";
        $database->setQuery($query);
        $id = $database->loadResult();
        $metabot = new mosMambot($database);
        $metabot->load($id);
    }

    return $metabot;

}

function getMetaBotParams()
{
    $metabot = getMetaBot();
    return new mosParameters($metabot->params);
}

function checkSEFTitle()
{
    global $mainframe;

    $params = getMetaBotParams();
    $preferTitle = $params->get('prefer_joomsef_title');
    $useSitename = $params->get('use_sitename');
    $sitenameSep = $params->get('sitename_sep');
    $preventDupl = $params->get('prevent_dupl');

    // Page title
    if (isset($GLOBALS['sefMetaTags']['title'])) $pageTitle = $GLOBALS['sefMetaTags']['title'];
    else {
        $pageTitle = $mainframe->getPageTitle();
        
        // Dave: replaced regular expression as it was causing problems
        //       with site names like [ index-i.cz ] with str_replace
        /*$pageSep = '( - |'.$sitenameSep.')';
        if (preg_match('/('.$GLOBALS['mosConfig_sitename'].$pageSep.')?(.*)?/', $pageTitle, $matches) > 0) {
            $pageTitle = strtr($pageTitle, array($matches[1] => ''));
        }*/
        $pageTitle = str_replace(array($GLOBALS['mosConfig_sitename'].' - ', $GLOBALS['mosConfig_sitename'].$sitenameSep), array('', ''), $pageTitle);
    }

    if ($preferTitle || @$GLOBALS['mosConfig_pagetitles']) {
        $pageTitle = trim($pageTitle);
        
        // Prevent name duplicity if set to
        if ($preventDupl && strcmp($pageTitle, trim($GLOBALS['mosConfig_sitename'])) == 0) {
            $pageTitle = '';
        }

        if (empty($pageTitle)) $sitenameSep = '';
        if ($useSitename == 1 && $GLOBALS['mosConfig_sitename']) {
            $pageTitle = $GLOBALS['mosConfig_sitename'].$sitenameSep.$pageTitle;
        }
        elseif ($useSitename == 2 && $GLOBALS['mosConfig_sitename']) {
            $pageTitle .= $sitenameSep.$GLOBALS['mosConfig_sitename'];
        }

        // set page title
        if ($pageTitle) {
            $mainframe->_head['title'] = ($pageTitle);
            if ($preferTitle) {
                // Protect our title from rewriting
                $GLOBALS['mosConfig_pagetitles'] = '0';
            }
        }
        // clear used variable
        if (isset($tags['title'])) unset($tags['title']);
    }
}

function generateSEFMeta()
{
    global $mainframe, $mosConfig_MetaKeys, $mosConfig_MetaDesc;

    $params = getMetaBotParams();
    $rewriteKeywords    = $params->get('rewrite_keywords');
    $rewriteDescription = $params->get('rewrite_description');

    if (isset($GLOBALS['sefMetaTags'])) {
        // set alias
        $tags = $GLOBALS['sefMetaTags'];

        // Description metatag
        if (isset($tags['metadesc'])) {
            $rewrite = (($rewriteDescription == '1') || ($mosConfig_MetaDesc == ''));
            // the next uses redefined mainframe
            $mainframe->appendMetaTag('description', $tags['metadesc'], $rewrite);
            unset($tags['metadesc']);
        }

        // Keywords metatag
        if (isset($tags['metakey'])) {
            $rewrite = (($rewriteKeywords == '1') || ($mosConfig_MetaKeys == ''));
            // the next uses redefined mainframe
            $mainframe->appendMetaTag('keywords', $tags['metakey'], $rewrite);
            unset($tags['metakey']);
        }

        // Other metatags
        foreach ($tags as $name => $content) {
            if( $name == 'title' )  continue;
            $mainframe->appendMetaTag($name, $content, true);
        }
    }
}
?>
