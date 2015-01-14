<div class="stockExchanges form">
<?php echo $this->Form->create('StockExchange'); ?>
	<fieldset>
		<legend><?php echo __('Add Stock Exchange'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Stock Exchanges'), array('action' => 'index')); ?></li>
	</ul>
</div>
