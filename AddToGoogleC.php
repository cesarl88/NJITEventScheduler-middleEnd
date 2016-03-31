<?
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);
	
	
	function createEnvent($eventID){
		Event event = new Event();
		event.setId($eventID);
		client.events().insert("primary", event).execute();
		echo json_encode(array('Passed'=> "1"),JSON_PRETTY_PRINT)
	}
	
	



	function CalendarListEntry($eventID){
		$calendarListEntry = new Google_Service_Calendar_CalendarListEntry();
		$calendarListEntry->setId($eventID);
		$createdCalendarListEntry = $service->calendarList->insert($calendarListEntry);
		echo $createdCalendarListEntry->getSummary();
	}
	
	
	
	$eventID =  $_POST['eventID'];
	$result1 =  createEnvent($eventID);
	$result2 =  CalendarListEntry($eventID);
	
	
	
?>