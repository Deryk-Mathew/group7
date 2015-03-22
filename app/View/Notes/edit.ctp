            <div class="container-fluid">
            
             <!-- ENTER INDIVIDUAL PAGE CONTENT HERE!!!!! -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Edit Note</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

<div class="notes form">
<?php echo $this->Form->create('Note'); ?>
	<fieldset>
	<?php
		//echo $this->Form->input('id');
		//echo $this->Form->input('client_id');
		echo $this->Form->input('body');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
