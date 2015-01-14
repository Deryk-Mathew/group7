<div class="stockExchanges form">
<?php echo $this->Form->create('StockExchange'); ?>
	<fieldset>
		<legend><?php echo __('Edit Stock Exchange'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('StockExchange.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('StockExchange.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Stock Exchanges'), array('action' => 'index')); ?></li>
	</ul>
</div>
