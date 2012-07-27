<div class="index">
	<h2>Tweets</h2>

	<?php
	echo $this->Form->create('Tweet', array('action' => 'post'));
	echo $this->Form->input('message', array('label' => false));
	echo $this->Form->end('Tweet');
	?>

	<?php foreach ($tweets as $tweet): ?>
	<div>
		<div style="padding:1.3em;border:1px #ccc solid;">
			<div style="margin-bottom:0.5em;">
				<span>@<?= $tweet['User']['username']; ?></span>
				<span style="float:right"><?= $this->Time->niceShort($tweet['Tweet']['created']); ?></span>
			</div>
			<div>
				<div><?= $tweet['Tweet']['message']; ?></div>
			</div>
		</div>
	</div>
	<?php endforeach; ?>

	<div class="paging">
		<?= $this->Paginator->prev('<<'); ?> |
		<?= $this->Paginator->numbers(); ?> |
		<?= $this->Paginator->next('>>'); ?>
	</div>
</div>
<?= $this->element('Users/actions'); ?>
