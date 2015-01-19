<div class="stocks index">
	<h2><?php echo __('Stocks'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('symbol'); ?></th>
			<th><?php echo $this->Paginator->sort('averageDailyVolume'); ?></th>
			<th><?php echo $this->Paginator->sort('change'); ?></th>
			<th><?php echo $this->Paginator->sort('daysLow'); ?></th>
			<th><?php echo $this->Paginator->sort('daysHigh'); ?></th>
			<th><?php echo $this->Paginator->sort('yearsLow'); ?></th>
			<th><?php echo $this->Paginator->sort('marketCapatalization'); ?></th>
			<th><?php echo $this->Paginator->sort('lastTradePriceOnly'); ?></th>
			<th><?php echo $this->Paginator->sort('daysRange'); ?></th>
			<th><?php echo $this->Paginator->sort('volume'); ?></th>
			<th><?php echo $this->Paginator->sort('stockExchange_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
		<?php $client_stocks; ?>
	<?php foreach ($stocks as $stock): ?>
	<tr>
		<td> <?php echo h($stock['Stock']['name']);  ?></td>
		<td><?php echo h($stock['Stock']['symbol']); ?>&nbsp;</td>
		<td><?php echo h($stock['Stock']['averageDailyVolume']); ?>&nbsp;</td>
		<td><?php echo h($stock['Stock']['change']); ?>&nbsp;</td>
		<td><?php echo h($stock['Stock']['daysLow']); ?>&nbsp;</td>
		<td><?php echo h($stock['Stock']['daysHigh']); ?>&nbsp;</td>
		<td><?php echo h($stock['Stock']['yearsLow']); ?>&nbsp;</td>
		<td><?php echo h($stock['Stock']['marketCapatalization']); ?>&nbsp;</td>
		<td><?php echo h($stock['Stock']['lastTradePriceOnly']); ?>&nbsp;</td>
		<td><?php echo h($stock['Stock']['daysRange']); ?>&nbsp;</td>
		<td><?php echo h($stock['Stock']['volume']); ?>&nbsp;</td>
		<td>
			<?php echo h($stock['StockExchange']['name']); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $stock['Stock']['id'])); ?>
			<?php if ($this->Session->read('current_client') != null): ?>
			<?php echo $this->Html->link(__('Buy'), array('controller' => 'client_stocks', 'action' => 'buyStock', $stock['Stock']['id'], $stock['Stock']['lastTradePriceOnly'])); ?>
			<?php endif; ?>
			<!-- Only show if admin logged in -->
			<?php if (AuthComponent::User('group_id') == 1): ?>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $stock['Stock']['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $stock['Stock']['id']), array(), __('Are you sure you want to delete # %s?', $stock['Stock']['id'])); ?>
			<?php endif; ?>
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
	<ul>
		<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients','action' => 'index')); ?> </li>
		<?php if ($this->Session->read('current_client') != null): ?>
			<li><?php echo $this->Html->link(__('Return To Client'), array('controller' => 'clients', 'action' => 'view', $this->Session->read('current_client'))); ?> </li>
		<?php endif; ?>
		<li><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout')); ?></li>
	</ul>
</div>
