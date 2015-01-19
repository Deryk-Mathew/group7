<div class="clients index">
	<h2><?php echo __('Clients'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('NINum'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('registered'); ?></th>
			<!--<th class="actions"><?php echo __('Actions'); ?></th> -->
	</tr>
	</thead>
	<tbody>
	<?php foreach ($clients as $client): ?>
	<tr>
		<td><?php echo $this->Html->link($client['Client']['NINum'], array('controller' => 'clients', 'action' => 'view', $client['Client']['id'])); ?>&nbsp;</td>
		<td><?php echo $this->Html->link($client['Client']['name'], array('controller' => 'clients', 'action' => 'view', $client['Client']['id'])); ?>&nbsp;</td>
		<td><?php echo $this->Html->link($client['Client']['registered'], array('controller' => 'clients', 'action' => 'view', $client['Client']['id'])); ?>&nbsp;</td>
		<!-- <td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $client['Client']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $client['Client']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $client['Client']['id']), array(), __('Are you sure you want to delete # %s?', $client['Client']['id'])); ?>
		</td> -->
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
	<ul>
		<li><?php echo $this->Html->link(__('New Client'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Stocks'), array('controller' => 'stocks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout')); ?></li>

	</ul>
</div>

		
		
<?php if (AuthComponent::User('group_id') == 1): ?>
	<div class="actions">
		<h3><?php echo __('Administration'); ?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		</ul>
	</div>
<?php endif; ?>