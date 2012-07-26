<div class="users form">
	<?php
	echo $this->Form->create('User', array('action' => 'register'));
	echo $this->Form->inputs(array(
		'legend' => 'Register',
		'username',
		'password',
		'repassword' => array('type' => 'password', 'required' => true)
	));
	echo $this->Form->end('Sign up');
	?>
</div>
