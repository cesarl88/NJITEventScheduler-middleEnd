<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);	
	
	
function addGoogleCalendarEvent($title, $Place, $description, $startDate, $EndDate){
	$event = new Google_Service_Calendar_Event(
		array(
		  'summary' 		=> $title,
		  'location' 		=> $Place,
		  'description' 	=> $description,
		  'start' => array(
			 'dateTime' => $startDate,
			 'timeZone' => 'America/New_York',
		  ),
		  'end' => array(
			 'dateTime' => $EndDate,
			 'timeZone' => 'America/New_York',
		  ),
		  'recurrence' => array(
			 'RRULE:FREQ=DAILY;COUNT=2'
		  ),
		  'reminders' => array(
				'useDefault' => FALSE,
				'overrides' => array(
						array('method' => 'email', 'minutes' => 24 * 60),
			 ),
		  ),
	));
	$calendarId = 'primary';
	$event = $service->events->insert($calendarId, $event);
	printf('Event created: %s\n', $event->htmlLink);
	}
	
	
	
	
	$title			= $_POST['title'];
	$Place			= $_POST['Place'];
	$description	= $_POST['description'];
	$startDate   	= $_POST['startDate'];
	$EndDate     	= $_POST['EndDate'];
	$startTime   	= $_POST['startTime'];
	$endTime     	= $_POST['endTime'];
	
	$startD 	=	formatDate($startDate,$startTime);
	$endD		=	formatDate($EndDate, $endTime);
	
	var_dump($startD);
	echo "</br>";
	var_dump($endD);
	
	#call function
	#$result = addGoogleCalendarEvent($title, $Place, $description, $startDate, $EndDate);
	#print_r( $result);
	
	
	
	
	
?>