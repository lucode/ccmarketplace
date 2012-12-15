<?php
/**
*
* CCMarketplace - Classified Ads for Joomla!
*
* @package		CCMarketplace
* @subpackage	Backend
* @author		Lucas Huber
*
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

class CCMarketplaceTableGroupid extends JTable
{
	var $id = null;
	var $gid = null;
	var $gname = null;
	var $webchannelid = null;
	var $login_page_name = null;
	var $published = null;
	var $group_codes = null;
	
	function __construct(& $db) {

		parent::__construct( '#__ccmarketplace_ws_grpfiltrs', 'id', $db);

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
