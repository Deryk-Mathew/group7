<div class="balances view">
<h2><?php echo __('Balance'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($balance['Balance']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Client'); ?></dt>
		<dd>
			<?php echo $this->Html->link($balance['Client']['id'], array('controller' => 'clients', 'action' => 'view', $balance['Client']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cash Balance'); ?></dt>
		<dd>
			<?php echo h($balance['Balance']['cash_balance']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Balance'), array('action' => 'edit', $balance['Balance']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Balance'), array('action' => 'delete', $balance['Balance']['id']), array(), __('Are you sure you want to delete # %s?', $balance['Balance']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add')); ?> </li>
		<?php if ($this->Session->read('current_client') != null): ?>
			<li><?php echo $this->Html->link(__('Return To Client'), array('controller' => 'clients', 'action' => 'view', $this->Session->read('current_client'))); ?> </li>
		<?php endif; ?>
		<li><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout')); ?></li>
	</ul>
</div>
