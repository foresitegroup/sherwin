<?php
/**
 * SEF module for Joomla!
 * Extension for Mosets Tree component.
 *
 * @author      $Author: michal $
 * @copyright   ARTIO s.r.o., http://www.artio.cz
 * @package     JoomSEF
 * @version     $Name$, ($Revision: 4994 $, $Date: 2005-11-03 20:50:05 +0100 (??t, 03 XI 2005) $)
 */

// Security check to ensure this file is being included by a parent file.
if (!defined('_VALID_MOS')) die('Direct Access to this location is not allowed.');

class sefext_com_mtree extends sef_joomsef
{
    /**
     * Helper function to get parent and sub category tree array for building URL
     */
    function mtree_sef_get_category_array(&$db, $cat_id)
    {
        static $tree = false;
        if (!$tree){
            $db->setQuery("SELECT cat_name, cat_id, cat_parent FROM #__mt_cats");
            $tree = $db->loadObjectList('cat_id');
        }
        $title = array();
        while ($cat_id != 0) {
            $title[] = $tree[$cat_id]->cat_name;
            $cat_id = $tree[$cat_id]->cat_parent;
        }
        
        return array_reverse($title);
    }

    function mtree_sef_get_category_name(&$db, $cat_id) {
        $db->setQuery("SELECT cat_name, cat_id FROM #__mt_cats WHERE cat_id = $cat_id");
        $cat = null;
        $db->loadObject($cat);
        return (isset($cat->cat_name) ? $cat->cat_name : '');
    }

    function getUserName($id) {
        global $database;

        $database->setQuery( "SELECT `username` FROM `#__users` WHERE `id` = '$id' AND `block` = '0'" );
        $username = $database->loadResult();
        return $username;
    }

    function create($string, &$vars) {
        global $database;

        // Load the texts to use in URL
        $texts = SEFTools::getExtTexts('com_mtree');

        // Create an associative array for task => url_text conversion
        $tasks = array();
        $tasks['mypage'] = $texts['_MT_SEF_MYPAGE'];
        $tasks['listfeatured'] = $texts['_MT_SEF_FEATUREDLISTING'];
        $tasks['listnew'] = $texts['_MT_SEF_NEWLISTING'];
        $tasks['listupdated'] = $texts['_MT_SEF_RECENTLYUPDATED'];
        $tasks['listfavourite'] = $texts['_MT_SEF_MOSTFAVOURED'];
        $tasks['listpopular'] = $texts['_MT_SEF_POPULARLISTING'];
        $tasks['listmostrated'] = $texts['_MT_SEF_MOSTRATEDLISTING'];
        $tasks['listtoprated'] = $texts['_MT_SEF_TOPRATEDLISTING'];
        $tasks['listmostreview'] = $texts['_MT_SEF_MOSTREVIEWEDLISTING'];

        $tasks['viewimage'] = $texts['_MT_SEF_IMAGE'];
        $tasks['advsearch2'] = $texts['_MT_SEF_ADVSEARCH2'];
        $tasks['advsearch'] = $texts['_MT_SEF_ADVSEARCH'];
        $tasks['viewowner'] = $texts['_MT_SEF_OWNER'];
        $tasks['viewusersreview'] = $texts['_MT_SEF_REVIEWS'];
        $tasks['viewusersfav'] = $texts['_MT_SEF_FAVOURITES'];
        $tasks['viewgallery'] = $texts['_MT_SEF_GALLERY'];
        $tasks['replyreview'] = $texts['_MT_SEF_REPLYREVIEW'];
        $tasks['reportreview'] = $texts['_MT_SEF_REPORTREVIEW'];
        $tasks['writereview'] = $texts['_MT_SEF_REVIEW'];
        $tasks['rate'] = $texts['_MT_SEF_RATE'];
        $tasks['recommend'] = $texts['_MT_SEF_RECOMMEND'];
        $tasks['contact'] = $texts['_MT_SEF_CONTACT'];
        $tasks['report'] = $texts['_MT_SEF_REPORT'];
        $tasks['claim'] = $texts['_MT_SEF_CLAIM'];
        $tasks['visit'] = $texts['_MT_SEF_VISIT'];
        $tasks['deletelisting'] = $texts['_MT_SEF_DELETE'];
        $tasks['addlisting'] = $texts['_MT_SEF_ADDLISTING'];
        $tasks['addcategory'] = $texts['_MT_SEF_ADDCATEGORY'];
        $tasks['search'] = $texts['_MT_SEF_SEARCH'];

        $params = SEFTools::getExtParams('com_mtree');

        /**
         * Use this to get variables from the original Joomla! URL, such as $task, $page, $id, $catID, ...
         */
        extract($vars);
        $title = array();

        $title[] = getMenuTitle(@$option, @$task, @$Itemid);


        /**
         * find cat_id for link_id
         */
        if (!isset($cat_id) && isset($link_id)) {
            // get category tree (parent cat and sub cats)
            $sql = "SELECT cat_id FROM #__mt_cl WHERE link_id=".$link_id;
            $database->setQuery($sql);
            $cat_id = $database->loadResult();
        }

        /**
         * Get category tree (parent cat and sub cats).
         */
        $categories = $params->get('categories', '2');
        if (isset($cat_id) && $cat_id != 0) {
            if( $categories != '0' ) {
                // Remove the component menu title if set to
                if( $params->get('addtitle', '1') != '1' ) {
                    array_shift($title);
                }

                if( $categories == '1' ) {
                    $title[] = $this->mtree_sef_get_category_name($database, $cat_id);
                } else {
                    $title = array_merge($title, $this->mtree_sef_get_category_array($database, $cat_id));
                }
            }
            unset($vars['cat_id']);
        }

        /**
         * Get info for recommend, contact and viewlink links.
         */
        if (isset($link_id)) {
            // get link name (company name)
            $sql  = "SELECT link_name FROM #__mt_links WHERE link_id=".$link_id;
            $database->setQuery($sql);
            if ($link_name = $database->loadResult()) {
                $title[] = $link_name;
            }
            unset($vars['link_id']);
        }

        /**
         * Alphabetical search / filter (a, b, c, d, etc...)
         */
        if (@$task == 'listalpha' && isset($start)) {
            $title[] = $start;
            unset($vars['start']);
            unset($task);
        }
        /**
         * Remove the 'listcats.html' url ending. Change it to index.html
         */
        elseif (@$task == 'listcats') {
            unset($task);
        }

        // Remove the viewlink.html ending if set to
        if( (@$task == 'viewlink') && ($params->get('viewlink', '0') == '0') ) {
            unset($task);
        }

        if( isset($task) && in_array($task, array_keys($tasks)) ) {
            $title[] = $tasks[$task];

            switch( $task ) {
                case 'viewimage': {
                    if( isset($img_id) ) {
                        $title[] = $img_id;
                    }
                    break;
                }

                case 'viewowner':
                case 'viewusersreview':
                case 'viewusersfav': {
                    if( isset($user_id) ) {
                        $title[] = $this->getUserName($user_id);
                    }
                    break;
                }

                case 'replyreview':
                case 'reportreview': {
                    if( isset($rev_id) ) {
                        $title[] = $rev_id;
                    }
                    break;
                }

            }

            unset($task);
        }

        /**
         * Pass the title array to the sefGetLocation function.
         */ 
        if (count($title) > 0) {
            $nonSefVars = array();
            if( isset($search_id) )     $nonSefVars['search_id'] = $search_id;
            if( isset($limit) )         $nonSefVars['limit'] = $limit;
            if( isset($limitstart) )    $nonSefVars['limitstart'] = $limitstart;
            if( isset($searchword) )    $nonSefVars['searchword'] = $searchword;

            $string = sef_joomsef::sefGetLocation($string, $title, @$task, @$limit, @$limitstart, @$lang, $nonSefVars);
        }

        return $string;
    }
}
?>
