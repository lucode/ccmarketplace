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

//require_once(JPATH_COMPONENT.DS.'classes/user.php');


/**
 * Marketplace Category Model
 */
class CCMarketplaceModelCategory extends JModel {



	/**
	 * Entry list array
	 *
	 * @var array
	 */
	var $_data = null;


	/**
	 * Entry list array
	 *
	 * @var array
	 */
	var $_rssdata = null;


	/**
	 * category total
	 *
	 * @var integer
	 */
	var $_total = null;


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
	 * category alias
	 *
	 * @var String
	 */
	var $_categoryAlias = null;


	/**
	 * category slug
	 *
	 * @var String
	 */
	var $_categorySlug = null;


	/**
	 * category description
	 *
	 * @var String
	 */
	var $_categoryDescription = null;


	/**
	 * category image
	 *
	 * @var String
	 */
	var $_categoryImage = null;


	/**
	 * exist status
	 *
	 * @var integer
	 */
	var $_existStatus = null;


    /**
     * filter private / commercial
     *
     * @var integer
     */
    var $_filterPrivateCommercial = 0;



	/**
	 * Constructor
	 *
	 * @since 1.5
	 */
	function __construct() {

		parent::__construct();

		// get parameters
		$params = JComponentHelper::getParams('com_ccmarketplace');

		$_categoryListLength = $params->get('categoryListLength', '20');
        $_commercialEntries  = $params->get('commercialEntries', '0'); // 0 no, 1 yes

		$this->setState('limit', $_categoryListLength, 'int');
		$this->setState('limitstart', JRequest::getVar('limitstart', 0, '', 'int'));

        if ( $_commercialEntries == 1) {
            if ( JRequest::getVar('filter_commercial', '') != '') {
                $this->setState('limitstart', 0); // set start to 0 if we changed filter
            }

            // store private / commercial filter in the session
            $session =& JFactory::getSession();
            $session->set('filterPrivateCommercial', JRequest::getVar('filter_commercial', $session->get('filterPrivateCommercial')));
	    }

    }


	/**
     * Gets entries data
     *
     * @return array
     */
     function getEntries() {

        $app = JFactory::getApplication();

     	if ( $this->getExistStatus() != null ) { // check if this category exists

        	$db =& $this->getDBO();

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
        else { // category does not exist
			$redirectLink = JRoute::_( "index.php?option=com_ccmarketplace");
			$app->redirect( $redirectLink, JText::_( 'CCMP_CATEGORY_DOES_NOT_EXIST' ), "notice");
        }


     }



	/**
	 * Method to get the total number of entries in this category
	 *
	 * @access public
	 * @return integer
	 */
	function getTotal() {

		if (empty($this->_total)) {
			$countQuery = $this->_buildCountQuery();
			$this->_total = $this->_getListCount($countQuery);
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

        $_catid = JRequest::getInt('catid', 0);

        // get parameters
        $params = JComponentHelper::getParams('com_ccmarketplace');
        $_commercialEntries  = $params->get('commercialEntries', '0'); // 0 no, 1 yes

        if ( $_commercialEntries == 1) {

            $session =& JFactory::getSession();
            $filter_commercial = $session->get('filterPrivateCommercial');

            switch ( $filter_commercial) {

                case 0 : { // all
                    $filter = " ";
                    break;
                }
                case 1 : { // private
                    $filter = " AND flag_commercial='0' ";
                    break;
                }
                case 2 : { // commercial
                    $filter = " AND flag_commercial='1' ";
                    break;
                }
                default: {
                    break;
                }

            }

        }
        else {
            $filter = " ";
        }

        $db =& $this->getDBO();

		$selectQuery = "SELECT id, category_id, user_id, label_id, headline, text, price, zip, city, state, country,
							CASE WHEN CHAR_LENGTH(alias) THEN CONCAT_WS(':', id, alias) ELSE id END as slug,
							DATE_FORMAT( date_created, '%d.%m.%Y') AS date, flag_top, flag_featured, flag_commercial, published,
							image1, image2, image3, image4, image5, image6, image7, image8, image9, image10,
							video1, video2, video3
						FROM " . $db->nameQuote('#__ccmarketplace_entries') .
                            " WHERE category_id=" . $db->Quote($_catid) . " AND published='1' " . $filter .
						    " ORDER BY flag_top DESC, date_created DESC";

        return $selectQuery;
	}



	function _buildCountQuery() {

     	$_catid = JRequest::getInt('catid', 0);

         // get parameters
         $params = JComponentHelper::getParams('com_ccmarketplace');
         $_commercialEntries  = $params->get('commercialEntries', '0'); // 0 no, 1 yes

         if ( $_commercialEntries == 1) {

             $session =& JFactory::getSession();
             $filter_commercial = $session->get('filterPrivateCommercial');

             switch ( $filter_commercial) {

                 case 0 : { // all
                     $filter = " ";
                     break;
                 }
                 case 1 : { // private
                     $filter = " AND flag_commercial='0' ";
                     break;
                 }
                 case 2 : { // commercial
                     $filter = " AND flag_commercial='1' ";
                     break;
                 }
                 default: {
                     break;
                 }

             }

         }
         else {
            $filter = " ";
         }

        $db =& $this->getDBO();

		$countQuery = "SELECT * FROM ".$db->nameQuote('#__ccmarketplace_entries') .
                        " WHERE category_id=" . $db->Quote($_catid) . " AND published='1' " . $filter;
		return $countQuery;
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
     	$this->_categorySlug = JRequest::getVar('catid', 0);

		return $this->_categorySlug;
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
	 * Method to check if this category exists
	 *
	 * @access public
	 * @return integer
	 */
	function getExistStatus() {
		if ( empty( $this->_existStatus)) {
            $_catid = JRequest::getInt('catid', 0);

            $db =& $this->getDBO();

            $sql = "SELECT name FROM ".$db->nameQuote( '#__ccmarketplace_categories')." WHERE id=" . $db->Quote($_catid);

            $db->setQuery( $sql);
            $this->_existStatus = $db->loadResult();
		}
		return $this->_existStatus;
	}


    /**
     * Method to get filter private / commercial
     *
     * @access public
     * @return integer
     */
    function getFilterPrivateCommercial() {

        // get parameters
        $params = JComponentHelper::getParams('com_ccmarketplace');
        $_commercialEntries  = $params->get('commercialEntries', '0'); // 0 no, 1 yes

        if ( $_commercialEntries == 1) {
            $session =& JFactory::getSession();
            $_filterPrivateCommercial = $session->get('filterPrivateCommercial');
        }
        else {
            $_filterPrivateCommercial = 0;
        }


        return $_filterPrivateCommercial;

    }




	/**
     * Gets RSS entries data
     *
     * @return array
     */
     function getRSSEntries() {

        $_catid = JRequest::getInt('catid', 0);

		// get parameters
		$params = JComponentHelper::getParams('com_ccmarketplace');

		$rssSize = $params->get('rssSize', 20);

    	$db =& $this->getDBO();

		$selectQuery = "SELECT id, category_id, user_id, headline, text,
							CASE WHEN CHAR_LENGTH(alias) THEN CONCAT_WS(':', id, alias) ELSE id END as slug,
							date_created AS date, published,
							image1, image2, image3, image4, image5, image6, image7, image8, image9, image10,
							video1, video2, video3
						FROM " . $db->nameQuote('#__ccmarketplace_entries') .
                            " WHERE category_id=" . $db->Quote($_catid) . " AND published='1' " .
						    " ORDER BY date_created DESC";

		$this->_rssdata = $this->_getList( $selectQuery, '0', $rssSize);

    	return $this->_rssdata;

     }


}
