<?php
/**
 * JOOMSEF support for DocMAN component.
 *
 * @author      $Author: michal $
 * @copyright   ARTIO s.r.o., http://www.artio.cz
 * @package     JoomSEF
 * @version     $Name$, ($Revision: 4994 $, $Date: 2005-11-03 20:50:05 +0100 (??t, 03 XI 2005) $)
 */

// Security check to ensure this file is being included by a parent file.
if (!defined('_VALID_MOS')) die('Direct Access to this location is not allowed.');

class sefext_com_docman extends sef_joomsef
{
    function create($string, &$vars) {
        extract($vars);

        // JF translate extension.
        global $sefConfig, $database, $debug, $debug_string;
        $jfTranslate = $sefConfig->translateNames ? ', id' : '';

        $title = array();
        $task = isset($task) ? @$task : null;
        switch ($task)
        {
            case 'cat_view':
                {
                    $title[] = getMenuTitle($option, $task, $Itemid);
                    $title = array_merge($title, sef_joomsef::getContentTitles('category', $gid));
                    $title[] = '/';
                    $task = null;
                    break;
                }
            case 'doc_download':
            case 'doc_details':
            case 'doc_view':
                {
                    $database->setQuery("SELECT dmname, catid$jfTranslate FROM #__docman WHERE id = ".$gid);
                    $rows = $database->loadObjectList();

                    if ($debug){$GLOBALS['JOOMSEF_DEBUG']['CLASS_SEF_JOOMSEF'][$debug_string][$option] = $rows;}
                    if ($database->getErrorNum()) {
                        die($database->stderr());
                    }

                    $title[] = getMenuTitle($option, $task, $Itemid);
                    if (@count($rows) > 0) {
                        $title = array_merge($title, sef_joomsef::getContentTitles('category', $rows[0]->catid));
                        $title[] = !empty($rows[0]->dmname) ? titleToLocation($rows[0]->dmname) : $gid;
                    }
                    $title[] = '/';
                    $task = substr($task, 4);

                    break;
                }
            default:
                {
                    $title[] = getMenuTitle($option, $task);
                    $title[] = '/';
                }
        }

        // Handle nonSef variables
        $nonSefVars = array();
        if (isset($limit))       $nonSefVars['limit'] = $limit;
        if (isset($limitstart))  $nonSefVars['limitstart'] = $limitstart;
        if (isset($dir))         $nonSefVars['dir'] = $dir;
        if (isset($order))       $nonSefVars['order'] = $order;

        $string = sef_joomsef::sefGetLocation($string, $title, $task, @$limit, @$limitstart, @$lang, $nonSefVars);

        return $string;
    }
}
?>
