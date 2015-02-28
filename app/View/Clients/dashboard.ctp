
            <div class="container-fluid">
            
             <!-- ENTER INDIVIDUAL PAGE CONTENT HERE!!!!! -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Calendar</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                
                			<?php
            $this->Html->css('calendar', null, array('inline' => false)); ?>

    <?php foreach ($meetings as $meeting): ?>
		<?php echo h($meeting["Meeting"]["client_id"]);  ?>
	<?php endforeach; ?>
