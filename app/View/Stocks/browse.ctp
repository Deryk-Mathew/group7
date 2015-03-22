<?php 
echo $this->Html->css('jquery.dataTables');
echo $this->Html->css('toggles-full');
echo $this->Html->script('toggles');?>
<script type="text/javascript">
   
$(document).ready(function() {
        var table = $('#stockList').dataTable({

           		"bProcessing": true,
           		"bServerSide": true,
			"bFilter": true,
			"oLanguage": { "sSearch": "", "sProcessing": "Please wait..."},
			"iDisplayLength": 10,
			"sDom": '<"H"rl<"toolbar">f>tip',
            		"sAjaxSource": "<?php echo $this->Html->Url(array('controller' => 'stocks', 'action' => 'ajaxData')); ?>",
			"aoColumns": [
			{mData:"id", "bVisible":false,"bSearchable":false},
			{mData:"symbol"},
			{mData:"name"},
			{mData:"exchange_id","bVisible":false},
			{mData:"exchange_name","bSortable":false},
			{mData:"change","bSearchable":false},
			{mData:"lastTradePriceOnly","bSearchable":false},
			{mData:"gbp_price","bSearchable":false,"bVisible":false},
			{"mData": "action","sClass": "actions","bSortable":false,"bSearchable":false}
			],
			
			"fnDrawCallback": function() {
			$("#stockList tbody td").click(function() {
			var position = table.fnGetPosition(this); // getting the clicked row position
			var aData = table.fnGetData(position[0]); // getting the value of the first (invisible) column
			document.location.href = "view/"+aData['id'];
			});},
			
			

	
        });
		$("div.toolbar").html("<div class='col-xs-8 col-md-1 col-lg-1'><div class='col-xl-11 col-md-11'><div class='toggle toggle-modern'></div></div></div>");
		
		$('.dataTables_filter input').attr("placeholder", "Search");
		
		$("[id='Filter by Exchange']").change( function() { 
				table.fnFilter( $(this).val(),3); 
			});
			
		$('.toggle, #currency').toggles({
	  drag: true, // allow dragging the toggle between positions
	  click: true, // allow clicking on the toggle
	  text: {
		on: '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Local', // text for the ON position
		off: 'GBP' // and off
	  },
	  on: true, // is the toggle ON on init
	  animate: 250, // animation time
	  transition: 'swing', // animation transition,
	  checkbox: null, // the checkbox to toggle (for use in forms)
	  clicker: null, // element that can be clicked on to toggle. removes binding from the toggle itself (use nesting)
	  width: 60, // width used if not set in css
	  height: 25, // height if not set in css
	  type: 'compact' // if this is set to 'select' then the select style toggle will be used
	});
	$('#stockList tbody').on( 'mouseover', 'td', function () {
        	$(this).css('cursor','pointer');
            var colIdx = table.cell(this).index().column;
 
            if ( colIdx !== lastIdx ) {
                $( table.cells().nodes() ).removeClass( 'highlight' );
                $( table.column( colIdx ).nodes() ).addClass( 'highlight' );
            }
        } )
	$('.toggle').on('toggle', function (e, active) {
	  if (active) {
			var bVis = table.fnSettings().aoColumns[6].bVisible;
			table.fnSetColumnVis( 6, bVis ? false : true );
			var bVis = table.fnSettings().aoColumns[7].bVisible;
			table.fnSetColumnVis( 7, bVis ? false : true );
		} else {
			var bVis = table.fnSettings().aoColumns[6].bVisible;
			table.fnSetColumnVis( 6, bVis ? false : true );
			var bVis = table.fnSettings().aoColumns[7].bVisible;
			table.fnSetColumnVis( 7, bVis ? false : true );
		}
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
echo $this->Form->input('Filter by Exchange', array(
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
			<th></th>
			<th>Exchange</th>
			<th>Change</th>
			<th>Price</th>
			<th>Price</th>
			<th></th>
			</tr>
	</thead>
	<tfoot>
			<tr>
			<th></th>
			<th>Symbol</th>
			<th>Company</th>
			<th></th>
			<th>Exchange</th>
			<th>Change</th>
			<th>Price</th>
			<th>Price</th>
			<th></th>
			</tr>
	</tfoot>
	<tbody>
	<tr>
            <td colspan="9" class="dataTables_empty">Loading data from server...</td>
        </tr>
	</tbody>
	</table>

</div>
	
</div>
