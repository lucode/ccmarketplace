<?php
// no direct access other than ajx

	if($_REQUEST['req'] != 'ajx') {
	  die('Direct Access to this location is not allowed.');
	} else {
	  define( '_JEXEC', 1 );
	}

	chdir("../../");
	getcwd();
	define('JPATH_BASE', getcwd() );

	define( 'DS', DIRECTORY_SEPARATOR );

	require_once (JPATH_BASE .DS.'includes'.DS.'defines.php' );
	require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );

	jimport( 'joomla.registry.registry' );
	$params = new JRegistry;
	$params->loadString(json_encode($_POST));

	jimport( 'joomla.environment.request' );

	// Include the syndicate functions only once
	require_once dirname(__FILE__).'/helper.php';

	$helper 		= new modrandomadsHelper();
	$value          = $helper->getWebservice($params);
	$data  		    = $helper->getAdsdata();

	//Horizontal
	$actualCategory = $data['actualCategory'];
	if (!empty($actualCategory) && !empty($actualCategory->children)) {
		$actualCategory_childrens = $actualCategory->children;
	}
	$page               = $data['page'];
	$ads        		= $page->ads;
	$currentPage 	    = $page->currentPage;
	$cyclos_server_root = $page->cyclos_server_root;
	$id                 = $params->get('id', '');
	$itoshow            = $params->get('itoshow');
	$view               = $params->get('view','vertical');
	 if(!empty($ads)){
	 ?>
	 <div class="random_module_inner_<?= $view; ?>">
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
		<div class="<?= $view; ?>_contenedor" style="width:<?php echo $params->get('ad_width','167px'); ?>;font-size:<?= $fontsize; ?>px;">
		<table class="<?= $view; ?>_list" onclick="self.location='index.php?option=com_ccmarketplace&view=ads&layout=default_detailview3&module=1&adid=<?php echo $ad->id;?>&id=<?php echo $id;?>&shse=n'" style="width:<?php echo $params->get('ad_width','167px'); ?>;height:<?php echo $params->get('ad_height','180px'); ?>;">
		   <?php if($itoshow == 1 || $itoshow == 3) :
				$idetail          = getimagesize($image_url);
				$percent_resizing = $params->get('ad_width','167px');
				$width            = $idetail[0];
				$height           = $idetail[1];
				$new_width 		  = round((($percent_resizing/100)*$width));
				$new_height       = round((($percent_resizing/100)*$height));
			 ?>
		   <tr class="<?= $view; ?>_imagen" style="height:<?= $new_height + 10; ?>px;">
				<td>
					<img src="<?php echo $image_url; ?>" width=<?= $new_width; ?> height=<?= $new_height; ?> />
				</td>
		   </tr>
		   <?php endif; ?>

		   <?php if($itoshow == 2 || $itoshow == 3) : ?>
		   <tr class="<?= $view; ?>_text">
				<td><?php echo $title ?></td>
		   </tr>
		   <tr class="<?= $view; ?>_price">
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
<?php
exit;
?>