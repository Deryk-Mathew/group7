
            <div class="container-fluid">
            
             <!-- ENTER INDIVIDUAL PAGE CONTENT HERE!!!!! -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Note</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

<div class="notes view">
	<dl>
		<dt><?php echo __('Content'); ?></dt>
		<dd>
			<?php echo h($note['Note']['body']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($note['Note']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<?php if (AuthComponent::User('group_id') == 1): ?>
		<ul>
			<li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients','action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients','action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Return To Client'), array('controller' => 'clients', 'action' => 'view', $this->Session->read('current_client'))); ?> </li>
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
