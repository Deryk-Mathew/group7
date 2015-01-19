<div class="users view">
<h2><?php echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Full Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['full_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Group']['name'], array('controller' => 'groups', 'action' => 'view', $user['Group']['id'])); ?>
			&nbsp;
		</dd>
		<dt> <?php echo __('Actions'); ?> </dt>
			<dd><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> &nbsp;
			<?php echo $this->Form->postLink(__('Delete Client'), array('action' => 'delete', $user['User']['id']), array(), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> &nbsp; 
			</dd>
	</dl>
</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<?php if (AuthComponent::User('group_id') == 1): ?>
		<ul>
			<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout')); ?></li>
		</ul>
	<?php endif; ?>
</div>

<div class="related">
	<h3><?php echo __('Related Clients'); ?></h3>
	<?php if (!empty($user['Client'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('NINum'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Street'); ?></th>
		<th><?php echo __('Town'); ?></th>
		<th><?php echo __('County'); ?></th>
		<th><?php echo __('Postcode'); ?></th>
		<th><?php echo __('Registered'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['Client'] as $client): ?>
		<tr>
			<td><?php echo $client['NINum']; ?></td>
			<td><?php echo $client['name']; ?></td>
			<td><?php echo $client['street']; ?></td>
			<td><?php echo $client['town']; ?></td>
			<td><?php echo $client['county']; ?></td>
			<td><?php echo $client['postcode']; ?></td>
			<td><?php echo $client['registered']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'clients', 'action' => 'view', $client['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'clients', 'action' => 'edit', $client['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'clients', 'action' => 'delete', $client['id']), array(), __('Are you sure you want to delete # %s?', $client['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

