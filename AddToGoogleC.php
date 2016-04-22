<?php
	
	session_start();
	date_default_timezone_set('America/New_York');

	#ini_set('display_errors', 'On');
	#error_reporting(E_ALL);	

	
	#print_r(get_defined_vars());
	
	
	#echo "Begin</br>";
	#print_r ($_GET);
	#echo "</br>";
	#print_r ($_POST);
	#echo "</br>";
	#print_r ($_SESSION);
	
	
	//Dependency for Composer
	require_once __DIR__ . '/vendor/autoload.php';
	
	//Definition of variables from Google API
	define('CREDENTIALS_PATH', '~/.credentials/calendar-php-quickstart.json');
	define('CLIENT_SECRET_PATH', __DIR__ . '/client_secret.json');
	define('SCOPES', implode(' ', array(Google_Service_Calendar::CALENDAR)));
	define('REDIRECT_URI', 'https://web.njit.edu/~jsr24/CS490/AddToGoogleC.php');
	define('CLIENT_ID', '730791246182-sjnjd2b3sf6d3mhemda24eukho3jtien.apps.googleusercontent.com');

	//This function is supposed to get all event details
	function getEventByID($ID){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://web.njit.edu/~jsr24/CS490/getEventByID.php"); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, "ID=".$ID);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$getEventReply = curl_exec($ch);
		curl_close($ch);
		return $getEventReply;	#review reply from DB	
	}
	
	
	if(isset($_POST['ID'])){
		$var = $_POST['ID'];
		#var_dump ($var);
		#echo "</br>";
		$_SESSION['eventID']	=	$_POST['ID'];
		#echo "SessionEventID".$_SESSION['eventID'];
	}
	elseif(isset($_SESSION['eventID'])){
		#echo "SessionEventID is working";
	}
	
	else{
		#echo "AfterInitialPost".$_SESSION['eventID'];
		#echo "</br>";
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
		
	if (isset($_GET['code'])) {
		$client->authenticate($_GET['code']);
		$_SESSION['access_token'] = $client->getAccessToken();
		$redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
	}
	
	if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
		$client->setAccessToken($_SESSION['access_token']);
	} 
	else {
		$authUrl = $client->createAuthUrl();
	}
	
	//If authentication is complete perform action
	if ($client->getAccessToken()) {
		#echo "I have been authenticated.Session EventID = ".$_SESSION['eventID'];
		#echo $_SESSION['eventID'];
		
		
		$eventID = '33454';
		#$eventID = $_SESSION['eventID'];
		
		
		#TO-DO
		#Check on DB whether the user has already added it to GoogleCal
		
		
		
		
		
		#call Function to get Event details
		$eventDetails = getEventByID($eventID);
		
		$eventArray = json_decode($eventDetails,true);
		$eventArray = $eventArray['Event'];
		
		$title       		= 		$eventArray['Title'];
		$Place       		= 		$eventArray['Place'];
		$description      = 		'Event Name:'."\n\t".$eventArray['EventName']."\n".
										'Description:'."\n\t".$eventArray['Description']."\n".
										'link:'."\n\t".$eventArray['link']."\n".
										'Organization:'."\n\t".$eventArray['Organization']."\n".
										'Submitter:'."\n\t".$eventArray['Submitter'];
		$startDate 			= 		$eventArray['startDate'];
		$startTime			= 		$eventArray['startTime'];
		$EndDate       	= 		$eventArray['EndDate'];
		$endTime       	= 		$eventArray['endTime'];
		$addToGoogle		= 		$eventArray['addToGoogle'];
		
		
		#Create date objects
		$val = $startDate."T".$startTime."Z";
		$startD = new DateTime($val);
		
				
		$val2 = $EndDate."T".$endTime."Z";
		$endD = new DateTime($val2);
		
		
		#echo "</br>";
		#var_dump($startD);
		#echo "</br>";
		#var_dump($endD);
		
		$event = new Google_Service_Calendar_Event(
			array(
			  'summary' 		=> $title,
			  'location' 		=> $Place,
			  'description' 	=> $description,
			  'start' => array(
				 'dateTime' => date_format($startD, "Y-m-d\TH:i:s"),
				 'timeZone' => "America/New_York",
			  ),
			  'end' => array(
				 'dateTime' => date_format($endD, "Y-m-d\TH:i:s"),
				 'timeZone' => "America/New_York",
			  ),
			  'reminders' => array(
					'useDefault' => FALSE,
					'overrides' => array(
							array('method' => 'email', 'minutes' => 24 * 60),
				 ),
			  ),
		));
		#echo "</br></br></br>";
		#var_dump($event);
		
		$calendarId = 'primary';
		$event = $service->events->insert($calendarId, $event);
		
		#printf('Event created: %s\n', $event->htmlLink);
		echo "<a href=".$event['htmlLink'].">Event created</a>";
		#echo "</br></br></br>";
		#var_dump($event);
	}
	
	#print_r(get_defined_vars());
	
	#echo "End</br>";
	#print_r ($_GET);
	#echo "</br>";
	#print_r ($_POST);
	#echo "</br>";
	#print_r ($_SESSION);
	
	
?>

<div class="box">
<div class="request">
<?php 
if (isset($authUrl)) {
  echo "</br><a class='login' href='" . $authUrl . "'>Connect Me!</a>";
}
?>
  </div>

  <div class="shortened">