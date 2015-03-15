<div class="balances form">
<?php echo $this->Form->create('Balance'); ?>
	<fieldset>
		<legend><?php echo __('Add Balance'); ?></legend>
	<?php
		echo $this->Form->input('client_id');
		echo $this->Form->input('cash_balance');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

