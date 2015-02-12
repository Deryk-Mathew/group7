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

$cakeDescription = __d('cake_dev', 'Wealth Management System');
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
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/metisMenu/1.1.3/metisMenu.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="http://cdn.datatables.net/1.10.0/js/jquery.dataTables.min.js"></script> 
	<?php
		echo $this->Html->meta('icon');
		
		echo $this->Html->css('cake.generic');
		echo $this->Html->css('bootstrap.min');	
		echo $this->Html->css('font-awesome.min');
		echo $this->Html->css('wealth-style');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	
</head>
<body>
	    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; height: 15%;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"><?php echo $this->Html->image('website-logo.png', array('alt' => 'Edit', 'border' => '0', 'width' => '300px'));?></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                <!-- /.dropdown -->
              <?php  if ((AuthComponent::User('group_id')) != null){
                
               echo '<li class="dropdown">';
                   echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i>';
                   echo $this->session->read( 'Auth.User.full_name' );
                   echo '<b class="caret"></b></a>';
                   echo ' <ul class="dropdown-menu dropdown-user">';
                    echo '<li>';
                    echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout'), array('class' => 'glyphicon glyphicon-off'));
                    echo '</li>';
                    echo '</li>';
                    echo '</ul>';
                echo '</li>';
            echo '</ul>';
            }
            ?>
          
          
          
          
          
          
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="index.html"><i class="glyphicon glyphicon-home"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-gbp"></i> Clients<span class="sidebarIcon glyphicon glyphicon-menu-down"></span></a>
                            <ul class="nav nav-second-level">
                                <li><?php echo $this->Html->link(__('Add New Client'), array('controller' => 'clients', 'action' => 'add')); ?></li>
                                <li><?php echo $this->Html->link(__('My Clients'), array('controller' => 'clients', 'action' => 'browse')); ?></li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                         <li>
                            <a href="#"><i class="glyphicon glyphicon-user"></i> Users<span class="sidebarIcon glyphicon glyphicon-menu-down"></span></a>
                            <ul class="nav nav-second-level">
                                <li><?php echo $this->Html->link(__('Add New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
                                <li><?php echo $this->Html->link(__('Browse Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-stats"></i> Markets<span class="sidebarIcon glyphicon glyphicon-menu-down"></span></a>
                            <ul class="nav nav-second-level">
                                <li><?php echo $this->Html->link(__('List Stocks'), array('controller' => 'stocks', 'action' => 'index')); ?></li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-calendar"></i> Meetings<span class="sidebarIcon glyphicon glyphicon-menu-down"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="flot.html">Add Meeting</a>
                                </li>
                                <li>
                                    <a href="morris.html">View Meetings</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                       
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
                -

                
                
                
                
                
                
                
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
        
       
        
			

			<?php echo $this->Session->flash(); ?>
 
			<?php echo $this->fetch('content'); ?>
			           </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
			
			
			
			<?php 
			echo $this->Html->script('bootstrap.min');
			echo $this->Html->script('wealth');
?>

<script src="//cdnjs.cloudflare.com/ajax/libs/metisMenu/1.1.3/metisMenu.min.js"></script>

</body>
</html>