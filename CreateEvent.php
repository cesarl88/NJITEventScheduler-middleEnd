<?php
	#ini_set('display_errors', 'On');
	#error_reporting(E_ALL);
	
	
	#include_once('login.php');
	function getUserName($UserID){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://web.njit.edu/~cls33/CS490/getUserName.php"); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array( "UserID" 	=> $UserID)));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$replyUserName = curl_exec($ch);
		curl_close($ch);
		return $replyUserName;
	
	}
	
	#Function Definition
	#Create event 
	#Approved (TRUE or FALSE) , UserID (integer)
	function CreateEvent($title,$startDate,$EndDate,$startTime,$endTime,$Place,$Submitter,$eventname,$Organization,$image,$link,$description,$UserID ){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://web.njit.edu/~cls33/CS490/CreateEvent.php"); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array("title" 			=> $title, 			
																						"startDate" 	=> $startDate, 		
																						"EndDate" 		=> $EndDate, 		
																						"startTime" 	=> $startTime, 		
																						"endTime"		=> $endTime,		
																						"Place"			=> $Place,			
																						"Submitter"		=> $Submitter,		
																						"eventname"		=> $eventname,		
																						"Organization"	=> $Organization,
																						"image"			=> $image,			
																						"link"			=> $link,
																						"description"	=> $description,	
																						"Approved" 		=> 0,					#0 Not Approved by default
																						"UserID" 		=> $UserID
																						)));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$CreateEventResult = curl_exec($ch);
		curl_close($ch);
		//echo "<br/>";
		#$value = (json_decode($CreateEventResult,true));
		
		#pending
		return $CreateEventResult;	#review reply from DB
		
	}

	
	
	
	#Variables to use for CreateEvent
	$title		 	= $_POST['title'];				#Mandatory from DB
	$startDate   	= $_POST['startDate'];
	$EndDate     	= $_POST['EndDate'];
	$startTime   	= $_POST['startTime'];			#Mandatory from DB
	$endTime     	= $_POST['endTime'];				#Mandatory from DB
	$Place       	= $_POST['Place'];
	#$Submitter    	= $_POST['Submitter'];
	$eventname   	= $_POST['eventname'];
	$Organization	= $_POST['Organization'];
	$image       	= $_POST['image'];
	$link        	= $_POST['link'];
	$description 	= $_POST['description'];
	#$Approved    	= $_POST['Approved'];
	$UserID      	= $_POST['UserID'];
	
	$SubmitterArray    	= json_decode(getUserName($UserID),true);
	print_r($SubmitterArray);
	
	$Submitter = $SubmitterArray['UserName'];
	print_r($Submitter);
	
		
	
	
	
	
	
	
	
	#Function call
	#$result = CreateEvent($title,$startDate,$EndDate,$startTime,$endTime,$Place,$Submitter,$eventname,$Organization,$image,$link,$description,$UserID);
	#print_r($result);
	
	
	#			#EventID 	
	#			#-1 in case of failure
	#			#-2 in case of an exception
	
?>


