	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script>
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
	        var data = google.visualization.arrayToDataTable([
	          ['Cash', 'Stocks'],
	          ['Cash',     <?php echo $client['Balance']['cash_balance']; ?>],
	          ['Stocks',   <?php 
			  $stocktotal = 0;
			  foreach ($client['ClientStock'] as $clientStock): 
						$stocktotal = $stocktotal + $clientStock['quantity']*$clientStock['Stock']['lastTradePriceOnly'];
						endforeach;
						echo $stocktotal;
			  
			  ?>],
	        	]);

	        var options = {
	          is3D: true,
	        };

	        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
	        chart.draw(data, options);
      }

    </script>

        
            <div class="container-fluid">
            
             <!-- ENTER INDIVIDUAL PAGE CONTENT HERE!!!!! -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo h($client['Client']['name']) . "'s Portfolio"; ?></h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                
                
				       <div class="clients index">      
	<?php if (!empty($client['ClientStock'])): ?>
<table id="stockTable" cellpadding = "0" cellspacing = "0">
			<tr>
				<th><?php echo __('Stock Name'); ?></th>
				<th><?php echo __('Stock Symbol'); ?></th>
				<th><?php echo __('Quantity'); ?></th>
				<th><?php echo __('Cost'); ?></th>
				<th><?php echo __('Average Estimated Stock Owned Price'); ?></th>
				<th><?php echo __('Current Stock Price'); ?></th>
				<th><?php echo __('Average Estimated Profit Per Stock'); ?></th>
				<th class="actions"></th>
			</tr>		   
			<?php foreach ($client['ClientStock'] as $clientStock): ?>
				<tr>
					<?php if ($clientStock['quantity'] > 0): ?>
						<td><?php echo $this->Html->link($clientStock['Stock']['name'], array('controller' => 'stocks', 'action' => 'view', $clientStock['Stock']['id'])); ?></td>
						<td><?php echo $this->Html->link($clientStock['Stock']['symbol'], array('controller' => 'stocks', 'action' => 'view', $clientStock['Stock']['id'])); ?></td>
						<td><?php echo $this->Html->link($clientStock['quantity'], array('controller' => 'stocks', 'action' => 'view', $clientStock['Stock']['id'])); ?></td>
						<td><?php echo $this->Html->link($clientStock['cost'], array('controller' => 'stocks', 'action' => 'view', $clientStock['Stock']['id'])); ?></td>

						<td><?php $aveStock = $clientStock['cost']/$clientStock['quantity']; echo h(round($aveStock,2)); ?></td>

						<td><?php echo $this->Html->link($clientStock['Stock']['lastTradePriceOnly'], array('controller' => 'stocks', 'action' => 'view', $clientStock['Stock']['id'])); ?></td>

						<td><?php $profit = $clientStock['Stock']['lastTradePriceOnly'] - $aveStock; echo h(round($profit,2));?></td>

						<td class="actions">
							<?php echo $this->Html->link(__('View'), array('controller' => 'stocks', 'action' => 'view', $clientStock['Stock']['id'])); ?>
							<?php echo $this->Html->link(__('Buy'), array('controller' => 'clientStocks', 'action' => 'buyStock', $clientStock['Stock']['id'],$clientStock['client_id'])); ?>
							<?php echo $this->Html->link(__('Sell'), array('controller' => 'clientStocks', 'action' => 'sellStock', $clientStock['Stock']['id'],$clientStock['client_id'])); ?>
						</td>
					<?php endif; ?>
				</tr>
			<?php endforeach; ?>            
<?php endif; ?>			
                
</div>
				
                
    <div class="clients view">
<div id="piechart_3d" style="width: 50%; height: 300px;"></div>
<!-- List client balance -->
	<div class="clientBalance">
	
		<h3><?php echo __('Related Balances'); ?></h3>
			<?php if (!empty($client['Balance'])): ?>
				<dl>
				<dt><?php echo __('Cash Balance'); ?></dt>
				<dd>
				<?php echo number_format((float)$client['Balance']['cash_balance'],2,'.',''); ?>
				&nbsp;</dd>
				<dt><?php echo __('Stock Balance'); ?></dt>
				<dd>
				<?php echo number_format((float)$stocktotal,2,'.',''); ?>
				&nbsp;</dd>
				<dt><?php echo __('Total Balance'); ?></dt>
				<dd>
				<?php echo number_format((float)$stocktotal + $client['Balance']['cash_balance'],2,'.',''); ?>
				&nbsp;</dd>
				</dl>
			<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Deposit'), array('controller' => 'balances', 'action' => 'deposit', $client['Balance']['id'])); ?></li>
				<li><?php echo $this->Html->link(__('Withdraw'), array('controller' => 'balances', 'action' => 'withdraw', $client['Balance']['id'])); ?></li>
				<li><?php echo $this->Html->link(__('Browse Markets'), array('controller' => 'stocks', 'action' => 'index')); ?> </li>
			</ul>

		</div>
		
		
	</div>
         


</div>



	

