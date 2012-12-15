<?php
/**
* CC-Marketplace - Classified Ads for Joomla!
*
* @package	CC-Marketplace
* @subpackage	Backend
* @author	Lucas Huber (development@cc-hub.org)
* @copyright	Copyright (C) 2012-2012 CC-HUB.ORG, All rights reserved.
* @link		http://www.cc-hub.org
* @license	http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
* @description  CCMarketplace coded by Jextn.com based on Marketplace by Codingfish
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

JHTML::_('behavior.tooltip');
$user = & JFactory::getUser();

$db	=& JFactory::getDBO();
$sql = "SELECT version FROM " . $db->nameQuote( '#__ccmarketplace_meta')." WHERE id='1'";
$db->setQuery( $sql);
$version = $db->loadResult();


$view = JRequest::getWord('view');

$document = & JFactory::getDocument();
$document->addStyleSheet(JURI::base().'components/com_ccmarketplace/assets/ccmarketplace.css');


$controller = JRequest::getWord('view', 'dashboard');


require_once (JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php');
$classname = 'CCMarketplaceController'.$controller;
$controller = new $classname();
$controller->registerTask('saveAndNew', 'save');
$controller->execute(JRequest::getWord('task'));
$controller->redirect();


?>


<div id="mpFooter">
	<div id="mpFooterVersion">
		CCMarketplace v<?php echo $version; ?>
	</div>
	<div id="mpFooterCopyright">
		(c) 2012 <a href="http://www.cc-hub.org" target="_blank" title="CC-Hub Community Currency Hub">CC-Hub</a>
	</div>
</div>
