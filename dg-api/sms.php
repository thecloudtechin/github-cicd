<?php
 header('Access-Control-Allow-Origin: *'); 
    header("Access-Control-Allow-Credentials: true");
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
    header('Access-Control-Max-Age: 1000');
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');
include 'db.php';
$curl = curl_init();
$json = file_get_contents('php://input');
// Converts it into a PHP object
$data = json_decode($json);
$to=$data->to;
if($to=="447574344346"){
     $otp='1234';
 }
 else{
//  $ran=rand(10,10000); // otp
$ran = mt_rand(1000,9999);
 $otp=$ran;
 }
// $ran=rand(1000,9999); // otp
//  $otp=$ran;
// $username="AltinKarar2";
// $password="GlasgowChennai@2018";
$username="MarketingGuru";
$password="PedroGadha@198586";
$token=sha1(mt_rand(100,999).time()); // token
$datee=date("Y/m/d");
$getsql="select * from users where mobile='$to'";
	$getsql1=mysqli_query($conn,$getsql);
	if(mysqli_num_rows($getsql1) == 0){
		$pusql="insert into users(mobile,otp,status) VALUES ('$to','$otp','0')";
		$pusql1=mysqli_query($conn,$pusql);
	}
	else{
		$updatesql="UPDATE users SET otp='$otp' where mobile='$to'";
		$updatesql1=mysqli_query($conn,$updatesql);
	}
$name=$data->name;
$from="D%20GURU";
$text="Your%20".$name."%20Login%20OTP%20:".$otp;
$text = str_replace(' ', '_', $text);
$prms="username=".$username."&password=".$password."&from=".$from."&to=".$to."&text=".$text.".";
$action = "POST";
$url = "https://p5k3e.api.infobip.com/sms/1/text/query?".$prms."";
curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    // CURLOPT_POSTFIELDS =>"{\"messages\":[{\"from\":\"InfoSMS\",\"destinations\":[{\"to\":\"7506455687\",\"messageId\":\"MESSAGE-ID-123-xyz\"},{\"to\":\"7506455687\"}],\"text\":\"Artık Ulusal Dil Tanımlayıcısı ile Türkçe karakterli smslerinizi rahatlıkla iletebilirsiniz.\",\"flash\":false,\"language\":{\"languageCode\":\"TR\"},\"transliteration\":\"TURKISH\",\"intermediateReport\":true,\"notifyUrl\":\"https://www.example.com/sms/advanced\",\"notifyContentType\":\"application/json\",\"callbackData\":\"DLR callback data\",\"validityPeriod\":720},{\"from\":\"41793026700\",\"destinations\":[{\"to\":\"41793026700\"}],\"text\":\"A long time ago, in a galaxy far, far away... It is a period of civil war. Rebel spaceships, striking from a hidden base, have won their first victory against the evil Galactic Empire.\",\"sendAt\":\"2021-08-25T16:00:00.000+0000\",\"deliveryTimeWindow\":{\"from\":{\"hour\":6,\"minute\":0},\"to\":{\"hour\":15,\"minute\":30},\"days\":[\"MONDAY\",\"TUESDAY\",\"WEDNESDAY\",\"THURSDAY\",\"FRIDAY\",\"SATURDAY\",\"SUNDAY\"]}}],\"bulkId\":\"BULK-ID-123-xyz\",\"tracking\":{\"track\":\"SMS\",\"type\":\"MY_CAMPAIGN\"}}",
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
        "Accept: application/json"
    ),
));

$response = curl_exec($curl);

curl_close($curl);

$output=json_decode($response, TRUE);
echo $output['messages'][0]['status']['groupName'];





