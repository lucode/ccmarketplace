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

$doc  = & JFactory::getDocument();
$js   = JURI::base().'components/com_ccmarketplace/assets/getcustom.js';
$doc->addScript($js);

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
								<td colspan="2">
									<h3><?php echo JText::_( 'CCMP_GEN_SEC' ); ?></h3>
								</td>
							</tr>
<!--*************** General Section   ************-->                             
							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_NAME').':'; ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="name" id="name" value="<?php echo $this->webservice->name; ?>" size="50" maxlength="250" />
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;padding-top: 0px;">
									<label> 
										<?php echo JHTML::tooltip(JText::_('CCMP_TYPE_OF_INTERFACE_DESC'),JText::_('CCMP_TYPE_OF_INTERFACE'),'',JText::_('CCMP_TYPE_OF_INTERFACE')); ?>
                  </label>
								</td>
								<td style="padding: 10px;">
                                    <fieldset class="radio">
									<?php
									echo JHTML::_( 'select.genericlist', $this->interfacetype, 'interface', '' ,'value','text', $this->webservice->interface );
									?>
                                    </fieldset>
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_URL').':'; ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="serverurl" id="serverurl" value="<?php echo $this->webservice->serverurl; ?>" size="50" maxlength="250" onBlur = "getcustomfields(this.value);"/>
								</td>
							</tr>
							<tr>
								<td class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_( 'CCMP_ORGANISATION' ).':'; ?>
									</label>
								</td>
								<td style="padding: 10px;">
                                    <?php
										$model = $this->getmodel('webservice');
										echo $model->getGroupfilterids($this->webservice->organisation,$this->webservice->id);
									?>
									<br/>
									<a href="index.php?option=com_ccmarketplace&view=groupids" style=" background: none repeat scroll 0 0 #E3E3E3;border: 1px solid #828282;padding: 7px;text-decoration: none;" title="Add WebService Group Filter">Add WebService Group Filter</a>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<div id="custom_fields" style="width:100%"><?php if($this->webservice->id) echo $this->custom_fields; ?></div>
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
									$html = JHTML::_('select.booleanlist', 'published', 'class="inputbox"', $this->webservice->published);
							        echo $html;
									?>
                                    </fieldset>
								</td>
							</tr>
<!--***************  Advertisements Section  ************-->                            
							<tr>
								<td colspan="2">
									<h3><?php echo JText::_( 'CCMP_ADV_SEC' ); ?></h3>
								</td>
							</tr>
							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									<?php
                     echo JHTML::tooltip(JText::_('CCMP_ADS_JOOMLA_DESC'),JText::_('CCMP_ADS_JOOMLA'),'',JText::_('CCMP_ADS_JOOMLA')); 
                  ?>
                                   </label>
								</td>
								<td style="padding: 10px;">
                                    <fieldset class="radio">
									<?php
										echo JHTML::_( 'select.radiolist', $this->radios_no, 'ad_joomla', '' ,'value','text', $this->webservice->ad_joomla );
									?> (NA)
                                    </fieldset>
								</td>
							</tr>
							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_WEB_USER').':'; ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="webserver_user" id="webserver_user" value="<?php echo $this->webservice->webserver_user; ?>" size="50" maxlength="250" />
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_WEB_PASSWORD').':'; ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="webserver_password" id="webserver_password" value="<?php echo $this->webservice->webserver_password; ?>" size="50" maxlength="250" />
								</td>
							</tr>
							<tr>
								<td class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_( 'CCMP_TYPE_OF_TRADE' ).':'; ?>
									</label>
								</td>
								<td style="padding: 10px;">
                                    <fieldset class="radio">
									<?php
									echo JHTML::_( 'select.genericlist', $this->type_of_trade, 'type_of_trade', '' ,'value','text', $this->webservice->type_of_trade );
									?>
                                    </fieldset>
								</td>
							</tr>


							<tr>
								<td class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_( 'CCMP_TYPE_OF_AD' ).':'; ?>
									</label>
								</td>
								<td style="padding: 10px;">
                                    <fieldset class="radio">
									<?php
										echo JHTML::_( 'select.genericlist', $this->adstype, 'adstype', '' ,'value','text', $this->webservice->adstype );
					?>
                                    </fieldset>
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
									<label>
								    <?php
                       echo JHTML::tooltip(JText::_('CCMP_INT_STATE_DESC'),JText::_('CCMP_INT_STATE'),'',JText::_('CCMP_INT_STATE')); 
                    ?>
                  </label>
								</td>
								<td style="padding: 10px;">
                                    <fieldset class="radio">
									<?php
										echo JHTML::_( 'select.radiolist', $this->radios_no, 'cynet', '' ,'value','text', $this->webservice->cynet );
									?>
                                    </fieldset>
								</td>
							</tr>
              	<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php
                       echo JHTML::tooltip(JText::_('CCMP_PDF_URL_DESC'),JText::_('CCMP_PDF_URL'),'',JText::_('CCMP_PDF_URL')); 
                      ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="pdfurl" id="pdfurl" value="<?php echo $this->webservice->pdfurl; ?>" size="50" maxlength="250" onBlur = "getcustomfields(this.value);"/>
 						  	</td>
							</tr>
<!--***************   Webshop Section  ************-->                      
							<tr>
								<td colspan="2">
									<h3><?php echo JText::_( 'CCMP_WEBSHOP_SEC' ); ?></h3>
								</td>
							</tr>
							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_WEB_SHOP_USER').':'; ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="shop_user" id="shop_user" value="<?php echo $this->webservice->shop_user; ?>" size="50" maxlength="250" />
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
                                    <label>
									    <?php echo JText::_('CCMP_WEB_SHOP_PASSWORD').':'; ?>
                                    </label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="shop_password" id="shop_password" value="<?php echo $this->webservice->shop_password; ?>" size="50" maxlength="250" />
								</td>
							</tr>
<!--***************  Member(Profile) Section  ************-->                                             
							<tr>
								<td colspan="2">
									<h3><?php echo JText::_( 'CCMP_MEN_SEC' ); ?></h3>
								</td>
							</tr>
							<tr>
								<td class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_( 'CCMP_DIS_MEMBERSHIP' ).':'; ?>
									</label>
								</td>
								<td style="padding: 10px;">
                                    <fieldset class="radio">
									<?php
										echo JHTML::_( 'select.radiolist', $this->radios_no, 'd_member_profile', '' ,'value','text', $this->webservice->d_member_profile );
									?>
                                    </fieldset>
								</td>
							</tr>
							<tr>
								<td class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_( 'CCMP_SHOW_NAME' ).':'; ?>
									</label>
								</td>
								<td style="padding: 10px;">
                                    <fieldset class="radio">
									<?php
										echo JHTML::_( 'select.radiolist', $this->radios_no, 'show_name', '' ,'value','text', $this->webservice->show_name );
									?>
                                    </fieldset>
								</td>
							</tr>
							<tr>
								<td class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_( 'CCMP_MAIL_ADDRESS' ).':'; ?>
									</label>
								</td>
								<td style="padding: 10px;">
                                    <fieldset class="radio">
									<?php
										echo JHTML::_( 'select.radiolist', $this->radios_no, 'show_mail_address', '' ,'value','text', $this->webservice->show_mail_address );
									?>
                                    </fieldset>
								</td>
							</tr>
							<tr>
								<td class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_( 'CCMP_PHOTO' ).':'; ?>
									</label>
								</td>
								<td style="padding: 10px;">
                                    <fieldset class="radio">
									<?php
										echo JHTML::_( 'select.radiolist', $this->radios_no, 'show_photo', '' ,'value','text', $this->webservice->show_photo );
									?>
                                    </fieldset>
								</td>
							</tr>
</script>
<!--*************** Future Member(Profile) Params  ************ -->               
<!--
  							<tr>
								<td class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_( 'CCMP_CITY' ).':'; ?>
									</label>
								</td>
								<td style="padding: 10px;">
                                    <fieldset class="radio">
									<?php
										echo JHTML::_( 'select.radiolist', $this->radios_no, 'show_city', '' ,'value','text', $this->webservice->show_city );
									?>
                                    </fieldset>
								</td>
							</tr>
							<tr>
								<td class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_( 'CCMP_AREA' ).':'; ?>
									</label>
								</td>
								<td style="padding: 10px;">
                                    <fieldset class="radio">
									<?php
										echo JHTML::_( 'select.radiolist', $this->radios_no, 'show_area', '' ,'value','text', $this->webservice->show_area );
									?>
                                    </fieldset>
								</td>
							</tr>
							<tr>
								<td class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_( 'CCMP_ORGANISATION' ).':'; ?>
									</label>
								</td>
								<td style="padding: 10px;">
                                    <fieldset class="radio">
									<?php
										echo JHTML::_( 'select.radiolist', $this->radios_no, 'show_org', '' ,'value','text', $this->webservice->show_org );
									?>
                                    </fieldset>
								</td>
							</tr>
							<tr>
								<td class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_( 'CCMP_CODE' ).':'; ?>
									</label>
								</td>
								<td style="padding: 10px;">
                                    <fieldset class="radio">
									<?php
										echo JHTML::_( 'select.radiolist', $this->radios_no, 'show_code', '' ,'value','text', $this->webservice->show_code );
									?>
                                    </fieldset>
								</td>
							</tr>
							<tr>
								<td class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_( 'CCMP_MEMBERSHIP' ).':'; ?>
									</label>
								</td>
								<td style="padding: 10px;">
                                    <fieldset class="radio">
									<?php
										echo JHTML::_( 'select.radiolist', $this->radios_no, 'show_ms', '' ,'value','text', $this->webservice->show_ms );
									?>
                                    </fieldset>
								</td>
							</tr>
//-->             
							<tr>
								<td class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_( 'CCMP_SHOW_CUSTOMFIELD' ).':'; ?>
									</label>
								</td>
								<td style="padding: 10px;">
                                    <fieldset class="radio">
									<?php
										echo JHTML::_( 'select.radiolist', $this->radios_no, 'show_customfield', '' ,'value','text', $this->webservice->show_customfield );
									?>
                                    </fieldset>
								</td>
							</tr>
						</table>
 NA -> Not yet available!           
	<input type="hidden" name="option" value="com_ccmarketplace" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="cid[]" value="<?php echo $this->webservice->id; ?>" />
	<input type="hidden" name="view" value="webservice" />
	<input type="hidden" id="path" value="<?php echo JURI::base(); ?>" />

	<?php echo JHTML::_('form.token'); ?>
</form>

<div class="clr"></div>

<p class="copyright" align="center">

</p>