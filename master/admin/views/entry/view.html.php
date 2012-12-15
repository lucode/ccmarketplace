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


class CCMarketplaceViewEntry extends JView {

	function display($tpl = null) {

		$model = &$this->getModel();

		$user = & JFactory::getUser();

		$edit = JRequest::getVar('edit',true);
		$text = !$edit ? JText::_( 'New' ) : JText::_( 'Edit' );


        JToolBarHelper::title(   "CCMarketplace - " . JText::_('CCMP_ENTRY') . ': <small><small>[ ' . $text.' ]</small></small>', "marketplace.png" );

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
		JSubMenuHelper::addEntry(JText::_('Entries'), 'index.php?option=com_ccmarketplace&view=entries', true);
		JSubMenuHelper::addEntry(JText::_('Users'), 'index.php?option=com_ccmarketplace&view=users');
		JSubMenuHelper::addEntry(JText::_('Labels'), 'index.php?option=com_ccmarketplace&view=labels');


		$entry	=& $this->get('data');

		$entryLabelId     = $entry->label_id;
		$entryUserId      = $entry->user_id;
		$entryCategoryId  = $entry->category_id;


		$db =& JFactory::getDBO();

		$lists = array();


		// build user list
		$sql = "SELECT id, username FROM #__users WHERE block='0' ORDER BY username ASC";
		$db->setQuery($sql);

		if ( intval( $entryUserId) == 0) { // new entry
	    	$userlist[]   = JHTML::_('select.option',  '0', JText::_( '- Select User -' ), 'id', 'username' );
	    }
	    else {
			$userlist = array();
		}
	    $userlist         = array_merge( $userlist, $db->loadObjectList() );
	    $lists['user_id'] = JHTML::_('select.genericlist', $userlist, 'user_id', 'class="inputbox" size="1"','id', 'username', intval( $entryUserId) );



		// build category list
		if ( intval( $entryCategoryId) == 0) { // new category
			$categories[] = JHTML::_('select.option', '0', JText::_('- Select Category -'));
		}
		else {
			$categories   = array();
		}

		require_once ( JPATH_COMPONENT.DS.'models'.DS.'categories.php');
		$categoriesModel = new CCMarketplaceModelCategories;
		$tree = $categoriesModel->categoriesTree( $category);
		$categories = array_merge( $categories, $tree);
		$lists['category_id'] = JHTML::_('select.genericlist', $categories, 'category_id', 'class="inputbox"', 'value', 'text', intval( $entryCategoryId) );



		// build list of labels
		$sql = "SELECT id, name FROM #__ccmarketplace_labels WHERE published='1' ORDER BY ordering ASC";
		$db->setQuery($sql);

		if ( intval( $entryLabelId) == 0) { // new label
	    	$labellist[]   = JHTML::_('select.option',  '0', JText::_( '- Select Label -' ), 'id', 'name' );
		}
		else {
			$labellist = array();
		}
	    $labellist         = array_merge( $labellist, $db->loadObjectList() );
	    $lists['label_id'] = JHTML::_('select.genericlist', $labellist, 'label_id', 'class="inputbox" size="1"','id', 'name', intval( $entryLabelId ) );


		$lists['commercial'] = JHTML::_('select.booleanlist',  'flag_commercial', 'class="inputbox"', $entry->flag_commercial );
		$lists['featured']   = JHTML::_('select.booleanlist',  'flag_featured', 'class="inputbox"', $entry->flag_featured );
		$lists['top']        = JHTML::_('select.booleanlist',  'flag_top', 'class="inputbox"', $entry->flag_top );

		$lists['published']  = JHTML::_('select.booleanlist',  'published', 'class="inputbox"', $entry->published );


		$this->assignRef( 'lists', $lists);
		$this->assignRef( 'entry', $entry);


		parent::display( $tpl);
	}

}
