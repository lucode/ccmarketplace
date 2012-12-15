<?php

/**
*
* Marketplace - Classified Ads for Joomla!
*
* @package		Marketplace
* @subpackage	Plugin
* @author		Achim Fischer
* @copyright	Copyright (C) 2005-2012 Achim Fischer (Codingfish). All rights reserved.
* @link			http://www.codingfish.com
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport('joomla.plugin.plugin');



/**
 * Plugin for Codingfish Marketplace
 *
 * @package		Joomla
 * @subpackage	Marketplace
 */
class plgSystemMarketplace extends JPlugin {

	/**
	 * Store user method
	 *
	 * Method is called after user data is stored in the database
	 *
	 * @param 	array		holds the new user data
	 * @param 	boolean		true if a new user is stored
	 * @param	boolean		true if user was succesfully stored in the database
	 * @param	string		message
	 */
	function onUserAfterSave( $user, $isnew, $success, $msg) {

        if ( $success) {

            if ( $isnew) { // insert

                // add a record to #__ccmarketplace_users
                $db = JFactory::getDBO();

                $sql = "INSERT INTO " . $db->nameQuote('#__ccmarketplace_users') . " SET " .
                        $db->nameQuote('id') . " = " . $user['id'] . ", " .
                        "username=\"" . $user['username'] . "\"";

                $db->setQuery( $sql);
                $db->query();

            }
            else { // update

                // update the user record in #__ccmarketplace_users
                $db = JFactory::getDBO();

                $sql = "UPDATE " . $db->nameQuote('#__ccmarketplace_users') . " SET " .
                        "username=\"" . $user['username'] . "\" " .
                        "WHERE " . $db->nameQuote('id') . " = " . $user['id'];

                $db->setQuery( $sql);
                $db->query();


            }

        }

	}


	function onUserAfterDelete( $user, $success, $msg) {

		$db = JFactory::getDBO();
		
		$sql = 'DELETE FROM '.$db->nameQuote('#__ccmarketplace_users') . ' WHERE ' .
								$db->nameQuote('id').' = '.$user['id'];

		$db->setQuery( $sql); 
		$db->query(); 
									
	}


}



