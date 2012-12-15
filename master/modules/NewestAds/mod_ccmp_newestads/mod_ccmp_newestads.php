<?php
/**
 * @package		CCMarketplace
 * @subpackage	Modul mod_ccmp_newestads
 * @version		1.0
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

jimport( 'joomla.environment.request' );

// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';

$document 		= JFactory::getDocument();
//Load Layout Style
$document->addStylesheet(JURI::base(true) . '/modules/mod_ccmp_newestads/assets/style.css');

$helper 		= new modnewestadsHelper();
$value          = $helper->getWebservice($params);
$data  		    = $helper->getAdsdata();

require JModuleHelper::getLayoutPath('mod_ccmp_newestads', $params->get('view', 'vertical'));
?>
