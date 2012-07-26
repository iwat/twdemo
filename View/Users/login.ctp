<div class="form">
	<?php
	echo $this->Form->create('User', array('action' => 'login'));
	echo $this->Form->inputs(array(
		'legend' => 'Login',
		'username',
		'password'
	));
	echo $this->Form->end('Sign in');
	?>
</div>
<div class="actions">
	<h3>Actions</h3>
	<ul>
		<li><?= $this->Html->link('Register', array('action' => 'register')); ?></li>
	</ul>
</div>
