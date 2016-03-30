<?php
	#ini_set('display_errors', 'On');
	#error_reporting(E_ALL);
	
	
	#include_once('login.php');
	
	#Function Definition
	# Get json with event information from a specific date and provide all the events 
	# that are happening within the same week as the date provided
	# $Date has to be on format YYYY-MM-DD, $Approved 1 for Approved, 0 for Not Approved
	function getEventByWeek($Date , $Approved){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://web.njit.edu/~cls33/CS490/getEventByWeek.php"); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, "Date=".$Date."&Approved=".$Approved);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$getEventReply = curl_exec($ch);
		curl_close($ch);
		//echo "<br/>";
		#$value = (json_decode($getEventReply,true));
		
		
		return $getEventReply;	#review reply from DB	
	}

	
	#Variables for getEventByWeek
	$Date 			= $_POST['Date'];
	
	if(isset($_POST['Approved'])){
		$Approved = $_POST['Approved'];
		}
	else{
		$Approved = '1';
	}
	
	#Function call
	$result = getEventByWeek($Date , $Approved);
	print_r($result);

?>