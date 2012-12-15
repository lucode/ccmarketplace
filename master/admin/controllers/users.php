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

jimport('joomla.application.component.controller');



class CCMarketplaceControllerUsers extends JController {


    function display() {
    
        JRequest::setVar('view', 'users');
        
        parent::display();
        
    }
        
                

	function edit() {	
	
		JRequest::checkToken() or jexit( 'Invalid Token' );
		
		JRequest::setVar( 'view', 'user' );
		
		JRequest::setVar( 'hidemainmenu', 1 );

		$model 	= $this->getModel('user');
		
		parent::display();
		
	}

        
        
}
