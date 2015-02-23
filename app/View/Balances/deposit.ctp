<div class="balances form">
<?php echo $this->Form->create('Balance'); ?>
	<fieldset>
		<legend><?php echo __('Deposit'); ?></legend>
	<?php
		echo $this->Form->input('cash_balance', array('label' => 'Deposit Amount', 'value' => '0.00'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Deposit')); ?>
</div>
