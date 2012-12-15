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

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

JTable::addIncludePath(JPATH_COMPONENT.DS.'tables');



class CCMarketplaceModelEntry extends JModel {

	var $_id = null;

	var $_data = null;



	function __construct() {

		parent::__construct();

		$array  = JRequest::getVar( 'cid', array(0), '', 'array');
		$edit	= JRequest::getVar( 'edit', true);

		if($edit) {

			$this->setId( (int)$array[0]);

		}

	}



	function setId( $id) {

		$this->_id		= $id;

		$this->_data	= null;

	}



	function &getData() {

		if ( $this->_loadData()) {

			$user = &JFactory::getUser();

		}
		else  {
			$this->_initData();
		}

		return $this->_data;
	}



	function _loadData() {

		if (empty($this->_data)) {

			$query = 'SELECT * FROM #__ccmarketplace_entries WHERE id = '.(int) $this->_id;

			$this->_db->setQuery($query);

			$this->_data = $this->_db->loadObject();

			return (boolean) $this->_data;

		}

		return true;

	}



	function store( $data) {

		$cb_image1  = JRequest::getString( 'cb_image1', '', 'POST');
		$cb_image2  = JRequest::getString( 'cb_image2', '', 'POST');
		$cb_image3  = JRequest::getString( 'cb_image3', '', 'POST');
		$cb_image4  = JRequest::getString( 'cb_image4', '', 'POST');
		$cb_image5  = JRequest::getString( 'cb_image5', '', 'POST');
		$cb_image6  = JRequest::getString( 'cb_image6', '', 'POST');
		$cb_image7  = JRequest::getString( 'cb_image7', '', 'POST');
		$cb_image8  = JRequest::getString( 'cb_image8', '', 'POST');
		$cb_image9  = JRequest::getString( 'cb_image9', '', 'POST');
		$cb_image10 = JRequest::getString( 'cb_image10', '', 'POST');


        $row =& JTable::getInstance('marketplaceentry', 'Table');

		if ( !$row->bind($data)) {

			$this->setError($this->_db->getErrorMsg());

			return false;

		}




		if ( !$row->id) { // new entry

			$row->date_created  = gmdate('Y-m-d H:i:s');

		}
		else { // edited entry

			$row->date_lastmodified = gmdate('Y-m-d H:i:s');

		}


		// create alias for SEF URL
		jimport( 'joomla.filter.output' );

		$alias = $row->headline;
		$alias = JFilterOutput::stringURLSafe( $alias);
		$row->alias  = $alias;


		if ( !$row->check()) {

			$this->setError( $this->_db->getErrorMsg());

			return false;

		}

		if ( !$row->store()) {

			$this->setError( $this->_db->getErrorMsg());

			return false;

		}


		// get folder name
		$rootDir = JPATH_ROOT;


	    // check if there are images to delete
		if ( $cb_image1  == "delete") {
		    	$this->del_image( $row->id, "image1", $rootDir, $this->_db, 1);
		}

		if ( $cb_image2  == "delete") {
		    	$this->del_image( $row->id, "image2", $rootDir, $this->_db, 2);
		}

		if ( $cb_image3  == "delete") {
		    	$this->del_image( $row->id, "image3", $rootDir, $this->_db, 3);
		}

		if ( $cb_image4  == "delete") {
		    	$this->del_image( $row->id, "image4", $rootDir, $this->_db, 4);
		}

		if ( $cb_image5  == "delete") {
		    	$this->del_image( $row->id, "image5", $rootDir, $this->_db, 5);
		}

		if ( $cb_image6  == "delete") {
		    	$this->del_image( $row->id, "image6", $rootDir, $this->_db, 6);
		}

		if ( $cb_image7  == "delete") {
		    	$this->del_image( $row->id, "image7", $rootDir, $this->_db, 7);
		}

		if ( $cb_image8  == "delete") {
		    	$this->del_image( $row->id, "image8", $rootDir, $this->_db, 8);
		}

		if ( $cb_image9  == "delete") {
		    	$this->del_image( $row->id, "image9", $rootDir, $this->_db, 9);
		}

		if ( $cb_image10  == "delete") {
		    	$this->del_image( $row->id, "image10", $rootDir, $this->_db, 10);
		}





		if (isset( $_FILES['image1']) and !$_FILES['image1']['error'] ) {
	    	$this->add_image( $row->id, "image1", $rootDir, $this->_db, 1);
		}
		if (isset( $_FILES['image2']) and !$_FILES['image2']['error'] ) {
	    	$this->add_image( $row->id, "image2", $rootDir, $this->_db, 2);
		}
		if (isset( $_FILES['image3']) and !$_FILES['image3']['error'] ) {
	    	$this->add_image( $row->id, "image3", $rootDir, $this->_db, 3);
		}
		if (isset( $_FILES['image4']) and !$_FILES['image4']['error'] ) {
	    	$this->add_image( $row->id, "image4", $rootDir, $this->_db, 4);
		}
		if (isset( $_FILES['image5']) and !$_FILES['image5']['error'] ) {
	    	$this->add_image( $row->id, "image5", $rootDir, $this->_db, 5);
		}
		if (isset( $_FILES['image6']) and !$_FILES['image6']['error'] ) {
	    	$this->add_image( $row->id, "image6", $rootDir, $this->_db, 6);
		}
		if (isset( $_FILES['image7']) and !$_FILES['image7']['error'] ) {
	    	$this->add_image( $row->id, "image7", $rootDir, $this->_db, 7);
		}
		if (isset( $_FILES['image8']) and !$_FILES['image8']['error'] ) {
	    	$this->add_image( $row->id, "image8", $rootDir, $this->_db, 8);
		}
		if (isset( $_FILES['image9']) and !$_FILES['image9']['error'] ) {
	    	$this->add_image( $row->id, "image9", $rootDir, $this->_db, 9);
		}
		if (isset( $_FILES['image10']) and !$_FILES['image10']['error'] ) {
	    	$this->add_image( $row->id, "image10", $rootDir, $this->_db, 10);
		}


		return true;
	}



	function _initData() {

		if (empty($this->_data)) {

			$entry = new stdClass();

			$entry->id					= 0;
			$entry->category_id			= 0;
			$entry->label_id			= 0;
			$entry->user_id				= 0;

			$entry->firstname			= "";
			$entry->lastname			= "";
			$entry->company				= "";

			$entry->street				= "";
			$entry->zip					= "";
			$entry->city				= "";
			$entry->state				= "";
			$entry->country				= "";

			$entry->phone				= "";
			$entry->mobile				= "";
			$entry->email				= "";
			$entry->web					= "";

			$entry->headline			= "";
			$entry->text				= "";

			$entry->condition			= "";
			$entry->price				= "";


			$entry->date_created		= "";
			$entry->date_lastmodified	= "";

			$entry->published			= 0;

			$this->_data				= $entry;

			return (boolean) $this->_data;

		}

		return true;

	}



	function delete($cid = array()) {

		$result = false;

		if (count( $cid )) {

			JArrayHelper::toInteger($cid);

			$cids = implode( ',', $cid );


			// remove image folder for deleted entries
			$tok = strtok( $cids, ",");

			while ( $tok !== false) {

				$this->rm_imagefolder( $tok, $this->_db);

    			$tok = strtok(",");

			}


			// remove entries from database
			$query = 'DELETE FROM #__ccmarketplace_entries' . ' WHERE id IN ( '.$cids.' )';

			$this->_db->setQuery( $query );

			if(!$this->_db->query()) {

				$this->setError($this->_db->getErrorMsg());

				return false;

			}

		}


		return true;

	}




	function add_image( $entry_id, $image, $absolute_path, $db, $imagenumber) {

	    // get max_imagesize from parameters
		$params = JComponentHelper::getParams('com_ccmarketplace');
		$max_image_size = $params->get('maxImageSize', '209715200'); // 200 KByte default

		$max_big_image_x = $params->get('maxBigImageX', '800');
		$max_big_image_y = $params->get('maxBigImageY', '600');

		$max_small_image_x = $params->get('maxSmallImageX', '128');
		$max_small_image_y = $params->get('maxSmallImageY', '96');


	    $af_dir_ads = $absolute_path."/images/marketplace/entries/";


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
	        echo "The uploaded image is too big";
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
				// 2. create the subdirs for ORIGINAL, LARGE (128) and SMALL(32)
				if ( !is_dir( $af_dir_ads.$entry_id)) {
					mkdir($af_dir_ads.$entry_id);
					mkdir($af_dir_ads.$entry_id."/original"); // ORIGINAL
					mkdir($af_dir_ads.$entry_id."/large"); // LARGE (800)
					mkdir($af_dir_ads.$entry_id."/small"); // SMALL (128)
				}


				$original_image = $af_dir_ads.$entry_id."/original/".$entry_id . "_" . $imagenumber . "." . $thispicext;
				$large_image = $af_dir_ads.$entry_id."/large/".$entry_id . "_" . $imagenumber . "." . $thispicext;
				$small_image = $af_dir_ads.$entry_id."/small/".$entry_id . "_" . $imagenumber . "." . $thispicext;


	            // copy original image to folder "original"
	            move_uploaded_file ( $_FILES[$image]['tmp_name'], $original_image);


	            // create "large" image 800px
	            switch ($af_size[2]) {
	                case 1 : $src = ImageCreateFromGif(  $original_image); break;
	                case 2 : $src = ImageCreateFromJpeg( $original_image); break;
	                case 3 : $src = ImageCreateFromPng(  $original_image); break;
	            }

	            $width_before  = ImageSx( $src);
	            $height_before = ImageSy( $src);

	            if ( $width_before  >= $height_before) {
	                $width_new = min($max_big_image_x, $width_before);
	                $scale = $width_before / $height_before;
	                $height_new = round( $width_new / $scale);
	            }
	            else {
	                $height_new = min($max_big_image_y, $height_before);
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


	            // create "small" image 128px
	            switch ($af_size[2]) {
	                case 1 : $src = ImageCreateFromGif(  $original_image); break;
	                case 2 : $src = ImageCreateFromJpeg( $original_image); break;
	                case 3 : $src = ImageCreateFromPng(  $original_image); break;
	            }

	            $width_before  = ImageSx( $src);
	            $height_before = ImageSy( $src);

	            if ( $width_before  >= $height_before) {
	                $width_new = min($max_small_image_x, $width_before);
	                $scale = $width_before / $height_before;
	                $height_new = round( $width_new / $scale);
	            }
	            else {
	                $height_new = min($max_small_image_y, $height_before);
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
	            $sql = "UPDATE #__ccmarketplace_entries SET ". $image . "='".$entry_id . "_" . $imagenumber . "." .$thispicext ."' WHERE id=".$entry_id;

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

	    $entries_dir = $absolute_path."/images/marketplace/entries/";

        // get image name
        $sql = "SELECT " . $image . " FROM #__ccmarketplace_entries WHERE id=".$entry_id;
		$db->setQuery( $sql);
		$imagename = $db->loadResult();


		if ( $imagename != "") {

			$original_image = $entries_dir.$entry_id."/original/" . $imagename;
			$large_image = $entries_dir.$entry_id."/large/" . $imagename;
			$small_image = $entries_dir.$entry_id."/small/" . $imagename;

            if ( file_exists( $original_image)) {
                unlink( $original_image);
            }
            if ( file_exists( $large_image)) {
                unlink( $large_image);
            }
            if ( file_exists( $small_image)) {
                unlink( $small_image);
            }

            // DB updaten
            $sql = "UPDATE #__ccmarketplace_entries SET ". $image . "='' WHERE id=".$entry_id;

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
        $sql = "SELECT image1, image2, image3, image4, image5, image6, image7, image8, image9, image10 FROM #__ccmarketplace_entries WHERE id=".$entry_id;
		$db->setQuery( $sql);
		$rows = $db->loadObjectList();

		foreach ( $rows as $row ) {

			if ( $row-image1 != "") {
				$this->del_image( $entry_id, "image1", $rootDir, $db, 1);
			}
			if ( $row-image2 != "") {
				$this->del_image( $entry_id, "image2", $rootDir, $db, 2);
			}
			if ( $row-image3 != "") {
				$this->del_image( $entry_id, "image3", $rootDir, $db, 3);
			}
			if ( $row-image4 != "") {
				$this->del_image( $entry_id, "image4", $rootDir, $db, 4);
			}
			if ( $row-image5 != "") {
				$this->del_image( $entry_id, "image5", $rootDir, $db, 5);
			}
			if ( $row-image6 != "") {
				$this->del_image( $entry_id, "image6", $rootDir, $db, 6);
			}
			if ( $row-image7 != "") {
				$this->del_image( $entry_id, "image7", $rootDir, $db, 7);
			}
			if ( $row-image8 != "") {
				$this->del_image( $entry_id, "image8", $rootDir, $db, 8);
			}
			if ( $row-image9 != "") {
				$this->del_image( $entry_id, "image9", $rootDir, $db, 9);
			}
			if ( $row-image10 != "") {
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




}