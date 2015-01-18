<div class="notes index">
	<h2><?php echo __('Notes'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('client_id'); ?></th>
			<th><?php echo $this->Paginator->sort('body'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($notes as $note): ?>
	<tr>
		<td><?php echo h($note['Note']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($note['Client']['id'], array('controller' => 'clients', 'action' => 'view', $note['Client']['id'])); ?>
		</td>
		<td><?php echo h($note['Note']['body']); ?>&nbsp;</td>
		<td><?php echo h($note['Note']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $note['Note']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $note['Note']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $note['Note']['id']), array(), __('Are you sure you want to delete # %s?', $note['Note']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<?php if (AuthComponent::User('group_id') == 1): ?>
		<ul>
			<li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients','action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients','action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
			<?php if ($this->Session->read('current_client') != null): ?>
				<li><?php echo $this->Html->link(__('Return To Client'), array('controller' => 'clients', 'action' => 'view', $this->Session->read('current_client'))); ?> </li>
			<?php endif; ?>
			<li><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout')); ?></li>
		</ul>
	<?php endif; ?>
	<?php if (AuthComponent::User('group_id') == 2): ?>
		<ul>
			<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients','action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients','action' => 'add')); ?> </li>
			<?php if ($this->Session->read('current_client') != null): ?>
				<li><?php echo $this->Html->link(__('Return To Client'), array('controller' => 'clients', 'action' => 'view', $this->Session->read('current_client'))); ?> </li>
			<?php endif; ?>
			<li><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout')); ?></li>
		</ul>
	<?php endif; ?>
</div>