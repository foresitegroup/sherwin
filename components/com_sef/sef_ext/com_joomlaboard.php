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

class sefext_com_joomlaboard extends sef_joomsef
{
    function create($string, &$vars) {
        extract($vars);

        // JF translate extension.
        global $sefConfig, $mainframe, $database;
        $jfTranslate = $sefConfig->translateNames ? ', `id`' : '';

        $catRewrite = true;
        $msgRewrite = true;

        if ($msgRewrite || $catRewrite) {
            if (file_exists($GLOBALS['mosConfig_absolute_path'].'/components/com_joomlaboard/forum.conf')) {
                $joomlaboardAdminPath = $mainframe->getCfg('absolute_path').'/administrator/components/com_joomlaboard';
                require_once($GLOBALS['mosConfig_absolute_path'].'/components/com_joomlaboard/forum.conf');
            }

            global $message_cat_table_suffix, $message_table_suffix;

            if ($catRewrite && !empty($catid)) {
                $query = "
        		SELECT `name`$jfTranslate
        		FROM `#__$message_cat_table_suffix`
        		WHERE `id` = $catid
        		";
                $database->setQuery($query);
                $catTitle = $database->loadResult();
            }
            if (isset($id)) $msgID = $id;
            elseif (isset($replyto)) $msgID = $replyto;
            else $msgID = null;
            if ($msgRewrite && !empty($msgID)) {
                $query = "
        		SELECT `subject`$jfTranslate
        		FROM `#__$message_table_suffix`
        		WHERE `id` = $msgID
        		";
                $database->setQuery($query);
                $msgTitle = $database->loadResult();
            }
        }

        if (empty($task) && isset($func)) {
            $task = $func;
            unset($vars['func']);
            unset($func);
        }

        // First subdir
        if (!empty($option)) {
            $title[] = getMenuTitle($option, @$task, @$Itemid);
        }

        // Category
        if (!empty($catTitle)) {
            $title[] = $catTitle;
            unset($vars['catid']);
        }

        // Topic
        if (!empty($msgTitle)) {
            $title[] = (!isset($do) && !isset($func)) ? $msgTitle.$sefConfig->suffix : $msgTitle;
            unset($vars['id']);
        }

        // Func and do
        if (isset($do) || isset($func)) {
            if (isset($func)) $oper[] = $func;
            if (isset($do))   $oper[] = $do;
            $title[] = join('-', $oper).$sefConfig->suffix;
        }

        if (count($title) > 0) {
            $string = sef_joomsef::sefGetLocation($string, $title, @$task, @$limit, @$limitstart, @$lang);
        }
        
        return $string;
    }
}
?>
