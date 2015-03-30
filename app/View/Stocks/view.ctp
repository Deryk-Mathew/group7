<?php 

echo $this->Html->css('toggles-full');
echo $this->Html->script('toggles');
echo $this->Html->script('viewstock');
?>


             <!-- ENTER INDIVIDUAL PAGE CONTENT HERE!!!!! -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo __($stock['Stock']['name']); ?></h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
              <script>
$(document).ready(function() {

	$('.toggle, #currency').toggles({
	  drag: true, // allow dragging the toggle between positions
	  click: true, // allow clicking on the toggle
	  text: {
		on: '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.concat($('#currency').val()), // text for the ON position
		off: '&nbsp;&nbsp;&nbsp;GBP' // and off
	  },
	  on: true, // is the toggle ON on init
	  animate: 250, // animation time
	  transition: 'swing', // animation transition,
	  checkbox: null, // the checkbox to toggle (for use in forms)
	  clicker: null, // element that can be clicked on to toggle. removes binding from the toggle itself (use nesting)
	  width: 30, // width used if not set in css
	  height: 40, // height if not set in css
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
		$('#marketcap').text($('#marketcaplocal').val());
		} else {
		$('#dayslow').text($('#dayslowgbp').val());
		$('#dayshigh').text($('#dayshighgbp').val());
		$('#yearlow').text($('#yearlowgbp').val());
		$('#yearhigh').text($('#yearhighgbp').val());
		$('#daysrange').text($('#daysrangegbp').val());
		$('#price').text($('#pricegbp').val());
		$('#marketcap').text($('#marketcapgbp').val());
		}
	});
	
} );
</script>
                <input type='hidden' id="currency" value="<?php echo $stock['StockExchange']['ExchangeRate']['currency']?>" disabled/>

<input type='hidden' id='dayslowlocal' value="<?php if(is_null($stock['Stock']['daysLow'])){ echo '-';}else{echo $stock['Stock']['daysLow'].' '.$stock['StockExchange']['ExchangeRate']['currency'];}?>" disabled/>
<input type='hidden' id='dayslowgbp' value="<?php if(is_null($stock['Stock']['daysLow'])){ echo '-';}else{echo $this->Number->precision($stock['Stock']['daysLow']*(1/$stock['StockExchange']['ExchangeRate']['rate']),2).' GBP';}?>" disabled/>

<input type='hidden' id='dayshighlocal' value="<?php if(is_null($stock['Stock']['daysHigh'])){ echo '-';}else{echo $stock['Stock']['daysHigh'].' '.$stock['StockExchange']['ExchangeRate']['currency'];}?>" disabled/>
<input type='hidden' id='dayshighgbp' value="<?php if(is_null($stock['Stock']['daysHigh'])){ echo '-';}else{echo $this->Number->precision($stock['Stock']['daysHigh']*
(1/$stock['StockExchange']['ExchangeRate']['rate']),2).' GBP';}?>" disabled/>

<input type='hidden' id='yearlowlocal' value="<?php if(is_null($stock['Stock']['yearLow'])){ echo '-';}else{echo $stock['Stock']['yearLow'].' '.$stock['StockExchange']['ExchangeRate']['currency'];}?>" disabled/>
<input type='hidden' id='yearlowgbp' value="<?php if(is_null($stock['Stock']['yearLow'])){ echo '-';}else{echo $this->Number->precision($stock['Stock']['yearLow']*
(1/$stock['StockExchange']['ExchangeRate']['rate']),2).' GBP';}?>" disabled/>

<input type='hidden' id='yearhighlocal' value="<?php if(is_null($stock['Stock']['yearHigh'])){ echo '-';}else{echo $stock['Stock']['yearHigh'].' '.$stock['StockExchange']['ExchangeRate']['currency'];}?>" disabled/>
<input type='hidden' id='yearhighgbp' value="<?php if(is_null($stock['Stock']['yearHigh'])){ echo '-';}else{echo $this->Number->precision($stock['Stock']['yearHigh']*
(1/$stock['StockExchange']['ExchangeRate']['rate']),2).' GBP';}?>"disabled/>

<input type='hidden' id='pricelocal' value="<?php echo $stock['Stock']['lastTradePriceOnly'].' '.$stock['StockExchange']['ExchangeRate']['currency'];?>" disabled/>
<input type='hidden' id='pricegbp' value="<?php echo $this->Number->precision($stock['Stock']['lastTradePriceOnly']*(1/$stock['StockExchange']['ExchangeRate']['rate']),2).' GBP';?>" disabled/>

<input type='hidden' id='daysrangelocal' value="<?php if(is_null($stock['Stock']['daysRange'])){ echo '-';}else{echo $stock['Stock']['daysRange'].' '.$stock['StockExchange']['ExchangeRate']['currency'];}?>" disabled/>
<input type='hidden' id='daysrangegbp' value="<?php if(is_null($stock['Stock']['daysRange'])){ echo '-';}else{echo $this->Number->precision($stock['Stock']['daysLow']*(1/$stock['StockExchange']['ExchangeRate']['rate']),2)
.' - '. $this->Number->precision(($stock['Stock']['daysHigh']*(1/$stock['StockExchange']['ExchangeRate']['rate'])),2).' GBP';}?>" disabled/>

<input type='hidden' id='marketcaplocal' value="<?php if(is_null($stock['Stock']['marketCapitalization'])){ echo '-';}else{echo $stock['Stock']['marketCapitalization'].' '.$stock['StockExchange']['ExchangeRate']['currency'];}?>" disabled/>
<input type='hidden' id='marketcapgbp' value="<?php 
		if(is_null($stock['Stock']['marketCapitalization'])){
			echo '-';
		}
		else if(!is_numeric($stock['Stock']['marketCapitalization'])){
			$number = substr($stock['Stock']['marketCapitalization'],0,-1)*(1/$stock['StockExchange']['ExchangeRate']['rate']);
			echo $this->Number->precision($number,2).substr($stock['Stock']['marketCapitalization'],-1).' GBP';
		}
		else {
			echo $this->Number->precision($stock['Stock']['marketCapitalization']*(1/$stock['StockExchange']['ExchangeRate']['rate']),2).' GBP';}?>" disabled/>

<div class="stocks view">


<div class="col-xs-12 col-md-6">
	<dl>
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
		<dt><?php echo __('Change from Yesterday'); ?></dt>
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
		<dt><?php echo __('Average Daily Volume'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['averageDailyVolume']); ?>
			&nbsp;
		</dd>
		
		<dt><?php echo __('Days Low'); ?></dt>
		<dd id = "dayslow">
			<?php echo h($stock['Stock']['daysLow']).' '.$stock['StockExchange']['ExchangeRate']['currency']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Days High'); ?></dt>
		<dd id = "dayshigh">
			<?php echo h($stock['Stock']['daysHigh']).' '.$stock['StockExchange']['ExchangeRate']['currency']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Year Low'); ?></dt>
		<dd id = "yearlow">
			<?php echo h($stock['Stock']['yearLow']).' '.$stock['StockExchange']['ExchangeRate']['currency']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Year High'); ?></dt>
		<dd id = "yearhigh">
			<?php echo h($stock['Stock']['yearHigh']).' '.$stock['StockExchange']['ExchangeRate']['currency']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Market Cap.'); ?></dt>
		<dd id = "marketcap">
			<?php echo h($stock['Stock']['marketCapitalization']).' '.$stock['StockExchange']['ExchangeRate']['currency']; ?>
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
		</dl>
		</div>
		<div class="col-xs-12 col-md-6">
		<dl>
		<dt><?php echo __('Price'); ?></dt>
		<dd id = 'price'>
			<?php echo h($stock['Stock']['lastTradePriceOnly']).' '.$stock['StockExchange']['ExchangeRate']['currency']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Days Range'); ?></dt>
		<dd id = "daysrange">
			<?php echo h($stock['Stock']['daysRange']).' '.$stock['StockExchange']['ExchangeRate']['currency']; ?>
			&nbsp;
		</dd>
		
		
		<?php if($this->Session->read('current_client') != null){ ?>
		
		<dt> <?php echo __('Trade'); ?> </dt>
		<div class = "actions">
			<dd><?php echo $this->Html->link(__('Buy Stock'), array('controller' => 'client_stocks', 'action' => 'buyStock', $stock['Stock']['id'], $this->Session->read('current_client'))); ?> &nbsp;
				<?php if ($cansell && $ownedstock['ClientStock']['quantity']>0): ?>
		<?php echo $this->Html->link(__('Sell Stock'), array('controller' => 'client_stocks', 'action' => 'sellStock', $stock['Stock']['id'], $this->Session->read('current_client'))); ?> &nbsp; <?php endif; ?>
			</div>
			</dd>
		<?php if($cansell && $ownedstock['ClientStock']['quantity']>0){
			echo '<br/>'.$this->Session->read('current_client_name').' owns <b> '.$ownedstock['ClientStock']['quantity'].'</b> '.$stock['Stock']['name'].' stock at an average price of <b>'.$this->Number->precision($ownedstock['ClientStock']['cost']/$ownedstock['ClientStock']['quantity'],2).' GBP </b>
			for a total value of<b> '.$this->Number->precision($ownedstock['ClientStock']['cost'],2).' GBP</b>';
		}?> 
		
		
		
		<?php } ?>

	</div>
	</div>
	<div class="col-xs-8 col-md-2 col-lg-2">
		<div class="col-xl-11 col-md-11">
	<dt>Currency</dt>
		<div class="toggle toggle-modern" width ="70%"></div></li>
		</div>
		</div>
	
</div>
