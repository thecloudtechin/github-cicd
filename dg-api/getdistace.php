<?php include 'db.php';
$origin=str_replace(" ","%20",$_GET['origins']);
$destination=str_replace(" ","%20",$_GET['destinations']);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".$origin."&destinations=".$destination."&key=AIzaSyDY2j1NE12MzJYS7t-dVay1lXooOpzxZsY");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);

$obj = json_decode($output);

if($obj->rows[0]->elements[0]->status == "OK")
{
//   echo $obj->rows[0]->elements[0]->distance->text;
   
   $value =str_replace(" mi","",$obj->rows[0]->elements[0]->distance->text);
//   echo  $value;
   $sql = "SELECT * FROM `delivery_charges` WHERE hotel_id = '".$_GET['hotel_id']."'";
//   echo $sql;
   $result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
      
      if($value > 0 && $value <=1)
      {
          echo number_format($row["one"], 2);
      }
      else if($value > 1 && $value <=2)
      {
          echo  number_format($row["two"], 2);
      }
      else if($value > 2 && $value <=3)
      {
          echo  number_format($row["three"], 2);
      }
      else if($value > 3 && $value <=4)
      {
          echo number_format($row["four"], 2);
      }
      else if($value > 4 && $value <=5)
      {
          echo number_format($row["five"], 2);
      }
      else if($value > 5 && $value <=6)
      {
          echo number_format($row["six"], 2);
      }
       else if($value > 6 && $value <=7)
      {
          echo number_format($row["seven"], 2);
      }
       else 
      {
          echo number_format($value, 2);
      }
      
    
  }
} else {
    // 
    
    if(str_replace(" mi","",$obj->rows[0]->elements[0]->distance->text) == "1 ft")
    {
        echo number_format("1.5", 2);
    }
    else
    {
       echo  number_format(str_replace(" mi","",$obj->rows[0]->elements[0]->distance->text), 2);
        
    }
 
  
}
$conn->close();
   
   
}
else
{
    echo "3.50";
}




// echo $obj['rows'][0]['element'][0]['status'];


?>