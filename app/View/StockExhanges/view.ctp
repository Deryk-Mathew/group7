<div class="stockExhanges view">
<h2><?php echo __('Stock Exhange'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($stockExhange['StockExhange']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($stockExhange['StockExhange']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Stock Exhange'), array('action' => 'edit', $stockExhange['StockExhange']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Stock Exhange'), array('action' => 'delete', $stockExhange['StockExhange']['id']), array(), __('Are you sure you want to delete # %s?', $stockExhange['StockExhange']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Stock Exhanges'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Stock Exhange'), array('action' => 'add')); ?> </li>
	</ul>
</div>
