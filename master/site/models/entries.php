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



/**
 * Marketplace Entries Model
 */
class CCMarketplaceModelEntries extends JModel {



	/**
	 * Entry list array
	 *
	 * @var array
	 */
	var $_data = null;


	/**
	 * category total
	 *
	 * @var integer
	 */
	var $_total = null;



	/**
	 * exist status
	 *
	 * @var integer
	 */
	var $_existStatus = null;



	/**
	 * Constructor
	 *
	 * @since 1.5
	 */
	function __construct() {

		parent::__construct();

        $app = JFactory::getApplication();

		$user =& JFactory::getUser();
		if ( $user->guest) { // user is not logged in
			$redirectLink = JRoute::_( "index.php?option=com_ccmarketplace");
			$app->redirect( $redirectLink, JText::_( 'CCMP_NOT_LOGGED_IN' ), "notice");
		}


		// get parameters
		$params = JComponentHelper::getParams('com_ccmarketplace');

		$_categoryListLength = $params->get('categoryListLength', '20');

		$this->setState('limit', $_categoryListLength, 'int');
		$this->setState('limitstart', JRequest::getVar('limitstart', 0, '', 'int'));

    }


	/**
     * Gets entries data
     *
     * @return array
     */
     function getEntries() {

		// Load entries if they don't exist
		if (empty($this->_data)) {

			$selectQuery = $this->_buildSelectQuery();

	        $limitstart = $this->getState('limitstart');
	        $limit = $this->getState('limit');

			$this->_data = $this->_getList( $selectQuery, $limitstart, $limit);
		}

    	// return the entry list data
    	return $this->_data;

     }



	/**
	 * Method to get the total number of entries in this category
	 *
	 * @access public
	 * @return integer
	 */
	function getTotal() {

		$user =& JFactory::getUser();
		$userid = $user->id;

		$db =& $this->getDBO();

		if (empty($this->_total)) {
			$countQuery = "SELECT * FROM " . $db->nameQuote('#__ccmarketplace_entries') .
                        " WHERE user_id=" . $db->Quote($userid);

			$this->_total = $this->_getListCount( $countQuery);
		}

		return $this->_total;
	}



	/**
	 * Method to get a pagination object
	 *
	 * @access public
	 * @return integer
	 */
	function getPagination() {

		if (empty($this->_pagination)) {
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination( $this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
		}

		return $this->_pagination;

	}



	function _buildSelectQuery() {

		$user =& JFactory::getUser();
		$userid = $user->id;

        $db =& $this->getDBO();

		$selectQuery = "SELECT id, category_id, user_id, label_id, headline, text, price, zip, city, state, country,
							CASE WHEN CHAR_LENGTH(alias) THEN CONCAT_WS(':', id, alias) ELSE id END as slug,
							DATE_FORMAT( date_created, '%d.%m.%Y') AS date, flag_top, flag_featured, flag_commercial, published, expired,
							image1, image2, image3, image4, image5, image6, image7, image8, image9, image10,
							video1, video2, video3
						FROM " . $db->nameQuote('#__ccmarketplace_entries') .
                            " WHERE user_id=" . $db->Quote($userid) .
						    " ORDER BY date_created DESC";

        return $selectQuery;
	}


}

