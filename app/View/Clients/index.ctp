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
  <script>
$(document).ready(function() {
    $('#clientList').dataTable();
} );
</script>
            <div class="container-fluid">
            
             <!-- ENTER INDIVIDUAL PAGE CONTENT HERE!!!!! -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo __('Client'); ?></h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
  <div class="clients index">
	<h2><?php echo __('Clients'); ?></h2>
	<table id="clientList" width="100%" cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th>NI Num</th>
			<th>Name</th>
			<th>Date Registered</th>
			<!--<th class="actions"><?php echo __('Actions'); ?></th> -->
	</tr>
	</thead>
	<tbody>
	<?php foreach ($clients as $client): ?>
	<tr>
		<td><?php echo $this->Html->link($client['Client']['NINum'], array('controller' => 'clients', 'action' => 'view', $client['Client']['id'])); ?>&nbsp;</td>
		<td><?php echo $this->Html->link($client['Client']['name'], array('controller' => 'clients', 'action' => 'view', $client['Client']['id'])); ?>&nbsp;</td>
		<td><?php echo $this->Html->link($client['Client']['registered'], array('controller' => 'clients', 'action' => 'view', $client['Client']['id'])); ?>&nbsp;</td>
		<!-- <td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $client['Client']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $client['Client']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $client['Client']['id']), array(), __('Are you sure you want to delete # %s?', $client['Client']['id'])); ?>
		</td> -->
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
</div>

