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
defined('_JEXEC') or die('Restricted Access');




/**
 * User class
 *
 */
class CofiUser extends JObject {



	/* 
	* id of this user
	*/
    var $_id = 0;


	/* 
	* # of entries this user has in the marketplace
	*/
    var $_ads = 0;


	/* 
	* user is blocked. This user cannot write entries in the marketplace
	*/
    var $_blocked = 0;

	/* 
	* user is a marketplace moderator and will see moderator functions 
	*/
    var $_moderator = 0;


    var $_firstname = "";
    var $_lastname 	= "";
    var $_company 	= "";

    var $_street 	= "";
    var $_zipcode 	= "";
    var $_city 		= "";
    var $_state 	= "";
    var $_country 	= "";

    var $_phone 	= "";
    var $_mobile 	= "";
    var $_email 	= "";
    var $_website 	= "";




	/**
	* Constructor
	*
	* @access 	protected
	*/
	function __construct( $user_id = 0) {
	
		$this->_id = $user_id;

        $db = JFactory::getDBO();

		$query = "SELECT * FROM " . $db->nameQuote( '#__ccmarketplace_users') . " WHERE id='" . $user_id . "'";
        $db->setQuery($query);

        $_user = $db->loadAssoc();

        $this->_ads      	= $_user['ads'];
        $this->_blocked  	= $_user['blocked'];
        $this->_moderator  	= $_user['moderator'];

        $this->_firstname  	= $_user['firstname'];
        $this->_lastname  	= $_user['lastname'];
        $this->_company  	= $_user['company'];
        
        $this->_street  	= $_user['street'];
        $this->_zipcode  	= $_user['zipcode'];
        $this->_city  		= $_user['city'];
        $this->_state  		= $_user['state'];
        $this->_country  	= $_user['country'];

        $this->_phone  		= $_user['phone'];
        $this->_mobile  	= $_user['mobile'];
        $this->_email  		= $_user['email'];
        $this->_website  	= $_user['website'];


	}


	function setId( $id) {
		$this->_id = $id;
	}

	function setAds( $ads) {
		$this->_ads = $ads;
	}

	function setBlocked( $blocked) {
		$this->_blocked = $blocked;

		$db = JFactory::getDBO();
		$sql = "UPDATE " . $db->nameQuote( '#__ccmarketplace_users')." SET" .
					" blocked = " . $db->Quote( $this->_blocked) . 
					" WHERE id = '".$this->_id."'";
		$db->setQuery( $sql);
		$result = $db->query();		
	}

	function setModerator( $moderator) {
		$this->_moderator = $moderator;
		
		$db = JFactory::getDBO();
		$sql = "UPDATE " . $db->nameQuote( '#__ccmarketplace_users')." SET" .
					" moderator = " . $db->Quote( $this->_moderator) . 
					" WHERE id = '".$this->_id."'";
		$db->setQuery( $sql);
		$result = $db->query();		
	}




	function getId() {
		return $this->_id;
	}

	function getAds() {
		return $this->_ads;
	}

	function isBlocked() {
		return $this->_blocked;
	}

	function isModerator() {
		return $this->_moderator;
	}


	function getFirstname() {
		return $this->_firstname;
	}
	function getLastname() {
		return $this->_lastname;
	}
	function getCompany() {
		return $this->_company;
	}

	function getStreet() {
		return $this->_street;
	}
	function getZipcode() {
		return $this->_zipcode;
	}
	function getCity() {
		return $this->_city;
	}
	function getState() {
		return $this->_state;
	}
	function getCountry() {
		return $this->_country;
	}

	function getPhone() {
		return $this->_phone;
	}
	function getMobile() {
		return $this->_mobile;
	}
	function getEmail() {
		return $this->_email;
	}
	function getWebsite() {
		return $this->_website;
	}



}


