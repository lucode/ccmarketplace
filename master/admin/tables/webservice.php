<?php
/**
*
* CCMarketplace - Classified Ads for Joomla!
*
* @package		Marketplace
* @subpackage	Backend
* @author		Lucas Huber
*
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

class CCMarketplaceTableWebservice extends JTable
{
	var $id = null;
	var $name = null;
	var $serverurl = null;
	var $webserver_user = null;
	var $webserver_password = null;
	var $shop_user = null;
	var $shop_password = null;
	var $organisation = null;
	var $area = null;
	var $type_of_trade = null;
  var $pdfrurl = null;
	var $published = null;
	var $show_mail_address = null;
	var $show_photo = null;
	var $show_city = null;
	var $show_area = null;
	var $show_code = null;
	var $ad_joomla = null;
	var $interface = null;
    var $d_member_profile = null;
    var $show_org = null;
    var $show_ms = null;
	var $show_name = null;
	var $show_customfield = null;

	function __construct(& $db) {

		parent::__construct( '#__ccmarketplace_ws_channels', 'id', $db);

	}

	function bind($array, $ignore = '') {

		if (key_exists( 'params', $array ) && is_array( $array['params'] )) {

			$registry = new JRegistry();
			$registry->loadArray($array['params']);
			$array['params'] = $registry->toString();

		}

		return parent::bind( $array, $ignore);
	}



	function check() {


		return true;
	}
}
?>
