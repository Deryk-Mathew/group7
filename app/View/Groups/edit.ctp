<div class="groups form">
<?php echo $this->Form->create('Group'); ?>
	<fieldset>
		<legend><?php echo __('Edit Group'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('List Groups'), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout')); ?></li>
		</ul>
</div>