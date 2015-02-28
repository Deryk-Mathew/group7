<?php	
$options = array();
foreach($clients as $client){
	$options[] = $client['Client']['name'];
}
echo $this->Form->input('field', array(
    'options' => $options,
    'empty' => '(choose one)'
));
?>