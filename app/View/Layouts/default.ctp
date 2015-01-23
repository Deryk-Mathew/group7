<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div class="headerFull">
		
		<div id="header">
			<?php echo $this->Html->image('website-logo.png', array('alt' => 'Edit', 'border' => '0', 'height' => '95%'));
			
			if ((AuthComponent::User('group_id')) != null){
			echo '<div id="loginInfo"><p><b>Logged In: </b>';
			echo $this->session->read( 'Auth.User.full_name' );
			echo '<br/>';
			echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout'));
			echo '</div>';
			}
			 ?>
<?php// echo h($client['Client']['NINum']); 
?>
		</div>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div class="footerFull">
		<div id="footer">
			<h6>Developed By Group 7</h6>
		</div>
	</div>
			
		</div>
	</div>
</body>
</html>
