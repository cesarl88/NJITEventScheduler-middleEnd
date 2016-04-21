<?php
	
	session_start();
	
	#ini_set('display_errors', 'On');
	#error_reporting(E_ALL);	

	
	#print_r(get_defined_vars());
	
	
	echo "Begin</br>";
	print_r ($_GET);
	echo "</br>";
	print_r ($_POST);
	echo "</br>";
	print_r ($_SESSION);
	echo "</br>";
	if(isset($var)){
		print_r ($var);
	}
	
	
	
	
	include_once('formatDate.php');
	
	//Dependency for Composer
	require_once __DIR__ . '/vendor/autoload.php';
	
	//Definition of variables from Google API
	define('CREDENTIALS_PATH', '~/.credentials/calendar-php-quickstart.json');
	define('CLIENT_SECRET_PATH', __DIR__ . '/client_secret.json');
	define('SCOPES', implode(' ', array(Google_Service_Calendar::CALENDAR)));
	define('REDIRECT_URI', 'https://web.njit.edu/~jsr24/CS490/AddToGoogleC.php');
	#define('REDIRECT_URI', 'urn:ietf:wg:oauth:2.0:oob');
	define('CLIENT_ID', '730791246182-sjnjd2b3sf6d3mhemda24eukho3jtien.apps.googleusercontent.com');

	//This function is supposed to get all event details
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
	
	
	#function authenticate(){
	#	$ch = curl_init();
	#	curl_setopt($ch, CURLOPT_URL, "https://accounts.google.com/o/oauth2/v2/auth"); 
	#	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
	#																					"scope"				=> "https://www.googleapis.com/auth/calendar",
	#																					"redirect_uri" 	=> "urn:ietf:wg:oauth:2.0:oob:auto",
	#																					"response_type"	=> "code",
	#																					"client_id"			=> CLIENT_ID,
	#																			)));
	#	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	#	$getEventReply = curl_exec($ch);
	#	curl_close($ch);
	#	#echo "<br/>";
	#	#$value = (json_decode($getEventReply,true));
	#	#return $getEventReply;	#review reply from DB	
	#	var_dump($getEventReply);
	#}
	
	
	
	
	
#	//Post variables
#	#$title			=	$_POST['title'];
#	#$Place			=	$_POST['Place'];
#	#$description	=	$_POST['description'];
#	#$startDate   	=	$_POST['startDate'];
#	#$EndDate     	=	$_POST['EndDate'];
#	#$startTime   	=	$_POST['startTime'];
#	#$endTime     	=	$_POST['endTime'];
#	
	if(isset($_POST['ID'])){
		global $var;
		$var = $_POST['ID'];
		#var_dump ($var);
		#echo "</br>";
		$_SESSION['eventID']	=	$_POST['ID'];
		echo "SessionEventID".$_SESSION['eventID'];
	}
	elseif(isset($_SESSION['eventID'])){
		echo "SessionEventID is working";
	}
	
	else{
		echo "AfterInitialPost".$_SESSION['eventID'];
		echo "</br>";
	}
	
	$client = new Google_Client();
	$client->setScopes(SCOPES);
	$client->setAuthConfigFile(CLIENT_SECRET_PATH);
	$client->setAccessType('offline');
	$client->setRedirectUri(REDIRECT_URI);
	$client->setClientId(CLIENT_ID);
	
	$service = new Google_Service_Calendar($client);
	
	if (isset($_REQUEST['logout'])) {
		echo "logOut</br>";
		unset($_SESSION['access_token']);
	}
		
	#if (isset($_GET['code'])) {
	#	$client->authenticate($_GET['code']);
	#	echo "1_This executes";
	#	$_SESSION['access_token'] = $client->getAccessToken();
	#	echo "2_This executes";
	#	
	#	$redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
	#	echo "3_This executes";
	#	
	#	header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
	#	echo "4_This executes";
	#	
	#	#$redirect = 'https://web.njit.edu/~jsr24/CS490/val.php';
	#	#header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
	#}
	
	if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
		echo "AccessTokenExecutes</br>";
		$client->setAccessToken($_SESSION['access_token']);
		
	} 
	else {
		echo "ElseAccessTokenExecutes</br>";
		$authUrl = $client->createAuthUrl();
	}
	
	//If authentication is complete perform action
	if ($client->getAccessToken()) {
		echo "I have been authenticated.Session EventID = ".$_SESSION['eventID']." OR ".$var;
		#echo $_SESSION['eventID'];
		
		$event = $_SESSION['eventID'];
		
		#call Function to get Event details
		$eventDetails = getEventByID($event);
		var_dump($eventDetails);
		
		#calll function to format Dates
		#$startD 	=	formatDate($startDate,$startTime);
		#$endD		=	formatDate($EndDate, $endTime);
		
		
		
		#$event = new Google_Service_Calendar_Event(
		#	array(
		#	  'summary' 		=> $title,
		#	  'location' 		=> $Place,
		#	  'description' 	=> $description,
		#	  'start' => array(
		#		 'dateTime' => $startD,
		#		 'timeZone' => 'America/New_York',
		#	  ),
		#	  'end' => array(
		#		 'dateTime' => $EndD,
		#		 'timeZone' => 'America/New_York',
		#	  ),
		#	  'reminders' => array(
		#			'useDefault' => FALSE,
		#			'overrides' => array(
		#					array('method' => 'email', 'minutes' => 24 * 60),
		#		 ),
		#	  ),
		#));
		#
		#$calendarId = 'primary';
		##$event = $service->events->insert($calendarId, $event);
		#printf('Event created: %s\n', $event->htmlLink);
		
	}
	
	#print_r(get_defined_vars());
	
	echo "End</br>";
	print_r ($_GET);
	echo "</br>";
	print_r ($_POST);
	echo "</br>";
	print_r ($_SESSION);
	echo "</br>";
	if(isset($var)){
		print_r ($var);
	}
	
?>

<div class="box">
<div class="request">
<?php 
if (isset($authUrl)) {
  echo "<a class='login' href='" . $authUrl . "'>Connect Me!</a>";
}
?>
  </div>

  <div class="shortened">