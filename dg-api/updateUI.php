<?php 
date_default_timezone_set('Europe/London');
include 'db.php';

$result = mysqli_query($conn,"select *,orders.email,orders.number,orders.name,orders.created_at as created_at,orders.id as orderid,orders.order_no as order_no,cast(delivery_charges as decimal(4,1)) as delivery_fee_new,
orders.status as o_status,orders.updated_at as o_updated from orders  where orders.created_at >= CURDATE() AND orders.status = '7'");//where orders.created = CURDATE()


if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
      
      
      echo "sdf";

      
      
      $date1 = strtotime($row['o_updated']);  
$date2 = strtotime(date('Y-m-d H:i:s')); 

echo date('Y-m-d H:i:s',$date2). "</br>";
echo date('Y-m-d H:i:s',$date1);

      $diff = abs($date2 - $date1); 
$years = floor($diff / (365*60*60*24));  
$months = floor(($diff - $years * 365*60*60*24) 
                               / (30*60*60*24));  
  
$days = floor(($diff - $years * 365*60*60*24 -  
             $months*30*60*60*24)/ (60*60*24)); 
  
$hours = floor(($diff - $years * 365*60*60*24  
       - $months*30*60*60*24 - $days*60*60*24) 
                                   / (60*60));  
                                   
                                   
$minutes = floor(($diff - $years * 365*60*60*24  
         - $months*30*60*60*24 - $days*60*60*24  
                          - $hours*60*60)/ 60); 
                          
                          
                          echo $minutes;
                          if($minutes > 10)
                          {
                              $result = mysqli_query($conn,"select * from emp_login");

if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {

    $url = "https://fcm.googleapis.com/fcm/send";
    $token = $row['token'];//'dpDDkSbtQ5eKX7UgIOofK_:APA91bHt8Bwu1Q35kKg4zFeqLAdCxizQLm1SBreSsZLZ0dNcUOLfZXrb5zCkHAIY0LKm2Tl7cRwObo9EYAGy7KKKIEhFNCUqIQGdXyDqja5iIjKHVGCLjLjYk2DUSNVvEGpInhuWsD76';//$row['token']; //"eigkNSP1S3mKJ9S24KAWna:APA91bGkFLRz4-ZeSOMlsLy2t64FW0Z_QsMMvKG-OCdJUu6tZoFmMqW68x1gXNrRnObbu3pgSLgUb53Jc9vqtTHD1wBgjgd9u3s8v2apX0ah6MwpbIGi0_NtpNKUby4FlrMBjMB4IQyj";
    $serverKey = 'AAAAhjBvD4o:APA91bEB8it_v01hz7ITKFTThqeM8Z3DTvkYNFyzAIawjPlAomqdbnO3oJNsiEa1Hhu53UYob3Igj4Q0ZeqbVGxy2pU8rGxu4AJoP5G4laC95PDKNr7bcPHC5nIkNTjkitDgzklKzaU_';
    $title = "Alert";
    $body = "Order inside kitchen waiting";
    $id = "";
    $dat = array
(
    'id'     => $id
);
    $notification = array('title' =>$title , 'body' => $body, 'sound' => 'ring.mp3', 'badge' => '1', 'data'       => $dat);
    $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high', 'data'       => $dat);
    $json = json_encode($arrayToSend);
    
    
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: key='. $serverKey;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    //Send the request
    $response = curl_exec($ch);
    //Close request
    if ($response === FALSE) {
    die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);
  }
}
                          }
                          
                          
                          
      
      
      
      
  }
  }


mysqli_close($conn);

?>