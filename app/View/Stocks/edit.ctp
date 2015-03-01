<div class="container-fluid">
            
             <!-- ENTER INDIVIDUAL PAGE CONTENT HERE!!!!! -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Edit Stock</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

<div class="stocks form">
<?php echo $this->Form->create('Stock'); ?>
	<fieldset>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('averageDailyVolume');
		echo $this->Form->input('change');
		echo $this->Form->input('daysLow');
		echo $this->Form->input('daysHigh');
		echo $this->Form->input('yearsLow');
		echo $this->Form->input('marketCapatalization');
		echo $this->Form->input('lastTradePriceOnly');
		echo $this->Form->input('daysRange');
		echo $this->Form->input('name');
		echo $this->Form->input('symbol');
		echo $this->Form->input('volume');
		echo $this->Form->input('stockExchange_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

