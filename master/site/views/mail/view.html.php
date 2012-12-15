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
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.view');


/**
 * Ads View
 */
class CCMarketplaceViewMail extends JView {


	/**
     * Renders the view
     *
     */
    function display() {

		$document   =& JFactory::getDocument();
		$app 		= JFactory::getApplication();
		$this->assignRef('mailid'     , JRequest::getvar('mailid'));
		$this->assignRef('mailsubject', JRequest::getvar('mailsubject'));		
		$this->assignRef('pview'   , JRequest::getvar('view'));
		$this->assignRef('pid'     , JRequest::getvar('pid'));
		$this->assignRef('playout' , JRequest::getvar('playout'));
		$this->assignRef('pmeid'   , JRequest::getvar('pmeid'));
		
        // display the view
        parent::display();

    }


}

