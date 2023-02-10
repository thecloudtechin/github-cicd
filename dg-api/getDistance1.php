<?php include 'db.php';
$origin=str_replace(" ","%20",$_GET['origins']);
$destination=str_replace(" ","%20",$_GET['destinations']);
// echo $origin.$destination;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".$origin."&destinations=".$destination."&key=AIzaSyDY2j1NE12MzJYS7t-dVay1lXooOpzxZsY");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
// echo  $output;
$obj = json_decode($output);
// echo $obj->status;
// title attribute
// echo $obj->rows[0]->elements[0]->status;
if($obj->rows[0]->elements[0]->status == "OK")
{
//   echo $obj->rows[0]->elements[0]->distance->text;
   
   $value =str_replace(" mi","",$obj->rows[0]->elements[0]->distance->text);
//   echo  $value;
   $sql = "SELECT * FROM `delivery_charges` WHERE hotel_id = '".$_GET['hotel_id']."'";
   $result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
      
      if($value > 0 && $value <=1)
      {
          echo $row["one"];
      }
      else if($value > 1 && $value <=2)
      {
          echo $row["two"];
      }
      else if($value > 2 && $value <=3)
      {
          echo $row["three"];
      }
      else if($value > 3 && $value <=4)
      {
          echo $row["four"];
      }
      else if($value > 4 && $value <=5)
      {
          echo $row["five"];
      }
      else if($value > 5 && $value <=6)
      {
          echo $row["six"];
      }
       else if($value > 6 && $value <=7)
      {
          echo $row["seven"];
      }
       else 
      {
          echo $value;
      }
      
    
  }
} else {
    // echo  $obj->rows[0]->elements[0]->distance->text;
    
    if(str_replace(" mi","",$obj->rows[0]->elements[0]->distance->text) == "1 ft")
    {
        echo "1.5";
    }
    else
    {
         echo  str_replace(" mi","",$obj->rows[0]->elements[0]->distance->text);
    }
 
  
}
$conn->close();
   
   
}
else
{
    echo "undefined";
}




// echo $obj['rows'][0]['element'][0]['status'];


?>