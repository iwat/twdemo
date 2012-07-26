<div class="follows index">
	<h2><?php echo 'Following'?></h2>
	<?php foreach ($follows as $follow): ?>
		<div style="padding:1.3em;border: 1px #cccccc solid;"><?php echo $follow['Following']['username']; ?></div>
<?php endforeach; ?>

	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => 'Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%'
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . 'previous', array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next('next' . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
