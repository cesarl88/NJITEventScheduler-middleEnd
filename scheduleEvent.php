<?php
	#session_start();
	#include_once('login.php');
	#Function Definition
	
	
	function unscheduleEvent($EventID,$UserID){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://web.njit.edu/~cls33/CS490/scheduleEvent.php"); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
																						"UserID"			=>	$UserID,
																						"EventID"		=>	$EventID)));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$getEventReply = curl_exec($ch);
		curl_close($ch);
		#echo "<br/>";
		#$value = (json_decode($getEventReply,true));
		return $getEventReply;	#review reply from DB	
	}
	
	$EventID = $_POST['EventID'];
	$UserID = $_POST['UserID'];
	
	$result = unscheduleEvent();
	print_r($result);
	
	
	#if($schedule)
	#{
  	#$result = [];
  	#foreach($schedule as $item)
  	#{
  	#	$result[] = $item->getJSON();
  	#	   	/*	$test = json_decode($item->getJSON(),true);
  	#	 echo 'Title : '.$test['Title'].'<br/>'; */
  	#}
  	#echo json_encode(array('Event' => $result));
   #}
   #else
   #{
   #	echo json_encode(array('Event' => -1));
   #}
  
  
  
  
  
	
	#Function call
	

?>





