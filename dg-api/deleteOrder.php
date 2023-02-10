<?php   

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'db.php';

$result = mysqli_query($conn,"SELECT * FROM `orders` WHERE user_id IN (55,42,16,24,44,909,179,2) ORDER BY `id` DESC "); 




if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
     
      $order_no = $row['order_no'];
    $a =   mysqli_query($conn,"DELETE FROM `order_items` WHERE order_no = '$order_no'");
     $b =  mysqli_query($conn,"DELETE FROM `extras` WHERE order_no = '$order_no'");
     mysqli_query($conn,"DELETE FROM `orders` WHERE order_no = '$order_no'");
  }
}









?>