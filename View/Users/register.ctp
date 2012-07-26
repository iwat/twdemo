<div class="users form">
<?php echo $this->Form->create('User', array('action' => 'register'));?>
	<fieldset>
		<legend>Register</legend>
	<?phplogin.ctp
		echo $this->Form->input('username');
		echo $this->Form->input('password');<div class="users form">
<?php echo $this->Form->create('User', array('action' => 'register'));?>
	<fieldset>
		<legend>Registers</legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('repassword', array('type' => 'password', 'required' => 'true'));
	?>
	</fieldset>
<?php echo $this->Form->end('Sign up');?>
</div>

		echo $this->Form->input('repassword', array('type' => 'password', 'required' => 'true'));
	?>
	</fieldset>
<?php echo $this->Form->end('Sign up');?>
</div>
