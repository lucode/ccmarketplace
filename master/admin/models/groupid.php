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

jimport('joomla.application.component.modeladmin');

class CCMarketplaceModelGroupid extends JModel
{
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

			$query = 'SELECT * FROM #__ccmarketplace_ws_grpfiltrs WHERE id = '.(int) $this->_id;

			$this->_db->setQuery($query);

			$this->_data = $this->_db->loadObject();

			return (boolean) $this->_data;

		}

		return true;

	}



	function store( $data) {

        $row =& JTable::getInstance('groupid', 'CCmarketplaceTable');
		
		$data['webchannelid'] = implode(',',$data['webchannelid']);
		
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

		//return true;
		return $row->id;
	}



	function _initData() {

		if (empty($this->_data)) {

			$category = new stdClass();

			$category->id				= 0;

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

			$query = 'DELETE FROM #__ccmarketplace_ws_channels' . ' WHERE id IN ( '.$cids.' )';

			$this->_db->setQuery( $query );

			if(!$this->_db->query()) {

				$this->setError($this->_db->getErrorMsg());

				return false;

			}

		}

		return true;

	}

	function webchannel_dropdown($active = null) {
	
		if($active) {
			$active = explode(',',$active);
		}
		
		$db	    = JFactory::getDBO();

		$query  = 'SELECT id,name,serverurl from #__ccmarketplace_ws_channels';
		$db->setQuery( $query );
		$row    = $db->loadAssocList();

		if (!$db->query())
		{
			JError::raiseWarning(20, JText::_('Error'));
		}

		$option[] = JHTML::_('select.option',  '', "--".JText::_( 'Select' )."--");
		foreach ( $row as $channel)
		{
			$option[] = JHTML::_('select.option',$channel['id'],$channel['name']."(".$channel['serverurl'].")");
		}

		$leader = JHTML::_('select.genericlist',  $option, 'webchannelid[]', 'class="inputbox" size="5" Multiple', 'value', 'text', $active);

		return $leader;
	}
}
?>
