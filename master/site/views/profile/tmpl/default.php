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

// no direct access
defined('_JEXEC') or die('Restricted access');

JHTML::_('stylesheet', 'ccmarketplace.css', 'components/com_ccmarketplace/assets/');


$user =& JFactory::getUser();
$CofiUser = new CofiUser( $user->id);

// get parameters
$params = JComponentHelper::getParams('com_ccmarketplace');

// website root directory
$_root = JURI::root();
?>

<div class="codingfish">

<?php
if ( $this->params->def( 'show_page_title', 1 ) ) :
	?>
	<div class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
		<?php echo $this->escape($this->params->get('page_title')); ?>
	</div>
	<?php
endif;
?>



<!-- HTML Box Top -->
<?php
$htmlBoxProfileTop = $params->get('htmlBoxProfileTop', '');

if ( $htmlBoxProfileTop != "") {
	echo "<div class='cofiHtmlBoxProfileTop'>";
		echo $htmlBoxProfileTop;
	echo "</div>";
}
?>
<!-- HTML Box Top -->



<?php
include( 'components/com_ccmarketplace/includes/topmenu.php');
?>





<?php
echo "<h3>";
	echo $this->headline;
echo "</h3>";
?>



<!-- Breadcrumb -->
<?php
$showBreadcrumbRow = $params->get('breadcrumb', '0');

if ( $showBreadcrumbRow == "1") {
	?>

	<table class="noborder" style="margin-top: 5px;">
	    <tr>
	        <td class="noborder">
	            <?php
	            $menuLinkHome     = JRoute::_( 'index.php?option=com_ccmarketplace');
	            $menuText = JSite::getMenu()->getActive()->name;
	            echo "<a href='$menuLinkHome'>" . $menuText . "</a>";
	            ?>
	        </td>
	        <td class="noborder">
	            <?php
	            	echo "&nbsp;&raquo;&nbsp;";
	            	echo JText::_( "CCMP_PROFILE", true );
	            ?>
	        </td>
	    </tr>
	</table>

	<?php
}
?>
<!-- Breadcrumb -->




<?php

echo "<br />";


echo "<div class='cofiProfileContent'>";


echo "<form action='' method='post' name='postform' id='postform' enctype='multipart/form-data'>";

	echo "<table class='noborder' cellspacing='0' cellpadding='0' width='100%' border='0' >";

		echo "<tr>";
			echo "<td class='noborder' align='left' valign='top' width='100%' style='padding: 10px;' colspan='2'>";

				echo "<div class='cofiProfileUsername'>";
					echo $user->username;
			    echo "</div>";

				echo "<div class='cofiProfileName'>";
					echo "&nbsp;&nbsp;&nbsp;(".$user->name.")";
			    echo "</div>";

			echo "</td>";
		echo "</tr>";


		echo "<tr>";

			// left column
			echo "<td class='noborder' align='left' valign='top' style='padding: 10px;' >";

				echo "<div class='cofiProfileLocationBox'>";


					echo "<div class='cofiProfileLocationRow'>";
						echo "<div class='cofiProfileLocationLabel'>";
							echo JText::_( 'CCMP_FIRST_NAME' ) . ": ";
				    	echo "</div>";
						echo "<div class='cofiProfileLocationValue'>";
	            				echo "<input type='text' name='firstname' id='firstname' size='30' maxlength='100' value='" . $this->firstname . "'>";
				    	echo "</div>";
				    echo "</div>";

					echo "<div class='cofiProfileLocationRow'>";
						echo "<div class='cofiProfileLocationLabel'>";
							echo JText::_( 'CCMP_LAST_NAME' ) . ": ";
				    	echo "</div>";
						echo "<div class='cofiProfileLocationValue'>";
	            				echo "<input type='text' name='lastname' id='lastname' size='30' maxlength='100' value='" . $this->lastname . "'>";
				    	echo "</div>";
				    echo "</div>";

					echo "<div class='cofiProfileLocationRow'>";
						echo "<div class='cofiProfileLocationLabel'>";
							echo JText::_( 'CCMP_COMPANY' ) . ": ";
				    	echo "</div>";
						echo "<div class='cofiProfileLocationValue'>";
	            				echo "<input type='text' name='company' id='company' size='30' maxlength='100' value='" . $this->company . "'>";
				    	echo "</div>";
				    echo "</div>";



					echo "<div class='cofiProfileLocationRow'>";
						echo "<div class='cofiProfileLocationLabel'>";
							echo JText::_( 'CCMP_STREET' ) . ": ";
				    	echo "</div>";
						echo "<div class='cofiProfileLocationValue'>";
	            				echo "<input type='text' name='street' id='street' size='30' maxlength='100' value='" . $this->street . "'>";
				    	echo "</div>";
				    echo "</div>";


					echo "<div class='cofiProfileLocationRow'>";
						echo "<div class='cofiProfileLocationLabel'>";
							echo JText::_( 'CCMP_ZIP' ) . ": ";
				    	echo "</div>";
						echo "<div class='cofiProfileLocationValue'>";
	            				echo "<input type='text' name='zipcode' id='zipcode' size='5' maxlength='10' value='" . $this->zipcode . "'>";
				    	echo "</div>";
				    echo "</div>";


					echo "<div class='cofiProfileLocationRow'>";
						echo "<div class='cofiProfileLocationLabel'>";
							echo JText::_( 'CCMP_CITY' ) . ": ";
					    echo "</div>";
						echo "<div class='cofiProfileLocationValue'>";
		            			echo "<input type='text' name='city' id='city' size='30' maxlength='100' value='" . $this->city . "'>";
					    echo "</div>";
				    echo "</div>";


					echo "<div class='cofiProfileLocationRow'>";
						echo "<div class='cofiProfileLocationLabel'>";
							echo JText::_( 'CCMP_STATE' ) . ": ";
				    	echo "</div>";
						echo "<div class='cofiProfileLocationValue'>";
	            				echo "<input type='text' name='state' id='state' size='30' maxlength='100' value='" . $this->state . "'>";
				    	echo "</div>";
				    echo "</div>";


					echo "<div class='cofiProfileLocationRow'>";
						echo "<div class='cofiProfileLocationLabel'>";
							echo JText::_( 'CCMP_COUNTRY' ) . ": ";
					    echo "</div>";
						echo "<div class='cofiProfileLocationValue'>";
								include( 'components/com_ccmarketplace/includes/countryselect.php');
					    echo "</div>";
				    echo "</div>";




					echo "<div class='cofiProfileLocationRow'>";
						echo "<div class='cofiProfileLocationLabel'>";
							echo JText::_( 'CCMP_PHONE' ) . ": ";
				    	echo "</div>";
						echo "<div class='cofiProfileLocationValue'>";
	            				echo "<input type='text' name='phone' id='phone' size='30' maxlength='100' value='" . $this->phone . "'>";
				    	echo "</div>";
				    echo "</div>";

					echo "<div class='cofiProfileLocationRow'>";
						echo "<div class='cofiProfileLocationLabel'>";
							echo JText::_( 'CCMP_MOBILE' ) . ": ";
				    	echo "</div>";
						echo "<div class='cofiProfileLocationValue'>";
	            				echo "<input type='text' name='mobile' id='mobile' size='30' maxlength='100' value='" . $this->mobile . "'>";
				    	echo "</div>";
				    echo "</div>";




					echo "<div class='cofiProfileLocationRow'>";
						echo "<div class='cofiProfileLocationLabel'>";
							echo JText::_( 'CCMP_EMAIL' ) . ": ";
				    	echo "</div>";
						echo "<div class='cofiProfileLocationValue'>";
	            				echo "<input type='text' name='email' id='email' size='30' maxlength='100' value='" . $this->email . "'>";
				    	echo "</div>";
				    echo "</div>";

					echo "<div class='cofiProfileLocationRow'>";
						echo "<div class='cofiProfileLocationLabel'>";
							echo JText::_( 'CCMP_WEB' ) . ": ";
				    	echo "</div>";
						echo "<div class='cofiProfileLocationValue'>";
	            				echo "<input type='text' name='website' id='website' size='30' maxlength='100' value='" . $this->website . "'>";
				    	echo "</div>";
				    echo "</div>";




			    echo "</div>";


			echo "</td>";
			// left column

		echo "</tr>";




		echo "<tr>";
			echo "<td class='noborder' align='left' valign='top' style='padding-left: 10px;' colspan='2'>";

        		echo "<div class='cofiTextButton'>";
					echo "<input type='hidden' name='task' value='save'>";
					echo "<input class='cofiButton' type='submit' name='submit' value='" . JText::_( 'CCMP_SAVE' ) . "'>";
				echo "</div> ";

			echo "</td>";
		echo "</tr>";


	echo "</table>";

echo "</form>";


echo "</div>";
?>



<!-- HTML Box Bottom -->
<?php
$htmlBoxProfileBottom = $params->get('htmlBoxProfileBottom', '');

if ( $htmlBoxProfileBottom != "") {
	echo "<div class='cofiHtmlBoxProfileBottom'>";
		echo $htmlBoxProfileBottom;
	echo "</div>";
}
?>
<!-- HTML Box Bottom -->


<?php
include( 'components/com_ccmarketplace/includes/footer.php');
?>

</div>
