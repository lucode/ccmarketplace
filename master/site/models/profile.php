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
 * Marketplace Profile Model
 */
class CCMarketplaceModelProfile extends JModel {


	/**
	 * task
	 *
	 * @var String
	 */
	var $_task = "";


	/**
	 * headline
	 *
	 * @var String
	 */
	var $_headline = null;


	/**
	 * Avatar
	 *
	 * @var String
	 */

	var $_avatar = null;


	/**
	 * Firstname
	 *
	 * @var String
	 */

	var $_firstname = null;


	/**
	 * Lastname
	 *
	 * @var String
	 */

	var $_lastname = null;


	/**
	 * Company
	 *
	 * @var String
	 */

	var $_company = null;


	/**
	 * Street
	 *
	 * @var String
	 */

	var $_street = null;


	/**
	 * Zipcode
	 *
	 * @var String
	 */

	var $_zipcode = null;


	/**
	 * City
	 *
	 * @var String
	 */

	var $_city = null;


	/**
	 * State
	 *
	 * @var String
	 */

	var $_pstate = null;


	/**
	 * Country
	 *
	 * @var String
	 */

	var $_country = null;


	/**
	 * Phone
	 *
	 * @var String
	 */

	var $_phone = null;


	/**
	 * Mobile
	 *
	 * @var String
	 */

	var $_mobile = null;


	/**
	 * Email
	 *
	 * @var String
	 */

	var $_email = null;


	/**
	 * Website
	 *
	 * @var String
	 */

	var $_website = null;





	/**
	 * Constructor
	 *
	 * @since 1.5
	 */
	function __construct() {

		parent::__construct();

        $app = JFactory::getApplication();

		$this->_headline = JText::_( 'CCMP_HEADLINE_PROFILE' );


		$user =& JFactory::getUser();

		if ( $user->guest) { // user is not logged in
			$redirectLink = JRoute::_( "index.php?option=com_ccmarketplace");
			$app->redirect( $redirectLink, JText::_( 'CCMP_NOT_LOGGED_IN' ), "notice");
		}

     	$this->_task   = JRequest::getString( 'task', '');
		$this->_userid = $user->id;

		$this->_firstname  	= JRequest::getString( 'firstname', '', 'POST');
		$this->_firstname	= strip_tags( $this->_firstname);

		$this->_lastname  	= JRequest::getString( 'lastname', '', 'POST');
		$this->_lastname 	= strip_tags( $this->_lastname);

		$this->_company  	= JRequest::getString( 'company', '', 'POST');
		$this->_company 	= strip_tags( $this->_company);

		$this->_street  = JRequest::getString( 'street', '', 'POST');
		$this->_street 	= strip_tags( $this->_street);

		$this->_zipcode  = JRequest::getString( 'zipcode', '', 'POST');
		$this->_zipcode = strip_tags( $this->_zipcode);

		$this->_city  	= JRequest::getString( 'city', '', 'POST');
		$this->_city 	= strip_tags( $this->_city);

		$this->_pstate  	= JRequest::getString( 'state', '', 'POST');
		$this->_pstate 	= strip_tags( $this->_pstate);

		$this->_country = JRequest::getString( 'country', '', 'POST');
		$this->_country = strip_tags( $this->_country);

		$this->_phone 	= JRequest::getString( 'phone', '', 'POST');
		$this->_phone 	= strip_tags( $this->_phone);

		$this->_mobile 	= JRequest::getString( 'mobile', '', 'POST');
		$this->_mobile 	= strip_tags( $this->_mobile);

		$this->_email 	= JRequest::getString( 'email', '', 'POST');
		$this->_email 	= strip_tags( $this->_email);

		$this->_website = JRequest::getString( 'website', '', 'POST');
		$this->_website = strtolower( $this->_website);
		$this->_website = strip_tags( $this->_website);
		$this->_website = str_replace( "http://", "", $this->_website);


		switch ( JRequest::getString( 'submit', '')) {

			case JText::_( 'CCMP_SAVE' ): {
     			$this->saveProfile();
				break;
			}

			default: {
				$this->_headline = JText::_( 'CCMP_PROFILE' );
				break;
			}

		}

	}




/**
 * save profile
 *
 * @return int
 */
 function saveProfile() {

    $app = JFactory::getApplication();

	$user =& JFactory::getUser();

	$this->_headline = JText::_( 'CCMP_PROFILE_SAVED' );


	// redirect	link
	$redirectLink = JRoute::_( "index.php?option=com_ccmarketplace&view=profile");

	// redirekt link to marketplace home page
	$redirectLinkHome = JRoute::_( "index.php?option=com_ccmarketplace");


    // check if user is logged in - maybe session has timed out
	if ($user->guest) {
		// if user is not logged in, kick him back to index page
		$app->redirect( $redirectLinkHome, JText::_( 'CCMP_PROFILE_NOT_SAVED' ), "message");
	}


	$db =& $this->getDBO();

	$sql = "UPDATE ".$db->nameQuote( '#__ccmarketplace_users')." SET" .
					" firstname = " . $db->Quote( $this->_firstname) .
					", lastname = " . $db->Quote( $this->_lastname) .
					", company = " . $db->Quote( $this->_company) .
					", street = " . $db->Quote( $this->_street) .
					", zipcode = " . $db->Quote( $this->_zipcode) .
					", city = " . $db->Quote( $this->_city) .
					", state = " . $db->Quote( $this->_pstate) .
					", country = " . $db->Quote( $this->_country) .
					", phone = " . $db->Quote( $this->_phone) .
					", mobile = " . $db->Quote( $this->_mobile) .
					", email = " . $db->Quote( $this->_email) .
					", website = " . $db->Quote( $this->_website) .
					" WHERE id = " . $db->Quote($user->id);

	$db->setQuery( $sql);
	$db->query();

	$app->redirect( $redirectLink, JText::_( 'CCMP_PROFILE_HAS_BEEN_SAVED' ), "notice");

    return 0; // save OK
 }




	/**
	 * Method to get the firstname of this user
	 *
	 * @access public
	 * @return String
	 */
	function getFirstname() {

		if (empty($this->_firstname)) {

        	$db =& $this->getDBO();

			$sql = "SELECT firstname FROM ".$db->nameQuote('#__ccmarketplace_users')." WHERE id=" . $db->Quote($this->_userid);

            $db->setQuery( $sql);
            $this->_firstname = $db->loadResult();

		}

		return $this->_firstname;
	}


	/**
	 * Method to get the lastname of this user
	 *
	 * @access public
	 * @return String
	 */
	function getLastname() {

		if (empty($this->_lastname)) {

        	$db =& $this->getDBO();

			$sql = "SELECT lastname FROM ".$db->nameQuote('#__ccmarketplace_users')." WHERE id=" . $db->Quote($this->_userid);

            $db->setQuery( $sql);
            $this->_lastname = $db->loadResult();

		}

		return $this->_lastname;
	}


	/**
	 * Method to get the company of this user
	 *
	 * @access public
	 * @return String
	 */
	function getCompany() {

		if (empty($this->_company)) {

        	$db =& $this->getDBO();

			$sql = "SELECT company FROM ".$db->nameQuote('#__ccmarketplace_users')." WHERE id=". $db->Quote($this->_userid);

            $db->setQuery( $sql);
            $this->_company = $db->loadResult();

		}

		return $this->_company;
	}


	/**
	 * Method to get the street of this user
	 *
	 * @access public
	 * @return String
	 */
	function getStreet() {

		if (empty($this->_street)) {

        	$db =& $this->getDBO();

			$sql = "SELECT street FROM ".$db->nameQuote('#__ccmarketplace_users')." WHERE id=" . $db->Quote($this->_userid);

            $db->setQuery( $sql);
            $this->_street = $db->loadResult();

		}

		return $this->_street;
	}


	/**
	 * Method to get the zipcode of this user
	 *
	 * @access public
	 * @return String
	 */
	function getZipcode() {

		if (empty($this->_zipcode)) {

        	$db =& $this->getDBO();

			$sql = "SELECT zipcode FROM ".$db->nameQuote('#__ccmarketplace_users')." WHERE id=" . $db->Quote($this->_userid);

            $db->setQuery( $sql);
            $this->_zipcode = $db->loadResult();

		}

		return $this->_zipcode;
	}


	/**
	 * Method to get the city of this user
	 *
	 * @access public
	 * @return String
	 */
	function getCity() {

		if (empty($this->_city)) {

        	$db =& $this->getDBO();

			$sql = "SELECT city FROM ".$db->nameQuote('#__ccmarketplace_users')." WHERE id=" . $db->Quote($this->_userid);

            $db->setQuery( $sql);
            $this->_city = $db->loadResult();

		}

		return $this->_city;
	}


	/**
	 * Method to get the state of this user
	 *
	 * @access public
	 * @return String
	 */
	function getState() {

		if (empty($this->_pstate)) {

        	$db =& $this->getDBO();

			$sql = "SELECT state FROM ".$db->nameQuote('#__ccmarketplace_users')." WHERE id=" . $db->Quote($this->_userid);

            $db->setQuery( $sql);
            $this->_pstate = $db->loadResult();

		}

		return $this->_pstate;
	}


	/**
	 * Method to get the country of this user
	 *
	 * @access public
	 * @return String
	 */
	function getCountry() {

		if (empty($this->_country)) {

        	$db =& $this->getDBO();

			$sql = "SELECT country FROM ".$db->nameQuote('#__ccmarketplace_users')." WHERE id=" . $db->Quote($this->_userid);

            $db->setQuery( $sql);
            $this->_country = $db->loadResult();

		}

		return $this->_country;
	}



	/**
	 * Method to get the phone of this user
	 *
	 * @access public
	 * @return String
	 */
	function getPhone() {

		if (empty($this->_phone)) {

        	$db =& $this->getDBO();

			$sql = "SELECT phone FROM ".$db->nameQuote('#__ccmarketplace_users')." WHERE id=" . $db->Quote($this->_userid);

            $db->setQuery( $sql);
            $this->_phone = $db->loadResult();

		}

		return $this->_phone;
	}


	/**
	 * Method to get the mobile of this user
	 *
	 * @access public
	 * @return String
	 */
	function getMobile() {

		if (empty($this->_mobile)) {

        	$db =& $this->getDBO();

			$sql = "SELECT mobile FROM ".$db->nameQuote('#__ccmarketplace_users')." WHERE id=" . $db->Quote($this->_userid);

            $db->setQuery( $sql);
            $this->_mobile = $db->loadResult();

		}

		return $this->_mobile;
	}


	/**
	 * Method to get the email of this user
	 *
	 * @access public
	 * @return String
	 */
	function getEmail() {

		if (empty($this->_email)) {

        	$db =& $this->getDBO();

			$sql = "SELECT email FROM ".$db->nameQuote('#__ccmarketplace_users')." WHERE id=" . $db->Quote($this->_userid);

            $db->setQuery( $sql);
            $this->_email = $db->loadResult();

		}

		return $this->_email;
	}


	/**
	 * Method to get the website of this user
	 *
	 * @access public
	 * @return String
	 */
	function getWebsite() {

		if (empty($this->_website)) {

        	$db =& $this->getDBO();

			$sql = "SELECT website FROM ".$db->nameQuote('#__ccmarketplace_users')." WHERE id=" . $db->Quote($this->_userid);

            $db->setQuery( $sql);
            $this->_website = $db->loadResult();

		}

		return $this->_website;
	}





	/**
	 * Method to get the headline
	 *
	 * @access public
	 * @return String
	 */
	function getHeadline() {
		return $this->_headline;
	}



}

