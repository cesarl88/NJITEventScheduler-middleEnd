<?php
	#ini_set('display_errors', 'On');
	#error_reporting(E_ALL);
	
	
	#Review details about session
	session_set_cookie_params  (30,"/");
	session_start();
	if (!isset($_SESSION['count'])) {
		$_SESSION['count'] = 0;
	} else {
	$_SESSION['count']++;
	}
	
	
	
	#include_once('login.php');
	
	function login($userName , $Password){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://web.njit.edu/~cls33/CS490/login.php"); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, "userName=".$userName."&Password=".$Password);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$loginReply = curl_exec($ch);
		curl_close($ch);
		//echo "<br/>";
		#$login = (json_decode($loginReply,true));
		
		#pending
		#return $login['UserID'];   #review what needs to be done here
		return $loginReply;
	}

	#Variables to use for login
	$userName 		= $_POST['userName'];
	$Password 		= $_POST['Password'];
	
	#Call login function
	$logigResult = login($userName, $Password);
	
	#Decode results to an array
	$result = json_decode($logigResult , true);
	
	//echo "<br/>";
	#if role of user is admin
	if($result['Role'] == 2){
		#echo "<br/>";
		#echo 'https://web.njit.edu/~jar63/CS490/UserCalendar.html';
		echo json_encode(array('Reply' => "1" , 'Site' => "https://web.njit.edu/~jar63/CS490/UserCalendar.html"),JSON_PRETTY_PRINT);
	}
	#else if if role is user
	elseif($result['Role'] == 1){
		#echo "<br/>";
		#echo 'https://web.njit.edu/~jar63/CS490/AdminCalendar.html';
		echo json_encode(array('Reply' => "1" , 'Site' => "https://web.njit.edu/~jar63/CS490/AdminCalendar.html"),JSON_PRETTY_PRINT);
	}
	else{
		#echo "<br/>";
		#echo 'https://web.njit.edu/~jar63/CS490/index.html';
		echo json_encode(array('Reply' => "-1" , 'Site' => "https://web.njit.edu/~jar63/CS490/index.html"),JSON_PRETTY_PRINT);
		
	}
	
	#session_write_close();
	if($result['UserID'] == -1){
		session_unset();
	}
	elseif($result['UserID'] != -1 ){
		$_SESSION["UserID"] = $result['UserID'];
		#print_r($_SESSION);
	}
	
	
	

?>