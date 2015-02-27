<div class="notes form">
<?php echo $this->Form->create('Add New Appointment'); ?>
	<fieldset>
	<?php
		echo $this->Form->input('client_id');
		echo $this->Form->input('time');
		echo $this->Form->input('hours');
		echo $this->Form->input('minutes');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

