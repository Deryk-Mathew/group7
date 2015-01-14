<div class="stockExchanges view">
<h2><?php echo __('Stock Exchange'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($stockExchange['StockExchange']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($stockExchange['StockExchange']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Stock Exchange'), array('action' => 'edit', $stockExchange['StockExchange']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Stock Exchange'), array('action' => 'delete', $stockExchange['StockExchange']['id']), array(), __('Are you sure you want to delete # %s?', $stockExchange['StockExchange']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Stock Exchanges'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Stock Exchange'), array('action' => 'add')); ?> </li>
	</ul>
</div>
