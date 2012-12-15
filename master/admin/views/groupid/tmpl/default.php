<?php
/**
*
* CCMarketplace - Classified Ads for Joomla!
*
* @package		Marketplace
* @subpackage	Backend
* @author		Lucas Huber
*
*/
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

JHTML::_('behavior.tooltip');
?>
<form action="index.php" method="post" name="adminForm" id="adminForm">

<fieldset class="adminform">

	<table class="admintable" width="100%">

		<tbody>

			<tr>

				<td valign="top">

						<legend>
							<?php echo JText::_('CCMP_WEBSERVICE_DETAILS');?>
						</legend>

						<table class="admintable" width="100%">

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_GROUP_ID'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="gid" id="gid" value="<?php echo $this->groupid->gid; ?>" size="50" maxlength="5" />
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_GROUP_NAME'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="gname" id="gname" value="<?php echo $this->groupid->gname; ?>" size="50" maxlength="250" />
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_WEBCHANNEL'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
										<?php
										$model = $this->getmodel('groupid');
										echo $model->webchannel_dropdown($this->groupid->webchannelid);
										?>
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_LOGIN_PAGE_NAME'); ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="login_page_name" id="login_page_name" value="<?php echo $this->groupid->login_page_name; ?>" size="50" maxlength="250" />
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
									$html = JHTML::_('select.booleanlist', 'published', 'class="inputbox"', $this->groupid->published);
									echo $html;
									?>
                                    </fieldset>
								</td>
							</tr>

							<!-- <tr>
								<td class="key" style="padding: 10px;">
                                    <label> -->
									    <?php /*echo JText::_('CCMP_GROUP_CODES');*/ ?>
                                    <!-- </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="group_codes" id="group_codes" value=" --> <?php /*echo $this->groupid->group_codes;*/ ?> <!--" size="50" maxlength="250" />
								</td>
							</tr> -->

						</table>
	<input type="hidden" name="option" value="com_ccmarketplace" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="cid[]" value="<?php echo $this->groupid->id; ?>" />
	<input type="hidden" name="view" value="groupid" />

	<?php echo JHTML::_('form.token'); ?>
</form>

<div class="clr"></div>

<p class="copyright" align="center">

</p>
