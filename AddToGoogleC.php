<?php
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);	

	include_once('formatDate.php');
	
	//Dependency for Composer
	require_once __DIR__ . '/vendor/autoload.php';
	
	//Definition of variables from Google API
	define('APPLICATION_NAME', 'Google Calendar API PHP Quickstart');
	define('CREDENTIALS_PATH', '~/.credentials/calendar-php-quickstart.json');
	define('CLIENT_SECRET_PATH', __DIR__ . '/client_secret.json');
	define('SCOPES', implode(' ', array(Google_Service_Calendar::CALENDAR)));
	
	
	//Post variables
	$title			=	$_POST['title'];
	$Place			=	$_POST['Place'];
	$description	=	$_POST['description'];
	$startDate   	=	$_POST['startDate'];
	$EndDate     	=	$_POST['EndDate'];
	$startTime   	=	$_POST['startTime'];
	$endTime     	=	$_POST['endTime'];
	$eventID			=	$_POST['eventID'];
	
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
	
	//This function is the main function called in order to generate the event on the user Calendar
	function addGoogleCalendarEvent($title, $Place, $description, $startD, $EndD, $linkSite){
		$event = new Google_Service_Calendar_Event(
			array(
			  'summary' 		=> $title,
			  'location' 		=> $Place,
			  'description' 	=> $description,
			  #'htmlLink'		=> $linkSite,
			  'start' => array(
				 'dateTime' => $startD,
				 'timeZone' => 'America/New_York',
			  ),
			  'end' => array(
				 'dateTime' => $EndD,
				 'timeZone' => 'America/New_York',
			  ),
			  'reminders' => array(
					'useDefault' => FALSE,
					'overrides' => array(
							array('method' => 'email', 'minutes' => 24 * 60),
				 ),
			  ),
		));
		
		#print_r($event);
		#echo </br>;
		#var_dump($event);
		
		#return $event;
		$calendarId = 'primary';
		$event = $service->events->insert($calendarId, $event);
		printf('Event created: %s\n', $event->htmlLink);
		}
	
	
	//Google API function to setup and authenticate user to have access to Calendar
	function getClient() {
	  $client = new Google_Client();
	  $client->setApplicationName(APPLICATION_NAME);
	  $client->setScopes(SCOPES);
	  $client->setAuthConfigFile(CLIENT_SECRET_PATH);
	  $client->setAccessType('offline');

	  // Load previously authorized credentials from a file.
	  $credentialsPath = expandHomeDirectory(CREDENTIALS_PATH);
	  if (file_exists($credentialsPath)) {
		 $accessToken = file_get_contents($credentialsPath);
	  } 
	  else {
		 // Request authorization from the user.
		 $authUrl = $client->createAuthUrl();
		 printf("Open the following link in your browser:\n%s\n", $authUrl);
		 print 'Enter verification code: ';
		 $authCode = trim(fgets(STDIN));

		 // Exchange authorization code for an access token.
		 $accessToken = $client->authenticate($authCode);

		 // Store the credentials to disk.
		 if(!file_exists(dirname($credentialsPath))) {
			mkdir(dirname($credentialsPath), 0700, true);
		 }
		 file_put_contents($credentialsPath, $accessToken);
	  }
	  $client->setAccessToken($accessToken);

	  // Refresh the token if it's expired.
	  if ($client->isAccessTokenExpired()) {
		 $client->refreshToken($client->getRefreshToken());
		 file_put_contents($credentialsPath, $client->getAccessToken());
	  }
	  return $client;
	}
	
	/**
	 * Expands the home directory alias '~' to the full path.
	 * @param string $path the path to expand.
	 * @return string the expanded path.
	 */
	function expandHomeDirectory($path) {
	  $homeDirectory = getenv('HOME');
	  if (empty($homeDirectory)) {
		 $homeDirectory = getenv("HOMEDRIVE") . getenv("HOMEPATH");
	  }
	  return str_replace('~', realpath($homeDirectory), $path);
	}

	

	
	
	// Get the API client and construct the service object.
	$client = getClient();
	$service = new Google_Service_Calendar($client);
	
	if(isset($eventID)){
		$event = getEventByID($eventID);
		var_dump($event);
		
		#Format Start Date and End Date with GoogleAPI specifications 
		#Sample: "2015-05-28T17:00:00Z"
		$startD 	=	formatDate($startDate,$startTime);
		$endD		=	formatDate($EndDate, $endTime);
		
		#Create link to embed on GoogleCalendar
		$linkSite = $title."<\"method=\"POST\" action=\"getEventByID.php\" name=\"ID\" value=\"".$eventID.">";
		#possible solution
		#var form = '<form name="'+frmName+'" method="post" action="'+url'">'+pe+'</form>';
	
		#echo $linkSite;
		#call function
		$result = addGoogleCalendarEvent($title, $Place, $description, $startD, $endD, $linkSite);
		var_dump( $result);
		
	}
	else{
		echo "Not event found!";
	}
	
	
	
	
	
	
	
	
	
	
	
?>