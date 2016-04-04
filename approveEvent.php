<?php
	session_start();
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);
	
	
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
	
	
	function UpdateEvent($UserID,$ID,$title,$startDate,$EndDate,$startTime,$endTime,$Place,$Submitter,$Organization,$eventname,$image,$link,$description){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://web.njit.edu/~cls33/CS490/UpdateEvent.php"); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
																						"UserID"				=>	$UserID,
																						"ID"						=>	$ID,
																						"title"					=>	$title,
																						"startDate"			=>	$startDate,
																						"EndDate"				=>	$EndDate,
																						"startTime"			=>	$startTime,
																						"endTime"				=>	$endTime,
																						"Place"					=>	$Place,
																						"Submitter"			=>	$Submitter,
																						"Organization"	=>	$Organization,
																						"eventname"			=>	$eventname,
																						"image"					=>	$image,
																						"link"					=>	$link,
																						"description"		=>	$description,
																						"Approved"			=>	1
																						)));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$UpdateEventResult = curl_exec($ch);
		curl_close($ch);
		//echo "<br/>";
		#$value = (json_decode($CreateEventResult,true));
		
		#pending
		return $UpdateEventResult;	#review reply from DB	
	}
	
	
	
	#getEventByID
	$ID				= $_POST['ID'];
	
	#Function call
	$result 	= getEventByID($ID);
	
	
	#print_r ($result);
	$result 	= json_decode($result, true);
	$varArray = $result['Event'];
	#var_dump ($result);
	#var_dump ($varArray);
	
	
	$UserID					= $varArray['UserID'];
	$ID							= $varArray['ID'];
	$title					= $varArray['Title'];
	$startDate			= $varArray['startDate'];
	$EndDate				= $varArray['EndDate'];
	$startTime			= $varArray['startTime'];
	$endTime				= $varArray['endTime'];
	$Place					= $varArray['Place'];
	$Submitter			= $varArray['Submitter'];
	$Organization		= $varArray['Organization'];
	$eventname			= $varArray['EventName'];
	$image					= $varArray['Image'];
	$link						= $varArray['link'];
	$description    = $varArray['Description'];
	
	
	$resultApprove = UpdateEvent($UserID,$ID,$title,$startDate,$EndDate,$startTime,$endTime,$Place,$Submitter,$Organization,$eventname,$image,$link,$description);
	print_r($resultApprove);
	
	
?>