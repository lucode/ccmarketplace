<?php

/**
*
* Marketplace - Classified Ads for Joomla!
*
* @package		Marketplace
* @subpackage	Backend
* @author		Achim Fischer
* @copyright	Copyright (C) 2005-2012 Achim Fischer (Codingfish). All rights reserved.
* @link			http://www.codingfish.com
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

if (!JFactory::getUser()->authorise('core.manage', 'com_ccmarketplace')) {
    return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

require_once (JPATH_COMPONENT.DS.'controller.php');

$controller	= new CCMarketplaceController( );
$controller->execute( JRequest::getCmd('task'));
$controller->redirect();