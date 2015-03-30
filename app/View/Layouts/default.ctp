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
	
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="http://cdn.datatables.net/1.10.5/js/jquery.dataTables.js"></script> 

	<?php
		echo $this->Html->meta('icon');
		
		echo $this->Html->css('cake.generic');
		echo $this->Html->css('bootstrap.min');	
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
                <a class="navbar-brand"><?php echo $this->Html->image('website-logo.png', array('alt' => 'Stock til we DROP', 'border' => '0', 'width' => '300px'));?></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                <!-- /.dropdown -->
              <?php  if ((AuthComponent::User('group_id')) != null){
                if($this->Session->read('current_client') != null){
                echo '<li class="dropdown">';
                   echo '<ul class="dropdown-menu dropdown-user">';
                    echo '<li>';
                    echo $this->Html->link(
						'<i class="glyphicon glyphicon-circle-arrow-up"></i> Deposit',
						array('controller' => 'balances', 'action' => 'deposit',$this->Session->read('current_client')),array('escape' => false)
					);
                    echo '</li>';
                    echo '<li>';
                    echo $this->Html->link(
						'<i class="glyphicon glyphicon-circle-arrow-down"></i> Withdraw',
						array('controller' => 'balances', 'action' => 'withdraw',$this->Session->read('current_client')),array('escape' => false)
					);
                    echo '</li>';
                    echo '<li>';
                    echo $this->Html->link(
						'<i class="glyphicon glyphicon-signal"></i> Portfolio',
						array('controller' => 'clients', 'action' => 'portfolio',$this->Session->read('current_client'),$this->Session->read('current_client_name')),array('escape' => false)
					);
                    echo '</li>';
                    echo '<li>';
                    echo $this->Html->link(
						'<i class="glyphicon glyphicon-list-alt"></i> Profile',
						array('controller' => 'clients', 'action' => 'profile',$this->Session->read('current_client'),$this->Session->read('current_client_name')),array('escape' => false)
					);
                    echo '</li>';
                    echo '<li>';
                    echo $this->Html->link(
						'<i class="glyphicon glyphicon-pencil"></i> Add Note',
						array('controller' => 'notes', 'action' => 'add',$this->Session->read('current_client')),array('escape' => false)
					);
                    echo '</li>';
					echo '<li>';
                    echo $this->Html->link(
						'<i class="glyphicon glyphicon-calendar"></i> Add Appointment',
						array('controller' => 'meetings', 'action' => 'browse',$this->Session->read('current_client')),array('escape' => false)
					);
                    echo '</li>';
                    echo '<li>';
                    echo $this->Html->link(
						'<i class="glyphicon glyphicon-arrow-left"></i> Change Client',
						array('controller' => 'clients', 'action' => 'browse'),array('escape' => false)
					);
                    echo '</li>';
					echo '<li>';
						echo $this->Html->link(
							'<i class="glyphicon glyphicon-cog"></i> Settings',
							array('controller' => 'users', 'action' => 'logout'),array('escape' => false)
						);
						echo '</li>';
						echo '<li>';
						echo $this->Html->link(
							'<i class="glyphicon glyphicon-off"></i> Logout',
							array('controller' => 'users', 'action' => 'logout'),array('escape' => false)
						);
						echo '</li>';
                    echo '</li>';
                    echo '</ul>';
					
					echo '<a href="#" color = "white"class="dropdown-toggle" data-toggle="dropdown">';
					echo '<font size = "4"><b><i class="glyphicon glyphicon-user"> </i>'.$this->session->read( 'Auth.User.full_name' );
					echo '<br/>Client: ' . $this->Session->read('current_client_name').'</br>';
					echo 'Balance: £' . $this->Session->read('balance');
					echo '</b><br/><div class = "menuicon"><i margin-left = "30px" class="glyphicon glyphicon-triangle-bottom"></i></div></a>';
					}
					else{
							echo '<li class="dropdown">';
					   echo '<ul class="dropdown-menu dropdown-user">';
					   echo '<li>';
						echo $this->Html->link(
							'<i class="glyphicon glyphicon-user"></i> Select Client',
							array('controller' => 'clients', 'action' => 'browse'),array('escape' => false)
						);
						echo '</li>';
					   echo '<li>';
						echo $this->Html->link(
							'<i class="glyphicon glyphicon-share"></i> Add Client',
							array('controller' => 'clients', 'action' => 'add'),array('escape' => false)
						);
						echo '</li>';
						echo '<li>';
						echo $this->Html->link(
							'<i class="glyphicon glyphicon-calendar"></i> Add Appointment',
							array('controller' => 'meetings', 'action' => 'browse'),array('escape' => false)
						);
						echo '</li>';
						echo '<li>';
						echo $this->Html->link(
							'<i class="glyphicon glyphicon-cog"></i> Settings',
							array('controller' => 'users', 'action' => 'logout'),array('escape' => false)
						);
						echo '</li>';
						echo '<li>';
						echo $this->Html->link(
							'<i class="glyphicon glyphicon-off"></i> Logout',
							array('controller' => 'users', 'action' => 'logout'),array('escape' => false)
						);
						echo '</li>';
						echo '</li>';
						echo '</li>';
						echo '</ul>';
						
						echo '<a href="#" color = "white"class="dropdown-toggle" data-toggle="dropdown">';
						echo '<font size = "4"><b><i class="glyphicon glyphicon-user"> </i>'.$this->session->read( 'Auth.User.full_name' );
						echo '<br/></br><i class="glyphicon glyphicon-info-sign"></i> No active client';
						echo '</b><br/><div class = "menuicon"><i margin-left = "30px" class="glyphicon glyphicon-triangle-bottom"></i></div></a>';
					}
                echo '</font></li>';
            echo '</ul>';
                
               
                   
            
            }
            ?>
          
          
          
          
          
          
            <!-- /.navbar-top-links -->
<?php  if ((AuthComponent::User('group_id')) != null): ?>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        
                        
                        <li>
						<?php
						echo $this->Html->link(
    '<i class="glyphicon glyphicon-home"></i> Dashboard'
                   ,
    array('controller' => 'clients', 'action' => 'dashboard'),array('escape' => false)
); ?>
                            
                        </li>
                        
						<?php if($this->Session->read('current_client') == null){ ?>
						<?php if(($this->params['controller'] == 'clients') && ($this->params['action'] != 'dashboard')){ ?>
						<li>
                            <a href="#"><i class="glyphicon glyphicon-user"></i> Clients<span class="sidebarIcon glyphicon glyphicon-menu-hamburger"></span></a>
                            <ul class="nav nav-second-level">
                                <li><?php echo $this->Html->link(__('- Browse Clients'), array('controller' => 'clients', 'action' => 'browse')); ?></li>
								<li><?php echo $this->Html->link(__('- Add New Client'), array('controller' => 'clients', 'action' => 'add')); ?></li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php } else { ?>
                       <li>
						<?php
						echo $this->Html->link(
    			'<i class="glyphicon glyphicon-gbp"></i> Clients',
			    array('controller' => 'clients', 'action' => 'browse'),array('escape' => false)
			); ?>
                            
                        </li>
                       
						<?php 
						}} else{?>
						<li class = "change">
							<?php
						echo $this->Html->link(
    '<b><i class="glyphicon glyphicon-arrow-left"></i> Select Another Client</b>',
    array('controller' => 'clients', 'action' => 'browse'),array('escape' => false)
); ?>
                         </li>
                         
                         <?php if(($this->params['controller'] == 'clients') && ($this->params['action'] != 'dashboard')){ ?>
						<li>
                            <a href="#"><i class="glyphicon glyphicon-user"></i> <?php echo $this->Session->read('current_client_name');?><span class="sidebarIcon glyphicon glyphicon-menu-hamburger"></span></a>
                            <ul class="nav nav-second-level">
                                <li><?php echo $this->Html->link(__('- Portfolio'), array('controller' => 'clients', 'action' => 'portfolio', $this->Session->read('current_client'),$this->Session->read('current_client_name'))); ?></li>
                                <li><?php echo $this->Html->link(__('- Profile'), array('controller' => 'clients', 'action' => 'profile', $this->Session->read('current_client'),$this->Session->read('current_client_name'))); ?></li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php } else { ?>
                       <li>
						<?php 
						echo $this->Html->link(
    			'<i class="glyphicon glyphicon-user"></i> '.$this->Session->read("current_client_name"),
			    array('controller' => 'clients', 'action' => 'portfolio',$this->Session->read('current_client'),$this->Session->read('current_client_name')),array('escape' => false)
			); ?>
                            
                        </li>
                         
                         
                         
                         
					
						<?php }} ?>
						<?php if(AuthComponent::User('group_id') == ADMIN): ?>
                         <li>
                            <a href="#"><i class="glyphicon glyphicon-user"></i> Users<span class="sidebarIcon glyphicon glyphicon-menu-hamburger"></span></a>
                            <ul class="nav nav-second-level">
                                <li><?php echo $this->Html->link(__('Add New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
                                <li><?php echo $this->Html->link(__('Browse Users'), array('controller' => 'users', 'action' => 'browse')); ?> </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						<?php endif; ?>
						<li>
						<?php
						echo $this->Html->link(
    			'<i class="glyphicon glyphicon-stats"></i> Markets',
			    array('controller' => 'stocks', 'action' => 'browse'),array('escape' => false)
			); ?>
                            
                        </li>
                        <?php if(AuthComponent::User('group_id') == 2): ?>
                        
                                                <li>
						<?php
						echo $this->Html->link(
    			'<i class="glyphicon glyphicon-calendar"></i> Calendar',
			    array('controller' => 'meetings', 'action' => 'browse'),array('escape' => false)
			); ?>
                            
                        </li>
                        
                        
                        
                        
                        
                        <?php endif; ?>
                        <li class = "logout">
                        <?php echo $this->Html->link(
						'<b><i class="glyphicon glyphicon-off"></i> Logout</b>',
						array('controller' => 'users', 'action' => 'logout'),array('escape' => false)
					); ?>
                        </li>
                        
                       
                    </ul>
                </div>
                <?php endif; ?>
                <!-- /.sidebar-collapse -->
                

                
                
                
                
                
                
                
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
        <div class="container-fluid">
       
        
			
	<div id="flashMessages">
			<?php echo $this->Session->flash(); ?>
	</div>
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
