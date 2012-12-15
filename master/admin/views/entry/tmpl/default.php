<?php

/**
*
* Marketplace - Classified Ads for Joomla!
*
* @package		Marketplace
* @subpackage	Backend
* @author		Achim Fischer
* @copyright	Copyright (C) 2005-2012 Achim Fischer (Codingfish). All rights reserved.
* @link			http://www.codingfish.com
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*
*/

defined('_JEXEC') or die('Restricted access');

JHTML::_('behavior.tooltip');

// get parameters
$params = JComponentHelper::getParams('com_ccmarketplace');
$images = $params->get('images', '3'); // 3 default
?>


<script language="javascript" type="text/javascript">

	//<![CDATA[
	function submitbutton(pressbutton) {
		if ( pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		}
		if (trim( document.adminForm.name.value ) == "") {
			alert( '<?php echo JText::_('CCMP_ENTRY_MUST_HAVE_HEADLINE', true);?>' );
		} else {
			submitform( pressbutton );
		}
	}
	//]]>

</script>



<form action="index.php" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data" >

<fieldset class="adminform">

	<table class="admintable" width="100%">

		<tbody>

			<tr>

				<td valign="top">

						<legend>
							<?php echo JText::_('CCMP_ENTRY_DETAILS');?>
						</legend>

						<table class="admintable" width="100%">


							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_PUBLISHED');	?>
                                    </label>
								</td>
								<td style="padding: 10px;">
                                    <fieldset class="radio">
									    <?php echo $this->lists['published']; ?>
                                    </fieldset>
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_TOP');	?>
                                    </label>
								</td>
								<td style="padding: 10px;">
                                    <fieldset class="radio">
									    <?php echo $this->lists['top']; ?>
                                    </fieldset>
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_FEATURED');	?>
                                    </label>
								</td>
								<td style="padding: 10px;">
                                    <fieldset class="radio">
									    <?php echo $this->lists['featured']; ?>
                                    </fieldset>
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_COMMERCIAL');	?>
                                    </label>
								</td>
								<td style="padding: 10px;">
                                    <fieldset class="radio">
									    <?php echo $this->lists['commercial']; ?>
                                    </fieldset>
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_USERNAME'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<?php echo $this->lists['user_id']; ?>
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_CATEGORY'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<?php echo $this->lists['category_id']; ?>
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_LABEL'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<?php echo $this->lists['label_id']; ?>
								</td>
							</tr>





							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_HEADLINE'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="headline" id="headline" value="<?php echo $this->entry->headline; ?>" size="50" maxlength="250" />
								</td>
							</tr>


							<tr>
								<td valign="top" class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_TEXT'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
				 					<textarea name="text" id="text" rows="10" cols="50" style="width: 100%;"><?php echo $this->entry->text; ?></textarea>
								</td>
							</tr>


							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_CONDITION'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="condition" id="condition" value="<?php echo $this->entry->condition; ?>" size="50" maxlength="250" />
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_PRICE'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="price" id="price" value="<?php echo $this->entry->price; ?>" size="50" maxlength="250" />
								</td>
							</tr>



							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_FIRSTNAME'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="firstname" id="firstname" value="<?php echo $this->entry->firstname; ?>" size="50" maxlength="250" />
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_LASTNAME'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="lastname" id="lastname" value="<?php echo $this->entry->lastname; ?>" size="50" maxlength="250" />
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_COMPANY'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="company" id="company" value="<?php echo $this->entry->company; ?>" size="50" maxlength="250" />
								</td>
							</tr>


							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_STREET'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="street" id="street" value="<?php echo $this->entry->street; ?>" size="50" maxlength="250" />
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_ZIPCODE'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="zip" id="zip" value="<?php echo $this->entry->zip; ?>" size="50" maxlength="250" />
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_CITY'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="city" id="city" value="<?php echo $this->entry->city; ?>" size="50" maxlength="250" />
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_STATE'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="state" id="state" value="<?php echo $this->entry->state; ?>" size="50" maxlength="250" />
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_COUNTRY'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="country" id="country" value="<?php echo $this->entry->country; ?>" size="50" maxlength="250" />
								</td>
							</tr>



							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_PHONE'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="phone" id="phone" value="<?php echo $this->entry->phone; ?>" size="50" maxlength="250" />
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_MOBILE'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="mobile" id="mobile" value="<?php echo $this->entry->mobile; ?>" size="50" maxlength="250" />
								</td>
							</tr>


							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_EMAIL'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="email" id="email" value="<?php echo $this->entry->email; ?>" size="50" maxlength="250" />
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_WEBSITE'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="web" id="web" value="<?php echo $this->entry->web; ?>" size="50" maxlength="250" />
								</td>
							</tr>





							<?php if ( $images > 0) { ?>
							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_IMAGE') . " 1"; ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<?php
									$imagepath = JURI::root() . "images/marketplace/entries/" . $this->entry->id . "/small/" . $this->entry->image1;
									if ( $this->entry->image1 != "") {
			   							echo "<div>";
								        	echo "<img src='" . $imagepath . "' alt='" . $this->entry->headline . "' align='top' style=' background: #FFFFFF; padding: 2px; border: 1px solid #DDDDDD; margin: 5px 10px 5px 0px;' />";

				        				echo "<input type='checkbox' name='cb_image1' value='delete'> " . JText::_( 'delete' );

			   							echo "</div>";
							    	}
									?>
									<input class="text_area" type="file" name="image1" id="image1" value="<?php echo $this->entry->image1; ?>" size="50" maxlength="250" />
								</td>
							</tr>
							<?php } ?>


							<?php if ( $images > 1) { ?>
							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_IMAGE') . " 2"; ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<?php
									$imagepath = JURI::root() . "images/marketplace/entries/" . $this->entry->id . "/small/" . $this->entry->image2;
									if ( $this->entry->image2 != "") {
			   							echo "<div>";
								        	echo "<img src='" . $imagepath . "' alt='" . $this->entry->headline . "' align='top' style=' background: #FFFFFF; padding: 2px; border: 1px solid #DDDDDD; margin: 5px 10px 5px 0px;' />";

				        				echo "<input type='checkbox' name='cb_image2' value='delete'> " . JText::_( 'delete' );

			   							echo "</div>";
							    	}
									?>
									<input class="text_area" type="file" name="image2" id="image2" value="<?php echo $this->entry->image2; ?>" size="50" maxlength="250" />
								</td>
							</tr>
							<?php } ?>


							<?php if ( $images > 2) { ?>
							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_IMAGE') . " 3"; ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<?php
									$imagepath = JURI::root() . "images/marketplace/entries/" . $this->entry->id . "/small/" . $this->entry->image3;
									if ( $this->entry->image3 != "") {
			   							echo "<div>";
								        	echo "<img src='" . $imagepath . "' alt='" . $this->entry->headline . "' align='top' style=' background: #FFFFFF; padding: 2px; border: 1px solid #DDDDDD; margin: 5px 10px 5px 0px;' />";

				        				echo "<input type='checkbox' name='cb_image3' value='delete'> " . JText::_( 'delete' );

			   							echo "</div>";
							    	}
									?>
									<input class="text_area" type="file" name="image3" id="image3" value="<?php echo $this->entry->image3; ?>" size="50" maxlength="250" />
								</td>
							</tr>
							<?php } ?>


							<?php if ( $images > 3) { ?>
							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_IMAGE') . " 4"; ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<?php
									$imagepath = JURI::root() . "images/marketplace/entries/" . $this->entry->id . "/small/" . $this->entry->image4;
									if ( $this->entry->image4 != "") {
			   							echo "<div>";
								        	echo "<img src='" . $imagepath . "' alt='" . $this->entry->headline . "' align='top' style=' background: #FFFFFF; padding: 2px; border: 1px solid #DDDDDD; margin: 5px 10px 5px 0px;' />";

				        				echo "<input type='checkbox' name='cb_image4' value='delete'> " . JText::_( 'delete' );

			   							echo "</div>";
							    	}
									?>
									<input class="text_area" type="file" name="image4" id="image4" value="<?php echo $this->entry->image4; ?>" size="50" maxlength="250" />
								</td>
							</tr>
							<?php } ?>


							<?php if ( $images > 4) { ?>
							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_IMAGE') . " 5"; ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<?php
									$imagepath = JURI::root() . "images/marketplace/entries/" . $this->entry->id . "/small/" . $this->entry->image5;
									if ( $this->entry->image5 != "") {
			   							echo "<div>";
								        	echo "<img src='" . $imagepath . "' alt='" . $this->entry->headline . "' align='top' style=' background: #FFFFFF; padding: 2px; border: 1px solid #DDDDDD; margin: 5px 10px 5px 0px;' />";

				        				echo "<input type='checkbox' name='cb_image5' value='delete'> " . JText::_( 'delete' );

			   							echo "</div>";
							    	}
									?>
									<input class="text_area" type="file" name="image5" id="image5" value="<?php echo $this->entry->image5; ?>" size="50" maxlength="250" />
								</td>
							</tr>
							<?php } ?>


							<?php if ( $images > 5) { ?>
							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_IMAGE') . " 6"; ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<?php
									$imagepath = JURI::root() . "images/marketplace/entries/" . $this->entry->id . "/small/" . $this->entry->image6;
									if ( $this->entry->image6 != "") {
			   							echo "<div>";
								        	echo "<img src='" . $imagepath . "' alt='" . $this->entry->headline . "' align='top' style=' background: #FFFFFF; padding: 2px; border: 1px solid #DDDDDD; margin: 5px 10px 5px 0px;' />";

				        				echo "<input type='checkbox' name='cb_image6' value='delete'> " . JText::_( 'delete' );

			   							echo "</div>";
							    	}
									?>
									<input class="text_area" type="file" name="image6" id="image6" value="<?php echo $this->entry->image6; ?>" size="50" maxlength="250" />
								</td>
							</tr>
							<?php } ?>


							<?php if ( $images > 6) { ?>
							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_IMAGE') . " 7"; ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<?php
									$imagepath = JURI::root() . "images/marketplace/entries/" . $this->entry->id . "/small/" . $this->entry->image7;
									if ( $this->entry->image7 != "") {
			   							echo "<div>";
								        	echo "<img src='" . $imagepath . "' alt='" . $this->entry->headline . "' align='top' style=' background: #FFFFFF; padding: 2px; border: 1px solid #DDDDDD; margin: 5px 10px 5px 0px;' />";

				        				echo "<input type='checkbox' name='cb_image7' value='delete'> " . JText::_( 'delete' );

			   							echo "</div>";
							    	}
									?>
									<input class="text_area" type="file" name="image7" id="image7" value="<?php echo $this->entry->image7; ?>" size="50" maxlength="250" />
								</td>
							</tr>
							<?php } ?>


							<?php if ( $images > 7) { ?>
							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_IMAGE') . " 8"; ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<?php
									$imagepath = JURI::root() . "images/marketplace/entries/" . $this->entry->id . "/small/" . $this->entry->image8;
									if ( $this->entry->image8 != "") {
			   							echo "<div>";
								        	echo "<img src='" . $imagepath . "' alt='" . $this->entry->headline . "' align='top' style=' background: #FFFFFF; padding: 2px; border: 1px solid #DDDDDD; margin: 5px 10px 5px 0px;' />";

				        				echo "<input type='checkbox' name='cb_image8' value='delete'> " . JText::_( 'delete' );

			   							echo "</div>";
							    	}
									?>
									<input class="text_area" type="file" name="image8" id="image8" value="<?php echo $this->entry->image8; ?>" size="50" maxlength="250" />
								</td>
							</tr>
							<?php } ?>


							<?php if ( $images > 8) { ?>
							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_IMAGE') . " 9"; ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<?php
									$imagepath = JURI::root() . "images/marketplace/entries/" . $this->entry->id . "/small/" . $this->entry->image9;
									if ( $this->entry->image9 != "") {
			   							echo "<div>";
								        	echo "<img src='" . $imagepath . "' alt='" . $this->entry->headline . "' align='top' style=' background: #FFFFFF; padding: 2px; border: 1px solid #DDDDDD; margin: 5px 10px 5px 0px;' />";

				        				echo "<input type='checkbox' name='cb_image9' value='delete'> " . JText::_( 'delete' );

			   							echo "</div>";
							    	}
									?>
									<input class="text_area" type="file" name="image9" id="image9" value="<?php echo $this->entry->image9; ?>" size="50" maxlength="250" />
								</td>
							</tr>
							<?php } ?>


							<?php if ( $images > 9) { ?>
							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_IMAGE') . " 10"; ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<?php
									$imagepath = JURI::root() . "images/marketplace/entries/" . $this->entry->id . "/small/" . $this->entry->image10;
									if ( $this->entry->image10 != "") {
			   							echo "<div>";
								        	echo "<img src='" . $imagepath . "' alt='" . $this->entry->headline . "' align='top' style=' background: #FFFFFF; padding: 2px; border: 1px solid #DDDDDD; margin: 5px 10px 5px 0px;' />";

				        				echo "<input type='checkbox' name='cb_image10' value='delete'> " . JText::_( 'delete' );

			   							echo "</div>";
							    	}
									?>
									<input class="text_area" type="file" name="image10" id="image10" value="<?php echo $this->entry->image10; ?>" size="50" maxlength="250" />
								</td>
							</tr>
							<?php } ?>


						</table>

						<input type="hidden" name="option" value="com_ccmarketplace" />
						<input type="hidden" name="task" value="" />
						<input type="hidden" name="cid[]" value="<?php echo $this->entry->id; ?>" />
						<input type="hidden" name="view" value="entry" />

						<?php echo JHTML::_('form.token'); ?>

				</td>

			</tr>

		</tbody>

	</table>

</fieldset>

</form>



