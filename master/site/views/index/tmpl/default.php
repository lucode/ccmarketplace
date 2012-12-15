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

?>

<div class="codingfish">

<?php
// set page description
$document =& JFactory::getDocument();

$title = $document->getTitle();

$pageDescription = "";
$pageDescriptionSuffix = "";

// get parameters
$params = JComponentHelper::getParams('com_ccmarketplace');

$expirationMode     = $params->get('expirationMode', '0');
$expirationDuration = $params->get('expirationDuration', '30');

$expirationCleanup     = $params->get('expirationCleanup', '0');
$expirationCleanupDuration = $params->get('expirationCleanupDuration', '60');

$cHelper = new CodingfishFrontendHelper();
$cHelper->expireEntries( $expirationDuration, $expirationMode, $expirationCleanup, $expirationCleanupDuration);

// website root directory
$_root = JURI::root();


$useRssFeeds = $params->get('useRssFeeds', 1);
$useDiscussionsAvatars = $params->get('useDiscussionsAvatars', 0);


if ( $useRssFeeds == 1) {

	$_RssTitle = JText::_( 'CCMP_RSS_ALL_ENTRIES' );

	$config =& JFactory::getConfig();
	$_suffix = $config->getValue( 'config.sef_suffix' );

	if ( $_suffix == 0) { // no .html suffix
		$link 		= JRoute::_( 'index.php?option=com_ccmarketplace&format=feed');
	}
	else {
		$link 		= JRoute::_( 'index.php?option=com_ccmarketplace') . '?format=feed';
	}
	$attribs 	= array('type' => 'application/rss+xml', 'title' => $_RssTitle);

	$document->addHeadLink( $link, 'alternate', 'rel', $attribs);

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



<!-- HTML Box Top -->
<?php
$htmlBoxIndexTop = $params->get('htmlBoxIndexTop', '');

if ( $htmlBoxIndexTop != "") {
	echo "<div class='cofiHtmlBoxIndexTop'>";
		echo $htmlBoxIndexTop;
	echo "</div>";
}
?>
<!-- HTML Box Top -->



<?php
include( 'components/com_ccmarketplace/includes/topmenu.php');
?>






<table width="100%" border="0" cellspacing="0" cellpadding="0">


	<tr>
		<td width="53px" align="center" style="border: 0px; padding:5px 0px 5px 0px; font-weight: bold;">
			&nbsp;
		</td>
    	<td align="left" style="border: 0px; padding:5px 0px 5px 0px; font-weight: bold;">
    		<?php
    		echo JText::_( 'CCMP_CATEGORY' );
    		?>
    	</td>
		<td width="70px" align="center" style="border: 0px; padding:5px 0px 5px 0px; font-weight: bold;">
    		<?php
    		echo JText::_( 'CCMP_ENTRIES' );
    		?>
		</td>

        <?php
        if ( $useDiscussionsAvatars == 1) {
            ?>
            <td width="160px" align="center" style="border: 0px; padding:5px 0px 5px 0px; font-weight: bold;">
            <?php
        }
        else {
            ?>
		    <td width="150px" align="center" style="border: 0px; padding:5px 0px 5px 0px; font-weight: bold;">
            <?php
        }
    	echo JText::_( 'CCMP_LAST_ENTRY' );
    	?>
		</td>
	</tr>



	<?php

	$rowColor = 1;

	foreach ( $this->categories as $category ) : ?>

    <tr>

			<?php

			if ( $category->show_image == 0) {  // don't show category image

                if ( $category->parent_id == 0) {  // container
                    ?>
                    <td align="center" class="cofiContainer">
                    <?php
                }
                else {
                    ?>
                    <td align="center">
                    <?php
                }

                echo "&nbsp;";
                ?>

                </td>
                <?php

			}
			else {
				?>
				<td align="center" class="cofiIndexTableRow<?php echo $rowColor; ?> cofiIndexViewTableRowCategoryImage">
					<?php
					if ( $category->image == "") {  // show default category image
						echo "<img src='" . $_root . "/components/com_ccmarketplace/assets/categories/default.png' style='border:0px;margin:5px;' />";
					}
					else {
						echo "<img src='" . $_root . "/components/com_ccmarketplace/assets/categories/".$category->image."' style='border:0px;margin:5px;' />";
					}
					?>
				</td>
				<?php
			}
			?>



			<?php
			if ( $category->parent_id == 0) {  // container ?
				$pageDescription .= $category->description . " ";
				?>
				<td class="cofiContainer">
					<br />
					<h2 style="padding: 0px; margin-bottom: 5px;" >
						<?php echo $category->name; ?>
					</h2>
					<?php
					echo $category->description;
					?>
				</td>
				<?php
			}
			else {
				?>
				<td class="cofiIndexTableRow<?php echo $rowColor; ?> cofiIndexViewTableRowCategoryName">

                    <b>
                    <?php
                        $catLink = JRoute::_('index.php?option=com_ccmarketplace&view=category&catid=' . $this->escape( $category->slug) );
                        echo "<a href='$catLink' title='$category->name'>".$category->name."</a>";
                    ?>
                    </b>

					<br />
					<?php
					echo $category->description;
					?>
					<br />
				</td>
				<?php
			}
			?>


		<?php
		if ( $category->parent_id == 0) {  // don't show threads, posts and last post
			?>
			<td class="cofiContainer">&nbsp;</td>
			<td class="cofiContainer">&nbsp;</td>
			<?php
		}
		else {
			?>

			<td align="center" class="cofiIndexTableRow<?php echo $rowColor; ?> cofiIndexViewTableRowThreads">
				<?php
				echo $category->counter_entries;
				?>
			</td>

			<td align="center" class="cofiIndexTableRow<?php echo $rowColor; ?> cofiIndexViewTableRowLastEntry">
				<?php
				if ( $category->last_entry_date == "") {
					echo "-";
				}
				else { // entry found
                    /***/

                    $_username = $cHelper->getUsernameById( $category->last_entry_user_id);

                    if ( $useDiscussionsAvatars == 1) {
                        $_avatar   = $cHelper->getAvatarFromDiscussionsById( $category->last_entry_user_id);
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
                                            echo "<img src='" . $_root . "images/discussions/users/".$category->last_entry_user_id."/small/".$_avatar."' width='32px' height='32px' class='cofiCategoryAvatar' alt='$_username' title='$_username' />";
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

                                echo $category->last_entry_date;

                                echo "<br />";

                                echo JText::_( 'CCMP_BY' ) . "&nbsp;";
                                echo "<b>";
                                    echo $_username;
                                echo "</b>";

                            echo "</td>";
                        echo "</tr>";
                    echo "</table>";

                    /***/
				}
				?>
			</td>
			<?php
		}
		?>

    </tr>



	<?php
	// toggle row color
	if ( $rowColor == 1) {
		$rowColor = 2;
	}
	else {
		$rowColor = 1;
	}

	endforeach;

	// set page description
	$document->setDescription( $pageDescription . $pageDescriptionSuffix);
	?>



</table>


<!-- RSS feed icon -->
<?php
$showRssFeedIcon = $params->get('showRssFeedIcon', 1);

if ( $useRssFeeds == 1 && $showRssFeedIcon == 1) {

	echo "<div style='margin: 40px 0px 30px 0px;'>";

		echo "<img src='" . $_root . "/components/com_ccmarketplace/assets/icons/rss_16.png' style='margin: 0px 10px 0px 5px;' align='top' />";

		echo "<a href='" . $link .  "'>" . $_RssTitle . "</a>";

	echo "</div>";

}
?>
<!-- RSS feed icon -->



<!-- HTML Box Bottom -->
<?php
$htmlBoxIndexBottom = $params->get('htmlBoxIndexBottom', '');

if ( $htmlBoxIndexBottom != "") {
	echo "<div class='cofiHtmlBoxIndexBottom'>";
		echo $htmlBoxIndexBottom;
	echo "</div>";
}
?>
<!-- HTML Box Bottom -->


<?php
include( 'components/com_ccmarketplace/includes/footer.php');
?>

</div>




