<?php	
$options = array();
foreach($clients as $client){
	$options[] = array($client['Client']['id']=>$client['Client']['name']);
}
echo $this->Form->input('field', array(
    'options' => $options,
    'empty' => '(choose one)'
));
?>