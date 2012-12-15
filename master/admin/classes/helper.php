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
defined('_JEXEC') or die('Restricted Access');



/**
 * Helper class
 *
 */
class CodingfishBackendHelper extends JObject {



	function getCategoryById( $id) {

		$db	=& JFactory::getDBO();		

		$sql = "SELECT name FROM ".$db->nameQuote('#__ccmarketplace_categories')." WHERE id='". $id . "'";
				
		$db->setQuery( $sql);
		$result = $db->loadResult();

		if ( !$result) {
			return "";
		}
		else {
			return $result;
		}

	}


	function getUsernameById( $id) {

		$db	=& JFactory::getDBO();		

		$sql = "SELECT username FROM ".$db->nameQuote('#__ccmarketplace_users')." WHERE id='". $id . "'";
				
		$db->setQuery( $sql);
		$result = $db->loadResult();

		if ( !$result) {
			return "";
		}
		else {
			return $result;
		}

	}


	function getNumberOfEntriesById( $id) {

		$db	=& JFactory::getDBO();		

		$sql = "SELECT count(*) FROM ".$db->nameQuote('#__ccmarketplace_entries')." WHERE user_id='". $id . "' AND published='1' ";
				
		$db->setQuery( $sql);
		$result = $db->loadResult();

		if ( !$result) {
			return 0;
		}
		else {
			return $result;
		}

	}




	function updateMarketplaceStats() {

		return 0;
	
	}



	function updateCategoryStats( $category_id) {

		return 0;
	
	}



	function isCategoryModerated( $cat_id) {

		return false;

	}



}







