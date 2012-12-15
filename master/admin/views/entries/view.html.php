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

jimport('joomla.application.component.view');


class CCMarketplaceViewEntries extends JView {

	function display($tpl = null) {

		JHTML::_('behavior.tooltip');

        $option = "com_ccmarketplace";

        $app 		= JFactory::getApplication();

		$user 		= & JFactory::getUser();
		$db  		= & JFactory::getDBO();

		$search 			= $app->getUserStateFromRequest( $option.'.entries.search', 'search', '', 'string');
		$search 			= $db->getEscaped( trim( JString::strtolower( $search )));
		$filter_state		= $app->getUserStateFromRequest( $option.'.entries.filter_state', 'filter_state', '*', 'word');
		$filter_order		= $app->getUserStateFromRequest( $option.'.entries.filter_order', 'filter_order', 	'ordering', 'cmd' );
		$filter_order_Dir	= $app->getUserStateFromRequest( $option.'.entries.filter_order_Dir', 'filter_order_Dir', '', 'word' );


		$rows      	= & $this->get( 'Data');

		$pageNav 	= & $this->get( 'Pagination' );


		$lists['search']	= $search;
		$lists['state']		= JHTML::_('grid.state', $filter_state );
		$lists['order_Dir'] = $filter_order_Dir;
		$lists['order'] 	= $filter_order;


		$this->assignRef('lists'      	, $lists);
		$this->assignRef('user'			, $user);
		$this->assignRef('rows'      	, $rows);
		$this->assignRef('pageNav' 		, $pageNav);



		JToolBarHelper::title( "CCMarketplace - " . JText::_('CCMP_ENTRIES'), "marketplace.png");

		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();

		JToolBarHelper::divider();

		JToolBarHelper::addNew();
		JToolBarHelper::editList();
		JToolBarHelper::deleteList();

		JToolBarHelper::divider();

        if (JFactory::getUser()->authorise('core.admin', 'com_ccmarketplace')) {
		    JToolBarHelper::preferences('com_ccmarketplace', '600', '800');
        }

		JSubMenuHelper::addEntry(JText::_('CCMP_DASHBOARD'), 'index.php?option=com_ccmarketplace');
		JSubMenuHelper::addEntry(JText::_('CCMP_WEBSERVICES'), 'index.php?option=com_ccmarketplace&view=webservices');
		JSubMenuHelper::addEntry(JText::_('CCMP_GROUPS'), 'index.php?option=com_ccmarketplace&view=groupids');
		JSubMenuHelper::addEntry(JText::_('CCMP_CATEGORIES'), 'index.php?option=com_ccmarketplace&view=categories');
		JSubMenuHelper::addEntry(JText::_('CCMP_ENTRIES'), 'index.php?option=com_ccmarketplace&view=entries', true);
		JSubMenuHelper::addEntry(JText::_('CCMP_USERS'), 'index.php?option=com_ccmarketplace&view=users');
		JSubMenuHelper::addEntry(JText::_('CCMP_LABELS'), 'index.php?option=com_ccmarketplace&view=labels');


		parent::display($tpl);
	}

}
