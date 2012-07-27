<div class="form">
	<?php
	if (isset($fileURL)) echo '<p>', $this->Html->link($fileURL), '</p>';
	if (isset($blobURL)) echo '<p>', $this->Html->link($blobURL), '</p>';

	echo $this->Form->create('Demo', array('type' => 'file'));
	echo $this->Form->input('file1', array('type' => 'file'));
	echo $this->Form->end('Upload');
	?>
</div>
