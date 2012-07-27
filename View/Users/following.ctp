<div class="index">
	<h2>Following</h2>
	<?php foreach ($follows as $follow): ?>
		<div style="padding:1.3em;border:1px #ccc solid;">
			@<?= $follow['Following']['username']; ?>
			<?= $this->Html->link('Unfollow', array('action' => 'unfollow', $follow['Following']['id'])); ?>
		</div>
	<?php endforeach; ?>

	<div class="paging">
		<?= $this->Paginator->prev('<<'); ?> |
		<?= $this->Paginator->numbers(); ?> |
		<?= $this->Paginator->next('>>'); ?>
	</div>
</div>
<?= $this->element('Users/actions'); ?>
