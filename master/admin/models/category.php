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



class CCMarketplaceModelCategory extends JModel {

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
		
			$query = 'SELECT * FROM #__ccmarketplace_categories WHERE id = '.(int) $this->_id;
					
			$this->_db->setQuery($query);
			
			$this->_data = $this->_db->loadObject();
			
			return (boolean) $this->_data;
			
		}
		
		return true;
		
	}



	function store( $data) {
	
        $row =& JTable::getInstance('marketplacecategory', 'Table');

		if ( !$row->bind($data)) {
		
			$this->setError($this->_db->getErrorMsg());
			
			return false;
			
		}



		
		if ( !$row->id) { // new entry

			$row->created  = gmdate('Y-m-d H:i:s');
			$row->modified = gmdate('Y-m-d H:i:s');
		
			$where = 'parent_id = ' . (int) $row->parent_id ;
			
			$row->ordering = $row->getNextOrder( $where );
			
		}
		else { // edited entry
		
			$row->modified = gmdate('Y-m-d H:i:s');
			
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
		
			$category = new stdClass();
			
			$category->id				= 0;
			$category->parent_id		= 0;
			$category->name				= "";
			$category->alias			= "";
			$category->description		= "";
			$category->image			= null;
			$category->published		= 0;
			$category->ordering	    	= 0;
			$category->show_image		= 1;

			$category->use_firstname	= 2;
			$category->use_lastname		= 2;
			$category->use_street		= 2;
			$category->use_zip			= 2;
			$category->use_city			= 2;
			$category->use_state		= 2;
			$category->use_country		= 2;
			$category->use_phone		= 2;
			$category->use_mobile		= 2;
			$category->use_email		= 2;
			$category->use_web			= 2;
			$category->use_condition	= 2;
			$category->use_price		= 2;			
			
			$this->_data				= $category;
			
			return (boolean) $this->_data;
			
		}
		
		return true;
		
	}



	function delete($cid = array()) {
	
		$result = false;

		if (count( $cid )) {
		
			JArrayHelper::toInteger($cid);
			
			$cids = implode( ',', $cid );
			
			$query = 'DELETE FROM #__ccmarketplace_categories' . ' WHERE id IN ( '.$cids.' )';
				
			$this->_db->setQuery( $query );
			
			if(!$this->_db->query()) {
			
				$this->setError($this->_db->getErrorMsg());
				
				return false;
				
			}
			
		}

		return true;
		
	}






}