
            <div class="container-fluid">
            
             <!-- ENTER INDIVIDUAL PAGE CONTENT HERE!!!!! -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Dashboard</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
     <?php  if ((AuthComponent::User('group_id')) == '2'): ?>           
                			<?php
            $this->Html->css('calendar', null, array('inline' => false));

?>

<script>

$.getScript('http://arshaw.com/js/fullcalendar-1.6.4/fullcalendar/fullcalendar.min.js',function(){


  $('#calendar').fullCalendar({
    defaultView: 'agendaDay',
    editable: false,
    events: [
    <?php foreach ($meetings as $meeting): ?>
	{
		title: '<?php echo h($meeting["Meeting"]["client_id"]);  ?>',
		<?php $dateReturn = h($meeting['Meeting']['startDate']);  
		$timestamp = strtotime($dateReturn);
		$year = strval('20');
		$year .= strval(date("y", $timestamp));
		$month = (intval(date("m", $timestamp))) - 1;
		$date = (intval(date("d", $timestamp)));
		$hour = (intval(date("h", $timestamp)));
		$hourStart = (intval(date("h", $timestamp)));
		$minuteStart = (intval(date("i", $timestamp)));
		$duration = intval(h($meeting['Meeting']['duration']));
		$hours = ($duration)/60;
		$minutes = ($duration)%60;
		$hourEnd = $hourStart + $hours;
		$minutesEnd = $minuteStart + $minutes;
		if($minutesEnd > 59){
			$hourEnd = $hourEnd + 1;
			$minutesEnd = $minutesEnd - 60;
		} ?>
		start: new Date(<?php echo $year; ?>, <?php echo $month ?>, <?php echo $date; ?>, <?php echo $hour; ?>, <?php echo $minuteStart; ?>),
		end: new Date(<?php echo $year; ?>, <?php echo $month ?>, <?php echo $date; ?>, <?php echo $hourEnd; ?>, <?php echo $minutesEnd; ?>),
		url: 'http://localhost/group7/meetings/edit/<?php echo h($meeting["Meeting"]["id"]); ?>',
		allDay: false,
		},
		
	<?php endforeach; ?>
    ],
    
    eventClick: function(event) {
        if (event.url) {
            window.open(event.url);
            return false;
        }
    },
    dayClick: function(date, jsEvent, view) {

        alert('Clicked on: ' + date.format());

        alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);

        alert('Current view: ' + view.name);

        // change the day's background color just for fun
        $(this).css('background-color', 'red');

    }
  });
})



</script>



<div class="col-xs-6">
<h3>Today's Schedule:</h3>
<br/>
<div class="container calendarFullWidth">
	<div id="calendar" class="hideHeader"></div>
</div>
</div>
<div class="col-xs-6">
<h3>Market Information:</h3>
<br/>

</div>
<?php endif; ?>

 <?php  if ((AuthComponent::User('group_id')) == '1'): ?>
	
	<h3>Unassigned Clients:</h3>
	<br/>
	
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
<?php endif; ?>
