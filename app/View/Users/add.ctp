<div class="container-fluid">
            
             <!-- ENTER INDIVIDUAL PAGE CONTENT HERE!!!!! -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Add New User</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>

<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('full_name');
		echo $this->Form->input('group_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
