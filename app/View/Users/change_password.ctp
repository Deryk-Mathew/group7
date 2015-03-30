<div class="container-fluid">

             <!-- ENTER INDIVIDUAL PAGE CONTENT HERE!!!!! -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Change Password</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>

<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
	<?php


				echo $this->Form->input('password_old',array('label'=>'Old password','value'=>'','type'=>'password'));

				echo $this->Form->input('password',array('label'=>'Enter New password','type'=>'password'));

        echo $this->Form->input('password2',array('label'=>'Confirm your password','type'=>'password'));






	?>
	</fieldset>
<?php echo $this->Form->end(__('Update Password')); ?>


</div>
