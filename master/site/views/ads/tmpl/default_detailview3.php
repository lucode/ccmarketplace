<?php

/**
*
* CCMarketplace - Classified Ads for Joomla!
*
* @package		CC-Marketplace
* @subpackage	Frontend (Ad Detail View) 
* @author		Lucas Huber
*
*/
// no direct access
defined('_JEXEC') or die('Restricted access');
JHTML::stylesheet('ad.css','modules'.DS.'mod_cyclosad'.DS.'tmpl'.DS );
JHTML::_('stylesheet', 'ccmarketplace.css', 'components/com_ccmarketplace/assets/');
$Itemid = JRequest::getInt('Itemid');
$ad = $this->data['data'];

if (empty($ad)) {
	echo "\nNo advertisements were found with identifier ".$id."\n";
}

$description          = $ad->description;
$images               = $this->model->ensure_array($ad->images);
$cyclosServer         = $this->data['cyclos_server_root'];
$no_picture_thumbnail = JURI::ROOT()."components/com_ccmarketplace/assets/images/no_image.jpg";
$image_url            = empty($images) ? $no_picture_thumbnail : $images[0]->fullUrl;
$image                = empty($images) ? null : $images[0];
$id                   = JRequest::getInt('id');
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
<div id="ccmarketplace_dview3_outer">
	<div id="ccmarketplace_dview3_title">
		<?php echo $ad->title; ?>
	</div>
	<div id="ccmarketplace_dview3_inner">
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
		<div id="ccmarketplace_dview3_inner_right">
			<table>
				<tr id="ccmp_other">
					<td id="ccmp_title"><?php echo JText::_('CCMP_CATEGORY'); ?></td>
					<td id="ccmp_data">
						<?php echo $ad->category->name; ?>
					</td>
				</tr>

				<tr id="ccmp_other">
					<td id="ccmp_title"><?php echo JText::_('CCMP_PUBLISHED_ON'); ?></td>
					<td id="ccmp_data"><?php echo $ad->formattedPublicationStart;?></td>
				</tr>

				<tr id="ccmp_other">
					<td id="ccmp_title"><?php echo JText::_('CCMP_PUBLISHED_BY'); ?> !</td>
					<td id="ccmp_data">
							<a onclick="self.location='index.php?option=com_ccmarketplace&view=ads&layout=default_member&id=<?php echo $id;?>&meid=<?php echo trim($ad->owner->id);?>'">
								<?php echo $ad->owner->username;?>
					</a></td>
				</tr>

			<?php if(!empty($ad->formattedPublicationEnd)) : ?>
				<tr id="ccmp_other">
					<td id="ccmp_title"><?php echo JText::_('CCMP_PUBLISHED_END_ON'); ?></td>
					<td id="ccmp_data"><?php echo $ad->formattedPublicationEnd;?></td>
				</tr>
			<?php endif; ?>

			<?php if(!empty($ad->formattedPrice)) : ?>
				<tr id="ccmp_other">
					<td id="ccmp_title"><?php echo JText::_('CCMP_PRICE'); ?></td>
					<td id="ccmp_data"><?php echo $ad->formattedPrice;?></td>
				</tr>
				<tr id="ccmp_pay">
					<td colspan="2">
						<?php // echo $this->menu_params->get ('pay_option');
						$buttonAction = $this->menu_params->get('pay_option',0);
						if ( $buttonAction == 2 ) { ?>
							<input type="button" onclick="window.open('<?php echo $cyclosServer . "/do/member/viewAd?id=" . $ad->id;?>','Cyclos','')" value="<?php echo JText::_('CCMP_REDIRECT') ?>" />
						<?php } elseif ( $buttonAction == 1 ) {
							$ticket = $this->data['ticket'];
						?>
							<input type="button" onclick="window.open('<?php echo $cyclosServer."/do/webshop/payment?ticket=".$ticket?>','pay','resizable=1,width=580,height=480')" value="<?php echo JText::_('CCMP_PAY') ?>" />
						<?php } ?>
					</td>
				</tr>
			<?php endif; ?>

			<?php if(!empty($description)) : ?>
				<tr id="ccmp_desc">
					<td colspan="2"><?php echo $description;?></td>
				</tr>
			<?php endif; ?>
			 </table>
		</div>
		<br style="clear:both"/>
	</div>
	 <div id="ccmarketplace_dview3_back" class="default_member">
		<div title=<?php echo JText::_('CCMP_BACK'); ?>>
		<form><input type="button"  value=""onclick="history.go(-1);return false;"/></form>  
	   </div>
	 </div>  
</div>

