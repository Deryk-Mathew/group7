
 
 <div class="container-fluid">
            
             <!-- ENTER INDIVIDUAL PAGE CONTENT HERE!!!!! -->
                

<div class="clientStocks form">
<?php echo $this->Form->create('ClientStock', array('onsubmit' => 'return confirm("Are you sure you want to purchase this stock?")')); ?>
	<fieldset>
		<legend><?php echo __('Buy Stock'); ?></legend>
		<div class="stocks view">
		<dt><?php echo __('Name'); ?></dt><dd><?php echo h($stock['Stock']['name'])?></dd>
		<dt><?php echo __('Price'); ?></dt><dd><?php echo h($stock['Stock']['lastTradePriceOnly'])?></dd>
		</br>
		</div>
	<?php
		echo $this->Form->input('quantity',array('default'=>0),array('maxlength'=>'4','type' => 'number'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Buy')); ?>
</div>

</div>