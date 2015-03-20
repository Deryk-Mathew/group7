 <div class="container-fluid">
            
             <!-- ENTER INDIVIDUAL PAGE CONTENT HERE!!!!! -->
                

<div class="clientStocks form">
<?php echo $this->Form->create('ClientStock'); ?>
	<fieldset>
		<legend><?php echo __('Confirm Stock Purchase'); ?></legend>
		<div class="stocks view">
		<dt><?php echo __('Name'); ?></dt><dd><?php echo h($stock['Stock']['name'])?></dd>
		<dt><?php echo __('Price'); ?></dt><dd><?php echo h($stock['Stock']['lastTradePriceOnly'])." ".$stock['StockExchange']['ExchangeRate']['currency'].' ('.
		$this->Number->precision($stock['Stock']['lastTradePriceOnly']*(1/$stock['StockExchange']['ExchangeRate']['rate']),2).' GBP)'?></dd>
		<dt><?php echo __($stock['StockExchange']['ExchangeRate']['currency'].' to GBP Exchange Rate'); ?></dt><dd><?php echo 1/$stock['StockExchange']['ExchangeRate']['rate']?></dd>
		<br/>
		<dt><?php echo __('Quantity'); ?></dt><dd><?php echo $quantity;?></dd>
		<dt><?php echo __('Total'); ?></dt><dd><?php echo $total;?></dd>
		</br>
		</div>
	</fieldset>
<?php echo $this->Form->end(__('Confirm')); ?>
</div>

</div>