
            <div class="container-fluid">
            
             <!-- ENTER INDIVIDUAL PAGE CONTENT HERE!!!!! -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Calendar</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                
                			<?php
            $this->Html->css('calendar', null, array('inline' => false));

?>
<?php 
echo $clients[22];

 ?>
<script>

$.getScript('http://arshaw.com/js/fullcalendar-1.6.4/fullcalendar/fullcalendar.min.js',function(){


  $('#calendar').fullCalendar({
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,agendaWeek,agendaDay'
    },
    defaultView: 'agendaWeek',
    editable: false,
    events: [
    <?php 
	
	
	foreach ($meetings as $meeting): ?>
	{
		title: '<?php 
		
		$id = $meeting["Meeting"]["client_id"];
		echo $id;  ?>',
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
<div class="container calendarFullWidth">
	<div id="calendar"></div>
</div>
