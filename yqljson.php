<?php
include 'stocksymbs.php';
$filename = 'stocksymbols.txt';
ini_set('max_execution_time', 1200);
function process_query($yql_query_url,$dbh){
	$session = curl_init($yql_query_url);  
	curl_setopt($session, CURLOPT_RETURNTRANSFER,true);      
	$json = curl_exec($session); 
	$items = json_decode($json); //Here items is an array of arrays
	while(is_null($items->query->results)){
	$session = curl_init($yql_query_url);  
	curl_setopt($session, CURLOPT_RETURNTRANSFER,true); 
		$json = curl_exec($session); 
		$items = json_decode($json);
	}

	
	try{ 
		
		$query = "INSERT INTO `u285514251_wms`.`stocks` (`averageDailyVolume`, `change`,`daysLow`, `daysHigh`, `yearLow`, `yearHigh`, `marketCapitalization`, `lastTradePriceOnly`, `gbp_price`, `daysRange`, `name`, `symbol`, `volume`, `exchange_id`) VALUES (:averagedailyvol,:change,:dayslow,:dayshigh,:yearlow,
		:yearhigh,:marketcap,:lasttradeprice,:lasttradeprice*(1/(SELECT rate FROM `u285514251_wms`.`stock_exchanges`,`u285514251_wms`.`exchange_rates` WHERE `stock_exchanges`.`id` = 
(SELECT id FROM `u285514251_wms`.`stock_exchanges` WHERE `name` LIKE :exchange) AND `stock_exchanges`.`currency` = `exchange_rates`.`id`)),:daysrange,:name,:symbol,:volume,(SELECT id FROM `u285514251_wms`.`stock_exchanges` WHERE `name` LIKE :exchange)) ON DUPLICATE KEY UPDATE `averageDailyVolume` = :averagedailyvol,
				`change` = :change,`daysLow` = :dayslow,`daysHigh` = :dayshigh,`yearLow` = :yearlow,`yearHigh` = :yearhigh
				,`marketCapitalization` = :marketcap,`daysRange`= :daysrange,volume = :volume,`lastTradePriceOnly` = :lasttradeprice,`gbp_price` = :lasttradeprice*(1/(SELECT rate FROM `u285514251_wms`.`stock_exchanges`,`u285514251_wms`.`exchange_rates` WHERE `stock_exchanges`.`id` = 
(SELECT id FROM `u285514251_wms`.`stock_exchanges` WHERE `name` LIKE :exchange) AND `stock_exchanges`.`currency` = `exchange_rates`.`id`))";
		
		
		$stmt=$dbh->prepare($query);

		$stmt->bindParam(':averagedailyvol',$averagedailyvol);
		$stmt->bindParam(':change',$change);
		$stmt->bindParam(':dayslow',$dayslow);
		$stmt->bindParam(':dayshigh',$dayshigh);
		$stmt->bindParam(':yearlow',$yearlow);
		$stmt->bindParam(':yearhigh',$yearhigh);
		$stmt->bindParam(':marketcap',$marketcap);
		$stmt->bindParam(':lasttradeprice',$lasttradeprice);
		$stmt->bindParam(':daysrange',$daysrange);
		$stmt->bindParam(':name',$name);
		$stmt->bindParam(':symbol',$symbol);
		$stmt->bindParam(':volume',$volume);
		$stmt->bindParam(':exchange',$exchange);
					
		if(!is_null($items->query->results)){  
			foreach($items->query->results->quote as $quote) {
				$symbol = $quote->symbol;
				$name = $quote->Name;
				$averagedailyvol = $quote->AverageDailyVolume;
				$dayslow = $quote->DaysLow;
				$dayshigh = $quote->DaysHigh;
				$yearlow = $quote->YearLow;
				$yearhigh = $quote->YearHigh;
				$marketcap = $quote->MarketCapitalization;
				$daysrange = $quote->DaysRange;
				$volume = $quote->Volume;
				$lasttradeprice = $quote->LastTradePriceOnly;
				if(((intval($quote->Change)+$quote->LastTradePriceOnly) != 0) & ($quote->Change != 0) & ($quote->Change != $quote->LastTradePriceOnly)){
					$change = intval($quote->Change)/($quote->LastTradePriceOnly-intval($quote->Change))*100;
				}
				else{
					$change = 0;
				}
				$exchange = $quote->StockExchange;
				if(!is_null($name)&!is_null($exchange)&!is_null($volume)&!is_null($lasttradeprice)&(intval($lasttradeprice)>0)){	
					if($stmt->execute()){
						echo $symbol.' good'.'<br/>';
					}
					else{
						echo $symbol.' bad<br/>';
					}
				}
			}
		}
	}
	catch (PDOException $exception) {
		echo "<br/>Connection error: " . $exception->getMessage();
	}
}
$dbh=new PDO("mysql:host=127.0.0.1:3306;dbname=u285514251_wms","root","",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));


/*
$symbols = file($filename);*/
$yql_base_url = 'http://query.yahooapis.com/v1/public/yql'; 
$yql_query = 'select * from yahoo.finance.quote where symbol in (';
$yql_query .= '"'.rtrim($stocks[0]['symbol']).'"';



$i = 0;

foreach($stocks as $symbol) {
		$yql_query .= ',"'.rtrim($symbol['symbol']).'"';
		$i++;
		if($i == 250){
			$yql_query .= ')';
			$yql = $yql_base_url . '?q=' . urlencode($yql_query); 
			$yql .= '&format=json&env=store://datatables.org/alltableswithkeys';
			process_query($yql,$dbh);
			$i = 0;
			$yql_query = 'select * from yahoo.finance.quote where symbol in (';
			$yql_query .= '"'.rtrim($symbol['symbol']).'"';
		}
}

if($i>0){
	$yql_query .= ')';
	$yql = $yql_base_url . '?q=' . urlencode($yql_query); 
	$yql .= '&format=json&env=store://datatables.org/alltableswithkeys';
	process_query($yql,$dbh);
}
?>			