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



/**
 * Entry View
 */
class CCMarketplaceViewEntry extends JView {


	/**
     * Renders the view
     *
     */
    function display() {

		$user =& JFactory::getUser();

		$document 		=& JFactory::getDocument();

        $app 		= JFactory::getApplication();
        $pathway	= &$app->getPathway();

		$cHelper = new CodingfishFrontendHelper();



        $task			    =& $this->get('task');
        $header   		    =& $this->get('Header');

        $id				    =& $this->get('id');
        $user_id		    =& $this->get('userid');
		$category_id	    =& $this->get('catid');
		$label_id		    =& $this->get('labelid');

        $firstname		    =& $this->get('firstname');
        $lastname		    =& $this->get('lastname');
        $company		    =& $this->get('company');

        $street			    =& $this->get('street');
        $zip			    =& $this->get('zip');
        $city			    =& $this->get('city');
        $entryState		    =& $this->get('entryState');
        $country		    =& $this->get('country');

        $phone			    =& $this->get('phone');
        $mobile			    =& $this->get('mobile');
        $email			    =& $this->get('email');
        $web			    =& $this->get('web');

        $headline		    =& $this->get('headline');
        $text			    =& $this->get('text');

        $entryCondition	    =& $this->get('entryCondition');
        $price			    =& $this->get('price');

        $image1			    =& $this->get('image1');
        $image2			    =& $this->get('image2');
        $image3			    =& $this->get('image3');
        $image4			    =& $this->get('image4');
        $image5			    =& $this->get('image5');
        $image6			    =& $this->get('image6');
        $image7			    =& $this->get('image7');
        $image8			    =& $this->get('image8');
        $image9			    =& $this->get('image9');
        $image10		    =& $this->get('image10');

        $video1			    =& $this->get('video1');


        $categoryId		        =& $this->get('CategoryId');
        $categorySlug           =& $this->get('CategorySlug');
        $categoryName           =& $this->get('CategoryName');
        $categoryDescription    =& $this->get('CategoryDescription');
        $categoryImage          =& $this->get('CategoryImage');

        $published		    =& $this->get('published');
        $expired		    =& $this->get('expired');

        $flag_commercial    =& $this->get('FlagCommercial');

        $dateCreated		=& $this->get('DateCreated');


        if ( $task == "" && $published == 0) {

			if ( $user_id <> $user->id) {  // only allow access to unpublished entries to entry owners

	            // redirect	link
	            $redirectLink = JRoute::_( "index.php?option=com_ccmarketplace&view=index");

	            // if entry is not published, show index page
	            $app->redirect( $redirectLink, JText::_( 'CCMP_ENTRY_NOT_AVAILABLE' ), "message");

			}

        }

		// get parameters
		$params = &$app->getParams();

		$menus	= &JSite::getMenu();
		$menu	= $menus->getActive();

        /*
		if (is_object( $menu )) {
			$menu_params = new JParameter( $menu->params );
			if (!$menu_params->get( 'page_title')) {
				$params->set('page_title',	JText::_( 'Marketplace' ));
			}
		} else {
			$params->set('page_title',	JText::_( 'Marketplace' ));
		}
        */


		$document->setTitle( $params->get( 'page_title' ) );

		//set breadcrumbs
		if( is_object($menu) && $menu->query['view'] != 'entry') {
			$pathway->addItem( $categoryName, 'index.php?option=com_ccmarketplace&view=category&catid=' . $this->escape( $categorySlug) );
			$pathway->addItem( $headline, '');
		}


		$entryUsername = $cHelper->getUsernameById( $user_id);
		$linkPrimezilla  = "";
        $linkDiscussionsMessages  = "";

		// get parameters
		$params 				 = JComponentHelper::getParams('com_ccmarketplace');
		$_usePrimezilla 		 = $params->get('usePrimezilla', 0); // 0 no, 1 yes
		$_callPrimezillaMode 	 = $params->get('callPrimezillaMode', 0); // 0 username, 1 userid
        $_useDiscussionsMessages = $params->get('useDiscussionsMessages', 0); // 0 no, 1 yes


        if ( $_useDiscussionsMessages == 1) { // use Discussions Messages

            $itemid = $cHelper->getItemidByComponentName( "com_discussions");
            if ( $itemid == 0) { // got no itemid
                $linkDiscussionsMessages  = JRoute::_( 'index.php?option=com_discussions&view=message&task=msg_new&userid=' . $user_id);
            }
            else {
                $linkDiscussionsMessages  = JRoute::_( 'index.php?option=com_discussions&view=message&task=msg_new&userid=' . $user_id . '&Itemid=' . $itemid);
            }


        }
        else { // if not Discussions Messages maybe we use good old Primezilla

            if ( $_usePrimezilla == 1) { // use Primezilla

                $_username = strtolower( $entryUsername);

                $itemid = $cHelper->getItemidByComponentName( "com_primezilla");
                if ( $itemid == 0) { // got no itemid

                    if ( $_callPrimezillaMode == 0) { // username
                        $linkPrimezilla  = JRoute::_( 'index.php?option=com_primezilla&view=message&task=new&username=' . $_username);
                    }
                    else { // userid
                        $linkPrimezilla  = JRoute::_( 'index.php?option=com_primezilla&view=message&task=new&userid=' . $user_id);
                    }

                }
                else {

                    if ( $_callPrimezillaMode == 0) { // username
                        $linkPrimezilla  = JRoute::_( 'index.php?option=com_primezilla&view=message&task=new&username=' . $_username . '&Itemid=' . $itemid);
                    }
                    else { // userid
                        $linkPrimezilla  = JRoute::_( 'index.php?option=com_primezilla&view=message&task=new&userid=' . $user_id . '&Itemid=' . $itemid);
                    }

                }

            }

        }






		$label = $cHelper->getLabelnameById( $label_id);

        $_meta_robots = $params->get('metaRobots', 'index, follow');
        $document->setMetaData( "robots", $_meta_robots);



		$this->assignRef('task', $task);
		$this->assignRef('header', $header);

		$this->assignRef('id', $id);
		$this->assignRef('user_id', $user_id);
		$this->assignRef('category_id', $category_id);
		$this->assignRef('label_id', $label_id);

		$this->assignRef('firstname', $firstname);
		$this->assignRef('lastname', $lastname);
		$this->assignRef('company', $company);

		$this->assignRef('street', $street);
		$this->assignRef('zip', $zip);
		$this->assignRef('city', $city);
		$this->assignRef('entryState', $entryState);
		$this->assignRef('country', $country);

		$this->assignRef('phone', $phone);
		$this->assignRef('mobile', $mobile);
		$this->assignRef('email', $email);
		$this->assignRef('web', $web);

		$this->assignRef('headline', $headline);
		$this->assignRef('text', $text);

		$this->assignRef('entryCondition', $entryCondition);
		$this->assignRef('price', $price);

		$this->assignRef('image1', $image1);
		$this->assignRef('image2', $image2);
		$this->assignRef('image3', $image3);
		$this->assignRef('image4', $image4);
		$this->assignRef('image5', $image5);
		$this->assignRef('image6', $image6);
		$this->assignRef('image7', $image7);
		$this->assignRef('image8', $image8);
		$this->assignRef('image9', $image9);
		$this->assignRef('image10', $image10);

		$this->assignRef('video1', $video1);

        $this->assignRef('dateCreated', $dateCreated);

		$this->assignRef('categoryId', $categoryId);
		$this->assignRef('categorySlug', $categorySlug);
		$this->assignRef('categoryName', $categoryName);
        $this->assignRef('categoryDescription', $categoryDescription);
		$this->assignRef('categoryImage', $categoryImage);

        $this->assignRef('published', $published);
        $this->assignRef('flag_commercial', $flag_commercial);
        $this->assignRef('expired', $expired);


		$this->assignRef('linkDiscussionsMessages', $linkDiscussionsMessages);
        $this->assignRef('linkPrimezilla', $linkPrimezilla);
		$this->assignRef('entryUsername', $entryUsername);

		$this->assignRef('label', $label);

		$this->assignRef('params',		$params);


        // display the view
        parent::display();

    }



}
