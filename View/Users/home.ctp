<div class="homes index">
	<h2><?php echo 'Tweets'?></h2>
	<?php
	$i = 0;

	foreach ($tweets as $tweet):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<div <?php echo $class;?>>
		<div style="padding:2em;">
			<div>
				<span><?php echo $tweet['User']['username']; ?></span>
				<span style="float:right"><?php echo $tweet['Tweet']['created']; ?></span>
			</div>
			<div>
				<div><?php echo $tweet['Tweet']['message']; ?></div>
			</div>

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
