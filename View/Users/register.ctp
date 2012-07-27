<div class="form">
	<?php
	echo $this->Form->create('User', array('action' => 'register'));
	echo $this->Form->inputs(array(
		'legend' => 'Register',
		'username' => array('autocomplete' => 'off'),
		'password' => array('autocomplete' => 'off'),
		'repassword' => array('type' => 'password', 'required' => true)
	));
	echo $this->Form->end('Sign up');
	?>
</div>
<div class="actions">
	<h3>Actions</h3>
	<ul>
		<li><?= $this->Html->link('Login', array('action' => 'login')); ?></li>
	</ul>
</div>
