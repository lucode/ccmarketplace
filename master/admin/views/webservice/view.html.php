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

class CCMarketplaceViewWebservice extends JView
{
	function display($tpl = null) {

		$model = &$this->getModel();

		$user = & JFactory::getUser();

		$custom_fields = "";

		$edit = JRequest::getVar('edit',true);
		$text = !$edit ? JText::_( 'New' ) : JText::_( 'Edit' );

        JToolBarHelper::title(   "CCMarketplace - " . JText::_('CCMP_WEBSERVICE') . ': <small><small>[ ' . $text.' ]</small></small>', "marketplace.png" );

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
		JSubMenuHelper::addEntry(JText::_('CCMP_WEBSERVICES'), 'index.php?option=com_ccmarketplace&view=webservices', true);
		JSubMenuHelper::addEntry(JText::_('Categories'), 'index.php?option=com_ccmarketplace&view=categories');
		JSubMenuHelper::addEntry(JText::_('Entries'), 'index.php?option=com_ccmarketplace&view=entries');
		JSubMenuHelper::addEntry(JText::_('Users'), 'index.php?option=com_ccmarketplace&view=users');
		JSubMenuHelper::addEntry(JText::_('Labels'), 'index.php?option=com_ccmarketplace&view=labels');

		$webservice	   =& $this->get('data');

		if($webservice->id) {
			$custom_fields = $model->getfields($webservice);
		}

		$radios_no = array(
				JHTML::_('select.option',  '0' , 'No'),
				JHTML::_('select.option',  '1'  , 'Yes'),
			);

		/*$adstype  = array(
				JHTML::_('select.option',  '1'  , 'Dienstleitung'),
				JHTML::_('select.option',  '2'  , 'Waren'),
				JHTML::_('select.option',  '0'  , 'Both'),
			);*/
		$adstype  = array(
				JHTML::_('select.option',  '1'  , 'Service'),
				JHTML::_('select.option',  '2'  , 'Goods'),
				JHTML::_('select.option',  '3'  , 'For-rent'),
				JHTML::_('select.option',  '4'  , 'All'),
			);

		$interfacetype  = array(
				JHTML::_('select.option',  '1'  , 'Cyclos 3.7x (SOAP)'),
				JHTML::_('select.option',  '2'  , 'Cyclos 4.0 (REST) !!NA!!'),
			);

		$type_of_trade = array(
				JHTML::_('select.option',  ''            , "--".JText::_( 'CCMP_TYPE_OF_TRADE' )."--"),
				JHTML::_('select.option',  'OFFER' , JText::_('CCMP_OFFER')),
				JHTML::_('select.option',  'SEARCH'  , JText::_('CCMP_SEARCH')),
				JHTML::_('select.option',  'BOTH'   , JText::_('CCMP_BOTH')),
			);

		//$this->assignRef( 'lists', $lists);
		$this->assignRef( 'webservice', $webservice);
		$this->assignRef( 'type_of_trade', $type_of_trade);
		$this->assignRef( 'custom_fields', $custom_fields);
		$this->assignRef( 'adstype', $adstype);
		$this->assignRef( 'radios_no', $radios_no);
		$this->assignRef( 'interfacetype', $interfacetype);

		parent::display();
	}
}
?>