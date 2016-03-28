<?php
	
	#include_once('login.php');
	
	function login($userName , $Password){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://web.njit.edu/~cls33/CS490/login.php"); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, "userName=".$userName."&Password=".$Password);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$loginReply = curl_exec($ch);
	curl_close($ch);
	//echo "<br/>";
	$login = (json_decode($loginReply,true));
	
	#pending
	return $login['UserID'];   #review what needs to be done here
	}

	#Variables to use for login
	$userName 		= $_POST['userName'];
	$Password 		= $_POST['Password'];

	$result = login($userName, $Password);
	print_r(json_encode( $result ,true));

?>