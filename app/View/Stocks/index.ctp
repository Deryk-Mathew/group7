<?php echo $this->Html->script('jquery.dataTables'); ?>
<script type="text/javascript">
   
$(document).ready(function() {
        var table = $('#stockList').dataTable({

            "bProcessing": true,
            "bServerSide": true,
			"bFilter": true,
			"iDisplayLength": 15,
			"stateSave": true,
            "sAjaxSource": "<?php echo $this->Html->Url(array('controller' => 'clients', 'action' => 'ajaxData')); ?>",
			"aoColumns": [
			{mData:"id", "bVisible":false,"bSearchable":false},
			{mData:"symbol"},
			{mData:"name"},
			{mData:"exchange_id","bVisible":false},
			{mData:"change","bSearchable":false},
			{mData:"lastTradePriceOnly","bSearchable":false},
			{"mData": "action","sClass": "actions","bSortable":false,"bSearchable":false}
			],
			
			"fnDrawCallback": function() {
			$("#stockList tbody td").click(function() {
			var position = table.fnGetPosition(this); // getting the clicked row position
			var aData = table.fnGetData(position[0]); // getting the value of the first (invisible) column
			document.location.href = "stocks/view/"+aData['id'];
			});},
			
			

	
        });
		$('#stockList tbody')
        .on( 'mouseover', 'td', function () {
				$(this).css('cursor','pointer');
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
				table.fnFilter( $(this).val(),3); 
			});
			
		
    });
</script>

            
             <!-- ENTER INDIVIDUAL PAGE CONTENT HERE!!!!! -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo __('Markets'); ?></h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
<div class="stocks index">
	<?php	
$options = array();
foreach($exchanges as $exchange){
	$options[$exchange['StockExchange']['id']] = $exchange['StockExchange']['full_name'];
}
echo $this->Form->input('Filter', array(
    'options' => $options,
    'empty' => 'All'
));
?>
	<table id="stockList" class="row-border hover order-column" width="100%" cellpadding="0" cellspacing="0">
	
	<thead>
	<tr>
			<th></th>
			<th>Symbol</th>
			<th>Company</th>
			<th>Exchange</th>
			<th>Change</th>
			<th>Price</th>
			<th></th>
			</tr>
	</thead>
	<tfoot>
			<tr>
			<th></th>
			<th>Symbol</th>
			<th>Company</th>
			<th>Exchange</th>
			<th>Change</th>
			<th>Price</th>
			<th></th>
			</tr>
	</tfoot>
	<tbody>
	<tr>
            <td colspan="7" class="dataTables_empty">Loading data from server...</td>
        </tr>
	</tbody>
	</table>

</div>
	
</div>
