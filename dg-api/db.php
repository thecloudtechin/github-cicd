<?php 

$conn = new mysqli("delivery.cuqz27co8fnc.ap-south-1.rds.amazonaws.com",'admin', '4SsXAoKNe7SEqCLhB9iT',"lumen");

// Check connection
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}

function d($d)
{
	echo '<pre>';
	print_r($d);
	echo '</pre>';
}
function Auth()
{
	if(!isset($_SESSION['aid'])) {
		$_SESSION['error'] = 'Please Login!';
		echo "<script>window.location = 'login.php';</script>";
		exit();
	}
} 
function uAuth()
{
	if(!isset($_SESSION['uid'])) {
		$_SESSION['error'] = 'Please Login!';
		echo "<script>window.location = 'login.php';</script>";
		exit();
	}
} 
$userStatus = array(0=>'Not Activated', 1=>'Active', 2=>'De-Active', 3=>'Deleted');
$DeliveryStatus = array(0=>'Order Placed', 1=>'Delivered', 2=>'Rejected', 3=>'Others');
$DeliveryPerson = array(1=>'Active', 2=>'Resigned', 3=>'Others');
$itemStatus = array(1=>'Active', 2=>'De-Active', 3=>'Other');
?>
