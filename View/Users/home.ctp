<div class="index">
	<h2>Tweets></h2>

	<?php foreach ($tweets as $tweet): ?>
	<div>
		<div style="padding:2em;">
			<div>
				<span><?= $tweet['User']['username']; ?></span>
				<span style="float:right"><?php echo $tweet['Tweet']['created']; ?></span>
			</div>
			<div>
				<div><?= $tweet['Tweet']['message']; ?></div>
			</div>
		</div>
	</div>
	<?php endforeach; ?>

	<div class="paging">
		<?= $this->Paginator->prev('<<', array(), null, array('class'=>'disabled'));?> |
		<?= $this->Paginator->numbers(); ?> |
		<?= $this->Paginator->next('>>', array(), null, array('class' => 'disabled')); ?>
	</div>
</div>
