<?php
/**
 * ReMOSitory SEF extension for Joomla!
 *
 * @author      $Author: David Jozefov $
 * @copyright   ARTIO s.r.o., http://www.artio.cz
 * @package     JoomSEF
 * @version     $Name$, ($Revision: 4994 $, $Date: 2005-11-03 20:50:05 +0100 (??t, 03 XI 2005) $)
 */

// Security check to ensure this file is being included by a parent file.
if (!defined('_VALID_MOS')) die('Direct Access to this location is not allowed.');

class sefext_com_remository extends sef_joomsef
{
    function GetContainers($id) {
        global $database;

        $params = SEFTools::getExtParams('com_remository');
        $cats = $params->get('categories', '2');
        $catid = $params->get('categoryid', '0');
        
        $containers = array();
        
        if($cats == '0')    $id = 0;    // If chosen to not add categories to URL at all
        while ($id > 0) {
            $database->setQuery("SELECT `name`, `parentid` FROM `#__downloads_containers` WHERE `id` = $id");
            $row = $database->loadRow();
            
            $name = ($catid != '0' ? $id.'-' : '').$row[0];
            array_unshift ($containers, $name);
            
            $id = $row[1];
            if($cats == '1')    break;  // If chosen to add only the last category to URL
        }
        return $containers;
    }

    // Returns path to given file id
    function GetFilePath($id) {
        global $database;

        $database->setQuery("SELECT `filetitle`, `containerid` FROM `#__downloads_files` WHERE `id` = $id");
        $row = $database->loadRow();
        $path = $this->GetContainers($row[1]);
        
        $params = SEFTools::getExtParams('com_remository');
        $fileid = $params->get('fileid', '0');
        
        $name = ($fileid != '0' ? $id.'-' : '').$row[0];
        array_push($path, $name);

        return $path;
    }

    function create($string, &$vars) {
        global $mosConfig_absolute_path, $mosConfig_lang, $mosConfig_sitename, $mosConfig_live_site;

        require_once($mosConfig_absolute_path.'/components/com_remository/com_remository_settings.php');
        if( file_exists($mosConfig_absolute_path.'/components/com_remository/language/'.$mosConfig_lang.'.php') )
        require_once($mosConfig_absolute_path.'/components/com_remository/language/'.$mosConfig_lang.'.php');
        if( ($mosConfig_lang != 'english') && file_exists($mosConfig_absolute_path.'/components/com_remository/language/english.php') )
        require_once($mosConfig_absolute_path.'/components/com_remository/language/english.php');

        // Extract variables
        extract($vars);
        $title = array();

        $title[] = getMenuTitle(@$option, @$task, @$Itemid);

        if( isset($func) ) {
            switch( $func ) {
                case 'select':
                    if( isset($id) )
                    $title = array_merge($title, $this->GetContainers($id));
                    break;

                case 'addfile':
                    if( isset($id) )
                    $title = array_merge($title, $this->GetContainers($id));
                    $title[] = _SUBMIT_FILE_BUTTON;
                    break;

                case 'search':
                    $title[] = _DOWN_SEARCH;
                    break;

                case 'addmanyfiles':
                    $title[] = _DOWN_ADD_NUMBER_FILES;
                    break;

                case 'fileinfo':
                    if( isset($id) )
                    $title = array_merge($title, $this->GetFilePath($id));
                    break;

                case 'thumbupdate':
                    if( isset($id) )
                    $title = array_merge($title, $this->GetFilePath($id));
                    $title[] = _DOWN_UPDATE_THUMBNAILS;
                    break;

                case 'userupdate':
                    if( isset($id) )
                    $title = array_merge($title, $this->GetFilePath($id));
                    $title[] = _DOWN_UPDATE_SUB;
                    break;

                case 'rss':
                    if( isset($id) )
                    $title = array_merge($title, $this->GetContainers($id));
                    $title[] = 'rss';
                    break;

                case 'download':
                    if( isset($id) )
                    $title = array_merge($title, $this->GetFilePath($id));
                    $title[] = 'get';
                    break;

                case 'startdown':
                    if( isset($id) )
                    $title = array_merge($title, $this->GetFilePath($id));
                    $title[] = _DOWNLOAD;
                    break;
                    
                case 'showdown':
                case 'finishdown':
                    return $string;
            }
        }

        if (count($title) > 0) {
            $nonSefVars = array();
            if( isset($orderby) ) $nonSefVars['orderby'] = $orderby;
            if( isset($no_html) ) $nonSefVars['no_html'] = $no_html;
            if( isset($chk) ) $nonSefVars['chk'] = $chk;
            if( isset($fname) ) $nonSefVars['fname'] = $fname;
            $string = sef_joomsef::sefGetLocation($string, $title, @$task, @$limit, @$limitstart, @$lang, $nonSefVars);
        }

        return $string;
    }
}
?>