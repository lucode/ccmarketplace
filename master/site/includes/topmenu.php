<?php

/**
*
* Marketplace - Classified Ads for Joomla!
*
* @package		Marketplace
* @subpackage	Frontend
* @author		Achim Fischer
* @copyright	Copyright (C) 2005-2012 Achim Fischer (Codingfish). All rights reserved.
* @link			http://www.codingfish.com
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once(JPATH_COMPONENT.DS.'classes/user.php');

// get parameters
$params = JComponentHelper::getParams('com_ccmarketplace');
$_backendMode = $params->get('backendMode', '0'); // 0 no, 1 yes


$user =& JFactory::getUser();
$logUser = new CofiUser( $user->id);


$menuLinkHome      	= JRoute::_( 'index.php?option=com_ccmarketplace');
$menuLinkNewEntry  	= JRoute::_( 'index.php?option=com_ccmarketplace&view=entry&task=create');
$menuLinkMyEntries 	= JRoute::_( 'index.php?option=com_ccmarketplace&view=entries&task=entries');
$menuLinkProfile 	= JRoute::_( 'index.php?option=com_ccmarketplace&view=profile&task=profile');

echo "<div id='mpTopmenu'>";

	echo "<a href='$menuLinkHome'>" . JText::_( 'CCMP_INDEX' ) . "</a>";

    if ( !$user->guest && !$logUser->isBlocked() && $_backendMode == 0 ) { // user is logged in and not blocked and not admin mode

    	echo "&nbsp;&nbsp;&nbsp;";
		echo "<a href='$menuLinkNewEntry'>" . JText::_( 'CCMP_NEW_ENTRY' ) . "</a>";

    	echo "&nbsp;&nbsp;&nbsp;";
		echo "<a href='$menuLinkMyEntries'>" . JText::_( 'CCMP_MY_ENTRIES' ) . "</a>";

    	echo "&nbsp;&nbsp;&nbsp;";
		echo "<a href='$menuLinkProfile'>" . JText::_( 'CCMP_PROFILE' ) . "</a>";

    }

echo "</div>";

