<div class="stocks view">
<h2><?php echo __('Stock'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('AverageDailyVolume'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['averageDailyVolume']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Change'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['change']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DaysLow'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['daysLow']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DaysHigh'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['daysHigh']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('YearsLow'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['yearsLow']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('MarketCapatalization'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['marketCapatalization']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('LastTradePriceOnly'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['lastTradePriceOnly']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DaysRange'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['daysRange']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Symbol'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['symbol']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Volume'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['volume']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Stock Exchange'); ?></dt>
		<dd>
			<?php echo $this->Html->link($stock['StockExchange']['name'], array('controller' => 'stock_exchanges', 'action' => 'view', $stock['StockExchange']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Buy Stock'); ?></dt>
		<div class="actions">
		<dd><?php echo $this->Html->link(__('Buy Stock'), array('controller' => 'client_stocks', 'action' => 'buyStock', $stock['Stock']['id'], $stock['Stock']['daysLow'])); ?>&nbsp;</dd>
		</div>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Stock'), array('action' => 'edit', $stock['Stock']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Stock'), array('action' => 'delete', $stock['Stock']['id']), array(), __('Are you sure you want to delete # %s?', $stock['Stock']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Stocks'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Stock'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Stock Exchanges'), array('controller' => 'stock_exchanges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Stock Exchange'), array('controller' => 'stock_exchanges', 'action' => 'add')); ?> </li>
	</ul>
</div>
