<script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1','packages':['corechart']}]}"></script>
    
          
          <script>
            google.load('visualization', '1', {packages: ['corechart']});
    google.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('number', 'X');
      data.addColumn('number', 'Dogs');
      data.addColumn('number', 'Cats');

      data.addRows([
        [0, 0, 0],   [1, 10, 5],  [2, 23, 15],
        [3, 17, 9],  [4, 18, 10],  [5, 9, 5],
        [6, 11, 3],  [7, 27, 19],  [8, 33, 25],
        [9, 40, 32],  [10, 32, 24], [11, 35, 27],
        [12, 30, 22], [13, 40, 32], [14, 42, 34],
        [15, 47, 39], [16, 44, 36], [17, 48, 40],
        [18, 52, 44], [19, 54, 46], [20, 42, 34],
        [21, 55, 47], [22, 56, 48], [23, 57, 49],
        [24, 60, 52], [25, 50, 42], [26, 52, 44],
        [27, 51, 43], [28, 49, 41], [29, 53, 45],
        [30, 55, 47], [31, 60, 52], [32, 61, 53],
        [33, 59, 51], [34, 62, 54], [35, 65, 57],
        [36, 62, 54], [37, 58, 50], [38, 55, 47],
        [39, 61, 53], [40, 64, 56], [41, 65, 57],
        [42, 63, 55], [43, 66, 58], [44, 67, 59],
        [45, 69, 61], [46, 69, 61], [47, 70, 62],
        [48, 72, 64], [49, 68, 60], [50, 66, 58],
        [51, 65, 57], [52, 67, 59], [53, 70, 62],
        [54, 71, 63], [55, 72, 64], [56, 73, 65],
        [57, 75, 67], [58, 70, 62], [59, 68, 60],
        [60, 64, 56], [61, 60, 52], [62, 65, 57],
        [63, 67, 59], [64, 68, 60], [65, 69, 61],
        [66, 70, 62], [67, 72, 64], [68, 75, 67],
        [69, 80, 72]
      ]);


      var options = {
        width: 1000,
        height: 563,
        hAxis: {
          title: 'Time'
        },
        vAxis: {
          title: 'Popularity'
        },
        series: {
          1: {curveType: 'function'}
        }
      };

      var chart = new google.visualization.LineChart(document.getElementById('ex2'));

      chart.draw(data, options);
    }</script>


<div class="stocks view">
<h2><?php echo __('Stock'); ?></h2>
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
			<?php echo h($stock['Stock']['change']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DaysLow'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['daysLow']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DaysHigh'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['daysHigh']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('YearLow'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['yearLow']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('YearHigh'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['yearHigh']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('MarketCapitalization'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['marketCapitalization']); ?>
			&nbsp;
		</dd>
		</dl>
		<dl class="right-dl">
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['lastTradePriceOnly'])." ".$stock['StockExchange']['ExchangeRate']['currency']." (".number_format((float)(1/$stock['StockExchange']['ExchangeRate']['rate'])*$stock['Stock']['lastTradePriceOnly'],2,'.',''). " GBP)"; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DaysRange'); ?></dt>
		<dd>
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
			<?php echo $stock['StockExchange']['name']; ?>
			&nbsp;
		</dd>
		<?php if($this->Session->read('current_client') != null){ ?>
		<dt><?php echo __('Trade'); ?></dt>
		<dd><?php echo $this->Html->link(__('Buy Stock'), array('controller' => 'client_stocks', 'action' => 'buyStock', $stock['Stock']['id'], $this->Session->read('current_client'))); ?>&nbsp;
		
		<?php echo $this->Html->link(__('Sell Stock'), array('controller' => 'client_stocks', 'action' => 'sellStock', $stock['Stock']['id'], $this->Session->read('current_client'))); ?></dd>
		<?php } ?>
	</dl>
	<div id="ex2"></div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<?php if (AuthComponent::User('group_id') == 1): ?>
			<li><?php echo $this->Html->link(__('Edit Stock'), array('action' => 'edit', $stock['Stock']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete Stock'), array('action' => 'delete', $stock['Stock']['id']), array(), __('Are you sure you want to delete # %s?', $stock['Stock']['id'])); ?> </li>
		<?php endif; ?>
		<li><?php echo $this->Html->link(__('List Stocks'), array('action' => 'index')); ?> </li>
		<?php if ($this->Session->read('current_client') != null): ?>
			<li><?php echo $this->Html->link(__('Return To Client'), array('controller' => 'clients', 'action' => 'view', $this->Session->read('current_client'))); ?> </li>
		<?php endif; ?>
		<li><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout')); ?></li>
	</ul>
</div>
