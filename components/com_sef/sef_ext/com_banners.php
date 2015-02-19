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

class sefext_com_banners extends sef_joomsef
{
    function create($string, &$vars) {
        global $sefConfig, $debug, $debug_string;
        
        extract($vars);
        
        $title[] = 'banners';
        $title[] = '/';
        $title[] = $task.$bid.$sefConfig->suffix;

        if (count($title) > 0) $string = sef_joomsef::sefGetLocation($string, $title, @$this_task, null, null, @$vars['lang']);
        if ($debug) { $GLOBALS['JOOMSEF_DEBUG']['CLASS_SEF_JOOMSEF'][$debug_string]['STRING'] = $string; }
        
        return $string;
    }
}
?>