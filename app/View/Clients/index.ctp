<script>
$(document).ready(function() {
    $('#clientList').dataTable();
} );
</script>
            <div class="container-fluid">
            
             <!-- ENTER INDIVIDUAL PAGE CONTENT HERE!!!!! -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Clients</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
  <div class="clients index">
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
		<td><?php echo $this->Html->link($client['Client']['NINum'], array('controller' => 'clients', 'action' => 'portfolio', $client['Client']['id'],$client['Client']['name'])); ?>&nbsp;</td>
		<td><?php echo $this->Html->link($client['Client']['name'], array('controller' => 'clients', 'action' => 'portfolio', $client['Client']['id'],$client['Client']['name'])); ?>&nbsp;</td>
		<td><?php echo $this->Html->link($client['Client']['registered'], array('controller' => 'clients', 'action' => 'portfolio', $client['Client']['id'],$client['Client']['name'])); ?>&nbsp;</td>
		<!-- <td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'portfolio', $client['Client']['id'],$client['Client']['name'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $client['Client']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $client['Client']['id']), array(), __('Are you sure you want to delete # %s?', $client['Client']['id'])); ?>
		</td> -->
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
</div>

