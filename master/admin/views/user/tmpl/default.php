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

require_once( JPATH_COMPONENT . DS . 'classes/helper.php');
$cHelper = new CodingfishBackendHelper();

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
			alert( '<?php echo JText::_('CCMP_USER_MUST_HAVE_NAME', true);?>' );
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
							<?php echo JText::_('CCMP_USER_DETAILS');?>
						</legend>

						<table class="admintable" width="100%">



							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_USERNAME'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<b>
										<?php
										echo $this->user->username;
										?>
									</b>
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_( 'CCMP_MODERATOR' ).':'; ?>
									</label>
								</td>
								<td style="padding: 10px;">
                                    <fieldset class="radio">
									<?php
									$html = JHTML::_('select.booleanlist', 'moderator', 'class="inputbox"', $this->user->moderator);
									echo $html;
									?>
                                    </fieldset>
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_( 'CCMP_BLOCKED' ).':'; ?>
									</label>
								</td>
								<td style="padding: 10px;">
                                    <fieldset class="radio">
									<?php
									$html = JHTML::_('select.booleanlist', 'blocked', 'class="inputbox"', $this->user->blocked);
									echo $html;
									?>
                                    </fieldset>
								</td>
							</tr>



							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_ENTRIES'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<b>
										<?php
										$ads = $cHelper->getNumberOfEntriesById( $this->user->id);
										echo $this->escape( $ads);
										?>
									</b>
								</td>
							</tr>



							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_FIRSTNAME'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="firstname" id="firstname" value="<?php echo $this->user->firstname; ?>" size="50" maxlength="250" />
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_LASTNAME'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="lastname" id="lastname" value="<?php echo $this->user->lastname; ?>" size="50" maxlength="250" />
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_COMPANY'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="company" id="company" value="<?php echo $this->user->company; ?>" size="50" maxlength="250" />
								</td>
							</tr>


							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_STREET'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="street" id="street" value="<?php echo $this->user->street; ?>" size="50" maxlength="250" />
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_ZIPCODE'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="zipcode" id="zipcode" value="<?php echo $this->user->zipcode; ?>" size="50" maxlength="250" />
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_CITY'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="city" id="city" value="<?php echo $this->user->city; ?>" size="50" maxlength="250" />
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_STATE'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="state" id="state" value="<?php echo $this->user->state; ?>" size="50" maxlength="250" />
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_COUNTRY'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="country" id="country" value="<?php echo $this->user->country; ?>" size="50" maxlength="250" />
								</td>
							</tr>


							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_PHONE'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="phone" id="phone" value="<?php echo $this->user->phone; ?>" size="50" maxlength="250" />
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_MOBILE'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="mobile" id="mobile" value="<?php echo $this->user->mobile; ?>" size="50" maxlength="250" />
								</td>
							</tr>


							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_EMAIL'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="email" id="email" value="<?php echo $this->user->email; ?>" size="50" maxlength="250" />
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_WEBSITE'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="website" id="website" value="<?php echo $this->user->website; ?>" size="50" maxlength="250" />
								</td>
							</tr>


						</table>

                        <input type="hidden" name="option" value="com_ccmarketplace" />
						<input type="hidden" name="task" value="" />
						<input type="hidden" name="cid[]" value="<?php echo $this->user->id; ?>" />
						<input type="hidden" name="view" value="user" />

						<?php echo JHTML::_('form.token'); ?>

				</td>

			</tr>

		</tbody>

	</table>

</fieldset>

</form>



