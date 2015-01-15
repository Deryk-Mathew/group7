<div class="stocks form">
<?php echo $this->Form->create('Stock'); ?>
	<fieldset>
		<legend><?php echo __('Edit Stock'); ?></legend>
	<?php
		echo $this->Form->input('id');
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Stock.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Stock.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Stocks'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Stock Exchanges'), array('controller' => 'stock_exchanges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Stock Exchange'), array('controller' => 'stock_exchanges', 'action' => 'add')); ?> </li>
	</ul>
</div>