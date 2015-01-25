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

<div class="clients view">

<h2><?php echo __('Client'); ?></h2>
	<dl>
		<!-- Only display if admin -->
		<?php if (AuthComponent::User('group_id') == 1): ?>
			<dt><?php echo __('User'); ?></dt>
			<dd>
				<?php echo $this->Html->link($client['User']['full_name'], array('controller' => 'users', 'action' => 'view', $client['User']['id'])); ?>
				&nbsp;
			</dd>
		<?php endif; ?>
		<dt><?php echo __('NINum'); ?></dt>
		<dd>
			<?php echo h($client['Client']['NINum']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($client['Client']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Street'); ?></dt>
		<dd>
			<?php echo h($client['Client']['street']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Town'); ?></dt>
		<dd>
			<?php echo h($client['Client']['town']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('County'); ?></dt>
		<dd>
			<?php echo h($client['Client']['county']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Postcode'); ?></dt>
		<dd>
			<?php echo h($client['Client']['postcode']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Registered'); ?></dt>
		<dd>
			<?php echo h($client['Client']['registered']); ?>
			&nbsp;
		</dd>
		<dt> <?php echo __('Actions'); ?> </dt>
			<dd><?php echo $this->Html->link(__('Edit Client'), array('action' => 'edit', $client['Client']['id'])); ?> &nbsp;
				<?php if (AuthComponent::User('group_id') == 1): ?>
		<?php echo $this->Form->postLink(__('Delete Client'), array('action' => 'delete', $client['Client']['id']), array(), __('Are you sure you want to delete # %s?', $client['Client']['id'])); ?> &nbsp; <?php endif; ?>
			<?php echo $this->Form->postLink(__('Remove Client'), array('action' => 'remove', $client['Client']['id']), array(), __('Are you sure you want to remove # %s?', $client['Client']['id'])); ?> &nbsp;
			</dd>
	</dl>

<div id="piechart_3d" style="width: 400px; height: 300px;"></div>

</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Clients'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Stocks'), array('controller' => 'stocks', 'action' => 'index', $client['Client']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout')); ?></li>
	</ul>
</div>

	<!-- List client balance -->
	<div class="related">
		<h3><?php echo __('Related Balances'); ?></h3>
			<?php if (!empty($client['Balance'])): ?>
				<dl>
				<dt><?php echo __('Cash Balance'); ?></dt>
				<dd>
				<?php echo $client['Balance']['cash_balance']; ?>
				&nbsp;</dd>
				<dt><?php echo __('Stock Balance'); ?></dt>
				<dd>
				<?php echo "Dummy"; ?>
				&nbsp;</dd>
				<dt><?php echo __('Total Balance'); ?></dt>
				<dd>
				<?php echo "Dummy"; ?>
				&nbsp;</dd>
				</dl>
			<?php endif; ?>

		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Deposit'), array('controller' => 'balances', 'action' => 'deposit', $client['Balance']['id'])); ?></li>
				<li><?php echo $this->Html->link(__('Withdraw'), array('controller' => 'balances', 'action' => 'withdraw', $client['Balance']['id'])); ?></li>
			</ul>
		</div>
	</div>
	
	<!-- List all client stocks -->
	<div class="related">
	<h3><?php echo __('Related Client Stocks'); ?></h3>

	<?php if (!empty($client['ClientStock'])): ?>
		<table id="stockTable" cellpadding = "0" cellspacing = "0">
			<tr>
				<th><?php echo __('Stock Name'); ?></th>
				<th><?php echo __('Stock Symbol'); ?></th>
				<th><?php echo __('Quantity'); ?></th>
				<th><?php echo __('Cost'); ?></th>
				<th><?php echo __('Average Stock Owned Price'); ?></th>
				<th><?php echo __('Current Stock Price'); ?></th>
				<th><?php echo __('Average Profit Per Stock'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
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
						<?php echo $this->Html->link(__('Buy'), array('controller' => 'clientStocks', 'action' => 'buyStock', $clientStock['client_id'], $clientStock['Stock']['id'])); ?>
						<?php echo $this->Html->link(__('Sell'), array('controller' => 'clientStocks', 'action' => 'sellStock', $clientStock['client_id'], $clientStock['Stock']['id'])); ?>
					</td>
				<?php endif; ?>
				</tr>
			<?php endforeach; ?>
		</table>
	<?php endif; ?>

	<!-- Add new stock to client -->
	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('Buy New Stock'), array('controller' => 'stocks', 'action' => 'index')); ?> </li>
		</ul>
	</div>
</div>

<!-- List all client notes -->
<div class="related">
	<h3><?php echo __('Related Notes'); ?></h3>
	<?php if (!empty($client['Note'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($client['Note'] as $note): ?>
		<tr>
			<td><?php echo $this->Html->link($note['created'], array('controller' => 'notes', 'action' => 'view', $note['id'])); ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'notes', 'action' => 'view', $note['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'notes', 'action' => 'edit', $note['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'notes', 'action' => 'delete', $note['id']), array(), __('Are you sure you want to delete # %s?', $note['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
	<!-- Add new client note -->
	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Note'), array('controller' => 'notes', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>



	

