<?php // no direct access
/**
*
* CCMarketplace - Classified Ads for Joomla!
*
* @package		CCMarketplace
* @subpackage	Frontend (Search Member Result View)
* @author		Lucas Huber
* @version		 
*
*/

defined('_JEXEC') or die('Restricted access');
JHTML::_('stylesheet', 'ccmarketplace.css', 'components/com_ccmarketplace/assets/');

$data	                = $this->data;
$members                = $data['data']->members;
$cyclos_server_root 	= $this->data['cyclos_server_root'];
$no_picture_thumbnail   = $cyclos_server_root."/systemImage?image=noPicture&thumbnail=true";
$even                   = true;
$Itemid                 = JRequest::getInt('Itemid');
$id                     = JRequest::getInt('id');
?>

<div class="ccmarketplace_member">
<form action="index.php" method="get">
	<div id="ccmarketplace_search">
		<input type="hidden" name="option" value="<?php echo $_REQUEST['option'] ?>">
		<input type="hidden" name="view" value="<?php echo $_REQUEST['view'] ?>">
		<input type="hidden" name="layout" value="<?php echo $_REQUEST['layout'] ?>">
		<input type="hidden" name="id" value="<?php echo $_REQUEST['id'] ?>">
		<input type="text" id="keywords" value="<?php if(!empty($_REQUEST['keywords'])){echo $_REQUEST['keywords'];}?>"	name="keywords"/>
		<!--<input type="hidden" name="sety" value="a" />
		<input type="hidden" name="shty" value="a" />-->
		<input type="hidden" name="Itemid" value="<?php echo $_REQUEST['Itemid'] ?>">
		<input type="submit" value="<?php echo JText::_("CCMP_SEARCH"); ?>" class="button"/>
  </div>
</form>

<?php
if (count($members)) {
	if($this->options->mp != 1 ) {
?>
<table class="memberlistTable" cellspacing="0">
<?php
//$image = empty($images) ? null : $images[0];
foreach($members as $member) {
    #Retrieve the member images
    $images = $this->model->ensure_array($member->images);
    #Get the first image in the array, or the no picture logo if the array is empty
	foreach ($this->model->ensure_array($member->fields->entry) as $field) {
        $fields[$field->key] = $field->value;
	}
	$image_url = empty($images) ? $no_picture_thumbnail : $images[0]->thumbnailUrl; ?>
		<tr class="member_<?php echo $even ? 'evenRow' : 'oddRow' ?>" style="border:1px solid #DDDDDD;">
        	<td align="center" class="member_thumb" onclick="self.location='index.php?option=com_ccmarketplace&view=ads&layout=default_member&id=<?php echo $id?>&meid=<?php echo $member->id;?>'">
            		<img border="0" src="<?php echo $image_url ?>">
            </td>
            <td align="left" id="member_righttext" style="border-top:1px solid #DDDDDD;">
            	<span id="member_user_link" onclick="self.location='index.php?option=com_ccmarketplace&view=ads&layout=default_member&id=<?php echo $id?>&meid=<?php echo $member->id;?>'">
                	<?php echo  JString::substr($member->name,0, 100) ?>
                </span>
				<br>
				<?php
					echo "<span id=\"member_spantext\">".JText::_("CCMP_MEMBER_USER")."</span>&nbsp;&nbsp;&nbsp;:&nbsp;".$member->username."<br>";
				    if($this->options->mail) {
						echo "<span id=\"member_spantext\">".JText::_("CCMP_MEMBER_EMAIL")."</span>&nbsp;:&nbsp;".$member->email;
					}
				?>
                <br>
            </td>
        </tr>
<?php
        $even = !$even;
} ?>

</table>
<br>
<?php
	} else {
		echo '<p id="ccmarketplace_noads">'.JText::_('CCMP_MEMBER_DISABLE').'</p>';
	}
} else {
?>
	<p id="ccmarketplace_noads">
		<?php echo JText::_("CCMP_NO_MEMBER"); ?>
	</p>
<?php
}

if($this->options->mp != 1 ) {
?>
<div style="text-align:center;color:red;font-weight:bold;font-family:arial;font-size:12px;">
<?php
$page = $this->data['data'];
//echo "<Pre>"; print_r($page); exit;

$category = $_REQUEST['caid'];
$keywords = $_REQUEST['keywords'];
?>
<form name="pager" method="get" action="index.php">
  <input type="hidden" name="option" value="<?php echo $_REQUEST['option'] ?>">
  <input type="hidden" name="view" value="<?php echo $_REQUEST['view'] ?>">
  <input type="hidden" name="layout" value="<?php echo $_REQUEST['layout'] ?>">
  <input type="hidden" name="id" value="<?php echo $_REQUEST['id'] ?>">
  <input type="hidden" name="curp" value="<?php echo $_REQUEST['curp'] ?>">
  <input type="hidden" name="keywords" value="<?php echo $_REQUEST['keywords'] ?>">
  <input type="hidden" name="Itemid" value="<?php echo $_REQUEST['Itemid'] ?>">

</form>
<?php
	$totalcount  = $page->totalCount;
	$total_pages = round($totalcount / $page->size);
	$currentPage = $page->currentPage;
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
<?php } ?>
</div>
