<?php
#ini_set('display_errors', 'On');
#error_reporting(E_ALL);	


function formatDate($Date, $Time){
	$val = $Date."T".$Time."Z";
	
	$d = new DateTime($val);
	echo $d->format('Y-m-d\TH:i:s'); // 2011-01-01T15:03:01.012345
	
	
	
	return $val; 
	
	#echo date();
}	

$Date = $_POST['Date'];
$Time = $_POST['Time'];
#
$Val = formatDate($Date, $Time);
echo $Val;

?>