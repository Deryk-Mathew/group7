
            
             <!-- ENTER INDIVIDUAL PAGE CONTENT HERE!!!!! -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Withdraw Funds from Account</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-xs-12">
<?php echo $this->Form->create('Balance'); ?>
	<fieldset>
	<?php
		//echo $this->Form->input('client_id');
		echo $this->Form->input('cash_balance', array('label' => 'Withdraw Amount',  'value' => '0.00'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
