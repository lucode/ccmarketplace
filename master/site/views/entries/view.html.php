<?php

/**
*
* CCMarketplace - Classified Ads for Joomla!
*
* @package		CCMarketplace
* @subpackage	Frontend
* @author		Achim Fischer
* @copyright	Copyright (C) 2005-2012 Achim Fischer (Codingfish). All rights reserved.
* @link			http://www.codingfish.com
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.view');



/** 
 * Category View 
 */ 
class CCMarketplaceViewEntries extends JView { 


	/** 
     * Renders the view 
     * 
     */ 
    function display() { 
				
		$document =& JFactory::getDocument();
		
        $app 		= JFactory::getApplication();
        $pathway	= &$app->getPathway();

		$entries                    =& $this->get('Entries');
		$pagination                 =& $this->get('Pagination');


		// get parameters
		$params = &$app->getParams();

		$menus	= &JSite::getMenu();
		$menu	= $menus->getActive();

        /*
		if (is_object( $menu )) {
			$menu_params = new JParameter( $menu->params );
			if (!$menu_params->get( 'page_title')) {
				$params->set('page_title',	JText::_( 'CCMP_MY_ENTRIES' ));
			}
		} else {
			$params->set('page_title',	JText::_( 'CCMP_MY_ENTRIES' ));
		}
        */

		$document->setTitle( $params->get( 'page_title' ) );

		//set breadcrumbs
		if( is_object($menu) && $menu->query['view'] != 'entries') {
			$pathway->addItem( JText::_( 'CCMP_MY_ENTRIES' ), '');
		}


        
		$this->assignRef('entries',	$entries);
		$this->assignRef('pagination', $pagination);
                
		$this->assignRef('params',		$params);

                
        // display the view 
        parent::display(); 

    }


}

