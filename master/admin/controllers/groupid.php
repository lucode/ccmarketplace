<?php
/**
*
* CCMarketplace - Classified Ads for Joomla!
*
* @package		CCMarketplace
* @subpackage	Backend
* @author		Lucas Huber
*
*/
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

class CCMarketplaceControllerGroupid extends JController
{
	function display() {

        JRequest::setVar('view', 'groupid');


		switch( $this->getTask()) {

			case 'add' : {
				JRequest::setVar( 'hidemainmenu', 1 );
				JRequest::setVar( 'view'  , 'groupid');
				JRequest::setVar( 'edit', false );
				break;
			}

			case 'edit' : {
				JRequest::setVar( 'hidemainmenu', 1 );
				JRequest::setVar( 'view'  , 'groupid');
				JRequest::setVar( 'edit', true );
				break;
			}

			case 'cancel' : {
				JRequest::setVar( 'view'  , 'groupids');
				break;
			}

			default : {

				break;
			}

		}


        parent::display();

    }

	function save() {
		$this->store('save');
	}

	function apply() {
		$this->store('apply');
	}

	function store($task) {

		JRequest::checkToken() or jexit( 'Invalid Token' );

		$post	= JRequest::get('post');

		$cid	= JRequest::getVar( 'cid', array(0), 'post', 'array' );

		$post['id'] = (int) $cid[0];

		$model = $this->getModel('groupid');

		if ( $id = $model->store( $post)) {

			$msg = JText::_( 'CCMP_GROUP_SAVED' );

		}
		else {

			$msg = JText::_( 'CCMP_GROUP_SAVE_ERROR' );

		}

		if($task == "save")
		$link = 'index.php?option=com_ccmarketplace&view=groupids';
		else
		$link = 'index.php?option=com_ccmarketplace&view=groupid&task=edit&cid[]='.$id;

		$this->setRedirect( $link, $msg);

	}
}
?>
