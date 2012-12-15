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

// no direct access
defined('_JEXEC') or die('Restricted access');

JHTML::_('stylesheet', 'ccmarketplace.css', 'components/com_ccmarketplace/assets/');

JHTML::_('behavior.formvalidation');

require_once(JPATH_COMPONENT.DS.'classes/user.php');

$app = JFactory::getApplication();
?>

<div class="codingfish">

<?php
echo "<script type='text/javascript'>";
	echo "function confirmdelete() { ";
 		echo "return confirm('" . JText::_( 'CCMP_CONFIRM_DELETE' ) . "');";
	echo "}";

	echo "function myValidate(f) {";
        echo "if (document.formvalidator.isValid(f)) {";
                echo "f.task.value='Apply';";
            	echo "f.submit(); ";
        echo "}";
        echo "else {";
                echo "alert('" . JText::_( 'CCMP_ENTRY_FORM_ERROR' ) . "');";
        		echo "return false;";
      	echo "}";
        echo "return false;";
	echo "}";

echo "</script>";


$user =& JFactory::getUser();
$logUser = new CofiUser( $user->id);


// set page title and description
$document =& JFactory::getDocument();

$title = $document->getTitle();
$siteName = $app->getCfg('sitename');



switch ( $this->task) {

	case "new":
	case "create":
	case "create1":
	case "create2":
	case "create3": {
		$title = JText::_( 'CCMP_NEW_ENTRY' );
		break;
	}
	default: {
		$title = $this->headline . " - " . $this->categoryName;
		break;
	}

}




$document->setTitle( $title);

$document->setDescription( $this->headline . ". " . $this->text );


//$user =& JFactory::getUser();
$cHelper = new CodingfishFrontendHelper();

// get parameters
$params = JComponentHelper::getParams('com_ccmarketplace');
$_commercialEntries = $params->get('commercialEntries', '0'); // 0 no, 1 yes



$catid = JRequest::getInt( 'categoryselectbox', 0);

if ( $catid == 0) {
    $catid = $this->category_id;
}


// get used fields

$_use_firstname = $cHelper->getCategoryUseFirstnameById( $catid);
if ( $_use_firstname == 2) { // global
	$_use_firstname = $params->get('useFirstname', '1'); // 0 no, 1 yes
}

$_use_lastname = $cHelper->getCategoryUseLastnameById( $catid);
if ( $_use_lastname == 2) { // global
	$_use_lastname = $params->get('useLastname', '1'); // 0 no, 1 yes
}

$_use_company = $cHelper->getCategoryUseCompanyById( $catid);
if ( $_use_company == 2) { // global
	$_use_company = $params->get('useCompany', '1'); // 0 no, 1 yes
}

$_use_street = $cHelper->getCategoryUseStreetById( $catid);
if ( $_use_street == 2) { // global
	$_use_street = $params->get('useStreet', '1'); // 0 no, 1 yes
}

$_use_zip = $cHelper->getCategoryUseZipById( $catid);
if ( $_use_zip == 2) { // global
	$_use_zip = $params->get('useZip', '1'); // 0 no, 1 yes
}

$_use_city = $cHelper->getCategoryUseCityById( $catid);
if ( $_use_city == 2) { // global
	$_use_city = $params->get('useCity', '1'); // 0 no, 1 yes
}

$_use_state = $cHelper->getCategoryUseStateById( $catid);
if ( $_use_state == 2) { // global
	$_use_state = $params->get('useState', '1'); // 0 no, 1 yes
}

$_use_country = $cHelper->getCategoryUseCountryById( $catid);
if ( $_use_country == 2) { // global
	$_use_country = $params->get('useCountry', '1'); // 0 no, 1 yes
}

$_use_phone = $cHelper->getCategoryUsePhoneById( $catid);
if ( $_use_phone == 2) { // global
	$_use_phone = $params->get('usePhone', '1'); // 0 no, 1 yes
}

$_use_mobile = $cHelper->getCategoryUseMobileById( $catid);
if ( $_use_mobile == 2) { // global
	$_use_mobile = $params->get('useMobile', '1'); // 0 no, 1 yes
}

$_use_email = $cHelper->getCategoryUseEmailById( $catid);
if ( $_use_email == 2) { // global
	$_use_email = $params->get('useEmail', '1'); // 0 no, 1 yes
}

$_use_web = $cHelper->getCategoryUseWebById( $catid);
if ( $_use_web == 2) { // global
	$_use_web = $params->get('useWeb', '1'); // 0 no, 1 yes
}

$_use_condition = $cHelper->getCategoryUseConditionById( $catid);
if ( $_use_condition == 2) { // global
	$_use_condition = $params->get('useCondition', '1'); // 0 no, 1 yes
}

$_use_price = $cHelper->getCategoryUsePriceById( $catid);
if ( $_use_price == 2) { // global
	$_use_price = $params->get('usePrice', '1'); // 0 no, 1 yes
}


$images = $params->get('images', '3'); // 3 default

$_imagesDisplayMode = $params->get('imagesDisplayMode', '0'); // 0 Browser, 1 Slimbox, 2 RokBox
$_includeMootoolsJS = $params->get('includeMootoolsJS', '0'); // 0 no, 1 yes
$_includeSlimboxJS  = $params->get('includeSlimboxJS', '0');  // 0 no, 1 yes

$_useDiscussionsMessages    = $params->get('useDiscussionsMessages', '0');  // 0 no, 1 yes
$_usePrimezilla  	        = $params->get('usePrimezilla', '0');  // 0 no, 1 yes

$_showContactDetailsToPublic  = $params->get('showContactDetailsToPublic', '0');  // 0 no, 1 yes

$_useDiscussionsAvatars = $params->get('useDiscussionsAvatars', 0);


if ( $_imagesDisplayMode == 1) { // Slimbox
	$assets = JURI::root() . "components/com_ccmarketplace/assets";
	$document->addStyleSheet( $assets.'/css/slimbox.css');
}


// website root directory
$_root = JURI::root();
?>


<?php
if ( $this->task == "") { // don't include when creating a new entry
?>

	<?php
	if ( $_includeMootoolsJS == 1) { // include Mootools JS
		echo "<script type=\"text/javascript\" src=\"" . $assets . "/js/mootools.js\"></script>";
	}

	if ( $_includeSlimboxJS == 1) { // include Slimbox JS
		echo "<script type=\"text/javascript\" src=\"" . $assets . "/js/slimbox.js\"></script>";
	}
	?>


	<!-- Javascript functions -->
	<script type="text/javascript">

	    function callURL(obj) {

	        $catid 		= obj.options[obj.selectedIndex].value;
			var length 	= slugsarray.length;

			for(var k=0; k < slugsarray.length; k++) {

				// if selected index found jump to category
				if ( slugsarray[k][0] == $catid) {
	         		location.href = slugsarray[k][1];
	        	}

			}

	    }

	</script>
	<!-- Javascript functions -->

<?php
}
?>


<?php
if ( $this->params->def( 'show_page_title', 1 ) ) :
	?>
	<div class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
		<?php echo $this->escape($this->params->get('page_title')); ?>
	</div>
	<?php
endif;
?>



<?php
if ( $this->task == "") { // don't display header stuff when creating a new entry
	?>

	<!-- HTML Box Top -->
	<?php
	$htmlBoxEntryTop = $params->get('htmlBoxEntryTop', '');

	if ( $htmlBoxEntryTop != "") {
		echo "<div class='cofiHtmlBoxEntryTop'>";
			echo $htmlBoxEntryTop;
		echo "</div>";
	}
	?>
	<!-- HTML Box Top -->



	<?php
	include( 'components/com_ccmarketplace/includes/topmenu.php');
	?>


	<!-- Category icon, name and description -->
	<table width="100%" class="noborder" style="margin-bottom:10px;">
	    <tr>

	        <!-- category image -->
	        <td width="50" class="noborder">
	            <?php
				if ( $this->categoryImage == "") {  // show default category image
					echo "<img src='". $_root ."/components/com_ccmarketplace/assets/categories/default.png' style='border:0px;margin:5px;' />";
				}
				else {
					echo "<img src='". $_root ."/components/com_ccmarketplace/assets/categories/".$this->categoryImage."' style='border:0px;margin:5px;' />";
				}
	            ?>
	        </td>
	        <!-- category image -->

	        <!-- category name and description -->
	        <td align="left" class="noborder">
	            <?php
	            echo "<h2 style='padding: 0px; margin: 0px 0px 5px 0px;'>";
	                echo $this->categoryName;
	            echo "</h2>";
	            echo $this->categoryDescription;
	            ?>
	        </td>
	        <!-- category name and description -->

	        <!-- category quick select box -->
	        <td align="right" class="noborder">
	            <?php
	            echo $cHelper->getQuickJumpSelectBox( $this->categoryId);
	            ?>
	        </td>
	        <!-- category quick select box -->

	    </tr>
	</table>
	<!-- Category icon, name and description -->



	<!-- Breadcrumb -->
	<table class="noborder" style="margin-top: 5px;">
	    <tr>
	        <td class="noborder">
	            <?php
	            $menuLinkHome     = JRoute::_( 'index.php?option=com_ccmarketplace');
                $menuText = $app->getMenu()->getActive()->title;
	            echo "<a href='$menuLinkHome'>" . $menuText . "</a>";
	            ?>
	        </td>
	        <td class="noborder">
	            <?php
	            $menuLinkCategoryTMP = "index.php?option=com_ccmarketplace&view=category&catid=".$this->categorySlug;
	            $menuLinkCategory = JRoute::_( $menuLinkCategoryTMP);
	            echo "&nbsp;&raquo;&nbsp;";
	            echo "<a href='$menuLinkCategory'>".$this->categoryName."</a>";
	            ?>
	        </td>
	        <td class="noborder">
	            <?php
	            	echo "&nbsp;&raquo;&nbsp;";
					echo $this->headline;
	            ?>
	        </td>
	    </tr>
	</table>
	<!-- Breadcrumb -->


    <?php

}






$_task = $this->task;

if ( $_commercialEntries == 0) { // only private entries
    $iSteps=3;
}
else { // commercial entries allowed
    $iSteps=4;
}


if ( $_commercialEntries == 0 && $_task == "create") { // only private entries
    $_task = "create1"; // skip private/commercial choice
}


switch ( $_task) {

    // wizard step 0, choose either private or commercial
    case "create": {

        if ( $_commercialEntries == 0) { // only private entries
            $iStep=0;
        }
        else { // commercial entries allowed
            $iStep=1;
            echo JText::_( 'CCMP_MARKETPLACE_RULES' );
        }

        echo "<br />";
        echo "<br />";
        echo "<h2>";
        echo JText::_( 'CCMP_STEP' )  . " " . $iStep . " / " . $iSteps ;
        echo "</h2>";

        echo "<div class='cofiEntryForm'>";

            echo "<form action='' method='post' name='entryform' id='entryform' >";

                echo "<table cellspacing='1' cellpadding='0' width='100%' class='noborder'>";


                    // private / commercial checkbox
                    echo "<tr>";
                        echo "<td class='noborder' style='padding: 5px;'>";

                            echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_PRIVATE_COMMERCIAL' ) . ":</div> ";

                                echo "<div class='cofiCategory'>";

                                    echo "<input type='radio' name='flag_commercial' value='0' checked> " . JText::_( 'CCMP_PRIVATE');
                                    echo "&nbsp;&nbsp;&nbsp;";
                                    echo "<input type='radio' name='flag_commercial' value='1'> " . JText::_( 'CCMP_COMMERCIAL');

                                echo "</div>";

                                echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_PRIVATE_COMMERCIAL_INFO' ) . "</div> ";

                        echo "</td>";
                    echo "</tr>";


                    // button
                    echo "<tr>";
                        echo "<td class='noborder' style='padding: 5px;'>";

                            echo "<div class='cofiButton'>";

                                echo "<input type='hidden' name='task' value='create1'>";
                                echo "<input class='cofiButton' type='submit' name='submit' value='" . JText::_( 'CCMP_CONTINUE' ) . "'>";

                                echo " " . JText::_( 'CCMP_OR' ) . " ";
                                $menuLinkHome      = JRoute::_( 'index.php?option=com_ccmarketplace');
                                echo "<a href='$menuLinkHome'>" . JText::_( 'CCMP_CANCEL' ) . "</a>";

                            echo "</div> ";

                        echo "</td>";
                    echo "</tr>";

                echo "</table>";

            echo "</form>";

        echo "</div>";


        break;
    }
    // wizard step 0, choose either private or commercial



	// wizard step 1
	case "create1": {

        if ( $_commercialEntries == 0) { // only private entries
            $iStep=1;
            echo JText::_( 'CCMP_MARKETPLACE_RULES' );
        }
        else { // commercial entries allowed
            $iStep=2;
        }

		echo "<br />";
		echo "<br />";
		echo "<h2>";
        echo JText::_( 'CCMP_STEP' )  . " " . $iStep . " / " . $iSteps ;
		echo "</h2>";

        $flag_commercial = JRequest::getInt( 'flag_commercial', 0);

		echo "<div class='cofiEntryForm'>";

		    echo "<form action='' method='post' name='entryform' id='entryform' >";

		    	echo "<table cellspacing='1' cellpadding='0' width='100%' class='noborder'>";


					// Category select box
		    		echo "<tr>";
		    			echo "<td class='noborder' style='padding: 5px;' >";

		    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_CATEGORY' ) . ":</div> ";

		            			echo "<div class='cofiCategory'>";
									echo $cHelper->getCategorySelectBox( 0); // 0 nothing selected
		            			echo "</div>";

		            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_CATEGORY_INFO' ) . "</div> ";

		    			echo "</td>";
		    		echo "</tr>";


					// button
		    		echo "<tr>";
		    			echo "<td class='noborder' style='padding: 5px;' >";

		            		echo "<div class='cofiButton'>";

                                echo "<input type='hidden' name='flag_commercial' value='" . $flag_commercial . "'>";
								echo "<input type='hidden' name='task' value='create2'>";
								echo "<input class='cofiButton' type='submit' name='submit' value='" . JText::_( 'CCMP_CONTINUE' ) . "'>";

								echo " " . JText::_( 'CCMP_OR' ) . " ";
								$menuLinkHome      = JRoute::_( 'index.php?option=com_ccmarketplace');
								echo "<a href='$menuLinkHome'>" . JText::_( 'CCMP_CANCEL' ) . "</a>";

							echo "</div> ";

		    			echo "</td>";
		    		echo "</tr>";

		    	echo "</table>";

		    echo "</form>";

		echo "</div>";

		break;
	}
	// wizard step 1


	// wizard step 2
	case "create2": {

        if ( $_commercialEntries == 0) { // only private entries
            $iStep=2;
        }
        else { // commercial entries allowed
            $iStep=3;
        }

		echo "<br />";
		echo "<br />";
		echo "<h2>";
        echo JText::_( 'CCMP_STEP' )  . " " . $iStep . " / " . $iSteps ;
		echo "</h2>";

        $flag_commercial = JRequest::getInt( 'flag_commercial', 0);
		$category_id = JRequest::getInt( 'categoryselectbox', 0);

		echo "<div class='cofiEntryForm'>";

		    echo "<form action='' method='post' name='entryform' id='entryform' >";

		    	echo "<table cellspacing='1' cellpadding='0' width='100%' class='noborder'>";

					// contact data
		    		echo "<tr>";
		    			echo "<td class='noborder' style='padding: 10px 5px 0px 5px;' >";
							echo "<h3>" . JText::_( 'CCMP_CONTACT_DATA' ) . "</h3>";
		    			echo "</td>";
		    		echo "</tr>";

					// firstname
					if ( $_use_firstname == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_FIRST_NAME' ) . ":</div> ";

			            			echo "<div class='cofiFirstname'>";
			            				echo "<input type='text' name='firstname' id='firstname' size='50' maxlength='250' value='" . $logUser->getFirstname() . "' >";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_FIRST_NAME_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
					}

					// lastname
					if ( $_use_lastname == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_LAST_NAME' ) . ":</div> ";

			            			echo "<div class='cofiLastname'>";
			            				echo "<input type='text' name='lastname' id='lastname' size='50' maxlength='250' value='" . $logUser->getLastname() . "' >";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_LAST_NAME_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}

					// company
					if ( $_use_company == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_COMPANY' ) . ":</div> ";

			            			echo "<div class='cofiLastname'>";
			            				echo "<input type='text' name='company' id='company' size='50' maxlength='250' value='" . $logUser->getCompany() . "' >";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_COMPANY_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}


					// street
					if ( $_use_street == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_STREET' ) . ":</div> ";

			            			echo "<div class='cofiStreet'>";
			            				echo "<input type='text' name='street' id='street' size='50' maxlength='250' value='" . $logUser->getStreet() . "'>";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_STREET_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}

					// zip
					if ( $_use_zip == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_ZIP' ) . ":</div> ";

			            			echo "<div class='cofiZip'>";
			            				echo "<input type='text' name='zip' id='zip' size='50' maxlength='250' value='" . $logUser->getZipcode() . "' >";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_ZIP_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}

					// city
					if ( $_use_city == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_CITY' ) . ":</div> ";

			            			echo "<div class='cofiCity'>";
			            				echo "<input type='text' name='city' id='city' size='50' maxlength='250' value='" . $logUser->getCity() . "' >";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_CITY_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}

					// state
					if ( $_use_state == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_STATE' ) . ":</div> ";

			            			echo "<div class='cofiState'>";
			            				echo "<input type='text' name='state' id='state' size='50' maxlength='250' value='" . $logUser->getState() . "' >";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_STATE_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}

					// country
					if ( $_use_country == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_COUNTRY' ) . ":</div> ";

			            			echo "<div class='cofiCountry'>";
			            				echo "<input type='text' name='country' id='country' size='50' maxlength='250' value='" . $logUser->getCountry() . "' >";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_COUNTRY_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}

					// phone
					if ( $_use_phone == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_PHONE' ) . ":</div> ";

			            			echo "<div class='cofiCountry'>";
			            				echo "<input type='text' name='phone' id='phone' size='50' maxlength='250' value='" . $logUser->getPhone() . "' >";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_PHONE_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}

					// mobile
					if ( $_use_mobile == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_MOBILE' ) . ":</div> ";

			            			echo "<div class='cofiCountry'>";
			            				echo "<input type='text' name='mobile' id='mobile' size='50' maxlength='250' value='" . $logUser->getMobile() . "' >";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_MOBILE_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}

					// email
					if ( $_use_email == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_EMAIL' ) . ":</div> ";

			            			echo "<div class='cofiCountry'>";
			            				echo "<input type='text' name='email' id='email' size='50' maxlength='250' class='validate-email' value='" . $logUser->getEmail() . "' >";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_EMAIL_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}

					// web
					if ( $_use_web == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_WEB' ) . ":</div> ";

			            			echo "<div class='cofiCountry'>";
			            				echo "<input type='text' name='web' id='web' size='50' maxlength='250' value='" . $logUser->getWebsite() . "' >";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_WEB_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}

					// button
		    		echo "<tr>";
		    			echo "<td class='noborder' style='padding: 5px;' >";

		            		echo "<div class='cofiButton'>";

                                echo "<input type='hidden' name='flag_commercial' value='" . $flag_commercial . "'>";
								echo "<input type='hidden' name='categoryselectbox' value='" . $category_id . "'>";
								echo "<input type='hidden' name='task' value='create3'>";
								echo "<input class='cofiButton' type='submit' name='submit' value='" . JText::_( 'CCMP_CONTINUE' ) . "'>";

								echo " " . JText::_( 'CCMP_OR' ) . " ";
								$menuLinkHome      = JRoute::_( 'index.php?option=com_ccmarketplace');
								echo "<a href='$menuLinkHome'>" . JText::_( 'CCMP_CANCEL' ) . "</a>";

							echo "</div> ";

		    			echo "</td>";
		    		echo "</tr>";

		    	echo "</table>";

		    echo "</form>";


		echo "</div>";

		break;
	}
	// wizard step 2


	// wizard step 3
	case "create3": {

        if ( $_commercialEntries == 0) { // only private entries
            $iStep=3;
        }
        else { // commercial entries allowed
            $iStep=4;
        }

		echo "<br />";
		echo "<br />";
		echo "<h2>";
        echo JText::_( 'CCMP_STEP' )  . " " . $iStep . " / " . $iSteps ;
		echo "</h2>";

        $flag_commercial = JRequest::getInt( 'flag_commercial', 0);

		// get category from step 1
		$category_id = JRequest::getInt( 'categoryselectbox', 0);

		// get contact data from step 2
		$firstname 	= JRequest::getString( 'firstname', '', 'POST');
		$lastname   = JRequest::getString( 'lastname', '', 'POST');
		$company    = JRequest::getString( 'company', '', 'POST');
		$street   	= JRequest::getString( 'street', '', 'POST');
		$zip   		= JRequest::getString( 'zip', '', 'POST');
		$city   	= JRequest::getString( 'city', '', 'POST');
		$state   	= JRequest::getString( 'state', '', 'POST');
		$country   	= JRequest::getString( 'country', '', 'POST');
		$phone 		= JRequest::getString( 'phone', '', 'POST');
		$mobile 	= JRequest::getString( 'mobile', '', 'POST');
		$email 		= JRequest::getString( 'email', '', 'POST');
		$web    	= JRequest::getString( 'web', '', 'POST');


		echo "<div class='cofiEntryForm'>";

		    echo "<form action='' method='post' name='entryform' id='entryform' enctype='multipart/form-data' class='form-validate' onSubmit='return myValidate(this);'>";

		    	echo "<table cellspacing='1' cellpadding='0' width='100%' class='noborder'>";

					// entry data
					echo "<tr>";
						echo "<td class='noborder' style='padding: 10px 5px 0px 5px;' >";
							echo "<h3>" . JText::_( 'CCMP_ENTRY_DATA' ) . "</h3>";
						echo "</td>";
					echo "</tr>";

					// label
					echo "<tr>";
						echo "<td class='noborder' style='padding: 5px;' >";

							echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_LABEL' ) . ":</div> ";

								echo "<div class='cofiType'>";
									echo $cHelper->getLabelSelectBox( 0); // 0 nothing selected
								echo "</div>";

								echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_LABEL_INFO' ) . "</div> ";

						echo "</td>";
					echo "</tr>";

					// headline
					echo "<tr>";
						echo "<td class='noborder' style='padding: 5px;' >";

							echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_HEADLINE' ) . ":</div> ";

								echo "<div class='cofiHeadline'>";
									echo "<input type='text' name='entryHeadline' id='entryHeadline' size='50' maxlength='250' class='required'>";
								echo "</div>";

								echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_HEADLINE_INFO' ) . "</div> ";

						echo "</td>";
					echo "</tr>";

					// text
					echo "<tr>";
						echo "<td class='noborder' align='left' valign='top' style='padding: 5px;' >";

							echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_TEXT' ) . ":</div> ";

							echo "<div class='cofiText'>";
								echo "<textarea name='entryText' cols='80' rows='10' wrap='VIRTUAL' id='entryText' class='required'>";
								echo "</textarea>";
							echo "</div>";

							echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_TEXT_INFO' ) . "</div> ";

						echo "</td>";

					echo "</tr>";

					// condition
					if ( $_use_condition == 1) {
						echo "<tr>";
							echo "<td class='noborder' style='padding: 5px;' >";

								echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_CONDITION' ) . ":</div> ";

					    			echo "<div class='cofiCondition'>";
					    				echo "<input type='text' name='condition' id='condition' size='50' maxlength='250'>";
					    			echo "</div>";

					    			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_CONDITION_INFO' ) . "</div> ";

							echo "</td>";
						echo "</tr>";
					}

					// price
					if ( $_use_price == 1) {
						echo "<tr>";
							echo "<td class='noborder' style='padding: 5px;' >";

								echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_PRICE' ) . ":</div> ";

					    			echo "<div class='cofiPrice'>";
					    				echo "<input type='text' name='price' id='price' size='50' maxlength='250'>";
					    			echo "</div>";

					    			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_PRICE_INFO' ) . "</div> ";

							echo "</td>";
						echo "</tr>";
					}

					if ( $images > 0) {

						// image1
						echo "<tr>";
							echo "<td class='noborder' style='padding: 5px;' >";

								echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_IMAGE' ) . " 1:</div> ";

					    			echo "<div class='cofiImage'>";
										echo "<input type='file' name='image1' id='image1' value='' size='50' maxlength='250' />";
					    			echo "</div>";

					    			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_IMAGE_INFO' ) . "</div> ";

							echo "</td>";
						echo "</tr>";

					}


					if ( $images > 1) {

						// image2
						echo "<tr>";
							echo "<td class='noborder' style='padding: 5px;' >";

								echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_IMAGE' ) . " 2:</div> ";

					    			echo "<div class='cofiImage'>";
										echo "<input type='file' name='image2' id='image2' value='' size='50' maxlength='250' />";
					    			echo "</div>";

					    			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_IMAGE_INFO' ) . "</div> ";

							echo "</td>";
						echo "</tr>";

					}


					if ( $images > 2) {

						// image3
						echo "<tr>";
							echo "<td class='noborder' style='padding: 5px;' >";

								echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_IMAGE' ) . " 3:</div> ";

					    			echo "<div class='cofiImage'>";
										echo "<input type='file' name='image3' id='image3' value='' size='50' maxlength='250' />";
					    			echo "</div>";

					    			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_IMAGE_INFO' ) . "</div> ";

							echo "</td>";
						echo "</tr>";

					}


					if ( $images > 3) {

						// image4
						echo "<tr>";
							echo "<td class='noborder' style='padding: 5px;' >";

								echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_IMAGE' ) . " 4:</div> ";

					    			echo "<div class='cofiImage'>";
										echo "<input type='file' name='image4' id='image4' value='' size='50' maxlength='250' />";
					    			echo "</div>";

					    			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_IMAGE_INFO' ) . "</div> ";

							echo "</td>";
						echo "</tr>";

					}


					if ( $images > 4) {

						// image5
						echo "<tr>";
							echo "<td class='noborder' style='padding: 5px;' >";

								echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_IMAGE' ) . " 5:</div> ";

					    			echo "<div class='cofiImage'>";
										echo "<input type='file' name='image5' id='image5' value='' size='50' maxlength='250' />";
					    			echo "</div>";

					    			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_IMAGE_INFO' ) . "</div> ";

							echo "</td>";
						echo "</tr>";

					}


					if ( $images > 5) {

						// image6
						echo "<tr>";
							echo "<td class='noborder' style='padding: 5px;' >";

								echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_IMAGE' ) . " 6:</div> ";

					    			echo "<div class='cofiImage'>";
										echo "<input type='file' name='image6' id='image6' value='' size='50' maxlength='250' />";
					    			echo "</div>";

					    			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_IMAGE_INFO' ) . "</div> ";

							echo "</td>";
						echo "</tr>";

					}


					if ( $images > 6) {

						// image7
						echo "<tr>";
							echo "<td class='noborder' style='padding: 5px;' >";

								echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_IMAGE' ) . " 7:</div> ";

					    			echo "<div class='cofiImage'>";
										echo "<input type='file' name='image7' id='image7' value='' size='50' maxlength='250' />";
					    			echo "</div>";

					    			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_IMAGE_INFO' ) . "</div> ";

							echo "</td>";
						echo "</tr>";

					}


					if ( $images > 7) {

						// image8
						echo "<tr>";
							echo "<td class='noborder' style='padding: 5px;' >";

								echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_IMAGE' ) . " 8:</div> ";

					    			echo "<div class='cofiImage'>";
										echo "<input type='file' name='image8' id='image8' value='' size='50' maxlength='250' />";
					    			echo "</div>";

					    			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_IMAGE_INFO' ) . "</div> ";

							echo "</td>";
						echo "</tr>";

					}


					if ( $images > 8) {

						// image9
						echo "<tr>";
							echo "<td class='noborder' style='padding: 5px;' >";

								echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_IMAGE' ) . " 9:</div> ";

					    			echo "<div class='cofiImage'>";
										echo "<input type='file' name='image9' id='image9' value='' size='50' maxlength='250' />";
					    			echo "</div>";

					    			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_IMAGE_INFO' ) . "</div> ";

							echo "</td>";
						echo "</tr>";

					}


					if ( $images > 9) {

						// image10
						echo "<tr>";
							echo "<td class='noborder' style='padding: 5px;' >";

								echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_IMAGE' ) . " 10:</div> ";

					    			echo "<div class='cofiImage'>";
										echo "<input type='file' name='image10' id='image10' value='' size='50' maxlength='250' />";
					    			echo "</div>";

					    			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_IMAGE_INFO' ) . "</div> ";

							echo "</td>";
						echo "</tr>";

					}

					// button
					echo "<tr>";
						echo "<td class='noborder' style='padding: 5px;' >";

							echo "<div class='cofiButton'>";

								switch ( $this->task) {
									case "edit": {
										echo "<input type='hidden' name='dbmode' value='update'>";
										break;
									}
									default: {
										echo "<input type='hidden' name='dbmode' value='insert'>";
										break;
									}
								}

                                echo "<input type='hidden' name='flag_commercial' value='" . $flag_commercial . "'>";
								echo "<input type='hidden' name='categoryselectbox' value='" . $category_id . "'>";

								echo "<input type='hidden' name='firstname' value='" . $firstname . "'>";
								echo "<input type='hidden' name='lastname' value='" . $lastname . "'>";
								echo "<input type='hidden' name='company' value='" . $company . "'>";

								echo "<input type='hidden' name='street' value='" . $street . "'>";
								echo "<input type='hidden' name='zip' value='" . $zip . "'>";
								echo "<input type='hidden' name='city' value='" . $city . "'>";
								echo "<input type='hidden' name='state' value='" . $state . "'>";
								echo "<input type='hidden' name='country' value='" . $country . "'>";

								echo "<input type='hidden' name='phone' value='" . $phone . "'>";
								echo "<input type='hidden' name='mobile' value='" . $mobile . "'>";
								echo "<input type='hidden' name='email' value='" . $email . "'>";
								echo "<input type='hidden' name='web' value='" . $web . "'>";

								echo "<input type='hidden' name='task' value='save'>";
								echo "<input class='cofiButton' type='submit' name='submit' value='" . JText::_( 'CCMP_SAVE' ) . "'>";

								echo " " . JText::_( 'CCMP_OR' ) . " ";
								$menuLinkHome      = JRoute::_( 'index.php?option=com_ccmarketplace');
								echo "<a href='$menuLinkHome'>" . JText::_( 'CCMP_CANCEL' ) . "</a>";

							echo "</div> ";

						echo "</td>";
					echo "</tr>";



		    	echo "</table>";

		    echo "</form>";


		echo "</div>";

		break;
	}
	// wizard step 3


	case "edit": {

		if ( $logUser->isModerator()) {
			// cool, do nothing for now
		}
		else {
			// check if this is the owner of this entry
			if ( $this->user_id != $user->id) {
				// redirect	link
				$redirectLink = JRoute::_( "index.php?option=com_ccmarketplace&view=index");

				// if user is not the owner, kick him back to index page
				$app->redirect( $redirectLink, JText::_( 'CCMP_HACKING_ATTEMPT_OWNER' ), "message");
			}
		}


		echo "<div class='cofiEntryForm'>";

		    echo "<form action='' method='post' name='entryform' id='entryform' enctype='multipart/form-data' class='form-validate' onSubmit='return myValidate(this);' >";

		    	echo "<table cellspacing='1' cellpadding='0' width='100%' class='noborder'>";


					// contact data
		    		echo "<tr>";
		    			echo "<td class='noborder' style='padding: 50px 5px 0px 5px;' >";
							echo "<h3>" . JText::_( 'CCMP_CONTACT_DATA' ) . "</h3>";
		    			echo "</td>";
		    		echo "</tr>";


					// firstname
					if ( $_use_firstname == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_FIRST_NAME' ) . ":</div> ";

			            			echo "<div class='cofiFirstname'>";
			            				echo "<input type='text' name='firstname' id='firstname' size='50' maxlength='250' value='" . $this->firstname . "' >";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_FIRST_NAME_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}


					// lastname
					if ( $_use_lastname == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_LAST_NAME' ) . ":</div> ";

			            			echo "<div class='cofiLastname'>";
			            				echo "<input type='text' name='lastname' id='lastname' size='50' maxlength='250' value='" . $this->lastname . "' >";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_LAST_NAME_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}


					// company
					if ( $_use_company == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_COMPANY' ) . ":</div> ";

			            			echo "<div class='cofiLastname'>";
			            				echo "<input type='text' name='company' id='company' size='50' maxlength='250' value='" . $this->company . "' >";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_COMPANY_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}


					// street
					if ( $_use_street == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_STREET' ) . ":</div> ";

			            			echo "<div class='cofiStreet'>";
			            				echo "<input type='text' name='street' id='street' size='50' maxlength='250' value='" . $this->street . "' >";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_STREET_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}


					// zip
					if ( $_use_zip == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_ZIP' ) . ":</div> ";

			            			echo "<div class='cofiZip'>";
			            				echo "<input type='text' name='zip' id='zip' size='50' maxlength='250' value='" . $this->zip . "' >";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_ZIP_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}


					// city
					if ( $_use_city == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_CITY' ) . ":</div> ";

			            			echo "<div class='cofiCity'>";
			            				echo "<input type='text' name='city' id='city' size='50' maxlength='250' value='" . $this->city . "' >";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_CITY_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}


					// state
					if ( $_use_state == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_STATE' ) . ":</div> ";

			            			echo "<div class='cofiState'>";
			            				echo "<input type='text' name='state' id='state' size='50' maxlength='250' value='" . $this->entryState . "' >";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_STATE_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}


					// country
					if ( $_use_country == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_COUNTRY' ) . ":</div> ";

			            			echo "<div class='cofiCountry'>";
			            				echo "<input type='text' name='country' id='country' size='50' maxlength='250' value='" . $this->country . "' >";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_COUNTRY_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}


					// phone
					if ( $_use_phone == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_PHONE' ) . ":</div> ";

			            			echo "<div class='cofiCountry'>";
			            				echo "<input type='text' name='phone' id='phone' size='50' maxlength='250' value='" . $this->phone . "' >";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_PHONE_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}


					// mobile
					if ( $_use_mobile == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_MOBILE' ) . ":</div> ";

			            			echo "<div class='cofiCountry'>";
			            				echo "<input type='text' name='mobile' id='mobile' size='50' maxlength='250' value='" . $this->mobile . "' >";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_MOBILE_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}


					// email
					if ( $_use_email == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_EMAIL' ) . ":</div> ";

			            			echo "<div class='cofiCountry'>";
			            				echo "<input type='text' name='email' id='email' size='50' maxlength='250' value='" . $this->email . "' class='validate-email' >";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_EMAIL_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}


					// web
					if ( $_use_web == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_WEB' ) . ":</div> ";

			            			echo "<div class='cofiCountry'>";
			            				echo "<input type='text' name='web' id='web' size='50' maxlength='250' value='" . $this->web . "' >";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_WEB_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}




					// entry data
		    		echo "<tr>";
		    			echo "<td class='noborder' style='padding: 50px 5px 0px 5px;' >";
							echo "<h3>" . JText::_( 'CCMP_ENTRY_DATA' ) . "</h3>";
		    			echo "</td>";
		    		echo "</tr>";



					// Category select box
		    		echo "<tr>";
		    			echo "<td class='noborder' style='padding: 5px;' >";

		    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_CATEGORY' ) . ":</div> ";

		            			echo "<div class='cofiCategory'>";
									echo $cHelper->getCategorySelectBox( $this->category_id);
		            			echo "</div>";

		            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_CATEGORY_INFO' ) . "</div> ";

		    			echo "</td>";
		    		echo "</tr>";



					// label
		    		echo "<tr>";
		    			echo "<td class='noborder' style='padding: 5px;' >";

		    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_LABEL' ) . ":</div> ";

		            			echo "<div class='cofiType'>";
									echo $cHelper->getLabelSelectBox( $this->label_id);
		            			echo "</div>";

		            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_LABEL_INFO' ) . "</div> ";

		    			echo "</td>";
		    		echo "</tr>";



					// headline
		    		echo "<tr>";
		    			echo "<td class='noborder' style='padding: 5px;' >";

		    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_HEADLINE' ) . ":</div> ";

		            			echo "<div class='cofiHeadline'>";
		            				echo "<input type='text' name='entryHeadline' id='entryHeadline' size='50' maxlength='250' value='" . $this->headline . "' class='required' >";
		            			echo "</div>";

		            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_HEADLINE_INFO' ) . "</div> ";

		    			echo "</td>";
		    		echo "</tr>";


					// text
		    		echo "<tr>";
		    			echo "<td class='noborder' align='left' valign='top' style='padding: 5px;' >";

		    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_TEXT' ) . ":</div> ";

		   					echo "<div class='cofiText'>";
		   						echo "<textarea name='entryText' cols='80' rows='10' wrap='VIRTUAL' id='entryText' class='required'>";
									if ( $this->task == "edit") {
		   								echo $this->text;
									}
		    					echo "</textarea>";
		    				echo "</div>";

		            		echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_TEXT_INFO' ) . "</div> ";

		    			echo "</td>";

		    		echo "</tr>";


					// condition
					if ( $_use_condition == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_CONDITION' ) . ":</div> ";

			            			echo "<div class='cofiCondition'>";
			            				echo "<input type='text' name='condition' id='condition' size='50' maxlength='250' value='" . $this->entryCondition . "' >";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_CONDITION_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
					}


					// price
					if ( $_use_price == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_PRICE' ) . ":</div> ";

			            			echo "<div class='cofiPrice'>";
			            				echo "<input type='text' name='price' id='price' size='50' maxlength='250' value='" . $this->price . "' >";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_PRICE_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}



					if ( $images > 0) {

						// image1
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_IMAGE' ) . " 1:</div> ";

							    	if ( $this->image1 != "") {
			   							echo "<div>";
								        	echo "<img src='" . $_root . "/images/marketplace/entries/" . $this->id . "/small/" . $this->image1 . "' alt='$this->headline' align='top' class='cofiEntryContentImage' style='margin-left: 0px;' />";

				        				echo "<input type='checkbox' name='cb_image1' value='delete'> " . JText::_( 'CCMP_DELETE' );

			   							echo "</div>";
							    	}

			            			echo "<div class='cofiImage'>";
										echo "<input type='file' name='image1' id='image1' value='' size='50' maxlength='250' />";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_IMAGE_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";

		    		}


					if ( $images > 1) {

						// image2
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_IMAGE' ) . " 2:</div> ";

							    	if ( $this->image2 != "") {
			   							echo "<div>";
								        	echo "<img src='" . $_root . "/images/marketplace/entries/" . $this->id . "/small/" . $this->image2 . "' alt='$this->headline' align='top' class='cofiEntryContentImage' style='margin-left: 0px;' />";

				        				echo "<input type='checkbox' name='cb_image2' value='delete'> " . JText::_( 'CCMP_DELETE' );

			   							echo "</div>";
							    	}

			            			echo "<div class='cofiImage'>";
										echo "<input type='file' name='image2' id='image2' value='' size='50' maxlength='250' />";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_IMAGE_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";

		    		}


					if ( $images > 2) {

						// image3
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_IMAGE' ) . " 3:</div> ";

							    	if ( $this->image3 != "") {
			   							echo "<div>";
								        	echo "<img src='" . $_root . "/images/marketplace/entries/" . $this->id . "/small/" . $this->image3 . "' alt='$this->headline' align='top' class='cofiEntryContentImage' style='margin-left: 0px;' />";

				        				echo "<input type='checkbox' name='cb_image3' value='delete'> " . JText::_( 'CCMP_DELETE' );

			   							echo "</div>";
							    	}

			            			echo "<div class='cofiImage'>";
										echo "<input type='file' name='image3' id='image3' value='' size='50' maxlength='250' />";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_IMAGE_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";

					}


					if ( $images > 3) {

						// image4
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_IMAGE' ) . " 4:</div> ";

							    	if ( $this->image4 != "") {
			   							echo "<div>";
								        	echo "<img src='" . $_root . "/images/marketplace/entries/" . $this->id . "/small/" . $this->image4 . "' alt='$this->headline' align='top' class='cofiEntryContentImage' style='margin-left: 0px;' />";

				        				echo "<input type='checkbox' name='cb_image4' value='delete'> " . JText::_( 'CCMP_DELETE' );

			   							echo "</div>";
							    	}

			            			echo "<div class='cofiImage'>";
										echo "<input type='file' name='image4' id='image4' value='' size='50' maxlength='250' />";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_IMAGE_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";

					}


					if ( $images > 4) {

						// image5
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_IMAGE' ) . " 5:</div> ";

							    	if ( $this->image5 != "") {
			   							echo "<div>";
								        	echo "<img src='" . $_root . "/images/marketplace/entries/" . $this->id . "/small/" . $this->image5 . "' alt='$this->headline' align='top' class='cofiEntryContentImage' style='margin-left: 0px;' />";

				        				echo "<input type='checkbox' name='cb_image5' value='delete'> " . JText::_( 'CCMP_DELETE' );

			   							echo "</div>";
							    	}

			            			echo "<div class='cofiImage'>";
										echo "<input type='file' name='image5' id='image5' value='' size='50' maxlength='250' />";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_IMAGE_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";

					}


					if ( $images > 5) {

						// image6
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_IMAGE' ) . " 6:</div> ";

							    	if ( $this->image6 != "") {
			   							echo "<div>";
								        	echo "<img src='" . $_root . "/images/marketplace/entries/" . $this->id . "/small/" . $this->image6 . "' alt='$this->headline' align='top' class='cofiEntryContentImage' style='margin-left: 0px;' />";

				        				echo "<input type='checkbox' name='cb_image6' value='delete'> " . JText::_( 'CCMP_DELETE' );

			   							echo "</div>";
							    	}

			            			echo "<div class='cofiImage'>";
										echo "<input type='file' name='image6' id='image6' value='' size='50' maxlength='250' />";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_IMAGE_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";

					}


					if ( $images > 6) {

						// image7
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_IMAGE' ) . " 7:</div> ";

							    	if ( $this->image7 != "") {
			   							echo "<div>";
								        	echo "<img src='" . $_root . "/images/marketplace/entries/" . $this->id . "/small/" . $this->image7 . "' alt='$this->headline' align='top' class='cofiEntryContentImage' style='margin-left: 0px;' />";

				        				echo "<input type='checkbox' name='cb_image7' value='delete'> " . JText::_( 'CCMP_DELETE' );

			   							echo "</div>";
							    	}

			            			echo "<div class='cofiImage'>";
										echo "<input type='file' name='image7' id='image7' value='' size='50' maxlength='250' />";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_IMAGE_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";

					}


					if ( $images > 7) {

						// image8
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_IMAGE' ) . " 8:</div> ";

							    	if ( $this->image8 != "") {
			   							echo "<div>";
								        	echo "<img src='" . $_root . "/images/marketplace/entries/" . $this->id . "/small/" . $this->image8 . "' alt='$this->headline' align='top' class='cofiEntryContentImage' style='margin-left: 0px;' />";

				        				echo "<input type='checkbox' name='cb_image8' value='delete'> " . JText::_( 'CCMP_DELETE' );

			   							echo "</div>";
							    	}

			            			echo "<div class='cofiImage'>";
										echo "<input type='file' name='image8' id='image8' value='' size='50' maxlength='250' />";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_IMAGE_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";

					}


					if ( $images > 8) {

						// image9
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_IMAGE' ) . " 9:</div> ";

							    	if ( $this->image9 != "") {
			   							echo "<div>";
								        	echo "<img src='" . $_root . "/images/marketplace/entries/" . $this->id . "/small/" . $this->image9 . "' alt='$this->headline' align='top' class='cofiEntryContentImage' style='margin-left: 0px;' />";

				        				echo "<input type='checkbox' name='cb_image9' value='delete'> " . JText::_( 'CCMP_DELETE' );

			   							echo "</div>";
							    	}

			            			echo "<div class='cofiImage'>";
										echo "<input type='file' name='image9' id='image9' value='' size='50' maxlength='250' />";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_IMAGE_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";

					}


					if ( $images > 9) {

						// image10
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_IMAGE' ) . " 10:</div> ";

							    	if ( $this->image10 != "") {
			   							echo "<div>";
								        	echo "<img src='" . $_root . "/images/marketplace/entries/" . $this->id . "/small/" . $this->image10 . "' alt='$this->headline' align='top' class='cofiEntryContentImage' style='margin-left: 0px;' />";

				        				echo "<input type='checkbox' name='cb_image10' value='delete'> " . JText::_( 'CCMP_DELETE' );

			   							echo "</div>";
							    	}

			            			echo "<div class='cofiImage'>";
										echo "<input type='file' name='image10' id='image10' value='' size='50' maxlength='250' />";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_IMAGE_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";

					}

					// button
		    		echo "<tr>";
		    			echo "<td class='noborder' style='padding: 5px;' >";

		            		echo "<div class='cofiButton'>";

		    					switch ( $this->task) {
		    						case "edit": {
										echo "<input type='hidden' name='dbmode' value='update'>";
										break;
									}
									default: {
										echo "<input type='hidden' name='dbmode' value='insert'>";
										break;
									}
								}
								echo "<input type='hidden' name='task' value='save'>";
								echo "<input type='hidden' name='entry' value='" . $this->id . "'>";
								echo "<input class='cofiButton' type='submit' name='submit' value='" . JText::_( 'CCMP_UPDATE' ) . "'>";

							echo "</div> ";

		    			echo "</td>";
		    		echo "</tr>";

		    	echo "</table>";

		    echo "</form>";


		echo "</div>";

		break;

	}


	case "new": {

		echo JText::_( 'CCMP_MARKETPLACE_RULES' );

		echo "<div class='cofiEntryForm'>";

		    echo "<form action='' method='post' name='entryform' id='entryform' enctype='multipart/form-data' class='form-validate' onSubmit='return myValidate(this);'>";

		    	echo "<table class='noborder' cellspacing='1' cellpadding='0' width='100%'>";

					// contact data
		    		echo "<tr>";
		    			echo "<td class='noborder' style='padding: 50px 5px 0px 5px;' >";
							echo "<h3>" . JText::_( 'CCMP_CONTACT_DATA' ) . "</h3>";
		    			echo "</td>";
		    		echo "</tr>";


					// firstname
					if ( $_use_firstname == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_FIRST_NAME' ) . ":</div> ";

			            			echo "<div class='cofiFirstname'>";
			            				echo "<input type='text' name='firstname' id='firstname' size='50' maxlength='250' >";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_FIRST_NAME_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
					}


					// lastname
					if ( $_use_lastname == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_LAST_NAME' ) . ":</div> ";

			            			echo "<div class='cofiLastname'>";
			            				echo "<input type='text' name='lastname' id='lastname' size='50' maxlength='250' >";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_LAST_NAME_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}


					// company
					if ( $_use_company == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_COMPANY' ) . ":</div> ";

			            			echo "<div class='cofiLastname'>";
			            				echo "<input type='text' name='company' id='company' size='50' maxlength='250' >";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_COMPANY_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}



					// street
					if ( $_use_street == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_STREET' ) . ":</div> ";

			            			echo "<div class='cofiStreet'>";
			            				echo "<input type='text' name='street' id='street' size='50' maxlength='250'>";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_STREET_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}


					// zip
					if ( $_use_zip == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_ZIP' ) . ":</div> ";

			            			echo "<div class='cofiZip'>";
			            				echo "<input type='text' name='zip' id='zip' size='50' maxlength='250'>";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_ZIP_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}


					// city
					if ( $_use_city == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_CITY' ) . ":</div> ";

			            			echo "<div class='cofiCity'>";
			            				echo "<input type='text' name='city' id='city' size='50' maxlength='250'>";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_CITY_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}


					// state
					if ( $_use_state == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_STATE' ) . ":</div> ";

			            			echo "<div class='cofiState'>";
			            				echo "<input type='text' name='state' id='state' size='50' maxlength='250'>";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_STATE_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}


					// country
					if ( $_use_country == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_COUNTRY' ) . ":</div> ";

			            			echo "<div class='cofiCountry'>";
			            				echo "<input type='text' name='country' id='country' size='50' maxlength='250'>";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_COUNTRY_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}



					// phone
					if ( $_use_phone == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_PHONE' ) . ":</div> ";

			            			echo "<div class='cofiCountry'>";
			            				echo "<input type='text' name='phone' id='phone' size='50' maxlength='250'>";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_PHONE_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}


					// mobile
					if ( $_use_mobile == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_MOBILE' ) . ":</div> ";

			            			echo "<div class='cofiCountry'>";
			            				echo "<input type='text' name='mobile' id='mobile' size='50' maxlength='250'>";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_MOBILE_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}


					// email
					if ( $_use_email == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_EMAIL' ) . ":</div> ";

			            			echo "<div class='cofiCountry'>";
			            				echo "<input type='text' name='email' id='email' size='50' maxlength='250' class='validate-email' >";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_EMAIL_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}


					// web
					if ( $_use_web == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_WEB' ) . ":</div> ";

			            			echo "<div class='cofiCountry'>";
			            				echo "<input type='text' name='web' id='web' size='50' maxlength='250'>";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_WEB_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}


					// entry data
		    		echo "<tr>";
		    			echo "<td class='noborder' style='padding: 50px 5px 0px 5px;' >";
							echo "<h3>" . JText::_( 'CCMP_ENTRY_DATA' ) . "</h3>";
		    			echo "</td>";
		    		echo "</tr>";


					// Category select box
		    		echo "<tr>";
		    			echo "<td class='noborder' style='padding: 5px;' >";

		    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_CATEGORY' ) . ":</div> ";

		            			echo "<div class='cofiCategory'>";
									echo $cHelper->getCategorySelectBox( 0); // 0 nothing selected
		            			echo "</div>";

		            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_CATEGORY_INFO' ) . "</div> ";

		    			echo "</td>";
		    		echo "</tr>";


					// label
		    		echo "<tr>";
		    			echo "<td class='noborder' style='padding: 5px;' >";

		    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_LABEL' ) . ":</div> ";

		            			echo "<div class='cofiType'>";
									echo $cHelper->getLabelSelectBox( 0); // 0 nothing selected
		            			echo "</div>";

		            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_LABEL_INFO' ) . "</div> ";

		    			echo "</td>";
		    		echo "</tr>";


					// headline
		    		echo "<tr>";
		    			echo "<td class='noborder' style='padding: 5px;' >";

		    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_HEADLINE' ) . ":</div> ";

		            			echo "<div class='cofiHeadline'>";
		            				echo "<input type='text' name='entryHeadline' id='entryHeadline' size='50' maxlength='250' class='required'>";
		            			echo "</div>";

		            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_HEADLINE_INFO' ) . "</div> ";

		    			echo "</td>";
		    		echo "</tr>";


					// text
		    		echo "<tr>";
		    			echo "<td class='noborder' align='left' valign='top' style='padding: 5px;' >";

		    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_TEXT' ) . ":</div> ";

		   					echo "<div class='cofiText'>";
		   						echo "<textarea name='entryText' cols='80' rows='10' wrap='VIRTUAL' id='entryText' class='required'>";
		    					echo "</textarea>";
		    				echo "</div>";

		            		echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_TEXT_INFO' ) . "</div> ";

		    			echo "</td>";

		    		echo "</tr>";


					// condition
					if ( $_use_condition == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_CONDITION' ) . ":</div> ";

			            			echo "<div class='cofiCondition'>";
			            				echo "<input type='text' name='condition' id='condition' size='50' maxlength='250'>";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_CONDITION_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}


					// price
					if ( $_use_price == 1) {
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_PRICE' ) . ":</div> ";

			            			echo "<div class='cofiPrice'>";
			            				echo "<input type='text' name='price' id='price' size='50' maxlength='250'>";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_PRICE_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";
		    		}



					if ( $images > 0) {

						// image1
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_IMAGE' ) . " 1:</div> ";

			            			echo "<div class='cofiImage'>";
										echo "<input type='file' name='image1' id='image1' value='' size='50' maxlength='250' />";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_IMAGE_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";

		    		}


					if ( $images > 1) {

						// image2
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_IMAGE' ) . " 2:</div> ";

			            			echo "<div class='cofiImage'>";
										echo "<input type='file' name='image2' id='image2' value='' size='50' maxlength='250' />";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_IMAGE_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";

		    		}


					if ( $images > 2) {

						// image3
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_IMAGE' ) . " 3:</div> ";

			            			echo "<div class='cofiImage'>";
										echo "<input type='file' name='image3' id='image3' value='' size='50' maxlength='250' />";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_IMAGE_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";

					}


					if ( $images > 3) {

						// image4
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_IMAGE' ) . " 4:</div> ";

			            			echo "<div class='cofiImage'>";
										echo "<input type='file' name='image4' id='image4' value='' size='50' maxlength='250' />";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_IMAGE_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";

					}


					if ( $images > 4) {

						// image5
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_IMAGE' ) . " 5:</div> ";

			            			echo "<div class='cofiImage'>";
										echo "<input type='file' name='image5' id='image5' value='' size='50' maxlength='250' />";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_IMAGE_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";

					}


					if ( $images > 5) {

						// image6
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_IMAGE' ) . " 6:</div> ";

			            			echo "<div class='cofiImage'>";
										echo "<input type='file' name='image6' id='image6' value='' size='50' maxlength='250' />";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_IMAGE_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";

					}


					if ( $images > 6) {

						// image7
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_IMAGE' ) . " 7:</div> ";

			            			echo "<div class='cofiImage'>";
										echo "<input type='file' name='image7' id='image7' value='' size='50' maxlength='250' />";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_IMAGE_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";

					}


					if ( $images > 7) {

						// image8
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_IMAGE' ) . " 8:</div> ";

			            			echo "<div class='cofiImage'>";
										echo "<input type='file' name='image8' id='image8' value='' size='50' maxlength='250' />";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_IMAGE_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";

					}


					if ( $images > 8) {

						// image9
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_IMAGE' ) . " 9:</div> ";

			            			echo "<div class='cofiImage'>";
										echo "<input type='file' name='image9' id='image9' value='' size='50' maxlength='250' />";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_IMAGE_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";

					}


					if ( $images > 9) {

						// image10
			    		echo "<tr>";
			    			echo "<td class='noborder' style='padding: 5px;' >";

			    				echo "<div class='cofiEntryHeader'>" . JText::_( 'CCMP_IMAGE' ) . " 10:</div> ";

			            			echo "<div class='cofiImage'>";
										echo "<input type='file' name='image10' id='image10' value='' size='50' maxlength='250' />";
			            			echo "</div>";

			            			echo "<div class='cofiEntryFooter'>" . JText::_( 'CCMP_IMAGE_INFO' ) . "</div> ";

			    			echo "</td>";
			    		echo "</tr>";

					}


					// button
		    		echo "<tr>";
		    			echo "<td class='noborder' style='padding: 5px;' >";

		            		echo "<div class='cofiButton'>";

		    					switch ( $this->task) {
		    						case "edit": {
										echo "<input type='hidden' name='dbmode' value='update'>";
										break;
									}
									default: {
										echo "<input type='hidden' name='dbmode' value='insert'>";
										break;
									}
								}
								echo "<input type='hidden' name='task' value='save'>";
								echo "<input class='cofiButton' type='submit' name='submit' value='" . JText::_( 'CCMP_SAVE' ) . "'>";

							echo "</div> ";

		    			echo "</td>";
		    		echo "</tr>";

		    	echo "</table>";

		    echo "</form>";


		echo "</div>";

		break;
	}


	default: {  // show entry

		echo "<div class='cofiEntryContent'>";

			echo "<div class='cofiEntryContentHeadline'>";

				echo "<div class='cofiEntryContentHeadline1'>";

                    echo "<h3 style='margin: 0px 0px 0px 0px;'>";
					    echo $this->headline;
                    echo "</h3>";

				echo "</div>";

				echo "<div class='cofiEntryContentHeadline2' style='text-align: right;'>";

                    $_username = $this->entryUsername;

                    if ( $_useDiscussionsAvatars == 1) {
                        $_avatar   = $cHelper->getAvatarFromDiscussionsById( $this->user_id);
                    }

                    echo "<table cellspacing='0' cellpadding='0' border='0' class='noborder'>";
                        echo "<tr>";

                            if ( $_useDiscussionsAvatars == 1) {

                                echo "<td width='32' align='left' class='noborder'>";

                                    echo "<div class='cofiAvatarBox'>";
                                        if ( $_avatar == "") { // display default avatar
                                            echo "<img src='" . $_root . "components/com_discussions/assets/users/user.png' width='32px' height='32px' class='cofiCategoryDefaultAvatar' alt='$_username' title='$_username' />";
                                        }
                                        else { // display uploaded avatar
                                            echo "<img src='" . $_root . "images/discussions/users/".$this->user_id."/small/".$_avatar."' width='32px' height='32px' class='cofiCategoryAvatar' alt='$_username' title='$_username' />";
                                        }
                                    echo "</div>";

                                echo "</td>";

                            }

                            if ( $_useDiscussionsAvatars == 1) {
                                echo "<td align='left' valign='center' class='noborder' style='padding-left: 5px;'>";
                            }
                            else {
                                echo "<td align='left' valign='center' class='noborder' style='padding-left: 5px;'>";
                            }

                                echo $this->dateCreated;

                                echo "<br />";

                                echo JText::_( 'CCMP_BY' ) . "&nbsp;";
                                echo "<b>";
                                    echo $_username;
                                echo "</b>";

                            echo "</td>";
                        echo "</tr>";
                    echo "</table>";

				echo "</div>";

				echo "<div style='clear:left;'></div>";

			echo "</div>";



			echo "<div class='cofiEntryContentText'>";


				echo "<div class='cofiEntryContentText1'>";



                    echo "<div class='cofiEntryInfoRow'>";

                        echo "<div class='cofiEntryUsername'>";
                            echo $this->entryUsername;
                        echo "</div>";

                        echo "<div class='cofiEntryLabel'>";
                            echo $this->label;
                        echo "</div>";

                        if ( $_commercialEntries == 1) {

                            echo "<div class='cofiEntryPrivateCommercial'>";
                            if ( $this->flag_commercial == 1) {
                                echo JText::_( 'CCMP_COMMERCIAL' );
                            }
                            else {
                                echo JText::_( 'CCMP_PRIVATE' );
                            }
                            echo "</div>";

                        }

                    echo "</div>";
                    echo "<br style='clear:left;'>";


					echo nl2br($this->text);

					echo "<br />";
					echo "<br />";

					// condition
					if ( $_use_condition == 1) {
						echo "<br />";
						echo JText::_( 'CCMP_CONDITION' ) . ": ";
						echo $this->entryCondition;
					}

					// price
					if ( $_use_price == 1) {
						echo "<br />";
						echo JText::_( 'CCMP_PRICE' ) . ": ";
						echo $this->price;
					}


				echo "</div>";

				echo "<div class='cofiEntryContentText2'>";

					// prepare linktag for images
					$_titleprefix = "";
					switch ( $_imagesDisplayMode) { // set rel and target

						case 1: { // Slimbox
							$_linktag = " rel='lightbox-" . $this->id . "' ";
							break;
						}

						case 2: { // RokBox
							$_linktag = " rel='rokbox (" . $this->id . ")' ";
							$_titleprefix = $this->headline . " :: ";
							break;
						}

						default: { // Set to Browser display by default
							$_linktag = " target='_blank' ";
							break;
						}

					}


					if ( $this->image1 == "") {  // show default image
						echo "<img src='". $_root ."/components/com_ccmarketplace/assets/entries/default.png' class='cofiEntryContentImage' />";
					}
					else {
						echo "<a href='" . $_root . "images/ccmarketplace/entries/" . $this->id . "/large/" . $this->image1 . "' " . $_linktag . " title='".$_titleprefix.$this->headline . " 1' >";
						echo "<img src='" . $_root . "images/ccmarketplace/entries/" . $this->id . "/small/" . $this->image1 . "' class='cofiEntryContentImage' />";
						echo "</a>";
					}


					if ( $this->image2 != "") {
						echo "<a href='" . $_root . "images/ccmarketplace/entries/" . $this->id . "/large/" . $this->image2 . "' " . $_linktag . " title='".$_titleprefix.$this->headline . " 2' >";
						echo "<img src='" . $_root . "images/ccmarketplace/entries/" . $this->id . "/small/" . $this->image2 . "' class='cofiEntryContentImage' />";
						echo "</a>";
					}

					if ( $this->image3 != "") {
						echo "<a href='" . $_root . "images/ccmarketplace/entries/" . $this->id . "/large/" . $this->image3 . "' " . $_linktag . " title='".$_titleprefix.$this->headline . " 3' >";
						echo "<img src='" . $_root . "images/ccmarketplace/entries/" . $this->id . "/small/" . $this->image3 . "' class='cofiEntryContentImage' />";
						echo "</a>";
					}

					if ( $this->image4 != "") {
						echo "<a href='" . $_root . "images/ccmarketplace/entries/" . $this->id . "/large/" . $this->image4 . "' " . $_linktag . " title='".$_titleprefix.$this->headline . " 4' >";
						echo "<img src='" . $_root . "images/ccmarketplace/entries/" . $this->id . "/small/" . $this->image4 . "' class='cofiEntryContentImage' />";
						echo "</a>";
					}

					if ( $this->image5 != "") {
						echo "<a href='" . $_root . "images/ccmarketplace/entries/" . $this->id . "/large/" . $this->image5 . "' " . $_linktag . " title='".$_titleprefix.$this->headline . " 5' >";
						echo "<img src='" . $_root . "images/ccmarketplace/entries/" . $this->id . "/small/" . $this->image5 . "' class='cofiEntryContentImage' />";
						echo "</a>";
					}


					if ( $this->image6 != "") {
						echo "<a href='" . $_root . "images/ccmarketplace/entries/" . $this->id . "/large/" . $this->image6 . "' " . $_linktag . " title='".$_titleprefix.$this->headline . " 6' >";
						echo "<img src='" . $_root . "images/ccmarketplace/entries/" . $this->id . "/small/" . $this->image6 . "' class='cofiEntryContentImage' />";
						echo "</a>";
					}

					if ( $this->image7 != "") {
						echo "<a href='" . $_root . "images/ccmarketplace/entries/" . $this->id . "/large/" . $this->image7 . "' " . $_linktag . " title='".$_titleprefix.$this->headline . " 7' >";
						echo "<img src='" . $_root ."images/ccmarketplace/entries/" . $this->id . "/small/" . $this->image7 . "' class='cofiEntryContentImage' />";
						echo "</a>";
					}

					if ( $this->image8 != "") {
						echo "<a href='" . $_root . "images/ccmarketplace/entries/" . $this->id . "/large/" . $this->image8 . "' " . $_linktag . " title='".$_titleprefix.$this->headline . " 8' >";
						echo "<img src='" . $_root ."images/ccmarketplace/entries/" . $this->id . "/small/" . $this->image8 . "' class='cofiEntryContentImage' />";
						echo "</a>";
					}

					if ( $this->image9 != "") {
						echo "<a href='" . $_root . "images/ccmarketplace/entries/" . $this->id . "/large/" . $this->image9 . "' " . $_linktag . " title='".$_titleprefix.$this->headline . " 9' >";
						echo "<img src='" . $_root . "images/ccmarketplace/entries/" . $this->id . "/small/" . $this->image9 . "' class='cofiEntryContentImage' />";
						echo "</a>";
					}

					if ( $this->image10 != "") {
						echo "<a href='" . $_root . "images/ccmarketplace/entries/" . $this->id . "/large/" . $this->image10 . "' " . $_linktag . " title='".$_titleprefix.$this->headline . " 10' >";
						echo "<img src='" . $_root . "images/ccmarketplace/entries/" . $this->id . "/small/" . $this->image10 . "' class='cofiEntryContentImage' />";
						echo "</a>";
					}


				echo "</div>";

				echo "<div style='clear:left;'></div>";



			echo "</div>";


			echo "<div class='cofiEntryContentContact'>";

				if ( $user->guest && $_showContactDetailsToPublic == 0) { // user is not logged in

					echo JText::_( 'CCMP_LOGIN_FOR_CONTACT_DETAILS_INFO' );

				}
				else { // user is logged in

					echo "<h3>";
					echo JText::_( 'CCMP_CONTACT_DATA' );
					echo "</h3>";


		            echo "<table class='noborder'>";

                        if ( $_useDiscussionsMessages == 1) { // show private message link (Discussions Messages)

                            if ( !$user->guest && $_useDiscussionsMessages == "1" && $this->entryUsername != "-") {

                                    echo "<tr>";

                                        echo "<td class='noborder'>";
                                            echo "<a href='" . $this->linkDiscussionsMessages . "' title='" . JText::_( 'CCMP_MESSAGE_TO' ) . " " . $this->entryUsername . "' >";
                                            echo "<img src='" . $_root . "/components/com_ccmarketplace/assets/icons/pn_16.png' style='margin: 10px 5px 10px 5px;' />";
                                            echo "</a>";
                                        echo "</td>";

                                        echo "<td class='noborder'>";
                                            echo "<a href='" . $this->linkDiscussionsMessages . "' title='" . JText::_( 'CCMP_MESSAGE_TO' ) . " " . $this->entryUsername . "' >";
                                            echo JText::_( 'CCMP_MESSAGE_TO' ) . " " . $this->entryUsername;
                                            echo "</a>";
                                        echo "</td>";

                                    echo "</tr>";

                            }

                        }
                        else { // check if we use Primezilla


                            if ( $_usePrimezilla == 1) { // show private message link (Primezilla)

                                if ( !$user->guest && $_usePrimezilla == "1" && $this->entryUsername != "-") {


                                        echo "<tr>";

                                            echo "<td class='noborder'>";
                                                echo "<a href='" . $this->linkPrimezilla . "' title='" . JText::_( 'CCMP_MESSAGE_TO' ) . " " . $this->entryUsername . "' >";
                                                echo "<img src='" . $_root . "/components/com_ccmarketplace/assets/icons/pn_16.png' style='margin: 10px 5px 10px 5px;' />";
                                                echo "</a>";
                                            echo "</td>";

                                            echo "<td class='noborder'>";
                                                echo "<a href='" . $this->linkPrimezilla . "' title='" . JText::_( 'CCMP_MESSAGE_TO' ) . " " . $this->entryUsername . "' >";
                                                echo JText::_( 'CCMP_MESSAGE_TO' ) . " " . $this->entryUsername;
                                                echo "</a>";
                                            echo "</td>";

                                        echo "</tr>";


                                }

                            } // end primezilla


                        }


                        if ( $_use_firstname == 1 || $_use_lastname == 1) {

                            echo "<tr>";
                                echo "<td colspan='2' class='noborder'>";
                                    if ( $_use_firstname == 1) {
                                        echo $this->firstname;
                                        echo " ";
                                    }
                                    if ( $_use_lastname == 1) {
                                        echo $this->lastname;
                                    }
                                echo "</td>";
                            echo "</tr>";

                        }


						if ( $_use_company == 1 && $this->company != "") {
				            echo "<tr>";
				               	echo "<td colspan='2' class='noborder'>";
									echo $this->company;
				                echo "</td>";
				            echo "</tr>";
						}


						if ( $_use_street == 1 && $this->street != "") {
				            echo "<tr>";
				               	echo "<td colspan='2' class='noborder'>";
									echo $this->street;
				                echo "</td>";
				            echo "</tr>";
						}


                        if ( $_use_zip == 1 || $_use_city == 1) {

                            if ( $this->zip != "" || $this->city != "") {
                                echo "<tr>";
                                    echo "<td colspan='2' class='noborder'>";
                                        echo $this->zip . " ";
                                        if ( $this->city != "") {
                                            echo $this->city;
                                        }
                                    echo "</td>";
                                echo "</tr>";
                            }
                        }


						if ( $_use_state == 1 && $this->entryState != "") {
				            echo "<tr>";
				               	echo "<td colspan='2' class='noborder'>";
									echo $this->entryState;
				                echo "</td>";
				            echo "</tr>";
						}

						if ( $_use_country == 1 && $this->country != "") {
				            echo "<tr>";
				               	echo "<td colspan='2' class='noborder'>";
									echo $this->country;
				                echo "</td>";
				            echo "</tr>";
						}

						if ( $_use_phone == 1 && $this->phone != "") {
				            echo "<tr>";
				               	echo "<td colspan='2' class='noborder'>";
									echo JText::_( 'CCMP_PHONE' ) . ": ";
									echo $this->phone;
				                echo "</td>";
				            echo "</tr>";
						}

						if ( $_use_mobile == 1 && $this->mobile != "") {
				            echo "<tr>";
				               	echo "<td colspan='2' class='noborder'>";
									echo JText::_( 'CCMP_MOBILE' ) . ": ";
									echo $this->mobile;
				                echo "</td>";
				            echo "</tr>";
						}

						if ( $_use_email == 1 && $this->email != "") {
				            echo "<tr>";
				               	echo "<td colspan='2' class='noborder'>";

									echo JText::_( 'CCMP_EMAIL' ) . ": ";

									$_email = $this->email;
									$_email = strtolower( $_email);
									$_email = strip_tags( $_email);
									$_email = str_replace( "mailto:", "", $_email);

                                    $_emcloaked = JHTML::_('Email.cloak', $_email);
                                    echo $_emcloaked;

				                echo "</td>";
				            echo "</tr>";
						}

						if ( $_use_web == 1 && $this->web != "") {
				            echo "<tr>";
				               	echo "<td colspan='2' class='noborder'>";
									echo JText::_( 'CCMP_WEB' ) . ": ";

									$_web = $this->web;
									$_web = strtolower( $_web);
									$_web = strip_tags( $_web);
									$_web = str_replace( "http://", "", $_web);

	                				echo "<a href='http://" . $_web . "' title='" . $_web . "' rel='nofollow' target='_blank' >";																		echo $_web;
									echo "</a>";

				                echo "</td>";
				            echo "</tr>";
						}

		            echo "</table>";

					echo "<br />";
					echo "<br />";


				}

			echo "</div>";


			if ( !$user->guest) { // user is logged in

				$_backendMode = $params->get('backendMode', '0'); // 0 no, 1 yes

				if( $_backendMode == 0) {

					if ( ($user->id == $this->user_id) || $logUser->isModerator()) { // it's the entry owner or a moderator

						echo "<div class='cofiEntryContentActions'>";

								$editLink = JRoute::_( 'index.php?option=com_ccmarketplace&view=entry&task=edit&entry='.$this->id);
								echo "<a href='$editLink'>" . JText::_( 'CCMP_EDIT' ) . "</a>";

								echo "&nbsp;&nbsp;&nbsp;";
								$deleteLink = JRoute::_( 'index.php?option=com_ccmarketplace&view=entry&task=delete&entry='.$this->id);
								echo "<a href='$deleteLink' onclick='return confirmdelete();'>" . JText::_( 'CCMP_DELETE' ) . "</a>";


								echo "&nbsp;&nbsp;&nbsp;";
								echo JText::_( 'CCMP_ENTRY_STATE' ) . ": ";

								if ( $this->published == 1) {
									echo "<span class='cofiStateActive'>";
										echo JText::_( 'CCMP_STATE_ACTIVE' );
									echo "</span>";
								}
								else { // either expired or unpublished by admin
									if ( $this->expired == 1) {
										echo "<span class='cofiStateExpired'>";
											echo JText::_( 'CCMP_STATE_EXPIRED' );
										echo "</span>";

										$reactivateLink = JRoute::_( 'index.php?option=com_ccmarketplace&view=entry&task=reactivate&entry='.$this->id);
										echo "(<a href='$reactivateLink'>" . JText::_( 'CCMP_REACTIVATE' ) . "</a>)";

									}
									else {
										echo "<span class='cofiStateDeactivated'>";
											echo JText::_( 'CCMP_STATE_DEACTIVATED' );
										echo "</span>";
									}
								}


						echo "</div>";

					}

				}

			}

		echo "</div>";

		break;

	} // end default

}

?>



<?php
if ( $this->task == "") { // don't display footer stuff when creating a new entry
	?>

	<!-- Breadcrumb -->
	<table class="noborder" style="margin-bottom: 20px;">
	    <tr>
	        <td class="noborder">
	            <?php
	            echo "<a href='$menuLinkHome'>" . $menuText . "</a>";
	            ?>
	        </td>
	        <td class="noborder">
	            <?php
	            echo "&nbsp;&raquo;&nbsp;";
	            echo "<a href='$menuLinkCategory'>".$this->categoryName."</a>";
	            ?>
	        </td>
	        <td class="noborder">
	            <?php
	            	echo "&nbsp;&raquo;&nbsp;";
					echo $this->headline;
	            ?>
	        </td>
	    </tr>
	</table>
	<!-- Breadcrumb -->



	<!-- HTML Box Bottom -->
	<?php
	$htmlBoxEntryBottom = $params->get('htmlBoxEntryBottom', '');

	if ( $htmlBoxEntryBottom != "") {
		echo "<div class='cofiHtmlBoxEntryBottom'>";
			echo $htmlBoxEntryBottom;
		echo "</div>";
	}
	?>
	<!-- HTML Box Bottom -->

	<?php
}
?>



<?php
include( 'components/com_ccmarketplace/includes/footer.php');
?>

</div>
