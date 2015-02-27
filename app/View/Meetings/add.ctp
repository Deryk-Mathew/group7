<div class="notes form">
<?php echo $this->Form->create('Add New Appointment'); ?>
	<fieldset>
	<?php
		echo $this->Form->input('body');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

