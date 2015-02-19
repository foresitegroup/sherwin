<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
* VirtueMart MiniCart Module
*
* @version $Id: mod_virtuemart_cart.php 797 2007-04-06 08:04:36Z soeren_nb $
* @package VirtueMart
* @subpackage modules
*
* @copyright (C) 2004-2007 Soeren Eberhardt
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* VirtueMart is Free Software.
* VirtueMart comes with absolute no warranty.
*
* www.virtuemart.net
*/

/* Load the virtuemart main parse code */
require_once( $mosConfig_absolute_path.'/components/com_virtuemart/virtuemart_parser.php' );

global $VM_LANG, $sess, $mm_action_url;

$class_sfx = $params->get( 'class_sfx' );
?><div>
                <a class="mainlevel<?php echo $class_sfx ?>" href="<?php echo $sess->url($mm_action_url."index.php?page=shop.cart")?>">
                <?php echo $VM_LANG->_PHPSHOP_CART_SHOW ?></a>
            <br /><?php include (PAGEPATH.'shop.basket_short.php') ?>
	    
</div>
