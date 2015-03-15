<script type="text/javascript">
$(document).ready(function() {
$('#ClientStockQuantity, #xrate, #price').on('input',function() {
    var qty = parseInt($('#ClientStockQuantity').val());
	var price = parseFloat($('#price').val());
	var rate = parseFloat($('#xrate').val());
    $('#total').text("£".concat((qty * (price*(1/rate)) ? qty * (price*(1/rate)) : 0).toFixed(2)));
});



$('#ClientStockBuyStockForm, #ClientStockQuantity, #xrate, #price').submit(function() {
	var qty = parseInt($('#ClientStockQuantity').val());
	var price = parseFloat($('#price').val());
	var rate = parseFloat($('#xrate').val());
    var c = confirm("Purchase for £".concat((qty * (price*(1/rate)) ? qty * (price*(1/rate)) : 0).toFixed(2)));
    return c; //you can just return c because it will be true or false
});

});
</script>

            
             <!-- ENTER INDIVIDUAL PAGE CONTENT HERE!!!!! -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Buy Stock</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                
 <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-xs-12">
<?php echo $this->Form->create('ClientStock'); ?>
	<fieldset>
		<div class="stocks view">
		<dt><?php echo __('Name'); ?></dt><dd><?php echo h($stock['Stock']['name'])?></dd>
		<dt><?php echo __('Price'); ?></dt><dd><?php echo h($stock['Stock']['lastTradePriceOnly'])." ".$stock['StockExchange']['ExchangeRate']['currency'].' ('.
		$this->Number->precision($stock['Stock']['lastTradePriceOnly']*(1/$stock['StockExchange']['ExchangeRate']['rate']),2).' GBP)'?></dd>
		<dt><?php echo __($stock['StockExchange']['ExchangeRate']['currency'].' to GBP Exchange Rate'); ?></dt><dd><?php echo 1/$stock['StockExchange']['ExchangeRate']['rate']?></dd>
		<br/>
		<input type='hidden' name='price' id='price' value='<?php echo $stock['Stock']['lastTradePriceOnly']?>' disabled/>
		<input type='hidden' name='xrate' id='xrate' value='<?php echo $stock['StockExchange']['ExchangeRate']['rate']?>' disabled/>
		
		<dt><?php echo __('Total'); ?></dt><dd><p id="total">£0.00</p></dd>
		</br>
		</div>
	<?php
		echo $this->Form->input('quantity',array('default'=>0),array('maxlength'=>'10','type' => 'number'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Buy')); ?>
</div>

</div>
