<?php
	#session_start();
	#include_once('login.php');
	#include_once('getEventByID.php');
	#Function Definition
	#ini_set('display_errors', 'On');
	#error_reporting(E_ALL);
	
	
	function getEventByID($ID){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://web.njit.edu/~jsr24/CS490/getEventByID.php"); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, "ID=".$ID);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$getEventReply = curl_exec($ch);
		curl_close($ch);
		#echo "<br/>";
		#$value = (json_decode($getEventReply,true));
		return $getEventReply;	#review reply from DB	
	}
	
	
	function ListscheduleEventByUserID($UserID){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://web.njit.edu/~cls33/CS490/ListscheduleEventByUserID.php"); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, "UserID=".$UserID);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$getEventReply = curl_exec($ch);
		curl_close($ch);
		#echo "<br/>";
		#$value = (json_decode($getEventReply,true));
		return $getEventReply;	#review reply from DB	
	}
	
	
	
	$UserID = $_POST['UserID'];

	
	$listEvents = ListscheduleEventByUserID($UserID);
	#var_dump($listEvents);
	#echo "<br/>";
	
	
	$listEvents = json_decode($listEvents,true);
	#var_dump($listEvents);
	#echo "<br/>";
	
	$tmp = $listEvents['Event'];
	#var_dump($tmp);
	#echo "<br/>";
	#
	#echo $tmp['Event'];
	#echo "<br/>";
	#echo "<br/>";
	
	if(isset($tmp)){
		$Export;
		foreach($tmp as $value){
			$value = json_decode($value,true); 
			$value = ($value['EventID']);
			$Export[] = getEventByID($value);
			#var_dump($Export);
			#echo "<br/>";
			
		}
	}
	print_r(json_encode($Export));
	
	

?>





