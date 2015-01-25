<div class="clientStocks form">

<?php echo $this->Form->create('ClientStock', array('onsubmit' => 'return confirm("Are you sure you want to sell this stock?")')); ?>
	<fieldset>
		<legend><?php echo __('Sell Stock'); ?></legend>
	<?php
		echo $this->Form->input('quantity', array('value' => '0'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Sell')); ?>
</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Stocks'), array('controller' => 'stocks', 'action' => 'index')); ?> </li>
		<?php if ($this->Session->read('current_client') != null): ?>
			<li><?php echo $this->Html->link(__('Return To Client'), array('controller' => 'clients', 'action' => 'view', $this->Session->read('current_client'))); ?> </li>
		<?php endif; ?>
		<li><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout')); ?></li>
	</ul>
</div>