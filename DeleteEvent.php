<?php
	#ini_set('display_errors', 'On');
	#error_reporting(E_ALL);
	
	
	#include_once('login.php');
	
	#Function Definition
	#DeleteEvent will pass an event ID, and it will return a confirmation from the DB
	function DeleteEvent($ID){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://web.njit.edu/~cls33/CS490/DeleteEvent.php"); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, "ID=".$ID);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$deleteEventReply = curl_exec($ch);
		curl_close($ch);
		//echo "<br/>";
		$value = (json_decode($deleteEventReply,true));
		
		#Pending
		return $value;	#review reply from DB
	}
	
	#Variable for Event ID
	$ID				= $_POST['ID'];

	
	#Function call
	$result = DeleteEvent($ID);
	
	print_r(json_encode( $result ,true));

?>