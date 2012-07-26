<div class="homes index">
	<h2><?php echo 'Branches'?></h2>
	<table cellpadding="0" cellspacing="0">
	<?php
	$i = 0;
	
	foreach ($homes as $home):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $home['Branch']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($branch['Shop']['title_en'], array('controller' => 'shops', 'action' => 'view', $branch['Shop']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($branch['Province']['title_en'], array('controller' => 'provinces', 'action' => 'view', $branch['Province']['id'])); ?>
		</td>
		<td><?php echo $branch['Branch']['title_th']; ?>&nbsp;</td>
		<td><?php echo $branch['Branch']['title_en']; ?>&nbsp;</td>

	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
