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


require_once(JPATH_COMPONENT.DS.'classes/helper.php');


$app = JFactory::getApplication();


// set page title and description
$document =& JFactory::getDocument();

$title = $document->getTitle();
$siteName = $app->getCfg('sitename');

$title = $this->categoryName;

$document->setTitle( $title);

$document->setDescription( $this->categoryDescription);


//$user =& JFactory::getUser();
$cHelper = new CodingfishFrontendHelper();

// get parameters
$params = JComponentHelper::getParams('com_ccmarketplace');

$_commercialEntries = $params->get('commercialEntries', '0'); // 0 no, 1 yes

$_maxSmallImageX = $params->get('maxSmallImageX', 128);
$_maxSmallImageY = $params->get('maxSmallImageY', 96);


// website root directory
$_root = JURI::root();


$useRssFeeds = $params->get('useRssFeeds', 1);
$useDiscussionsAvatars = $params->get('useDiscussionsAvatars', 0);

$showPriceColumn = $params->get('showPriceColumn', 1);
$showLabelColumn = $params->get('showLabelColumn', 1);

$_lengthHeadline = $params->get( 'headlineLength', 65 );
$_lengthText = $params->get( 'textLength', 60 );


if ( $useRssFeeds == 1) {

	$_RssTitleAll = JText::_( 'CCMP_RSS_ALL_ENTRIES' );
	$_RssTitleCategory = JText::_( 'CCMP_RSS_CATEGORY' ) . " " . $this->categoryName ;

	$config =& JFactory::getConfig();
	$_suffix = $config->getValue( 'config.sef_suffix' );

	if ( $_suffix == 0) { // no .html suffix
		$linkAll 		= JRoute::_( 'index.php?option=com_ccmarketplace&format=feed');
	}
	else {
		$linkAll 		= JRoute::_( 'index.php?option=com_ccmarketplace') . '?format=feed';
	}
	$attribsAll 	= array('type' => 'application/rss+xml', 'title' => $_RssTitleAll);
	$document->addHeadLink( $linkAll, 'alternate', 'rel', $attribsAll);

	if ( $_suffix == 0) { // no .html suffix
		$linkCategory 	= JRoute::_( 'index.php?option=com_ccmarketplace&view=category&catid=' . $this->categorySlug . '&format=feed' );
	}
	else {
		$linkCategory 	= JRoute::_( 'index.php?option=com_ccmarketplace&view=category&catid=' . $this->categorySlug )  . '?format=feed';
	}
	$attribsCategory 	= array('type' => 'application/rss+xml', 'title' => $_RssTitleCategory);
	$document->addHeadLink( $linkCategory, 'alternate', 'rel', $attribsCategory);

}
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



<!-- Category icon, name and description -->
<table width="100%" class="noborder" style="margin-bottom:10px;">
    <tr>

        <!-- category image -->
        <td width="50" class="noborder">
            <?php
			if ( $this->categoryImage == "") {  // show default category image
				echo "<img src='" . $_root . "/components/com_ccmarketplace/assets/categories/default.png' style='border:0px;margin:5px;' />";
			}
			else {
				echo "<img src='" . $_root . "/components/com_ccmarketplace/assets/categories/".$this->categoryImage."' style='border:0px;margin:5px;' />";
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
            echo "&nbsp;&raquo;&nbsp;";
            echo $this->categoryName;
            ?>
        </td>
    </tr>
</table>
<!-- Breadcrumb -->




<!-- Filter row -->
<?php
if ( $_commercialEntries == 1) {
    echo "<table class='noborder' style='margin-top: 15px;'>";
        echo "<tr>";
            echo "<td class='noborder'>";

                echo "<form name = 'filter_entries' action = '' method = 'post' >";
                    echo JText::_( 'CCMP_FILTER_ENTRIES');
                    echo "&nbsp;&nbsp;&nbsp;";

                    switch ( $this->filterPrivateCommercial) {

                        case 1: { // private
                            echo "<input type='radio' name='filter_commercial' value='0' onclick = 'this.form.submit()'> " . JText::_( 'CCMP_FILTER_ALL');
                            echo "&nbsp;&nbsp;&nbsp;";
                            echo "<input type='radio' name='filter_commercial' value='1' onclick = 'this.form.submit()' checked> " . JText::_( 'CCMP_FILTER_PRIVATE');
                            echo "&nbsp;&nbsp;&nbsp;";
                            echo "<input type='radio' name='filter_commercial' value='2' onclick = 'this.form.submit()'> " . JText::_( 'CCMP_FILTER_COMMERCIAL');
                            break;
                        }

                        case 2: { // commercial
                            echo "<input type='radio' name='filter_commercial' value='0' onclick = 'this.form.submit()'> " . JText::_( 'CCMP_FILTER_ALL');
                            echo "&nbsp;&nbsp;&nbsp;";
                            echo "<input type='radio' name='filter_commercial' value='1' onclick = 'this.form.submit()'> " . JText::_( 'CCMP_FILTER_PRIVATE');
                            echo "&nbsp;&nbsp;&nbsp;";
                            echo "<input type='radio' name='filter_commercial' value='2' onclick = 'this.form.submit()' checked> " . JText::_( 'CCMP_FILTER_COMMERCIAL');
                            break;
                        }

                        default: { // nothing special -> show all
                            echo "<input type='radio' name='filter_commercial' value='0' onclick = 'this.form.submit()' checked> " . JText::_( 'CCMP_FILTER_ALL');
                            echo "&nbsp;&nbsp;&nbsp;";
                            echo "<input type='radio' name='filter_commercial' value='1' onclick = 'this.form.submit()'> " . JText::_( 'CCMP_FILTER_PRIVATE');
                            echo "&nbsp;&nbsp;&nbsp;";
                            echo "<input type='radio' name='filter_commercial' value='2' onclick = 'this.form.submit()'> " . JText::_( 'CCMP_FILTER_COMMERCIAL');
                            break;
                        }

                    } // switch

                echo "</form>";

            echo "</td>";
        echo "</tr>";
    echo "</table>";
}
?>
<!-- Filter row -->





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



<table width="100%" border="0" cellspacing="0" cellpadding="0" class="noborder" style="margin-top:20px; margin-bottom:20px;">



    <tr>
        <td               align="left"   class="cofiTableHeader"><?php echo JText::_( 'CCMP_ENTRY' ); ?></td>

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
                $entryLink = JRoute::_('index.php?option=com_ccmarketplace&view=entry&catid=' . $this->escape( $this->categorySlug) . '&entry=' . $entry->slug );
                ?>

                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="noborder">
                    <tr>
                        <td align="left" valign="top" class="noborder">
                            <?php
                            $_imageBox = $_maxSmallImageX + 20;
                            echo"<div style='width: " . $_imageBox . "px; text-align: center;' >";

                                echo "<a href='$entryLink' title='".$_hoverHeadline."' rel='nofollow'>";

                                if ( $entry->image1 == "") {
                                    echo "<img src='" . $_root . "components/com_ccmarketplace/assets/entries/default.png' width='128' height='96' align='top' border='0' class='cofiEntryContentImage' />";
                                }
                                else {
                                    echo "<img src='" . $_root . "images/marketplace/entries/" . $entry->id . "/small/" . $entry->image1 . "' alt='$entry->headline' class='cofiEntryContentImage' />";
                                }

                                echo "</a>";

                            echo"</div>";
                            ?>
                        </td>


                        <td width="100%" align="left" valign="top" class="noborder">

                            <?php
                            echo "<div class='cofiIndexTableRowHeadlineTitle'>";
                                $longheadline = strip_tags( $entry->headline);
                                $i_longheadlinelength = strlen( $longheadline);
                                $shortheadline = substr( strip_tags( $longheadline), 0, $_lengthHeadline);

                                echo "<a href='$entryLink' title='".$_hoverHeadline."' rel='nofollow'>" . $shortheadline . "</a>";

                                if ( $i_longheadlinelength > $_lengthHeadline) { // display some dots
                                    echo JText::_( 'CCMP_DOTS' );
                                }
                            echo "</div>";

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

                                $longtext = strip_tags( $entry->text);
                                $i_longtextlength = strlen( $longtext);
                                $shorttext = substr( strip_tags( $longtext), 0, $_lengthText);

                                echo $shorttext;
                                if ( $i_longtextlength > $_lengthText) { // display some dots
                                    echo JText::_( 'CCMP_DOTS' );
                                    echo "<a href='$entryLink' title='" . $_hoverHeadline . "'>" . JText::_( 'CCMP_MORE' ) . "</a>";
                                }

                            echo "</div>";
                            ?>
                        </td>



                    </tr>
                </table>

			</td>


			<!-- price -->
            <?php
            if ( $showPriceColumn == 1) {
                echo "<td align='center' class='cofiIndexTableRow" . $rowColor . " cofiIndexTableRowSticky'>";
                        echo $entry->price;
                echo "</td>";
			}
			?>
			<!-- price -->


			<!-- label -->
            <?php
            if ( $showLabelColumn == 1) {
                echo "<td align='center' class='cofiIndexTableRow" . $rowColor . " cofiIndexTableRowSticky'>";
                    echo $cHelper->getLabelnameById( $entry->label_id);
                echo "</td>";
			}
			?>
			<!-- label -->


			<!-- date -->
			<td align="center" class="cofiIndexTableRow<?php echo $rowColor; ?>  cofiIndexTableRowSticky">
				<?php
                $_username = $cHelper->getUsernameById( $entry->user_id);

                if ( $useDiscussionsAvatars == 1) {
                    $_avatar   = $cHelper->getAvatarFromDiscussionsById( $entry->user_id);
                }

                echo "<table width='100%' cellspacing='0' cellpadding='0' border='0' class='noborder'>";
                    echo "<tr>";

                        if ( $useDiscussionsAvatars == 1) {

                            echo "<td width='32' align='left' class='noborder'>";

                                echo "<div class='cofiAvatarBox'>";
                                    if ( $_avatar == "") { // display default avatar
                                        echo "<img src='" . $_root . "components/com_discussions/assets/users/user.png' width='32px' height='32px' class='cofiCategoryDefaultAvatar' alt='$_username' title='$_username' />";
                                    }
                                    else { // display uploaded avatar
                                        echo "<img src='" . $_root . "images/discussions/users/".$entry->user_id."/small/".$_avatar."' width='32px' height='32px' class='cofiCategoryAvatar' alt='$_username' title='$_username' />";
                                    }
                                echo "</div>";

                            echo "</td>";

                        }

                        if ( $useDiscussionsAvatars == 1) {
                            echo "<td align='left' valign='center' class='noborder' style='padding-left: 5px;'>";
                        }
                        else {
                            echo "<td align='center' valign='center' class='noborder'>";
                        }

                        echo $entry->date;
                        echo "<br />";

                        echo JText::_( 'CCMP_BY' ) . "&nbsp;";
                        echo "<b>";
                            echo $_username;
                        echo "</b>";

                        echo "</td>";
                    echo "</tr>";
                echo "</table>";
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
<table width="100%" class="noborder" style="margin-bottom:10px;">
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
            echo $this->categoryName;
            ?>
        </td>
    </tr>
</table>
<!-- Breadcrumb -->



<!-- RSS feed icon -->
<?php
$showRssFeedIcon = $params->get('showRssFeedIcon', 1);

if ( $useRssFeeds == 1 && $showRssFeedIcon == 1) {

	echo "<div style='margin: 30px 0px 10px 0px;'>";
		echo "<img src='" . $_root . "/components/com_ccmarketplace/assets/icons/rss_16.png' style='margin: 0px 10px 0px 5px;' align='top' />";
		echo "<a href='" . $linkAll .  "'>" . $_RssTitleAll . "</a>";
	echo "</div>";

	echo "<div style='margin: 0px 0px 20px 0px;'>";
		echo "<img src='" . $_root . "/components/com_ccmarketplace/assets/icons/rss_16.png' style='margin: 0px 10px 0px 5px;' align='top' />";
		echo "<a href='" . $linkCategory .  "'>" . $_RssTitleCategory . "</a>";
	echo "</div>";



}
?>
<!-- RSS feed icon -->




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


