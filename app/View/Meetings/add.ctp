<div class="container-fluid">
            
             <!-- ENTER INDIVIDUAL PAGE CONTENT HERE!!!!! -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Add new Appointment</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

<?php echo $this->Form->create('Meeting'); ?>
	<fieldset>
		<?php	

			echo $this->Form->input('client_id');
			echo $this->Form->input('startDate');
			echo $this->Form->input('duration',array('value'=>'60','min' => '30', 'max'=>'120','step'=>'5'));
		?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>

