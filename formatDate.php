<?php
#ini_set('display_errors', 'On');
#error_reporting(E_ALL);	
	
	
	function formatDate($Date, $Time){
		
		
		$val = $Date."T".$Time."Z";
		#$val = "2016-04-21T12:00:00Z";
		
		$d2 = new DateTime($val);
		#var_dump($d2);
		
		return $d2; 
		
	}	
	
	$Date = $_POST['Date'];
	$Time = $_POST['Time'];
	#
	
	$val = $Date."T".$Time."Z";
	#$val = "2016-04-21T12:00:00Z";
	
	$d2 = new DateTime($val);
	#var_dump($d2);
	echo $d2;
	
	#$Val = formatDate($Date, $Time);
	#echo $Val;

?>