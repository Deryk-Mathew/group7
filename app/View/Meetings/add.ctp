<div class="notes form">
<?php echo $this->Form->create('Note'); ?>
	<fieldset>
		<legend><?php echo __('Add Note'); ?></legend>
	<?php
		echo $this->Form->input('body');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
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
