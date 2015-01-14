<div class="stockExhanges form">
<?php echo $this->Form->create('StockExhange'); ?>
	<fieldset>
		<legend><?php echo __('Edit Stock Exhange'); ?></legend>
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('StockExhange.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('StockExhange.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Stock Exhanges'), array('action' => 'index')); ?></li>
	</ul>
</div>
