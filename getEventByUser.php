<?php
	session_start();
	#ini_set('display_errors', 'On');
	#error_reporting(E_ALL);
	
	#include_once('login.php');
	
	#Function Definition
	function getEventByDate($UserID){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://web.njit.edu/~cls33/CS490/getEventByUser.php"); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, "UserID=".$UserID);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$getEventReply = curl_exec($ch);
		curl_close($ch);
		//echo "<br/>";
		#$value = (json_decode($getEventReply,true));
		
		
		return $getEventReply;	#review reply from DB	
	
	}
	
	
	#variables for getEventByDate
	$UserID 		 = $_POST['UserID'];
	
	
	#Function call
	
	#echo $Date;
	#echo $Approved;
	$result = getEventByUser($UserID);
	print_r( $result );

?>