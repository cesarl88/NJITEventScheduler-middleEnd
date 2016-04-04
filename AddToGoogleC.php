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
	
	
	#Format Start date with form '2015-05-28T09:00:00-04:00'
	#"Y-m-d\TH:i:sP"
	
	$startDate 	= $startDate.'T'.$startTime.'-04:00';
	#var_dump($startDate);
	#echo "<br/>";
	
	$startDate1 = $startDate.' '.$startTime;
	#$startDate2 = $startDate1;
	
	#$datetime = \DateTime::createFromFormat("Y-m-d H:i:s",$startDate2);
	#$datetime->format(\DateTime::RFC3339);
	#var_dump($datetime);
	#echo "<br/>";
	
	
	$startDate1 = date("c", strtotime($startDate1));
	#var_dump($startDate1);
	#echo "<br/>";
	
	
	#Format End date with form '2015-05-28T17:00:00-04:00'
	#$EndDate 	= $EndDate.'T'.$endTime.'-04:00';
	#var_dump($EndDate);
	
	
	$finalTime = strtotime(startDate1);
	var_dump(date('Y-m-d\TH:i:s', $finalTime));
	
	
	#call function
	#$result = addGoogleCalendarEvent($title, $Place, $description, $startDate, $EndDate);
	#print_r( $result);
	
	
	
	
	
?>