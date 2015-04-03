<style> /* set the CSS */

#chart { font: 12px Arial;}

path { 
    stroke: steelblue;
    stroke-width: 2;
    fill: none;
}

text.shadow {
    stroke: white;
    stroke-width: 2.5px;
    opacity: 0.9;
}

.axis path,
.axis line {
    fill: none;
    stroke: grey;
    stroke-width: 1;
    shape-rendering: crispEdges;
}

</style>
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
		</dl>
		</div>
		<div class="col-xs-12 col-md-6">
		
		
		
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
		
		<div id="chart"></div>
		<br/>
		<p style="padding-left: 10%;">Historical Performance of <b><?php echo h($stock['Stock']['name']); ?></b> in the last 6 months [Currency: <?php echo $stock['StockExchange']['ExchangeRate']['currency']?>] </p>


<!-- load the d3.js library -->    
<script src="http://d3js.org/d3.v3.min.js"></script>

<script>

// Set the dimensions of the graph
var margin = {top: 30, right: 40, bottom: 30, left: 50},
   width = 650 - margin.left - margin.right,
   height = 270 - margin.top - margin.bottom;

// Parse the date / time
var parseDate = d3.time.format("%Y-%m-%d").parse;

// Set the ranges
var x = d3.time.scale().range([0, width]);
var y = d3.scale.linear().range([height, 0]);

var xAxis = d3.svg.axis().scale(x)
   .orient("bottom").ticks(5);

var    yAxis = d3.svg.axis().scale(y)
   .orient("left").ticks(5);

var valueline = d3.svg.line()
   .x(function(d) { return x(d.date); })
   .y(function(d) { return y(d.high); });
   
 
var svg = d3.select("#chart")
   .append("svg")
       .attr("width", width + margin.left + margin.right)
       .attr("height", height + margin.top + margin.bottom)
     .append("g")
       .attr("transform", "translate(" 
           + (margin.left + 30)
           + "," + margin.top + ")");

var stock = "<?php echo h($stock['Stock']['symbol']); ?>";
<?php 
$date = new DateTime();
?>
var end = "<?php echo date_format($date, 'Y-m-d'); ?>";
<?php
date_sub($date, date_interval_create_from_date_string('6 months')); ?>
var start = "<?php echo date_format($date, 'Y-m-d'); ?>";


var inputURL = "http://query.yahooapis.com/v1/public/yql"+
    "?q=select%20*%20from%20yahoo.finance.historicaldata%20"+
    "where%20symbol%20%3D%20%22"
    +stock+"%22%20and%20startDate%20%3D%20%22"
    +start+"%22%20and%20endDate%20%3D%20%22"
    +end+"%22&format=json&env=store%3A%2F%2F"
    +"datatables.org%2Falltableswithkeys";

    // Get the data 
    d3.json(inputURL, function(error, data){

    data.query.results.quote.forEach(function(d) {
        d.date = parseDate(d.Date);
        d.high = +d.High;
        d.low = +d.Low;
    });

    // Scale the range of the data
    x.domain(d3.extent(data.query.results.quote, function(d) {
        return d.date; }));
    y.domain([
        d3.min(data.query.results.quote, function(d) { return d.low; }), 
        d3.max(data.query.results.quote, function(d) { return d.high; })
    ]);

    svg.append("path")        // Add the valueline path.
        .attr("class", "line")
        .attr("d", valueline(data.query.results.quote));

    svg.append("g")            // Add the X Axis
        .attr("class", "x axis")
        .attr("transform", "translate(0," + 210 + ")")
        .call(xAxis);

    svg.append("g")            // Add the Y Axis
        .attr("class", "y axis")
        .call(yAxis);

    svg.append("text")          // Add the label
        .attr("class", "label")
        .attr("transform", "translate(" + (510+3) + "," 
            + y(data.query.results.quote[0].high) + ")")
        .attr("dy", ".35em")
        .attr("text-anchor", "start")
        .style("fill", "steelblue")
        .text("price");

    svg.append("text")          // Add the title shadow
        .attr("x", (510 / 2))
        .attr("y", margin.top / 2)
        .attr("text-anchor", "middle")
        .attr("class", "shadow")
        .style("font-size", "16px")
        .text("<?php echo h($stock['Stock']['symbol']);  ?>");
        
    svg.append("text")          // Add the title
        .attr("class", "stock")
        .attr("x", (510 / 2))
        .attr("y", margin.top / 2)
        .attr("text-anchor", "middle")
        .style("font-size", "16px")
        .text("<?php echo h($stock['Stock']['symbol']);  ?>");
});

// ** Update data section (Called from the onclick)
function updateData() {

var stock = "<?php echo h($stock['Stock']['symbol']); ?>";





var start = document.getElementById('start').value;
var end = document.getElementById('end').value;

var inputURL = "http://query.yahooapis.com/v1/public/yql"+
    "?q=select%20*%20from%20yahoo.finance.historicaldata%20"+
    "where%20symbol%20%3D%20%22"
    +stock+"%22%20and%20startDate%20%3D%20%22"
    +start+"%22%20and%20endDate%20%3D%20%22"
    +end+"%22&format=json&env=store%3A%2F%2F"
    +"datatables.org%2Falltableswithkeys";

    // Get the data again
    d3.json(inputURL, function(error, data){

        data.query.results.quote.forEach(function(d) {
            d.date = parseDate(d.Date);
            d.high = +d.High;
            d.low = +d.Low;
        });

        // Scale the range of the data
        x.domain(d3.extent(data.query.results.quote, function(d) {
            return d.date; }));
        y.domain([
            d3.min(data.query.results.quote, function(d) { 
                return d.low; }), 
            d3.max(data.query.results.quote, function(d) { 
                return d.high; })
        ]);

        // Select the section we want to apply our changes to
        var svg = d3.select("body").transition();

        // Make the changes
        svg.select(".line")    // change the line
            .duration(750) 
            .attr("d", valueline(data.query.results.quote));

        svg.select(".label")   // change the label text
            .duration(750)
            .attr("transform", "translate(" + (510+3) + "," 
            + y(data.query.results.quote[0].high) + ")");
 
        svg.select(".shadow") // change the title shadow
            .duration(750)
            .text(stock);  
             
        svg.select(".stock")   // change the title
            .duration(750)
            .text(stock);
     
        svg.select(".x.axis") // change the x axis
            .duration(750)
            .call(xAxis);
        svg.select(".y.axis") // change the y axis
            .duration(750)
            .call(yAxis);

    });
}

</script>

	</div>

	</div>
	<div class="col-xs-8 col-md-2 col-lg-2">
		<div class="col-xl-11 col-md-11">
	<dt>Currency</dt>
		<div class="toggle toggle-modern" width ="70%"></div></li>
		</div>
		</div>
	
</div>