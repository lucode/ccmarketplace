<?php
/**
 * CCMarketplace package
 * @author JExtension <contact@jextn.com>
 * @link http://www.jextn.com
 * @copyright (C) 2012 - 2013 JExtension
 * @license GNU/GPL, see LICENSE.php for full license.
**/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.modellist');

class CCMarketplaceModelGroupids extends JModel
{

	var $_data = null;

	var $_total = null;

	var $_pagination = null;

	var $_table = null;





	function __construct() {

		parent::__construct();

        $option = "com_marketprice_groupid";

        $app 		= JFactory::getApplication();

		$limit		= $app->getUserStateFromRequest( 'global.list.limit', 'limit', $app->getCfg('list_limit'), 'int' );

		$limitstart	= $app->getUserStateFromRequest( $option.'.limitstart', 'limitstart', 0, 'int' );

		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

		$this->setState('limit', $limit);

		$this->setState('limitstart', $limitstart);

	}



	function getData() {

		if ( empty( $this->_data)) {

			$query = $this->_buildQuery();

			$this->_data = $this->_getList( $query, $this->getState('limitstart'), $this->getState('limit'));

		}

		return $this->_data;
	}



	function getTotal() {

		if ( empty( $this->_total)) {

			$query = $this->_buildQuery();

			$this->_total = $this->_getListCount( $query);

		}

		return $this->_total;

	}



	function getPagination() {

		if (empty($this->_pagination)) {

			jimport('joomla.html.pagination');

			$this->_pagination = new JPagination( $this->getTotal(), $this->getState('limitstart'), $this->getState('limit'));

		}

		return $this->_pagination;

	}




	function _buildQuery() {

		$where		= $this->_buildContentWhere();

		$orderby	= $this->_buildContentOrderBy();

		$query = "SELECT * FROM #__ccmarketplace_ws_grpfiltrs " . $where . $orderby;

		return $query;

	}



	function _buildContentOrderBy() {

        $option = "com_marketprice_groupid";

        $app = JFactory::getApplication();

		$filter_order		= $app->getUserStateFromRequest( $option.'filter_order',		'filter_order',		'id',	'cmd' );

		$filter_order_Dir	= $app->getUserStateFromRequest( $option.'filter_order_Dir',	'filter_order_Dir',	'ASC',	'word' );

		if(empty($filter_order) && empty($filter_order_Dir)) {
			$filter_order = 'id';
			$filter_order_Dir = "ASC";
		}
		$orderby 	= ' ORDER BY '.$filter_order.' '.$filter_order_Dir;

		return $orderby;

	}



	function _buildContentWhere() {

        $option = "com_marketprice_groupid";

        $app = JFactory::getApplication();

		$db					=& JFactory::getDBO();

		$filter_state		= $app->getUserStateFromRequest( $option.'filter_state', 'filter_state',	'',	'word' );
		$search				= $app->getUserStateFromRequest( $option.'search', 'search', '', 'string' );
		$search				= JString::strtolower( $search );

		$where = array();

		if ($search) {
			$where[] = 'LOWER(gname) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false ).
					' or LOWER(login_page_name) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
		}

		if($filter_state) {
			$state   = $filter_state == 'P' ? 1 : 0;
			$where[] = 'published = '.$state;
		}


		$where = ( count( $where ) ? ' WHERE '. implode( ' AND ', $where ) : '' );

		return $where;

	}


	function publish( $cid = array(), $publish = 1) {

		if (count( $cid )) {

			$cids = implode( ',', $cid );

			$query = 'UPDATE #__ccmarketplace_ws_grpfiltrs'
						. ' SET published = ' . (int) $publish
						. ' WHERE id IN ('. $cids .')';

			$this->_db->setQuery( $query );

			if ( !$this->_db->query()) {

				$this->setError( $this->_db->getErrorMsg());

				return false;

			}

		}

		return true;

	}

	function webchannel($id) {
		$db	    = JFactory::getDBO();

		$query  = 'SELECT name from #__ccmarketplace_ws_channels where id in('.$id.')';
		$db->setQuery( $query );
		$row    = $db->loadResultArray();
		$row    = implode("\n", $row);

		if (!$db->query())
		{
			JError::raiseWarning(20, JText::_('Error'));
		}

		return $row;
	}
	

}

?>
