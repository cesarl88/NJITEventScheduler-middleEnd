<?

	session_start();
	if($_SESSION){
		print_r($_SESSION);
		session_unset();
		session_destroy();		
	}
	else{
		echo "Nothing to Destroy";
	}
	
	
?>