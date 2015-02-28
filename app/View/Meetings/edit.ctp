
<?php
            echo $this->Html->css('jquery.datetimepicker');
            echo $this->Html->script('jquery.datetimepicker');

?>
<?php echo $this->Form->create('Modify Appointment'); ?>
	<fieldset>
	<?php
	
		echo $this->Form->input('client_id');
		echo $this->Form->input('time', ['id' => 'datetimepicker']);
		echo $this->Form->input('length',array('step'=>'5', 'max'=>'120'));
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
<?php foreach ($meetings as $meeting): ?>
$('#datetimepicker').datetimepicker({value:'<?php echo h($meeting["Meeting"]["time"]);  ?>',step:5});
<?php endforeach; ?>
</script>
