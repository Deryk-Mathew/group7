

        <?php 
			  $stocktotal = 0;
			  foreach ($client['ClientStock'] as $clientStock): 
						$stocktotal = $stocktotal + $clientStock['quantity']*$clientStock['Stock']['lastTradePriceOnly'];
						endforeach;
			  
			  ?>
            <div class="container-fluid">
            
             <!-- ENTER INDIVIDUAL PAGE CONTENT HERE!!!!! -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo __('Client'); ?></h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                
                
                
    <div class="clients view">

	<div class="col-xs-12 col-md-6">
	<dl>
		<!-- Only display if admin -->
		<?php if (AuthComponent::User('group_id') == 1): ?>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($client['User']['full_name'], array('controller' => 'users', 'action' => 'view', $client['User']['id'])); ?>
			&nbsp;
		</dd>
		<?php endif; ?>
		<dt><?php echo __('NINum'); ?></dt>
		<dd>
			<?php echo h($client['Client']['NINum']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($client['Client']['name']); ?>
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
		<dt> <?php echo __('Actions'); ?> </dt>
			<dd><?php echo $this->Html->link(__('Edit Client'), array('action' => 'edit', $client['Client']['id'])); ?> &nbsp;
				<?php if (AuthComponent::User('group_id') == 1): ?>
		<?php echo $this->Form->postLink(__('Delete Client'), array('action' => 'delete', $client['Client']['id']), array(), __('Are you sure you want to delete # %s?', $client['Client']['id'])); ?> &nbsp; <?php endif; ?>
			<?php echo $this->Form->postLink(__('Remove Client'), array('action' => 'remove', $client['Client']['id']), array(), __('Are you sure you want to remove # %s?', $client['Client']['id'])); ?> &nbsp;
			</dd>
	</dl>
	
	
	 </div>

<!-- List client balance -->
	<div class="col-xs-12 col-md-6">
		<h3><?php echo __('Related Balances'); ?></h3>
			<?php if (!empty($client['Balance'])): ?>
				<dl>
				<dt><?php echo __('Cash Balance'); ?></dt>
				<dd>
				<?php echo $client['Balance']['cash_balance']; ?>
				&nbsp;</dd>
				<dt><?php echo __('Stock Value'); ?></dt>
				<dd>
				<?php echo $stocktotal; ?>
				&nbsp;</dd>
				<dt><?php echo __('Total Balance'); ?></dt>
				<dd>
				<?php echo $stocktotal + $client['Balance']['cash_balance']; ?>
				&nbsp;</dd>
				</dl>
			<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Deposit'), array('controller' => 'balances', 'action' => 'deposit', $client['Balance']['id'])); ?></li>
				<li><?php echo $this->Html->link(__('Withdraw'), array('controller' => 'balances', 'action' => 'withdraw', $client['Balance']['id'])); ?></li>
				<li><?php echo $this->Html->link(__('Buy New Stock'), array('controller' => 'stocks', 'action' => 'index')); ?> </li>
			</ul>

		</div>
		<!-- List all client notes -->

	<h3 class="notes"><?php echo __('Related Notes'); ?></h3>
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
	<!-- New Note div end -->

	</div>
	
	
  

	<?php if (!empty($client['TransactionRecord'])): ?>
<table id="stockTable" cellpadding = "0" cellspacing = "0">
 	<div class="col-xs-12 col-md-6">  
			<tr>
			<h3><?php echo __('Transaction Record'); ?></h3>	
				<th><?php echo __('Type'); ?></th>
				<th><?php echo __('Description'); ?></th>
				<th><?php echo __('In'); ?></th>
				<th><?php echo __('Out'); ?></th>
				<th><?php echo __('Date'); ?></th>
			</tr>		   
			<?php foreach ($client['TransactionRecord'] as $transrec): ?>
				<tr>
						<td><?php echo $transrec['TransactionType']['type']; ?></td>
						<td><?php echo $transrec['description']; ?></td>
						<?php if ($transrec['balance_change'] > 0): ?><td><?php echo $transrec['balance_change']; ?></td><td><?php echo "-"; ?></td><?php endif; ?>
						<?php if ($transrec['balance_change'] < 0): ?><td><?php echo "-"; ?></td><td><?php echo $transrec['balance_change']*-1; ?></td><?php endif; ?>
						<?php if ($transrec['balance_change'] == 0): ?><td><?php echo "-"; ?></td><td><?php echo "-"; ?></td><?php endif; ?>
						<td><?php echo $transrec['date']; ?></td>
				</tr>
			<?php endforeach; ?>  
			</div>          
<?php endif; ?>			
                



</div>                   


</div>



	

