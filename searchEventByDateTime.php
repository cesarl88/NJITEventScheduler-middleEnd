<?php
	session_start();
	#ini_set('display_errors', 'On');
	#error_reporting(E_ALL);	
	
	
	#Function Definition
	function searchEventByDateTime($Date, $StartTime,$EndTime){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://web.njit.edu/~cls33/CS490/searchEventByDateTime.php"); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array( 
																						"Date"				=>	$Date, 		
																						"StartTime"			=>	$StartTime, 	
																						"EndTime"			=>	$EndTime, 	
																						)));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$replyUserName = curl_exec($ch);
		curl_close($ch);
		return $replyUserName;
	
	}
	
	
	$Date 		= $_POST['Date'];
  	$StartTime 	= $_POST['StartTime'];
   $EndTime 	= $_POST['EndTime'];
	
	#Function call
	$result = searchEventByDateTime($Date, $StartTime,$EndTime);
	print_r($result);

?>