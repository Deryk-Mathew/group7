<script type="text/javascript">
$(document).ready(function() {
$('#ClientStockQuantity, #xrate, #price, #balance').on('input',function() {
    var qty = parseInt($('#ClientStockQuantity').val());
	var price = parseFloat($('#price').val());
	var rate = parseFloat($('#xrate').val());
    var balance = parseFloat($('#balance').val());
	var totalchange = parseFloat((qty * (price*(1/rate)) ? qty * (price*(1/rate)) : 0).toFixed(2)).toFixed(2);
	if(qty<1 || !$.isNumeric($('#ClientStockQuantity').val())){
		$('#total').text("-").css("color", "red").css("font-weight","Bold");
    		var newbalance = (balance-totalchange).toFixed(2);
    		$('#projbalance').text("Invalid quantity entered!").css("color", "red").css("font-weight","Bold");
    		$('#submit').css('visibility','hidden');
	}
	else if(totalchange<=balance){
    		$('#total').text("£"+totalchange).css("color", "black").css("font-weight","Normal");
    		var newbalance = (balance-totalchange).toFixed(2);
    		$('#projbalance').text("£" + newbalance).css("color", "black").css("font-weight","Normal");
    		$('#submit').css('visibility','visible');
    	}
    	else{
    		$('#total').html("£"+totalchange).css("color", "red").css("font-weight","Bold");
    		var newbalance = (balance-totalchange).toFixed(2);
    		var required = (totalchange - balance).toFixed(2);
    		var stock = stockid;
    		$('#submit').css('visibility','hidden');
    		$('#projbalance').html("Client has insufficient funds. <div class = 'actions' ><a href = '/balances/deposit/"+$('#clientid').val()+"/"+required+"/"+$('#stockid').val()+"/"+$('#ClientStockQuantity').val()+"'>CLICK HERE TO DEPOSIT</a></div>").css("color", "red").css("font-weight","Bold");
    	}
});



$('#ClientStockBuyStockForm, #ClientStockQuantity, #xrate, #price').submit(function() {
	var qty = parseInt($('#ClientStockQuantity').val());
	var price = parseFloat($('#price').val());
	var rate = parseFloat($('#xrate').val());
    var c = confirm("Purchase for £".concat((qty * (price*(1/rate)) ? qty * (price*(1/rate)) : 0).toFixed(2)));
    return c; //you can just return c because it will be true or false
});

$('#max').on('click',function() {
	var price = parseFloat($('#price').val());
	var rate = parseFloat($('#xrate').val());
    	var qty = parseInt($('#clientqty').val());
    	var totalchange = parseFloat((qty * (price*(1/rate)) ? qty * (price*(1/rate)) : 0).toFixed(2));
    	$('#total').text("£"+totalchange).css("color", "black").css("font-weight","Normal");
    	var balance = parseFloat($('#balance').val());
    	var newbalance = (balance-totalchange).toFixed(2);
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
                        <h1 class="page-header">Buy Stock</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                
                <input type='hidden' id="clientqty" value="<?php $maxpossible = floor($this->Session->read('balance')/($stock['Stock']['lastTradePriceOnly']*(1/$stock['StockExchange']['ExchangeRate']['rate'])));
                echo $maxpossible;?>" disabled/>
                <input type='hidden' id="clientid" value="<?php echo $this->Session->read('current_client');?>" disabled/>
                <input type='hidden' id="stockid" value="<?php echo $stock['Stock']['id'];?>" disabled/>
                
 <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-xs-12">
<?php echo $this->Form->create('ClientStock');
$defaultcost = round($defaultqty*($stock['Stock']['lastTradePriceOnly']*(1/$stock['StockExchange']['ExchangeRate']['rate'])),2);?>
	<fieldset>
		<div class="stocks view">
		
		<dt><?php echo __('Name'); ?></dt><dd><?php echo h($stock['Stock']['name'])?></dd>
		<dt><?php echo __('Price'); ?></dt><dd><?php 
		$gbpprice = $this->Number->precision($stock['Stock']['lastTradePriceOnly']*(1/$stock['StockExchange']['ExchangeRate']['rate']),2);
		echo h($stock['Stock']['lastTradePriceOnly'])." ".$stock['StockExchange']['ExchangeRate']['currency'].' ('.
		$gbpprice.' GBP)'?></dd>
		<dt><?php echo __($stock['StockExchange']['ExchangeRate']['currency'].' to GBP Exchange Rate'); ?></dt><dd><?php echo 1/$stock['StockExchange']['ExchangeRate']['rate']?></dd>
		<br/>
		<dt><?php echo __('Buy Stock for Client'); ?></dt><dd><?php echo h($this->Session->read('current_client_name'))?></dd>
		<dt><?php echo __('Current Client Balance'); ?></dt><dd><?php echo '£'.h($this->Session->read('balance'))?></dd>
		<br/>
		<input type='hidden' name='price' id='price' value='<?php echo $stock['Stock']['lastTradePriceOnly']?>' disabled/>
		<input type='hidden' name='xrate' id='xrate' value='<?php echo $stock['StockExchange']['ExchangeRate']['rate']?>' disabled/>
		<input type='hidden' name='balance' id='balance' value='<?php echo $this->Session->read('balance')?>' disabled/>
		<?php if($gbpprice<$this->Session->read('balance')){?>
		<dt><?php echo __('Projected New Balance'); ?></dt><dd><p id="projbalance"><?php echo '£'.round($this->Session->read('balance')-$defaultcost,2)?></p></dd>
		<?php } else {?>
		<dt><?php echo __('Projected New Balance'); ?></dt><div class = "actions"><dd><p id="projbalance"><?php echo $this->Html->link(__('Deposit Funds'), array('controller' => 'balances', 'action' => 'deposit', $client['Client']['id'])); ?></p></li></dd></div>
		<?php }?>
		<dt><?php echo __('Total'); ?></dt><dd><p id="total">£<?php echo $defaultcost;?></p></dd>
		</br>
		</div>
		<div class="input-append">
	<?php
		echo $this->Form->input('quantity',array('maxlength'=>'10','type' => 'number','value' => $defaultqty));
	?>
	<?php if($gbpprice<$this->Session->read('balance')){?>
	<div id = "max" class = "col-lg-2 actions"><a>Max</a></div>
	</div>
	</fieldset>
<span id = "submit"><?php echo $this->Form->end(__('Buy')); ?></span>
<?php }?>
</div>

</div>
