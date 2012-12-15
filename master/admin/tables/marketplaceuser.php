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
* User Table class
*/
class TableMarketplaceUser extends JTable {

	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;

	/**
	 * @var string
	 */
	var $username = null;

	/**
	 * @var int
	 */
	var $moderator = null;

	/**
	 * @var int
	 */
	var $ads = null;

	/**
	 * @var int
	 */
	var $status = null;

	/**
	 * @var int
	 */
	var $blocked = null;


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
	var $zipcode = null;
	
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
	var $website = null;




	/**
	 * @var string
	 */
	var $params = null;



	function __construct(& $db) {
	
		parent::__construct( '#__ccmarketplace_users', 'id', $db);
		
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
