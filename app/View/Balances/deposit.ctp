<script type="text/javascript">
$(document).ready(function() {
$('#BalanceCashBalance, #balance').on('input',function() {
    var qty = parseFloat($('#BalanceCashBalance').val());
	var price = parseFloat($('#balance').val());
	$('#total').text("£".concat((price+qty) ? (price+qty) : price));
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
	<dt><?php echo __('Projected New Balance'); ?></dt><dd><p id="total"><?php echo '£'.h($this->Session->read('balance'))?></p></dd>
	</div>
	<?php
		echo $this->Form->input('cash_balance', array('label' => 'Deposit Amount', 'value' => '0.00'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Deposit')); ?>
</div>
