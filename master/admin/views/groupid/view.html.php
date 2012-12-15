<?php
/**
*
* CCMarketplace - Classified Ads for Joomla!
*
* @package		CCMarketplace
* @subpackage	Backend
* @author		Lucas Huber
*
*/

defined('_JEXEC') or die( 'Restricted Access' );

jimport('joomla.application.component.view');

class CCMarketplaceViewGroupid extends JView
{
	function display($tpl = null) {

		$model = &$this->getModel();

		$user = & JFactory::getUser();

		$edit = JRequest::getVar('edit');
		$text = !$edit ? JText::_( 'New' ) : JText::_( 'Edit' );

        JToolBarHelper::title(   "CCMarketplace - " . JText::_('CCMP_GROUP') . ': <small><small>[ ' . $text.' ]</small></small>', "marketplace.png" );

		JToolBarHelper::Apply();
		JToolBarHelper::save();

		JToolBarHelper::divider();

		if ( !$edit) {
			JToolBarHelper::cancel();
		}
		else {
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}

		if ( !$edit) {
			JToolBarHelper::divider();

	        if (JFactory::getUser()->authorise('core.admin', 'com_ccmarketplace')) {
			    JToolBarHelper::preferences('com_ccmarketplace', '600', '800');
	        }
		}

		JSubMenuHelper::addEntry(JText::_('Dashboard'), 'index.php?option=com_ccmarketplace');
		JSubMenuHelper::addEntry(JText::_('CCMP_WEBSERVICES'), 'index.php?option=com_ccmarketplace&view=webservices');
		JSubMenuHelper::addEntry(JText::_('Categories'), 'index.php?option=com_ccmarketplace&view=categories');
		JSubMenuHelper::addEntry(JText::_('Entries'), 'index.php?option=com_ccmarketplace&view=entries');
		JSubMenuHelper::addEntry(JText::_('Users'), 'index.php?option=com_ccmarketplace&view=users');
		JSubMenuHelper::addEntry(JText::_('Labels'), 'index.php?option=com_ccmarketplace&view=labels');
		JSubMenuHelper::addEntry(JText::_('CCMP_GROUPS'), 'index.php?option=com_ccmarketplace&view=groupids', true);

		$groupid	=& $this->get('data');

		//$this->assignRef( 'lists', $lists);
		$this->assignRef( 'groupid', $groupid);

		parent::display();
	}
}
?>