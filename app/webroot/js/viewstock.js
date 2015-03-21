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
		$('#dayslow').text("<?php if(is_null($stock['Stock']['daysLow'])){ echo '-';}else{echo $stock['Stock']['daysLow'];}?>");
		$('#dayshigh').text("<?php if(is_null($stock['Stock']['daysHigh'])){ echo '-';}else{echo $stock['Stock']['daysHigh'];}?>");
		$('#yearlow').text("<?php if(is_null($stock['Stock']['yearLow'])){ echo '-';}else{echo $this->number->precision($stock['Stock']['yearLow'],3);}?>");
		$('#yearhigh').text("<?php if(is_null($stock['Stock']['yearHigh'])){ echo '-';}else{echo $stock['Stock']['yearHigh'];}?>");
		$('#daysrange').text("<?php if(is_null($stock['Stock']['daysRange'])){ echo '-';}else{echo $stock['Stock']['daysRange'];}?>");
		$('#price').text("<?php echo $stock['Stock']['lastTradePriceOnly']?>");
		$('#marketcap').text("<?php if(is_null($stock['Stock']['marketCapitalization'])){ echo '-';}else{echo $stock['Stock']['marketCapitalization'];}?>");
		} else {
		$('#dayslow').text("<?php if(is_null($stock['Stock']['daysLow'])){ echo '-';}else{
echo $this->number->precision($stock['Stock']['daysLow']*(1/$stock['StockExchange']['ExchangeRate']['rate']),2);}?>");
		$('#dayshigh').text("<?php if(is_null($stock['Stock']['daysHigh'])){ echo '-';}else{echo $this->number->precision($stock['Stock']['daysHigh']*
(1/$stock['StockExchange']['ExchangeRate']['rate']),2);}?>");
		$('#yearlow').text("<?php if(is_null($stock['Stock']['yearLow'])){ echo '-';}else{echo $this->number->precision($stock['Stock']['yearLow']*
(1/$stock['StockExchange']['ExchangeRate']['rate']),2);}?>");
		$('#yearhigh').text("<?php if(is_null($stock['Stock']['yearHigh'])){ echo '-';}else{echo $this->number->precision($stock['Stock']['yearHigh']*
(1/$stock['StockExchange']['ExchangeRate']['rate']),2);}?>");
		$('#daysrange').text("<?php if(is_null($stock['Stock']['daysRange'])){ echo '-';}else{echo $this->number->precision($stock['Stock']['daysLow']*(1/$stock['StockExchange']['ExchangeRate']['rate']),2)
.' - '. $this->number->precision($stock['Stock']['daysHigh']*(1/$stock['StockExchange']['ExchangeRate']['rate']),2);}?>");
		$('#price').text("<?php echo $this->number->precision($stock['Stock']['lastTradePriceOnly']*(1/$stock['StockExchange']['ExchangeRate']['rate']),2)?>");
		$('#marketcap').text("<?php 
		if(is_null($stock['Stock']['marketCapitalization'])){
			echo '-';
		}
		else if(!is_numeric($stock['Stock']['marketCapitalization'])){
			$number = $this->number->precision(substr($stock['Stock']['marketCapitalization'],0,-1)*(1/$stock['StockExchange']['ExchangeRate']['rate']),2);
			echo $number.substr($stock['Stock']['marketCapitalization'],-1);
		}
		else {
			echo $this->number->precision($stock['Stock']['marketCapitalization']*(1/$stock['StockExchange']['ExchangeRate']['rate']),2);}?>");
		}
	});
	
} );