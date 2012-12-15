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


class CCMarketplaceViewCategory extends JView {

	function display($tpl = null) {

		$model = &$this->getModel();

		$user = & JFactory::getUser();

		$edit = JRequest::getVar('edit',true);
		$text = !$edit ? JText::_( 'New' ) : JText::_( 'Edit' );

        JToolBarHelper::title(   "CCMarketplace - " . JText::_('CCMP_CATEGORY') . ': <small><small>[ ' . $text.' ]</small></small>', "marketplace.png" );


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
		JSubMenuHelper::addEntry(JText::_('Categories'), 'index.php?option=com_ccmarketplace&view=categories', true);
		JSubMenuHelper::addEntry(JText::_('Entries'), 'index.php?option=com_ccmarketplace&view=entries');
		JSubMenuHelper::addEntry(JText::_('Users'), 'index.php?option=com_ccmarketplace&view=users');
		JSubMenuHelper::addEntry(JText::_('Labels'), 'index.php?option=com_ccmarketplace&view=labels');

		$category	=& $this->get('data');

		$lists = array();

		$categories[] = JHTML::_('select.option', '0', JText::_('Top'));
		require_once ( JPATH_COMPONENT.DS.'models'.DS.'categories.php');
		$categoriesModel = new CCMarketplaceModelCategories;
		$tree = $categoriesModel->categoriesTree( $category);
		$categories = array_merge( $categories, $tree);
		$lists['parent'] = JHTML::_('select.genericlist', $categories, 'parent_id', 'class="inputbox"', 'value', 'text', $category->parent_id);

		$lists['published'] = JHTML::_('select.booleanlist',  'published', 'class="inputbox"', $category->published );

		$lists['show_image'] = JHTML::_('select.booleanlist',  'show_image', 'class="inputbox"', $category->show_image );


		$yesnoglobal[] = JHTML::_('select.option', '0', JText::_('No'));
		$yesnoglobal[1] = JHTML::_('select.option', '1', JText::_('Yes'));
		$yesnoglobal[2] = JHTML::_('select.option', '2', JText::_('Global'));
		$lists['use_firstname'] = JHTML::_('select.genericlist', $yesnoglobal, 'use_firstname', 'class="inputbox"', 'value', 'text', $category->use_firstname);
		$lists['use_lastname'] = JHTML::_('select.genericlist', $yesnoglobal, 'use_lastname', 'class="inputbox"', 'value', 'text', $category->use_lastname);
		$lists['use_street'] = JHTML::_('select.genericlist', $yesnoglobal, 'use_street', 'class="inputbox"', 'value', 'text', $category->use_street);
		$lists['use_zip'] = JHTML::_('select.genericlist', $yesnoglobal, 'use_zip', 'class="inputbox"', 'value', 'text', $category->use_zip);
		$lists['use_city'] = JHTML::_('select.genericlist', $yesnoglobal, 'use_city', 'class="inputbox"', 'value', 'text', $category->use_city);
		$lists['use_state'] = JHTML::_('select.genericlist', $yesnoglobal, 'use_state', 'class="inputbox"', 'value', 'text', $category->use_state);
		$lists['use_country'] = JHTML::_('select.genericlist', $yesnoglobal, 'use_country', 'class="inputbox"', 'value', 'text', $category->use_country);
		$lists['use_phone'] = JHTML::_('select.genericlist', $yesnoglobal, 'use_phone', 'class="inputbox"', 'value', 'text', $category->use_phone);
		$lists['use_mobile'] = JHTML::_('select.genericlist', $yesnoglobal, 'use_mobile', 'class="inputbox"', 'value', 'text', $category->use_mobile);
		$lists['use_email'] = JHTML::_('select.genericlist', $yesnoglobal, 'use_email', 'class="inputbox"', 'value', 'text', $category->use_email);
		$lists['use_web'] = JHTML::_('select.genericlist', $yesnoglobal, 'use_web', 'class="inputbox"', 'value', 'text', $category->use_web);
		$lists['use_condition'] = JHTML::_('select.genericlist', $yesnoglobal, 'use_condition', 'class="inputbox"', 'value', 'text', $category->use_condition);
		$lists['use_price'] = JHTML::_('select.genericlist', $yesnoglobal, 'use_price', 'class="inputbox"', 'value', 'text', $category->use_price);


		$this->assignRef( 'lists', $lists);
		$this->assignRef( 'category', $category);


		parent::display( $tpl);
	}

}
