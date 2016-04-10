<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);	


function formatDate($Date, $Time){
	$val = $Date."T".$Time."Z";
	return $val; 
	#echo date();
}	

$Date = $_POST['Date'];
$Time = $_POST['Time'];

$Val = formatDate($Date, $Time);
echo $Val;

?>