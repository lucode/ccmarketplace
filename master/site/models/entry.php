<?php

/**
*
* Marketplace - Classified Ads for Joomla!
*
* @package		Marketplace
* @subpackage	Frontend
* @author		Achim Fischer
* @copyright	Copyright (C) 2005-2012 Achim Fischer (Codingfish). All rights reserved.
* @link			http://www.codingfish.com
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport('joomla.application.component.model');

require_once(JPATH_COMPONENT.DS.'classes/user.php');



/**
 * Marketplace Entry Model
 */
class CCMarketplaceModelEntry extends JModel {


	/**
	 * task
	 *
	 * @var String
	 */
	var $_task = "";


	/**
	 * id
	 *
	 * @var Integer
	 */
	var $_id = 0;


	/**
	 * user_id
	 *
	 * @var Integer
	 */
	var $_user_id = 0;


	/**
	 * cat id
	 *
	 * @var integer
	 */
	var $_catid = 0;


	/**
	 * header
	 *
	 * @var String
	 */
	var $_header = null;


	/**
	 * firstname
	 *
	 * @var String
	 */
	var $_firstname = null;


	/**
	 * lastname
	 *
	 * @var String
	 */
	var $_lastname = null;


	/**
	 * company
	 *
	 * @var String
	 */
	var $_company = null;


	/**
	 * street
	 *
	 * @var String
	 */
	var $_street = null;


	/**
	 * zip
	 *
	 * @var String
	 */
	var $_zip = null;


	/**
	 * city
	 *
	 * @var String
	 */
	var $_city = null;


	/**
	 * state
	 *
	 * @var String
	 */
	var $_entryState = null;


	/**
	 * country
	 *
	 * @var String
	 */
	var $_country = null;


	/**
	 * phone
	 *
	 * @var String
	 */
	var $_phone = null;


	/**
	 * mobile
	 *
	 * @var String
	 */
	var $_mobile = null;


	/**
	 * email
	 *
	 * @var String
	 */
	var $_email = null;


	/**
	 * web
	 *
	 * @var String
	 */
	var $_web = null;


	/**
	 * headline
	 *
	 * @var String
	 */
	var $_headline = null;


	/**
	 * text
	 *
	 * @var String
	 */

	var $_text = null;


	/**
	 * condition
	 *
	 * @var String
	 */
	var $_entryCondition = null;


	/**
	 * price
	 *
	 * @var String
	 */
	var $_price = null;


	/**
	 * category id
	 *
	 * @var integer
	 */
	var $_categoryId = 0;


	/**
	 * category name
	 *
	 * @var String
	 */
	var $_categoryName = null;


	/**
	 * category slug
	 *
	 * @var String
	 */
	var $_categorySlug = null;


	/**
	 * category image
	 *
	 * @var String
	 */
	var $_categoryImage = null;



	/**
	 * image 1
	 *
	 * @var String
	 */

	var $_image1 = null;

	/**
	 * image 2
	 *
	 * @var String
	 */

	var $_image2 = null;

	/**
	 * image 3
	 *
	 * @var String
	 */

	var $_image3 = null;

	/**
	 * image 4
	 *
	 * @var String
	 */

	var $_image4 = null;

	/**
	 * image 5
	 *
	 * @var String
	 */

	var $_image5 = null;

	/**
	 * image 6
	 *
	 * @var String
	 */

	var $_image6 = null;

	/**
	 * image 7
	 *
	 * @var String
	 */

	var $_image7 = null;

	/**
	 * image 8
	 *
	 * @var String
	 */

	var $_image8 = null;

	/**
	 * image 9
	 *
	 * @var String
	 */

	var $_image9 = null;

	/**
	 * image 10
	 *
	 * @var String
	 */

	var $_image10 = null;


    /**
     * video 1
     *
     * @var String
     */

    var $_video1 = null;


    /**
     * published
     *
     * @var integer
     */
    var $_published = 0;


    /**
     * flag_commercial
     *
     * @var integer
     */
    var $_flag_commercial = 0;


    /**
     * expired
     *
     * @var integer
     */
    var $_expired = 0;


    /**
     * date created
     *
     * @var String
     */

    var $_date_created = null;



	/**
	 * Constructor
	 *
	 * @since 1.5
	 */
	function __construct() {

		parent::__construct();

        $app = JFactory::getApplication();

		$this->_header = "Entry";

		$user =& JFactory::getUser();
		$logUser = new CofiUser( $user->id);


		if ( $user->guest) { // user is not logged in

		}
		else { // user is logged in

		}

     	$this->_task   = JRequest::getString( 'task', '');

     	$this->_id     = JRequest::getInt( 'entry', 0);


		$this->_headline = JRequest::getString( 'headline', '', 'POST');
		$this->_headline = substr( strip_tags( $this->_headline), 0, 255);

		$this->_text = JRequest::getString( 'text', '', 'POST');
		//$this->_text = substr( strip_tags( $this->_text), 0, 255);
		$this->_text = strip_tags( $this->_text);


		// get parameters
		$params = JComponentHelper::getParams('com_ccmarketplace');
		$_backendMode = $params->get('backendMode', '0'); // 0 no, 1 yes


		switch ( $this->_task) {

			case "delete": {

				// check if backend mode is active
				if ( $_backendMode == 1) {
					$redirectLink = JRoute::_( "index.php?option=com_ccmarketplace&view=category");
					$app->redirect( $redirectLink, JText::_( 'CCMP_BACKEND_MODE_ONLY' ), "message");
				}

     			$this->deleteEntry();
				break;
			}

			case "reactivate": {

				// check if backend mode is active
				if ( $_backendMode == 1) {
					$redirectLink = JRoute::_( "index.php?option=com_ccmarketplace&view=category");
					$app->redirect( $redirectLink, JText::_( 'CCMP_BACKEND_MODE_ONLY' ), "message");
				}

     			$this->reactivateEntry();
				break;
			}


			case "new":
			case "create":
			case "create1":
			case "create2":
			case "create3": {
				// check if user is blocked
				if ( $logUser->isBlocked()) {
					$redirectLink = JRoute::_( "index.php?option=com_ccmarketplace&view=category");
					$app->redirect( $redirectLink, JText::_( 'CCMP_YOUR_ACCOUNT_HAS_BEEN_BLOCKED' ), "message");
				}

				// check if backend mode is active
				if ( $_backendMode == 1) {
					$redirectLink = JRoute::_( "index.php?option=com_ccmarketplace&view=category");
					$app->redirect( $redirectLink, JText::_( 'CCMP_BACKEND_MODE_ONLY' ), "message");
				}

				break;
			}

			default: {
				break;
			}

		}



		switch ( JRequest::getString( 'submit', '')) {

			//case "Save": {
			case JText::_( 'CCMP_SAVE' ): {

				// check if backend mode is active
				if ( $_backendMode == 1) {
					$redirectLink = JRoute::_( "index.php?option=com_ccmarketplace&view=category");
					$app->redirect( $redirectLink, JText::_( 'CCMP_BACKEND_MODE_ONLY' ), "message");
				}

     			$this->saveEntry();
				break;
			}

			//case "Update": {
			case JText::_( 'CCMP_UPDATE' ): {

				// check if backend mode is active
				if ( $_backendMode == 1) {
					$redirectLink = JRoute::_( "index.php?option=com_ccmarketplace&view=category");
					$app->redirect( $redirectLink, JText::_( 'CCMP_BACKEND_MODE_ONLY' ), "message");
				}

     			$this->updateEntry();
				break;
			}

			default: {
				$this->_header = "Entry";
				break;
			}

		}

	}




/**
 * delete entry
 *
 * @return int
 */
 function deleteEntry() {

    $app = JFactory::getApplication();

	$user =& JFactory::getUser();
	$logUser = new CofiUser( $user->id);

	$this->_header = JText::_( 'CCMP_ENTRY_DELETED' );


	// redirect	link
	$redirectLink = JRoute::_( "index.php?option=com_ccmarketplace&view=category");


    // check if user is logged in - maybe session has timed out
	if ($user->guest) {
		// if user is not logged in, kick him back to index page
		$app->redirect( $redirectLink, JText::_( 'CCMP_ENTRY_HAS_NOT_BEEN_DELETED_SESSION' ), "message");
	}


	$id       	= JRequest::getInt( 'entry', 0);

	$user_id 	= $user->id;


	$db =& $this->getDBO();

	$sql = "SELECT user_id FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE id=" . $db->Quote($id);

    $db->setQuery( $sql);
    $entry_user_id = $db->loadResult();


	if ( ($entry_user_id == $user_id) || $logUser->isModerator()) { // this is the owner or a moderator

	}
	else {
		$app->redirect( $redirectLink, JText::_( 'CCMP_ENTRY_HAS_NOT_BEEN_DELETED_OWNER' ), "message");
	}


	// remove images and images folders
	$this->rm_imagefolder( $id, $db);


	$sql = "DELETE FROM " . $db->nameQuote( '#__ccmarketplace_entries') . " WHERE id = " . $db->Quote($id);

	$db->setQuery( $sql);
	$result = $db->query();


	if ( $result) { // delete went fine
		$app->redirect( $redirectLink, JText::_( 'CCMP_ENTRY_HAS_BEEN_DELETED' ), "notice");
	}
	else {
		$app->redirect( $redirectLink, JText::_( 'CCMP_ENTRY_HAS_NOT_BEEN_DELETED_ERROR' ), "message");
	}

   	return 0; // delete OK

}


/**
 * reactivate entry
 *
 * @return int
 */
 function reactivateEntry() {

    $app = JFactory::getApplication();

	$user =& JFactory::getUser();
	$logUser = new CofiUser( $user->id);

	//$this->_header = JText::_( 'CCMP_ENTRY_DELETED' );


	// redirect	link
	$redirectLink = JRoute::_( "index.php?option=com_ccmarketplace&view=category");


    // check if user is logged in - maybe session has timed out
	if ($user->guest) {
		// if user is not logged in, kick him back to index page
		$app->redirect( $redirectLink, JText::_( 'CCMP_ENTRY_HAS_NOT_BEEN_REACTIVATED_SESSION' ), "message");
	}


	$id       	= JRequest::getInt( 'entry', 0);

	$user_id 	= $user->id;


	$db =& $this->getDBO();

	$sql = "SELECT user_id FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE id=" . $db->Quote($id);

    $db->setQuery( $sql);
    $entry_user_id = $db->loadResult();

	if ( ($entry_user_id == $user_id) || $logUser->isModerator()) { // this is the owner or a moderator

	}
	else {
		$app->redirect( $redirectLink, JText::_( 'CCMP_ENTRY_HAS_NOT_BEEN_REACTIVATED_OWNER' ), "message");
	}

	$sql = "SELECT expired FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE id=" . $db->Quote($id);

    $db->setQuery( $sql);
    $expired = $db->loadResult();

	if ( ($expired == 0)) { // this is not an expired entry
		$app->redirect( $redirectLink, JText::_( 'CCMP_ENTRY_HAS_NOT_BEEN_REACTIVATED_EXPIRED' ), "message");
	}


	// 1. set published=1
	// 2. set expired=0
	// 3. set date_created = today
	// 5. set date_lastmodified = today

	$date_today = gmdate('Y-m-d H:i:s');

	$sql = "UPDATE " . $db->nameQuote( '#__ccmarketplace_entries') .
					" SET" .
						" `published` = '1'," .
						" `expired` = '0'," .
						" `date_created` = " . $db->Quote( $date_today) . ", " .
						" `date_lastmodified` = " . $db->Quote( $date_today) .
     				" WHERE id = " . $db->Quote($id);

	$db->setQuery( $sql);
	$result = $db->query();

	if ( $result) { // reactivate went fine
		$app->redirect( $redirectLink, JText::_( 'CCMP_ENTRY_HAS_BEEN_REACTIVATED' ), "notice");
	}
	else {
		$app->redirect( $redirectLink, JText::_( 'CCMP_ENTRY_HAS_NOT_BEEN_REACTIVATED_ERROR' ), "message");
	}

   	return 0; // reactivate OK

}





/**
 * save entry
 *
 * @return int
 */
 function saveEntry() {

    $app = JFactory::getApplication();

	$user =& JFactory::getUser();

	$this->_header = JText::_( 'CCMP_ENTRY_SAVED' );


	// redirect	link
	$redirectLink = JRoute::_( "index.php?option=com_ccmarketplace&view=index");


    // check if user is logged in - maybe session has timed out
	if ($user->guest) {
		// if user is not logged in, kick him back to index page
		$app->redirect( $redirectLink, JText::_( 'CCMP_ENTRY_HAS_NOT_BEEN_SAVED_SESSION' ), "message");
	}


	$user_id 	    = $user->id;

    $flag_commercial = JRequest::getInt( 'flag_commercial', 0);

	$category_id    = JRequest::getInt( 'categoryselectbox', 0);
	$label_id       = JRequest::getInt( 'labelselectbox', 0);

	$firstname 	    = JRequest::getString( 'firstname', '', 'POST');
	$lastname       = JRequest::getString( 'lastname', '', 'POST');
	$company        = JRequest::getString( 'company', '', 'POST');

	$street   	    = JRequest::getString( 'street', '', 'POST');
	$zip   		    = JRequest::getString( 'zip', '', 'POST');
	$city   	    = JRequest::getString( 'city', '', 'POST');
	$state   	    = JRequest::getString( 'state', '', 'POST');
	$country   	    = JRequest::getString( 'country', '', 'POST');

	$phone 	        = JRequest::getString( 'phone', '', 'POST');
	$mobile         = JRequest::getString( 'mobile', '', 'POST');
	$email 	        = JRequest::getString( 'email', '', 'POST');
	$web            = JRequest::getString( 'web', '', 'POST');

	$headline       = JRequest::getString( 'entryHeadline', '', 'POST', JREQUEST_ALLOWRAW);
	$headline       = substr( strip_tags( $headline), 0, 255);

	// create alias for SEF URL
	jimport( 'joomla.filter.output' );

	$alias          = $headline;
	$alias          = JFilterOutput::stringURLSafe( $alias);


    $text           = JRequest::getString( 'entryText', '', 'POST', JREQUEST_ALLOWRAW);
	$text           = strip_tags( $text);

	$condition 	    = JRequest::getString( 'condition', '', 'POST');
	$price    	    = JRequest::getString( 'price', '', 'POST');

	$published = 1;



	$db =& $this->getDBO();


	$sql = "INSERT INTO ".$db->nameQuote( '#__ccmarketplace_entries') .
					" ( `category_id`, `label_id`, `user_id`, `firstname`, `lastname`, `company`, `street`, `zip`, `city`, `state`, `country`, " .
					" `phone`, `mobile`, `email`, `web`, `headline`, `alias`, `text`, `condition`, `price`, `flag_commercial`, `published`) " .
					" VALUES ( " .
					$db->Quote( $category_id) . ", " .
					$db->Quote( $label_id) . ", " .
					$db->Quote( $user_id) . ", " .
					$db->Quote( $firstname) . ", " .
					$db->Quote( $lastname) . ", " .
					$db->Quote( $company) . ", " .
					$db->Quote( $street) . ", " .
					$db->Quote( $zip) . ", " .
					$db->Quote( $city) .  ", " .
					$db->Quote( $state) .  ", " .
					$db->Quote( $country) .  ", " .
					$db->Quote( $phone) .  ", " .
					$db->Quote( $mobile) .  ", " .
					$db->Quote( $email) .  ", " .
					$db->Quote( $web) .  ", " .
					$db->Quote( $headline) . ", " .
					$db->Quote( $alias) . ", " .
					$db->Quote( $text) . ", " .
					$db->Quote( $condition) .  ", " .
					$db->Quote( $price) .  ", " .
                    $db->Quote( $flag_commercial) .  ", " .
					$db->Quote( $published) . " )";


	$db->setQuery( $sql);
	$result = $db->query();



	if ( $result) { // insert went fine

		// 1. get last_insert_id
		$db->setQuery( "SELECT LAST_INSERT_ID() FROM ".$db->nameQuote( '#__ccmarketplace_entries'));
		$entry_id = $db->loadResult();


		// 2. upload images to id folder

		// get folder name
		$rootDir = JPATH_ROOT;

		if (isset( $_FILES['image1']) and !$_FILES['image1']['error'] ) {
	    	$this->add_image( $entry_id, "image1", $rootDir, $db, 1);
		}

		if (isset( $_FILES['image2']) and !$_FILES['image2']['error'] ) {
	    	$this->add_image( $entry_id, "image2", $rootDir, $db, 2);
		}

		if (isset( $_FILES['image3']) and !$_FILES['image3']['error'] ) {
	    	$this->add_image( $entry_id, "image3", $rootDir, $db, 3);
		}

		if (isset( $_FILES['image4']) and !$_FILES['image4']['error'] ) {
	    	$this->add_image( $entry_id, "image4", $rootDir, $db, 4);
		}

		if (isset( $_FILES['image5']) and !$_FILES['image5']['error'] ) {
	    	$this->add_image( $entry_id, "image5", $rootDir, $db, 5);
		}

		if (isset( $_FILES['image6']) and !$_FILES['image6']['error'] ) {
	    	$this->add_image( $entry_id, "image6", $rootDir, $db, 6);
		}

		if (isset( $_FILES['image7']) and !$_FILES['image7']['error'] ) {
	    	$this->add_image( $entry_id, "image7", $rootDir, $db, 7);
		}

		if (isset( $_FILES['image8']) and !$_FILES['image8']['error'] ) {
	    	$this->add_image( $entry_id, "image8", $rootDir, $db, 8);
		}

		if (isset( $_FILES['image9']) and !$_FILES['image9']['error'] ) {
	    	$this->add_image( $entry_id, "image9", $rootDir, $db, 9);
		}

		if (isset( $_FILES['image10']) and !$_FILES['image10']['error'] ) {
	    	$this->add_image( $entry_id, "image10", $rootDir, $db, 10);
		}

		$app->redirect( $redirectLink, JText::_( 'CCMP_ENTRY_HAS_BEEN_SAVED' ), "notice");
	}
	else {
		$app->redirect( $redirectLink, JText::_( 'CCMP_ENTRY_HAS_NOT_BEEN_SAVED_ERROR' ), "message");
	}


    return 0; // save OK
 }





/**
 * update entry
 *
 * @return int
 */
 function updateEntry() {

    $app = JFactory::getApplication();

	$user =& JFactory::getUser();

	$this->_header = JText::_( 'CCMP_ENTRY_UPDATED' );


	// redirect	link
	$redirectLink = JRoute::_( "index.php?option=com_ccmarketplace&view=index");


    // check if user is logged in - maybe session has timed out
	if ($user->guest) {
		// if user is not logged in, kick him back to index page
		$app->redirect( $redirectLink, JText::_( 'CCMP_ENTRY_HAS_NOT_BEEN_UPDATED_SESSION' ), "message");
	}


	$id       	    = JRequest::getInt( 'entry', 0);

	$category_id    = JRequest::getInt( 'categoryselectbox', 0);
	$label_id       = JRequest::getInt( 'labelselectbox', 0);

	$firstname 	    = JRequest::getString( 'firstname', '', 'POST');
	$lastname       = JRequest::getString( 'lastname', '', 'POST');
	$company        = JRequest::getString( 'company', '', 'POST');

	$street   	    = JRequest::getString( 'street', '', 'POST');
	$zip   		    = JRequest::getString( 'zip', '', 'POST');
	$city   	    = JRequest::getString( 'city', '', 'POST');
	$state   	    = JRequest::getString( 'state', '', 'POST');
	$country   	    = JRequest::getString( 'country', '', 'POST');

	$phone 	        = JRequest::getString( 'phone', '', 'POST');
	$mobile         = JRequest::getString( 'mobile', '', 'POST');
	$email 	        = JRequest::getString( 'email', '', 'POST');
	$web            = JRequest::getString( 'web', '', 'POST');

	$headline       = JRequest::getString( 'entryHeadline', '', 'POST', JREQUEST_ALLOWRAW);
	$headline       = substr( strip_tags( $headline), 0, 255);

	// create alias for SEF URL
	jimport( 'joomla.filter.output' );

	$alias          = $headline;
	$alias          = JFilterOutput::stringURLSafe( $alias);

	$date_lastmodified = gmdate('Y-m-d H:i:s');


	$text           = JRequest::getString( 'entryText', '', 'POST', JREQUEST_ALLOWRAW);
	$text           = strip_tags( $text);


	$condition 	    = JRequest::getString( 'condition', '', 'POST');
	$price    	    = JRequest::getString( 'price', '', 'POST');


	$cb_image1      = JRequest::getString( 'cb_image1', '', 'POST');
	$cb_image2      = JRequest::getString( 'cb_image2', '', 'POST');
	$cb_image3      = JRequest::getString( 'cb_image3', '', 'POST');
	$cb_image4      = JRequest::getString( 'cb_image4', '', 'POST');
	$cb_image5      = JRequest::getString( 'cb_image5', '', 'POST');
	$cb_image6      = JRequest::getString( 'cb_image6', '', 'POST');
	$cb_image7      = JRequest::getString( 'cb_image7', '', 'POST');
	$cb_image8      = JRequest::getString( 'cb_image8', '', 'POST');
	$cb_image9      = JRequest::getString( 'cb_image9', '', 'POST');
	$cb_image10     = JRequest::getString( 'cb_image10', '', 'POST');

	// get folder name
	$rootDir = JPATH_ROOT;

	$db =& $this->getDBO();


	// update db

	$sql = "UPDATE ".$db->nameQuote( '#__ccmarketplace_entries') .
					" SET" .
					" `category_id` = " . $db->Quote( $category_id) . "," .
					" `label_id` = " . $db->Quote( $label_id) . "," .
					" `firstname` = " . $db->Quote( $firstname) . "," .
					" `lastname` = " . $db->Quote( $lastname) . "," .
					" `company` = " . $db->Quote( $company) . "," .
					" `street` = " . $db->Quote( $street) . "," .
					" `zip` = " . $db->Quote( $zip) . "," .
					" `city` = " . $db->Quote( $city) . "," .
					" `state` = " . $db->Quote( $state) . "," .
					" `country` = " . $db->Quote( $country) . "," .
					" `phone` = " . $db->Quote( $phone) . "," .
					" `mobile` = " . $db->Quote( $mobile) . "," .
					" `email` = " . $db->Quote( $email) . "," .
					" `web` = " . $db->Quote( $web) . "," .
					" `headline` = " . $db->Quote( $headline) . "," .
					" `alias` = " . $db->Quote( $alias) . "," .
					" `text` = " . $db->Quote( $text) . "," .
					" `condition` = " . $db->Quote( $condition) . "," .
					" `price` = " . $db->Quote( $price) . "," .
					" `date_lastmodified` = " . $db->Quote( $date_lastmodified) .
     				" WHERE id = " . $db->Quote($id);

	$db->setQuery( $sql);
	$result = $db->query();



    // check if there are images to delete
	if ( $cb_image1  == "delete") {
	    	$this->del_image( $id, "image1", $rootDir, $db, 1);
	}

	if ( $cb_image2  == "delete") {
	    	$this->del_image( $id, "image2", $rootDir, $db, 2);
	}

	if ( $cb_image3  == "delete") {
	    	$this->del_image( $id, "image3", $rootDir, $db, 3);
	}

	if ( $cb_image4  == "delete") {
	    	$this->del_image( $id, "image4", $rootDir, $db, 4);
	}

	if ( $cb_image5  == "delete") {
	    	$this->del_image( $id, "image5", $rootDir, $db, 5);
	}

	if ( $cb_image6  == "delete") {
	    	$this->del_image( $id, "image6", $rootDir, $db, 6);
	}

	if ( $cb_image7  == "delete") {
	    	$this->del_image( $id, "image7", $rootDir, $db, 7);
	}

	if ( $cb_image8  == "delete") {
	    	$this->del_image( $id, "image8", $rootDir, $db, 8);
	}

	if ( $cb_image9  == "delete") {
	    	$this->del_image( $id, "image9", $rootDir, $db, 9);
	}

	if ( $cb_image10  == "delete") {
	    	$this->del_image( $id, "image10", $rootDir, $db, 10);
	}




	if ( $result) { // update went fine

		$entry_id = $id;

		// upload images to id folder

		if (isset( $_FILES['image1']) and !$_FILES['image1']['error'] ) {
	    	$this->add_image( $entry_id, "image1", $rootDir, $db, 1);
		}

		if (isset( $_FILES['image2']) and !$_FILES['image2']['error'] ) {
	    	$this->add_image( $entry_id, "image2", $rootDir, $db, 2);
		}

		if (isset( $_FILES['image3']) and !$_FILES['image3']['error'] ) {
	    	$this->add_image( $entry_id, "image3", $rootDir, $db, 3);
		}

		if (isset( $_FILES['image4']) and !$_FILES['image4']['error'] ) {
	    	$this->add_image( $entry_id, "image4", $rootDir, $db, 4);
		}

		if (isset( $_FILES['image5']) and !$_FILES['image5']['error'] ) {
	    	$this->add_image( $entry_id, "image5", $rootDir, $db, 5);
		}

		if (isset( $_FILES['image6']) and !$_FILES['image6']['error'] ) {
	    	$this->add_image( $entry_id, "image6", $rootDir, $db, 6);
		}

		if (isset( $_FILES['image7']) and !$_FILES['image7']['error'] ) {
	    	$this->add_image( $entry_id, "image7", $rootDir, $db, 7);
		}

		if (isset( $_FILES['image8']) and !$_FILES['image8']['error'] ) {
	    	$this->add_image( $entry_id, "image8", $rootDir, $db, 8);
		}

		if (isset( $_FILES['image9']) and !$_FILES['image9']['error'] ) {
	    	$this->add_image( $entry_id, "image9", $rootDir, $db, 9);
		}

		if (isset( $_FILES['image10']) and !$_FILES['image10']['error'] ) {
	    	$this->add_image( $entry_id, "image10", $rootDir, $db, 10);
		}

		$app->redirect( $redirectLink, JText::_( 'CCMP_ENTRY_HAS_BEEN_UPDATED' ), "notice");
	}
	else {
		$app->redirect( $redirectLink, JText::_( 'CCMP_ENTRY_HAS_NOT_BEEN_UPDATED_ERROR' ), "message");
	}


    return 0; // update OK
 }








	/**
	 * Method to get the id of this entry
	 *
	 * @access public
	 * @return integer
	 */
	function getId() {

		return $this->_id;

	}



	/**
	 * Method to get the user id of this entry
	 *
	 * @access public
	 * @return integer
	 */
	function getUserid() {

		if (empty($this->_user_id)) {

        	$db =& $this->getDBO();

			$sql = "SELECT user_id FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE id=" . $db->Quote($this->_id);

            $db->setQuery( $sql);
            $this->_user_id = $db->loadResult();

		}

		return $this->_user_id;

	}


	/**
	 * Method to get the category id of this entry
	 *
	 * @access public
	 * @return integer
	 */
	function getCatid() {

		if (empty($this->_cat_id)) {

        	$db =& $this->getDBO();

			$sql = "SELECT category_id FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE id=" . $db->Quote($this->_id);

            $db->setQuery( $sql);
            $this->_cat_id = $db->loadResult();

		}

		return $this->_cat_id;

	}



	/**
	 * Method to get the label id of this entry
	 *
	 * @access public
	 * @return integer
	 */
	function getLabelid() {

		if (empty($this->_label_id)) {

        	$db =& $this->getDBO();

			$sql = "SELECT label_id FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE id=" . $db->Quote($this->_id);

            $db->setQuery( $sql);
            $this->_label_id = $db->loadResult();

		}

		return $this->_label_id;

	}



	/**
	 * Method to get the firstname of this entry
	 *
	 * @access public
	 * @return String
	 */
	function getFirstname() {

		$_id = JRequest::getInt('entry', 0);


		if ( $_id <> 0) {

			if (empty($this->_firstname)) {

	        	$db =& $this->getDBO();

				$sql = "SELECT firstname FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE id=" . $db->Quote($_id);

	            $db->setQuery( $sql);
	            $this->_firstname = $db->loadResult();

			}

		}

		return $this->_firstname;
	}


	/**
	 * Method to get the lastname of this entry
	 *
	 * @access public
	 * @return String
	 */
	function getLastname() {

		$_id = JRequest::getInt('entry', 0);


		if ( $_id <> 0) {

			if (empty($this->_lastname)) {

	        	$db =& $this->getDBO();

				$sql = "SELECT lastname FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE id=" . $db->Quote($_id);

	            $db->setQuery( $sql);
	            $this->_lastname = $db->loadResult();

			}

		}

		return $this->_lastname;
	}


	/**
	 * Method to get the company of this entry
	 *
	 * @access public
	 * @return String
	 */
	function getCompany() {

		$_id = JRequest::getInt('entry', 0);


		if ( $_id <> 0) {

			if (empty($this->_company)) {

	        	$db =& $this->getDBO();

				$sql = "SELECT company FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE id=" . $db->Quote($_id);

	            $db->setQuery( $sql);
	            $this->_company = $db->loadResult();

			}

		}

		return $this->_company;
	}



	/**
	 * Method to get the street of this entry
	 *
	 * @access public
	 * @return String
	 */
	function getStreet() {

		$_id = JRequest::getInt('entry', 0);


		if ( $_id <> 0) {

			if (empty($this->_street)) {

	        	$db =& $this->getDBO();

				$sql = "SELECT street FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE id=" . $db->Quote($_id);

	            $db->setQuery( $sql);
	            $this->_street = $db->loadResult();

			}

		}

		return $this->_street;
	}


	/**
	 * Method to get the zip of this entry
	 *
	 * @access public
	 * @return String
	 */
	function getZip() {

		$_id = JRequest::getInt('entry', 0);


		if ( $_id <> 0) {

			if (empty($this->_zip)) {

	        	$db =& $this->getDBO();

				$sql = "SELECT zip FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE id=" . $_id;

	            $db->setQuery( $sql);
	            $this->_zip = $db->loadResult();

			}

		}

		return $this->_zip;
	}


	/**
	 * Method to get the city of this entry
	 *
	 * @access public
	 * @return String
	 */
	function getCity() {

		$_id = JRequest::getInt('entry', 0);


		if ( $_id <> 0) {

			if (empty($this->_city)) {

	        	$db =& $this->getDBO();

				$sql = "SELECT city FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE id=" . $db->Quote($_id);

	            $db->setQuery( $sql);
	            $this->_city = $db->loadResult();

			}

		}

		return $this->_city;
	}


	/**
	 * Method to get the state of this entry
	 *
	 * @access public
	 * @return String
	 */
	function getEntryState() {

		$_id = JRequest::getInt('entry', 0);


		if ( $_id <> 0) {

			if (empty($this->_entryState)) {

	        	$db =& $this->getDBO();

				$sql = "SELECT state FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE id=" . $db->Quote($_id);

	            $db->setQuery( $sql);
	            $this->_entryState = $db->loadResult();

			}

		}

		return $this->_entryState;
	}


	/**
	 * Method to get the country of this entry
	 *
	 * @access public
	 * @return String
	 */
	function getCountry() {

		$_id = JRequest::getInt('entry', 0);


		if ( $_id <> 0) {

			if (empty($this->_country)) {

	        	$db =& $this->getDBO();

				$sql = "SELECT country FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE id=" . $_id;

	            $db->setQuery( $sql);
	            $this->_country = $db->loadResult();

			}

		}

		return $this->_country;
	}


	/**
	 * Method to get the phone of this entry
	 *
	 * @access public
	 * @return String
	 */
	function getPhone() {

		$_id = JRequest::getInt('entry', 0);


		if ( $_id <> 0) {

			if (empty($this->_phone)) {

	        	$db =& $this->getDBO();

				$sql = "SELECT phone FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE id=" . $db->Quote($_id);

	            $db->setQuery( $sql);
	            $this->_phone = $db->loadResult();

			}

		}

		return $this->_phone;
	}


	/**
	 * Method to get the mobile of this entry
	 *
	 * @access public
	 * @return String
	 */
	function getMobile() {

		$_id = JRequest::getInt('entry', 0);


		if ( $_id <> 0) {

			if (empty($this->_mobile)) {

	        	$db =& $this->getDBO();

				$sql = "SELECT mobile FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE id=" . $db->Quote($_id);

	            $db->setQuery( $sql);
	            $this->_mobile = $db->loadResult();

			}

		}

		return $this->_mobile;
	}


	/**
	 * Method to get the email of this entry
	 *
	 * @access public
	 * @return String
	 */
	function getEmail() {

		$_id = JRequest::getInt('entry', 0);


		if ( $_id <> 0) {

			if (empty($this->_email)) {

	        	$db =& $this->getDBO();

				$sql = "SELECT email FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE id=" . $db->Quote($_id);

	            $db->setQuery( $sql);
	            $this->_email = $db->loadResult();

			}

		}

		return $this->_email;
	}


	/**
	 * Method to get the web of this entry
	 *
	 * @access public
	 * @return String
	 */
	function getWeb() {

		$_id = JRequest::getInt('entry', 0);


		if ( $_id <> 0) {

			if (empty($this->_web)) {

	        	$db =& $this->getDBO();

				$sql = "SELECT web FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE id=" . $db->Quote($_id);

	            $db->setQuery( $sql);
	            $this->_web = $db->loadResult();

			}

		}

		return $this->_web;
	}



	/**
	 * Method to get the headline of this entry
	 *
	 * @access public
	 * @return String
	 */
	function getHeadline() {

		$_id = JRequest::getInt('entry', 0);


		if ( $_id <> 0) {

			if (empty($this->_headline)) {

	        	$db =& $this->getDBO();

				$sql = "SELECT headline FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE id=" . $db->Quote($_id);

	            $db->setQuery( $sql);
	            $this->_headline = $db->loadResult();

			}

		}

		return $this->_headline;
	}


	/**
	 * Method to get the text of this entry
	 *
	 * @access public
	 * @return String
	 */
	function getText() {

		$_id = JRequest::getInt('entry', 0);


		if ( $_id <> 0) {

			if (empty($this->_text)) {

	        	$db =& $this->getDBO();

				$sql = "SELECT text FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE id=" . $db->Quote($_id);

	            $db->setQuery( $sql);
	            $this->_text = $db->loadResult();

			}

		}

		return $this->_text;
	}


	/**
	 * Method to get the condition of this entry
	 *
	 * @access public
	 * @return String
	 */
	function getEntryCondition() {

		$_id = JRequest::getInt('entry', 0);


		if ( $_id <> 0) {

			if (empty($this->_entryCondition)) {

	        	$db =& $this->getDBO();

				$sql = "SELECT " . $db->nameQuote('condition') . " FROM " . $db->nameQuote('#__ccmarketplace_entries') . " WHERE id=" . $db->Quote($_id);

	            $db->setQuery( $sql);
	            $this->_entryCondition = $db->loadResult();

			}

		}

		return $this->_entryCondition;
	}


	/**
	 * Method to get the price of this entry
	 *
	 * @access public
	 * @return String
	 */
	function getPrice() {

		$_id = JRequest::getInt('entry', 0);


		if ( $_id <> 0) {

			if (empty($this->_price)) {

	        	$db =& $this->getDBO();

				$sql = "SELECT price FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE id=" . $db->Quote($_id);

	            $db->setQuery( $sql);
	            $this->_price = $db->loadResult();

			}

		}

		return $this->_price;
	}


	/**
	 * Method to get image 1 of this entry
	 *
	 * @access public
	 * @return String
	 */
	function getImage1() {

		$_id = JRequest::getInt('entry', 0);


		if ( $_id <> 0) {

			if (empty($this->_image1)) {

	        	$db =& $this->getDBO();

				$sql = "SELECT image1 FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE id=" . $db->Quote($_id);

	            $db->setQuery( $sql);
	            $this->_image1 = $db->loadResult();

			}

		}

		return $this->_image1;
	}

	/**
	 * Method to get image 2 of this entry
	 *
	 * @access public
	 * @return String
	 */
	function getImage2() {

		$_id = JRequest::getInt('entry', 0);


		if ( $_id <> 0) {

			if (empty($this->_image2)) {

	        	$db =& $this->getDBO();

				$sql = "SELECT image2 FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE id=" . $db->Quote($_id);

	            $db->setQuery( $sql);
	            $this->_image2 = $db->loadResult();

			}

		}

		return $this->_image2;
	}

	/**
	 * Method to get image 3 of this entry
	 *
	 * @access public
	 * @return String
	 */
	function getImage3() {

		$_id = JRequest::getInt('entry', 0);


		if ( $_id <> 0) {

			if (empty($this->_image3)) {

	        	$db =& $this->getDBO();

				$sql = "SELECT image3 FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE id=" . $db->Quote($_id);

	            $db->setQuery( $sql);
	            $this->_image3 = $db->loadResult();

			}

		}

		return $this->_image3;
	}

	/**
	 * Method to get image 4 of this entry
	 *
	 * @access public
	 * @return String
	 */
	function getImage4() {

		$_id = JRequest::getInt('entry', 0);


		if ( $_id <> 0) {

			if (empty($this->_image4)) {

	        	$db =& $this->getDBO();

				$sql = "SELECT image4 FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE id=" . $db->Quote($_id);

	            $db->setQuery( $sql);
	            $this->_image4 = $db->loadResult();

			}

		}

		return $this->_image4;
	}

	/**
	 * Method to get image 5 of this entry
	 *
	 * @access public
	 * @return String
	 */
	function getImage5() {

		$_id = JRequest::getInt('entry', 0);


		if ( $_id <> 0) {

			if (empty($this->_image5)) {

	        	$db =& $this->getDBO();

				$sql = "SELECT image5 FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE id=" . $db->Quote($_id);

	            $db->setQuery( $sql);
	            $this->_image5 = $db->loadResult();

			}

		}

		return $this->_image5;
	}

	/**
	 * Method to get image 6 of this entry
	 *
	 * @access public
	 * @return String
	 */
	function getImage6() {

		$_id = JRequest::getInt('entry', 0);


		if ( $_id <> 0) {

			if (empty($this->_image6)) {

	        	$db =& $this->getDBO();

				$sql = "SELECT image6 FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE id=" . $_id;

	            $db->setQuery( $sql);
	            $this->_image6 = $db->loadResult();

			}

		}

		return $this->_image6;
	}

	/**
	 * Method to get image 7 of this entry
	 *
	 * @access public
	 * @return String
	 */
	function getImage7() {

		$_id = JRequest::getInt('entry', 0);


		if ( $_id <> 0) {

			if (empty($this->_image7)) {

	        	$db =& $this->getDBO();

				$sql = "SELECT image7 FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE id=" . $db->Quote($_id);

	            $db->setQuery( $sql);
	            $this->_image7 = $db->loadResult();

			}

		}

		return $this->_image7;
	}

	/**
	 * Method to get image 8 of this entry
	 *
	 * @access public
	 * @return String
	 */
	function getImage8() {

		$_id = JRequest::getInt('entry', 0);


		if ( $_id <> 0) {

			if (empty($this->_image8)) {

	        	$db =& $this->getDBO();

				$sql = "SELECT image8 FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE id=" . $db->Quote($_id);

	            $db->setQuery( $sql);
	            $this->_image8 = $db->loadResult();

			}

		}

		return $this->_image8;
	}

	/**
	 * Method to get image 9 of this entry
	 *
	 * @access public
	 * @return String
	 */
	function getImage9() {

		$_id = JRequest::getInt('entry', 0);


		if ( $_id <> 0) {

			if (empty($this->_image9)) {

	        	$db =& $this->getDBO();

				$sql = "SELECT image9 FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE id=" . $db->Quote($_id);

	            $db->setQuery( $sql);
	            $this->_image9 = $db->loadResult();

			}

		}

		return $this->_image9;
	}

	/**
	 * Method to get image 10 of this entry
	 *
	 * @access public
	 * @return String
	 */
	function getImage10() {

		$_id = JRequest::getInt('entry', 0);


		if ( $_id <> 0) {

			if (empty($this->_image10)) {

	        	$db =& $this->getDBO();

				$sql = "SELECT image10 FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE id=" . $db->Quote($_id);

	            $db->setQuery( $sql);
	            $this->_image10 = $db->loadResult();

			}

		}

		return $this->_image10;
	}




	/**
	 * Method to get video 1 of this entry
	 *
	 * @access public
	 * @return String
	 */
	function getVideo1() {

		$_id = JRequest::getInt('entry', 0);


		if ( $_id <> 0) {

			if (empty($this->_video1)) {

	        	$db =& $this->getDBO();

				$sql = "SELECT video1 FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE id=" . $db->Quote($_id);

	            $db->setQuery( $sql);
	            $this->_video1 = $db->loadResult();

			}

		}

		return $this->_video1;
	}



    /**
     * Method to get the published state of this entry
     *
     * @access public
     * @return integer
     */
    function getPublished() {

        if (empty($this->_published)) {

            $db =& $this->getDBO();

            $sql = "SELECT published FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE id=" . $db->Quote($this->_id);

            $db->setQuery( $sql);
            $this->_published = $db->loadResult();

        }

        return $this->_published;

    }



    /**
     * Method to get the private/commercial state of this entry
     *
     * @access public
     * @return integer
     */
    function getFlagCommercial() {

        if (empty($this->_flag_commercial)) {

            $db =& $this->getDBO();

            $sql = "SELECT flag_commercial FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE id=" . $db->Quote($this->_id);

            $db->setQuery( $sql);
            $this->_flag_commercial = $db->loadResult();

        }

        return $this->_flag_commercial;

    }


    /**
     * Method to get the expired state of this entry
     *
     * @access public
     * @return integer
     */
    function getExpired() {

        if (empty($this->_expired)) {

            $db =& $this->getDBO();

            $sql = "SELECT expired FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE id=" . $db->Quote($this->_id);

            $db->setQuery( $sql);
            $this->_expired = $db->loadResult();

        }

        return $this->_expired;

    }


	/**
	 * Method to get the id of this category
	 *
	 * @access public
	 * @return integer
	 */
	function getCategoryId() {

     	$this->_categoryId = JRequest::getInt('catid', 0);

        return $this->_categoryId;

	}


	/**
	 * Method to get the slug of this category
	 *
	 * @access public
	 * @return string
	 */
	function getCategorySlug() {

     	$this->_categoryId = JRequest::getVar('catid', 0);

		return $this->_categoryId;

	}



	/**
	 * Method to get the name of this category
	 *
	 * @access public
	 * @return String
	 */
	function getCategoryName() {

		if ( empty( $this->_categoryName)) {
            $_catid = JRequest::getInt('catid', 0);

            $db =& $this->getDBO();

            $categoryNameQuery = "SELECT name FROM ".$db->nameQuote( '#__ccmarketplace_categories')." WHERE id=" . $db->Quote($_catid);

            $db->setQuery( $categoryNameQuery);
            $this->_categoryName = $db->loadResult();
		}
		return $this->_categoryName;

	}



    /**
     * Method to get the description of this category
     *
     * @access public
     * @return String
     */
    function getCategoryDescription() {
        if ( empty( $this->_categoryDescription)) {
            $_catid = JRequest::getInt('catid', 0);

            $db =& $this->getDBO();

            $categoryDescriptionQuery = "SELECT description FROM ".$db->nameQuote( '#__ccmarketplace_categories')." WHERE id=" . $db->Quote($_catid);

            $db->setQuery( $categoryDescriptionQuery);
            $this->_categoryDescription = $db->loadResult();
        }
        return $this->_categoryDescription;
    }



	/**
	 * Method to get the image of this category
	 *
	 * @access public
	 * @return String
	 */
	function getCategoryImage() {

		if ( empty( $this->_categoryImage)) {
            $_catid = JRequest::getInt('catid', 0);

            $db =& $this->getDBO();

            $categoryImageQuery = "SELECT image FROM ".$db->nameQuote( '#__ccmarketplace_categories')." WHERE id=" . $db->Quote($_catid);

            $db->setQuery( $categoryImageQuery);
            $this->_categoryImage = $db->loadResult();
		}
		return $this->_categoryImage;

	}




	/**
	 * Method to get the page header
	 *
	 * @access public
	 * @return String
	 */
	function getHeader() {

		return $this->_header;

	}



	/**
	 * Method to get the task
	 *
	 * @access public
	 * @return String
	 */
	function getTask() {

		if ( empty( $this->_task)) {

     		$this->_task   = JRequest::getString( 'task', '');

		}

		return $this->_task;

	}



	function add_image( $entry_id, $image, $absolute_path, $db, $imagenumber) {

	    // get max_imagesize from parameters
		$params = JComponentHelper::getParams('com_ccmarketplace');
		$max_image_size = $params->get('maxImageSize', '209715200');

		$max_big_image_x = $params->get('maxBigImageX', '800');
		$max_big_image_y = $params->get('maxBigImageY', '600');

		$max_small_image_x = $params->get('maxSmallImageX', '128');
		$max_small_image_y = $params->get('maxSmallImageY', '96');


		$marketplace_folder = $absolute_path."/images/marketplace/";
		if ( !is_dir( $marketplace_folder)) {
			mkdir( $marketplace_folder);
		}

	    $image_folder = $absolute_path."/images/marketplace/entries/";
		if ( !is_dir( $image_folder)) {
			mkdir( $image_folder);
		}



	    $image_too_big = 0;
	    if (isset( $_FILES[$image])) {
	        if ( $_FILES[$image]['size'] > $max_image_size) {
	            $image_too_big = 1;
	        }
	    }


	    if ( $image_too_big == 1) {
	        echo "<font color='#CC0000'>";
	        	echo JText::_( 'CCMP_IMAGE_TOO_BIG' );
	        echo "</font>";
	        echo "<br>";
	        echo "<br>";
	    }
	    else {
	        $af_size = GetImageSize ($_FILES[$image]['tmp_name']);

	        switch ($af_size[2]) {
	                case 1 : {
	                    $thispicext = 'gif';
	                    break;
	                }
	                case 2 : {
	                    $thispicext = 'jpg';
	                    break;
	                }
	                case 3 : {
	                    $thispicext = 'png';
	                    break;
	                }
	        }



	        // if ( $af_size[2] >= 1 && $af_size[2] <= 3) { // 1=GIF, 2=JPG or 3=PNG
	        if ( $af_size[2] >= 2 && $af_size[2] <= 3) { // 2=JPG or 3=PNG

	            $pic_jpg = $absolute_path."/images/marketplace/entries/" . $entry_id . "_" .$imagenumber . ".jpg";
	            if ( file_exists( $pic_jpg)) {
	                unlink( $pic_jpg);
	            }

	            $pic_png = $absolute_path."/images/marketplace/entries/" . $entry_id . "_" .$imagenumber . ".png";
	            if ( file_exists( $pic_png)) {
	                unlink( $pic_png);
	            }

	            $pic_gif = $absolute_path."/images/marketplace/entries/" . $entry_id . "_" .$imagenumber . ".gif";
	            if ( file_exists( $pic_gif)) {
	                unlink( $pic_gif);
	            }



	            chmod ( $_FILES[$image]['tmp_name'], 0644);



				// 1. if directory ./entries/ENTRYID does not exist, create it
				// 2. create the subdirs for ORIGINAL, LARGE and SMALL
				if ( !is_dir( $image_folder.$entry_id)) {
					mkdir($image_folder.$entry_id);
					mkdir($image_folder.$entry_id."/original"); // ORIGINAL
					mkdir($image_folder.$entry_id."/large"); // LARGE
					mkdir($image_folder.$entry_id."/small"); // SMALL
				}


				$original_image = $image_folder.$entry_id."/original/".$entry_id . "_" . $imagenumber . "." . $thispicext;
				$large_image = $image_folder.$entry_id."/large/".$entry_id . "_" . $imagenumber . "." . $thispicext;
				$small_image = $image_folder.$entry_id."/small/".$entry_id . "_" . $imagenumber . "." . $thispicext;


	            // copy original image to folder "original"
	            move_uploaded_file ( $_FILES[$image]['tmp_name'], $original_image);


	            // create "large" image
	            switch ($af_size[2]) {
	                case 1 : $src = ImageCreateFromGif(  $original_image); break;
	                case 2 : $src = ImageCreateFromJpeg( $original_image); break;
	                case 3 : $src = ImageCreateFromPng(  $original_image); break;
	            }

	            $width_before  = ImageSx( $src);
	            $height_before = ImageSy( $src);

	            if ( $width_before  >= $height_before) {
	                $width_new = min( $max_big_image_x, $width_before);
	                $scale = $width_before / $height_before;
	                $height_new = round( $width_new / $scale);
	            }
	            else {
	                $height_new = min( $max_big_image_y, $height_before);
	                $scale = $height_before / $width_before;
	                $width_new = round( $height_new / $scale);
	            }

	            $dst = ImageCreateTrueColor( $width_new, $height_new);

	            // GD Lib 2
	            ImageCopyResampled( $dst, $src, 0, 0, 0, 0, $width_new, $height_new, $width_before, $height_before);

	            switch ($af_size[2]) {
	                case 1 : ImageGIF(  $dst, $large_image); break;
	                case 2 : ImageJPEG( $dst, $large_image); break;
	                case 3 : ImagePNG(  $dst, $large_image); break;
	            }

	            imagedestroy( $dst);
	            imagedestroy( $src);


	            // create "small" image
	            switch ($af_size[2]) {
	                case 1 : $src = ImageCreateFromGif(  $original_image); break;
	                case 2 : $src = ImageCreateFromJpeg( $original_image); break;
	                case 3 : $src = ImageCreateFromPng(  $original_image); break;
	            }

	            $width_before  = ImageSx( $src);
	            $height_before = ImageSy( $src);

	            if ( $width_before  >= $height_before) {
	                $width_new = min( $max_small_image_x, $width_before);
	                $scale = $width_before / $height_before;
	                $height_new = round( $width_new / $scale);
	            }
	            else {
	                $height_new = min( $max_small_image_y, $height_before);
	                $scale = $height_before / $width_before;
	                $width_new = round( $height_new / $scale);
	            }

	            $dst = ImageCreateTrueColor( $width_new, $height_new);

	            // GD Lib 2
	            ImageCopyResampled( $dst, $src, 0, 0, 0, 0, $width_new, $height_new, $width_before, $height_before);

	            switch ($af_size[2]) {
	                case 1 : ImageGIF(  $dst, $small_image); break;
	                case 2 : ImageJPEG( $dst, $small_image); break;
	                case 3 : ImagePNG(  $dst, $small_image); break;
	            }

	            imagedestroy( $dst);
	            imagedestroy( $src);


	            // DB update
	            $sql = "UPDATE #__ccmarketplace_entries SET ". $image . "='".$entry_id . "_" . $imagenumber . "." .$thispicext ."' WHERE id=" . $db->Quote($entry_id);

	            $db->setQuery( $sql);

	            if ($db->getErrorNum()) {
	                echo $db->stderr();
	            } else {
	                $db->query();
	            }


	        }
	    }
	}



	function del_image( $entry_id, $image, $absolute_path, $db, $imagenumber) {

	    $image_folder = $absolute_path."/images/marketplace/entries/";

        // get image name
        $sql = "SELECT " . $image . " FROM #__ccmarketplace_entries WHERE id=" . $db->Quote($entry_id);
		$db->setQuery( $sql);
		$imagename = $db->loadResult();


		if ( $imagename != "") {

			$original_image = $image_folder.$entry_id."/original/" . $imagename;
			$large_image = $image_folder.$entry_id."/large/" . $imagename;
			$small_image = $image_folder.$entry_id."/small/" . $imagename;

            if ( file_exists( $original_image)) {
                unlink( $original_image);
            }
            if ( file_exists( $large_image)) {
                unlink( $large_image);
            }
            if ( file_exists( $small_image)) {
                unlink( $small_image);
            }

            // DB update
            $sql = "UPDATE #__ccmarketplace_entries SET ". $image . "='' WHERE id=" . $db->Quote($entry_id);

            $db->setQuery( $sql);

            if ($db->getErrorNum()) {
                echo $db->stderr();
            } else {
                $db->query();
            }

		}

	}



	function rm_imagefolder( $entry_id, $db) {

		// get folder name
		$rootDir = JPATH_ROOT;

		$folder = $rootDir . "/images/marketplace/entries/" . $entry_id;


		// 1. delete all existing images for this entry
        // get image names
        $sql = "SELECT image1, image2, image3, image4, image5, image6, image7, image8, image9, image10 FROM #__ccmarketplace_entries WHERE id=" . $db->Quote($entry_id);
		$db->setQuery( $sql);
		$rows = $db->loadObjectList();

		foreach ( $rows as $row ) {

			if ( $row->image1 != "") {
				$this->del_image( $entry_id, "image1", $rootDir, $db, 1);
			}
			if ( $row->image2 != "") {
				$this->del_image( $entry_id, "image2", $rootDir, $db, 2);
			}
			if ( $row->image3 != "") {
				$this->del_image( $entry_id, "image3", $rootDir, $db, 3);
			}
			if ( $row->image4 != "") {
				$this->del_image( $entry_id, "image4", $rootDir, $db, 4);
			}
			if ( $row->image5 != "") {
				$this->del_image( $entry_id, "image5", $rootDir, $db, 5);
			}
			if ( $row->image6 != "") {
				$this->del_image( $entry_id, "image6", $rootDir, $db, 6);
			}
			if ( $row->image7 != "") {
				$this->del_image( $entry_id, "image7", $rootDir, $db, 7);
			}
			if ( $row->image8 != "") {
				$this->del_image( $entry_id, "image8", $rootDir, $db, 8);
			}
			if ( $row->image9 != "") {
				$this->del_image( $entry_id, "image9", $rootDir, $db, 9);
			}
			if ( $row->image10 != "") {
				$this->del_image( $entry_id, "image10", $rootDir, $db, 10);
			}

		}


    	// 2. remove all existing folders for this entry

    	if (is_dir( $folder. "/original/")) {
    		rmdir( $folder. "/original/");
    	}
    	if (is_dir( $folder. "/large/")) {
    		rmdir( $folder. "/large/");
    	}
    	if (is_dir( $folder. "/small/")) {
    		rmdir( $folder. "/small/");
    	}
    	if (is_dir( $folder)) {
    		rmdir( $folder );
    	}


	}



    /**
     * Method to get the creation date of this entry
     *
     * @access public
     * @return string
     */
    function getDateCreated() {

        if (empty($this->_date_created)) {

            $db =& $this->getDBO();

            $sql = "SELECT DATE_FORMAT( date_created, '%d.%m.%Y') FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE id=" . $db->Quote($this->_id);

            $db->setQuery( $sql);
            $this->_date_created = $db->loadResult();

        }

        return $this->_date_created;

    }



}

