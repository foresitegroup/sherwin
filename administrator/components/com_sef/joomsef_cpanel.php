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

?>
<table class="adminform">
   <tr>
      <td width="50%" valign="top">
         <table width="100%">
         <tr>
            <td align="center" height="90" width="90">
            <a href="index2.php?option=com_sef&task=showconfig" style="text-decoration:none;" title="<?php echo _COM_SEF_CONFIGDESC;?>">
            <img src="components/com_sef/images/config.png" width="48" height="48" align="middle" border="0"/>
            <br />
            <?php echo _COM_SEF_CONFIG;?>
            </a>
            </td>

            <td align="center" height="90" width="90">
            <a href="index2.php?option=com_sef&task=help" style="text-decoration:none;" title="<?php echo _COM_SEF_HELPDESC;?>">
            <img src="components/com_sef/images/support.png" width="48" height="48" align="middle" border="0"/>
            <br />
            <?php echo _COM_SEF_HELP;?>
            </a>
            </td>

            <td align="center" height="90" width="90">
            <a href="index2.php?option=com_sef&task=info" style="text-decoration:none;" title="<?php echo _COM_SEF_INFODESC;?>">
            <img src="components/com_sef/images/docs.png" width="48" height="48" align="middle" border="0"/>
            <br />
            <?php echo _COM_SEF_INFO;?>
            </a>
            </td>
            
            <td align="center" height="90" width="90">
            </td>
            
         </tr>
         <tr>
            <td align="center" height="90" width="90">
            <a href="index2.php?option=com_sef&task=view&viewmode=3" style="text-decoration:none;" title="<?php echo _COM_SEF_VIEWURLDESC;?>">
            <img src="components/com_sef/images/urls.png" width="48" height="48" align="middle" border="0"/>
            <br />
            <?php echo _COM_SEF_VIEWURL ;?>
            </a>
            </td>

            <td align="center" height="90" width="90">
            <a href="index2.php?option=com_sef&task=view&viewmode=1" style="text-decoration:none;" title="<?php echo _COM_SEF_VIEW404DESC;?>">
            <img src="components/com_sef/images/logs.png" width="48" height="48" align="middle" border="0"/>
            <br />
            <?php echo _COM_SEF_VIEW404 ;?>
            </a>
            </td>

            <td align="center" height="90" width="90">
            <a href="index2.php?option=com_sef&task=view&viewmode=2" style="text-decoration:none;" title="<?php echo _COM_SEF_VIEWCUSTOMDESC;?>">
            <img src="components/com_sef/images/custom.png" width="48" height="48" align="middle" border="0"/>
            <br />
            <?php echo _COM_SEF_VIEWCUSTOM ;?>
            </a>
            </td>
            
            <td align="center" height="90" width="90">
            <a href="index2.php?option=com_sef&task=view301" style="text-decoration:none;" title="<?php echo _COM_SEF_VIEW301DESC;?>">
            <img src="components/com_sef/images/url_301.png" width="48" height="48" align="middle" border="0"/>
            <br />
            <?php echo _COM_SEF_VIEW301 ;?>
            </a>
            </td>

         </tr>
         <tr>
            <td align="center" height="90" width="90">
            <a href="index2.php?option=com_sef&task=purge&viewmode=0&confirmed=0" style="text-decoration:none;" title="<?php echo _COM_SEF_PURGEURLDESC;?>">
            <img src="components/com_sef/images/urls_del.png" width="48" height="48" align="middle" border="0"/>
            <br />
            <?php echo _COM_SEF_PURGEURL ;?>
            </a>
            </td>

            <td align="center" height="90" width="90">
            <a href="index2.php?option=com_sef&task=purge&viewmode=1&confirmed=0" style="text-decoration:none;" title="<?php echo _COM_SEF_PURGE404DESC;?>">
            <img src="components/com_sef/images/logs_del.png" width="48" height="48" align="middle" border="0"/>
            <br />
            <?php echo _COM_SEF_PURGE404 ;?>
            </a>
            </td>

            <td align="center" height="90" width="90">
            <a href="index2.php?option=com_sef&task=purge&viewmode=2&confirmed=0" style="text-decoration:none;" title="<?php echo _COM_SEF_PURGECUSTOMDESC;?>">
            <img src="components/com_sef/images/custom_del.png" width="48" height="48" align="middle" border="0"/>
            <br />
            <?php echo _COM_SEF_PURGECUSTOM ;?>
            </a>
            </td>
            
            <td align="center" height="90" width="90">
            <a href="index2.php?option=com_sef&task=purge301" style="text-decoration:none;" title="<?php echo _COM_SEF_PURGE301DESC;?>">
            <img src="components/com_sef/images/url_301_del.png" width="48" height="48" align="middle" border="0"/>
            <br />
            <?php echo _COM_SEF_PURGE301 ;?>
            </a>
            </td>

         </tr></table>
      </td>
      <td width="50%" valign="top" align="center">
      <table border="1" width="100%" class="adminform">
         <tr>
            <th class="cpanel" colspan="2">ARTIO JoomSEF</th>
         </tr>
         <tr>
            <td width="120" bgcolor="#F4F4F4"><?php echo _COM_SEF_INSTALLED_VERS ;?></td>
            <td bgcolor="#F4F4F4">
                <a href="http://www.artio.net/en/joomla-extensions/artio-joomsef" target="_blank">
                <img src="components/com_sef/images/box.png" align="middle" alt="JoomSEF logo" style="border: none; margin: 8px;" />
                </a><br />
                <a href="http://www.artio.net" target="_blank">ARTIO</a> JoomSEF v<?php echo SEFTools::getSEFVersion();?>
            </td>
         </tr>
         <tr>
            <td bgcolor="#EFEFEF"><?php echo _COM_SEF_COPYRIGHT ;?></td>
            <td bgcolor="#EFEFEF">&copy; 2006-<?php print(date('Y')); ?> Artio s.r.o.</td>
         </tr>
         <tr>
            <td bgcolor="#F4F4F4"><?php echo _COM_SEF_LICENSE ;?></td>
            <td bgcolor="#F4F4F4"><a href="http://www.artio.net/en/joomsef/artio-joomsef-license-and-pricing" target="_blank">Combined license</a></td>
         </tr>
		 <tr>
		 	<td bgcolor="#EFEFEF"><?php echo _COM_SEF_SUPPORT_JOOMSEF ;?></td>
			<td bgcolor="#EFEFEF">
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
				<input name="cmd" type="hidden" value="_s-xclick"></input>
				<input name="submit" type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but04.gif" title="Support JoomSEF"></input>
				<img src="https://www.paypal.com/en_US/i/scr/pixel.gif" border="0" alt="" width="1" height="1" />
				<input name="encrypted" type="hidden" value="-----BEGIN PKCS7-----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-----END PKCS7-----"></input>
				</form>
			</td>
		 </tr>
      </table>
      </td>
   </tr>
</table>
