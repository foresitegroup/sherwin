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

class sefext_com_search extends sef_joomsef
{
    function create($string, &$vars) {
        extract($vars);
        
        if (!(isset($task) ? @$task : null)) {
            $title[] = getMenuTitle($option, (isset($task) ? @$task : null));
            if (count($title) > 0) {
                $nonSefVars = array();
                if (isset($ordering))       $nonSefVars['ordering']     = $ordering;
                if (isset($searchphrase))   $nonSefVars['searchphrase'] = $searchphrase;
                if (isset($searchword))     $nonSefVars['searchword']   = $searchword;
                if (isset($submit))         $nonSefVars['submit']       = $submit;

                $string = sef_joomsef::sefGetLocation($string, $title, null, null, null, @$vars['lang'], $nonSefVars);
            }
        }
        
        return $string;
    }
}
?>