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
jimport( 'joomla.html.parameter');

/**
 * Index View
 */
class CCMarketplaceViewIndex extends JView {


	/**
     * Renders the view
     *
     */
    function display() {

		$document =& JFactory::getDocument();

		$categories =& $this->get('Categories');


		// get parameters
        $params =& JComponentHelper::getParams('com_ccmarketplace');

		$menus	= &JSite::getMenu();
		$menu	= $menus->getActive();


        if (is_object( $menu )) {

            $menu_params = new JParameter( $menu->params );
            $pageTitle = $menu_params->get( 'page_title');

            if (!$menu_params->get( 'page_title')) {
                $params->set( 'page_title', JText::_( 'Categories' ) );
            }
            else {
                $params->set( 'page_title', $pageTitle );
            }
        } else {
            $params->set( 'page_title', JText::_( 'Categories' ) );
        }


		$document->setTitle( $params->get( 'page_title' ) );



		$this->assignRef('categories',	$categories);
		$this->assignRef('params',		$params);


        // display the view
        parent::display();

    }


}

