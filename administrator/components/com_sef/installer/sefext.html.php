<?php
/**
* @version $Id: mambot.html.php 85 2005-09-15 23:12:03Z eddieajau $
* @package Joomla
* @subpackage Installer
* @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined('_VALID_MOS') or die('Restricted access');

/**
 * @package Joomla
 * @subpackage Installer
 */
class HTML_sefext
{

    function showWritable()
    {
        ?>
        <table class="content">
        <?php
            writableCell('components/com_sef/sef_ext');
        ?>
        </table>
        <?php
    }
    
    /**
     * Displays the installed non-core Mambot
     * 
     * @param array An array of mambot object
     * @param strong The URL option
     */
    function showInstalledExts(&$rows, $option)
    {
		?>
        <table class="adminheading">
        <tr>
            <th class="install">
                <?php echo(_COM_SEF_INSTALLED_EXTS); ?>
            </th>
		</tr>
		<tr>
			<td>
	           	<?php echo(_COM_SEF_EXTS_INFO); ?>
    			<br /><br />
			</td>
		</tr>
		</table>
		<?php
		if (count($rows)) { ?>
			<form action="index2.php" method="post" name="adminForm">
			<table class="adminlist">
			<tr>
				<th width="20%" class="title">
				    <?php echo(_COM_SEF_EXT); ?>
				</th>
				<th width="10%" align="left">
				    <?php echo(_COM_SEF_AUTHOR); ?>
				</th>
				<th width="5%" align="center">
				    <?php echo(_COM_SEF_VERSION); ?>
				</th>
				<th width="10%" align="center">
				    <?php echo(_COM_SEF_DATE); ?>
				</th>
				<th width="15%" align="left">
				    <?php echo(_COM_SEF_AUTHOR_EMAIL); ?>
				</th>
				<th width="15%" align="left">
				    <?php echo(_COM_SEF_AUHTOR_URL); ?>
				</th>
			</tr>
			<?php
			$rc = 0;
			$n = count($rows);
			for ($i = 0; $i < $n; $i++) {
			    $row =& $rows[$i];
			    $link = 'index2.php?option=com_sef&task=editext&cid='.$row['id'];
				?>
				<tr class="<?php echo "row$rc"; ?>">
					<td>
					<input type="radio" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row['id']; ?>" onclick="isChecked(this.checked);">
					<span class="bold">
					<a href="<?php echo $link; ?>">
					<?php echo $row['name']; ?>
					</a>
					</span>
					</td>
					<td>
					<?php echo @$row['author'] != '' ? $row['author'] : "&nbsp;"; ?>
					</td>
					<td align="center">
					<?php echo @$row['version'] != '' ? $row['version'] : "&nbsp;"; ?>
					</td>
					<td align="center">
					<?php echo @$row['creationdate'] != '' ? $row['creationdate'] : "&nbsp;"; ?>
					</td>
					<td>
					<?php echo @$row['authorEmail'] != '' ? $row['authorEmail'] : "&nbsp;"; ?>
					</td>
					<td>
					<?php echo @$row['authorUrl'] != "" ? "<a href=\"" .(substr( $row['authorUrl'], 0, 7) == 'http://' ? $row['authorUrl'] : 'http://'.$row['authorUrl']). "\" target=\"_blank\">".$row['authorUrl']."</a>" : "&nbsp;";?>
					</td>
				</tr>
				<?php
				$rc = 1 - $rc;
			}
			?>
			</table>

    			<input type="hidden" name="task" value="" />
    			<input type="hidden" name="boxchecked" value="0" />
    			<input type="hidden" name="option" value="com_sef" />
    			<input type="hidden" name="element" value="sef_ext" />
			</form>
			<?php
		}
		else {
			echo(_COM_SEF_NONE_EXTS);
		}
    }

}
?>