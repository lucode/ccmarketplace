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

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted Access');


// get the controller
require_once(JPATH_COMPONENT.DS.'controller.php');

require_once(JPATH_COMPONENT.DS.'classes'.DS.'helper.php');


// instantiate and execute the controller
$controller = new CCMarketplaceController();

$controller->execute(JRequest::getCmd('task', 'display'));


// redirect
$controller->redirect();


?>