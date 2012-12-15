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
* Category Table class
*/
class TableMarketplaceCategory extends JTable {

	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;

	/**
	 * @var int
	 */
	var $parent_id = null;

	/**
	 * @var string
	 */
	var $name = null;

	/**
	 * @var string
	 */
	var $alias = null;

	/**
	 * @var string
	 */
	var $description = null;

	/**
	 * @var int
	 */
	var $show_image = null;

	/**
	 * @var string
	 */
	var $image = null;


	/**
	 * @var int
	 */
	var $published = null;

	/**
	 * @var datetime
	 */
	var $created = null;

	/**
	 * @var datetime
	 */
	var $modified = null;

	/**
	 * @var int
	 */
	var $ordering = null;

	/**
	 * @var string
	 */
	var $params = null;

	/**
	 * @var int
	 */
	var $use_firstname	= null;

	/**
	 * @var int
	 */
	var $use_lastname	= null;

	/**
	 * @var int
	 */
	var $use_street		= null;

	/**
	 * @var int
	 */
	var $use_zip		= null;

	/**
	 * @var int
	 */
	var $use_city		= null;

	/**
	 * @var int
	 */
	var $use_state		= null;

	/**
	 * @var int
	 */
	var $use_country	= null;

	/**
	 * @var int
	 */
	var $use_phone		= null;

	/**
	 * @var int
	 */
	var $use_mobile		= null;

	/**
	 * @var int
	 */
	var $use_email		= null;

	/**
	 * @var int
	 */
	var $use_web		= null;

	/**
	 * @var int
	 */
	var $use_condition	= null;

	/**
	 * @var int
	 */
	var $use_price		= null;			



	function __construct(& $db) {
	
		parent::__construct( '#__ccmarketplace_categories', 'id', $db);
		
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
