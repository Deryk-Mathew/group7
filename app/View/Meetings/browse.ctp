            
            
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
      right: 'month,agendaDay'
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
    dayRender: function (date, cell) {

    var today = new Date();

    if (date.getDate() === today.getDate()) {
        cell.css("background-color", "#CBE2F0");
        //cell.css("border", "1px dashed red");
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
        var d = new Date();
		var now = d.getTime();
		var selected = start.getTime();
		
		
      	if(parseInt(start.getHours()) > 7){
      	
      	if(selected < now){
		document.getElementById("selectedDate").innerHTML="Please Select Timeslot in future";
		document.getElementById("selectedDate").style.color="red";
		document.getElementById("addMeeting").value= "Select Valid Timeslot to Add Appointment";
        document.getElementById("addMeeting").disabled=true;
        $("#addMeeting").addClass("disabledSubmit");
		return;
		}
          var day = parseInt(start.getDate());
				var month = parseInt(start.getMonth());
				var year = start.getFullYear();
				var hour = parseInt(start.getHours());
				//hour = hour + 1;
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
				var textHour;
				var meridian = "am";
				if(hour>12){
					hour = hour - 12;
					meridian = "pm";
				}
				else if(hour == 12){
					meridian = "pm";
				}
				if(hour<10){
				textHour = "0" + hour;
				} else {
				textHour = "" + hour;
				}
				var minutes = parseInt(start.getMinutes());
				var textMin;
				if(minutes<10){
				textMin = "0" + minutes;
				} else {
				textMin = "" + minutes;
				}
            	
               document.getElementById("MeetingStartDateMonth").value=textMonth;
                document.getElementById("MeetingStartDateDay").value=textDay;
                document.getElementById("MeetingStartDateYear").value=year;
                document.getElementById("MeetingStartDateHour").value=textHour;
                document.getElementById("MeetingStartDateMin").value=textMin;
                document.getElementById("MeetingStartDateMeridian").value=meridian;
                document.getElementById("selectedDate").innerHTML=start;
                document.getElementById("selectedDate").style.color="green";
                
                document.getElementById("addMeeting").value= "Submit Meeting";
                document.getElementById("addMeeting").disabled=false;
                $("#addMeeting").removeClass("disabledSubmit");
                }
                /*else {
                	document.getElementById("addMeeting").value= "Select Valid Timeslot to Add Appointment";
                	document.getElementById("addMeeting").disabled=false;
                	$("#addMeeting").addClass("disabledSubmit");
                }*/
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
<div class="col-lg-9 col-md-12 col-xs-12">
	<div id="calendar"></div>
</div>
<script>
$('.submit').click(function(){
if (attr('submit-button', 'disabled') == 'true')
{
alert('Button Disabled')
}
});
</script>

<script>
function submitCheck(){
	if(document.getElementById("selectedDate").innerHTML="Please Select Timeslot From Calendar" || document.getElementById("selectedDate").innerHTML="Please Select Timeslot in future"){
	alert("please select valid time slot for meeting");
}
</script>
<div class="col-lg-3 col-md-12 col-xs-12">
<h3>Add Appointment</h3>
<?php echo $this->Form->create('Meeting'); ?>
	<fieldset>
		<?php  if (isset($_SESSION['current_client'])){
		

			echo $this->Form->input('client_id',
    array('label' => 'Meeting with Client:', 'default'=>$_SESSION['current_client']));
    }
    else {
    echo $this->Form->input('client_id',
    array('label' => 'Meeting with Client:' ));
    }
    
     ?>
    	<div class="input">
    	<label>Start Date and Time of Meeting:<label><p id="selectedDate" style="color: red; font-style: italic">Please Select Timeslot From Calendar</p>
    	</div>
		<?php	echo $this->Form->input('startDate',
    array('label' => 'Start Date and Time:'));
			//echo $this->Form->input('duration',array('value'=>'60','min' => '30', 'max'=>'120','step'=>'5','label' => 'Duration (Minutes):'));
			//$options[];
			$options[30] = "30 Minutes";
			$options[60] = "60 Minutes";
			$options[90] = "90 Minutes";
			echo $this->Form->input('duration',array('type'=>'select','options' => $options,'label' => 'Duration:'));
		?>
	</fieldset>
<?php //echo $this->Form->end(__('Submit'), array('id'=>'addMeeting')); 
?>
<?php echo $this->Form->submit('Select Valid Timeslot to Add Appointment', array('id'=>'addMeeting', 'disabled'=>'true', 'class'=>'disabledSubmit')); ?>
</div>





