<?php

/**
*
* CCMarketplace - Classified Ads for Joomla!
*
* @package		Marketplace
* @subpackage	Backend
* @author		Lucas Huber
*
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport('joomla.application.component.model');


/**
 * Marketplace Ads Model
 */

class CCMarketplaceModelMail extends JModel {

   public function __construct() {
		parent::__construct();
		$task   = JRequest::getString( 'task', '');
		if($task == "send_mail") {
			$this->send_mail();
		} else if($task == "set_mail") {
			$this->set_mail();
		}
    }

	function set_mail() {
		$post           = JRequest::get('post');
		//$post['mailid'] = "henry@adodis.com";
		JRequest::setvar('mailid'     , $post['mailid']);
		JRequest::setvar('mailsubject', $post['mailsubject']);
		JRequest::setvar('pview'      , $post['view']);
		JRequest::setvar('pid'     , $post['id']);
		JRequest::setvar('playout' , $post['layout']);
		JRequest::setvar('pmeid'   , $post['meid']);
	}

	function send_mail() {
		$mainframe      = JFactory::getApplication();
		$post           = JRequest::get('post');
		$from           = $post['email'];
		$fromname		= $post['name'];
		$to             = $post['mailid'];
		$subject        = "[".$mainframe->getCfg('sitename')."]".$post['mailsubject'];
		$body           = $post['comment'];
		$check			= JUtility::sendMail($from,$fromname, $to, $subject, $body, true);

		if($post['playout'] == "default_member") {
			$link = "index.php?option=com_ccmarketplace&view=ads&layout=".$post['playout']."&meid=".$post['pmeid']."&id=".JRequest::getInt('id')."&Itemid=".JRequest::getInt('Itemid');
		} else {
			$link = "index.php?option=com_ccmarketplace&view=ads&layout=".$post['playout']."&id=".JRequest::getInt('id')."&Itemid=".JRequest::getInt('Itemid');
		}

		if($check) {
			$mainframe->redirect( $link , JText::_( 'Sent SuccessFully' ), "message");
		} else {
			$mainframe->redirect( $link , JText::_( 'Sending Failed' ), "warning");
		}
	}
}
