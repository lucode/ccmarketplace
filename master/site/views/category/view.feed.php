<?php

/**
*
* CCMarketplace - Classified Ads for Joomla!
*
* @package		CCMarketplace
* @subpackage	Frontend
* @author		Achim Fischer
* @copyright	Copyright (C) 2005-2012 Achim Fischer (Codingfish). All rights reserved.
* @link			http://www.codingfish.com
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

require_once(JPATH_COMPONENT.DS.'classes/helper.php');



/**
 * Category View
 */
class CCMarketplaceViewCategory extends JView {


	/**
     * Renders the view
     *
     */
    function display() {

		$cHelper = new CodingfishFrontendHelper();

		$document =& JFactory::getDocument();

        $categoryName               =& $this->get('CategoryName');
		$categoryDescription        =& $this->get('CategoryDescription');

		$docTitle = $categoryName;
		$document->setTitle( $docTitle);
		$document->setDescription( $categoryDescription);


		$entries =& $this->get('RSSEntries');


		foreach ( $entries as $entry ) {

			$title = $this->escape( $entry->headline );
			$title = html_entity_decode( $title );

			$_cslug = $cHelper->getCategorySlugById( $entry->category_id);
			$link = JRoute::_('index.php?option=com_ccmarketplace&view=entry&catid=' . $_cslug . '&entry=' . $entry->slug );

			$_user = $cHelper->getUsernameById( $entry->user_id);

			$description = $entry->text;

			$date = ( $entry->date ? date( 'r', strtotime( $entry->date) ) : '' );

			$feeditem = new JFeedItem();
			$feeditem->title 		= $title;
			$feeditem->link 		= $link;
			$feeditem->description 	= $description;
			$feeditem->date			= $date;
			$feeditem->author 		= $_user;

			$db	=& JFactory::getDBO();
            $db->setQuery( "SELECT name FROM #__ccmarketplace_categories WHERE id='" . $entry->category_id . "' AND published='1'" );
            $_category = $db->loadResult();
			$feeditem->category = $_category;

			$document->addItem( $feeditem );
		}





    }


}

