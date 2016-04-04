<?php
	session_start();
	#include_once('login.php');
	include_once('getEventByID.php');
	#Function Definition
	
	
	function ListscheduleEventByUserID($UserID){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://web.njit.edu/~cls33/CS490/ListscheduleEventByUserID.php"); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, "UserID=".$UserID);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$getEventReply = curl_exec($ch);
		curl_close($ch);
		#echo "<br/>";
		#$value = (json_decode($getEventReply,true));
		return $getEventReply;	#review reply from DB	
	}
	
	$result = ListscheduleEventByUserID();
	print_r( $result );
	
	
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





