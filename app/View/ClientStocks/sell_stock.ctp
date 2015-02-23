 <div class="container-fluid">
            
             <!-- ENTER INDIVIDUAL PAGE CONTENT HERE!!!!! -->
                

<div class="clientStocks form">
<?php echo $this->Form->create('ClientStock', array('onsubmit' => 'return confirm("Are you sure you want to sell this stock?")')); ?>
	<fieldset>
		<legend><?php echo __('Sell Stock'); ?></legend>
		<div class="stocks view">
		<dt><?php echo __('Name'); ?></dt><dd><?php echo h($stock['Stock']['name'])?></dd>
		<dt><?php echo __('Price'); ?></dt><dd><?php echo h($stock['Stock']['lastTradePriceOnly'])?></dd>
		</br>
		<dt><?php echo __('Stocks Owned'); ?></dt><dd><?php echo $quantity?></dd>
		</div>
	<?php
		echo $this->Form->input('quantity',array('default'=>0));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Sell')); ?>
</div>

</div>