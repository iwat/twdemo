<div class="index">
	<h2>Followers</h2>
	<?php foreach ($follows as $follow): ?>
		<div style="padding:1.3em;border: 1px #cccccc solid;"><?= $follow['User']['username']; ?></div>
	<?php endforeach; ?>

	<div class="paging">
		<?= $this->Paginator->prev('<<', array(), null, array('class' => 'disabled')); ?> |
		<?= $this->Paginator->numbers(); ?> |
		<?= $this->Paginator->next('>>', array(), null, array('class' => 'disabled')); ?>
	</div>
</div>
<?= $this->element('Users/actions'); ?>
