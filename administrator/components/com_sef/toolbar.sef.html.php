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

/**
* @package JoomSEF
*/
class TOOLBAR_sef
{
    
    function generateButton($icon, $task, $text, $title = null, $href = null)
    {
        if (is_null($title)) $title = $text;
        if (is_null($href))  $href = "index2.php?option=com_sef&task=$task"; 
        
        $image = mosAdminMenus::ImageCheckAdmin($icon, '/administrator/components/com_sef/images/', null, null, $text, $task, 1, 'middle', $title);
       ?>
        <td>
          <a class="toolbar" href="<?php echo $href; ?>">
            <?php echo $image; ?>
            <br /><?php echo $text; ?>
          </a>
        </td>
        <?php        
    }
    
    function upgradeButton()
    {
        $icon = 'upgrade.png';
        $task = 'showupgrade';
        $text = _COM_SEF_UPGRADE;

        TOOLBAR_sef::generateButton($icon, $task, $text);
    }
    
    function installExtButton()
    {
        $icon = 'install.png';
        $task = 'installext';
        $text = _COM_SEF_INSTALL_EXT;
        $title = _COM_SEF_TITLE_INSTALL_EXT;

        TOOLBAR_sef::generateButton($icon, $task, $text, $title);
    }
    
    function unistallExtButton()
    {
        $icon = 'uninstall.png';
        $task = 'uninstallext';
        $text = _COM_SEF_UNINSTALL_EXT;
        $title = _COM_SEF_TITLE_UNINSTALL_EXT;
        $href = "javascript: if (document.adminForm.boxchecked.value == 0){ alert('Please make a selection from the list to delete'); } else if (confirm('Are you sure you want to delete selected items?')){ submitbutton('$task');}";

        TOOLBAR_sef::generateButton($icon, $task, $text, $title, $href);
    }

    function editExtButton()
    {
        $icon = 'edit_f2.png';
        $task = 'editext';
        $text = _COM_SEF_EDIT_EXT;
        $title = _COM_SEF_TITLE_EDIT_EXT;
        $href = "javascript: if (document.adminForm.boxchecked.value == 0){ alert('Please make a selection from the list to edit'); } else { submitbutton('$task');}";

        TOOLBAR_sef::generateButton($icon, $task, $text, $title, $href);
    }
    
    function deleteFilterButton() {
        $icon = 'delete_f2.png';
        $task = 'deletefilter';
        $text = _COM_SEF_DELETE_FILTER;
        $title = _COM_SEF_TITLE_DELETE_FILTER;
        $href = "javascript: if (confirm('"._COM_SEF_DELETE_FILTER_QUESTION."')) { submitbutton('$task'); }";
        
        TOOLBAR_sef::generateButton($icon, $task, $text, $title, $href);
    }
    
    function cleanCacheButton() {
        $icon = 'cancel_f2.png';
        $task = 'cleancache';
        $text = _COM_SEF_CLEAN_CACHE;
        $title = _COM_SEF_TITLE_CLEAN_CACHE;
        $href = "javascript: if (confirm('"._COM_SEF_CLEAN_CACHE_QUESTION."')) { submitbutton('$task'); }";
        
        TOOLBAR_sef::generateButton($icon, $task, $text, $title, $href);
    }
    
    function _NEW()
    {
        mosMenuBar::startTable();
        mosMenuBar::save();
        mosMenuBar::cancel();
        mosMenuBar::spacer();
        mosMenuBar::endTable();
    }

    function _EDIT()
    {
        mosMenuBar::startTable();
        mosMenuBar::save();
        mosMenuBar::cancel();
        mosMenuBar::spacer();
        mosMenuBar::endTable();
    }

    function _CPANEL()
    {
        mosMenuBar::startTable();
        TOOLBAR_sef::cleanCacheButton();
        mosMenuBar::spacer();
        TOOLBAR_sef::installExtButton();
        TOOLBAR_sef::unistallExtButton();
        TOOLBAR_sef::editExtButton();
        mosMenuBar::spacer();
        TOOLBAR_sef::upgradeButton();
        mosMenuBar::back();
        mosMenuBar::spacer();
        mosMenuBar::endTable();
    }

    function _INFO()
    {
        mosMenuBar::startTable();
        mosMenuBar::back();
        mosMenuBar::spacer();
        mosMenuBar::endTable();
    }
    
    function _INSTALL()
    {
        mosMenuBar::startTable();
        TOOLBAR_sef::unistallExtButton();
        mosMenuBar::spacer();
        mosMenuBar::back();
        mosMenuBar::spacer();
        mosMenuBar::endTable();
    }

    function _DEFAULT()
    {
        mosMenuBar::startTable();
        mosMenuBar::addNew();
        mosMenuBar::editList();
        mosMenuBar::deleteList();
        mosMenuBar::spacer();
        TOOLBAR_sef::deleteFilterButton();
        mosMenuBar::spacer();
        mosMenuBar::endTable();
    }

}
?>