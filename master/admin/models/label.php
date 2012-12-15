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



class CCMarketplaceModelLabel extends JModel {

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
		
			$query = 'SELECT * FROM #__ccmarketplace_labels WHERE id = '.(int) $this->_id;
					
			$this->_db->setQuery($query);
			
			$this->_data = $this->_db->loadObject();
			
			return (boolean) $this->_data;
			
		}
		
		return true;
		
	}



	function store( $data) {
	
        $row =& JTable::getInstance('marketplacelabel', 'Table');

		if ( !$row->bind($data)) {
		
			$this->setError($this->_db->getErrorMsg());
			
			return false;
			
		}



		
		if ( !$row->id) { // new entry
		
			//$where = 'parent_id = ' . (int) $row->parent_id ;
			
			$row->ordering = $row->getNextOrder(); // todo ?
			
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
		
			$label = new stdClass();
			
			$label->id					= 0;
			$label->name				= "";
			$label->ordering	    	= 0;
			$label->published			= 0;
			
			$this->_data				= $label;
			
			return (boolean) $this->_data;
			
		}
		
		return true;
		
	}



	function delete($cid = array()) {
	
		$result = false;

		if (count( $cid )) {
		
			JArrayHelper::toInteger($cid);
			
			$cids = implode( ',', $cid );
			
			$query = 'DELETE FROM #__ccmarketplace_labels' . ' WHERE id IN ( '.$cids.' )';
				
			$this->_db->setQuery( $query );
			
			if(!$this->_db->query()) {
			
				$this->setError($this->_db->getErrorMsg());
				
				return false;
				
			}
			
		}

		return true;
		
	}






}