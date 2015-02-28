<?php echo $this->Form->create('Client'); ?>
	<fieldset>
		<legend><?php echo __('Edit Client'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('NINum');
		echo $this->Form->input('name');
		echo $this->Form->input('street');
		echo $this->Form->input('town');
		echo $this->Form->input('county');
		echo $this->Form->input('postcode');
		echo $this->Form->input('registered');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>


