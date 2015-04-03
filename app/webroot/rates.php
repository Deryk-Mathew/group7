<?php

 // get current exchange rates
$dbh=new PDO("mysql:host=85.10.230.136;dbname=kgbmxvry_u285514251_wms","kgbmxvry","5mrSx0U4h7",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$yql_base_url = 'http://query.yahooapis.com/v1/public/yql'; 
$yql_query = 'select * from yahoo.finance.xchange where pair in ("GBPEUR","GBPUSD","GBPCAD","GBPBRL","GBPMXN","GBPHKD","GBPNZD","GBPSGD","GBPAUD","GBPARS",
			"GBPDKK","GBPIDR","GBPMYR","GBPKRW","GBPINR","GBPNOK","GBPSEK","GBPTWD","GBPILS")';
$yql = $yql_base_url . '?q=' . urlencode($yql_query); 
$yql .= '&format=json&env=store://datatables.org/alltableswithkeys';
$session = curl_init($yql);  
curl_setopt($session, CURLOPT_RETURNTRANSFER,true);      
$json = curl_exec($session); 
$items = json_decode($json); //Here items is an array of arrays

try{ 
	$query = "UPDATE `kgbmxvry_u285514251_wms`.`exchange_rates` SET `rate` = :rate WHERE `currency` = :currency ";
	
	
	$stmt=$dbh->prepare($query);

	$stmt->bindParam(':currency',$currency);
	$stmt->bindParam(':rate',$rate);
				
	if(!is_null($items->query->results)){  
		foreach($items->query->results->rate as $rate) {
			$currency = substr($rate->id,-3);
			$rate = $rate->Rate;
			if($stmt->execute()){
				echo $currency.' good'.'<br/>';
			}
			else{
				echo $currency.' bad<br/>';
			}
			
		}
	}
}
catch (PDOException $exception) {
	echo "<br/>Connection error: " . $exception->getMessage();
}

?>
