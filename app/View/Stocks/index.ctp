<?php echo $this->Html->script('jquery.dataTables'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#stockList').dataTable({
            "bProcessing": true,
            "bServerSide": true,
			"iDisplayLength": 20,
            "sAjaxSource": "<?php echo $this->Html->Url(array('controller' => 'clients', 'action' => 'ajaxData')); ?>",
			"aoColumns": [
			{mData:"symbol"},
			{mData:"name"},
			{mData:"daysHigh"},
			{mData:"daysLow"},
			{mData:"lastTradePriceOnly"},
			{
            "mData": "action"
			}
    ],
	
        });
		
		$('#stockList tbody').on( 'click', 'button', function () {
        var data = table.row( $(this).parents('tr') ).data();
        alert( "ID is: "+ data[ 5 ] );
		} );
		
    });
</script>
<div class="container-fluid">
            
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
			<th>Symbol</th>
			<th>Company</th>
			<th>Days High</th>
			<th>Days Low</th>
			<th>Price</th>
			<th></th>
			</tr>
	</thead>
	<tbody>
	<tr>
            <td colspan="7" class="dataTables_empty">Loading data from server...</td>
        </tr>
	</tbody>
	</table>
</div>
	
</div>
