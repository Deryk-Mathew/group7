<?php echo $this->Html->css('jquery.dataTables');?>
<script>
$(document).ready(function() {
    var table = $('#clientList').dataTable({
    		"bProcessing": true,
		"bFilter": true,
		"oLanguage": { "sSearch": "", "sProcessing": "Please wait..."},
		"aoColumnDefs": [ { "sClass": "hide_me", "aTargets": [ 0 ] } ]
    });
    $('#clientList tbody').on( 'mouseover', 'td', function () {
        	$(this).css('cursor','pointer');
            var colIdx = table.cell(this).index().column;
 
            if ( colIdx !== lastIdx ) {
                $( table.cells().nodes() ).removeClass( 'highlight' );
                $( table.column( colIdx ).nodes() ).addClass( 'highlight' );
            }
        } )
        
        $('.dataTables_filter input').attr("placeholder", "Search");
        
    $('#clientList tbody tr').click( function () {
    var aData = table.fnGetData( this );
    window.location = aData[0]; 
	} );
} );
</script>
            
            
             <!-- ENTER INDIVIDUAL PAGE CONTENT HERE!!!!! -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Clients</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
  <div class="clients index">
	<table id="clientList" class="row-border hover order-column" width="100%" cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th class = "hide_me"></th>
			<th>Name</th>
			<th>NI Num</th>
			<th>Date Registered</th>
			<th></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($clients as $client): ?>
	<tr>
		<td><?php echo $this->Html->Url(array('controller' => 'clients', 'action' => 'portfolio',$client['Client']['id'],$client['Client']['name'])); ?></td>
		<td><?php echo $client['Client']['name']; ?>&nbsp;</td>
		<td><?php echo $client['Client']['NINum']; ?>&nbsp;</td>
		<td><?php echo $client['Client']['registered']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Portfolio'), array('controller' => 'clients', 'action' => 'portfolio', $client['Client']['id'],$client['Client']['name'])); ?>
			<?php echo $this->Html->link(__('Profile'), array('controller' => 'clients', 'action' => 'profile', $client['Client']['id'],$client['Client']['name'])); ?>
		</td>

	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
</div>

