<?php 
header("Access-Control-Allow-Origin: *");
include 'db.php';
define( 'API_ACCESS_KEY', 'AAAAvMgUe-E:APA91bELGdRGA2_a_YVb-iQPAVk4naPTp5fgGahWlU_8DSKGSZd4mgDM5VmoGiowUXrvhKCG_yBS0aIbc7NZUeikI4Otjn5aMlDZmFnA6JXasVxxfzfk1-J99TvBa6_r2N7lPWQfwI4z' ); 


 
      
$query = "SELECT token FROM emp_logins WHERE emp_id = 'adminDG' AND token IS NOT NULL";
$result1 = mysqli_query($conn, $query);
while($row1 = mysqli_fetch_assoc($result1)){

$token = $row1['token'];
$serverKey = 'AAAAvMgUe-E:APA91bELGdRGA2_a_YVb-iQPAVk4naPTp5fgGahWlU_8DSKGSZd4mgDM5VmoGiowUXrvhKCG_yBS0aIbc7NZUeikI4Otjn5aMlDZmFnA6JXasVxxfzfk1-J99TvBa6_r2N7lPWQfwI4z';

          $body = array(
		"to" => $token,
		"notification" => array(
		"title" => "DeliveryGuru",
                        "body" => 'admin refresh call',
                        "sound" => "ring.mp3"
		),
		"data" => array("targetScreen" => "detail"),
		"priority" => 10
	);

	$headers = array(
		'Content-Type: application/json',
		'Authorization: key=' . $serverKey
	);

	if($ch = curl_init()) {
		curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
	$result = curl_exec($ch);
		curl_close( $ch );
		echo $result . "\n\n";
	}

}





?>