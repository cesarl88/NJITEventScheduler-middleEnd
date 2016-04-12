<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);	

include_once('formatDate.php');
	
function addGoogleCalendarEvent($title, $Place, $description, $startD, $EndD, $linkSite){
	$event = new Google_Service_Calendar_Event(
		array(
		  'summary' 		=> $title,
		  'location' 		=> $Place,
		  'description' 	=> $description,
		  'htmlLink'		=> $linkSite,
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
	
	return $event;
	$calendarId = 'primary';
	#$event = $service->events->insert($calendarId, $event);
	#printf('Event created: %s\n', $event->htmlLink);
	}
	
	
	
	
	$title			=	$_POST['title'];
	$Place			=	$_POST['Place'];
	$description	=	$_POST['description'];
	$startDate   	=	$_POST['startDate'];
	$EndDate     	=	$_POST['EndDate'];
	$startTime   	=	$_POST['startTime'];
	$endTime     	=	$_POST['endTime'];
	$eventID			=	$_POST['eventID'];
	
	#Format Start Date and End Date with GoogleAPI specifications 
	#Sample: "2015-05-28T17:00:00Z"
	$startD 	=	formatDate($startDate,$startTime);
	$endD		=	formatDate($EndDate, $endTime);
	
	#var_dump($startD);
	#echo "</br>";
	#var_dump($endD);
	
	#Create link to embed on GoogleCalendar
	$linkSite = $title."<\"method=\"POST\" action=\"getEventByID.php\" name=\"ID\" value=\"".$eventID.">";
	
	
	#possible solution
	#      var form = '<form name="'+frmName+'" method="post" action="'+url'">'+pe+'</form>';
	
	
	echo $linkSite;
	
	
	
	#call function
	$result = addGoogleCalendarEvent($title, $Place, $description, $startD, $EndD, $linkSite);
	print_r( $result);
	
	
	
	
	
?>