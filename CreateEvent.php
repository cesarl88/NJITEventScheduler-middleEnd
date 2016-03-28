<?php
	
	#include_once('login.php');
	
	#Function Definition
	#Create event 
	#Approved (TRUE or FALSE) , UserID (integer)
	function CreateEvent($title,$startDate,$EndDate,$startTime,$endTime,$Place,$Submiter,$eventname,$Organization,$image,$link,$description,$Approved ,$UserID ){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://web.njit.edu/~cls33/CS490/CreateEvent.php"); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array("title" 			=> $title, 			
																						"startDate" 	=> $startDate, 		
																						"EndDate" 		=> $EndDate, 		
																						"startTime" 	=> $startTime, 		
																						"endTime"		=> $endTime,		
																						"Place"			=> $Place,			
																						"Submiter"		=> $Submiter,		
																						"eventname"		=> $eventname,		
																						"Organization"	=> $Organization,
																						"image"			=> $image,			
																						"link"			=> $link,
																						"description"	=> $description,	
																						"Approved" 		=> $Approved,	
																						"UserID" 		=> $UserID
																						)));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$CreateEventResult = curl_exec($ch);
		curl_close($ch);
		//echo "<br/>";
		$value = (json_decode($CreateEventResult,true));
		
		#pending
		return $value;	#review reply from DB
		
	}

	
	
	
	#Variables to use for CreateEvent
	$title		 	= $_POST['title'];			
	$startDate   	= $_POST['startDate'];
	$EndDate     	= $_POST['EndDate'];
	$startTime   	= $_POST['startTime'];
	$endTime     	= $_POST['endTime'];
	$Place       	= $_POST['Place'];
	$Submiter    	= $_POST['Submiter'];
	$eventname   	= $_POST['eventname'];
	$Organization	= $_POST['Organization'];
	$image       	= $_POST['image'];
	$link        	= $_POST['link'];
	$description 	= $_POST['description'];
	$Approved    	= $_POST['Approved'];
	$UserID      	= $_POST['UserID'];
	
	
	#Function call
	$result = CreateEvent($title,$startDate,$EndDate,$startTime,$endTime,$Place,$Submiter,$eventname,$Organization,$image,$link,$description,$Approved,$UserID);
	print_r(json_encode( $result ,true));

?>