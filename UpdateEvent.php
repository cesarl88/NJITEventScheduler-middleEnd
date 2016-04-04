<?php
	session_start();
	#include_once('login.php');
	
	#Function Definition
	function UpdateEvent($UserID,$ID,$title,$startDate,$EndDate,$startTime,$endTime,$Place,$Submitter,$Organization,$eventname,$image,$link,$description,$Approved ){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://web.njit.edu/~cls33/CS490/UpdateEvent.php"); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
																						"UserID"			=>	$UserID,
																						"ID"				=>	$ID,
																						"title"			=>	$title,
																						"startDate"		=>	$startDate,
																						"EndDate"		=>	$EndDate,
																						"startTime"		=>	$startTime,
																						"endTime"		=>	$endTime,
																						"Place"			=>	$Place,
																						"Submitter"		=>	$Submitter,
																						"Organization"	=>	$Organization,
																						"eventname"		=>	$eventname,
																						"image"			=>	$image,
																						"link"			=>	$link,
																						"description"	=>	$description,
																						"Approved"		=>	$Approved
																						)));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$UpdateEventResult = curl_exec($ch);
		curl_close($ch);
		//echo "<br/>";
		#$value = (json_decode($CreateEventResult,true));
		
		#pending
		return $UpdateEventResult;	#review reply from DB	
	}
	
	
	
	#Post Variables
	#$ID				= $_POST['ID'];
	#$title			= $_POST['title'];
	#$startDate		= $_POST['startDate'];
	#$EndDate			= $_POST['EndDate'];
	#$startTime		= $_POST['startTime'];
	#$endTime			= $_POST['endTime'];
	#$Place			= $_POST['Place'];
	#$Submitter		= $_POST['Submitter'];
	#$eventname		= $_POST['eventname'];
	#$Organization	= $_POST['Organization'];
	#$image			= $_POST['image'];  
	#$link				= $_POST['link'];
	#$description	= $_POST['description']; 
	
	
	#function
	$UserID			= $_POST['UserID'];
	$ID				= $_POST['ID'];				#EventID
	$title			= $_POST['title'];			#
	$startDate		= $_POST['startDate'];		#
	$EndDate			= $_POST['EndDate'];			#
	$startTime		= $_POST['startTime'];		#
	$endTime			= $_POST['endTime'];			#
	$Place			= $_POST['Place'];			#
	$Submitter		= $_POST['Submitter'];		#
	$Organization	= $_POST['Organization'];
	$eventname		= $_POST['eventname'];
	$image			= $_POST['image'];
	$link				= $_POST['link'];
	$description	= $_POST['description'];
	$Approved		= $_POST['Approved'];
	
	
	
	#admin can change everything
	#user can only edit his updates
	#
	
	#Function call
	$result = UpdateEvent();
	print_r( $result);

?>