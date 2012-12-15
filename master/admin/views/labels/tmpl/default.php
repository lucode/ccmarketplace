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



$ordering = ( ($this->lists['order'] == 'ordering' || $this->lists['order'] == 'id, ordering'));
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

		</tr>

	</table>



	<table class="adminlist" cellspacing="1">

	<thead>

		<tr>
			<th width="5"><?php echo JText::_( 'CCMP_NUM' ); ?></th>

			<th width="5"><input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count( $this->rows ); ?>);" /></th>

			<th class="title" style="text-align: left;"><?php echo JText::_( 'CCMP_NAME' ); ?></th>

			<th width="10"><?php echo JText::_( 'CCMP_PUBLISHED' ); ?></th>

			<th width="120">
        	<?php echo JHTML::_('grid.sort', JText::_('Order'), 'ordering', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
        	<?php echo $ordering ? JHTML::_('grid.order',  $this->rows , 'filesave.png' ) : ''; ?>
			</th>


			<th width="10"><?php echo JText::_( 'ID' ); ?></th>

		</tr>

	</thead>



	<tfoot>

		<tr>

			<td colspan="11">

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

			$link 	= JRoute::_( 'index.php?option=com_ccmarketplace&view=label&task=edit&cid[]='. $row->id );

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

					<span class="editlinktip hasTip" title="<?php echo JText::_( 'CCMP_EDIT_LABEL' );?>::<?php echo $this->escape($row->name); ?>">
						<a href="<?php echo $link; ?>"><?php echo $row->name; ?></a>
					</span>

				</td>


				<td align="center">
					<?php
					echo $published;
					?>
				</td>


				<td class="order" nowrap="nowrap">

					<span>
						<?php
						echo $this->pageNav->orderUpIcon( $i, $row->id == @$rows[$i-1]->id, 'orderup', 'Move Up', $ordering);
						?>
					</span>

					<span>
						<?php
						echo $this->pageNav->orderDownIcon( $i, $n, $row->id == @$rows[$i+1]->id, 'orderdown', 'Move Down', $ordering );
						?>
					</span>

					<?php
					$disabled = $ordering ?  '' : 'disabled="disabled"';
					?>

					<input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" <?php echo $disabled ?> class="text_area" style="text-align: center" />
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
	<input type="hidden" name="controller" value="labels" />
	<input type="hidden" name="view" value="labels" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="task" value="" />

	<?php echo JHTML::_( 'form.token' ); ?>

</form>


