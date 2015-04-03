<script type="text/javascript">
$(document).ready(function() {
$('#BalanceCashBalance, #balance').on('input',function() {
    	var amount = parseFloat($('#BalanceCashBalance').val());
	var balance = parseFloat($('#balance').val());
	var newbalance = parseFloat(balance+amount).toFixed(2);
	if(!$.isNumeric($('#BalanceCashBalance').val()) || (amount>(999999999999999999-balance)) || (amount<0.01)){
		$('#total').text("Invalid quantity entered.").css("color", "red").css("font-weight","Bold");
		$('#submit').css('visibility','hidden');
	}
	else{
		$('#total').text("£"+newbalance).css("color", "black").css("font-weight","Normal");
		$('#submit').css('visibility','visible');
	}
});



});
</script>
            
             <!-- ENTER INDIVIDUAL PAGE CONTENT HERE!!!!! -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Deposit Funds to Account</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-xs-12">
<?php echo $this->Form->create('Balance'); ?>
	<fieldset>
	<div class = "stocks view">
	<dt><?php echo __('Deposit for Client'); ?></dt><dd><?php echo h($this->Session->read('current_client_name'))?></dd>
	<dt><?php echo __('Current Client Balance'); ?></dt><dd><?php echo '£'.h($this->Session->read('balance'))?></dd>
	<br/>
	<input type='hidden' name='balance' id='balance' value='<?php echo $this->Session->read('balance')?>' disabled/>
	<dt><?php echo __('Projected New Balance'); ?></dt><dd><p id="total"><?php echo '£'.h($this->Session->read('balance')+$default)?></p></dd>
	</div>
	<?php
		echo $this->Form->input('cash_balance', array('label' => 'Deposit Amount', 'value' => $default));
	?>
	</fieldset>
<span id = "submit"><?php echo $this->Form->end(__('Deposit')); ?></span>
</div>
