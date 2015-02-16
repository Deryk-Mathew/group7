  <script>
$(document).ready(function() {
    $('#stockList').dataTable();
} );
</script><div class="container-fluid">
            
             <!-- ENTER INDIVIDUAL PAGE CONTENT HERE!!!!! -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo __('Stock List'); ?></h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
<div class="stocks index">
	<table id="stockList" width="100%" cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th>Company</th>
			<th>Symbol</th>
			<th>Change</th>
			<th>Day's Low</th>
			<th>Day's High</th>
			<th>Day's Range</th>
			<th>Volume</th>
			<th>Exchange</th>
			<th class="actions"></th>
	</tr>
	</thead>
	<tbody>
		<?php $client_stocks; ?>
	<?php foreach ($stocks as $stock): ?>
	<tr>
		<td> <?php echo h($stock['Stock']['name']);  ?></td>
		<td><?php echo h($stock['Stock']['symbol']); ?>&nbsp;</td>
		<td><?php echo h($stock['Stock']['change']); ?>&nbsp;</td>
		<td><?php echo h($stock['Stock']['daysLow']); ?>&nbsp;</td>
		<td><?php echo h($stock['Stock']['daysHigh']); ?>&nbsp;</td>
		<td><?php echo h($stock['Stock']['daysRange']); ?>&nbsp;</td>
		<td><?php echo h($stock['Stock']['volume']); ?>&nbsp;</td>
		<td>
			<?php echo h($stock['StockExchange']['name']); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $stock['Stock']['id'])); ?>
			<?php if ($this->Session->read('current_client') != null): ?>
				<?php echo $this->Html->link(__('Buy'), array('controller' => 'client_stocks', 'action' => 'buyStock', $this->Session->read('current_client'), $stock['Stock']['id'])); ?>
			<?php endif; ?>
			<!-- Only show if admin logged in -->
			<?php if (AuthComponent::User('group_id') == 1): ?>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $stock['Stock']['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $stock['Stock']['id']), array(), __('Are you sure you want to delete # %s?', $stock['Stock']['id'])); ?>
			<?php endif; ?>
		</td>
	</tr>
	<?php endforeach; ?>
	</tbody>
	</table>

	
</div>
