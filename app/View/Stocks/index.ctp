<div class="stocks index">
	<h2><?php echo __('Stocks'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('averageDailyVolume'); ?></th>
			<th><?php echo $this->Paginator->sort('change'); ?></th>
			<th><?php echo $this->Paginator->sort('daysLow'); ?></th>
			<th><?php echo $this->Paginator->sort('daysHigh'); ?></th>
			<th><?php echo $this->Paginator->sort('yearsLow'); ?></th>
			<th><?php echo $this->Paginator->sort('marketCapatalization'); ?></th>
			<th><?php echo $this->Paginator->sort('lastTradePriceOnly'); ?></th>
			<th><?php echo $this->Paginator->sort('daysRange'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('symbol'); ?></th>
			<th><?php echo $this->Paginator->sort('volume'); ?></th>
			<th><?php echo $this->Paginator->sort('stockExchange_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($stocks as $stock): ?>
	<tr>
		<td><?php echo h($stock['Stock']['id']); ?>&nbsp;</td>
		<td><?php echo h($stock['Stock']['averageDailyVolume']); ?>&nbsp;</td>
		<td><?php echo h($stock['Stock']['change']); ?>&nbsp;</td>
		<td><?php echo h($stock['Stock']['daysLow']); ?>&nbsp;</td>
		<td><?php echo h($stock['Stock']['daysHigh']); ?>&nbsp;</td>
		<td><?php echo h($stock['Stock']['yearsLow']); ?>&nbsp;</td>
		<td><?php echo h($stock['Stock']['marketCapatalization']); ?>&nbsp;</td>
		<td><?php echo h($stock['Stock']['lastTradePriceOnly']); ?>&nbsp;</td>
		<td><?php echo h($stock['Stock']['daysRange']); ?>&nbsp;</td>
		<td><?php echo h($stock['Stock']['name']); ?>&nbsp;</td>
		<td><?php echo h($stock['Stock']['symbol']); ?>&nbsp;</td>
		<td><?php echo h($stock['Stock']['volume']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($stock['StockExchange']['name'], array('controller' => 'stock_exchanges', 'action' => 'view', $stock['StockExchange']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $stock['Stock']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $stock['Stock']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $stock['Stock']['id']), array(), __('Are you sure you want to delete # %s?', $stock['Stock']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Stock'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Stock Exchanges'), array('controller' => 'stock_exchanges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Stock Exchange'), array('controller' => 'stock_exchanges', 'action' => 'add')); ?> </li>
	</ul>
</div>
