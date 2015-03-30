
            
             <!-- ENTER INDIVIDUAL PAGE CONTENT HERE!!!!! -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Log in</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-xs-12">
<?php
echo $this->Form->create('User', array(
    'url' => array(
        'controller' => 'users',
        'action' => 'login'
    )
));
echo $this->Form->input('User.username');
echo $this->Form->input('User.password');
?>
<div class="actions_top">
	<?php echo $this->Html->link(__('Forgot password?', true), array('action' => 'forgot_password')); ?>
</div>
<?php	
echo $this->Form->end('Login');
?>
</div>
