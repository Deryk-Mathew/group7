<div class="clients view">

<h2><?php echo __('Client'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($client['Client']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($client['User']['full_name'], array('controller' => 'users', 'action' => 'view', $client['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NINum'); ?></dt>
		<dd>
			<?php echo h($client['Client']['NINum']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Forename'); ?></dt>
		<dd>
			<?php echo h($client['Client']['forename']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Surname'); ?></dt>
		<dd>
			<?php echo h($client['Client']['surname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Street'); ?></dt>
		<dd>
			<?php echo h($client['Client']['street']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Town'); ?></dt>
		<dd>
			<?php echo h($client['Client']['town']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('County'); ?></dt>
		<dd>
			<?php echo h($client['Client']['county']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Postcode'); ?></dt>
		<dd>
			<?php echo h($client['Client']['postcode']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Registered'); ?></dt>
		<dd>
			<?php echo h($client['Client']['registered']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Client'), array('action' => 'edit', $client['Client']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Client'), array('action' => 'delete', $client['Client']['id']), array(), __('Are you sure you want to delete # %s?', $client['Client']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Clients'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Stocks'), array('controller' => 'stocks', 'action' => 'index', $client['Client']['id'])); ?> </li>

		<li><?php echo $this->Html->link(__('List Client Stocks'), array('controller' => 'client_stocks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Notes'), array('controller' => 'notes', 'action' => 'index')); ?> </li>
	</ul>
</div>
	
	<!-- List client balance -->
	<div class="related">
		<h3><?php echo __('Related Balances'); ?></h3>
	<?php if (!empty($client['Balance'])): ?>
		<dl>
		<dt><?php echo __('Cash Balance'); ?></dt>
		<dd>
	<?php echo $client['Balance']['cash_balance']; ?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Balance'), array('controller' => 'balances', 'action' => 'edit', $client['Balance']['id'])); ?></li>
			</ul>
		</div>
	</div>

	<!-- List all client stocks -->
	<div class="related">
	<h3><?php echo __('Related Client Stocks'); ?></h3>
	<?php if (!empty($client['ClientStock'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Client Id'); ?></th>
		<th><?php echo __('Stock Id'); ?></th>
		<th><?php echo __('Quantity'); ?></th>
		<th><?php echo __('Cost'); ?></th>
		<th><?php echo __('Purchase Date'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($client['ClientStock'] as $clientStock): ?>
		<tr>
			<td><?php echo $clientStock['id']; ?></td>
			<td><?php echo $clientStock['client_id']; ?></td>
			<td><?php echo $clientStock['stock_id']; ?></td>
			<td><?php echo $clientStock['quantity']; ?></td>
			<td><?php echo $clientStock['cost']; ?></td>
			<td><?php echo $clientStock['purchase']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'client_stocks', 'action' => 'view', $clientStock['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'client_stocks', 'action' => 'edit', $clientStock['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'client_stocks', 'action' => 'delete', $clientStock['id']), array(), __('Are you sure you want to delete # %s?', $clientStock['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
	<!-- Add new stock to client -->
	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Client Stock'), array('controller' => 'stocks', 'action' => 'index')); ?> </li>
		</ul>
	</div>
</div>

<!-- List all client notes -->
<div class="related">
	<h3><?php echo __('Related Notes'); ?></h3>
	<?php if (!empty($client['Note'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($client['Note'] as $note): ?>
		<tr>
			<td><?php echo $this->Html->link($note['created'], array('controller' => 'notes', 'action' => 'view', $note['id'])); ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'notes', 'action' => 'view', $note['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'notes', 'action' => 'edit', $note['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'notes', 'action' => 'delete', $note['id']), array(), __('Are you sure you want to delete # %s?', $note['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
	<!-- Add new client note -->
	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Note'), array('controller' => 'notes', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
