<div class="homes index">
	<h2><?php echo 'Tweets'?></h2>
	<?php foreach ($tweets as $tweet): ?>
		<div style="padding:1.3em;border: 1px #cccccc solid;">
			<div style="margin-bottom:0.5em;">
				<span><?php echo $tweet['User']['username']; ?></span>
				<span style="float:right"><?php echo $tweet['Tweet']['created']; ?></span>
			</div>
			<div>
				<div><?php echo $tweet['Tweet']['message']; ?></div>
			</div>
		</div>
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
