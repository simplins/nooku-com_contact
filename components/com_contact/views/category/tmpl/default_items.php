<? defined( '_JEXEC' ) or die( 'Restricted access' ); ?>

<? $odd = 0; ?>
<? $i = 0; ?>
<? foreach($items as $item) : ?>
<tr class="sectiontableentry<?= $odd + 1; ?>">
	<td align="right" width="5">
		<?= $i + 1; ?>
	</td>
	<td height="20">
		<a href="<?= $item->link; ?>" class="category<?= $pageclass_sfx; ?>">
			<?= $item->name; ?></a>
	</td>
	<?php if ($params->get('show_position')) : ?>
	<td>
		<?= @escape($item->con_position); ?>
	</td>
	<?php endif; ?>
	<?php if ( $params->get( 'show_email' ) ) : ?>
	<td width="20%">
		<?= $item->email_to; ?>
	</td>
	<?php endif; ?>
	<?php if ( $params->get( 'show_telephone' ) ) : ?>
	<td width="15%">
		<?= @escape($item->telephone); ?>
	</td>
	<?php endif; ?>
	<?php if ( $params->get( 'show_mobile' ) ) : ?>
	<td width="15%">
		<?= @escape($item->mobile); ?>
	</td>
	<?php endif; ?>
	<?php if ( $params->get( 'show_fax' ) ) : ?>
	<td width="15%">
		<?= @escape($item->fax); ?>
	</td>
	<?php endif; ?>
</tr>
<? $i++;?>
<? $odd = 1 - $odd; ?>
<?php endforeach; ?>
