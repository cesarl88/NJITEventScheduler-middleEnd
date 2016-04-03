<?php
	
	#include_once('login.php');
	
	#Function Definition
	function getUserName($UserID){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://web.njit.edu/~cls33/CS490/getUserName.php"); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array( "UserID" 		=> $UserID);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$CreateEventResult = curl_exec($ch);
		curl_close($ch);
		return $CreateEventResult;
	
	}
	
	
	#$UserID = $_POST['UserID'];
	
	
	#Function call
	#$result = getUserName($UserID);
	#print_r($result);

?>