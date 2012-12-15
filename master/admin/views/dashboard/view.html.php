<?php

/**
*
* CC-Marketplace - Classified Ads for Joomla!
*
* @package		CC-Marketplace
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


class CCMarketplaceViewDashboard extends JView {

	function display($tpl = null) {

		$model = &$this->getModel();

		$latestEntries = $model->getLatestEntries();
		$this->assignRef('latestEntries',$latestEntries);

		$numOfEntries = $model->countEntries();
		$this->assignRef('numOfItems',$numOfItems);

		$numOfCategories = $model->countCategories();
		$this->assignRef('numOfCategories',$numOfCategories);

		$user = & JFactory::getUser();



        JToolBarHelper::title( "CC-Marketplace - " . JText::_('CCMP_DASHBOARD'), "marketplace.png");

        if (JFactory::getUser()->authorise('core.admin', 'com_ccmarketplace')) {
		    JToolBarHelper::preferences('com_ccmarketplace', '600', '800');
        }

		JSubMenuHelper::addEntry(JText::_('CCMP_DASHBOARD'), 'index.php?option=com_ccmarketplace', true);
		JSubMenuHelper::addEntry(JText::_('CCMP_WEBSERVICES'), 'index.php?option=com_ccmarketplace&view=webservices');
		JSubMenuHelper::addEntry(JText::_('CCMP_GROUPS'), 'index.php?option=com_ccmarketplace&view=groupids');
		JSubMenuHelper::addEntry(JText::_('CCMP_CATEGORIES'), 'index.php?option=com_ccmarketplace&view=categories');
		JSubMenuHelper::addEntry(JText::_('CCMP_ENTRIES'), 'index.php?option=com_ccmarketplace&view=entries');
		JSubMenuHelper::addEntry(JText::_('CCMP_USERS'), 'index.php?option=com_ccmarketplace&view=users');
		JSubMenuHelper::addEntry(JText::_('CCMP_LABELS'), 'index.php?option=com_ccmarketplace&view=labels');


		require_once ( JPATH_COMPONENT . DS . 'models' . DS . 'entries.php');
		$entriesModel = new CCMarketplaceModelEntries;
		$latestEntries = $entriesModel->latestEntries( 10);  // get 10 latest entries
		$this->assignRef( 'latestEntries', $latestEntries);



		parent::display($tpl);
	}

}
