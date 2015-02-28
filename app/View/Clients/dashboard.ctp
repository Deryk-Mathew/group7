            <div class="container-fluid">
            
             <!-- ENTER INDIVIDUAL PAGE CONTENT HERE!!!!! -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Dashboard</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
	  <div class="clients index">
	<table id="clientList" width="100%" cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th>ID</th>
			<th>User ID</th>
			<th>Date</th>
			<!--<th class="actions"><?php echo __('Actions'); ?></th> -->
	</tr>
	</thead>
	<tbody>
	<?php foreach ($meetings as $meeting): ?>
	<tr>
		<td><?php echo $meeting['id']; ?>&nbsp;</td>
		<td><?php echo $meeting['user_id']; ?>&nbsp;</td>
		<td><?php echo $meeting['startDate']; ?>&nbsp;</td>
		
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
</div>

