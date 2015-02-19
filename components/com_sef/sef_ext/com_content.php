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

class sefext_com_content extends sef_joomsef
{
    function beforeCreate($string, &$vars) {
        $params = SEFTools::GetExtParams('com_content');

        // Remove the limitstart and limit variables if they point to the first page
        if( isset($vars['limitstart']) && ($vars['limitstart'] == '0') ) {
            $string = SEFTools::RemoveVariable($string, 'limitstart');
            $string = SEFTools::RemoveVariable($string, 'limit');
        }

        // Try to guess the correct Itemid if set to
        if( $params->get('guessId', '0') != '0' ) {
            if( isset($vars['Itemid']) && isset($vars['id']) ) {
                global $mainframe;
                $string = SEFTools::RemoveVariable($string, 'Itemid');
                $i = $mainframe->getItemid($vars['id']);
                $string .= '&Itemid='.$i;
            }
        }

        return $string;
    }

    function create($string, &$vars) {
        global $sefConfig;

        $params = SEFTools::GetExtParams('com_content');

        extract($vars);

        // Set title.
        $title = array();

        switch (@$task) {
            case 'new': {
                /*
                $title[] = getMenuTitle($option, $task, $Itemid, $string);
                $title[] = 'new' . $sefConfig->suffix;
                */
                break;
            }
            case 'archivecategory':
            case 'archivesection': {
                if (eregi($task.".*id=".$id, $_SERVER['REQUEST_URI'])) break;
            }
            default: {
                if( isset($do_pdf) && ($do_pdf == 1) ) {
                    // Create PDF
                    $title = sef_joomsef::getContentTitles('view', $id);
                    if (count($title) === 0) $title[] = getMenuTitle(@$option, @$task, @$Itemid);

                    $title[] = _CMN_PDF;
                } else {
                    $title = sef_joomsef::getContentTitles($task, $id);
                    if (count($title) === 0) $title[] = getMenuTitle(@$option, @$task, @$Itemid);

                    // Add content ID if set to
                    if( $params->get('titleid', '0') != '0' ) {
                        $i = count($title) - 1;
                        $title[$i] = $id . '-' . $title[$i];
                    }

                    if ((@$task == 'view') && isset($sefConfig->suffix)) {
                        $title[count($title) - 1] .= $sefConfig->suffix;
                    }
                    else {
                        $title[] = '/';
                    }

                    if( isset($limitstart) && (!$sefConfig->appendNonSef || ($params->get('pagination', '0') == '0')) ) {
                        $title[count($title) - 1] .= '-' . ($limitstart+1);
                    }

                    if( isset($pop) && ($pop == 1) ) {
                        // Print article
                        $title[] = _CMN_PRINT. (isset($page) ? '-'.($page+1) : '');
                    }
                }
            }
        }
        if (count($title) > 0) {
            $nonSefVars = array();
            if( $sefConfig->appendNonSef && ($params->get('pagination', '0') != '0') ) {
                if( isset($limit) )         $nonSefVars['limit'] = $limit;
                if( isset($limitstart) )    $nonSefVars['limitstart'] = $limitstart;
            }

            $string = sef_joomsef::sefGetLocation($string, $title, null, null, null, @$lang, $nonSefVars);
        }

        return $string;
    }
}
?>