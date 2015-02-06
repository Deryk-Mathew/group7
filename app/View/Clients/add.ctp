                    	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script>
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
	        var data = google.visualization.arrayToDataTable([
	          ['Cash', 'Stocks'],
	          ['Cash',     <?php echo $client['Balance']['cash_balance']; ?>],
	          ['Stocks',   1420.01],
	        	]);

	        var options = {
	          title: 'Asset Balance',
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
                        <h1 class="page-header">Add New Client</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                
   <div class="clients form">
<?php echo $this->Form->create('Client'); ?>
	<fieldset>
		<legend><?php echo __('Add Client'); ?></legend>
	<?php
		//echo $this->Form->input('user_id');
		echo $this->Form->input('NINum');
		echo $this->Form->input('name');
		echo $this->Form->input('street');
		echo $this->Form->input('town');
		echo $this->Form->input('county');
		echo $this->Form->input('postcode');
		echo $this->Form->input('registered');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
         
                
                
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

	<!-- List all client stocks -->
	<div class="related" style="visibility: hidden;">

	<?php if (!empty($client['ClientStock'])): ?>
		<table id="stockTable" cellpadding = "0" cellspacing = "0">
			<tr>
				<th><?php echo __('Stock Name'); ?></th>
				<th><?php echo __('Stock Symbol'); ?></th>
				<th><?php echo __('Quantity'); ?></th>
				<th><?php echo __('Cost'); ?></th>
				<th><?php echo __('Purchase Date'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
			<?php foreach ($client['ClientStock'] as $clientStock): ?>
				<tr>
					<td><?php echo $this->Html->link($clientStock['Stock']['name'], array('controller' => 'stocks', 'action' => 'view', $clientStock['Stock']['id'])); ?></td>
					<td><?php echo $this->Html->link($clientStock['Stock']['symbol'], array('controller' => 'stocks', 'action' => 'view', $clientStock['Stock']['id'])); ?></td>
					<td><?php echo $this->Html->link($clientStock['quantity'], array('controller' => 'stocks', 'action' => 'view', $clientStock['Stock']['id'])); ?></td>
					<td><?php echo $this->Html->link($clientStock['cost'], array('controller' => 'stocks', 'action' => 'view', $clientStock['Stock']['id'])); ?></td>
					<td><?php echo $this->Html->link($clientStock['purchase'], array('controller' => 'stocks', 'action' => 'view', $clientStock['Stock']['id'])); ?></td>
					<td><?php $stock_value =  $clientStock['Stock']['lastTradePriceOnly'] * $clientStock['quantity']; ?></td>
					<td class="actions">
						<?php echo $this->Html->link(__('View'), array('controller' => 'stocks', 'action' => 'view', $clientStock['Stock']['id'])); ?>
						<?php echo $this->Html->link(__('Buy'), array('controller' => 'clientStocks', 'action' => 'buyStock', $clientStock['Stock']['id'], $clientStock['Stock']['lastTradePriceOnly'])); ?>
						<?php echo $this->Form->postLink(__('Sell'), array('controller' => 'clientStocks', 'action' => 'edit', $clientStock['id'])); ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
	<?php endif; ?>

	
</div>


</div>



	






