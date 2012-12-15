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



class CCMarketplaceControllerLabel extends JController {

    function display() {

        JRequest::setVar('view', 'label');


		switch( $this->getTask()) {

			case 'add' : {
				JRequest::setVar( 'hidemainmenu', 1 );
				JRequest::setVar( 'view'  , 'label');
				JRequest::setVar( 'edit', false );
				break;
			}

			case 'edit' : {
				JRequest::setVar( 'hidemainmenu', 1 );
				JRequest::setVar( 'view'  , 'label');
				JRequest::setVar( 'edit', true );
				break;
			}

			case 'cancel' : {
				JRequest::setVar( 'view'  , 'labels');
				break;
			}

			default : {

				break;
			}

		}


        parent::display();

    }



	function save() {

		JRequest::checkToken() or jexit( 'Invalid Token' );

		$post	= JRequest::get('post');

		$cid	= JRequest::getVar( 'cid', array(0), 'post', 'array' );

		$post['id'] = (int) $cid[0];

		$model = $this->getModel('label');

		if ( $model->store( $post)) {

			$msg = JText::_( 'CCMP_LABEL_SAVED' );

		}
		else {

			$msg = JText::_( 'CCMP_LABEL_SAVE_ERROR' );

		}

		$link = 'index.php?option=com_ccmarketplace&view=labels';

		$this->setRedirect( $link, $msg);

	}




}
