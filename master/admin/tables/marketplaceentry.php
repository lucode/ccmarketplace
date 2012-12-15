<?php

/**
*
* Marketplace - Classified Ads for Joomla!
*
* @package		Marketplace
* @subpackage	Backend
* @author		Achim Fischer
* @copyright	Copyright (C) 2005-2012 Achim Fischer (Codingfish). All rights reserved.
* @link			http://www.codingfish.com
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*
*/

// no direct access
defined('_JEXEC') or die('Restricted access');



/**
* Entry Table class
*/
class TableMarketplaceEntry extends JTable {

	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;

	/**
	 * @var int
	 */
	var $category_id = null;

	/**
	 * @var int
	 */
	var $label_id = null;

	/**
	 * @var int
	 */
	var $user_id = null;

	/**
	 * @var string
	 */
	var $firstname = null;

	/**
	 * @var string
	 */
	var $lastname = null;

	/**
	 * @var string
	 */
	var $company = null;

	/**
	 * @var string
	 */
	var $street = null;

	/**
	 * @var string
	 */
	var $zip = null;

	/**
	 * @var string
	 */
	var $city = null;

	/**
	 * @var string
	 */
	var $state = null;

	/**
	 * @var string
	 */
	var $country = null;

	/**
	 * @var string
	 */
	var $phone = null;

	/**
	 * @var string
	 */
	var $mobile = null;

	/**
	 * @var string
	 */
	var $email = null;

	/**
	 * @var string
	 */
	var $web = null;

	/**
	 * @var string
	 */
	var $headline = null;

	/**
	 * @var string
	 */
	var $text = null;

	/**
	 * @var string
	 */
	var $condition = null;

	/**
	 * @var string
	 */
	var $price = null;

	/**
	 * @var datetime
	 */
	var $date_created = null;

	/**
	 * @var datetime
	 */
	var $date_lastmodified = null;


	/**
	 * @var int
	 */
	var $flag_commercial = null;


	/**
	 * @var int
	 */
	var $flag_featured = null;


	/**
	 * @var int
	 */
	var $flag_top = null;


	/**
	 * @var int
	 */
	var $published = null;


	/**
	 * @var string
	 */
	var $params = null;



	function __construct(& $db) {
	
		parent::__construct( '#__ccmarketplace_entries', 'id', $db);
		
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
