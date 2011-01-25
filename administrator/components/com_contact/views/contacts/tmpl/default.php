<? defined('KOOWA') or die('Restricted access');?>

<?= @helper('behavior.tooltip');?>

<style src="media://com_default/css/admin.css" />

<form action="<?= @route()?>" method="get">
<table class="adminlist"  style="clear: both;">
	<thead>
		<tr>
			<th width="5"><?= @text('Num'); ?></th>
			<th width="5"></th>
			<th>
				<?= @helper('grid.sort', array('column' => 'name')); ?>
			</th>
			<th>
				<?= @helper('grid.sort', array('column' => 'published')); ?>
			</th>
			<th>
				<?= @helper('grid.sort', array('column' => 'ordering')); ?>
			</th>
			<!--
			<th><?= @text('Acess Level'); ?></th>
			<th><?= @text('Category'); ?></th>
			<th><?= @text('Linked to User'); ?></th>
			-->
			<th><?= @helper('grid.sort', array('column' => 'access')); ?></th>
			<th><?= @helper('grid.sort', array('column' => 'category')); ?></th>
			<th><?= @helper('grid.sort', array('column' => 'user')); ?></th>
		</tr>		
		<tr>
			<td></td>
			<td><input type="checkbox" name="toggle" value="" onclick="checkAll(<?= count($contacts); ?>);" /></td>
			<td><?= @template('admin::com.default.view.list.search_form'); ?></td>
			<td align="center"><?= @helper('admin::com.default.template.helper.listbox.enabled', array('name' => 'enabled', 'attribs' => array('onchange' => 'this.form.submit()'))); ?></td>
			<td></td>
			<td></td>
			<td><?= @helper('admin::com.contact.template.helper.listbox.catid', array('name' => 'catid', 'attribs' => array('onchange' => 'this.form.submit()'))); ?></td>
			<td></td>
		</tr>
	</thead>

	<tfoot>
           <tr>
                <td colspan="20">
					 <?= @helper('paginator.pagination', array('total' => $total)) ?>
                </td>
			</tr>
	</tfoot>
		
	<tbody>
	<? $i = 0; $m = 0; ?>
	<? foreach ($contacts as $contact) : ?>
		<tr class="<?= 'row'.$m; ?>">
			<td align="center">
				<?= $i + 1; ?>
			</td>
			<td align="center">
				<?= @helper('grid.checkbox', array('row' => $contact))?>
			</td>				
			<td align="left">
				<span class="editlinktip hasTip" title="<?= @text('Edit Contact');?>::<?= @escape($contact->name); ?>">
					<a href="<?= @route('view=contact&id='.$contact->id); ?>">
	   					<?= @escape($contact->name); ?>
	   				</a>
				</span>
			</td>
			<td align="center">
				<?= @helper('grid.enable', array('row' => $contact)); ?>
            </td>
			<td align="center">
				<?= @helper('grid.order', array('row' => $contact)); ?>
			</td>
			<td align="center">
				<?= @helper('grid.access', array('row' => $contact)) ?>
			</td>
			<td align="left">
				<?=$contact->category; ?>
			</td>
			<td align="left">
				<?=$contact->user; ?>
			</td>
		</tr>
	<? $i = $i + 1; $m = (1 - $m);?>
	<? endforeach; ?>

	<? if (!count($contacts)) : ?>
		<tr>
			<td colspan="20" align="center">
				<?= @text('No Items Found'); ?>
			</td>
		</tr>
	<? endif; ?>	
	</tbody>	
</table>
</form>