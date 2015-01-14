<div class="stockExhanges form">
<?php echo $this->Form->create('StockExhange'); ?>
	<fieldset>
		<legend><?php echo __('Add Stock Exhange'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Stock Exhanges'), array('action' => 'index')); ?></li>
	</ul>
</div>
