	<script>
$(document).ready(function() {
	var lastIdx = null;
    var table = $('#stockTable').dataTable({
		
		"bProcessing": true,
		"bFilter": true,
		"aoColumnDefs": [ { "sClass": "hide_me", "aTargets": [ 0 ] } ]
		
	});
	$('#stockTable tbody')
        .on( 'mouseover', 'td', function () {
            var colIdx = table.cell(this).index().column;
 
            if ( colIdx !== lastIdx ) {
                $( table.cells().nodes() ).removeClass( 'highlight' );
                $( table.column( colIdx ).nodes() ).addClass( 'highlight' );
            }
        } )
		
	$('#stockTable tbody tr').click( function () {
    var aData = table.fnGetData( this );
    window.location = aData[0]; 
	} );
		
} );
</script>
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
<table id="stockTable" class="row-border hover order-column" cellpadding = "0" cellspacing = "0">
<thead>
			<tr>
			<th class = "hide_me"></th>
			<th><?php echo __('Symbol'); ?></th>
				<th><?php echo __('Name'); ?></th>
				<th><?php echo __('Quantity'); ?></th>
				<th><?php echo __('Average Price'); ?></th>
				<th><?php echo __('Current Price'); ?></th>
				<th><?php echo __('Total Cost'); ?></th>
				<th><?php echo __('Total Valuation'); ?></th>
				<th class="actions"></th>
			</tr>	
</thead>
<tbody>			
			<?php foreach ($client['ClientStock'] as $clientStock): ?>
				
					<?php if ($clientStock['quantity'] > 0): ?>
					<tr>
					<td><?php echo $this->Html->Url(array('controller' => 'stocks', 'action' => 'view',$clientStock['Stock']['id'])); ?></td>
						<td><?php echo $clientStock['Stock']['symbol']; ?></td>
						<td><?php echo $clientStock['Stock']['name']; ?></td>
						<td><?php echo $clientStock['quantity']; ?></td>
						

						<td><?php $aveStock = $clientStock['cost']/$clientStock['quantity']; echo h(round($aveStock,2)); ?></td>

						<td><?php echo $clientStock['Stock']['lastTradePriceOnly']*(1/$clientStock['Stock']['StockExchange']['ExchangeRate']['rate']); ?></td>
						<td><?php echo $clientStock['cost']; ?></td>
						<td><?php echo $clientStock['Stock']['lastTradePriceOnly']*(1/$clientStock['Stock']['StockExchange']['ExchangeRate']['rate'])*$clientStock['quantity']; ?></td>


						<td class="actions">
							<?php echo $this->Html->link(__('View'), array('controller' => 'stocks', 'action' => 'view', $clientStock['Stock']['id'])); ?>
							<?php echo $this->Html->link(__('Buy'), array('controller' => 'clientStocks', 'action' => 'buyStock', $clientStock['Stock']['id'],$clientStock['client_id'])); ?>
							<?php echo $this->Html->link(__('Sell'), array('controller' => 'clientStocks', 'action' => 'sellStock', $clientStock['Stock']['id'],$clientStock['client_id'])); ?>
						</td>
						</tr>
					<?php endif; ?>
				
			<?php endforeach; ?>
</tbody>			
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
				<li><?php echo $this->Html->link(__('Deposit'), array('controller' => 'balances', 'action' => 'deposit', $client['Client']['id'])); ?></li>
				<li><?php echo $this->Html->link(__('Withdraw'), array('controller' => 'balances', 'action' => 'withdraw', $client['Client']['id'])); ?></li>
				<li><?php echo $this->Html->link(__('Browse Markets'), array('controller' => 'stocks', 'action' => 'index')); ?> </li>
			</ul>

		</div>
		
		
	</div>
         


</div>



	

