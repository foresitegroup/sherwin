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

class sefext_com_newsfeeds extends sef_joomsef
{
    function create($string, &$vars) {
        extract($vars);
        
        // JF translate extension.
        global $sefConfig, $debug, $debug_string, $database;
        $jfTranslate = $sefConfig->translateNames ? ', `id`' : '';

        if (empty($cat_table)) $cat_table = "#__categories";
        if (empty($this_task) && @$task == "view") {
            $database->setQuery("SELECT `name`$jfTranslate FROM #__newsfeeds WHERE id = '$feedid'");
            $rows = $database->loadObjectList();

            if ($debug) $GLOBALS['JOOMSEF_DEBUG']['CLASS_SEF_JOOMSEF'][$debug_string][$option] = $rows;

            if ($database->getErrorNum()) die($database->stderr());
            elseif (@count($rows) > 0 && !empty($rows[0]->name)) {
                $this_task = titleToLocation($rows[0]->name);
            }
        }

        $title[] = getMenuTitle($option, @$this_task);
        if (isset($catid)) $title[] = sef_joomsef::getCategories($catid);
        $title[] = '/';

        if (isset($task) && $task == 'new') {
            $title[] = 'new'.$sefConfig->suffix;
        }

        if (count($title) > 0) $string = sef_joomsef::sefGetLocation($string, $title, @$this_task, null, null, @$vars['lang']);
        if ($debug) { $GLOBALS['JOOMSEF_DEBUG']['CLASS_SEF_JOOMSEF'][$debug_string]['STRING'] = $string; }
        
        return $string;
    }
}
?>