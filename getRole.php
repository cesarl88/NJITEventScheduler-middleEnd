<?php
	#ini_set('display_errors', 'On');
	#error_reporting(E_ALL);
	
	
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
		return $value;
	}
	
	#getRole
	$UserID 			= $_POST['UserID'];
	
	#Function getRole($UserID)
	$result = getRole($UserID);
	
	#Confirm if appplicable 
	print_r(json_encode( $result ,true));
	
	#{"Role":"1"}		#Admin
	#{"Role":"2"}		#User
	#{"Roles":"-1"}	#NonAuthenticated

?>