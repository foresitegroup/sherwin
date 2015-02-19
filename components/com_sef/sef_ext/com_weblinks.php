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

class sefext_com_weblinks extends sef_joomsef
{
    function create($string, &$vars) {
        // JF translate extension.
        global $sefConfig, $debug, $debug_string, $database;
        $jfTranslate = $sefConfig->translateNames ? ', `id`' : '';

        extract($vars);
        
        if ((empty($this_task)) && (@$task == 'view')) {
            $database->setQuery("SELECT `title`$jfTranslate FROM #__weblinks WHERE id = '$id'");
            $rows = $database->loadObjectList();

            if ($debug) $GLOBALS['JOOMSEF_DEBUG']['CLASS_SEF_JOOMSEF'][$debug_string][$option] = $rows;

            if ($database->getErrorNum()) die( $database->stderr());
            elseif (@count($rows) > 0 && !empty($rows[0]->title)) {
                $this_task = titleToLocation($rows[0]->title);
            }
        }

        $title = array();
        $title[] = getMenuTitle($option, @$this_task);
        $title[] = '/';

        $arg2 = array();
        if (isset($catid)) {
            $arg2[] = sef_joomsef::getCategories($catid);
        }
        $title = array_merge($title, $arg2);

        if (isset($task) && $task == 'new') {
            $title[] = 'new'.$sefConfig->suffix;
        }

        if (count($title) > 0) $string = sef_joomsef::sefGetLocation($string, $title, @$this_task, null, null, @$vars['lang']);
        if ($debug) $GLOBALS['JOOMSEF_DEBUG']['CLASS_SEF_JOOMSEF'][$debug_string]['STRING'] = $string;
        
        return $string;
    }
}
?>