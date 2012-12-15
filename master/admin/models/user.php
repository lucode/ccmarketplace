<?php

/**
*
* CCMarketplace - Classified Ads for Joomla!
*
* @package		CCMarketplace
* @subpackage	Backend
* @author		Achim Fischer
* @copyright	Copyright (C) 2005-2012 Achim Fischer (Codingfish). All rights reserved.
* @link			http://www.codingfish.com
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

JTable::addIncludePath(JPATH_COMPONENT.DS.'tables');



class CCMarketplaceModelUser extends JModel {

	var $_id = null;

	var $_data = null;



	function __construct() {

		parent::__construct();

		$array  = JRequest::getVar( 'cid', array(0), '', 'array');
		$edit	= JRequest::getVar( 'edit', true);
		
		if($edit) {
		
			$this->setId( (int)$array[0]);
			
		}
						
	}



	function setId( $id) {
	
		$this->_id		= $id;
		
		$this->_data	= null;
		
	}



	function &getData() {
	
		if ( $this->_loadData()) {

			$user = &JFactory::getUser();

		}
		else  {
			$this->_initData();
		}

		return $this->_data;
	}



	function _loadData() {
	
		if (empty($this->_data)) {
		
			$query = 'SELECT * FROM #__ccmarketplace_users WHERE id = '.(int) $this->_id;
					
			$this->_db->setQuery($query);
			
			$this->_data = $this->_db->loadObject();
			
			return (boolean) $this->_data;
			
		}
		
		return true;
		
	}



	function store( $data) {
	
		$row =& JTable::getInstance('marketplaceuser', 'Table');

		if ( !$row->bind($data)) {
		
			$this->setError($this->_db->getErrorMsg());
			
			return false;
			
		}

		if ( !$row->check()) {
		
			$this->setError( $this->_db->getErrorMsg());
			
			return false;
			
		}

		if ( !$row->store()) {
		
			$this->setError( $this->_db->getErrorMsg());
			
			return false;
			
		}

		return true;
	}



	function _initData() {

		if (empty($this->_data)) {
		
			$user = new stdClass();
			
			$user->id			= 0;
			$user->username		= "";
			$user->status		= 0;
			$user->ads			= 0;
			$user->moderator	= 0;
			$user->blocked		= 0;

			$user->firstname	= "";
			$user->lastname		= "";
			$user->company		= "";

			$user->street		= "";
			$user->zipcode		= "";
			$user->city			= "";
			$user->state		= "";
			$user->country		= "";

			$user->phone		= "";
			$user->mobile		= "";
			$user->email		= "";
			$user->website		= "";
									
			$this->_data		= $user;
			
			return (boolean) $this->_data;
			
		}
		
		return true;
		
	}



}