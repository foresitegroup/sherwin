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

// Ensure that user has access to this function.
if (!($acl->acl_check('administration', 'edit', 'users', $my->usertype, 'components', 'all')
| $acl->acl_check('administration', 'edit', 'users', $my->usertype, 'components', 'com_sef'))) {
    mosRedirect('index2.php', _NOT_AUTH);
}

$sefAdminPath = $GLOBALS['mosConfig_absolute_path'].'/administrator/components/com_sef/';

// Get the right language file.
if (file_exists($sefAdminPath.'language/'.$mosConfig_lang.'.php')) {
    include($sefAdminPath.'language/'.$mosConfig_lang.'.php');
}
else {
    include($sefAdminPath.'language/english.php');
}

// Setup paths.
$sef_config_class = $sefAdminPath.'sef.class.php';
$sef_config_file  = $sefAdminPath.'config.sef.php';

require_once($mainframe->getPath('admin_html'));
require_once($mainframe->getPath('class'));

// Make sure class was loaded.
if (!class_exists('SEFConfig')) {
    if (is_readable($sef_config_class)) require_once($sef_config_class);
    else die(_COM_SEF_NOREAD."($sef_config_class)<br />"._COM_SEF_CHK_PERMS);
}

$cid    = mosGetParam($_REQUEST, 'cid', array(0));
$sortby = mosGetParam($_REQUEST, 'sortby', 0);
$section = mosGetParam($_REQUEST, 'section', '');

if (!is_array($cid)) $cid = array($cid);

$sefConfig = new SEFConfig();

// Action switch.
switch ($task) {
    case 'cancel': {
        cancelSEF($option);
        break;
    }
    case 'edit': {
        if( $section == '301' ) {
            edit301($cid[0], $option);
        } else {
            editSEF($cid[0], $option);
        }
        break;
    }
    case 'help': {
        showNavigationBar(_COM_SEF_TITLE_SUPPORT);
        HTML_sef::help();
        break;
    }
    case 'info': {
        showNavigationBar(_COM_SEF_TITLE_INFO);
        include 'components/com_sef/readme.inc.html';
        break;
    }
    case 'new': {
        if( $section == '301' ) {
            edit301(0, $option);
        } else {
            editSEF(0, $option);
        }
        break;
    }
    case 'purge': {
        purge($option, @$ViewModeId);
        break;
    }
    case 'purge301': {
        purge301($option);
        break;
    }
    case 'remove': {
        if( $section == '301' ) {
            remove301($cid, $option);
        } else {
            removeSEF($cid, $option);
        }
        break;
    }
    case 'deletefilter': {
        if( $section == '301' ) {
            removeFiltered301($option);
        } else {
            removeFilteredSEF($option);
        }
        break;
    }
    case 'save': {
        if ($section == 'config') saveConfig();
        elseif ($section == 'sefext') saveExt($option);
        elseif ($section == '301') save301($option);
        else saveSEF($option);
        break;
    }
    case 'saveconfig': {
        saveConfig();
        break;
    }
    case 'showconfig': {
        showNavigationBar(_COM_SEF_TITLE_CONFIG);
        showConfig($option);
        break;
    }
    case 'view': {
        viewSEF($option, @$ViewModeId);
        break;
    }
    case 'view301': {
        view301($option);
        break;
    }
    case 'import_export': {
        showNavigationBar(_COM_SEF_IMPORT_EXPORT);
        HTML_sef::import_export();
        break;
    }
    case 'import': {
        $userfile = mosGetParam($_FILES, 'userfile', null);
        if (!$userfile) {
            echo '<p class="error">ERROR UPLOADING FILE</p>';
            exit();
        }
        else{
            import_custom($userfile);
            break;
        }
    }
    case 'export': {
        export_custom('joomsef_custom_urls.sql');
        break;
    }
    case 'dwnld': {
        $data =  $sefConfig->saveConfig(1);
        $trans_tbl = get_html_translation_table(HTML_ENTITIES);
        $trans_tbl = array_flip($trans_tbl);
        $data =strtr($data, $trans_tbl);
        output_attachment('config.sef.php',$data);
        exit();
    }
    case 'showupgrade': {
        // Shows the form for upgrade source selection (server or local package)
        showNavigationBar(_COM_SEF_TITLE_UPGRADE);
        HTML_sef::show_upgrade();
        break;
    }
    case 'upgrade': {
        // Upgrades JoomSEF from selected source
        //require_once($mosConfig_absolute_path.'/administrator/components/com_installer/installer.class.php');
        //upgrade();
        include_once($sefAdminPath.'installer/upgrade.php');
        break;
    }
    case 'installext': {
        showNavigationBar(_COM_SEF_TITLE_INSTALL_EXT);
        include_once($sefAdminPath.'installer/sefext.php');
        HTML_installer::showInstallForm(_COM_SEF_TITLE_INSTALL_NEW_EXT, $option, 'sef_ext', '', dirname(__FILE__));
        HTML_sefext::showWritable();
        showInstalledExts($option);
        break;
    }
    case 'editext': {
        editExt( $option, $cid[0] );
        break;
    }
    case 'uploadfile':
    case 'installfromdir':
    case 'uninstallext': {
        include_once($sefAdminPath.'installer/installer.php');
        break;
    }
    case 'cleancache': {
        cleanCache($option);
        break;
    }
    default: {
        showNavigationBar();
        include_once($sefAdminPath.'joomsef_cpanel.php');
        include_once($sefAdminPath.'installer/sefext.php');
        echo('<br />');
        showInstalledExts($option);
        include_once($sefAdminPath.'installer/sefpatch.php');
        echo('<br />');
        showInstalledPatches($option);
        break;
    }
}

/**
 * List the records.
 *
 * @param string The current GET/POST option
 * @param int The mode of view 0=
 */
function viewSEF($option, $ViewModeId = 0)
{
    global $database, $mainframe, $mosConfig_list_limit;

    $catid = $mainframe->getUserStateFromRequest("catid{$option}", 'catid', 0);
    $limit = $mainframe->getUserStateFromRequest("viewlistlimit", 'limit', $mosConfig_list_limit);
    $limitstart = $mainframe->getUserStateFromRequest("view{$option}limitstart", 'limitstart', 0);
    $ViewModeId = $mainframe->getUserStateFromRequest("viewmode{$option}", 'viewmode', 3);
    $SortById = $mainframe->getUserStateFromRequest("SortBy{$option}", 'sortby', 0);
    $ComponentFilter = $mainframe->getUserStateFromRequest("ComFilter{$option}", 'comFilter', '');
    $FilterSEF = $mainframe->getUserStateFromRequest("FilterSEF{$option}", 'filterSEF', '');
    $FilterReal = $mainframe->getUserStateFromRequest("FilterReal{$option}", 'filterReal', '');
    $FilterHitsCmp = $mainframe->getUserStateFromRequest("FilterHitsCmp{$option}", 'filterHitsCmp', 0);
    $FilterHitsVal = $mainframe->getUserStateFromRequest("FilterHitsVal{$option}", 'filterHitsVal', '');
    $FilterItemid = $mainframe->getUserStateFromRequest("FilterItemid{$option}", 'filterItemid', '');

    $where = createWhereFilter($option);

    // Make the input boxes for hits filter
    $hitsCmp[] = mosHTML::makeOption('0', '=');
    $hitsCmp[] = mosHTML::makeOption('1', '>');
    $hitsCmp[] = mosHTML::makeOption('2', '<');
    $lists['hitsCmp'] = mosHTML::selectList($hitsCmp, 'filterHitsCmp', "class=\"inputbox\" onchange=\"document.adminForm.submit();\" size=\"1\"" , 'value', 'text', $FilterHitsCmp);
    $lists['hitsVal'] = "<input type=\"text\" name=\"filterHitsVal\" value=\"$FilterHitsVal\" size=\"5\" maxlength=\"10\" onchange=\"document.adminForm.submit();\" />";

    // Make the input box for Itemid filter
    $lists['itemid'] = "<input type=\"text\" name=\"filterItemid\" value=\"$FilterItemid\" size=\"5\" maxlength=\"10\" onchange=\"document.adminForm.submit();\" />";

    // make the select list for the filter
    $viewmode[] = mosHTML::makeOption('3', _COM_SEF_SHOW3);
    $viewmode[] = mosHTML::makeOption('2', _COM_SEF_SHOW2);
    $viewmode[] = mosHTML::makeOption('0', _COM_SEF_SHOW0);
    $viewmode[] = mosHTML::makeOption('4', _COM_SEF_SHOW4);
    $viewmode[] = mosHTML::makeOption('1', _COM_SEF_SHOW1);
    $lists['viewmode'] = mosHTML::selectList($viewmode, 'viewmode', "class=\"inputbox\" onchange=\"document.adminForm.submit();\" size=\"1\"" ,  'value', 'text', $ViewModeId);

    // make the select list for the filter
    $orderby[] = mosHTML::makeOption('0', _COM_SEF_SEFURL._COM_SEF_ASC);
    $orderby[] = mosHTML::makeOption('1', _COM_SEF_SEFURL._COM_SEF_DESC);
    if ($ViewModeId != 1) {
        $orderby[] = mosHTML::makeOption('2', _COM_SEF_REALURL._COM_SEF_ASC);
        $orderby[] = mosHTML::makeOption('3', _COM_SEF_REALURL._COM_SEF_DESC);
    }
    $orderby[] = mosHTML::makeOption('4', _COM_SEF_HITS._COM_SEF_ASC);
    $orderby[] = mosHTML::makeOption('5', _COM_SEF_HITS._COM_SEF_DESC);
    $lists['sortby'] = mosHTML::selectList($orderby, 'sortby', "class=\"inputbox\" onchange=\"document.adminForm.submit();\" size=\"1\"" , 'value', 'text', $SortById);

    // make the select list for the component filter
    $comList[] = mosHTML::makeOption('', _COM_SEF_FILTERCOMPONENTALL);
    $comList[] = mosHTML::makeOption('com_content', 'Content');
    $database->setQuery("SELECT `name`,`option` FROM #__components WHERE parent = 0 ORDER BY `name`");
    $rows = $database->loadObjectList();
    if ($database->getErrorNum()) {
        echo $database->stderr();
        return false;
    }
    foreach(array_keys($rows) as $i) {
        $row = &$rows[$i];
        $comList[] = mosHTML::makeOption( $row->option, $row->name );
    }
    $lists['comList'] = mosHTML::selectList( $comList, 'comFilter', "class=\"inputbox\" onchange=\"document.adminForm.submit();\" size=\"1\"", 'value', 'text', $ComponentFilter);

    // make the filter text boxes
    $lists['filterSEF']  = "<input type=\"text\" name=\"filterSEF\" value=\"$FilterSEF\" size=\"40\" maxlength=\"255\" onchange=\"document.adminForm.submit();\" title=\""._COM_SEF_FILTERSEF_HLP."\" />";
    $lists['filterReal'] = "<input type=\"text\" name=\"filterReal\" value=\"$FilterReal\" size=\"40\" maxlength=\"255\" onchange=\"document.adminForm.submit();\" title=\""._COM_SEF_FILTERREAL_HLP."\" />";

    switch ($SortById) {
        case 1: $sort = "`oldurl` DESC"; break;
        case 2: $sort = "`newurl`"; break;
        case 3: $sort = "`newurl` DESC"; break;
        case 4: $sort = "`cpt`"; break;
        case 5: $sort = "`cpt` DESC"; break;
        default: $sort = "`oldurl`"; break;
    }
    // get the total number of records
    $query = "SELECT count(*) FROM #__redirection WHERE ".$where;

    $database->setQuery($query);
    $total = $database->loadResult();

    require_once($GLOBALS['mosConfig_absolute_path'] . '/administrator/includes/pageNavigation.php');
    $pageNav = new mosPageNav( $total, $limitstart, $limit );

    // get the subset (based on limits) of required records
    $query = "SELECT * FROM #__redirection WHERE ".$where." ORDER BY ".$sort." LIMIT $pageNav->limitstart,$pageNav->limit";
    $database->setQuery($query);
    $rows = $database->loadObjectList();
    if ($database->getErrorNum()) {
        echo $database->stderr();
        return false;
    }

    HTML_sef::viewSEF($rows, $lists, $pageNav, $option, $ViewModeId);
}

/**
 * List the records.
 *
 * @param string The current GET/POST option
 * @param int The mode of view 0=
 */
function view301($option)
{
    global $database, $mainframe, $mosConfig_list_limit;

    $limit = $mainframe->getUserStateFromRequest("viewlistlimit", 'limit', $mosConfig_list_limit);
    $limitstart = $mainframe->getUserStateFromRequest("view{$option}limitstart", 'limitstart', 0);
    $SortById = $mainframe->getUserStateFromRequest("SortBy{$option}", 'sortby', 0);
    $FilterOld = $mainframe->getUserStateFromRequest("FilterOld{$option}", 'filterOld', '');
    $FilterNew = $mainframe->getUserStateFromRequest("FilterNew{$option}", 'filterNew', '');
    $FilterDays = $mainframe->getUserStateFromRequest("FilterDays{$option}", 'filterDays', 0);

    $where = createWhere301($option);

    // Make the input boxes for hits filter
    $lists['filterDays'] = "<input type=\"text\" name=\"filterDays\" value=\"$FilterDays\" size=\"10\" maxlength=\"10\" onchange=\"document.adminForm.submit();\" />";

    // make the select list for the filter
    $orderby[] = mosHTML::makeOption('0', _COM_SEF_301OLDURL._COM_SEF_ASC);
    $orderby[] = mosHTML::makeOption('1', _COM_SEF_301OLDURL._COM_SEF_DESC);
    $orderby[] = mosHTML::makeOption('2', _COM_SEF_301NEWURL._COM_SEF_ASC);
    $orderby[] = mosHTML::makeOption('3', _COM_SEF_301NEWURL._COM_SEF_DESC);
    $orderby[] = mosHTML::makeOption('4', _COM_SEF_DAYS._COM_SEF_ASC);
    $orderby[] = mosHTML::makeOption('5', _COM_SEF_DAYS._COM_SEF_DESC);
    $lists['sortby'] = mosHTML::selectList($orderby, 'sortby', "class=\"inputbox\" onchange=\"document.adminForm.submit();\" size=\"1\"" , 'value', 'text', $SortById);

    // make the filter text boxes
    $lists['filterOld'] = "<input type=\"text\" name=\"filterOld\" value=\"$FilterOld\" size=\"40\" maxlength=\"255\" onchange=\"document.adminForm.submit();\" title=\""._COM_SEF_FILTEROLD_HLP."\" />";
    $lists['filterNew'] = "<input type=\"text\" name=\"filterNew\" value=\"$FilterNew\" size=\"40\" maxlength=\"255\" onchange=\"document.adminForm.submit();\" title=\""._COM_SEF_FILTERNEW_HLP."\" />";

    switch ($SortById) {
        case 1: $sort = "`old` DESC"; break;
        case 2: $sort = "`new`"; break;
        case 3: $sort = "`new` DESC"; break;
        case 4: $sort = "`lastHit` DESC"; break;
        case 5: $sort = "`lastHit`"; break;
        default: $sort = "`old`"; break;
    }
    // get the total number of records
    $query = "SELECT count(*) FROM #__sefmoved ".($where != '' ? 'WHERE '.$where : '');

    $database->setQuery($query);
    $total = $database->loadResult();

    require_once($GLOBALS['mosConfig_absolute_path'] . '/administrator/includes/pageNavigation.php');
    $pageNav = new mosPageNav( $total, $limitstart, $limit );

    // get the subset (based on limits) of required records
    $query = "SELECT * FROM #__sefmoved ".($where != '' ? 'WHERE '.$where : '')." ORDER BY ".$sort." LIMIT $pageNav->limitstart,$pageNav->limit";
    $database->setQuery($query);
    $rows = $database->loadObjectList();
    if ($database->getErrorNum()) {
        echo $database->stderr();
        return false;
    }

    HTML_sef::view301($rows, $lists, $pageNav, $option);
}

/**
* Creates the WHERE clause for filtering of displayed URLs
* @param string The current GET/POST option
*/
function createWhereFilter($option) {
    global $mainframe;

    $ViewModeId = $mainframe->getUserStateFromRequest("viewmode{$option}", 'viewmode', 3);
    $ComponentFilter = $mainframe->getUserStateFromRequest("ComFilter{$option}", 'comFilter', '');
    $FilterSEF = $mainframe->getUserStateFromRequest("FilterSEF{$option}", 'filterSEF', '');
    $FilterReal = $mainframe->getUserStateFromRequest("FilterReal{$option}", 'filterReal', '');
    $FilterHitsCmp = $mainframe->getUserStateFromRequest("FilterHitsCmp{$option}", 'filterHitsCmp', 0);
    $FilterHitsVal = $mainframe->getUserStateFromRequest("FilterHitsVal{$option}", 'filterHitsVal', '');
    $FilterItemid = $mainframe->getUserStateFromRequest("FilterItemid{$option}", 'filterItemid', '');

    // Filter ViewMode
    if ($ViewModeId == 1) {
        $where = "`dateadd` > '0000-00-00' AND `newurl` = '' ";
    } elseif ( $ViewModeId == 2 ) {
        $where = "`dateadd` > '0000-00-00' AND `newurl` != '' ";
    } elseif ( $ViewModeId == 0 ) {
        $where = "`dateadd` = '0000-00-00' ";
    } elseif ( $ViewModeId == 4 ) {
        $where = "(`newurl` != '') AND (`oldurl` = '' OR `newurl` LIKE '%option=com_frontpage%') ";
    } else {
        $where = "`newurl` != '' ";
    }

    // Filter URLs
    if ($ComponentFilter != '' && $ViewModeId != 1)
    $where .= "AND (`newurl` LIKE '%option=$ComponentFilter&%' OR `newurl` LIKE '%option=$ComponentFilter') ";
    if ($FilterSEF != '')
    $where .= "AND `oldurl` LIKE '%$FilterSEF%' ";
    if ($FilterReal != '' && $ViewModeId != 1)
    $where .= "AND `newurl` LIKE '%$FilterReal%' ";

    // Filter hits
    if( $FilterHitsVal != '' ) {
        $cmp = ($FilterHitsCmp == 0) ? '=' : (($FilterHitsCmp == 1) ? '>' : '<');
        $where .= "AND `cpt` $cmp $FilterHitsVal ";
    }

    // Filter Itemid
    if( $FilterItemid != '' && $ViewModeId != 1 ) {
        $where .= "AND `Itemid` = $FilterItemid ";
    }

    return $where;
}

/**
* Creates the WHERE clause for filtering of displayed URLs
* @param string The current GET/POST option
*/
function createWhere301($option) {
    global $mainframe;

    $FilterOld = $mainframe->getUserStateFromRequest("FilterOld{$option}", 'filterOld', '');
    $FilterNew = $mainframe->getUserStateFromRequest("FilterNew{$option}", 'filterNew', '');
    $FilterDays = $mainframe->getUserStateFromRequest("FilterDays{$option}", 'filterDays', 0);

    $where = '';

    // Filter URLs
    if( $FilterOld != '' )  $where .= ($where != '' ? 'AND ' : '') . "`old` LIKE '%$FilterOld%' ";
    if( $FilterNew != '' )  $where .= ($where != '' ? 'AND ' : '') . "`new` LIKE '%$FilterNew%' ";
    if( $FilterDays != '' ) $where .= ($where != '' ? 'AND ' : '') . "`lastHit` < DATE_SUB(NOW(), INTERVAL '$FilterDays' DAY) ";

    return $where;
}

/**
 * Creates a new or edits and existing user record.
 *
 * @param int The id of the user, 0 if a new entry
 * @param string The current GET/POST option
 */
function editSEF($id, $option)
{
    global $database, $my, $mainframe;

    $LinkTypeId = $mainframe->getUserStateFromRequest("linktype{$option}",   'linktype',   0);
    $SectionId  = $mainframe->getUserStateFromRequest("sectionid{$option}",  'sectionid',  0);
    $CategoryId = $mainframe->getUserStateFromRequest("categoryid{$option}", 'categoryid', 0);
    $ContentId  = $mainframe->getUserStateFromRequest("contentid{$option}",  'contentid',  0);

    $row = new mosSEF($database);
    // load the row from the db table
    $row->load($id);

    if ($id) {
        // do stuff for existing records
        if ($row->dateadd != '0000-00-00') $row->dateadd = date('Y-m-d');
    }
    else {
        // do stuff for new records
        $row->dateadd = date('Y-m-d');
    }
    $linktype[] = mosHTML::makeOption('0', 'Content');
    $linktype[] = mosHTML::makeOption('1', 'Component');
    $lists['linktype'] = mosHTML::selectList( $linktype, 'linktype', "class=\"inputbox\"  onchange=\"document.buildLinkForm.submit();\" size=\"1\"" , 'value', 'text', $LinkTypeId );
    $lists['linktype'] = mosHTML::selectList( $linktype, 'linktype', "class=\"inputbox\"  onchange=\"document.buildLinkForm.submit();\" size=\"1\"" , 'value', 'text', $LinkTypeId );

    switch ($LinkTypeId) {
        case 0: {
            // content

            // build section list
            $database->setQuery( "SELECT `id`,`title` FROM #__sections");
            $sections = $database->loadObjectList();
            $options = array(  mosHTML::makeOption( 0, "(static content)"));
            foreach($sections as $section) {

                $options[] = mosHTML::makeOption( $section->id, $section->title );
            }
            $lists['sections'] = mosHTML::selectList($options, 'sectionid', 'class="inputbox" onchange="document.buildLinkForm.submit();" size="1"', 'value', 'text', $SectionId);

            // build category list
            if ($SectionId) {
                $database->setQuery( "SELECT `id`,`title` FROM #__categories WHERE `section`='".$SectionId."'");
                $cats = $database->loadObjectList();
                $options = array(  mosHTML::makeOption( 0, "(NONE)")  );
                $options[] =  mosHTML::makeOption( -1, "(section)");
                $options[] =  mosHTML::makeOption( -2, "(blog section)");
                foreach($cats as $cat) {
                    $options[] = mosHTML::makeOption( $cat->id, $cat->title );
                }
                $lists['cats'] = mosHTML::selectList($options, 'categoryid', 'class="inputbox" onchange="document.buildLinkForm.submit();" size="1"', 'value', 'text', $CategoryId);
            }
            else $CategoryId = 0;

            $sql = "SELECT `id`,`title` FROM #__content WHERE ((`sectionid`='".$SectionId."') AND (`catid`='".$CategoryId."'))";
            $database->setQuery($sql);
            $items = $database->loadObjectList();
            $options = array(mosHTML::makeOption( 0, '(NONE)'));
            if ($SectionId) {
                $options[] = mosHTML::makeOption( "-1", "(category)");
                $options[] = mosHTML::makeOption( "-2", "(blog category)");
            }

            foreach($items as $item) {
                $options[] = mosHTML::makeOption( $item->id, $item->title );
            }
            $lists['content'] = mosHTML::selectList( $options, 'contentid', 'class="inputbox" onchange="document.buildLinkForm.submit();" size="1"', 'value', 'text', $ContentId );
            $database->setQuery( $sql );
            // needed to reduce queries used by getItemid
            $bs = $mainframe->getBlogSectionCount();
            $bc = $mainframe->getBlogCategoryCount();
            $gbs = $mainframe->getGlobalBlogSectionCount();
            $Itemid = $mainframe->getItemid( $ContentId, ($SectionId == 0), 0, $bs, $bc, $gbs );
            $this_link = "index.php?option=com_content&task=";
            $lists['msg'] = '';

            switch ($CategoryId) {
                case -2: {
                    $this_link .= "blogsection&id=$SectionId";
                    break;
                }
                case -1: {
                    $this_link .= "section&id=$SectionId";
                    $database->setQuery("SELECT `id` FROM #__menu WHERE (`link` like '%".$this_link."%')");
                    $result = $database->loadResult();
                    if (is_numeric($result)){
                        $this_link .= "&Itemid=$result";
                    } else {
                        $this_link .= "&Itemid=$Itemid";
                        $lists['msg'] = _COM_SEF_INVALID_URL;
                    }
                    break;
                }
                default: {
                    switch ($ContentId) {
                        case -2: {
                            $this_link .= "blogsection&id=$SectionId";
                            break;
                        }
                        case -1: {
                            $database->setQuery("SELECT `id` FROM #__menu WHERE (`link` like '%".$this_link."section&id=$SectionId%')");
                            $result = $database->loadResult();
                            $this_link .= "category&sectionid=$SectionId&id=$CategoryId";
                            if (is_numeric($result)) {
                                $this_link .= "&Itemid=$result";
                            }
                            else {
                                $this_link .= "&Itemid=$Itemid";
                                $lists['msg'] = _COM_SEF_INVALID_URL;
                            }
                            break;
                        }
                        default: {
                            $this_link = "index.php?option=com_content&task=view&id=$ContentId&Itemid=$Itemid";
                        }
                    }
                }
                $lists['this_link'] = $this_link;
            }
            break;
        }
        case 1: // component
        break;
    }
    HTML_sef::editSEF($row, $lists, $option);
}

/**
 * Creates a new or edits and existing user record.
 *
 * @param int The id of the user, 0 if a new entry
 * @param string The current GET/POST option
 */
function edit301($id, $option)
{
    global $database, $my, $mainframe;

    $row = new mosMoved($database);
    // load the row from the db table
    $row->load($id);

    HTML_sef::edit301($row, $lists, $option);
}

/**
* Saves the record from an edit form submit.
*
* @param string The current GET/POST option
*/
function saveSEF($option)
{
    global $database, $my;

    $row = new mosSEF($database);
    if (!$row->bind($_POST)) {
        echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
        exit();
    }

    // pre-save checks
    if (!$row->check()) {
        echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
        exit();
    }

    // save the changes
    if (!$row->store()) {
        echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
        exit();
    }

    // Check if there's old url to save to Moved Permanently table
    if( isset($_POST['unchanged']) && ($_POST['unchanged'] != '') ) {
        $row = new mosMoved($database);
        $row->old = $_POST['unchanged'];
        $row->new = $_POST['oldurl'];

        // pre-save checks
        if (!$row->check()) {
            echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
            exit();
        }

        // save the changes
        if (!$row->store()) {
            echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
            exit();
        }
    }

    mosRedirect('index2.php?option='.$option.'&task=view');
}

/**
* Saves the record from an edit form submit.
*
* @param string The current GET/POST option
*/
function save301($option)
{
    global $database, $my;

    $row = new mosMoved($database);
    if (!$row->bind($_POST)) {
        echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
        exit();
    }

    // pre-save checks
    if (!$row->check()) {
        echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
        exit();
    }

    // save the changes
    if (!$row->store()) {
        echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
        exit();
    }

    mosRedirect('index2.php?option='.$option.'&task=view301');
}

/**
* Removes records
* @param array An array of id keys to remove
* @param string The current GET/POST option
*/
function removeSEF(&$cid, $option)
{
    global $database;

    if (!is_array($cid) || count( $cid ) < 1) {
        echo "<script> alert('"._COM_SEF_SELECT_DELETE."'); window.history.go(-1);</script>\n";
        exit;
    }

    if (count($cid)) {
        $cids = implode(',', $cid);
        $query = "DELETE FROM #__redirection"
        . "\n WHERE id IN ($cids)"
        ;
        $database->setQuery($query);
        if (!$database->query()) {
            echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
        }
    }
    mosRedirect( 'index2.php?option='.$option.'&task=view' );
}

/**
* Removes records
* @param array An array of id keys to remove
* @param string The current GET/POST option
*/
function remove301(&$cid, $option)
{
    global $database;

    if (!is_array($cid) || count( $cid ) < 1) {
        echo "<script> alert('"._COM_SEF_SELECT_DELETE."'); window.history.go(-1);</script>\n";
        exit;
    }

    if (count($cid)) {
        $cids = implode(',', $cid);
        $query = "DELETE FROM #__sefmoved"
        . "\n WHERE id IN ($cids)"
        ;
        $database->setQuery($query);
        if (!$database->query()) {
            echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
        }
    }
    mosRedirect( 'index2.php?option='.$option.'&task=view301' );
}

/**
* Removes all URLs matching selected filters
* @param string The current GET/POST option
*/
function removeFilteredSEF($option) {
    global $database;

    $where = createWhereFilter($option);

    $query = "DELETE FROM `#__redirection` WHERE ".$where;
    $database->setQuery($query);
    if (!$database->query()) {
        echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
    }

    mosRedirect( 'index2.php?option='.$option.'&task=view' );
}

/**
* Removes all URLs matching selected filters
* @param string The current GET/POST option
*/
function removeFiltered301($option) {
    global $database;

    $where = createWhere301($option);

    $query = "DELETE FROM `#__sefmoved` ".($where != '' ? 'WHERE '.$where : '');
    $database->setQuery($query);
    if (!$database->query()) {
        echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
    }

    mosRedirect( 'index2.php?option='.$option.'&task=view301' );
}

/**
* Cancels an edit operation
* @param string The current GET/POST option
*/
function cancelSEF( $option )
{
    global $database;

    if ($_POST['section'] == "config" || $_POST['section'] == "sefext") {
        mosRedirect('index2.php?option='.$option);
    }
    elseif ($_POST['section'] == "301") {
        mosRedirect('index2.php?option='.$option.'&task=view301');
    }
    else {
        mosRedirect('index2.php?option='.$option.'&task=view');
    }
}

function showConfig($option)
{
    global $sefConfig, $sef_config_file;
    global $database;

    $std_opt = 'class="inputbox" size="2"';

    $lists['enabled']       = mosHTML::yesnoRadioList('enabled',        $std_opt, $sefConfig->enabled);
    $lists['lowerCase']     = mosHTML::yesnoRadioList('lowerCase',      $std_opt, $sefConfig->lowerCase);
    $lists['showSection']   = mosHTML::yesnoRadioList('showSection',    $std_opt, $sefConfig->showSection);
    $lists['showCat']       = mosHTML::yesnoRadioList('showCat',        $std_opt, $sefConfig->showCat);
    $lists['disableNewSEF'] = mosHTML::yesnoRadioList('disableNewSEF',  $std_opt, $sefConfig->disableNewSEF);
    $lists['dontRemoveSid'] = mosHTML::yesnoRadioList('dontRemoveSid',  $std_opt, $sefConfig->dontRemoveSid);

    // lang placement
    $langPlacement[] = mosHTML::makeOption(_COM_SEF_LANG_PATH,   _COM_SEF_LANG_PATH_TXT);
    $langPlacement[] = mosHTML::makeOption(_COM_SEF_LANG_SUFFIX, _COM_SEF_LANG_SUFFIX_TXT);
    $langPlacement[] = mosHTML::makeOption(_COM_SEF_LANG_DOMAIN, _COM_SEF_LANG_DOMAIN_TXT);
    $langPlacement[] = mosHTML::makeOption(_COM_SEF_LANG_NONE,   _COM_SEF_LANG_NONE_TXT);
    $lists['langPlacement'] = mosHTML::radioList($langPlacement, 'langPlacement', $std_opt, $sefConfig->langPlacement);
    //$lists['langToPath']    = mosHTML::yesnoRadioList('langToPath',  $std_opt, $sefConfig->langToPath);

    // language domains
    $database->setQuery("SELECT `id`, `name` FROM `#__languages` WHERE `active`='1' ORDER BY `ordering`");
    $langs = $database->loadObjectList();
    if( @count(@$langs) ) {
        foreach($langs as $lang) {
            $langlist[] = '<td>'.$lang->name.':</td><td><input type="text" name="langDomain['.$lang->id.']" size="45" class="inputbox" value="'.(isset($sefConfig->langDomain[$lang->id]) ? $sefConfig->langDomain[$lang->id] : $GLOBALS['mosConfig_live_site']).'" /></td>';
        }
        $lists['langDomains'] = '<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr>'. implode('</tr><tr>', $langlist) .'</tr></table>';
    }

    $lists['record404']      = mosHTML::yesnoRadioList('record404',      $std_opt, $sefConfig->record404);
    $lists['nonSefRedirect'] = mosHTML::yesnoRadioList('nonSefRedirect', $std_opt, $sefConfig->nonSefRedirect);
    $lists['useMoved']       = mosHTML::yesnoRadioList('useMoved',       $std_opt, $sefConfig->useMoved);
    $lists['useMovedAsk']    = mosHTML::yesnoRadioList('useMovedAsk',    $std_opt, $sefConfig->useMovedAsk);
    $lists['alwaysUseLang']  = mosHTML::yesnoRadioList('alwaysUseLang',  $std_opt, $sefConfig->alwaysUseLang);
    $lists['translateNames'] = mosHTML::yesnoRadioList('translateNames', $std_opt, $sefConfig->translateNames);
    $lists['excludeSource']  = mosHTML::yesnoRadioList('excludeSource',  $std_opt, $sefConfig->excludeSource);
    $lists['reappendSource'] = mosHTML::yesnoRadioList('reappendSource', $std_opt, $sefConfig->reappendSource);
    $lists['ignoreSource']   = mosHTML::yesnoRadioList('ignoreSource',   $std_opt, $sefConfig->ignoreSource);
    $lists['appendNonSef']   = mosHTML::yesnoRadioList('appendNonSef',   $std_opt, $sefConfig->appendNonSef);
    $lists['transitSlash']   = mosHTML::yesnoRadioList('transitSlash',   $std_opt, $sefConfig->transitSlash);
    $lists['useCache']       = mosHTML::yesnoRadioList('useCache',       $std_opt, $sefConfig->useCache);
    $lists['cacheSize']      = '<input type="text" name="cacheSize" size="10" class="inputbox" value="'.$sefConfig->cacheSize.'" />';
    $lists['cacheMinHits']      = '<input type="text" name="cacheMinHits" size="10" class="inputbox" value="'.$sefConfig->cacheMinHits.'" />';
    //$lists['useAlias']       = mosHTML::yesnoRadioList('useAlias', $std_opt, $sefConfig->useAlias);

    if ($sefConfig->useAlias == 0) {
        $fulltitle = 'checked="checked"';
        $titlealias = '';
    }
    else {
        $titlealias = 'checked="checked"';
        $fulltitle = '';
    }
    $lists['useAlias'] =  '
		<input type="radio" name="useAlias" value="0" class="inputbox"'.$fulltitle.'size="2" />'._COM_SEF_FULL_TITLE.'
		<input type="radio" name="useAlias" value="1" class="inputbox"'.$titlealias.'size="2" />'._COM_SEF_TITLE_ALIAS.'
	';

    // get a list of the static content items for 404 page
    $query = "SELECT id, title"
    ."\n FROM #__content"
    ."\n WHERE sectionid = 0 AND title != '404'"
    ."\n AND catid = 0"
    ."\n ORDER BY ordering"
    ;

    $database->setQuery( $query );
    $items = $database->loadObjectList();

    $options = array(mosHTML::makeOption(0, '('._COM_SEF_DEF_404_PAGE.')'));
    $options[] = mosHTML::makeOption(9999999, '(Front Page)');

    // assemble menu items to the array
    foreach ( $items as $item ) {
        $options[] = mosHTML::makeOption($item->id, $item->title);
    }

    $lists['page404'] = mosHTML::selectList( $options, 'page404', 'class="inputbox" size="1"', 'value', 'text', $sefConfig->page404 );
    $sql='SELECT id,introtext FROM #__content WHERE `title`="404"';
    $row = null;
    $database->setQuery($sql);
    $database->loadObject($row);

    $txt404 = isset($row->introtext) ? $row->introtext : _COM_SEF_DEF_404_MSG;

    // get list of installed components for advanced config
    $installed_components = $undefined_components = array();
    $sql = 'SELECT SUBSTRING(link,8) AS name FROM #__components WHERE CHAR_LENGTH(link) > 0 ORDER BY name';
    $database->setQuery($sql);
    $installed_components = $database->loadResultArray();
    $undefined_components= array_values(array_diff($installed_components,array_intersect($sefConfig->predefined, $installed_components)));

    // build mode list and create the list
    $mode = array();
    $mode[] = mosHTML::makeOption(0, _COM_SEF_USE_DEFAULT);
    $mode[] = mosHTML::makeOption(1, _COM_SEF_NOCACHE);
    $mode[] = mosHTML::makeOption(2, _COM_SEF_SKIP);

    $database->setQuery("SELECT file, title FROM #__sefexts");
    $titles = $database->loadAssocList('file');

    while (list($index, $name) = each($undefined_components)) {
        // List of handlers
        $selectedmode = ((in_array($name, $sefConfig->nocache)) * 1) + ((in_array($name, $sefConfig->skip)) * 2);
        $lists['adv_config'][$name] = mosHTML::selectList( $mode, $name, 'class="inputbox" size="1"', 'value', 'text', $selectedmode);

        // List of titles
        $title = isset($titles[$name.'.xml']['title']) ? $titles[$name.'.xml']['title'] : '';
        $lists['titles'][$name] = '<input type="text" name="title['.$name.']" size="40" class="inputbox" value="'.$title.'" />';
        
        // List of menu title checkboxes
        $checked = in_array($name, $sefConfig->dontShowTitle);
        $lists['dontshow'][$name] = '<input type="checkbox" name="dontshow['.$name.']" class="inputbox" '.($checked ? 'checked="checked" ' : '').'/>';
    }

    HTML_sef::configuration($lists, $txt404);
}

function advancedConfig($key,$value)
{
    global $sefConfig;

    $debug = 0;

    if ((strpos($key, 'com_')) !== false) {
        if ($debug) echo "<p class='error'>FOUND COMPONENT:$key</p>";
        switch ($value) {
            case 1: {
                array_push($sefConfig->nocache, $key);
                break;
            }
            case 2: {
                array_push($sefConfig->skip, $key);
                break;
            }
        }
    }
    if ($debug) echo "<br>KEY=$key:VALUE=$value:";

}

function saveConfig()
{
    global $database, $sefConfig, $sef_config_file;

    $debug = 0;

    //set skip and nocache arrays
    $sefConfig->skip = array();
    $sefConfig->nocache = array();
    foreach($_POST as $key => $value) {
        $sefConfig->set($key, $value);
        advancedConfig($key, $value);
    }

    // Save extensions not to show the menu titles in URL
    $sefConfig->dontShowTitle = array();
    if( isset($_POST['dontshow']) && is_array($_POST['dontshow']) ) {
        foreach(array_keys($_POST['dontshow']) as $name) {
            array_push($sefConfig->dontShowTitle, $name);
        }
    }
    
    $sql = 'SELECT id  FROM #__content WHERE `title` = "404"';
    $database->setQuery( $sql );

    $introtext = (get_magic_quotes_gpc() ? $_POST['introtext'] : addslashes($_POST['introtext']));
    if ($id = $database->loadResult()){
        $sql = 'UPDATE #__content SET introtext="'.$introtext.'",  modified ="'.date("Y-m-d H:i:s").'" WHERE `id` = "'.$id.'";';
    }
    else {
        $sql='SELECT MAX(id)  FROM #__content';
        $database->setQuery($sql);
        if ($max = $database->loadResult()) {
            $max++;
            $sql = 'INSERT INTO #__content VALUES( "'.$max.'", "404", "404", "'.$introtext.'", "", "1", "0", "0", "0", "2004-11-11 12:44:38", "62", "", "'.date("Y-m-d H:i:s").'", "0", "62", "2004-11-11 12:45:09", "2004-10-17 00:00:00", "0000-00-00 00:00:00", "", "", "menu_image=-1\nitem_title=0\npageclass_sfx=\nback_button=\nrating=0\nauthor=0\ncreatedate=0\nmodifydate=0\npdf=0\nprint=0\nemail=0", "1", "0", "0", "", "", "0", "750");';
        }
    }

    $database->setQuery( $sql );
    if (!$database->query()) {
        echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
    }

    // Save the extension titles
    if( isset($_POST['title']) && is_array($_POST['title']) ) {
        foreach($_POST['title'] as $name => $title) {
            $file = $name.'.xml';
            $row = null;
            $database->setQuery("SELECT file, title FROM #__sefexts WHERE file = '$file'");
            $database->loadObject($row);

            if(!$row) {
                $database->setQuery("INSERT INTO #__sefexts (file, title) VALUES ('$file', '$title')");
                if(!$database->query()) {
                    echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
                }
            }
            elseif( $row->title != $title ) {
                $database->setQuery("UPDATE #__sefexts SET title = '$title' WHERE file = '$file'");
                if(!$database->query()) {
                    echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
                }
            }
        }
    }

    if (is_writable($sef_config_file)) {
        $purge = isset($_POST['purge']) ? $_POST['purge'] : "0";

        $config_written = $sefConfig->saveConfig(0, $purge);
        //die("config_written:$config_written");
        if($config_written != 0) {
            if ($debug) {
                echo"<div align='left'><pre>CONFIG:";
                print_r($sefConfig);
                echo "<br />POST:";
                print_r($_POST);
                die("</pre></div>");
            }
            mosRedirect('index2.php?option=com_sef', _COM_SEF_CONFIG_UPDATED );
        } else mosRedirect('index2.php?option=com_sef&task=dwnld', _COM_SEF_WRITE_ERROR);
    } else mosRedirect('index2.php?option=com_sef&task=dwnld', _COM_SEF_WRITE_ERROR);
}

function purge($option, $ViewModeId = 0)
{
    global $database, $mainframe;

    $ViewModeId = $mainframe->getUserStateFromRequest( "viewmode{$option}", 'viewmode', 0 );
    $SortById = $mainframe->getUserStateFromRequest( "SortBy{$option}", 'sortby', 0 );
    $confirmed = mosGetParam( $_REQUEST, 'confirmed', 0 );

    switch ($ViewModeId) {
        case '1': {
            $where = "`dateadd` > '0000-00-00' and `newurl` = '' ";
            break;
        }
        case '2': {
            $where = "`dateadd` > '0000-00-00' and `newurl` != '' ";
            break;
        }
        default: {
            $where = "`dateadd` = '0000-00-00'";
            break;
        }
    }

    if ( $confirmed == "Proceed") {
        $query = "DELETE FROM #__redirection WHERE ".$where;
        $database->setQuery( $query );
        if (!$database->query()) {
            echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
        }
        else $message = _COM_SEF_SUCCESSPURGE;
    }
    else {
        // get the total number of records
        $query = "SELECT count(*) FROM #__redirection WHERE ".$where;
        $database->setQuery( $query );
        $total = $database->loadResult();
        if (!$database->query()) {
            echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
        }
        switch ($total) {
            case '0'; {
                $message = _COM_SEF_NORECORDS;
                break;
            }
            case '1'; {
                $message = _COM_SEF_WARNDELETE.$total._COM_SEF_RECORD;
                break;
            }
            default: {
                $message = _COM_SEF_WARNDELETE.$total._COM_SEF_RECORDS;
            }
        }
    }
    
    // Clean the cache
    cleanCache('com_sef', false);
    
    HTML_sef::purge($option, $message, $confirmed);
}

function purge301($option)
{
    global $database;

    $query = "DELETE FROM `#__sefmoved`";
    $database->setQuery( $query );
    if (!$database->query()) {
        echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
    }
    else $message = _COM_SEF_SUCCESSPURGE;

    HTML_sef::purge($option, $message, '');
}

function backup_custom()
{
    global $database;

    $SQL = array();

    $table = $GLOBALS['mosConfig_dbprefix']."redirection";
    $query ="SELECT * FROM `$table` WHERE (`dateadd` > '0000-00-00' and `newurl` != '' )";
    $database->setQuery( $query );
    if ($rows = $database->loadRowList()) {
        foreach ($rows as $row) {
            $fields = "''";
            for ($i = 1; $i < 12; $i++) {
                $fields .= ",'".$row[$i]."'";
            }
            $SQL[] = "INSERT INTO `$table` (id, cpt, oldurl, newurl, Itemid, metadesc, metakey, metatitle, metalang, metarobots, metagoogle, dateadd) VALUES(".$fields.");\n";
        }
    }
    else die(_COM_SEF_NOACCESS.$table);
    return $SQL;
}

function output_attachment($filename,&$data)
{
    if (!headers_sent()) {
        header ('Expires: 0');
        header ('Last-Modified: '.gmdate ('D, d M Y H:i:s', time()) . ' GMT');
        header ('Pragma: public');
        header ('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header ('Accept-Ranges: bytes');
        header ('Content-Length: ' . strlen($data));
        header ('Content-Type: Application/octet-stream');
        header ('Content-Disposition: attachment; filename="' . $filename . '"');
        header ('Connection: close');
        ob_end_clean(); //flush the mambo stuff from the ouput buffer
        print $data; // and send the sql
        die();
    }
    else die(_COM_SEF_FATAL_ERROR_HEADERS);
}

function export_custom($filename)
{
    global $database;

    $sql_data = backup_custom();
    $sql_data = implode("\r\n", $sql_data);
    if (!headers_sent()) {
        while (ob_get_level() > 0) {
            ob_end_clean(); //flush the mambo stuff from the ouput buffer
        }

        // Determine Browser
        if (ereg( 'MSIE ([0-9].[0-9]{1,2})', $_SERVER["HTTP_USER_AGENT"], $log_version)) {
            $BROWSER_VER=$log_version[1];
            $BROWSER_AGENT='IE';
        } elseif (ereg( 'Opera ([0-9].[0-9]{1,2})', $_SERVER["HTTP_USER_AGENT"], $log_version)) {
            $BROWSER_VER=$log_version[1];
            $BROWSER_AGENT='OPERA';
        } elseif (ereg( 'Mozilla/([0-9].[0-9]{1,2})', $_SERVER["HTTP_USER_AGENT"], $log_version)) {
            $BROWSER_VER=$log_version[1];
            $BROWSER_AGENT='MOZILLA';
        } else {
            $BROWSER_VER=0;
            $BROWSER_AGENT='OTHER';
        }
        ob_start();
        header ('Expires: 0');
        header ('Last-Modified: '.gmdate ('D, d M Y H:i:s', time()) . ' GMT');
        header ('Pragma: public');
        header ('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header ('Accept-Ranges: bytes');
        header ('Content-Length: ' . strlen($sql_data));
        header ('Content-Type: Application/octet-stream');
        header ('Content-Disposition: attachment; filename="' . $filename . '"');
        header ('Connection: close');

        echo($sql_data);

        ob_end_flush();
        die();
    }
    else{
        echo "Error! Not Good!";
        die(""._COM_SEF_FATAL_ERROR_HEADERS);
    }
}



function import_custom($userfile)
{
    global $database;

    $uploaddir  = $GLOBALS['mosConfig_absolute_path'].'/media/';
    $uploadfile = $uploaddir.basename($userfile['name']);

    if (move_uploaded_file($userfile['tmp_name'], $uploadfile)) {
        echo '<p class="message">'._COM_SEF_UPLOAD_OK.'</p>';
        $result = true;
        $lines = file($uploadfile);

        $command = "INSERT INTO `".$GLOBALS['mosConfig_dbprefix']."redirection`";
        for ($i = 0; $i < count($lines); $i++) {
            // Trim line
            $line = trim($lines[$i]);
            // Ignore empty lines
            if (strlen($line) == 0) continue;

            // If the query continues at the next line.
            while (substr($line, -1) != ';' && $i + 1 < count($lines)) {
                $i++;
                $newLine = trim($lines[$i]);
                if (strlen($newLine) == 0) continue;
                $line .= ' '.$lines[$i];
            }

            if (preg_match('/^INSERT INTO `?(\w)+redirection`?/', $line) > 0) {
                // Fix for files exported from versions older than 1.3.0
                if (strstr($line, "redirection` VALUES") != false) {
                    $line = str_replace("redirection` VALUES", "redirection` (id, cpt, oldurl, newurl, dateadd) VALUES", $line);
                }

                // Fix for files exported from versions prior to 2.0.0
                if( stristr($line, "newurl, Itemid") == false ) {
                    $url = preg_replace('/.*VALUES\s*\(\'[^\']*\',\s*\'[^\']*\',\s*\'[^\']*\',\s*\'([^\']*)\'.*/', '$1', $line);
                    $itemid = preg_replace('/.*[&?]Itemid=([^&]*).*/', '$1', $url);
                    
                    $newurl = eregi_replace("Itemid=[^&]*", '', $url);
                    $newurl = trim($newurl, '&?');
                    $trans = array( '&&' => '&', '?&' => '?' );
                    $newurl = strtr($newurl, $trans);
                    
                    $line = str_replace('newurl,', 'newurl, Itemid,', $line);
                    $line = str_replace("'$url'", "'$newurl','$itemid'", $line);
                }

                $database->setQuery($line);
                if (!$database->query()) {
                    echo("<p class='error'>"._COM_SEF_ERROR_IMPORT."<pre>$line</pre></p>");
                    $result = false;
                    echo ($database->getErrorMsg());
                }
            }
            else echo("<p class='error'>"._COM_SEF_IGNORE_SQL.substr($line, 0, 40)."</p>");
        }

        unlink($uploadfile) OR die("<p class='error'>"._COM_SEF_NO_UNLINK."</p>");
        if ($result) echo('<p class="message">'._COM_SEF_IMPORT_OK.'</p>');
		?>
		<form><input type="button" value="<?php echo _COM_SEF_PROCEED; ?>" onClick="javascript:location.href='index2.php?option=com_sef&task=view&viewmode=2'"></form>
		<?php
    }
    else {
        echo "<p class='error'>"._COM_SEF_WRITE_FAILED."</p>";
        $result = false;
    }

    return $result;
}

function editExt($option, $id) {
    global $database, $my, $mainframe;
    global $mosConfig_absolute_path;

    $lists 	= array();
    $row 	= new mosExt($database);

    // load the row from the db table
    if( !$row->load( $id ) ) {
        $row->file = $id;
        $row->title = '';
        $row->params = '';
    }

    // XML library
    require_once( $mosConfig_absolute_path . '/includes/domit/xml_domit_lite_include.php' );
    // xml file for module
    $xmlfile = $mosConfig_absolute_path . '/components/com_sef/sef_ext/' . $row->file;
    $xmlDoc = new DOMIT_Lite_Document();
    $xmlDoc->resolveErrors( true );
    if ($xmlDoc->loadXML( $xmlfile, false, true )) {
        $root = &$xmlDoc->documentElement;
        if ($root->getTagName() == 'mosinstall' && $root->getAttribute( 'type' ) == 'sef_ext' ) {
            $element = &$root->getElementsByPath( 'description', 1 );
            $row->description = $element ? trim( $element->getText() ) : '';
            $element = &$root->getElementsByPath( 'name', 1 );
            $row->name = $element ? trim( $element->getText() ) : '';
            $element = &$root->getElementsByPath( 'version', '1.0.0');
            $row->version = $element ? trim( $element->getText() ) : '';

            // get params definitions
            $element = &$root->getElementsByPath( 'params', 1);
            if( is_object($element) ) {
                $path = $mosConfig_absolute_path . "/components/com_sef/sef_ext/$row->file";
                if (!file_exists( $path )) {
                    $path = '';
                }
                $params = new mosParameters( $row->params, $path, 'sef_ext' );
            }
            else {
                $params = null;
            }
        }
    }

    HTML_sef::editExt($row, $lists, $params, $option);
}

/**
* Saves the module after an edit form submit
*/
function saveExt( $option ) {
    global $database;

    $params = mosGetParam( $_POST, 'params', '' );
    if (is_array( $params )) {
        $txt = array();
        foreach ($params as $k=>$v) {
            $txt[] = "$k=$v";
        }

        $_POST['params'] = mosParameters::textareaHandling( $txt );
    }

    $row = new mosExt( $database );
    if (!$row->bind( $_POST )) {
        echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
        exit();
    }
    if (!$row->check()) {
        echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
        exit();
    }
    if (!$row->store()) {
        echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
        exit();
    }

    $msg = 'Successfully Saved Extension';
    mosRedirect( 'index2.php?option='. $option, $msg );
}

// Recursively deletes directory and all of its contents
/*function deldir( $dir ) {
$current_dir = opendir( $dir );
$old_umask = umask(0);
while ($entryname = readdir( $current_dir )) {
if ($entryname != '.' and $entryname != '..') {
if (is_dir( $dir . $entryname )) {
deldir( mosPathName( $dir . $entryname ) );
} else {
@chmod($dir . $entryname, 0777);
unlink( $dir . $entryname );
}
}
}
umask($old_umask);
closedir( $current_dir );
return rmdir( $dir );
}*/

function cleanCache($option, $redirect = true) {
    global $mosConfig_absolute_path;

    $file = $mosConfig_absolute_path.'/components/com_sef/cache/cache.php';

    if( file_exists($file) ) {
        @unlink($file);
    }

    if( $redirect ) {
        mosRedirect( 'index2.php?option='.$option, _COM_SEF_CACHECLEANED );
    }
}

function showNavigationBar($moduleName = '')
{
  ?>
    <div style="text-align: left;">
    <strong><a href="index2.php?option=com_sef">JoomSEF</a><?php $moduleName != '' ? print(" / $moduleName") : ''; ?></strong>
    </div>
  <?php
}
?>
