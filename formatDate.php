<?php
#ini_set('display_errors', 'On');
#error_reporting(E_ALL);	


#function formatDate($Date, $Time){
	
// function formatDate(){
	
	// #$val = $Date."T".$Time."Z";
	
	// $val = "2016-04-21T12:00:00";
	// $d = strtotime($val);

	// $d2 = new DateTime($val);
	// var_dump($d2);
	
	// #var_dump($d);
	// #$d = new DateTime($val);
	// #echo date_format($d, 'Y-m-d\TH:i:s');
	
	// #echo $d->format('Y-m-d\TH:i:s'); // 2011-01-01T15:03:01.012345
	
	
	
	// return $val; 
	
	// #echo date();
// }	

// $Date = $_POST['Date'];
// $Time = $_POST['Time'];
// #
// $Val = formatDate($Date, $Time);
// echo $Val;
	date_default_timezone_set('America/New_York');
	$val = "2016-04-21T12:00:00";
	#$d2 = new DateTime($val);
	#date_timezone_set($d2, timezone_open('America/New_York'));
	
	
	$d3 = new DateTime($val);
	var_dump($d3);

	
	#var_dump($d2);


?>