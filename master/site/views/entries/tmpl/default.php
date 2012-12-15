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


//require_once(JPATH_COMPONENT.DS.'classes/user.php');
require_once(JPATH_COMPONENT.DS.'classes/helper.php');

$app = JFactory::getApplication();


// set page title and description
$document =& JFactory::getDocument();

$title = $document->getTitle();
$siteName = $app->getCfg('sitename');

$title = JText::_( 'CCMP_MY_ENTRIES_TITLE' );

$document->setTitle( $title);

$document->setDescription( JText::_( 'CCMP_MY_ENTRIES_TITLE' ));


//$user =& JFactory::getUser();
$cHelper = new CodingfishFrontendHelper();

// get parameters
$params = JComponentHelper::getParams('com_ccmarketplace');

$_maxSmallImageX = $params->get('maxSmallImageX', 128);
$_maxSmallImageY = $params->get('maxSmallImageY', 96);

$showPriceColumn = $params->get('showPriceColumn', 1);
$showLabelColumn = $params->get('showLabelColumn', 1);

// website root directory
$_root = JURI::root();
?>

<div class="codingfish">

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
$htmlBoxCategoryTop = $params->get('htmlBoxCategoryTop', '');

if ( $htmlBoxCategoryTop != "") {
	echo "<div class='cofiHtmlBoxCategoryTop'>";
		echo $htmlBoxCategoryTop;
	echo "</div>";
}
?>
<!-- HTML Box Top -->



<?php
include( 'components/com_ccmarketplace/includes/topmenu.php');
?>



<!-- My entries icon, name and description -->
<table class="noborder" width="100%" style="margin-bottom:10px;">
    <tr>

        <!-- my entries image -->
        <td width="50" class="noborder">
            <?php
			// show default category image
			echo "<img src='" . $_root . "/components/com_ccmarketplace/assets/categories/default.png' style='border:0px;margin:5px;' />";
            ?>
        </td>
        <!-- my entries image -->

        <!-- my entries name and description -->
        <td align="left" class="noborder">
            <?php
            echo "<h2 style='padding: 0px; margin: 0px 0px 5px 0px;'>";
                echo JText::_( 'CCMP_MY_ENTRIES' );
            echo "</h2>";
            echo "";
            ?>
        </td>
        <!-- my entries name and description -->

    </tr>
</table>
<!-- My entries icon, name and description -->




<!-- Breadcrumb -->
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
            echo JText::_( 'CCMP_MY_ENTRIES' );
            ?>
        </td>
    </tr>
</table>
<!-- Breadcrumb -->



<!-- Pagination Links -->
<?php
if ( $this->pagination->getPagesLinks() ) {
?>
<table class="noborder" width="100%" style="margin-top:20px;">
    <tr>
        <td class="noborder">
            <?php
            echo $this->pagination->getPagesLinks();
            ?>
        </td>
        <td class="noborder">
            <?php
            echo $this->pagination->getPagesCounter();
            ?>
        </td>

    </tr>
</table>
<?php
}
?>
<!-- Pagination Links -->



<table class="noborder" width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:20px; margin-bottom:20px;">



<tr>
    <td align="left" class="cofiTableHeader"><?php echo JText::_( 'CCMP_ENTRY' ); ?></td>

    <?php
    if ( $showPriceColumn == 1) {
	    echo "<td width='100px' align='center' class='cofiTableHeader'>" . JText::_( 'CCMP_PRICE' ) . "</td>";
    }

    if ( $showLabelColumn == 1) {
	    echo "<td width='100px' align='center' class='cofiTableHeader'>" . JText::_( 'CCMP_LABEL' ) . "</td>";
    }

    if ( $useDiscussionsAvatars == 1) {
        ?>
        <td width="160px" align="center" class="cofiTableHeader"><?php echo JText::_( 'CCMP_DATE' ); ?></td>
        <?php
    }
    else {
        ?>
        <td width="150px" align="center" class="cofiTableHeader"><?php echo JText::_( 'CCMP_DATE' ); ?></td>
        <?php
    }
    ?>
</tr>



	<?php
	$rowColor = 1;

	$_row = 1;
	$_topStartDisplayed=0;
	$_topEndDisplayed=0;
	$_lastTop = 0;

	foreach ( $this->entries as $entry ) : ?>


		<?php
		if ( $_row == 1 && $_topStartDisplayed==0 && $entry->flag_top == 1) { // display "Top Entries"
			echo "<tr>";
				echo "<td>";
					echo "<div class='cofiTopEntries1'>";
						echo JText::_( 'CCMP_TOP_ENTRIES_1' );
					echo "</div>";
				echo "</td>";
			echo "</tr>";
			$_topStartDisplayed=1;
			$_lastTop = 1;
		}

		if ( $_topStartDisplayed==1 && $_topEndDisplayed==0 && $_lastTop == 1 && $entry->flag_top == 0) { // display "Top Entries"
			echo "<tr>";
				echo "<td>";
					echo "<div class='cofiTopEntries2'>";
						echo JText::_( 'CCMP_TOP_ENTRIES_2' );
					echo "</div>";
				echo "</td>";
			echo "</tr>";
			$_topEndDisplayed=1;
		}
		?>


    	<tr>

			<td align="left" class="cofiIndexTableRow<?php echo $rowColor; ?> cofiIndexTableRowTopic">

                <?php

            	$_hoverHeadline = $entry->headline;
            	$_hoverHeadline = str_replace( '\'', '"', $_hoverHeadline);

            	// get category slug
            	$_cslug = $cHelper->getCategorySlugById( $entry->category_id);

        		$entryLink = JRoute::_('index.php?option=com_ccmarketplace&view=entry&catid=' . $this->escape( $_cslug) . '&entry=' . $entry->slug );





          		echo"<div style='float:left; padding:0px;' >";

                	$_imageBox = $_maxSmallImageX + 20;
          			echo"<div style='width: " . $_imageBox . "px; text-align: center;' >";

	                	echo "<a href='$entryLink' title='".$_hoverHeadline."' rel='nofollow'>";

				    	if ( $entry->image1 == "") {
							echo "<img src='" . $_root . "components/com_ccmarketplace/assets/entries/default.png' width='" . $_maxSmallImageX . "' height='" . $_maxSmallImageY . "' align='top' border='0' class='cofiEntryContentImage' />";
				    	}
				    	else {
				        	echo "<img src='" . $_root . "images/marketplace/entries/" . $entry->id . "/small/" . $entry->image1 . "' alt='$entry->headline' class='cofiEntryContentImage' />";
				    	}

	                	echo "</a>";

	          		echo"</div>";


          		echo"</div>";



          		echo"<div style='float:left; padding:10px;' >";

					// shorten subject

					$_lengthHeadline = $params->get( 'headlineLength', 65 );

					$longheadline = strip_tags( $entry->headline);
					$i_longheadlinelength = strlen( $longheadline);
					$shortheadline = substr( strip_tags( $longheadline), 0, $_lengthHeadline);

                	echo "<a href='$entryLink' title='".$_hoverHeadline."' rel='nofollow'>" . $shortheadline . "</a>";

					if ( $i_longheadlinelength > $_lengthHeadline) { // display some dots
						echo JText::_( 'CCMP_DOTS' );
					}


					echo "<div class='cofiIndexTableRowHeadlineSubtitle'>";

						if ( $entry->zip != "" || $entry->city != "" || $entry->state != "" || $entry->country != "" ) {

							echo "(";

							echo $entry->zip;
							echo " ";
							echo $entry->city;
							echo " ";
							echo $entry->state;
							echo " ";
							echo $entry->country;

							echo ")";

						}

					echo "</div>";

					echo "<div class='cofiIndexTableRowTeaserText'>";

						$_lengthText = $params->get( 'textLength', 60 );

						$longtext = strip_tags( $entry->text);
						$i_longtextlength = strlen( $longtext);
						$shorttext = substr( strip_tags( $longtext), 0, $_lengthText);

						echo $shorttext;
						if ( $i_longtextlength > $_lengthText) { // display some dots
							echo JText::_( 'CCMP_DOTS' );
							echo "<a href='$entryLink' title='" . $_hoverHeadline . "'>" . JText::_( 'CCMP_MORE' ) . "</a>";
						}

					echo "</div>";




				echo"</div>";

                ?>

			</td>




			<!-- price -->
			<td align="center" class="cofiIndexTableRow<?php echo $rowColor; ?>  cofiIndexTableRowSticky">
					<?php
					echo $entry->price;
					?>
			</td>
			<!-- price -->


			<!-- label -->
			<td align="center" class="cofiIndexTableRow<?php echo $rowColor; ?>  cofiIndexTableRowSticky">
					<?php
					echo $cHelper->getLabelnameById( $entry->label_id);
					?>
			</td>
			<!-- label -->


			<!-- date -->
			<td align="center" class="cofiIndexTableRow<?php echo $rowColor; ?>  cofiIndexTableRowSticky">
				<?php
				echo $entry->date;

				echo "<br />";


				if ( $entry->published == 1) {
					echo "<div class='cofiStateActive'>";
						echo JText::_( 'CCMP_STATE_ACTIVE' );
					echo "</div>";
				}
				else { // either expired or unpublished by admin
					if ( $entry->expired == 1) {
						echo "<div class='cofiStateExpired'>";
							echo JText::_( 'CCMP_STATE_EXPIRED' );
						echo "</div>";
					}
					else {
						echo "<div class='cofiStateDeactivated'>";
							echo JText::_( 'CCMP_STATE_DEACTIVATED' );
						echo "</div>";
					}
				}

				?>
			</td>
			<!-- date -->



    	</tr>




		<?php
		// toggle row color
		if ( $rowColor == 1) {
			$rowColor = 2;
		}
		else {
			$rowColor = 1;
		}


	$_row += 1;

	endforeach;

	?>

</table>



<!-- Pagination Links -->
<?php
if ( $this->pagination->getPagesLinks() ) {
?>
<table class="noborder" width="100%" style="margin-bottom:10px;">
    <tr>
        <td class="noborder">
            <?php
            echo $this->pagination->getPagesLinks();
            ?>
        </td>
        <td class="noborder">
            <?php
            echo $this->pagination->getPagesCounter();
            ?>
        </td>

    </tr>
</table>
<?php
}
?>
<!-- Pagination Links -->



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
            echo JText::_( 'CCMP_MY_ENTRIES' );
            ?>
        </td>
    </tr>
</table>
<!-- Breadcrumb -->



<!-- Glossary -->
<table class="noborder" style="margin-bottom:20px;">
    <tr>
        <td class="noborder">
        	<div class="cofiStateActive">
	            <?php
	            echo JText::_( 'CCMP_STATE_ACTIVE' );
	            ?>
            </div>
        </td>
        <td class="noborder">
            <?php
            echo JText::_( 'CCMP_STATE_ACTIVE_TEXT' );
            ?>
        </td>

    </tr>
    <tr>
        <td class="noborder">
        	<div class="cofiStateExpired">
	            <?php
	            echo JText::_( 'CCMP_STATE_EXPIRED' );
	            ?>
            </div>
        </td>
        <td class="noborder">
            <?php
            echo JText::_( 'CCMP_STATE_EXPIRED_TEXT' );
            ?>
        </td>
    </tr>
    <tr>
        <td class="noborder">
        	<div class="cofiStateDeactivated">
	            <?php
	            echo JText::_( 'CCMP_STATE_DEACTIVATED' );
	            ?>
            </div>
        </td>
        <td class="noborder">
            <?php
            echo JText::_( 'CCMP_STATE_DEACTIVATED_TEXT' );
            ?>
        </td>

    </tr>
</table>
<!-- Glossary -->






<!-- HTML Box Bottom -->
<?php
$htmlBoxCategoryBottom = $params->get('htmlBoxCategoryBottom', '');

if ( $htmlBoxCategoryBottom != "") {
	echo "<div class='cofiHtmlBoxCategoryBottom'>";
		echo $htmlBoxCategoryBottom;
	echo "</div>";
}
?>
<!-- HTML Box Bottom -->


<?php
include( 'components/com_ccmarketplace/includes/footer.php');
?>

</div>
