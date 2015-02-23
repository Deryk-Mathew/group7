<div class="balances form">
<?php echo $this->Form->create('Balance'); ?>
	<fieldset>
		<legend><?php echo __('Withdraw'); ?></legend>
	<?php
		//echo $this->Form->input('client_id');
		echo $this->Form->input('cash_balance', array('label' => 'Withdraw Amount',  'value' => '0.00'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
