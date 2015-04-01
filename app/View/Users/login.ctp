<?php
            $this->Html->css('login', null, array('inline' => false));

?>

<div class="form-signin">
<?php echo $this->Html->image('website-logo.png', array('alt' => 'Stock til we DROP', 'border' => '0'));?>
<?php
echo $this->Form->create('User', array(
    'url' => array(
        'controller' => 'users',
        'action' => 'login'
    )
)); ?>
<h2 class="form-signin-heading">Please sign in</h2>

<?php echo $this->Form->input('User.username');
echo $this->Form->input('User.password');
?>
<div class="actions_top">
	<?php echo $this->Html->link(__('Forgot password?', true), array('action' => 'forgot_password')); ?>
</div>
<?php	
echo $this->Form->end('Login');
?>

</div>

