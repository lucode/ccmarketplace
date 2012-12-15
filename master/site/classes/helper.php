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
 * Helper class
 *
 */
class CodingfishFrontendHelper extends JObject {



	function getCategoryById( $cat_id) {

		return "";

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



	function getQuickJumpSelectBox( $cat_id) {

		$user =& JFactory::getUser();

		$db	=& JFactory::getDBO();


        // create array for slugs
        $slugs = array();

		// set slug counter to 0
        $iSlug = 0;


		$html = "<select class='quickselectbox' name='quickselectbox' onchange='callURL( this)'>";

		// get all published category groups
	    $sql_groups = "SELECT id, name FROM ".$db->nameQuote( '#__ccmarketplace_categories') .
		    		" WHERE parent_id='0' AND published='1'" .
	    			" ORDER BY ordering ASC";


        $db->setQuery( $sql_groups);

        $_group_list = $db->loadAssocList();

		reset( $_group_list);
		while (list($key, $val) = each( $_group_list)) {

        	$group_id 	= $_group_list[$key]['id'];
        	$group_name = $_group_list[$key]['name'];

			$html .= "<optgroup label='".$group_name."'>";


				/* get categories from this group */
				// get all published categories in this group
			    $sql_categories = "SELECT id, name, " .
			    		" CASE WHEN CHAR_LENGTH(alias) THEN CONCAT_WS(':', id, alias) ELSE id END as slug" .
			    		" FROM ".$db->nameQuote( '#__ccmarketplace_categories') .
			    		" WHERE parent_id='".$group_id."' AND published='1'" .
			    		" ORDER BY ordering ASC";

		        $db->setQuery( $sql_categories);

		        $_category_list = $db->loadAssocList();

				reset( $_category_list);
				while (list($key, $val) = each( $_category_list)) {

		        	$category_id 	 = $_category_list[$key]['id'];
		        	$category_name   = $_category_list[$key]['name'];
		        	$category_slug   = $_category_list[$key]['slug'];

					if ( $category_id == $cat_id) { // this category is the current active
						$html .= "<option value='".$category_id."' selected='selected'>" . $category_name;
					}
					else {
						$html .= "<option value='".$category_id."'>" . $category_name;
					}

					$category_urlTMP = "index.php?option=com_ccmarketplace&view=category&catid=".$category_slug;
        			$category_url = JRoute::_( $category_urlTMP);


					$slugs[$iSlug][0] = utf8_encode( $category_id);
					$slugs[$iSlug][1] = utf8_encode( $category_url);
					$iSlug++;

				}
				/* get categories from this group */

			$html .= "</optgroup>";

		}

		$html .=	"</select>";

		print "<script type='text/javascript'> var slugsarray = ".json_encode($slugs)."; </script>";


		return $html;

	}



	function getCategorySelectBox( $cat_id) {

		$user =& JFactory::getUser();

		$db	=& JFactory::getDBO();




		$html = "<select class='quickselectbox' name='categoryselectbox'>";

		// get all published category groups
	    $sql_groups = "SELECT id, name FROM ".$db->nameQuote( '#__ccmarketplace_categories') .
		    		" WHERE parent_id='0' AND published='1'" .
	    			" ORDER BY ordering ASC";


        $db->setQuery( $sql_groups);

        $_group_list = $db->loadAssocList();

		reset( $_group_list);
		while (list($key, $val) = each( $_group_list)) {

        	$group_id 	= $_group_list[$key]['id'];
        	$group_name = $_group_list[$key]['name'];

			$html .= "<optgroup label='".$group_name."'>";


				/* get categories from this group */
				// get all published categories in this group
			    $sql_categories = "SELECT id, name, " .
			    		" CASE WHEN CHAR_LENGTH(alias) THEN CONCAT_WS(':', id, alias) ELSE id END as slug" .
			    		" FROM ".$db->nameQuote( '#__ccmarketplace_categories') .
			    		" WHERE parent_id='".$group_id."' AND published='1'" .
			    		" ORDER BY ordering ASC";

		        $db->setQuery( $sql_categories);

		        $_category_list = $db->loadAssocList();

				reset( $_category_list);
				while (list($key, $val) = each( $_category_list)) {

		        	$category_id 	 = $_category_list[$key]['id'];
		        	$category_name   = $_category_list[$key]['name'];
		        	$category_slug   = $_category_list[$key]['slug'];

					if ( $category_id == $cat_id) { // this category is the current active
						$html .= "<option value='".$category_id."' selected='selected'>" . $category_name;
					}
					else {
						$html .= "<option value='".$category_id."'>" . $category_name;
					}

					$category_urlTMP = "index.php?option=com_ccmarketplace&view=category&catid=".$category_slug;
        			$category_url = JRoute::_( $category_urlTMP);


				}
				/* get categories from this group */

			$html .= "</optgroup>";

		}

		$html .=	"</select>";

		return $html;

	}



	function getCategorySlugById( $cat_id) {

		$db	=& JFactory::getDBO();

		$sql = "SELECT CASE WHEN CHAR_LENGTH(alias) THEN CONCAT_WS(':', id, alias) ELSE id END as slug" .
				" FROM " . $db->nameQuote('#__ccmarketplace_categories') . " WHERE id='". $cat_id . "'";

		$db->setQuery( $sql);
		$slug = $db->loadResult();

		if ( !$slug) {
			return "";
		}
		else {
			return $slug;
		}

	}






	function getLabelSelectBox( $lab_id) {

		$user =& JFactory::getUser();

		$db	=& JFactory::getDBO();




		$html = "<select class='labelselectbox' name='labelselectbox'>";


			// get all published labels
		    $sql = "SELECT id, name " .
		    		" FROM ".$db->nameQuote( '#__ccmarketplace_labels') .
		    		" WHERE published='1'" .
		    		" ORDER BY ordering ASC";

	        $db->setQuery( $sql);

	        $_label_list = $db->loadAssocList();

			reset( $_label_list);
			while (list($key, $val) = each( $_label_list)) {

	        	$label_id 	  = $_label_list[$key]['id'];
	        	$label_name   = $_label_list[$key]['name'];

				if ( $label_id == $lab_id) { // this label is the current active
					$html .= "<option value='".$label_id."' selected='selected'>" . $label_name;
				}
				else {
					$html .= "<option value='".$label_id."'>" . $label_name;
				}

			}


		$html .=	"</select>";

		return $html;

	}



	function getUsernameById( $id) {

		$db	=& JFactory::getDBO();

		$sql = "SELECT username FROM ".$db->nameQuote('#__users')." WHERE id='". $id . "'";

		$db->setQuery( $sql);
		$username = $db->loadResult();

		if ( !$username) {
			return "-";
		}
		else {
			return $username;
		}

	}


	function getLabelnameById( $id) {

		$db	=& JFactory::getDBO();

		$sql = "SELECT name FROM ".$db->nameQuote('#__ccmarketplace_labels')." WHERE id='". $id . "'";

		$db->setQuery( $sql);
		$labelname = $db->loadResult();

		if ( !$labelname) {
			return "-";
		}
		else {
			return $labelname;
		}

	}


	function expireEntries( $duration, $mode, $cleanup, $cleanupduration) {

		$db	=& JFactory::getDBO();

		$db->setQuery( "SELECT CURRENT_DATE()");
		$date_current = $db->loadResult();


	    // are there expired entries?
        $sql = "SELECT COUNT(*) FROM #__ccmarketplace_entries WHERE date_created < DATE_SUB( '" . $date_current . "', INTERVAL " . $duration . " DAY)";
		$db->setQuery( $sql);
		$count_expired = $db->loadResult();

		if ( $count_expired > 0) { // found expired entries

			switch ( $mode) {

				case 1: { // unpublish

					$sql = "UPDATE #__ccmarketplace_entries SET published='0', expired='1' WHERE date_created < DATE_SUB( '" . $date_current . "', INTERVAL " . $duration . " DAY)";
					$db->setQuery( $sql);
					$db->query();

					break;
				}

				case 2: { // delete

	                // select loop over expired entries
                    $sql = "SELECT id FROM #__ccmarketplace_entries WHERE date_created < DATE_SUB( '" . $date_current . "', INTERVAL " . $duration . " DAY)";
                    $db->setQuery( $sql);
                    $rows = $db->loadObjectList();

                    foreach ( $rows as $row ) {
                        $this->rm_imagefolder( $row->id);
                    }

	                // delete the entries from database
					$sql = "DELETE FROM #__ccmarketplace_entries WHERE date_created < DATE_SUB( '" . $date_current . "', INTERVAL " . $duration . " DAY)";
					$db->setQuery( $sql);
					$db->query();

					break;
				}

				default: { // do nothing

					break;
				}


			}

		} // if count_expired > 0



	    // are there entries to cleanup?
        $sql = "SELECT COUNT(*) FROM #__ccmarketplace_entries WHERE date_created < DATE_SUB( '" . $date_current . "', INTERVAL " . $cleanupduration . " DAY)";
		$db->setQuery( $sql);
		$count_cleanup = $db->loadResult();

		if ( $count_cleanup > 0) { // found entries to cleanup

			if ( $cleanup == 1)	{ // cleanup (delete) unpublished entries

                // select loop over cleanup entries
                $sql = "SELECT id FROM #__ccmarketplace_entries WHERE date_created < DATE_SUB( '" . $date_current . "', INTERVAL " . $cleanupduration . " DAY)";
                $db->setQuery( $sql);
                $rows = $db->loadObjectList();

                foreach ( $rows as $row ) {
                    $this->rm_imagefolder( $row->id);
                }

                // delete the entries from database
				$sql = "DELETE FROM #__ccmarketplace_entries WHERE date_created < DATE_SUB( '" . $date_current . "', INTERVAL " . $cleanupduration . " DAY)";
				$db->setQuery( $sql);
				$db->query();

			}

		} // if count_cleanup > 0


	}


	function getItemidByComponentName( $component) {

		$db	=& JFactory::getDBO();

		$sql = "SELECT extension_id FROM " . $db->nameQuote('#__extensions') . " WHERE " . $db->nameQuote('element') . "=" . $db->Quote($component);

		$db->setQuery( $sql);
		$componentid = $db->loadResult();

		if ( !$componentid) {

			return 0;

		}
		else {

			$sql = "SELECT id FROM " . $db->nameQuote('#__menu') .
					" WHERE " . $db->nameQuote('component_id') . "=" . $db->Quote($componentid) . " AND level='1' AND published='1' ";

			$db->setQuery( $sql);
			$itemid = $db->loadResult();

			if ( !$itemid) {
				return 0;
			}
			else {
				return $itemid;
			}

		}

	}


	function getVersion() {

		$db	=& JFactory::getDBO();

		$sql = "SELECT version FROM " . $db->nameQuote( '#__ccmarketplace_meta')." WHERE id='1'";

		$db->setQuery( $sql);
		$version = $db->loadResult();

		if ( !$version) {
			return "0";
		}
		else {
			return $version;
		}

	}



	function getCategoryUseFirstnameById( $id) {

		$db	=& JFactory::getDBO();

		$sql = "SELECT use_firstname FROM " . $db->nameQuote( '#__ccmarketplace_categories') . " WHERE id='" . $id . "'";

		$db->setQuery( $sql);
		$use = $db->loadResult();

        switch ( $use) {

            case 0: {
                return 0; // No
                break;
            }

            case 1: {
                return 1; // Yes
                break;
            }

            default: {
                return 2; // global
                break;
            }

        }

	}

	function getCategoryUseLastnameById( $id) {

		$db	=& JFactory::getDBO();

		$sql = "SELECT use_lastname FROM " . $db->nameQuote( '#__ccmarketplace_categories') . " WHERE id='" . $id . "'";

		$db->setQuery( $sql);

		$use = $db->loadResult();

        switch ( $use) {

            case 0: {
                return 0; // No
                break;
            }

            case 1: {
                return 1; // Yes
                break;
            }

            default: {
                return 2; // global
                break;
            }

        }

	}


	function getCategoryUseCompanyById( $id) {

		$db	=& JFactory::getDBO();

		$sql = "SELECT use_company FROM " . $db->nameQuote( '#__ccmarketplace_categories') . " WHERE id='" . $id . "'";

		$db->setQuery( $sql);

		$use = $db->loadResult();

        switch ( $use) {

            case 0: {
                return 0; // No
                break;
            }

            case 1: {
                return 1; // Yes
                break;
            }

            default: {
                return 2; // global
                break;
            }

        }

	}


	function getCategoryUseStreetById( $id) {

		$db	=& JFactory::getDBO();

		$sql = "SELECT use_street FROM " . $db->nameQuote( '#__ccmarketplace_categories') . " WHERE id='" . $id . "'";

		$db->setQuery( $sql);
		$use = $db->loadResult();

        switch ( $use) {

            case 0: {
                return 0; // No
                break;
            }

            case 1: {
                return 1; // Yes
                break;
            }

            default: {
                return 2; // global
                break;
            }

        }

	}

	function getCategoryUseZipById( $id) {

		$db	=& JFactory::getDBO();

		$sql = "SELECT use_zip FROM " . $db->nameQuote( '#__ccmarketplace_categories') . " WHERE id='" . $id . "'";

		$db->setQuery( $sql);
		$use = $db->loadResult();

        switch ( $use) {

            case 0: {
                return 0; // No
                break;
            }

            case 1: {
                return 1; // Yes
                break;
            }

            default: {
                return 2; // global
                break;
            }

        }

	}

	function getCategoryUseCityById( $id) {

		$db	=& JFactory::getDBO();

		$sql = "SELECT use_city FROM " . $db->nameQuote( '#__ccmarketplace_categories') . " WHERE id='" . $id . "'";

		$db->setQuery( $sql);
		$use = $db->loadResult();

        switch ( $use) {

            case 0: {
                return 0; // No
                break;
            }

            case 1: {
                return 1; // Yes
                break;
            }

            default: {
                return 2; // global
                break;
            }

        }

	}

	function getCategoryUseStateById( $id) {

		$db	=& JFactory::getDBO();

		$sql = "SELECT use_state FROM " . $db->nameQuote( '#__ccmarketplace_categories') . " WHERE id='" . $id . "'";

		$db->setQuery( $sql);
		$use = $db->loadResult();

        switch ( $use) {

            case 0: {
                return 0; // No
                break;
            }

            case 1: {
                return 1; // Yes
                break;
            }

            default: {
                return 2; // global
                break;
            }

        }

	}

	function getCategoryUseCountryById( $id) {

		$db	=& JFactory::getDBO();

		$sql = "SELECT use_country FROM " . $db->nameQuote( '#__ccmarketplace_categories') . " WHERE id='" . $id . "'";

		$db->setQuery( $sql);
		$use = $db->loadResult();

        switch ( $use) {

            case 0: {
                return 0; // No
                break;
            }

            case 1: {
                return 1; // Yes
                break;
            }

            default: {
                return 2; // global
                break;
            }

        }

	}

	function getCategoryUsePhoneById( $id) {

		$db	=& JFactory::getDBO();

		$sql = "SELECT use_phone FROM " . $db->nameQuote( '#__ccmarketplace_categories') . " WHERE id='" . $id . "'";

		$db->setQuery( $sql);
		$use = $db->loadResult();

        switch ( $use) {

            case 0: {
                return 0; // No
                break;
            }

            case 1: {
                return 1; // Yes
                break;
            }

            default: {
                return 2; // global
                break;
            }

        }

	}

	function getCategoryUseMobileById( $id) {

		$db	=& JFactory::getDBO();

		$sql = "SELECT use_mobile FROM " . $db->nameQuote( '#__ccmarketplace_categories') . " WHERE id='" . $id . "'";

		$db->setQuery( $sql);
		$use = $db->loadResult();

        switch ( $use) {

            case 0: {
                return 0; // No
                break;
            }

            case 1: {
                return 1; // Yes
                break;
            }

            default: {
                return 2; // global
                break;
            }

        }

	}

	function getCategoryUseEmailById( $id) {

		$db	=& JFactory::getDBO();

		$sql = "SELECT use_email FROM " . $db->nameQuote( '#__ccmarketplace_categories') . " WHERE id='" . $id . "'";

		$db->setQuery( $sql);
		$use = $db->loadResult();

        switch ( $use) {

            case 0: {
                return 0; // No
                break;
            }

            case 1: {
                return 1; // Yes
                break;
            }

            default: {
                return 2; // global
                break;
            }

        }

	}

	function getCategoryUseWebById( $id) {

		$db	=& JFactory::getDBO();

		$sql = "SELECT use_web FROM " . $db->nameQuote( '#__ccmarketplace_categories') . " WHERE id='" . $id . "'";

		$db->setQuery( $sql);
		$use = $db->loadResult();

        switch ( $use) {

            case 0: {
                return 0; // No
                break;
            }

            case 1: {
                return 1; // Yes
                break;
            }

            default: {
                return 2; // global
                break;
            }

        }

	}

	function getCategoryUseConditionById( $id) {

		$db	=& JFactory::getDBO();

		$sql = "SELECT use_condition FROM " . $db->nameQuote( '#__ccmarketplace_categories') . " WHERE id='" . $id . "'";

		$db->setQuery( $sql);
		$use = $db->loadResult();

        switch ( $use) {

            case 0: {
                return 0; // No
                break;
            }

            case 1: {
                return 1; // Yes
                break;
            }

            default: {
                return 2; // global
                break;
            }

        }

	}

	function getCategoryUsePriceById( $id) {

		$db	=& JFactory::getDBO();

		$sql = "SELECT use_price FROM " . $db->nameQuote( '#__ccmarketplace_categories') . " WHERE id='" . $id . "'";

		$db->setQuery( $sql);
		$use = $db->loadResult();

        switch ( $use) {

            case 0: {
                return 0; // No
                break;
            }

            case 1: {
                return 1; // Yes
                break;
            }

            default: {
                return 2; // global
                break;
            }

        }

	}



    function del_image( $entry_id, $image, $absolute_path, $db, $imagenumber) {

        $image_folder = $absolute_path."/images/ccmarketplace/entries/";

        // get image name
        $sql = "SELECT " . $image . " FROM #__ccmarketplace_entries WHERE id=".$entry_id;
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
            $sql = "UPDATE #__ccmarketplace_entries SET ". $image . "='' WHERE id=".$entry_id;

            $db->setQuery( $sql);

            if ($db->getErrorNum()) {
                echo $db->stderr();
            } else {
                $db->query();
            }

        }

    }



    function rm_imagefolder( $entry_id) {

        $db	=& JFactory::getDBO();

        // get folder name
        $rootDir = JPATH_ROOT;

        $folder = $rootDir . "/images/ccmarketplace/entries/" . $entry_id;


        // 1. delete all existing images for this entry
        // get image names
        $sql = "SELECT image1, image2, image3, image4, image5, image6, image7, image8, image9, image10 FROM #__ccmarketplace_entries WHERE id=".$entry_id;
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


    function getAvatarFromDiscussionsById( $id) {

        $db	=& JFactory::getDBO();

        $sql = "SELECT avatar FROM ".$db->nameQuote('#__discussions_users')." WHERE id='". $id . "'";

        $db->setQuery( $sql);
        $avatar = $db->loadResult();

        if ( !$avatar) {
            return "";
        }
        else {
            return $avatar;
        }

    }


}







