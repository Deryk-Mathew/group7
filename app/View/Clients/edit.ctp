
            <div class="container-fluid">
            
             <!-- ENTER INDIVIDUAL PAGE CONTENT HERE!!!!! -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Edit Client</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

<?php echo $this->Form->create('Client'); ?>
	<fieldset>
	<?php
		echo $this->Form->input('NINum');
		echo $this->Form->input('name');
		echo $this->Form->input('street');
		echo $this->Form->input('town');
		echo $this->Form->input('county');
		echo $this->Form->input('postcode');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>


