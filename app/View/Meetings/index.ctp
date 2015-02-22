
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
			echo $this->Html->script('moment.min');
            echo $this->Html->script('fullcalendar.min');

?>
<script>

	$(document).ready(function() {
	
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	var yyyy = today.getFullYear();

	if(dd<10) {
		dd='0'+dd
	} 

	if(mm<10) {
		mm='0'+mm
	} 

	today = mm+'/'+dd+'/'+yyyy;

		$('#calendar').fullCalendar({
			defaultDate: today,
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: [
				<?php $meetings; ?>
				<?php foreach ($meetings as $meeting): ?>
				{
					title: '<?php echo h($meeting['Meeting']['user_id']);  ?>':,
					start: '<?php echo h($meeting['Meeting']['startdate']);  ?>',
					end: '<?php echo h($meeting['Meeting']['enddate']);  ?>'
				},
				<?php endforeach; ?>
				
			]
		});
		
	});

</script>
		<div id='calendar'></div>

