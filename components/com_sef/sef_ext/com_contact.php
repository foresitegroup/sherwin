<?php
/**
 * Contacts SEF extension for Joomla!
 *
 * @author      $Author: David Jozefov $
 * @copyright   ARTIO s.r.o., http://www.artio.cz
 * @package     JoomSEF
 */

// Security check to ensure this file is being included by a parent file.
if (!defined('_VALID_MOS')) die('Direct Access to this location is not allowed.');

class sefext_com_contact extends sef_joomsef
{
    var $params;
    
    function getCategoryTitle($id) {
        global $database;

        $database->setQuery("SELECT `id`, `title` FROM `#__categories` WHERE `id` = $id");
        $database->loadObject($cat);
        if($cat) {
            $name = ( ($this->params->get('categoryid', '0') != '0') ? $id.'-' : '' ).$cat->title;
            return $name;
        } else {
            return null;
        }
    }

    function getContactName($id) {
        global $database;

        $database->setQuery("SELECT `id`, `name`, `catid` FROM `#__contact_details` WHERE `id` = $id");
        $database->loadObject($contact);
        if($contact) {
            
            $name = ( ($this->params->get('contactid', '0') != '0') ? $id.'-' : '' ).$contact->name;
            
            if( $this->params->get('category', '1') != '1' ) {
                return array( $name );
            } else {
                return array( $this->getCategoryTitle($contact->catid), $name );
            }
        }
        else {
            return array();
        }
    }

    function create($string, &$vars) {
        global $mosConfig_absolute_path;

        // Extract variables
        extract($vars);
        $title = array();
        
        $this->params = SEFTools::getExtParams('com_contact');

        $title[] = getMenuTitle(@$option, @$task, @$Itemid);

        if( isset($catid) ) {
            $title[] = $this->getCategoryTitle($catid);
        }
        if( isset($task) ) {
            if( $task == 'view' ) {
                $title = array_merge( $title, $this->getContactName($contact_id) );
                unset($task);
            }
        }

        if (count($title) > 0) {
            $string = sef_joomsef::sefGetLocation($string, $title, @$task, null, null, @$lang);
        }

        return $string;
    }
}
?>