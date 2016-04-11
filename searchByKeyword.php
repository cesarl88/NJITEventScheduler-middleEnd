<?php
	session_start();
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);	
	
	
	#Function Definition
	function searchByKeyword($keyWord){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://web.njit.edu/~cls33/CS490/searchByKeyword.php"); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array( "keyWord" 	=> $keyWord)));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$replyUserName = curl_exec($ch);
		curl_close($ch);
		return $replyUserName;
	
	}
	
	
	$keyWord = $_POST['keyWord'];
	
	#Function call
	$result = searchByKeyword($keyWord);
	print_r($result);

?>