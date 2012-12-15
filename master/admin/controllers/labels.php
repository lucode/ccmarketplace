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



class CCMarketplaceControllerLabels extends JController {


    function display() {

        JRequest::setVar('view', 'labels');

        parent::display();

    }


	function publish() {

		JRequest::checkToken() or jexit( 'Invalid Token' );

		$cid 	= JRequest::getVar( 'cid', array(0), 'post', 'array' );

		if ( !is_array( $cid ) || count( $cid ) < 1) {

			$msg = '';

			JError::raiseWarning(500, JText::_( 'SELECT ITEM PUBLISH' ) );

		}
		else {

			$model = $this->getModel( 'labels');

			if( !$model->publish( $cid, 1)) {
				JError::raiseError( 500, $model->getError());
			}

			$msg 	= JText::_( 'CCMP_LABEL_PUBLISHED');

			$cache = &JFactory::getCache('com_ccmarketplace');
			$cache->clean();

		}

		$this->setRedirect( 'index.php?option=com_ccmarketplace&view=labels', $msg );
	}


	function unpublish() {

		JRequest::checkToken() or jexit( 'Invalid Token' );

		$cid 	= JRequest::getVar( 'cid', array(0), 'post', 'array' );

		if ( !is_array( $cid ) || count( $cid ) < 1) {

			$msg = '';

			JError::raiseWarning(500, JText::_( 'SELECT ITEM UNPUBLISH' ) );

		}
		else {

			$model = $this->getModel( 'labels');

			if( !$model->publish( $cid, 0)) {
				JError::raiseError( 500, $model->getError());
			}

			$msg 	= JText::_( 'CCMP_LABEL_UNPUBLISHED');

			$cache = &JFactory::getCache('com_ccmarketplace');
			$cache->clean();

		}

		$this->setRedirect( 'index.php?option=com_ccmarketplace&view=labels', $msg );
	}


	function edit() {

		JRequest::checkToken() or jexit( 'Invalid Token' );

		JRequest::setVar( 'view', 'label' );

		JRequest::setVar( 'hidemainmenu', 1 );

		$model 	= $this->getModel('label');

		parent::display();

	}


	function add() {

		JRequest::checkToken() or jexit( 'Invalid Token' );

		JRequest::setVar( 'view', 'label' );

		JRequest::setVar( 'hidemainmenu', 1 );

		$model 	= $this->getModel('label');

		parent::display();

	}



	function remove() {

		JRequest::checkToken() or jexit( 'Invalid Token' );

		$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );

		JArrayHelper::toInteger( $cid);

		if (count( $cid ) < 1) {

			JError::raiseError(500, JText::_( 'Select an item to delete' ) );

		}

		$model = $this->getModel('label');

		if( !$model->delete( $cid)) {

			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";

		}

		$this->setRedirect( 'index.php?option=com_ccmarketplace&view=labels' );

	}



}
