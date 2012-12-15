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
 * Profile View
 */
class CCMarketplaceViewProfile extends JView {


	/**
     * Renders the view
     *
     */
    function display() {

		$document =& JFactory::getDocument();

        $app 		= JFactory::getApplication();
        $pathway	= &$app->getPathway();

        $headline   		=& $this->get('Headline');
        $task       		=& $this->get('Task');

        $firstname			=& $this->get('Firstname');
        $lastname			=& $this->get('Lastname');        
        $company			=& $this->get('Company');

        $street				=& $this->get('Street');
        $zipcode			=& $this->get('Zipcode');
        $city	   			=& $this->get('City');
        $state				=& $this->get('State');
        $country			=& $this->get('Country');

        $phone				=& $this->get('Phone');
        $mobile				=& $this->get('Mobile');

        $email				=& $this->get('Email');
        $website			=& $this->get('Website');


		// get parameters
		$params = &$app->getParams();

		$menus	= &JSite::getMenu();
		$menu	= $menus->getActive();

        /*
		if (is_object( $menu )) {
			$menu_params = new JParameter( $menu->params );
			if (!$menu_params->get( 'page_title')) {
				$params->set('page_title',	JText::_( 'Marketplace' ));
			}
		} else {
			$params->set('page_title',	JText::_( 'Marketplace' ));
		}
        */

		$document->setTitle( $params->get( 'page_title' ) );

		//set breadcrumbs
		if( is_object($menu) && $menu->query['view'] != 'profile') {
			$pathway->addItem( 'Profile', '');
		}


		$this->assignRef('headline', $headline);
		$this->assignRef('task', $task);

        $this->assignRef('firstname', $firstname);
        $this->assignRef('lastname', $lastname);
        $this->assignRef('company', $company);
				
        $this->assignRef('street', $street);
        $this->assignRef('zipcode', $zipcode);
        $this->assignRef('city', $city);
        $this->assignRef('state', $state);
        $this->assignRef('country', $country);

        $this->assignRef('phone', $phone);
        $this->assignRef('mobile', $mobile);
        
        $this->assignRef('email', $email);
        $this->assignRef('website', $website);

		$this->assignRef('params',		$params);


        // display the view
        parent::display();

    }



}
