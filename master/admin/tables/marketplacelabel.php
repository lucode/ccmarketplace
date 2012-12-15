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
* Forum Table class
*/
class TableMarketplaceLabel extends JTable {

	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;

	/**
	 * @var string
	 */
	var $name = null;

	/**
	 * @var int
	 */
	var $ordering = null;

	/**
	 * @var int
	 */
	var $published = null;

	/**
	 * @var string
	 */
	var $params = null;



	function __construct(& $db) {
	
		parent::__construct( '#__ccmarketplace_labels', 'id', $db);
		
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
