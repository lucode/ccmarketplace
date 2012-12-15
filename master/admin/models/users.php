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



class CCMarketplaceModelUsers extends JModel {


	var $_data = null;

	var $_total = null;

	var $_pagination = null;

	var $_table = null;





	function __construct() {

		parent::__construct();

        $option = "com_ccmarketplace";

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

		$query = "SELECT id, username, status, ads, moderator, blocked " .
					" FROM #__ccmarketplace_users " . $where . $orderby;

		return $query;

	}



	function _buildContentOrderBy() {

        $option = "com_ccmarketplace";

        $app 	= JFactory::getApplication();

		$filter_order		= $app->getUserStateFromRequest( $option.'filter_order',		'filter_order',		'ordering',	'cmd' );

		$filter_order_Dir	= $app->getUserStateFromRequest( $option.'filter_order_Dir',	'filter_order_Dir',	'',	'word' );

		if ($filter_order == 'ordering'){

			$orderby 	= ' ORDER BY username ASC '.$filter_order_Dir;

		}
		else {

			$orderby 	= ' ORDER BY '.$filter_order.' '.$filter_order_Dir.' , id ';

		}

		return $orderby;

	}



	function _buildContentWhere() {

        $option = "com_ccmarketplace";

        $app 	= JFactory::getApplication();

		$db					=& JFactory::getDBO();

		$filter_state		= $app->getUserStateFromRequest( $option.'filter_state', 'filter_state',	'',	'word' );
		$search				= $app->getUserStateFromRequest( $option.'search', 'search', '', 'string' );
		$search				= JString::strtolower( $search );

		$where = array();

		if ($search) {
			$where[] = 'LOWER(username) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
		}


		$where = ( count( $where ) ? ' WHERE '. implode( ' AND ', $where ) : '' );

		return $where;

	}




}
