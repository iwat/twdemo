<div class="index">
	<h2>Tweets</h2>

	<?php
	echo $this->Form->create('Tweet', array('action' => 'post'));
	echo $this->Form->input('message', array('label' => false));
	echo $this->Form->end('Tweet');
	?>

	<?php foreach ($tweets as $tweet): ?>
	<div>
		<div style="padding:1.3em;border: 1px #cccccc solid;">
			<div style="margin-bottom:0.5em;">
				<span style="font-weight:bold;"><?= $tweet['User']['username']; ?></span>
				<span style="float:right"><?php echo $tweet['Tweet']['created']; ?></span>
			</div>
			<div>
				<div><?= $tweet['Tweet']['message']; ?></div>
			</div>
		</div>
	</div>
	<?php endforeach; ?>

	<div class="paging">
		<?= $this->Paginator->prev('<<', array(), null, array('class' => 'disabled'));?> |
		<?= $this->Paginator->numbers(); ?> |
		<?= $this->Paginator->next('>>', array(), null, array('class' => 'disabled')); ?>
	</div>
</div>
<div class="actions">
	<h3>Actions</h3>
	<ul>
		<li><?= $this->Html->link('Following', array('action' => 'following')); ?></li>
		<li><?= $this->Html->link('Followers', array('action' => 'followers')); ?></li>
	</ul>
</div>
