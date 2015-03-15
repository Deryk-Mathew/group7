<?php 

echo $this->Html->css('toggles-full');
echo $this->Html->script('toggles');?>
	<script>
$(document).ready(function() {

	$('.toggle, #currency').toggles({
	  drag: true, // allow dragging the toggle between positions
	  click: true, // allow clicking on the toggle
	  text: {
		on: '&nbsp;&nbsp;&nbsp;&nbsp;Local('.concat($('#currency').val()).concat(')'), // text for the ON position
		off: 'GBP' // and off
	  },
	  on: true, // is the toggle ON on init
	  animate: 250, // animation time
	  transition: 'swing', // animation transition,
	  checkbox: null, // the checkbox to toggle (for use in forms)
	  clicker: null, // element that can be clicked on to toggle. removes binding from the toggle itself (use nesting)
	  width: 60, // width used if not set in css
	  height: 20, // height if not set in css
	  type: 'compact' // if this is set to 'select' then the select style toggle will be used
	});
	
	$('.toggle').on('toggle', function (e, active) {
	  if (active) {
		$('#dayslow').text($('#dayslowlocal').val());
		$('#dayshigh').text($('#dayshighlocal').val());
		$('#yearlow').text($('#yearlowlocal').val());
		$('#yearhigh').text($('#yearhighlocal').val());
		$('#daysrange').text($('#daysrangelocal').val());
		$('#price').text($('#pricelocal').val());
		} else {
		$('#dayslow').text($('#dayslowgbp').val());
		$('#dayshigh').text($('#dayshighgbp').val());
		$('#yearlow').text($('#yearlowgbp').val());
		$('#yearhigh').text($('#yearhighgbp').val());
		$('#daysrange').text($('#daysrangegbp').val());
		$('#price').text($('#pricegbp').val());
		}
	});
	
} );
</script>
<input type='hidden' id='currency' value='<?php echo $stock['StockExchange']['ExchangeRate']['currency']?>' disabled/>
<input type='hidden' id='dayslowlocal' value='<?php echo $stock['Stock']['daysLow']?>' disabled/>
<input type='hidden' id='dayslowgbp' value='<?php echo $this->number->precision($stock['Stock']['daysLow']*(1/$stock['StockExchange']['ExchangeRate']['rate']),2)?>' disabled/>
<input type='hidden' id='dayshighlocal' value='<?php echo $stock['Stock']['daysHigh']?>' disabled/>
<input type='hidden' id='dayshighgbp' value='<?php echo $this->number->precision($stock['Stock']['daysHigh']*(1/$stock['StockExchange']['ExchangeRate']['rate']),2)?>' disabled/>
<input type='hidden' id='yearlowlocal' value='<?php echo $stock['Stock']['yearLow']?>' disabled/>
<input type='hidden' id='yearlowgbp' value='<?php echo $this->number->precision($stock['Stock']['yearLow']*(1/$stock['StockExchange']['ExchangeRate']['rate']),2)?>' disabled/>
<input type='hidden' id='yearhighlocal' value='<?php echo $stock['Stock']['yearHigh']?>' disabled/>
<input type='hidden' id='yearhighgbp' value='<?php echo $this->number->precision($stock['Stock']['yearHigh']*(1/$stock['StockExchange']['ExchangeRate']['rate']),2)?>' disabled/>
<input type='hidden' id='pricelocal' value='<?php echo $stock['Stock']['lastTradePriceOnly']?>' disabled/>
<input type='hidden' id='pricegbp' value='<?php echo $this->number->precision($stock['Stock']['lastTradePriceOnly']*(1/$stock['StockExchange']['ExchangeRate']['rate']),2)?>' disabled/>
<input type='hidden' id='daysrangelocal' value='<?php echo $stock['Stock']['daysRange']?>' disabled/>
<input type='hidden' id='daysrangegbp' value='<?php echo $this->number->precision($stock['Stock']['daysLow']*(1/$stock['StockExchange']['ExchangeRate']['rate']),2)
." - ". $this->number->precision($stock['Stock']['daysHigh']*(1/$stock['StockExchange']['ExchangeRate']['rate']),2)?>' disabled/>

<div class="stocks view">
<h2><?php echo __($stock['Stock']['name']); ?></h2>

<div class="col-xs-12 col-md-6">
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('AverageDailyVolume'); ?></dt>
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
		<dt><?php echo __('DaysLow'); ?></dt>
		<dd id = "dayslow">
			<?php echo h($stock['Stock']['daysLow']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DaysHigh'); ?></dt>
		<dd id = "dayshigh">
			<?php echo h($stock['Stock']['daysHigh']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('YearLow'); ?></dt>
		<dd id = "yearlow">
			<?php echo h($stock['Stock']['yearLow']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('YearHigh'); ?></dt>
		<dd id = "yearhigh">
			<?php echo h($stock['Stock']['yearHigh']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('MarketCapitalization'); ?></dt>
		<dd>
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
		<dt><?php echo __('DaysRange'); ?></dt>
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
	<div class="col-xs-6 col-md-2 col-lg-2">
		<div class="col-xl-11 col-md-11">
	<dt>Currency</dt>
		<div class="toggle toggle-modern" width ="70%"></div></li>
		</div>
		</div>
</div>
