<div class="clientStocks view">
<h2><?php echo __('Client Stock'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($clientStock['ClientStock']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Client'); ?></dt>
		<dd>
			<?php echo $this->Html->link($clientStock['Client']['id'], array('controller' => 'clients', 'action' => 'view', $clientStock['Client']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Stock'); ?></dt>
		<dd>
			<?php echo $this->Html->link($clientStock['Stock']['name'], array('controller' => 'stocks', 'action' => 'view', $clientStock['Stock']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quantity'); ?></dt>
		<dd>
			<?php echo h($clientStock['ClientStock']['quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cost'); ?></dt>
		<dd>
			<?php echo h($clientStock['ClientStock']['cost']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Purchase Date'); ?></dt>
		<dd>
			<?php echo h($clientStock['ClientStock']['purchase']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Client Stock'), array('action' => 'edit', $clientStock['ClientStock']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Client Stock'), array('action' => 'delete', $clientStock['ClientStock']['id']), array(), __('Are you sure you want to delete # %s?', $clientStock['ClientStock']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Client Stocks'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client Stock'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Stocks'), array('controller' => 'stocks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Stock'), array('controller' => 'stocks', 'action' => 'add')); ?> </li>
	</ul>
</div>
