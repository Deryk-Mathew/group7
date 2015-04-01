<script type="text/javascript">
$(document).ready(function() {
$('#BalanceCashBalance, #balance').on('input',function() {
    	var amount = parseFloat($('#BalanceCashBalance').val());
	var balance = parseFloat($('#balance').val());
	var newbalance = parseFloat(balance-amount).toFixed(2);
	if(!$.isNumeric($('#BalanceCashBalance').val()) || (amount<0.01) || (amount>balance)){
		$('#total').text("Invalid quantity entered.").css("color", "red").css("font-weight","Bold");
		$('#submit').css('visibility','hidden');
	}
	else{
		$('#total').text("£"+newbalance).css("color", "black").css("font-weight","Normal");
		$('#submit').css('visibility','visible');
	}
});

$('#max').on('click',function() {

	$( '#BalanceCashBalance' ).val(function( index, value ) {
	$('#total').text("£0.00").css("color", "black").css("font-weight","Normal");
	$('#submit').css('visibility','visible');
	return $('#balance').val() + this.className;
});

})


});
</script>
            
             <!-- ENTER INDIVIDUAL PAGE CONTENT HERE!!!!! -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Withdraw Funds from Account</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->


<div class="col-lg-6 col-lg-offset-3 col-md-10 col-md-offset-1 col-xs-12">
<?php echo $this->Form->create('Balance'); ?>
	<fieldset>
	<div class = "stocks view">
	<dt><?php echo __('Withdrawal for Client'); ?></dt><dd><?php echo h($this->Session->read('current_client_name'))?></dd>
	<dt><?php echo __('Current Client Balance'); ?></dt><dd><?php echo '£'.h($this->Session->read('balance'))?></dd>
	<br/>
	<input type='hidden' name='balance' id='balance' value='<?php echo $this->Session->read('balance')?>' disabled/>
	<dt><?php echo __('Projected New Balance'); ?></dt><dd><p id="total"><?php echo '£'.h($this->Session->read('balance'))?></p></dd>
	</div>
	<div class="col-lg-12">
	<div class="col-lg-10">
	<?php
		//echo $this->Form->input('client_id');
		echo $this->Form->input('cash_balance', array('label' => 'Amount',  'value' => '0.00'));
	?>
	</div>
	<div id = "max" class = "col-lg-2 actions"><a href ='#'>Max</a></div>
	</fieldset>
<span id = "submit"><?php echo $this->Form->end(__('Withdraw')); ?></span>
</div>
