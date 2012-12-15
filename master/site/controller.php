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


jimport('joomla.application.component.controller');



/**
 * Marketplace Controller Index
 *
 */
class CCMarketplaceController extends JController {

	/**
	 * Display
	 *
	 */
	function display() {
			// Set a default view if none exists
			if ( ! JRequest::getCmd( 'view' ) ) {
				JRequest::setVar('view', 'index' );
			}

	        parent::display();

	}

}
