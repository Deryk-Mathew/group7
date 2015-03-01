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
<?php echo $this->Form->create('Meeting'); ?>
	<fieldset>
		<?php	
			$options = array();
			foreach($clients as $client){
				$options[] = array($client['Client']['id']);
			}
			echo $this->Form->input('client_id', array('options' => $options));
			echo $this->Form->input('startDate');
			echo $this->Form->input('duration',array('type'=>'number', 'min' => '5', 'max'=>'120'));
		?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>

