
            <div class="container-fluid">
            
             <!-- ENTER INDIVIDUAL PAGE CONTENT HERE!!!!! -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Edit Meeting</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
<?php
            echo $this->Html->css('jquery.datetimepicker');
            echo $this->Html->script('jquery.datetimepicker');

?>
<?php echo $meeting['Meeting']['id']; ?>


<?php echo $this->Form->create('Meeting'); ?>
	<fieldset>
	<?php
	  
		echo $this->Form->input('startDate');
		echo $this->Form->input('duration',array('min' => '30', 'max'=>'120','step'=>'5'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>

