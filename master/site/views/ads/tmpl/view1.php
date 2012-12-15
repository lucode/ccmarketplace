<?php
/**
*
* CCMarketplace - Classified Ads for Joomla!
*
* @package		Marketplace
* @subpackage		Frontend (View1)
* @author		Lucas Huber
* @version		New Layout 12-12-07  
*
*/

defined('_JEXEC') or die('Restricted access');
JHTML::_('stylesheet', 'ccmarketplace.css', 'components/com_ccmarketplace/assets/');

$option   = @$_GET['option'];
$view     = @$_GET['view'];
$layout   = @$_GET['layout'];
$id       = @$_GET['id'];
$Itemid   = @$_GET['Itemid'];

$memberFields  = $this->filters['memberFields'];
$adFields      = $this->filters['adFields'];

$s_memberfield = JRequest::getvar('memberFields');
$s_adfield     = JRequest::getvar('adFields');
$other_search  = JRequest::getvar('other_search');
//echo "<Pre>"; print_r($s_memberfield); echo "</Pre>"; //print_r($s_adfield); print_r($other_search); echo "</Pre>"; //exit;  page_title
?>
<div class="ads_views_div">  <!--Div for whole view-->
<?php
if( count($this->menu_params) ) {
	if( $this->menu_params->get('show_page_heading','1') ) {
		echo "<h2>".$this->menu_params->get('page_heading')."</h2>";
	}
}
?>
<!-- ********** BEGIN search form row1 ************** -->
<form action="" method="post">
<div id="ccmarketplace_search">
<table id="ccmarketplace_vsearch">
	<tbody>
		<tr>
			<td> <?php echo JText::_("CCMP_SEARCH") ?> </td>			
			<td><input type="text" id="keywords_view2" value="<?php if(!empty($other_search['keywords'])){echo $other_search['keywords'];}?>"	name="keywords"/>		
			</td>
			<td style="text-align: right;">
			<input type="submit" value="<?php echo JText::_("CCMP_SEARCH"); ?>" class="button"/>
      <!-- ********** PDF Button  **************  -->
			<?php if($this->menu_params->get('show_pdf_button','1')) : 
          $chid = JRequest::getInt('id');
          $PDFurl =  $this->model->getPDFurl($chid); ?> 
			<a href=<?php echo $PDFurl?> target="_blank" title=<?php echo JText::_("CCMP_CREATE_PDF") ?> >
			<?php echo "&nbsp;&nbsp;"."<img src='" . $_root . "/components/com_ccmarketplace/assets/icons/pdf_48.png' align='right' />"; ?>  
			<?php endif; ?>	
			</td>
		</tr>
		<tr><!-- ********** BEGIN row2 search category /  GroupFiltre ************** -->
			<?php if($this->menu_params->get('show_category','1')) :  ?>
			<td> <?php echo JText::_("CCMP_CATEGORY") ?> </td>
			<td>
			    <select name="caid" >
					<option value="">
						   <?php echo JText::_("CCMP_ALL_CATEGORIES"); ?>
					</option>
					<?php echo $this->options; ?>
				</select>
			</td>
			<?php endif; ?>  
			<?php if($this->menu_params->get('show_organisation','1')) :  ?>
			 
			<td style="text-align: right;"> <?php echo JText::_("CCMP_ORGANISATION_SEL")."&nbsp;&nbsp;" ?> <?php echo $this->o_filter; ?> </td> 
			<?php endif; ?>      
		</tr>
	</tbody>
</table>

<?php if($this->menu_params->get('show_memberfields','1')) :  ?> 
<table id="memberFields"> 
	<tbody><!-- ********** BEGIN row3 search along member fields (membership, state, area) ************** --> 
		<tr><!-- ** You have to define member fields in Cyclos as "For Ads Search Member **--> 
				
					<?php
					//echo "<Pre>"; print_r($memberFields); /*print_r($adFields);*/ echo "</Pre>"; exit;
					foreach($memberFields as $field) {
						$show     = 1;
						$selected_yes = 0;
						if($field->internalName == "area") {
							$show = $this->menu_params->get('show_memberfields','1');
						}

						if($show) :
					?>
					<td style="text-align: right;"><?php echo $field->displayName ?></td>          
					<td <?php echo $field->displayName ?>>    
				<!--	<td <?php echo $field->displayName == "Region" ? 'align="right"' : ""; ?>>  -->
             	<input type="hidden" name="memberFieldIds[]" value="<?php echo $field->internalName ?>" />
						<?php
						$s_mf  = $s_memberfield[$field->internalName];
							if ($field->type == "ENUMERATED") {
									$possibleValues = $field->possibleValues;
								?>
								<select name="memberFieldValues[]">
								<?php
								echo "<option value=\"\">".JText::_( 'CCMP_ANY' )."</option>";
								$n = 0;
								foreach ($possibleValues as $value) {
									if (count($s_mf)) {
										if($field->internalName == $s_mf->internalName && $value->id == $s_mf->value ) {
											$selected = "selected = 'selected'";
											$selected_yes = 1;
										}
										else  {
											$selected = "";
										}
									} else {
										$selected = "";
									}

									if (empty($selected_yes) && ($field->internalName == "area") && ($n == (count($possibleValues) - 1 )))
										$selected = "selected = 'selected'";
								?>
									<option value="<?php echo $value->id ?>" <?php echo $selected ?> > <?php echo $value->value ?> </option>
								<?php  $n += 1; } ?>
								</select>
						<?php } else { ?>
								<?php
									$value = "";
									if($field->internalName == $s_mf->internalName) $value = $s_mf->value;
								?>
								<input type="text" name="memberFieldValues[]" value="<?php echo $value ?>" />
						<?php } ?>
					</td>
					  <?php endif; }  ?>
		</tr>  
	</tbody>
</table>
<?php endif; ?>

<table id="ccmarketplace_vsearch"> <!--	 ********** BEGIN row4 search along ads fields (Tradetype, Adstype) plus Ads Counter  **************  -->
			<tr>
				<? if($this->menu_params->get('show_tradetype','1')) : ?>
					<td style="text-align: right;"> <?php echo JText::_("CCMP_TYPE_OF_TRADE")."&nbsp;" ?> </td>
					<td>
						<?php
							$type_of_trade = array(
								JHTML::_('select.option', ''      , JText::_( 'CCMP_ANY' )),
								JHTML::_('select.option', 'OFFER' , JText::_('CCMP_OFFER')),
								JHTML::_('select.option', 'SEARCH', JText::_('CCMP_SEARCH')),
								JHTML::_('select.option', 'BOTH'  , JText::_('CCMP_BOTH')),
							);
							echo JHTML::_( 'select.genericlist', $type_of_trade, 'type_of_trade', '' ,'value','text', $other_search['type_of_trade'] );
						?>
					</td>
				<?php endif;
				if($this->menu_params->get('show_adstype','1')) : ?>
					<td  style="text-align: right;"> <?php echo JText::_("CCMP_TYPE_OF_AD")."&nbsp;"?> </td>
					<td align="right">
						<input type="hidden" name="adFieldIds[]" value="adstype" />
							<?php
								$field          = $this->fieldsService->possibleValuesForAdField(array('name' => 'adstype'));
								$possibleValues = $field->return;
							?>
							<select name="adFieldValues[]">
								<option value=""><?= JText::_( 'CCMP_ANY' ) ?></option>
							<?php  foreach ($possibleValues as $value) {
								$selected = "";
								if("adstype" == $s_adfield[0]->internalName && $value->id == $s_adfield[0]->value )
								$selected = "selected = 'selected'";
							?>
								<option value="<?php echo $value->id ?>" <?php echo $selected ?> > <?php echo $value->value ?> </option>
							<?php } ?>
							</select>
					</td>
				<?php endif; ?>

  <!-- ********** BEGIN form actions for ads ************** -->
	<input type="hidden" name="search" value="1" />
	<input type="hidden" name="option" value="<?php echo $_REQUEST['option'] ?>">
	<input type="hidden" name="view" value="<?php echo $_REQUEST['view'] ?>">
	<input type="hidden" name="layout" value="<?php echo $_REQUEST['layout'] ?>">
	<input type="hidden" name="id" value="<?php echo $_REQUEST['id'] ?>">
	<input type="hidden" name="Itemid" value="<?php echo $_REQUEST['Itemid'] ?>">
  </div>
</form>
  <!-- ********** BEGIN form actions for Mailbutton ************** --> 
<form action="" name="smail" method="post">
	<input type="hidden" name="mailid" value="" />
	<input type="hidden" name="mailsubject" value="" />
	<input type="hidden" name="task" value="set_mail" />
	<input type="hidden" name="option" value="<?php echo $_REQUEST['option'] ?>">
	<input type="hidden" name="view" value="mail">
	<input type="hidden" name="id" value="<?php echo $_REQUEST['id'] ?>">
	<input type="hidden" name="Itemid" value="<?php echo $_REQUEST['Itemid'] ?>">
</form>
  <!-- ********** BEGIN form actions for counter ************** -->        
<form action="" name="filter_os" method="post">
	<input type="hidden" name="ex_type_of_trade" value=""/>
	<input type="hidden" name="ex_search" value="2" />
	<input type="hidden" name="option" value="<?php echo $_REQUEST['option'] ?>">
	<input type="hidden" name="view" value="<?php echo $_REQUEST['view'] ?>">
	<input type="hidden" name="layout" value="<?php echo $_REQUEST['layout'] ?>">
	<input type="hidden" name="id" value="<?php echo $_REQUEST['id'] ?>">
	<input type="hidden" name="Itemid" value="<?php echo $_REQUEST['Itemid'] ?>">
</form>        
<?php
$data				= $this->data;
$actualCategory 	= $data['actualCategory'];
if (!empty($actualCategory) && !empty($actualCategory->children)) {
	//$actualCategory_childrens = $actualCategory->children;
	$actualCategory_childrens = array();
}
$page               = $data['page'];
$ads        		= $page->ads;
$count_os			= $page->count_os;
$currentPage 	    = $page->currentPage;
$cyclos_server_root = $page->cyclos_server_root;
$id                 = JRequest::getInt('id');
 if(!empty($ads)){
 ?>        
     <!-- ********** BEGIN  Ads Counter ************** -->
	  <td text-align="right">
      <!--   <div class="view1_contmain">    -->
      <div style="text-align:right"><?php echo "<a id=\"filter_os\"  href=\"javascript:document.forms['filter_os'].ex_type_of_trade.value='OFFER';document.forms['filter_os'].submit()\">".JText::_("CCMP_OFFERS")."(".$count_os['offer'].")</a>&nbsp;/&nbsp;<a id=\"filter_os\" href=\"javascript:document.forms['filter_os'].ex_type_of_trade.value='SEARCH';document.forms['filter_os'].submit()\">".JText::_("CCMP_SEARCHES")."(".$count_os['search'].")</a>"; ?></div>
	  </td>
	</tr>
</tbody>		
</table>

  
  <table class="view1">
  <?php    // ********** BEGIN  displaying of the content (ads)  ************** -->
 $i = 0;
 foreach ($ads as $ad) {
    $title                = $ad->title;
    $desc                 = $ad->description;
    $images               = $this->model->ensure_array($ad->images);
    $groupFiId            = $ad->owner->groupFilterIds;
    $no_picture_thumbnail = $cyclos_server_root."/systemImage?image=noPicture&thumbnail=true";
    $image_url            = empty($images) ? $no_picture_thumbnail : $images[0]->thumbnailUrl;

    $price=(!empty($ad->formattedPrice))?'<span>'.$ad->formattedPrice.'</span>':'';
?>
       <tr> <td>
			<table class="view1_inner">
				<tr>
					<td id="ccmp_view1_title" colspan="3" onclick="self.location='index.php?option=com_ccmarketplace&view=ads&layout=default_detailview3&adid=<?php echo $ad->id;?>&menu_id=<?php echo $this->active_mid; ?>&id=<?php echo $id;?>&shse=n'">
						<?php echo $title ?>
					</td>
				</tr>
				<tr>
					<td width="78%" valign="top" colspan="2"> <div id="max_div"> <?php echo $desc ?> </div></td>
					<td align="center" valign="top"> <div id="img_div"> <img src="<?php echo $image_url; ?>" /> </div> </td>
				</tr>
				<tr>
					<td width="40">
					<?php /*echo "<Pre>"; print_r($ad->owner); echo "</Pre>"; /* if($this->mem_options->mp != 1 ) : /*groupId*/ ?>
					<a href='index.php?option=com_ccmarketplace&view=ads&layout=default_member&id=<?php echo $id;?>&meid=<?php echo $ad->owner->id;?>'><?php echo $ad->owner->username; ?></a>
					<?php
					/*else :
						echo '<p id="mem_d_v">'.JText::_('CCMP_MEMBER_DISABLE').'</p>';
					endif;*/
					?>
					</td>  <!-- ********** BEGIN  Show Organisation when enabled and Area always ************** -->
					<td width="40" align="left"> 
						<?php if($this->menu_params->get('show_organisation','1')) : 
             //  echo "Organisation id" . ($ad->owner->groupId) . " / ";
						if($this->mem_options->org) {
								$gid = explode(",",$this->mem_options->org);
						  	} else {
								$gid = null;
						  	}  
							if(count($gid) != 1) {
						//		echo $this->model->getOrganisation($ad->owner->groupId);
						  	}
                echo $groupFiId;
             endif;  ?>
         <!--   <?php echo "AREA of owner ID" . $ad->owner->id;?> -->
					</td>
					<td align="right" width="20" id="mail_date">
						<input type="hidden" id="mail" value="<?= $ad->owner->email ?>">
						<input type="hidden" id="mails" value="<?= $title ?>">
						<div><?php $time = strtotime($ad->publicationStart); echo JText::_("CCMP_FROM").'&nbsp:&nbsp'.date('d.m.Y', $time);
						echo "</div><div class=\"send_mail\" onclick=\"javascript:document.forms['smail'].mailid.value=document.getElementById('mail').value;document.forms['smail'].mailsubject.value=document.getElementById('mails').value;document.forms['smail'].submit()\"></div>";
						?>
					</td>

				</tr>
			 </table>
      </td> </tr>
 <?php
	$empty_ads[] = 0;
	$i += 1;
 }?>
</table>
</div>

<br style="clear:both"/>
 <?php
 } else {
 ?>   
 <!-- ********** subcategories TBD ****** -->
		<table class="ccmarketplace_subcategories">
			<?php
			$i = 0;
			foreach ($actualCategory_childrens as $subCategory) {
				if ($i % 2 == 0) {
					echo "<tr>";
				}
			?>
				<td>
					<a href="index.php?shty=a&option=<?php echo $option?>&view=<?php echo $view?>&id=<?php echo $id?>&Itemid=<?php echo $Itemid?>&caid=<?php echo trim($subCategory->id); ?>">
						<?php echo $subCategory->name; ?>
					</a>
					<?php if($subCategory->countOffer != 0) { ?>
						<span> <?php echo " (" . $subCategory->countOffer . ")";?></span>
					<?php } ?>
				</td>
				<?php
				if ($i % 2 == 1) {
					echo "</tr>";
				}
				$i++;
			}
			?>
		</table>  <!-- ********** BEGIN  No Ads Statement and Page Counter ************** -->
		<p id="ccmarketplace_noads">
			<?php echo JText::_("CCMP_NO_ADS"); ?>
		</p>
		<div style="text-align:right">
			<a href="JavaScript:(history.go(-1))" id="ccmarketplace_back">
			   <?php echo JText::_("CCMP_BACK"); ?>
			</a>
		</div>
	<?php
	}
$totalcount = $page->totalCount;
?>
<div class="ccmarketplace_pag">
<?php
$category    = @$_REQUEST['caid'];
$keywords    = @$_REQUEST['keywords'];

?>
<!-- ********** Here the Form Input? starts ************** -->
<form name="pager" method="post" action="">
	<input type="hidden" name="option" value="<?php echo $_REQUEST['option'] ?>">
	<input type="hidden" name="view" value="<?php echo $_REQUEST['view'] ?>">
	<input type="hidden" name="layout" value="<?php echo $_REQUEST['layout'] ?>">
	<input type="hidden" name="id" value="<?php echo $_REQUEST['id'] ?>">
	<input type="hidden" name="caid" value="<?php echo $_REQUEST['caid'] ?>">
	<input type="hidden" name="curp" value="<?php echo $_REQUEST['curp'] ?>">
	<input type="hidden" name="organisation" value="<?php echo $_REQUEST['organisation'] ?>">
	<input type="hidden" name="keywords" value="<?php echo $_REQUEST['keywords'] ?>">
	<input type="hidden" name="Itemid" value="<?php echo $_REQUEST['Itemid'] ?>">
	<?php if($selected) {
		echo '<input type="hidden" name="search" value="1" />';
		foreach($s_memberfield as $s_mf) {
			echo '<input type="hidden" name="memberFieldIds[]" value="'.$s_mf->field .'" />';
			echo '<input type="hidden" name="memberFieldValues[]" value="'.$s_mf->value .'" />';
		}
		foreach($s_adfield as $s_af) {
			echo '<input type="hidden" name="adFieldIds[]" value="'.$s_af->field.'" />';
			echo '<input type="hidden" name="adFieldValues[]" value="'.$s_af->value .'" />';
		}
	}

	$ex_tot = JRequest::getvar("ex_type_of_trade");
	if($ex_tot) {
		echo '<input type="hidden" name="ex_search" value="2" />';
		echo '<input type="hidden" name="ex_type_of_trade" value="'.$ex_tot.'"/>';
	}
	?>
</form>
<?php
	$total_pages = round($totalcount / $page->size);
	if($total_pages > 1) {
		echo "<ul id='cyclos_pagination'>";
		for($i = 0; $i < $total_pages; $i++) {
			$pag = $i + 1;
			if($currentPage == $i) {
				$class="ccmp_pag_active";
			} else {
				$class="ccmp_pag_inactive";
			}
			echo "<li><a class=\"".$class."\" href=\"javascript:document.forms['pager'].curp.value=".$i.";document.forms['pager'].submit()\">".$pag."</a></li>";
		}
		echo "</ul>";
	}
?>
</div>
</div>
