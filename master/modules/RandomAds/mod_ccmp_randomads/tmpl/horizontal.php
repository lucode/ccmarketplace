<?php

/**
*
* CCMarketplace - Classified Ads for Joomla!
*
* @package		Marketplace
* @subpackage	Modul Random Ads
* @author		Lucas Huber
*
*/

defined('_JEXEC') or die('Restricted access');
JHTML::_('stylesheet', 'ccmarketplace.css', 'components/com_ccmarketplace/assets/');

$option   = @$_GET['option'];
$view     = @$_GET['view'];
$layout   = @$_GET['layout'];
$id       = @$_GET['id'];
$Itemid   = @$_GET['Itemid'];
$itoshow  = $params->get('itoshow');

//$parameters                = array($params->get('id'),$params->get('show_image'),$params->get('ad_per_page'),$params->get('pay_option'),$params->get('tradetype'),							$params->get('adstype'),$params->get('ad_width'),$params->get('ad_height'),$params->get('itoshow'));
?>
<div class="ccmarketplace_random_module" id="<?= $mod_id; ?>">

<?php
$actualCategory = $data['actualCategory'];
if (!empty($actualCategory) && !empty($actualCategory->children)) {
	$actualCategory_childrens = $actualCategory->children;
}
$page               = $data['page'];
//echo "<Pre>"; print_r($page); exit;
$ads        		= $page->ads;
$currentPage 	    = $page->currentPage;
$cyclos_server_root = $page->cyclos_server_root;
$id                 = $params->get('id', '');
 if(!empty($ads)){
 ?>
 <div class="random_module_inner_horizontal">
 <?php
 foreach ($ads as $ad) {
    $title                = JString::substr($ad->title,0, 60);
    $desc                 = JString::substr($ad->description,0, 60);
    $images               = $helper->model->ensure_array($ad->images);
    $no_picture_thumbnail = $cyclos_server_root."/systemImage?image=noPicture&thumbnail=true";
    $image_url            = empty($images) ? $no_picture_thumbnail : $images[0]->thumbnailUrl;

    $price=(!empty($ad->formattedPrice))?'<span>'.$ad->formattedPrice.'</span>':'';

	$siz                  = array("px", "pt");
	$d_width              = $params->get('ad_width','167px');
	$d_width              = str_replace($siz, "", $d_width);
	if($d_width < 70) {
		$fontsize = 10;
	} else {
		$fontsize = 12;
	}
?>
    <div class="horizontal_contenedor" style="width:<?php echo $params->get('ad_width','167px'); ?>;font-size:<?= $fontsize; ?>px;">
	<table class="horizontal_list" onclick="self.location='index.php?option=com_ccmarketplace&view=ads&layout=default_detailview3&module=1&adid=<?php echo $ad->id;?>&id=<?php echo $id;?>&shse=n'" style="width:<?php echo $params->get('ad_width','167px'); ?>;height:<?php echo $params->get('ad_height','180px'); ?>;">
       <?php if($itoshow == 1 || $itoshow == 3) :
			$idetail          = getimagesize($image_url);
			$percent_resizing = $params->get('ad_width','167px');
			$width            = $idetail[0];
			$height           = $idetail[1];
			$new_width 		  = round((($percent_resizing/100)*$width));
			$new_height       = round((($percent_resizing/100)*$height));
		?>
	    <tr class="horizontal_imagen" style="height:<?= $new_height + 10; ?>px">
             <td> <img src="<?php echo $image_url; ?>" width=<?= $new_width; ?> height=<?= $new_height; ?> /></td>
       </tr>
	   <?php endif; ?>

	   <?php if($itoshow == 2 || $itoshow == 3) : ?>
       <tr class="horizontal_text">
            <td><?php echo $title ?></td>
       </tr>
       <tr class="horizontal_price">
            <td><?php echo $price ?></td>
       </tr>
	   <?php endif; ?>
	</table>
    </div>
<?php
 }
?>
</div>
<?php
 } else {
	?>
		<p id="ccmarketplace_noads">
			<?php echo JText::_("CCMP_NO_ADS"); ?>
		</p>
	<?php
	}
$totalCount = $page->totalCount;
?>
<br style="clear:both;"/>
</div>
<input type="hidden" name="path" id="path" value="<?= JURI::ROOT(); ?>"/>
