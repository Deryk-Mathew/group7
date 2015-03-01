<div class="container-fluid">
            
             <!-- ENTER INDIVIDUAL PAGE CONTENT HERE!!!!! -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Add new Appointment</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
<?php
            echo $this->Html->css('jquery.datetimepicker');
            echo $this->Html->script('jquery.datetimepicker');
?>
<?php echo $this->Form->create('Add New Appointment'); ?>
	<fieldset>
		<?php	
			$options = array();
			foreach($clients as $client){
				$options[] = array($client['Client']['id']=>$client['Client']['name']);
			}
			echo $this->Form->input('client_id', array(
				'options' => $options
			));
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
