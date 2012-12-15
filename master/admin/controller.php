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

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.controller' );



/**
 * Marketplace Controller
 */
class CCMarketplaceController extends JController {

	function __construct($config = array()) {
		parent::__construct($config);

		// Register Extra tasks
		$this->registerTask( 'add',  'display' );
		$this->registerTask( 'edit', 'display' );
	}


	function display() {
		parent::display();
	}


	function save() {
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$post	= JRequest::get('post');
		$cid	= JRequest::getVar( 'cid', array(0), 'post', 'array' );
		$post['id'] = (int) $cid[0];

		$model = $this->getModel('category');

		if ($model->store($post)) {
			$msg = JText::_( 'Category Saved' );
		} else {
			$msg = JText::_( 'Error Saving Category' );
		}

		$model->checkin();
		$link = 'index.php?option=com_ccmarketplace';
		$this->setRedirect($link, $msg);
	}


	function remove() {
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);

		if (count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to delete' ) );
		}

		$model = $this->getModel('category');
		if(!$model->delete($cid)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_ccmarketplace' );
	}


	function publish() {
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);

		if (count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to publish' ) );
		}

		$model = $this->getModel('category');
		if(!$model->publish($cid, 1)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_ccmarketplace' );
	}


	function unpublish() {
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);

		if (count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to unpublish' ) );
		}

		$model = $this->getModel('category');
		if(!$model->publish($cid, 0)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_ccmarketplace' );
	}


	function cancel()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		// Checkin the weblink
		$model = $this->getModel('category');
		$model->checkin();

		$this->setRedirect( 'index.php?option=com_ccmarketplace' );
	}


	function orderup() {
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$model = $this->getModel('category');
		$model->move(-1);

		$this->setRedirect( 'index.php?option=com_ccmarketplace');
	}


	function orderdown() {
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$model = $this->getModel('category');
		$model->move(1);

		$this->setRedirect( 'index.php?option=com_ccmarketplace');
	}


	function saveorder() {
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$cid 	= JRequest::getVar( 'cid', array(), 'post', 'array' );
		$order 	= JRequest::getVar( 'order', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);
		JArrayHelper::toInteger($order);

		$model = $this->getModel('category');
		$model->saveorder($cid, $order);

		$msg = JText::_( 'New ordering saved' );
		$this->setRedirect( 'index.php?option=com_ccmarketplace', $msg );
	}

}