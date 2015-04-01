<script type="text/javascript">
$(document).ready(function() {
$('#ClientStockQuantity, #xrate, #price, #balance').on('input',function() {
    var qty = parseInt($('#ClientStockQuantity').val());
    var clientqty = parseInt($('#clientqty').val());
	var price = parseFloat($('#price').val());
	var rate = parseFloat($('#xrate').val());
    var balance = parseFloat($('#balance').val());
	var totalchange = parseFloat((qty * (price*(1/rate)) ? qty * (price*(1/rate)) : 0).toFixed(2));
    $('#total').text("£"+totalchange);
    var newbalance = (balance+totalchange).toFixed(2);
    $('#projbalance').text("£" + newbalance);
    
    if(qty<1 || (qty>clientqty) ||!$.isNumeric($('#ClientStockQuantity').val())){
		$('#total').text("-").css("color", "red").css("font-weight","Bold");
    		$('#projbalance').text("Invalid quantity entered!").css("color", "red").css("font-weight","Bold");
    		$('#submit').css('visibility','hidden');
	}
	else{
    		$('#total').text("£"+totalchange).css("color", "black").css("font-weight","Normal");
    		$('#projbalance').text("£" + newbalance).css("color", "black").css("font-weight","Normal");
    		$('#submit').css('visibility','visible');
    	}
    
    
});



$('#ClientStockSellStockForm, #ClientStockQuantity, #xrate, #price').submit(function() {
	var qty = parseInt($('#ClientStockQuantity').val());
	var price = parseFloat($('#price').val());
	var rate = parseFloat($('#xrate').val());
    var c = confirm("Sell for £".concat((qty * (price*(1/rate)) ? qty * (price*(1/rate)) : 0).toFixed(2)));
    return c; //you can just return c because it will be true or false
});

$('#max').on('click',function() {
	var price = parseFloat($('#price').val());
	var rate = parseFloat($('#xrate').val());
    	var qty = parseInt($('#clientqty').val());
    	var totalchange = parseFloat((qty * (price*(1/rate)) ? qty * (price*(1/rate)) : 0).toFixed(2));
    	$('#total').text("£"+totalchange).css("color", "black").css("font-weight","Normal");
    	var balance = parseFloat($('#balance').val());
    	var newbalance = balance+totalchange;
    	$('#projbalance').text("£" + newbalance).css("color", "black").css("font-weight","Normal");
$( '#ClientStockQuantity' ).val(function( index, value ) {
	
	
	return $('#clientqty').val() + this.className;
});

})

});
</script>


            
             <!-- ENTER INDIVIDUAL PAGE CONTENT HERE!!!!! -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Sell Stock</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                
<input type='hidden' id="clientqty" value="<?php echo $quantity?>" disabled/>

<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-xs-12">
<?php echo $this->Form->create('ClientStock'); ?>
	<fieldset>
		<div class="stocks view">
		<dt><?php echo __('Name'); ?></dt><dd><?php echo h($stock['Stock']['name'])?></dd>
				<dt><?php echo __('Price'); ?></dt><dd><?php echo h($stock['Stock']['lastTradePriceOnly'])." ".$stock['StockExchange']['ExchangeRate']['currency'].' ('.
		$this->Number->precision($stock['Stock']['lastTradePriceOnly']*(1/$stock['StockExchange']['ExchangeRate']['rate']),2).' GBP)'?></dd>
		<dt><?php echo __($stock['StockExchange']['ExchangeRate']['currency'].' to GBP Exchange Rate'); ?></dt><dd><?php echo 1/$stock['StockExchange']['ExchangeRate']['rate']?></dd>
		<dt><?php echo __('Stocks Owned'); ?></dt><dd><?php echo $quantity?></dd>
		<br/>
		<dt><?php echo __('Buy Stock for Client'); ?></dt><dd><?php echo h($this->Session->read('current_client_name'))?></dd>
		<dt><?php echo __('Current Client Balance'); ?></dt><dd><?php echo '£'.h($this->Session->read('balance'))?></dd>
		<br/>
		<input type='hidden' name='price' id='price' value='<?php echo $stock['Stock']['lastTradePriceOnly']?>' disabled/>
		<input type='hidden' name='xrate' id='xrate' value='<?php echo $stock['StockExchange']['ExchangeRate']['rate']?>' disabled/>
		<input type='hidden' name='balance' id='balance' value='<?php echo $this->Session->read('balance')?>' disabled/>
		<dt><?php echo __('Projected New Balance'); ?></dt><dd><p id="projbalance"><?php echo '£'.h($this->Session->read('balance'))?></p></dd>
		<dt><?php echo __('Total'); ?></dt><dd><p id="total">£0.00</p></dd>
		</br>
		</div>
	<?php
		echo $this->Form->input('quantity',array('default'=>0),array('maxlength'=>'10','type' => 'number'));
	?>
	<div id = "max" class = "col-lg-2 actions"><a href ='#'>Max</a></div>
	</fieldset>
<span id = "submit"><?php echo $this->Form->end(__('Sell')); ?></span>
</div>

</div>
