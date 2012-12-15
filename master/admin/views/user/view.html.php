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


class CCMarketplaceViewUser extends JView {

	function display($tpl = null) {

		$model = &$this->getModel();

		$user = & JFactory::getUser();

		$edit = JRequest::getVar('edit',true);
		$text = !$edit ? JText::_( 'New' ) : JText::_( 'Edit' );

        JToolBarHelper::title(   "CCMarketplace - " . JText::_('CCMP_USER') . ': <small><small>[ ' . $text.' ]</small></small>', "marketplace.png" );


		JToolBarHelper::save();

		if ( !$edit) {
			JToolBarHelper::cancel();
		}
		else {
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}

		JToolBarHelper::divider();

        if (JFactory::getUser()->authorise('core.admin', 'com_ccmarketplace')) {
		    JToolBarHelper::preferences('com_ccmarketplace', '600', '800');
        }

		JSubMenuHelper::addEntry(JText::_('Dashboard'), 'index.php?option=com_ccmarketplace');
		JSubMenuHelper::addEntry(JText::_('CCMP_WEBSERVICES'), 'index.php?option=com_ccmarketplace&view=webservices');
		JSubMenuHelper::addEntry(JText::_('Categories'), 'index.php?option=com_ccmarketplace&view=categories');
		JSubMenuHelper::addEntry(JText::_('Entries'), 'index.php?option=com_ccmarketplace&view=entries');
		JSubMenuHelper::addEntry(JText::_('Users'), 'index.php?option=com_ccmarketplace&view=users', true);
		JSubMenuHelper::addEntry(JText::_('Labels'), 'index.php?option=com_ccmarketplace&view=labels');


		$user	=& $this->get('data');


		$this->assignRef( 'user', $user);


		parent::display( $tpl);
	}

}
