<div class="notes form">
<?php echo $this->Form->create('Meeting'); ?>
	<fieldset>
	<?php
		echo $this->Form->input('client_id');
		echo $this->Form->input('time', ['id' => 'datetimepicker']);
		echo $this->Form->input('duration');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

<script>
$('#datetimepicker').datetimepicker({
dayOfWeekStart : 1,
lang:'en',
disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
startDate:	'2015/01/05'
});
$('#datetimepicker').datetimepicker({step:5});
</script>
