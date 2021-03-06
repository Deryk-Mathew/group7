<link rel="stylesheet" href="//cdn.datatables.net/1.10.5/css/jquery.dataTables.css"/>
 <script>
 
 $(document).ready(function() {
	 var lastIdx = null;
    var table = $('#tranRec').dataTable({
		"bProcessing": true,
		"bFilter": true,
		"oLanguage": { "sSearch": "", "sProcessing": "Please wait..."},
		"dom" : '<"H"lfr>t<"F"ip>',
		"order": [[4, "desc" ]]

	});
	
	var ntable = $('#noteTable').dataTable({
		"bProcessing": true,
		"bFilter": true,
		"oLanguage": { "sSearch": "", "sProcessing": "Please wait..."},
		"iDisplayLength": 5,
		"bLengthChange": false
		

	});
	
	$('.dataTables_filter input').attr("placeholder", "Search");
    $('#tranRec tbody')
        .on( 'mouseover', 'td', function () {
            var colIdx = table.cell(this).index().column;
 
            if ( colIdx !== lastIdx ) {
                $( table.cells().nodes() ).removeClass( 'highlight' );
                $( table.column( colIdx ).nodes() ).addClass( 'highlight' );
            }
        } )
        .on( 'mouseleave', function () {
            $( table.cells().nodes() ).removeClass( 'highlight' );
        } );
	$('#Filter').change( function() { 
				table.fnFilter( $(this).val(),0); 
			});
} );
 
</script>
        <?php 
			  $stocktotal = 0;
			  foreach ($client['ClientStock'] as $clientStock): 
						$stocktotal = $stocktotal + $clientStock['quantity']*$clientStock['Stock']['lastTradePriceOnly'];
						endforeach;
			  
			  ?>
            
            
             <!-- ENTER INDIVIDUAL PAGE CONTENT HERE!!!!! -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo __($client['Client']['name']); ?></h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                
 
                
    <div class="clients view">

	<div class="col-xs-12 col-md-6">
	<dl>
		<!-- Only display if admin -->
		<?php if (AuthComponent::User('group_id') == ADMIN): ?>
		<dt><?php echo __('Financial Advisor'); ?></dt>
		<div class = "actions">
		<dd>
			<?php 
			if($client['User']['id'] != ADMIN){
			echo $this->Html->link($client['User']['full_name'], array('controller' => 'users', 'action' => 'view', $client['User']['id']));
			echo '&nbsp;'.$this->Html->link(__('Change FA'), array('controller' => 'clients','action' => 'edit', $client['Client']['id']));
			}
			else{
			echo 'UNASSIGNED';
			echo '&nbsp;'.$this->Html->link(__('Assign FA'), array('controller' => 'clients','action' => 'edit', $client['Client']['id']));
			} ?>
			&nbsp;
		</dd></div>
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
		<div class = "actions">
			<dd><?php echo $this->Html->link(__('Edit Client'), array('action' => 'edit', $client['Client']['id'])); ?> &nbsp;
				<?php if (AuthComponent::User('group_id') == 1): ?>
		<?php echo $this->Form->postLink(__('Delete Client'), array('action' => 'delete', $client['Client']['id']), array(), __('Are you sure you want to delete # %s?', $client['Client']['id'])); ?> &nbsp; <?php endif; ?>
			<?php 
			if($client['User']['id'] != ADMIN){
			echo $this->Form->postLink(__('Unassign Client'), array('action' => 'remove', $client['Client']['id']), array(), __('Are you sure you want to remove %s?', $client['Client']['name']));} ?> &nbsp;</div>
			</dd>
	</dl>
	
	
	 </div>
	 
<?php if (AuthComponent::User('group_id') == FA){ ?>
<!-- List all client notes -->
	<div class="col-xs-12 col-md-6">
		<h3><?php echo __('Notes'); ?></h3>
		<?php if (!empty($client['Note'])): ?>
	<table id = "noteTable" cellpadding = "0" cellspacing = "0">
	<thead>
	<tr role ="row">
			
			
				<th><?php echo __('Subject'); ?></th>
				<th><?php echo __('Body'); ?></th>
				<th><?php echo __('Created'); ?></th>
				<th></th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($client['Note'] as $note): ?>
				<tr>
			<td><?php echo $this->Html->link($note['title'], array('controller' => 'notes', 'action' => 'view', $note['id'])); ?></td>
			<?php $content = $note['body']; if(strlen($content)>10) $content = substr($content,0,10)."...";?>
			<td><?php echo $this->Html->link($content, array('controller' => 'notes', 'action' => 'view', $note['id'])); ?></td>
			<td><?php echo $this->Html->link($note['created'], array('controller' => 'notes', 'action' => 'view', $note['id'])); ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'notes', 'action' => 'view', $note['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'notes', 'action' => 'edit', $note['id'],$this->Session->read('current_client'))); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'notes', 'action' => 'delete', $note['id'],$this->Session->read('current_client')), array(), __('Are you sure you want to delete this note?')); ?>
			</td>
		</tr>
		<?php endforeach; ?>
		</tbody>
		</table>
			<?php endif; ?>
			
			<div class="actions">
		<ul>
		<li><?php echo $this->Html->link(__('New Note'), array('controller' => 'notes', 'action' => 'add',$this->Session->read('current_client'))); ?></i>
		</ul>
	</div>
		</div>
		</div>
	
	
  

	<?php if (!empty($client['TransactionRecord'])): ?>
<table id="tranRec" class="row-border hover order-column" cellpadding = "0" cellspacing = "0">

 	<div class="col-xs-12 col-md-6">  
			<h3><?php echo __('Transaction Record'); ?></h3>	
			<div id ="filter">
			<?php	

			$options["STOCK"] = "Stocks";
			$options["CASH"] = "Cash";
			echo $this->Form->input('Filter', array(
				'options' => $options,
				'empty' => 'All'
			));
			?>
			</div>
			<thead>
			<tr role = "row">
			
				<th><?php echo __('Type'); ?></th>
				<th><?php echo __('Description'); ?></th>
				<th><?php echo __('In'); ?></th>
				<th><?php echo __('Out'); ?></th>
				<th><?php echo __('Date'); ?></th>
			</tr>
			</thead>	

<tbody>			
			<?php foreach ($client['TransactionRecord'] as $transrec): ?>
				<tr>
						<td><?php echo $transrec['TransactionType']['type']; ?></td>
						<?php if ($transrec['type'] == CASH){ ?>
						<td><?php if ($transrec['balance_change'] >= 0): echo "DEPOSIT"; endif;
						if ($transrec['balance_change'] < 0): echo "WITHDRAWAL"; endif;?></td>
						<?php if ($transrec['balance_change'] > 0): ?><td><?php echo $transrec['balance_change']; ?></td><td><?php echo "-"; ?></td><?php endif; ?>
						<?php if ($transrec['balance_change'] < 0): ?><td><?php echo "-"; ?></td><td><?php echo $transrec['balance_change']*-1; ?></td><?php endif; ?>
						<?php } else {?>
						<td><?php echo $this->Html->link($transrec['Stock']['symbol'], array('controller' => 'stocks', 'action' => 'view', $transrec['Stock']['id']));
						if ($transrec['balance_change'] > 0): echo " PURCHASE ".$transrec['quantity']." @ ".$transrec['balance_change']/$transrec['quantity']; endif;
						if ($transrec['balance_change'] <= 0): echo " SALE ".$transrec['quantity']." @ ".$transrec['balance_change']/$transrec['quantity']*-1; endif;?></td>
						<?php if ($transrec['balance_change'] < 0): ?><td><?php echo $transrec['balance_change']*-1; ?></td><td><?php echo "-"; ?></td><?php endif; ?>
						<?php if ($transrec['balance_change'] > 0): ?><td><?php echo "-"; ?></td><td><?php echo $transrec['balance_change']; ?></td><?php endif; ?>
						<?php }?>
						<?php if ($transrec['balance_change'] == 0): ?><td><?php echo "-"; ?></td><td><?php echo "-"; ?></td><?php endif; ?>
						<td><?php echo $transrec['date']; ?></td>
				</tr>
			<?php endforeach; ?>  
			</tbody>
			</div>          
<?php endif; ?>			
                



</div>                   


</div>

<?php } ?>



	

