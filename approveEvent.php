<?php
	session_start();
	#ini_set('display_errors', 'On');
	#error_reporting(E_ALL);
	
	
	#include_once('login.php');
	
	#Function Definition
	# Get json with event information where ID 
	function getEventByID($ID){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://web.njit.edu/~cls33/CS490/getEventByID.php"); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, "ID=".$ID);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$getEventReply = curl_exec($ch);
		curl_close($ch);
		#echo "<br/>";
		#$value = (json_decode($getEventReply,true));
		
		
		return $getEventReply;	#review reply from DB	
	}

	
	#getEventByID
	$ID				= $_POST['ID'];
	
	#Function call
	$result = getEventByID($ID);
	
	
	#print_r ($result);
	$result = json_decode($result, true);
	print_r ($result);

	
	
	
	
	
	
?>