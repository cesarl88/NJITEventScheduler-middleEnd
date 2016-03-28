<?php
	
	#include_once('login.php');
	
	#Function Definition
	# Get json with event information from a specific date
	# $Date has to be on format YYYY-MM-DD, $Approved 1 for Approved, 0 for Not Approved
	function getEventByDate($Date , $Approved){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://web.njit.edu/~cls33/CS490/getEventByDate.php"); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, "Date=".$Date."Approved=".$Approved);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$getEventReply = curl_exec($ch);
		curl_close($ch);
		//echo "<br/>";
		$value = (json_decode($getEventReply,true));
		
		
		return $value;	#review reply from DB	
	
	}
	
	
	#variables for getEventByDate
	$Date 			= $_POST['Date'];
	$Approved		= $_POST['Approved'];
	
	#Function call
	$result = getEventByDate($Date , $Approved);
	print_r(json_encode( $result ,true));

?>