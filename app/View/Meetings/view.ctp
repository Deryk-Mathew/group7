
            <div class="container-fluid">
            
             <!-- ENTER INDIVIDUAL PAGE CONTENT HERE!!!!! -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Meeting Details with Client: <?php $id = $meeting["Meeting"]["client_id"];
		echo $clients[$id]; ?></h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
	<dl>
		<dt>Client</dt>
		<dd>
			<?php echo $clients[$id]; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date and Time'); ?></dt>
		<dd>
			<?php echo h($meeting['Meeting']['startDate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Duration (Minutes)'); ?></dt>
		<dd>
			<?php echo h($meeting['Meeting']['duration']); ?>
			&nbsp;
		</dd>
	</dl>
<?php echo $this->Form->postLink(__('Cancel Meeting'), array('action' => 'delete', $meeting['Meeting']['id']), array(), __('Are you sure you want to cancel this meeting?')); ?>
		

