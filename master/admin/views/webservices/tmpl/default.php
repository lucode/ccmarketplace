<?php
/**
 * JE Effective Lead Management System package
 * @author JExtension <contact@jextn.com>
 * @link http://www.jextn.com
 * @copyright (C) 2012 - 2013 JExtension
 * @license GNU/GPL, see LICENSE.php for full license.
**/
// no direct access
defined('_JEXEC') or die('Restricted access');
$ordering = ( ($this->lists['order'] == 'ordering' || $this->lists['order'] == 'parent_id, ordering'));
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

			<th class="title" style="text-align: left;"><?php echo JHTML::_('grid.sort','CCMP_NAME' , 'name', $this->lists['order_Dir'], $this->lists['order'] ); ?></th>

			<th class="title" style="text-align: left;"><?php echo JHTML::_('grid.sort','CCMP_URL' , 'serverurl', $this->lists['order_Dir'], $this->lists['order'] ); ?></th>

			<th class="title" style="text-align: left;"><?php echo JHTML::_('grid.sort','CCMP_WEB_USER' , 'webserver_user', $this->lists['order_Dir'], $this->lists['order'] ); ?></th>

			<th class="title" style="text-align: left;"><?php echo JHTML::_('grid.sort', 'CCMP_WEB_PASSWORD' , 'webserver_password', $this->lists['order_Dir'], $this->lists['order'] ); ?></th>

			<th class="title" style="text-align: left;"><?php echo JHTML::_('grid.sort', 'CCMP_WEB_SHOP_USER', 'shop_user', $this->lists['order_Dir'], $this->lists['order'] ); ?></th>

			<th class="title" style="text-align: left;"><?php echo JHTML::_('grid.sort', 'CCMP_WEB_SHOP_PASSWORD', 'shop_password', $this->lists['order_Dir'], $this->lists['order'] ); ?></th>

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

			$link 	= JRoute::_( 'index.php?option=com_ccmarketplace&view=webservice&task=edit&cid[]='. $row->id );

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

					<span class="editlinktip hasTip" title="<?php echo JText::_( 'CCMP_EDIT_WEBSERVICE' );?>::<?php echo $this->escape($row->serverurl); ?>">
						<a href="<?php echo $link; ?>"><?php echo $row->name; ?></a>
					</span>

				</td>

				<td>
					<?php echo $row->serverurl; ?>
				</td>

				<td>
					<?php
					echo $row->webserver_user;
					?>
				</td>

				<td>
					<?php
					echo $row->webserver_password;
					?>
				</td>

				<td>
					<?php
					echo $row->shop_user;
					?>
				</td>

				<td>
					<?php
					echo $row->shop_password;
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
	<input type="hidden" name="controller" value="webservices" />
	<input type="hidden" name="view" value="webservices" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />

	<?php echo JHTML::_( 'form.token' ); ?>

</form>

