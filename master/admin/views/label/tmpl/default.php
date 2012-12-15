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
			alert( '<?php echo JText::_('CCMP_LABEL_MUST_HAVE_NAME', true);?>' );
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
							<?php echo JText::_('CCMP_LABEL_DETAILS');?>
						</legend>

						<table class="admintable" width="100%">

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_NAME'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="name" id="name" value="<?php echo $this->label->name; ?>" size="50" maxlength="250" />
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_( 'CCMP_PUBLISHED' ).':'; ?>
									</label>
								</td>
								<td style="padding: 10px;">
                                    <fieldset class="radio">
									<?php
									$html = JHTML::_('select.booleanlist', 'published', 'class="inputbox"', $this->label->published);
									echo $html;
									?>
                                    </fieldset>
								</td>
							</tr>


						</table>

                        <input type="hidden" name="option" value="com_ccmarketplace" />
						<input type="hidden" name="task" value="" />
						<input type="hidden" name="cid[]" value="<?php echo $this->label->id; ?>" />
						<input type="hidden" name="view" value="label" />

						<?php echo JHTML::_('form.token'); ?>

				</td>

			</tr>

		</tbody>

	</table>

</fieldset>

</form>



