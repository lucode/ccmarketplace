<?php

/**
*
* CCMarketplace - Classified Ads for Joomla!
*
* @package		Marketplace
* @subpackage	Frontend (Single Member Profile View)
* @author		Lucas Huber
*
*/
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

// JHTML::stylesheet('ad.css','modules'.DS.'mod_cyclosad'.DS.'tmpl'.DS );
JHTML::_('stylesheet', 'ccmarketplace.css', 'components/com_ccmarketplace/assets/');
$Itemid = JRequest::getInt('Itemid');
$id     = JRequest::getInt('meid');
$member = $this->data['data'];

$images               = $this->model->ensure_array($member->images);
$fields               = $this->model->ensure_array($member->fields);
$cyclosServer         = $this->data['cyclos_server_root'];
$no_picture_thumbnail = JURI::ROOT()."components/com_ccmarketplace/assets/images/no_picture_available.gif";
$image_url            = empty($images) ? $no_picture_thumbnail : $images[0]->fullUrl;
$image                = empty($images) ? null : $images[0];

$user                 = JFactory::getuser();
?>

<script type="text/javascript">
	var image_d = "";
	function showAd(url){
		if(image_d != "") {
			window.open( image_d, 'pop_ad_details', 'scrollbars=no,width=500,height=500,top=10,left=10')
		} else {
			window.open( url, 'pop_ad_details', 'scrollbars=no,width=500,height=500,top=10,left=10')
		}
	}

	function displayImageIn(image,caption) {
		image_d = image;
		document.getElementById('detail_image').src               = image;
		document.getElementById('detail_image_caption').innerHTML = caption;
	}
</script>
<form action="" name="smail" method="post">
	<input type="hidden" name="mailid" value="" />
	<input type="hidden" name="mailsubject" value="" />
	<input type="hidden" name="task" value="set_mail" />
	<input type="hidden" name="option" value="<?php echo $_REQUEST['option'] ?>">
	<input type="hidden" name="layout" value="<?php echo $_REQUEST['layout'] ?>">
	<input type="hidden" name="view" value="mail">
	<input type="hidden" name="id" value="<?php echo $_REQUEST['id'] ?>">
	<input type="hidden" name="meid" value="<?php echo $_REQUEST['meid'] ?>">
	<input type="hidden" name="Itemid" value="<?php echo $_REQUEST['Itemid'] ?>">
</form>
<?php if (!empty($member)) {
	if($this->options->mp != 1 || !empty($user->id)) {
 ?>
<div id="ccmarketplace_dview3_outer">
	<div id="ccmarketplace_dview3_title">
		<?php echo JText::_("CCMP_MEMBER_DETAILS"); ?>
	</div>
	<div id="ccmarketplace_dview3_inner">
		<?php if($this->options->photo) : ?>
		<div id="ccmarketplace_dview3_inner_left">
			<table>
				<tr>
					<td id="ccmarketplace_dview3_image">
						<a href="JavaScript:showAd('<?php echo $image_url;?>')" >
							<img id="detail_image" width="240" alt="<?php echo $images[0]->caption;?>" src="<?php echo $image_url;?>" />
						</a>
					</td>
				</tr>
				<tr>
					<td id="detail_image_caption">
						<?php echo @$images[0]->caption;?>
					</td>
				</tr>
				<?php
				if (!empty($images) && count($images)>1) { ?>
				<tr>
					<td id="detail_image_thumb">
				<?php  for ($j=0; $j<count($images); $j++) { ?>
					<img id="thumb" width="60" height="45" alt="<?php echo $images[$j]->caption;?>" onclick="displayImageIn( '<?php echo $images[$j]->fullUrl; ?>','<?php echo $images[$j]->caption;?>')" src="<?php echo $images[$j]->thumbnailUrl;?>" />
				<?php } ?>
					</td>
				</tr>
				<?php } ?>
			</table>
		</div>
		<?php endif; ?>
		<div id="<?php echo $this->options->photo ? "ccmarketplace_dview3_inner_right" : "ccmarketplace_dview3_ir_no_image" ?>" class="member_details_view">
			<table>
				<?php if($this->options->show_name) : ?>
				<tr id="ccmp_other">
					<td id="ccmp_title"><?php echo JText::_('CCMP_NAME'); ?></td>
					<td id="ccmp_data">
						<?php echo $member->name; ?>
					</td>
				</tr>
				<?php endif; ?>


				<tr id="ccmp_other">
					<td id="ccmp_title"><?php echo JText::_('CCMP_USER_NAME'); ?></td>
					<td id="ccmp_data">
						<?php echo $member->username; ?>
					</td>
				</tr>

				<?php if($this->options->mail) : ?>
				<tr id="ccmp_other">
					<td id="ccmp_title"><?php echo JText::_('CCMP_EMAIL'); ?></td>
					<td id="ccmp_data">
						<?php echo $member->email; ?>
					</td>
				</tr>
				<?php endif;
				//echo "<Pre>"; print_r($fields); exit;
				//echo "<Pre>"; print_r($this->options);  echo "</Pre>";
				if($this->options->show_customfield) :
					foreach ($fields as $field) {
					//echo "<Pre>"; print_r($field); echo "</Pre>";
						$show = 1;
						if(trim($field->value) && $field->value != null) {
					//	LUH	if($field->internalName == "code" || $field->internalName == "city" || $field->internalName == "state" || $field->internalName == "membership") {
							if($field->internalName == "code" || $field->internalName == "city" || $field->internalName == "membership") {
								$option_field = $field->internalName;
								if($this->options->$option_field) {
									$show = 1;
								} else {
									$show = 0;
								}
							}
							if($show) :
							?>
							<tr id="ccmp_other">
								<td id="ccmp_title"><?php echo $field->displayName; ?></td>
								<td id="ccmp_data"><?php echo $field->value; ?></td>
							</tr>
							<?php
							endif;
						}
					}
				endif;
				?>

			 </table>
		</div>
		<?php if($this->options->photo) : ?>
		<br style="clear:both"/>
		<?php endif; ?>
	</div>
</div>
<?php
	} else {
		echo '<p id="ccmarketplace_noads">'.JText::_('CCMP_MEMBER_DISABLE').'</p>';
	}
?>
<div id="ccmarketplace_dview3_back" class="default_member">
	<div title=<?php echo JText::_('CCMP_BACK'); ?>>
		<form><input type="button"  value=""onclick="history.go(-1);return false;"/></form>  
	</div>
	<input type="hidden" id="mail" value="<?php echo $member->email; ?>">
	<input type="hidden" id="mails" value="<?php echo $member->name; ?>">
	<?php echo "<div title=\"Send a Mail to member\" class=\"mem_send_mail\" onclick=\"javascript:document.forms['smail'].mailid.value=document.getElementById('mail').value;document.forms['smail'].mailsubject.value=document.getElementById('mails').value;document.forms['smail'].submit()\"></div>"; ?>
</div>
<?php
}
else {
	echo '<p id="ccmarketplace_noads">'.JText::_('CCMP_NO_MEMBER_DETAILS').'</p>';
}
?>
