<?php
	
	#include_once('fileName.php');
	
	#Function Definition
	#Get Role of user id
	function getRole($UserID){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://web.njit.edu/~cls33/CS490/getRole.php"); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, "UserID=".$UserID);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$getRoleReply = curl_exec($ch);
		curl_close($ch);
		//echo "<br/>";
		$value = (json_decode($getRoleReply,true));
		
		#pending
		return $value['UserID'];	#review reply from DB
	}
	
	#getRole
	$UserID 			= $_POST['UserID'];
	
	#Function getRole($UserID)
	$result = getRole($UserID);
	
	#Confirm if appplicable 
	print_r(json_encode( $result ,true));

?>