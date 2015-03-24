            
            
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


  $('#calendar').fullCalendar({
    header: {
      left: 'prev,next',
      center: 'title',
      right: 'month,agendaWeek,agendaDay'
    },
	/*dayClick: function (date) {
				var day = parseInt(date.getDate());
				var month = parseInt(date.getMonth());
				month = month + 1;
				var textMonth;
				if(month<10){
				textMonth = "0" + month;
				} else {
				textMonth = "" + month;
				}
				var textDay;
				if(day<10){
				textDay = "0" + day;
				} else {
				textDay = "" + day;
				}
				var year = date.getFullYear();
                $(this).parent().siblings().children().removeClass('dayHighlight');
                $(this).siblings().removeClass('dayHighlight');
            	$(this).addClass('dayHighlight');
            	
                document.getElementById("MeetingStartDateMonth").value=textMonth;
                document.getElementById("MeetingStartDateDay").value=textDay;
                document.getElementById("MeetingStartDateYear").value=year;
            },*/
        dayClick: function(date, allDay, jsEvent, view) {

        if (allDay) {
            // Clicked on the entire day
            $('#calendar')
                .fullCalendar('changeView', 'agendaDay')
                .fullCalendar('gotoDate',
                    date.getFullYear(), date.getMonth(), date.getDate());
        }
    },
    defaultView: 'month',
    fixedWeekCount: false,
    minTime: "08:00:00",
	maxTime: "19:00:00",
	allDaySlot: false,
	height: 700,
    editable: true,
    selectable: true,
      //header and other values
      select: function(start, end, allDay) {
          var day = parseInt(date.getDate());
				var month = parseInt(date.getMonth());
				month = month + 1;
				var textMonth;
				if(month<10){
				textMonth = "0" + month;
				} else {
				textMonth = "" + month;
				}
				var textDay;
				if(day<10){
				textDay = "0" + day;
				} else {
				textDay = "" + day;
				}
				var year = date.getFullYear();
                $(this).parent().siblings().children().removeClass('dayHighlight');
                $(this).siblings().removeClass('dayHighlight');
            	$(this).addClass('dayHighlight');
            	
                document.getElementById("MeetingStartDateMonth").value=textMonth;
                document.getElementById("MeetingStartDateDay").value=textDay;
                document.getElementById("MeetingStartDateYear").value=year;
       },
    events: [
    <?php 
	
	
	foreach ($meetings as $meeting): ?>
	{
		title: 'Meeting with <?php 
		
		$id = $meeting["Meeting"]["client_id"];
		echo $clients[$id];  ?>',
		<?php $dateReturn = h($meeting['Meeting']['startDate']);  
		$timestamp = strtotime($dateReturn);
		$year = strval('20');
		$year .= strval(date("y", $timestamp));
		$month = (intval(date("m", $timestamp))) - 1;
		$date = (intval(date("d", $timestamp)));
		$hour = (intval(date("H", $timestamp)));
		$hourStart = (intval(date("H", $timestamp)));
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
		url: '/meetings/view/<?php echo h($meeting["Meeting"]["id"]); ?>',
		allDay: false,
		},
		
	<?php endforeach; ?>
    ],
    
    eventClick: function(event) {
        if (event.url) {
            window.open(event.url, '_self');
            return false;
        }
    },
    
  });
})



</script>
<div class="col-lg-9 col-md-9 col-xs-12">
	<div id="calendar"></div>
</div>

<div class="col-lg-3 col-md-3 col-xs-12">
<h3>Add Appointment</h3>
<?php echo $this->Form->create('Meeting'); ?>
	<fieldset>
		<?php	

			echo $this->Form->input('client_id',
    array('label' => 'Meeting with Client:'));
			echo $this->Form->input('startDate',
    array('label' => 'Start Date and Time:'));
			echo $this->Form->input('duration',array('value'=>'60','min' => '30', 'max'=>'120','step'=>'5','label' => 'Duration (Minutes):'));
		?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>


