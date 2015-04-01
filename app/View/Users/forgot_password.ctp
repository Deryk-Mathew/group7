


<div class="form-signin">

<?php echo $this->Html->image('website-logo.png', array('alt' => 'Stock til we DROP', 'border' => '0'));?>

<h4>Password Recovery</h4>
<?php echo $this->Form->create('User'); ?>
	<fieldset>
	<?php
		echo $this->Form->input('username');

	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
