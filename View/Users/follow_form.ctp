<div class="form">
	<h2>Follow</h2>
	<?php
	echo $this->Form->create('User', array('action' => 'followForm'));
	echo $this->Form->input('username');
	echo $this->Form->end('Follow');
	?>
</div>
<?= $this->element('Users/actions'); ?>
