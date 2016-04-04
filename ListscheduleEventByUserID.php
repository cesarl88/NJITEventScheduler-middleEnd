<?php
	#session_start();
	#include_once('login.php');
	#include_once('getEventByID.php');
	#Function Definition
	
	function getEventByID($ID){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://web.njit.edu/~jsr24/CS490/getEventByID.php"); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, "ID=".$ID);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$getEventReply = curl_exec($ch);
		curl_close($ch);
		#echo "<br/>";
		#$value = (json_decode($getEventReply,true));
		return $getEventReply;	#review reply from DB	
	}
	
	
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
	
	
	
	$UserID = $_POST['UserID'];
	
	$listEvents = ListscheduleEventByUserID($UserID);
	
	#var_dump($listEvents);
	echo "<br/>";
	
	$listEvents = json_decode($listEvents,true);
	var_dump($listEvents);
	echo "<br/>";
	
	$tmp = $listEvents['Event'];
	var_dump($tmp);
	echo "<br/>";
	
	if(isset($tmp)){
		foreach($tmp as $value){
				var_dump (json_decode($value['EventID'],true)); 
				echo "<br/>";
				var_dump ($value); 
				echo "<br/>";
			}
			
			#$result[] = json_decode($item['Event'],true);
					/*	$test = json_decode($item->getJSON(),true);*/
		}
	
	#	#echo json_encode(array('Event' => $result));
	#}
  # else{
  # 	echo json_encode(array('EventID' => -1));
  }
  
  
  
  
  
	
	#Function call
	

?>





