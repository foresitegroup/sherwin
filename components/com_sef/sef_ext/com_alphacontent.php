<?php
/**
 * SEF module for Joomla!
 * Extension for AlphaContent component.
 * Partial credits to David Thomas.
 *
 * @author      $Author: michal $
 * @copyright   ARTIO s.r.o., http://www.artio.cz
 * @package     JoomSEF
 * @version     $Name$, ($Revision: 4994 $, $Date: 2005-11-03 20:50:05 +0100 (??t, 03 XI 2005) $)
 */

// Security check to ensure this file is being included by a parent file.
if (!defined('_VALID_MOS')) die('Direct Access to this location is not allowed.');

class sefext_com_alphacontent extends sef_joomsef
{
    function create($string, &$vars) {
        global $sefConfig, $database;

        // Use this to get variables from the original Joomla! URL, such as $task, $page, $id, $catID, ...
        extract($vars);
        $title = array();

        $title[] = getMenuTitle(@$option, @$task, @$Itemid);

        if (isset($section)/* && $sefConfig->showSection*/) {
            $sql = "SELECT title, id FROM #__sections WHERE id=".$section;
            $database->setQuery($sql);
            if (($section_name = $database->loadResult())) {
                $title[] = $section_name; //section name
            }
            unset($vars['section']);
        }

        if (isset($cat)/* && $sefConfig->showCat*/) {
            $sql = "SELECT title, id FROM #__categories WHERE id=".$cat;
            $database->setQuery($sql);
            if ($cat_name = $database->loadResult()) {
                $title[] = $cat_name; //category name
            }
            unset($vars['cat']);
        }

        if (isset($id)) {
            $sql = "SELECT title, id FROM #__content WHERE id = $id";
            $database->setQuery($sql);
            if ($cTitle = $database->loadResult()) {
                $title[] = $cTitle; //item title
            }
            unset($vars['id']);
            if ($task == 'view') unset($task);
        }

        // Add letter name.
        if (isset($alpha)) {
            $title[] = $alpha;
        }

        if (count($title) > 0) {
            // Ignore sorting.
            if (isset($vars['sort'])) {
                $string = preg_replace('/[?&]sort=[0-9]+/', '', $string);
                $tmp['sort'] = $vars['sort'];
            }

            $string = sef_joomsef::sefGetLocation($string, $title, @$task, @$limit, @$limitstart, @$lang);

            // Re-append ignored vars.
            if (isset($tmp)) {
                foreach ($tmp as $id => $val) {
                    $string .= (strpos($string, '?') !== false ? '&' : '?').$id.'='.$val;
                }
            }
        }
        
        return $string;
    }
}
?>
