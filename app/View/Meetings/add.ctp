
            
             <!-- ENTER INDIVIDUAL PAGE CONTENT HERE!!!!! -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Add new Appointment</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-xs-12">
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
