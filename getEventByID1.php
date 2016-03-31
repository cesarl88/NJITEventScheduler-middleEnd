<?php  /* Implementation of curl */


  $ID = $_POST['ID'];

  $post = 'ID='.$ID;
	$url = 'https://web.njit.edu/~jsr24/CS490/getEventByID.php';
  $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);      /* functions that set an option for a curl transfer */
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
	$replyFromDB2 = curl_exec($ch); /* set variable to store response */
 
  
	curl_close($ch);
   echo $replyFromDB2;
	echo <br/>;
	
  
	$replyFromDB3 = json_decode($replyFromDB2, true);
	echo $replyFromDB2;
	echo <br/>;
	
 
	$value = json_decode($replyFromDB3, true); /* Using json to decode the response in a form of array */
	var_dump($value);

 
echo "<table border='1' >
  			<tr>
         <td><b>Event Name</b></td>
		    <td><b>Title</b></td>
  			<td><b>Start Date</b></td>
      		<td><b>Start Time</b></td>
  			<td><b>End Date</b></td>
		    <td><b>End Time</b></td>
  
			</tr>";
 foreach($value['Event'] as $item)
 {
 	$temp = json_decode($item,true);
 	var_dump($temp);
 	echo "<tr>";
  	echo "<td>".$temp['EventName']."</td>";
 	echo "<td>".$temp['Title']."</td>";
 	echo "<td>".$temp['startDate']."</td>";
 	echo "<td>".date('h:i:s a', strtotime($temp['startTime']))."</td>";
 	echo "<td>".$temp['EndDate']."</td>";
 	echo "<td>".date('h:i:s a', strtotime($temp['endTime']))."</td>";
 	echo "</tr>";
 }
 echo "</table>";

 
?>