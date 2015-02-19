<?php
/**
 * SOBI2 SEF extension for Joomla!
 *
 * @author      $Author: David Jozefov $
 * @copyright   ARTIO s.r.o., http://www.artio.cz
 * @package     JoomSEF
 */

// Security check to ensure this file is being included by a parent file.
if (!defined('_VALID_MOS')) die('Direct Access to this location is not allowed.');

class sefext_com_glossary extends sef_joomsef
{
    var $params;
    
    // Returns term for given id
    function GetTerm($id) {
        global $database;

        $database->setQuery("SELECT `tterm`, `tletter` FROM `#__glossary` WHERE `id` = $id");
        $row = null;
        $database->loadObject($row);
        
        if( $this->params->get('letter', '0') != '0' ) {
            return array($row->tletter, $row->tterm);
        } else {
            return array($row->tterm);
        }
    }
    
    function GetLetter($term) {
        global $database;
        
        if( $this->params->get('letter', '0') != '0' ) {
            $database->setQuery("SELECT `tletter` FROM `#__glossary` WHERE `tterm` = '$term'");
            return $database->loadResult();
        } else {
            return null;
        }
    }

    function create($string, &$vars) {
        global $sefConfig;

        $this->params = SEFTools::getExtParams('com_glossary');
        
        // Extract variables
        extract($vars);
        $title = array();

        $title[] = getMenuTitle(@$option, @$task, @$Itemid);

        if( isset($func) ) {
            switch($func) {
                case 'display':
                    if( isset($search) ) {
                        // We don't want to save every search URL in the database
                        return;
                    }
                    if( isset($letter) )  $title[] = $letter;
                    if( isset($page) && !$sefConfig->appendNonSef )  $title[] = $page;
                    break;

                case 'view':
                    if( isset($term) )  $title = array_merge( $title, array($this->GetLetter($term), $term) );
                    break;

                case 'comment':
                case 'delete':
                    $title = array_merge( $title, $this->GetTerm($id) );
                    $title[] = $func;
                    break;

                case 'submit':
                    if( isset($id) ) {
                        $title = array_merge( $title, $this->GetTerm($id) );
                        $title[] = 'edit';
                    }
                    else {
                        $title[] = $letter;
                        $title[] = 'submit';
                    }
                    break;
            }
        }

        if (count($title) > 0) {
            $nonSefVars = array();
            if( isset($page) ) $nonSefVars['page'] = $page;
            $string = sef_joomsef::sefGetLocation($string, $title, @$task, @$limit, @$limitstart, @$lang, $nonSefVars);
        }
        
        return $string;
    }
}
?>