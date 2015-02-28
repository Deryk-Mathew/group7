
	<?php
            echo $this->Html->css('jquery.datetimepicker');
            echo $this->Html->script('jquery.datetimepicker');

?>
<?php echo $this->Form->create('Add New Appointment'); ?>
	<fieldset>
	<?php
	
		echo $this->Form->input('client_id');
		echo $this->Form->input('time', ['id' => 'datetimepicker']);
		echo $this->Form->input('length',array('name'=>'meetingLength','value'=>'60','step'=>'5','data-show-value'=>'true','type'=>'number', 'min' => '5', 'max'=>'120'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
<script>
$('#datetimepicker').datetimepicker({
dayOfWeekStart : 1,
lang:'en',
disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
startDate:	'2015/01/05'
});
$('#datetimepicker').datetimepicker({value:'2015/04/15 09:30',step:5});
</script>
