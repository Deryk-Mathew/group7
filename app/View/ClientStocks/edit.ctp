<div class="clientStocks form">
<?php echo $this->Form->create('ClientStock'); ?>
	<fieldset>
		<legend><?php echo __('Edit Client Stock'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('client_id');
		echo $this->Form->input('stock_id');
		echo $this->Form->input('quantity');
		echo $this->Form->input('cost');
		echo $this->Form->input('purchase_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ClientStock.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('ClientStock.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Client Stocks'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Stocks'), array('controller' => 'stocks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Stock'), array('controller' => 'stocks', 'action' => 'add')); ?> </li>
	</ul>
</div>
