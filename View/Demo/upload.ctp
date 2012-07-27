<div class="form">
	<?php
	echo $this->Form->create('Demo', array('type' => 'file'));
	echo $this->Form->input('file1', array('type' => 'file'));
	echo $this->Form->end('Upload');
	?>
</div>
