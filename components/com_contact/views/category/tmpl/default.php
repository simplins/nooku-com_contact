<? defined( '_JEXEC' ) or die( 'Restricted access' ); ?>

<? $pageclass_sfx = @escape($params->get('pageclass_sfx')); ?>

<? if ($params->get('show_page_title', 1)): ?>
	<div class="componentheading<?= $pageclass_sfx; ?>">
		<?= @escape($params->get('page_title')); ?>
	</div>
<? endif; ?>

<div class="contentpane<?= $pageclass_sfx; ?>">
	<? /* ?>
	<? if ($category->image OR $category->description): ?>
		<div class="contentdescription<?= $pageclass_sfx; ?>">
			<? if ($params->get('image') != -1 AND $params->get('image') != "" ): ?>

			<? elseif ($category->image): ?>

			<? endif; ?>
		</div>
	<? endif; ?>
	<? */ ?>
	<form action="<?= @route();?>" method="get" name="adminForm">
	<table>
		<thead>
			<tr>
				<td align="right" colspan="6">
					<? if ($params->get('show_limit')): ?>
						<?= @text('Display Num').'&nbsp;'; ?>
						<?= @helper('paginator.limit', array('attribs' => array('onchange' => 'this.form.submit()'))); ?>
					<? endif; ?>
				</td>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td align="center" colspan="6" class="sectiontablefooter<?= @escape($pageclass_sfx); ?>">
					<?//= @helper('paginator.pageslinks'); ?>
					<?= KFactory::tmp('site::com.contact.template.helper.paginator')->pageslinks(); ?>
				</td>
			</tr>
			<tr>
				<td colspan="6" align="right">
					<?//= @helper('paginator.pagescounter'); ?>
					<?= KFactory::tmp('site::com.contact.template.helper.paginator')->pagescounter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>
			<? if ($params->get('show_headings')): ?>
				<tr>
					<td width="5" align="right" class="sectiontableheader<?= $pageclass_sfx; ?>">
						<?= @text('Num'); ?>
					</td>
					<td class="sectiontableheader<?= $pageclass_sfx; ?>">
						<?= @helper('grid.sort', array('column' => 'name')); ?>
					</td>
					<? if ($params->get('show_position')): ?>
					<td class="sectiontableheader<?= $pageclass_sfx; ?>">
						<?= @helper('grid.sort', array('column' => 'position')); ?>
					</td>
					<? endif; ?>
					<? if ($params->get('show_email')): ?>
					<td width="20%" class="sectiontableheader<?= $pageclass_sfx; ?>">
						<?= @text('Email'); ?>
					</td>
					<? endif; ?>
					<? if ($params->get('show_telephone')): ?>
					<td width="15%" class="sectiontableheader<?= $pageclass_sfx; ?>">
						<?= @text('Phone'); ?>
					</td>
					<? endif; ?>
					<? if ($params->get('show_mobile')): ?>
					<td width="15%" class="sectiontableheader<?= $pageclass_sfx; ?>">
						<?= @text('Mobile'); ?>
					</td>
					<? endif; ?>
					<? if ($params->get('show_fax')): ?>
					<td class="sectiontableheader<?= $pageclass_sfx; ?>">
						<?= @text('Fax'); ?>
					</td>
					<? endif; ?>
				</tr>
			<? endif; ?>

			<?= @template('default_items'); ?>
		</tbody>
	</table>

	<input type="hidden" name="option" value="com_contact" />
	<!--
	<input type="hidden" name="catid" value="" />
	<input type="hidden" name="filter_order" value="" />
	<input type="hidden" name="filter_order_Dir" value="" />
	-->
		<input type="hidden" name="viewcache" value="0" />
	</form>
</div>