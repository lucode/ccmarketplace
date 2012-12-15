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


$ordering = ( ($this->lists['order'] == 'ordering' || $this->lists['order'] == 'parent_id, ordering'));

// website root directory
$_root = JURI::root();

$image_yes = $_root . "administrator/templates/bluestork/images/admin/tick.png";
$image_no  = $_root . "administrator/templates/bluestork/images/admin/publish_x.png";
?>

<form action="index.php" method="post" name="adminForm">

	<table class="adminform">

		<tr>

			<td width="100%">
			  	<?php echo JText::_( 'SEARCH' ); ?>
				<input type="text" name="search" id="search" value="<?php echo $this->lists['search']; ?>" class="text_area" onChange="document.adminForm.submit();" />
				<button onclick="this.form.submit();"><?php echo JText::_( 'GO' ); ?></button>
				<button onclick="this.form.getElementById('search').value='';this.form.submit();"><?php echo JText::_( 'RESET' ); ?></button>
			</td>

			<td nowrap="nowrap">
			  <?php
			  echo $this->lists['state'];
				?>
			</td>

		</tr>

	</table>



	<table class="adminlist" cellspacing="1">

	<thead>

		<tr>
			<th width="5"><?php echo JText::_( 'CCMP_NUM' ); ?></th>

			<th width="5"><input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count( $this->rows ); ?>);" /></th>

			<th class="title" style="text-align: left;"><?php echo JText::_( 'CCMP_ENTRY' ); ?></th>

			<th class="title" style="text-align: left;"><?php echo JText::_( 'CCMP_CATEGORY' ); ?></th>

			<th class="title" style="text-align: left;"><?php echo JText::_( 'CCMP_USERNAME' ); ?></th>

			<th width="1%" nowrap="nowrap"><?php echo JText::_( 'CCMP_TOP' ); ?></th>
			<th width="1%" nowrap="nowrap"><?php echo JText::_( 'CCMP_FEATURED' ); ?></th>
			<th width="1%" nowrap="nowrap"><?php echo JText::_( 'CCMP_COMMERCIAL' ); ?></th>

			<th width="1%" nowrap="nowrap"><?php echo JText::_( 'CCMP_PUBLISHED' ); ?></th>

			<th width="1%" nowrap="nowrap"><?php echo JHTML::_('grid.sort', 'ID', 'id', $this->lists['order_Dir'], $this->lists['order'] ); ?></th>
		</tr>

	</thead>



	<tfoot>

		<tr>

			<td colspan="10">

				<?php echo $this->pageNav->getListFooter(); ?>

			</td>

		</tr>

	</tfoot>



	<tbody>

		<?php

		$k = 0;
		$i = 0;
		$n = count( $this->rows );

		$rows = &$this->rows;

		foreach ( $rows as $row) {

			$id = JHTML::_('grid.id', $i, $row->id);
			$published = JHTML::_('grid.published', $row, $i);

			$link 	= JRoute::_( 'index.php?option=com_ccmarketplace&view=entry&task=edit&cid[]='. $row->id );

			?>

			<tr class="<?php echo "row$k"; ?>">

				<td>
					<?php
					echo $i + 1 + $this->pageNav->limitstart;
					?>
				</td>

				<td>
					<?php
					echo $id;
					?>
				</td>

				<td>
					<span class="editlinktip hasTip" title="<?php echo JText::_( 'CCMP_EDIT_ENTRY' );?>::<?php echo $this->escape($row->headline); ?>">
						<a href="<?php echo $link; ?>"><?php echo $row->headline; ?></a>
					</span>
				</td>

				<td>
					<?php
					$category = $cHelper->getCategoryById( $row->category_id);
					echo $this->escape( $category);
					?>
				</td>

				<td>
					<?php
					$username = $cHelper->getUsernameById( $row->user_id);
					echo $this->escape( $username);
					?>
				</td>


				<td align="center">
					<?php
					if ( $row->flag_top) {
                        echo "<img src='" . $image_yes . "' width='16' height='16' border='0' />";
					}
					else {
                        echo "<img src='" . $image_no . "' width='16' height='16' border='0' />";
					}
					?>
				</td>

				<td align="center">
					<?php
					if ( $row->flag_featured) {
                        echo "<img src='" . $image_yes . "' width='16' height='16' border='0' />";
					}
					else {
                        echo "<img src='" . $image_no . "' width='16' height='16' border='0' />";
					}
					?>
				</td>

				<td align="center">
					<?php
					if ( $row->flag_commercial) {
                        echo "<img src='" . $image_yes . "' width='16' height='16' border='0' />";
					}
					else {
                        echo "<img src='" . $image_no . "' width='16' height='16' border='0' />";
					}
					?>
				</td>

				<td align="center">
					<?php
					echo $published;
					?>
				</td>

				<td align="center">
					<?php
					echo $row->id;
					?>
				</td>

			</tr>

			<?php
			$k = 1 - $k;
			$i++;

		}
		?>

	</tbody>

	</table>

	<input type="hidden" name="option" value="com_ccmarketplace" />
	<input type="hidden" name="controller" value="entries" />
	<input type="hidden" name="view" value="entries" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="task" value="" />

	<?php echo JHTML::_( 'form.token' ); ?>

</form>


