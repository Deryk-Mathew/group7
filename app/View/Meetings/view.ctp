            
            
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
	
	<?php 
	
	$meetingTime = strtotime($meeting["Meeting"]["startDate"]);
	$minutes = intval($meeting['Meeting']['duration']);
	$endMeetingTime = $meetingTime + ($minutes * 60);
	
	if(time() < $meetingTime): {

echo $this->Form->postLink(__('Cancel Meeting'), array('action' => 'delete', $meeting['Meeting']['id']), array(), __('Are you sure you want to cancel this meeting?')); 
		}

	else: { ?>
	
	<div class="col-xs-12 col-md-2 col-lg-12">
		<h4>Notes Taken at Meeting</h4>
		<hr/>
		
	<table id = "noteTable" cellpadding = "0" cellspacing = "0">
	<tr>
			
			
				<th>Note Subject</th>
				<th>Note Description</th>
			</tr>
			<?php foreach ($notes as $note): {
			if($note['Note']['client_id'] == $id): {
			
			$noteTime = strtotime($note['Note']['created']);
			$noteTime = $noteTime - 3600; 
			if($meetingTime < $noteTime && $noteTime < $endMeetingTime): {
			?>
				
				<tr>
			<td width="30%"><?php echo h($note['Note']['title']) ?></td>
			<td width="70%"><?php echo h($note['Note']['body']) ?></td>
		</tr>
		<?php 
			}	endif;
		}	endif; ?>
		<?php } endforeach; ?>
		</table>
			

		</div>
	
	
	
	
	<?php }
	
	endif;

?>