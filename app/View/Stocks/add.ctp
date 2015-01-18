<div class="stocks form">
<?php echo $this->Form->create('Stock'); ?>
	<fieldset>
		<legend><?php echo __('Add Stock'); ?></legend>
	<?php
		echo $this->Form->input('averageDailyVolume');
		echo $this->Form->input('change');
		echo $this->Form->input('daysLow');
		echo $this->Form->input('daysHigh');
		echo $this->Form->input('yearsLow');
		echo $this->Form->input('marketCapatalization');
		echo $this->Form->input('lastTradePriceOnly');
		echo $this->Form->input('daysRange');
		echo $this->Form->input('name');
		echo $this->Form->input('symbol');
		echo $this->Form->input('volume');
		echo $this->Form->input('stockExchange_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Stocks'), array('action' => 'index')); ?></li>
		<?php if ($this->Session->read('current_client') != null): ?>
			<li><?php echo $this->Html->link(__('Return To Client'), array('controller' => 'clients', 'action' => 'view', $this->Session->read('current_client'))); ?> </li>
		<?php endif; ?>
		<li><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout')); ?></li>
	</ul>
</div>
