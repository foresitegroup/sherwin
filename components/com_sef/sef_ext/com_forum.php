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

class sefext_com_forum extends sef_joomsef
{
    function create($string, &$vars) {
        extract($vars);

        $categoryTitle = true;
        $forumTitle = true;
        $topicTitle = true;

        // Session ID check
        if (strstr($string, 'sid=')) {
            die('Sessionid exists in the url, that should not be!');
        }

        global $sefConfig, $table_prefix, $database;
        // JF translate extension.
        $jfTranslate = $sefConfig->translateNames ? ', `id`' : '';

        if ($forumTitle || $topicTitle || $categoryTitle) {
            if (file_exists($GLOBALS['mosConfig_absolute_path'].'/components/com_forum/config.php')) {
                require_once $GLOBALS['mosConfig_absolute_path'].'/components/com_forum/config.php';
            }

            global $table_prefix;

            if ($categoryTitle && !empty($c)) {
                $query = "
        		SELECT `cat_title`$jfTranslate
        		FROM `".$table_prefix.categories."`
        		WHERE `cat_id` = '$c'
        		";
                $database->setQuery($query);
                $c = $database->loadResult();
            }
            elseif ($forumTitle && !empty($f)) {
                $query = "
        		SELECT `forum_name`$jfTranslate
        		FROM `".$table_prefix.forums."`
        		WHERE `forum_id` = '$f'
        		";
                $database->setQuery($query);
                $f = $database->loadResult();
            }
            elseif ($topicTitle && !empty($t)) {
                $query = "
        		SELECT `topic_title`$jfTranslate
        		FROM `".$table_prefix.topics."`
        		WHERE `topic_id` = '$t'
        		";
                $database->setQuery($query);
                $t = $database->loadResult();
            }
        }

        // First subdir
        if (!empty($option)) {
            $title[] = getMenuTitle($option, @$this_task);
            $title[] = '/';
            unset($vars['option']);
            if (empty($title)) {
                $comp_name = str_replace('com_', '', $option);
                $title = $comp_name;
            }
        }

        // Page
        if (!empty($page)) {
            $title[] = $page;
            $title[] = '/';
            unset($vars['page']);
        }

        // Mode
        if (!empty($mode)) {
            $title[] = $mode;
            $title[] = '/';
            unset($vars['mode']);
        }

        // Search
        if (!empty($search_id)) {
            $title[] = $search_id;
            $title[] = '/';
            unset($vars['search_id']);
        }

        // Category
        if (!empty($c)) {
            $title[] = $c;
            unset($vars['c']);
        }

        // User
        if (!empty($u)) {
            $title[] = $u . $sefConfig->suffix;
            unset($vars['u']);
        }

        // Forum
        if (!empty($f)) {
            $title[] = $f;
            unset($vars['f']);
        }

        // Topic
        if (!empty($t)) {
            $title[] = $t . $sefConfig->suffix;
            unset($vars['t']);
        }

        // Mark
        if (!empty($mark)) {
            $title[] = 'mark';
            $title[] = '/';
            $title[] = $mark . $sefConfig->suffix;
            unset($vars['mark']);
        }

        if (count($title) > 0) $string = sef_joomsef::sefGetLocation($string, $title, null, @$limit, @$limitstart, $vars['lang']);

        return $string;
    }
}
?>
