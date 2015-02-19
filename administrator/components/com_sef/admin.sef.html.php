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
class HTML_sef
{

    function configuration(&$lists, $txt404)
    {
        global $sefConfig, $sef_config_file;
	?>
		<table class="adminheading">
		<tr><th>
		<?php
		echo _COM_SEF_TITLE_CONFIG.(file_exists($sef_config_file) ? (is_writable($sef_config_file) ? _COM_SEF_WRITEABLE : _COM_SEF_UNWRITEABLE) : _COM_SEF_USING_DEFAULT)
		?>
		<br/><font class="small" align="left"><a href="index2.php?option=com_sef"><?php echo _COM_SEF_BACK?></a></font>
		</th></tr>
		</table>
		<?php if (!$GLOBALS['mosConfig_sef']) {
		    echo _COM_SEF_DISABLED;
		}
		$x = 0;
	       	?>
	        <div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
	        <script language="Javascript" src="<?php echo $GLOBALS['mosConfig_live_site']; ?>/includes/js/overlib_mini.js"></script>
	        <script language="Javascript">
	        function submitbutton(pressbutton) {
	            if (pressbutton == 'save') {
	                var purge = confirm("<?php echo _COM_SEF_PURGE_URLS; ?>");
	                if (purge) document.getElementById("purge").value = "1";
	            }

	            <?php getEditorContents( 'editor1', 'introtext') ; ?>
	            submitform(pressbutton);
	        }
	        //-->
					</script>
	    <form action="index2.php?option=com_sef&task=saveconfig" method="post" name="adminForm" id="adminForm">
        <table class="adminform">
	        <tr>
	            <th colspan="4"><?php echo _COM_SEF_TITLE_BASIC; ?></th>
	        </tr>
	        <?php //Dit zit hier niet goed; ?>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_ENABLED;?>?</td>
	            <td width="100"><?php echo $lists['enabled'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_ENABLED,_COM_SEF_ENABLED);?></td>
	            <td rowspan="15" valign="top" align="right"><b>
	             <?php echo _COM_SEF_DEF_404_PAGE;?></b><br/><br/>
			<?php
			// parameters : areaname, content, hidden field, width, height, cols, rows
			editorArea('editor1', $txt404, 'introtext', '450', '150', '50', '11');
			?>
	            </td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_DISABLENEWSEF;?></td>
	            <td width="100"><?php echo $lists['disableNewSEF']; ?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_DISABLENEWSEF,_COM_SEF_DISABLENEWSEF);?></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_REPLACE_CHAR;?></td>
	            <td width="100"><input type="text" name="replacement" value="<?php echo $sefConfig->replacement;?>" size="1" maxlength="1"></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_REPLACE_CHAR,_COM_SEF_REPLACE_CHAR);?></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_PAGEREP_CHAR;?></td>
	            <td width="100"><input type="text" name="pagerep" value="<?php echo $sefConfig->pagerep;?>" size="1" maxlength="1"></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_PAGEREP_CHAR,_COM_SEF_PAGEREP_CHAR);?></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_STRIP_CHAR;?></td>
	            <td width="100"><input type="text" name="stripthese" value="<?php echo $sefConfig->stripthese;?>" size="60" maxlength="255"></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_STRIP_CHAR,_COM_SEF_STRIP_CHAR);?></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_FRIENDTRIM_CHAR;?></td>
	            <td width="100"><input type="text" name="friendlytrim" value="<?php echo $sefConfig->friendlytrim;?>" size="60" maxlength="255"></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_FRIENDTRIM_CHAR,_COM_SEF_FRIENDTRIM_CHAR);?></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_USE_ALIAS;?>?</td>
	            <td width="100"><?php echo $lists['useAlias'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_USE_ALIAS,_COM_SEF_USE_ALIAS);?></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SUFFIX;?></td>
	            <td width="100"><input type="text" name="suffix" value="<?php echo $sefConfig->suffix; ?>" size="6" maxlength="6"></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SUFFIX,_COM_SEF_SUFFIX);?></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_ADDFILE;?></td>
	            <td width="100"><input type="text" name="addFile" value="<?php echo $sefConfig->addFile; ?>" size="60" maxlength="60"></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_ADDFILE,_COM_SEF_ADDFILE);?></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_PAGETEXT;?></td>
	            <td width="100"><input type="text" name="pagetext" value="<?php echo $sefConfig->pagetext; ?>" size="10" maxlength="20"></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_PAGETEXT,_COM_SEF_PAGETEXT);?></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_LOWER;?>?</td>
	            <td width="100"><?php echo $lists['lowerCase'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_LOWER,_COM_SEF_LOWER);?></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SHOW_SECT;?>?</td>
	            <td width="100"><?php echo $lists['showSection'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SHOW_SECT, _COM_SEF_SHOW_SECT);?></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SHOW_CAT;?>?</td>
	            <td width="100"><?php echo $lists['showCat'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_HIDE_CAT, _COM_SEF_SHOW_CAT);?></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_404PAGE;?></td>
	            <td width="100"><?php echo $lists['page404'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_404PAGE, _COM_SEF_404PAGE);?></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_RECORD_404;?></td>
	            <td width="100"><?php echo $lists['record404'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_RECORD_404, _COM_SEF_RECORD_404);?></td>
	            <td></td>                
	        </tr>
	        <tr>
	            <th colspan="4"><?php echo _COM_SEF_TITLE_ADV_CONF;?></th>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_REPLACEMENTS;?></td>
	            <td width="100"><textarea name="replacements" cols="60" rows="5"><?php echo $sefConfig->replacements;?></textarea></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_REPLACEMENTS, _COM_SEF_REPLACEMENTS);?></td>
	            <td></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_EXCLUDE_SOURCE;?></td>
	            <td width="100"><?php echo $lists['excludeSource'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_EXCLUDE_SOURCE, _COM_SEF_EXCLUDE_SOURCE);?></td>
	            <td></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_REAPPEND_SOURCE;?></td>
	            <td width="100"><?php echo $lists['reappendSource'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_REAPPEND_SOURCE, _COM_SEF_REAPPEND_SOURCE);?></td>
	            <td></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_IGNORE_SOURCE;?></td>
	            <td width="100"><?php echo $lists['ignoreSource'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_IGNORE_SOURCE, _COM_SEF_IGNORE_SOURCE);?></td>
	            <td></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_APPEND_NONSEF;?></td>
	            <td width="100"><?php echo $lists['appendNonSef'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_APPEND_NONSEF, _COM_SEF_APPEND_NONSEF);?></td>
	            <td></td>                
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_TRANSIT_SLASH;?></td>
	            <td width="100"><?php echo $lists['transitSlash'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_TRANSIT_SLASH, _COM_SEF_TRANSIT_SLASH);?></td>
	            <td></td>                
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_NONSEFREDIRECT;?></td>
	            <td width="100"><?php echo $lists['nonSefRedirect'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_NONSEFREDIRECT, _COM_SEF_NONSEFREDIRECT);?></td>
	            <td></td>                
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_USEMOVED;?></td>
	            <td width="100"><?php echo $lists['useMoved'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_USEMOVED, _COM_SEF_USEMOVED);?></td>
	            <td></td>                
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_USEMOVEDASK;?></td>
	            <td width="100"><?php echo $lists['useMovedAsk'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_USEMOVEDASK, _COM_SEF_USEMOVEDASK);?></td>
	            <td></td>                
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_DONTREMOVESID;?></td>
	            <td width="100"><?php echo $lists['dontRemoveSid'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_DONTREMOVESID, _COM_SEF_DONTREMOVESID);?></td>
	            <td></td>                
	        </tr>
	        <tr>
	           <th colspan="4"><?php echo _COM_SEF_CACHE_CONF;?></th>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_USE_CACHE;?></td>
	            <td width="100"><?php echo $lists['useCache'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_USE_CACHE, _COM_SEF_USE_CACHE);?></td>
	            <td></td>                
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_CACHE_SIZE;?></td>
	            <td width="100"><?php echo $lists['cacheSize'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_CACHE_SIZE, _COM_SEF_CACHE_SIZE);?></td>
	            <td></td>                
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_CACHE_MINHITS;?></td>
	            <td width="100"><?php echo $lists['cacheMinHits'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_CACHE_MINHITS, _COM_SEF_CACHE_MINHITS);?></td>
	            <td></td>                
	        </tr>
<?php if (is_dir($GLOBALS['mosConfig_absolute_path'] .'/components/com_joomfish')) { ?>
	        <tr>
	            <th colspan="4"><?php echo _COM_SEF_JOOMFISH_CONF;?></th>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_JF_LANG_PLACEMENT;?></td>
	            <td width="100"><?php echo $lists['langPlacement'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_JF_LANG_PLACEMENT, _COM_SEF_JF_LANG_PLACEMENT);?></td>
	            <td></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_JF_ALWAYS_USE_LANG;?></td>
	            <td width="100"><?php echo $lists['alwaysUseLang'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_JF_ALWAYS_USE_LANG, _COM_SEF_JF_ALWAYS_USE_LANG);?></td>
	            <td></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_JF_TRANSLATE;?></td>
	            <td width="100"><?php echo $lists['translateNames'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_JF_TRANSLATE, _COM_SEF_JF_TRANSLATE);?></td>
	            <td></td>
	        </tr>
	        <?php
	        if( isset($lists['langDomains']) ) {
	            ?>
        	    <tr<?php $x++; echo (($x %2) ? '':' class="row1"' ); ?>>
        	        <td width="200" valign="top"><?php echo _COM_SEF_JF_DOMAIN; ?></td>
        	        <td width="100"><?php echo $lists['langDomains']; ?></td>
        	        <td valign="top"><?php echo mosToolTip(_COM_SEF_TT_JF_DOMAIN, _COM_SEF_JF_DOMAIN);?></td>
        	        <td></td>	            
        	    </tr>
        	    <?php
	        }
	        ?>
<?php } ?>
    </table>
    <table class="adminform">
	        <tr>
	            <th><?php echo _COM_SEF_TITLE_COM_CONF;?></th>
	            <th><?php echo _COM_SEF_ADV_HANDLING.mosToolTip(_COM_SEF_TT_ADV,_COM_SEF_ADV_HANDLING); ?></th>
	            <th><?php echo _COM_SEF_ADV_TITLE.mosToolTip(_COM_SEF_TT_ADV_TITLE,_COM_SEF_ADV_TITLE); ?></th>
	            <th align="left"><?php echo mosToolTip(_COM_SEF_TT_DONTSHOWTITLE, _COM_SEF_DONTSHOWTITLE); ?></th>
	            <th></th>
	        </tr>
	<?php
	foreach($lists['adv_config'] as $key => $option) {
	    $x++;
	    echo '<tr'.(($x % 2) ? '':' class="row1"' ).">\n";
	    echo '<td width="200">'.$key."</td>\n";
	    echo '<td width="100">'.$option."</td>\n";
	    echo '<td width="200">'.$lists['titles'][$key]."</td>\n";
	    echo '<td width="20">'.$lists['dontshow'][$key]."</td>\n";
	    echo "<td></td>\n";
	    echo "</tr>\n";
	}
	?>
	        <tr>
	            <th colspan="5"></th>
	        </tr>
	    </table>
	    <input type="hidden" name="id" value="" />
	    <input type="hidden" name="task" value="saveconfig" />
	    <input type="hidden" name="option" value="com_sef" />
	    <input type="hidden" name="section" value="config" />
	    <input type="hidden" name="purge" id="purge" value="0" />
	    </form>
    <?php
    }

    function viewSEF(&$rows, &$lists, $pageNav, $option, $viewmode = 0)
    {
        global $my;

        if ($viewmode == 0) $path = _COM_SEF_VIEWURLDESC;
        elseif ($viewmode == 1) $path = _COM_SEF_VIEW404DESC;
        else $path = _COM_SEF_VIEWCUSTOMDESC;
        showNavigationBar($path);
		?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading" cellpadding="2" cellspacing="2">
		<tr>
			<th>
			<?php echo _COM_SEF_TITLE_MANAGER; ?>
			<br/><font class="small" align="left"><a href="index2.php?option=com_sef"><?php echo _COM_SEF_BACK?></a></font>
			</th>
			<td>
			&nbsp;
			</td>
			<td>
			&nbsp;
			</td>
			<td nowrap >
			<?php
			if ($viewmode == 2) {
			?><br/>
			<a href="index2.php?option=<?php echo $option; ?>&task=import_export"><?php echo _COM_SEF_IMPORT_EXPORT; ?></a>&nbsp;&nbsp;
			<?php } else { ?>
			&nbsp;
			</td>
			<?php } ?>
			<td align="right">
			<?php echo _COM_SEF_VIEWMODE.'<br/>'.$lists['viewmode'];?>
			</td>
			<td align="right">
			<?php echo _COM_SEF_SORTBY.$lists['sortby'];?>
			</td>
		</tr>
		<tr>
		  <td>
		  </td>
		  <td nowrap align="right">
		  <?php echo _COM_SEF_HITS; ?>:<br />
		  <?php echo $lists['hitsCmp'].$lists['hitsVal']; ?>
		  </td>
		  <?php if ($viewmode != 1) { ?>
    		  <td align="right">
    		  <?php echo _COM_SEF_ITEMID; ?>:<br />
    		  <?php echo $lists['itemid']; ?>
    		  </td>
		  <?php } else echo "<td></td>\n"; ?>
		  <?php if ($viewmode == 1) echo "<td></td>"; ?>
		  <td align="right" <?php if ($viewmode==1) echo 'colspan="2"'; ?>>
		    <?php
		    if ($viewmode == 1) echo _COM_SEF_FILTER404;
		    else echo _COM_SEF_FILTERSEF;
		    echo $lists['filterSEF'];
		    ?>
		  </td>
		  <?php if ($viewmode != 1) { ?>
    		<td align="right">
    		  <?php echo _COM_SEF_FILTERREAL.$lists['filterReal']; ?>
    		</td>
          <td align="right">
		    <?php echo _COM_SEF_FILTERCOMPONENT.$lists['comList']; ?>
		  </td>
    	  <?php } ?>
		</tr>
		</table>

		<?php
		// Top navigation bar
		$pageNavTop  = '<table class="adminlist"><tr><th colspan="3">';
		$pageNavTop .= $pageNav->getPagesLinks();
		$pageNavTop .= '</th></tr></table>';
		echo $pageNavTop;
		?>
		
		<table class="adminlist">
		<tr>
			<th width="20px">
			#
			</th>
			<th width="20px">
			<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" />
			</th>
			<th class="title" width="50px">
			<?php echo _COM_SEF_HITS;?>
			</th>
			<th class="title">
			<?php echo (($viewmode == 1) ? _COM_SEF_DATEADD : _COM_SEF_SEFURL); ?>
			</th>
			<th>
			<?php echo (($viewmode == 1) ? _COM_SEF_URL : _COM_SEF_REALURL); ?>
			</th>
		</tr>
		<?php
		$k = 0;
		//for ($i=0, $n=count( $rows ); $i < $n; $i++) {
		foreach (array_keys($rows) as $i) {
		    $row = &$rows[$i];
			?>
			<tr class="<?php echo 'row'. $k; ?>">
				<td align="center">
				<?php echo $pageNav->rowNumber($i); ?>
				</td>
				<td>
				<?php echo mosHTML::idBox($i, $row->id, false); ?>
				</td>
				<td>
				<?php echo $row->cpt; ?>
				</td>
				<td style="text-align:left;">
				<?php if ($viewmode == 1) {?>
					<?php echo $row->dateadd;?>
				<?php } else { ?>
					<a href="#edit" onclick="return listItemTask('cb<?php echo $i;?>','edit')">
					<?php echo $row->oldurl;?>
					</a>
				<?php } ?>
				</td>
				<td style="text-align:left;" width="80%">
				<?php if ($viewmode == 1) {?>
					<a href="#edit" onclick="return listItemTask('cb<?php echo $i;?>','edit')">
					<?php echo $row->oldurl;?>
					</a>
				<?php }else echo htmlentities( $row->newurl . ($row->Itemid == '' ? '' : (strpos($row->newurl, '?') ? '&' : '?' ) . 'Itemid='.$row->Itemid ) ); ?>
				</td>
			</tr>
			<?php
			$k = 1 - $k;
		}
		?>
		</table>
		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="view" />
		<input type="hidden" name="boxchecked" value="0" />
		</form>
		<?php
    }

    function view301(&$rows, &$lists, $pageNav, $option)
    {
        global $my;

        showNavigationBar(_COM_SEF_VIEW301);
		?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading" cellpadding="2" cellspacing="2">
		<tr>
			<th>
			<?php echo _COM_SEF_TITLE_MANAGER; ?>
			<br/><font class="small" align="left"><a href="index2.php?option=com_sef"><?php echo _COM_SEF_BACK?></a></font>
			</th>
			<td>
			&nbsp;
			</td>
			<td>
			&nbsp;
			</td>
			<td align="right">
			<?php echo _COM_SEF_SORTBY.$lists['sortby'];?>
			</td>
		</tr>
		<tr>
		  <td>
		  </td>
		  <td align="right">
		  <?php echo _COM_SEF_FILTEROLD.$lists['filterOld']; ?>
		  </td>
		  <td align="right">
		  <?php echo _COM_SEF_FILTERNEW.$lists['filterNew']; ?>
		  </td>
		  <td align="right">
		  <?php echo _COM_SEF_FILTERDAY.$lists['filterDays']; ?>
		  </td>
		</tr>
		</table>

		<?php
		// Top navigation bar
		$pageNavTop  = '<table class="adminlist"><tr><th colspan="3">';
		$pageNavTop .= $pageNav->getPagesLinks();
		$pageNavTop .= '</th></tr></table>';
		echo $pageNavTop;
		?>
		
		<table class="adminlist">
		<tr>
			<th width="20px">
			#
			</th>
			<th align="left" width="20px">
			<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" />
			</th>
			<th class="title">
			<?php echo _COM_SEF_301OLDURL;?>
			</th>
			<th class="title">
			<?php echo _COM_SEF_301NEWURL; ?>
			</th>
			<th>
			<?php echo _COM_SEF_DAYS; ?>
			</th>
		</tr>
		<?php
		$k = 0;
		//for ($i=0, $n=count( $rows ); $i < $n; $i++) {
		foreach (array_keys($rows) as $i) {
		    $row = &$rows[$i];
			?>
			<tr class="<?php echo 'row'. $k; ?>">
				<td align="center" width="20px">
				<?php echo $pageNav->rowNumber($i); ?>
				</td>
				<td width="20px">
				<?php echo mosHTML::idBox($i, $row->id, false); ?>
				</td>
				<td style="text-align:left;">
				<a href="#edit" onclick="return listItemTask('cb<?php echo $i;?>','edit')">
				<?php echo $row->old; ?>
				</a>
				</td>
				<td style="text-align:left;">
				<?php echo $row->new; ?>
				</td>
				<td style="text-align:left;" width="10%">
				<?php echo (substr($row->lastHit, 0, 10) == '0000-00-00' ? _COM_SEF_NEVER : $row->lastHit); ?>
				</td>
			</tr>
			<?php
			$k = 1 - $k;
		}
		?>
		</table>
		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="section" value="301" />
		<input type="hidden" name="task" value="view301" />
		<input type="hidden" name="boxchecked" value="0" />
		</form>
		<?php
    }

    function editSEF(&$_row, &$lists, $_option)
    {
        global $sefConfig;
    ?>
	<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
	<script language="Javascript" src="<?php echo $GLOBALS['mosConfig_live_site']; ?>/includes/js/overlib_mini.js"></script>
	<script language="javascript">
	<!--
	function submitbutton(pressbutton)
	{
	    var form = document.adminForm;
	    if (pressbutton == 'cancel') {
	        submitform( pressbutton );
	        return;
	    }
	    // do field validation
	    if (form.customurl.checked == true ) {
	        form.dateadd.value = "<?php echo date('Y-m-d'); ?>"
	    } else {
	        form.dateadd.value = "0000-00-00"
	    }
	    if (form.newurl.value == "") {
	        alert( "<?php echo _COM_SEF_EMPTYURL; ?>" );
	    } else {
	        if (form.newurl.value.match(/^index.php/)) {
	            <?php if( $sefConfig->useMoved ) { ?>
	            // Ask to save the changed url to Moved Permanently table
	            if( form.oldurl.value != form.unchanged.value ) {
	                <?php if( $sefConfig->useMovedAsk ) { ?>
	                if( !confirm("<?php echo _COM_SEF_CONFIRM301; ?>") ) {
	                    form.unchanged.value = "";
	                }
	                <?php } ?>
	            } else {
	                form.unchanged.value = "";
	            }
	            <?php } else { echo 'form.unchanged.value="";'; } ?>
	            submitform( pressbutton );
	        } else {
	            alert( "<?php echo _COM_SEF_BADURL; ?>" );
	        }
	    }
	}
	//-->
	</script>
	<?php showNavigationBar('JoomSEF '.($_row->id ? _COM_SEF_EDIT : _COM_SEF_ADD).' URL'); ?>
	<table class="adminheading">
		<tr>
			<th>JoomSEF <?php echo $_row->id ? _COM_SEF_EDIT : _COM_SEF_ADD; ?> URL</th>
		</tr>
	</table>
	<form action="index2.php" method="post" name="adminForm">
	<table class="adminform">
	    <tr><th colspan="2"><?php echo _COM_SEF_URL_TTL; ?></th></tr>
		<tr>
			<td><?php echo _COM_SEF_NEWURL; ?></td>
			<td><input class="inputbox" type="text" size="100" name="oldurl" value="<?php echo $_row->oldurl; ?>">
			<?php echo mosToolTip(_COM_SEF_TT_NEWURL); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo _COM_SEF_OLDURL;?></td>
			<td align="left"><input class="inputbox" type="text" size="100" name="newurl" value="<?php echo $_row->newurl; ?>">
			<?php echo mosToolTip(_COM_SEF_TT_OLDURL);?>
			</td>
		</tr>
		<tr>
			<td><?php echo _COM_SEF_ITEMID;?></td>
			<td align="left"><input class="inputbox" type="text" size="30" name="Itemid" value="<?php echo $_row->Itemid; ?>">
			<?php echo mosToolTip(_COM_SEF_TT_ITEMID);?>
			</td>
		</tr>		
		<tr>
  		<td></td>
  		<td>
  			<?php echo _COM_SEF_SAVEAS; ?><input type="checkbox" name="customurl" value="0" checked="checked" />
  		</td>
		</tr>
		<tr><th colspan="2"><?php echo _COM_SEF_META_TTL; ?></th></tr>
		<tr><td colspan="2"><?php echo  mosToolTip(_COM_SEF_META_TIP).' '._COM_SEF_META_INFO; ?></td></tr>
		<tr>
		  <td><?php echo _COM_SEF_METATITLE; ?></td>
		  <td align="left"><input class="inputbox" type="text" size="100" maxlength="255" name="metatitle" value="<?php echo htmlspecialchars($_row->metatitle); ?>">
		  </td>
		</tr>
		<tr>
		  <td><?php echo _COM_SEF_METADESCRIPTION; ?></td>
		  <td align="left"><input class="inputbox" type="text" size="100" maxlength="255" name="metadesc" value="<?php echo htmlspecialchars($_row->metadesc); ?>">
		  </td>
		</tr>
		<tr>
		  <td><?php echo _COM_SEF_METAKEYWORDS; ?></td>
		  <td align="left"><input class="inputbox" type="text" size="100" maxlength="255" name="metakey" value="<?php echo htmlspecialchars($_row->metakey); ?>">
		  </td>
		</tr>
		<tr>
		  <td><?php echo _COM_SEF_METALANG; ?></td>
		  <td align="left"><input class="inputbox" type="text" size="100" maxlength="30" name="metalang" value="<?php echo htmlspecialchars($_row->metalang); ?>">
		  </td>
		</tr>
		<tr>
		  <td><?php echo _COM_SEF_METAROBOTS; ?></td>
		  <td align="left"><input class="inputbox" type="text" size="100" maxlength="30" name="metarobots" value="<?php echo htmlspecialchars($_row->metarobots); ?>">
		  </td>
		</tr>
		<tr>
		  <td><?php echo _COM_SEF_METAGOOGLE; ?></td>
		  <td align="left"><input class="inputbox" type="text" size="100" maxlength="30" name="metagoogle" value="<?php echo htmlspecialchars($_row->metagoogle); ?>">
		  </td>
		</tr>
		<?php /*
	<tr>
	<td colspan="3">&nbsp;</td>
	</tr>
		*/ ?>
	</table>

	<input type="hidden" name="unchanged" value="<?php echo $_row->oldurl; ?>" />
	<input type="hidden" name="option" value="<?php echo $_option; ?>" />
	<input type="hidden" name="dateadd" value="<?php echo $_row->dateadd; ?>" />
	<input type="hidden" name="id" value="<?php echo $_row->id; ?>" />
	<input type="hidden" name="task" value="" />
	</form>
<?php
    }

    function edit301(&$_row, &$lists, $_option)
    {
        global $sefConfig;
    ?>
	<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
	<script language="Javascript" src="<?php echo $GLOBALS['mosConfig_live_site']; ?>/includes/js/overlib_mini.js"></script>
	<script language="javascript">
	<!--
	function submitbutton(pressbutton)
	{
	    var form = document.adminForm;
	    if (pressbutton == 'cancel') {
	        submitform( pressbutton );
	        return;
	    }
	    // do field validation
	    if (form.new.value == "" || form.old.value == "") {
	        alert( "<?php echo _COM_SEF_EMPTYURL; ?>" );
	    } else {
	        submitform( pressbutton );
	    }
	}
	//-->
	</script>
	<?php showNavigationBar('JoomSEF '.($_row->id ? _COM_SEF_EDIT : _COM_SEF_ADD).' 301 URL'); ?>
	<table class="adminheading">
		<tr>
			<th>JoomSEF <?php echo $_row->id ? _COM_SEF_EDIT : _COM_SEF_ADD; ?> 301 URL</th>
		</tr>
	</table>
	<form action="index2.php" method="post" name="adminForm">
	<table class="adminform">
	    <tr><th colspan="2"><?php echo _COM_SEF_URL_TTL; ?></th></tr>
		<tr>
			<td><?php echo _COM_SEF_301OLDURL; ?></td>
			<td><input class="inputbox" type="text" size="100" name="old" value="<?php echo $_row->old; ?>">
			<?php echo mosToolTip(_COM_SEF_TT_301OLDURL); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo _COM_SEF_301NEWURL;?></td>
			<td align="left"><input class="inputbox" type="text" size="100" name="new" value="<?php echo $_row->new; ?>">
			<?php echo mosToolTip(_COM_SEF_TT_301NEWURL);?>
			</td>
		</tr>
	</table>

	<input type="hidden" name="option" value="<?php echo $_option; ?>" />
	<input type="hidden" name="id" value="<?php echo $_row->id; ?>" />
	<input type="hidden" name="section" value="301" />
	<input type="hidden" name="task" value="" />
	</form>
<?php
    }

    function help()
    {
	?>
		 <table class="adminform">
	        <tr>
	            <th colspan="4"><?php echo _COM_SEF_TITLE_SUPPORT;?></th>
	        </tr>
	        <tr>
	        	<td>
	        	<ol><?php echo _COM_SEF_HELPVIA;?><br />
				    <li><a href="http://www.artio.cz/en/joomla-extensions/artio-joomsef" target="_blank"><?php echo _COM_SEF_PAGES;?></a></li>
				    <li><a href="http://www.artio.cz/en/support-forums" target="_blank"><?php echo _COM_SEF_FORUM;?></a></li>
				    <li><a href="http://www.artio.cz/en/web-support/" target="_blank"><?php echo _COM_SEF_HELPDESK;?></a></li>
	        	</ol>
	        </tr>
	<?php
    }

    function purge($option, $message, $confirmed)
    {
	?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th>
			<?php echo _COM_SEF_TITLE_PURGE;?>
			<br /><font class="small" align="left"><a href="index2.php?option=com_sef"><?php echo _COM_SEF_BACK; ?></a></font>
			</th>
		</tr>
		<tr>
			<td><p class="message"><?php echo $message ?><br />
				<input type="hidden" name="option" value="<?php echo $option;?>" />
			<?php if (($message == _COM_SEF_SUCCESSPURGE)||($message == _COM_SEF_NORECORDS)) { ?>
				<input type="hidden" name="task" value="" />
				<input type="submit" name="continue" value="<?php echo _COM_SEF_OK ?>"></p>
			<?php } else { ?>
			  <input type="hidden" name="task" value="purge" />
				<input type="submit" name="confirmed" value="<?php echo _COM_SEF_PROCEED ?>"></p>
			<?php } ?>
			</td>
		</tr>
	  </table>
	<?php
    }

    function import_export()
    {
    ?>
<script type="text/javascript">
function checkForm(){
    if (document.backupform.userfile.value == "") {
        alert('<?php echo _COM_SEF_SELECT_FILE; ?>');
        return false;
    } else {
        return true;
    }
}

function toggle_display(idname) {
    obj = fetch_object(idname);
    if (obj) {
        if (obj.style.display == "none"){
            obj.style.display = "";
        } else {
            obj.style.display = "none";
        }
    }
    return false;
}
</script>
<center>
<form method="post" action="index2.php?option=com_sef&task=import" enctype="multipart/form-data" onSubmit="return checkForm();" name="backupform">
<input type="file" name="userfile">
<input type="submit" value="<?php echo _COM_SEF_IMPORT; ?>">
</form>
<input type="button" value="<?php echo _COM_SEF_EXPORT; ?>" onClick="javascript:location.href='index2.php?option=com_sef&task=export'"></center>
<?php
    }

    function show_upgrade()
    {
        global $sefConfig, $mosConfig_absolute_path;
        require_once($mosConfig_absolute_path.'/includes/domit/xml_domit_lite_include.php' );
        $extBaseDir	= mosPathName(mosPathName($mosConfig_absolute_path).'components/com_sef/sef_ext');

        $versions = @file_get_contents($sefConfig->serverNewVersionURL);
        if (!$versions) {
            $versions = "?.?.?";
        }

        $versions = explode("\n", trim($versions));
        $newVersion = trim(array_shift($versions));
        if( count($versions) > 0 ) {
            foreach($versions as $version) {
                list($ext, $ver) = explode(' ', $version);
                $extensions[$ext]['new'] = trim($ver);

                if( !file_exists($extBaseDir.$ext.'.xml') ) {
                    unset($extensions[$ext]);
                    continue;
                }

                // Load the xml file
                $xmlDoc = new DOMIT_Lite_Document();
                $xmlDoc->resolveErrors(true);
                if (!$xmlDoc->loadXML($extBaseDir.$ext.'.xml', false, true)) {
                    continue;
                }

                $root = &$xmlDoc->documentElement;
                if ($root->getTagName() != 'mosinstall') {
                    continue;
                }
                if ($root->getAttribute('type') != 'sef_ext') {
                    continue;
                }

                $element                    = &$root->getElementsByPath('name', 1);
                $extensions[$ext]['name']   = $element ? $element->getText() : '';

                $element 			        = &$root->getElementsByPath('version', 1);
                $extensions[$ext]['old']    = $element ? $element->getText() : '';
            }
        }
	  ?>
		<table class="adminheading">
		<tr>
			<th>
  			<?php echo _COM_SEF_TITLE_UPGRADE; ?>
  			<br/><font class="small" align="left"><a href="index2.php?option=com_sef"><?php echo _COM_SEF_BACK?></a></font>
			</th>
			<td nowrap>
			  <?php echo _COM_SEF_INSTALLED_VERS."<br/>"._COM_SEF_TITLE_NEWVERSION; ?>
			</td>
			<td nowrap align="right" width="35">
        <?php echo SEFTools::getSEFVersion()."<br/>".$newVersion; ?>
			</td>
		</tr>
		</table>
		
        <form action="index2.php" method="post" enctype="multipart/form-data" name="adminForm">
   		<table class='adminform'>
   		<tr>
   		  <th>
   		    <?php echo _COM_SEF_UPGRADEPACKAGE_HEADER; ?>
   		  </th>
   		</tr>
   		<tr>
   		  <td align="left">
   		    <?php echo _COM_SEF_UPGRADEPACKAGE_LABEL; ?>
   		    <input class="text_area" name="userfile" type="file" size="70" />
   		    <input type="submit" value="<?php echo _COM_SEF_UPGRADEPACKAGE_SUBMIT; ?>" />
   		  </td>
   		</tr>
   		</table>
    		
   		<input type="hidden" name="task" value="upgrade" />
   		<input type="hidden" name="option" value="com_sef" />
   		<input type="hidden" name="fromServer" value="0" />
   		</form>
   		<br />
    	
		<?php
		$curVersion = SEFTools::getSEFVersion();
		if (strnatcasecmp($newVersion, $curVersion) > 0
		|| strnatcasecmp($newVersion, substr($curVersion, 0, strpos($curVersion, '-'))) == 0
		|| $newVersion == "?.?.?"
		)
		{
	    ?>
   		<table class='adminform'>
   		<tr>
   		  <th>
   		    <?php echo _COM_SEF_UPGRADESERVER_HEADER; ?>
   		  </th>
   		</tr>
   		<tr>
   		  <td align="left">
   		    <?php
   		    if ($newVersion == "?.?.?") {
   		        echo _COM_SEF_UPGRADE_SERVERUNAVAILABLE;
   		    }
   		    else
   		    {
   		        echo "<a href=\"index2.php?option=com_sef&task=upgrade&fromServer=1\" title=\""._COM_SEF_UPGRADESERVER_LINKTITLE."\">";
   		        echo _COM_SEF_UPGRADESERVER_LINKTEXT."</a>";
   		    }
   		    ?>
   		  </td>
   		</tr>
   		</table>
   		<?php
		}
		else
		{
		    echo "<p class='message'>"._COM_SEF_UPTODATE."</p>";
		}
		?>
		<br />
		<table class="adminheading">
		<tr>
		  <th>
		  <?php echo _COM_SEF_EXTUPGRADE_TITLE; ?>
		  </th>
		</tr>
		</table>
		<table class="adminform">
		<tr>
    		<th><?php echo _COM_SEF_EXT; ?></th>
    		<th><?php echo _COM_SEF_INSTALLED_VERS; ?></th>
    		<th><?php echo _COM_SEF_TITLE_NEWVERSION; ?></th>
    		<th><?php echo _COM_SEF_UPGRADE; ?></th>
		</tr>
		<?php
		$k = 0;
		if( isset($extensions) && (count($extensions) > 0) ) {
		    foreach(array_keys($extensions) as $i) {
		        $row = &$extensions[$i];
		    ?>
		    <tr class="<?php echo 'row'.$k; ?>">
		      <td><?php echo $row['name']; ?></td>
		      <td><?php echo $row['old']; ?></td>
		      <td><?php echo $row['new']; ?></td>
		      <td>
		      <?php
		      if (strnatcasecmp($row['new'], $row['old']) > 0 ||
		      strnatcasecmp($row['new'], substr($row['old'], 0, strpos($row['old'], '-'))) == 0 ) {
		          ?>
		          <a href="index2.php?option=com_sef&amp;task=upgrade&amp;fromServer=1&amp;ext=<?php echo $i; ?>">Upgrade</a>
		          <?php
		      } else {
		          echo _COM_SEF_NOTAVAILABLE;
		      }
		      ?>
		      </td>
		    </tr>
		    <?php
		    $k = 1 - $k;
		    }
		}
		?>
		</table>
		<?php
    }

    function editExt( &$row, &$lists, &$params, $option ) {
        global $mosConfig_live_site;

        $row->nameA = '<small><small>[ '. $row->name .' ]</small></small>';
		?>
		<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
		<table class="adminheading">
		<tr>
			<th class="mambots">
			<?php echo _COM_SEF_EXT; ?>
			<small>
			<?php echo _COM_SEF_EDIT; ?>
			</small>
			<?php echo $row->nameA; ?>
			</th>
		</tr>
		</table>

		<form action="index2.php" method="post" name="adminForm">
		<table cellspacing="0" cellpadding="0" width="100%">
		<tr valign="top">
			<td width="60%" valign="top">
				<table class="adminform">
				<tr>
					<th colspan="2">
					Extension Details
					</th>
				<tr>
				<tr>
					<td width="100" align="left">
					<?php echo _COM_SEF_NAME; ?>:
					</td>
					<td>
					<?php echo $row->name; ?>
					</td>
				</tr>
				<tr>
					<td width="100" align="left">
					<?php echo _COM_SEF_VERSION; ?>:
					</td>
					<td>
					<?php echo $row->version; ?>
					</td>
				</tr>
				<tr>
					<td valign="top" colspan="2">&nbsp;

					</td>
				</tr>
				<tr>
					<td valign="top">
					<?php echo _COM_SEF_DESCRIPTION; ?>:
					</td>
					<td>
					<?php echo $row->description; ?>
					</td>
				</tr>
				</table>
			</td>
			<td width="40%">
				<table class="adminform">
				<tr>
					<th colspan="2">
					<?php echo _COM_SEF_PARAMETERS; ?>
					</th>
				<tr>
				<tr>
					<td>
					<?php
					if ( !is_null($params) ) {
					    echo $params->render();
					} else {
					    echo '<i>'._NO_PARAMS.'</i>';
					}
					?>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="file" value="<?php echo $row->file; ?>" />
		<input type="hidden" name="section" value="sefext" />
		<input type="hidden" name="task" value="" />
		</form>
		<script language="Javascript" src="<?php echo $mosConfig_live_site;?>/includes/js/overlib_mini.js"></script>
		<?php
    }
}
?>
