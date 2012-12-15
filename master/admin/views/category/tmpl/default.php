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
?>

<script language="javascript" type="text/javascript">

	//<![CDATA[
	function submitbutton(pressbutton) {
		if ( pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		}
		if (trim( document.adminForm.name.value ) == "") {
			alert( '<?php echo JText::_('CCMP_CATEGORY_MUST_HAVE_NAME', true);?>' );
		} else {
			submitform( pressbutton );
		}
	}
	//]]>

</script>



<form action="index.php" method="post" name="adminForm" id="adminForm">

<fieldset class="adminform">

	<table class="admintable" width="100%">

		<tbody>

			<tr>

				<td valign="top">

						<legend>
							<?php echo JText::_('CCMP_CATEGORY_DETAILS');?>
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
									    <?php echo JText::_('CCMP_NAME'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="name" id="name" value="<?php echo $this->category->name; ?>" size="50" maxlength="250" />
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_ALIAS'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="alias" value="<?php echo $this->category->alias; ?>" size="50" maxlength="250" />
								</td>
							</tr>


							<tr>
								<td valign="top" class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_DESCRIPTION'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
				 					<textarea name="description" id="description" rows="5" cols="50" style="width: 100%;"><?php echo $this->category->description; ?></textarea>
								</td>
							</tr>


							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_PARENT'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<?php
									echo $this->lists['parent'];
									?>
								</td>
							</tr>


							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_SHOW_IMAGE');	?>
                                    </label>
								</td>
								<td style="padding: 10px;">
                                    <fieldset class="radio">
									    <?php echo $this->lists['show_image']; ?>
                                    </fieldset>
								</td>
							</tr>


							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									<?php echo JText::_('CCMP_IMAGE'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="image" id="image" value="<?php echo $this->category->image; ?>" size="50" maxlength="250" />
								</td>
							</tr>



							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_USE_FIRSTNAME');	?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<?php echo $this->lists['use_firstname']; ?>
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									<?php echo JText::_('CCMP_USE_LASTNAME');	?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<?php echo $this->lists['use_lastname']; ?>
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_USE_STREET');	?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<?php echo $this->lists['use_street']; ?>
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_USE_ZIPCODE');	?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<?php echo $this->lists['use_zip']; ?>
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_USE_CITY');	?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<?php echo $this->lists['use_city']; ?>
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_USE_STATE');	?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<?php echo $this->lists['use_state']; ?>
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_USE_COUNTRY');	?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<?php echo $this->lists['use_country']; ?>
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_USE_PHONE');	?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<?php echo $this->lists['use_phone']; ?>
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_USE_MOBILE');	?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<?php echo $this->lists['use_mobile']; ?>
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_USE_EMAIL');	?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<?php echo $this->lists['use_email']; ?>
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_USE_WEBSITE');	?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<?php echo $this->lists['use_web']; ?>
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_USE_CONDITION');	?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<?php echo $this->lists['use_condition']; ?>
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_USE_PRICE');	?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<?php echo $this->lists['use_price']; ?>
								</td>
							</tr>


						</table>

                        <input type="hidden" name="option" value="com_ccmarketplace" />
						<input type="hidden" name="task" value="" />
						<input type="hidden" name="cid[]" value="<?php echo $this->category->id; ?>" />
						<input type="hidden" name="view" value="category" />

						<?php echo JHTML::_('form.token'); ?>

				</td>

			</tr>

		</tbody>

	</table>

</fieldset>

</form>



