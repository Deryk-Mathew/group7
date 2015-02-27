
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

<script>
$.getScript('http://arshaw.com/js/fullcalendar-1.6.4/fullcalendar/fullcalendar.min.js',function(){
  
  var date = new Date();
  var d = date.getDate();
  var m = date.getMonth();
  var y = date.getFullYear();


	
  $('#calendar').fullCalendar({
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,agendaWeek,agendaDay'
    },
    defaultView: 'agendaWeek',
    editable: true,
    events: [
    <?php foreach ($meetings as $meeting): ?>
	{
		title: '<?php echo h($meeting["Meeting"]["client_id"]);  ?>',
		<?php $dateReturn = h($meeting['Meeting']['time']);  
		$timestamp = strtotime($dateReturn);
		$year = strval('20');
		$year .= strval(date("y", $timestamp));
		$month = (intval(date("m", $timestamp))) - 1;
		$minuteStart = (intval(date("i", $timestamp))); ?>
		
		start: new Date(<?php echo $year; ?>, <?php echo $month ?>, <?php echo date("d", $timestamp); ?>, <?php echo date('h', $timestamp); ?>, <?php echo $minuteStart; ?>),
		end: new Date(<?php echo $year; ?>, <?php echo $month ?>, <?php echo date("d", $timestamp); ?>, 18, <?php echo $minuteStart; ?>),
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
