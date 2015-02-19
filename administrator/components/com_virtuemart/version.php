<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
*
* @version $Id: version.php 859 2007-06-13 20:13:51Z gregdev $
* @package VirtueMart
* @subpackage core
* @copyright Copyright (C) 2004-2007 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
if( class_exists( 'vmVersion' ) ) {
	$VMVERSION =& new vmVersion();
	
	$shortversion = $VMVERSION->PRODUCT . " " . $VMVERSION->RELEASE . " " . $VMVERSION->DEV_STATUS. " ";
		
	$myVersion = $shortversion . " [".$VMVERSION->CODENAME ."] <br />" . $VMVERSION->RELDATE . " "
	. $VMVERSION->RELTIME . " " . $VMVERSION->RELTZ;
	return;
}
if( !class_exists( 'vmVersion' ) ) {
/** Version information */
class vmVersion {
	/** @var string Product */
	var $PRODUCT = 'VirtueMart';
	/** @var int Release Number */
	var $RELEASE = '1.0.11';
	/** @var string Development Status */
	var $DEV_STATUS = 'stable';
	/** @var string Codename */
	// Song by Noel "Paul" Stookey: http://en.wikipedia.org/wiki/The_Wedding_Song_%28There_is_Love%29
	var $CODENAME = 'The Wedding Song';
	/** @var string Date */
	var $RELDATE = '14/06/2007';
	/** @var string Time */
	var $RELTIME = '19:00';
	/** @var string Timezone */
	var $RELTZ = 'CET';
	/** @var string Revision */
	var $REVISION = '$Revision: 859 $';
	/** @var string Copyright Text */
	var $COPYRIGHT = 'Copyright (C) 2005-2007 Soeren Eberhardt. All rights reserved.'; 
	/** @var string URL */
	var $URL = '<a href="http://virtuemart.net">VirtueMart</a> is a Free Component for Joomla!/Mambo released under the GNU/GPL License.';
}
$VMVERSION =& new vmVersion();

$shortversion = $VMVERSION->PRODUCT . " " . $VMVERSION->RELEASE . " " . $VMVERSION->DEV_STATUS. " ";
	
$myVersion = $shortversion . " [".$VMVERSION->CODENAME ."] <br />" . $VMVERSION->RELDATE . " "
	. $VMVERSION->RELTIME . " " . $VMVERSION->RELTZ;
	
}

?>