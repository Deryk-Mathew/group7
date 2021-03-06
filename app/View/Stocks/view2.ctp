<?php 

echo $this->Html->css('toggles-full');
echo $this->Html->script('toggles');?>



	<script>
$(document).ready(function() {

	$('.toggle, #currency').toggles({
	  drag: true, // allow dragging the toggle between positions
	  click: true, // allow clicking on the toggle
	  text: {
		on: '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.concat("<?php echo $stock['StockExchange']['ExchangeRate']['currency']?>"), // text for the ON position
		off: 'GBP' // and off
	  },
	  on: true, // is the toggle ON on init
	  animate: 250, // animation time
	  transition: 'swing', // animation transition,
	  checkbox: null, // the checkbox to toggle (for use in forms)
	  clicker: null, // element that can be clicked on to toggle. removes binding from the toggle itself (use nesting)
	  width: 60, // width used if not set in css
	  height: 40, // height if not set in css
	  type: 'compact' // if this is set to 'select' then the select style toggle will be used
	});
	
	$('.toggle').on('toggle', function (e, active) {
	  if (active) {
		$('#dayslow').text("<?php if(is_null($stock['Stock']['daysLow'])){ echo '&nbsp;';}else{echo $stock['Stock']['daysLow'];}?>");
		$('#dayshigh').text("<?php if(is_null($stock['Stock']['daysHigh'])){ echo '&nbsp;';}else{echo $stock['Stock']['daysHigh'];}?>");
		$('#yearlow').text($("<?php if(is_null($stock['Stock']['yearLow'])){ echo '&nbsp;';}else{echo $stock['Stock']['yearLow'];}?>");
		$('#yearhigh').text("<?php if(is_null($stock['Stock']['yearHigh'])){ echo '&nbsp;';}else{echo $stock['Stock']['yearHigh'];}?>");
		$('#daysrange').text("<?php if(is_null($stock['Stock']['daysRange'])){ echo '&nbsp;';}else{echo $stock['Stock']['daysRange'];}?>");
		$('#price').text("<?php echo $stock['Stock']['lastTradePriceOnly']?>");
		$('#marketcap').text("<?php if(is_null($stock['Stock']['marketCapitalization'])){ echo '&nbsp;';}else{echo $stock['Stock']['marketCapitalization'];}?>");
		} else {
		$('#dayslow').text("<?php if(is_null($stock['Stock']['daysLow'])){ echo '&nbsp;';}else{
echo $this->number->precision($stock['Stock']['daysLow']*(1/$stock['StockExchange']['ExchangeRate']['rate']),2);}?>");
		$('#dayshigh').text("<?php if(is_null($stock['Stock']['daysHigh'])){ echo '&nbsp;';}else{echo $this->number->precision($stock['Stock']['daysHigh']*
(1/$stock['StockExchange']['ExchangeRate']['rate']),2);}?>");
		$('#yearlow').text("<?php if(is_null($stock['Stock']['yearLow'])){ echo '&nbsp;';}else{echo $this->number->precision($stock['Stock']['yearLow']*
(1/$stock['StockExchange']['ExchangeRate']['rate']),2);}?>");
		$('#yearhigh').text("<?php if(is_null($stock['Stock']['yearHigh'])){ echo '&nbsp;';}else{echo $this->number->precision($stock['Stock']['yearHigh']*
(1/$stock['StockExchange']['ExchangeRate']['rate']),2);}?>");
		$('#daysrange').text("<?php if(is_null($stock['Stock']['daysRange'])){ echo '&nbsp;';}else{echo $this->number->precision($stock['Stock']['daysLow']*(1/$stock['StockExchange']['ExchangeRate']['rate']),2)
." - ". $this->number->precision($stock['Stock']['daysHigh']*(1/$stock['StockExchange']['ExchangeRate']['rate']),2);}?>");
		$('#price').text("<?php echo $this->number->precision($stock['Stock']['lastTradePriceOnly']*(1/$stock['StockExchange']['ExchangeRate']['rate']),2)?>");
		$('#marketcap').text("<?php if(is_null($stock['Stock']['marketCapitalization'])){ echo '&nbsp;';}else{
	if(!is_numeric(substr($stock['Stock']['marketCapitalization']))){echo $this->number->precision(substr($stock['Stock']['marketCapitalization'],0,-1)*
(1/$stock['StockExchange']['ExchangeRate']['rate']),2).substr($stock['Stock']['marketCapitalization'],-1);} else { echo $this->number->precision($stock['Stock']['marketCapitalization']*
(1/$stock['StockExchange']['ExchangeRate']['rate']),2); }}?>");
		}
	});
	
} );
</script>


            
             <!-- ENTER INDIVIDUAL PAGE CONTENT HERE!!!!! -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo __($stock['Stock']['name']); ?></h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

<div class="stocks view">


<div class="col-xs-12 col-md-6">
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Avg Daily Vol.'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['averageDailyVolume']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Change'); ?></dt>
		<dd>
			<?php 
			if($stock['Stock']['change']>0){
				echo "<font color = 'green'>".h($stock['Stock']['change'])."%</font>";
			}
			else if($stock['Stock']['change']<0){
				echo "<font color = 'red'>".h($stock['Stock']['change'])."%</font>";
			}
			else{
				echo "0.00%";
			}	?>
			&nbsp;
		</dd>
		<dt><?php echo __('Days Low'); ?></dt>
		<dd id = "dayslow">
			<?php echo h($stock['Stock']['daysLow']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Days High'); ?></dt>
		<dd id = "dayshigh">
			<?php echo h($stock['Stock']['daysHigh']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Year Low'); ?></dt>
		<dd id = "yearlow">
			<?php echo h($stock['Stock']['yearLow']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Year High'); ?></dt>
		<dd id = "yearhigh">
			<?php echo h($stock['Stock']['yearHigh']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Market Cap.'); ?></dt>
		<dd id = "marketcap">
			<?php echo h($stock['Stock']['marketCapitalization']); ?>
			&nbsp;
		</dd>
		</dl>
		</div>
		<div class="col-xs-12 col-md-6">
		<dl>
		<dt><?php echo __('Price'); ?></dt>
		<dd id = 'price'>
			<?php echo h($stock['Stock']['lastTradePriceOnly']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Days Range'); ?></dt>
		<dd id = "daysrange">
			<?php echo h($stock['Stock']['daysRange']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Symbol'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['symbol']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Volume'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['volume']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Exchange'); ?></dt>
		<dd>
			<?php echo $stock['StockExchange']['full_name']; ?>
			&nbsp;
		</dd>
		<?php if($this->Session->read('current_client') != null){ ?>
		<div = "actions">
		<dt><?php echo __('Trade'); ?></dt>
		<dd><?php echo $this->Html->link(__('Buy Stock'), array('controller' => 'client_stocks', 'action' => 'buyStock', $stock['Stock']['id'], $this->Session->read('current_client'))); ?>&nbsp;
		
		<?php echo $this->Html->link(__('Sell Stock'), array('controller' => 'client_stocks', 'action' => 'sellStock', $stock['Stock']['id'], $this->Session->read('current_client'))); ?></dd>
		
		</div>
		
		<?php } ?>
	</dl>
	</div>
	</div>
	
	<div class="col-xs-8 col-md-2 col-lg-2">
		<div class="col-xl-11 col-md-11">
	<dt>Currency</dt>
		<div class="toggle toggle-modern" width ="70%"></div></li>
		</div>
		</div>
</div>
