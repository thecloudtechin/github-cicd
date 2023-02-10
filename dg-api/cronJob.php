<?php 
date_default_timezone_set('Europe/London');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'db.php';
$from="ordery@deliveryguru.org.uk";
$from_name="DeliveryGuru";
//SMTP mail Config username and password		
$account="order@deliveryguru.co.uk";
$password="Glasgow2019";

include("phpmailer/class.phpmailer.php");
$mail = new PHPMailer();
$mail->IsSMTP();
//$mail->SMTPDebug = 3;
$mail->CharSet = 'UTF-8';
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth= true;
$mail->Port = 465; // Or 587
$mail->isHTML(true);
$mail->Username= $account;
$mail->Password= $password;
$mail->SMTPSecure = 'ssl';
$reply="order@deliveryguru.co.uk";
$replyname="Restaurant order placed";
$subject = "Your order placed!";

$result = mysqli_query($conn,"select orders.*,restaurants.hotel_name AS res_name,orders.status AS o_sta,restaurants.*,orders.discount as orderdiscount,orders.delivery_charges as ordersdelivery_charges from orders
Inner join restaurants on restaurants.id = orders.hotel_id where sync = 0 AND orders.created_at >= CURDATE() AND orders.status IN (2,12,7) "); 

if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
      
 $order_type_msg='';
      $id = $row["id"];
      $order_no = $row["order_no"];
       $delivery_type = $row["delivery_type"];
       $order_type = $row["o_sta"];
       $res_name = $row["res_name"];
       
       
       
          	if($order_type == '12' || $order_type == 12){
		$order_type_msg="Pre-Order will be delivered on date : " .$row["day"] . " & time :" .$row["time"] ;
	}
	else {
		$order_type_msg="";
	}
       
              	
    $address="";   
      	if($delivery_type == '0'){
      	    
		$delivery_type="Delivery";
		$query = mysqli_query($conn,"SELECT home_address FROM `addresses` WHERE id = ". $row['user_address_id']);

  if($row23 = mysqli_fetch_array($query, MYSQLI_ASSOC)){
      $address =   "Deliver to this address : "  . $row23['home_address']; 
  }

	}
	else {
		$delivery_type="Collection";
	}
	


$hotel_name=$row['hotel_name'];
$delivery_type=$row["delivery_type"];
$payment_type=$row["payment_type"];
	if($delivery_type == '0'){
		$delvierymode="Delivery";
		$Minutes = 45;
		$imgurl="http://grill-guru.co.uk/img/bike.gif";
		$outxt="Your Order will Reach you";
	}
	else {
		$delvierymode="Collection";
		$Minutes = 15;
		$imgurl="https://deliveryguru.co.uk/img/cooking.gif";
		$outxt="Your Order will Be Ready";
	}
$date = new DateTime("now", new DateTimeZone('Europe/London') );
$ndate=$date->format('H:i:s');
$Totime =date("h:i:s", strtotime($ndate)+($Minutes*60));
if($payment_type=='COD'){
    $paytxt="NOT PAID";
}
else{
    $paytxt="PAID";
}
$adminfee="0.50";
$totalpay=$row['amount']-$row['orderdiscount'];


$msg='<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#f5f5f5">
    <tbody>

       <tr>
          <td align="center">
             <table cellpadding="0" cellspacing="0" border="0" width="640" style="max-width:640px;width:100%">
                <tbody>
                   <tr>
                      <td align="center" style="font-size:0">
                         <table cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color:#ffffff">
                            <tbody>
                               <tr>
                                  <td>
                                     <div style="display:none!important">
                                        <input type="radio" style="display:none" checked="">
                                     </div>
                                     <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                        <tbody>
                                           <tr>
                                              <td>
                                                 <div>
                                                    <div>
                                                       <div>
                                                          <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                             <tbody>

                                                                <tr>
                                                                   <td bgcolor="#f5f5f5" align="center" style="padding-top:25px;padding-bottom:20px">
                                                                      <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                         <tbody>
                                                                            <tr>
                                                                               <td align="center">
                                                                                  <img src="http://deliveryguru.co.uk/images/Deliverygurulogo.png" style="width:150px;">
                                                                               </td>
                                                                            </tr>
                                                                         </tbody>
                                                                      </table>
                                                                   </td>
                                                                </tr>
                                                             </tbody>
                                                          </table>
                                                       </div>
                                                       <div>
                                                          <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                             <tbody>
                                                                <tr>
                                                                   <td valign="top">
                                                                      <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                         <tbody>
                                                                            <tr>
                                                                               <td style="padding-bottom:20px" bgcolor="#f5f5f5">
                                                                                  <table cellpadding="0" cellspacing="0" border="0" width="100%" bgcolor="#ffffff">
                                                                                     <tbody>
                                                                                        <tr>
                                                                                           <td align="left" style="padding-right:20px;padding-bottom:50px;padding-left:20px;padding-top:50px">
                                                                                              <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                 <tbody>
                                                                                                    <tr>
                                                                                                       <td align="center" style="padding-bottom:20px">
                                                                                                          <img src="'.$imgurl.'" style="width:450px;">
                                                                                                       </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                       <td align="center">
                                                                                                          <div style="max-width:455px;width:100%">
                                                                                                             <table cellpadding="0" cellspacing="0" width="100%" bgcolor="#ffffff">
                                                                                                                <tbody>';
                                                                                                                
                                                                                                               
                                                                                                                if($order_type_msg != "")
                                                                                                                {
                                                                                                                     $msg.=  '<tr>
                                                                                                                      <td align="center" style="font-family:Poppins,arial;font-size:28px;color: #ff6308cc;font-weight:600;line-height:32px;margin:10px">'.$order_type_msg.' </td>
                                                                                                                   </tr><tr>
                                                                                                                      <td align="center" style="font-family:Poppins,arial;font-size:8px;color: #ff6308cc;font-weight:600;line-height:2px;margin:10px"> </td>
                                                                                                                   </tr>';
                                                                                                                }
                                                                                                                else
                                                                                                                {
                                                                                                                     $msg.=  ' <tr>
                                                                                                                      <td align="center" style="font-family:Poppins,arial;font-size:64px;color: #143a0d;font-weight:600;line-height:70px;padding: 11px;">'.$outxt.'</td>
                                                                                                                   </tr>
                                                                                                                   <tr>
                                                                                                                      <td align="center" style="font-family:Poppins,arial;font-size:64px;color: #143a0d;font-weight:600;line-height:70px;padding: 11px;">'.$Totime.'</td>
                                                                                                                   </tr>';
                                                                                                                }
                                                                                                                
                                                                                                                
                                                                                                                
                                                                                                                
                                                                                                                   
                                                                                                                   
                                                                                                                  
                                                                                                                   
                                                                                                                   
                                                                                                                  $msg.= '<tr>
                                                                                                                      <td align="center" style="font-family:Poppins,arial;font-size:16px;color: #ff6308cc;font-weight:300;line-height:22px;padding-bottom:20px">'.$hotel_name.' have received your order. Get ready for Fresh. Fast. Tasty!<br><br><strong>Your order number is:</strong></td>
                                                                                                                   </tr>
                                                                                                                   <tr>
                                                                                                                      <td align="center">
                                                                                                                         <table cellpadding="0" cellspacing="0" width="280">
                                                                                                                            <tbody>
                                                                                                                               <tr>
                                                                                                                                  <td align="center">
                                                                                                                                     <div style="">
                                                                                                                                        <table cellpadding="0" cellspacing="0" width="100%" bgcolor="#ffffff">
                                                                                                                                           <tbody>
                                                                                                                                              <tr>

                                                                                                                                                 <td align="center" style="background: #ff6308cc;border: 1px solid #ff6308cc;color: #fff;font-family: Poppins,arial;font-size: 40px;font-weight: 600;padding-bottom: 5px;padding-top: 5px;letter-spacing: 2px;height: 65px;">
                                                                                                                                                 <a style="color: #000;font-size: 23px;">'.$order_no.'</a></td>
                                                                                                                                              </tr>
                                                                                                                                           </tbody>
                                                                                                                                        </table>
                                                                                                                                     </div>
                                                                                                                                  </td>
                                                                                                                               </tr>
                                                                                                                            </tbody>
                                                                                                                         </table>
                                                                                                                      </td>
                                                                                                                   </tr>
                                                                                                                </tbody>
                                                                                                             </table>
                                                                                                          </div>
                                                                                                       </td>
                                                                                                    </tr>
                                                                                                 </tbody>
                                                                                              </table>
                                                                                           </td>
                                                                                        </tr>
                                                                                     </tbody>
                                                                                  </table>
                                                                               </td>
                                                                            </tr>
                                                                            <tr>
                                                                               <td style="padding-bottom:20px" bgcolor="#f5f5f5">
                                                                                  <table cellpadding="0" cellspacing="0" border="0" width="100%" bgcolor="#ffffff">
                                                                                     <tbody>
                                                                                        <tr>
                                                                                           <td align="left" style="padding-right:20px;padding-left:20px;padding-top:50px;padding-bottom:20px">
                                                                                              <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                 <tbody>
                                                                                                    <tr>
                                                                                                       <td align="center" colspan="2">
                                                                                                          <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                             <tbody>
                                                                                                                <tr>
                                                                                                                   <td align="center" style="font-family:Poppins,arial;font-size:28px;color: #ff6308cc;font-weight:600;line-height:32px;padding-bottom:20px">ORDER DETAILS</td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                 <td align="center" style="font-family:Poppins,arial;font-size:22px;color:#53565a;font-weight:300;line-height:22px;padding-bottom:20px"> '.$hotel_name.' </td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                   <td align="center" style="font-family:Poppins,arial;font-size:16px;color:#53565a;font-weight:300;line-height:22px;padding-bottom:20px">'.$row['address'].'</td>
                                                                                                                </tr>
                                                                                                             </tbody>
                                                                                                          </table>
                                                                                                       </td>
                                                                                                    </tr>
                                                                                                 </tbody>
                                                                                              </table>
                                                                                           </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                           <td align="left" style="border-top:1px solid #e3e3e3;border-bottom:1px solid #e3e3e3">
                                                                                              <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                 <tbody>
                                                                                                    <tr>
                                                                                                       <td align="center" style="padding-right:20px;padding-left:20px">
                                                                                                          <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                             <tbody>
                                                                                                                <tr>
                                                                                                                   <td width="40" align="left" valign="top">
                                                                                                                      <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                                         <tbody>
                                                                                                                            <tr>
                                                                                                                               <td align="left" valign="top" style="font-family:Poppins,arial;font-size:16px;color:#53565a;font-weight:300;line-height:22px;padding-top:15px;padding-bottom:15px">
                                                                                                                                  <img src="http://grill-guru.co.uk/img/money.png"  alt="Location" style="width: 27px;height: 27px;">
                                                                                                                               </td>
                                                                                                                            </tr>
                                                                                                                         </tbody>
                                                                                                                      </table>
                                                                                                                   </td>
                                                                                                                   <td align="left" valign="top">
                                                                                                                      <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                                         <tbody>
                                                                                                                            <tr>
                                                                                                                               <td align="left" style="font-family:Poppins,arial;font-size:16px;color:#53565a;font-weight:600;line-height:22px;padding-top:15px;padding-bottom:5px">Payment : '.$paytxt.' </td>
                                                                                                                            </tr>
                                                                                                                         </tbody>
                                                                                                                      </table>
                                                                                                                   </td>
                                                                                                                </tr>
                                                                                                             </tbody>
                                                                                                          </table>
                                                                                                       </td>
                                                                                                    </tr>
                                                                                                 </tbody>
                                                                                              </table>
                                                                                           </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                           <td align="left" style="border-top:1px solid #e3e3e3;border-bottom:1px solid #e3e3e3">
                                                                                              <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                 <tbody>
                                                                                                    <tr>
                                                                                                       <td align="center" style="padding-right:20px;padding-left:20px">
                                                                                                          <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                             <tbody>
                                                                                                                <tr>
                                                                                                                   <td width="40" align="left" valign="top">
                                                                                                                      <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                                         <tbody>
                                                                                                                            <tr>
                                                                                                                               <td align="left" valign="top" style="font-family:Poppins,arial;font-size:16px;color:#53565a;font-weight:300;line-height:22px;padding-top:15px;padding-bottom:15px">
                                                                                                                                  <img src="http://grill-guru.co.uk/img/fooddv.png"  alt="Location" style="width: 27px;height: 27px;">
                                                                                                                               </td>
                                                                                                                            </tr>
                                                                                                                         </tbody>
                                                                                                                      </table>
                                                                                                                   </td>
                                                                                                                   <td align="left" valign="top">
                                                                                                                      <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                                         <tbody>
                                                                                                                            <tr>
                                                                                                                               <td align="left" style="font-family:Poppins,arial;font-size:16px;color:#53565a;font-weight:600;line-height:22px;padding-top:15px;padding-bottom:5px">Order Type : '.$delvierymode.' </td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                               <td align="left" style="font-family:Poppins,arial;font-size:16px;color:#53565a;font-weight:600;line-height:22px;padding-top:15px;padding-bottom:5px">  '.$address.' </td>
                                                                                                                            </tr>
                                                                                                                         </tbody>
                                                                                                                      </table>
                                                                                                                   </td>
                                                                                                                </tr>
                                                                                                             </tbody>
                                                                                                          </table>
                                                                                                       </td>
                                                                                                    </tr>
                                                                                                 </tbody>
                                                                                              </table>
                                                                                           </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                           <td align="left" style="border-top:1px solid #e3e3e3;border-bottom:1px solid #e3e3e3">
                                                                                              <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                 <tbody>
                                                                                                    <tr>
                                                                                                       <td align="center" style="padding-right:20px;padding-left:20px">
                                                                                                          <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                             <tbody>
                                                                                                                <tr>
                                                                                                                   <td width="40" align="left" valign="top">
                                                                                                                      <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                                         <tbody>
                                                                                                                            <tr>
                                                                                                                               <td align="left" valign="top" style="font-family:Poppins,arial;font-size:16px;color:#53565a;font-weight:300;line-height:22px;padding-top:15px;padding-bottom:15px">
                                                                                                                                  <img src="http://grill-guru.co.uk/img/userdet.png"  alt="Location" style="width: 30px;height: 30px;">
                                                                                                                               </td>
                                                                                                                            </tr>
                                                                                                                         </tbody>
                                                                                                                      </table>
                                                                                                                   </td>
                                                                                                                   <td align="left" valign="top">
                                                                                                                      <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                                         <tbody>
                                                                                                                            <tr>
                                                                                                                               <td align="left" style="font-family:Poppins,arial;font-size:16px;color:#53565a;font-weight:600;line-height:22px;padding-top:15px;padding-bottom:5px">'.htmlspecialchars($row['name']).'</td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                               <td align="left" style="font-family:Poppins,arial;font-size:16px;color:#53565a;font-weight:300;line-height:22px;padding-bottom:15px">Mobile : '.$row['number'].', Email: '.$row['email'].' </td>
                                                                                                                            </tr>
                                                                                                                            
                                                                                                                         </tbody>
                                                                                                                      </table>
                                                                                                                   </td>
                                                                                                                </tr>
                                                                                                             </tbody>
                                                                                                          </table>
                                                                                                       </td>
                                                                                                    </tr>
                                                                                                 </tbody>
                                                                                              </table>
                                                                                           </td>
                                                                                        </tr>
                                                                                   
                                                                                        <tr>
                                                                                           <td align="left" style="border-bottom:1px solid #e3e3e3;">
                                                                                              <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                 <tbody>';
                                                                                                    $result1 = mysqli_query($conn,"select * from order_items inner join sub_categories on order_items.item_id = sub_categories.id where order_items.order_no='$order_no'"); 
                                                                                                    if (mysqli_num_rows($result1) > 0) {
                                                                                                    while($row1 = mysqli_fetch_assoc($result1)) {
      
                                                                                                    $msg.='<tr>
                                                                                                        <td width="75%" align="left">
                                                                                                           <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                              <tbody>
                                                                                                                 <tr>
                                                                                                                    <td align="left" valign="top" width="40" style="font-family:Poppins,arial;font-size:16px;color:#53565a;font-weight:600;line-height:22px;padding-top:15px;padding-bottom:15px">&nbsp;&nbsp;&nbsp;'.$row1['qty'].'&nbsp;&nbsp;</td>
                                                                                                                    <td align="left" style="font-family:Poppins,arial;font-size:16px;color:#53565a;font-weight:600;line-height:22px;padding-top:15px;padding-bottom:15px">'.$row1['item_name'].'</td>
                                                                                                                 </tr>
                                                                                                              </tbody>
                                                                                                           </table>
                                                                                                        </td>
                                                                                                        <td width="25%" align="right" valign="top">';
                                                                                                        
                                                                                                        if($row1['offer_cat'] != 0 || $row1['offer_cat'] != "0")
                                                                                                        {
                                                                                                          $msg.='<table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                              <tbody>
                                                                                                                 <tr>
                                                                                                                    <td align="right" style="font-family:Poppins,arial;font-size:16px;color:#53565a;font-weight:600;line-height:22px;padding-top:15px;padding-bottom:15px">&#163;  '.$row1['amount'].' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                                                                                 </tr>
                                                                                                              </tbody>
                                                                                                           </table>';  
                                                                                                        }
                                                                                                        else
                                                                                                        {
                                                                                                            
                                                                                                            $msg.='<table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                              <tbody>
                                                                                                                 <tr>
                                                                                                                    <td align="right" style="font-family:Poppins,arial;font-size:16px;color:#53565a;font-weight:600;line-height:22px;padding-top:15px;padding-bottom:15px">&#163;  '.$row1['amount']*$row1['qty'].' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                                                                                 </tr>
                                                                                                              </tbody>
                                                                                                           </table>';
                                                                                                        }
                                                                                                        
                                                                                                           
                                                                                                           
                                                                                                           
                                                                                                           
                                                                                                        $msg.='</td>';
                                                                                                   
                                                                                                     if($row1['notes']!=""){
                                                                                                      
                                                                                                      $msg.='<tr>
                                                                                                        <td width="75%" align="left">
                                                                                                           <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                              <tbody>
                                                                                                                 <tr>
                                                                                                                    <td align="left" valign="top" width="40" style="font-family:Poppins,arial;font-size:16px;color:#53565a;font-weight:600;line-height:22px;padding-top:15px;padding-bottom:15px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Note :  &nbsp;'.$row1['notes'].'</td>
                                                                                                                    </tr>
                                                                                                              </tbody>
                                                                                                           </table>
                                                                                                        </td>
                                                                                                        
                                                                                                     </tr>';
                                                                                                     }
                                                                                                   
                                                                                                  
                                                                                                  $rowextraFor = $row1['extraFor'];
                                                                                                    $result2 = mysqli_query($conn,"select extras.*,addon_items.* from extras Inner join addon_items on addon_items.id = extras.add_on_id where order_no ='$order_no'"); 
                                                                                                    // echo "select * from extras where order_no ='$order_no' and for = '$rowextraFor'";

                                                                                                if (mysqli_num_rows($result2) > 0) {
                                                                                                while($row2 = mysqli_fetch_assoc($result2)) {
                                                                                                    if($row2['for']==$row1['extraFor']){
                                                                                                  
                                                                                                    $msg.='<tr>
                                                                                                        <td width="75%" align="left">
                                                                                                           <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                              <tbody>
                                                                                                                 <tr>
                                                                                                                    <td align="left" valign="top" width="40" style="font-family:Poppins,arial;font-size:16px;color:#53565a;font-weight:600;line-height:22px;padding-top:15px;padding-bottom:15px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                                                                                    <td align="left" style="font-family:Poppins,arial;font-size:16px;color:#53565a;font-weight:600;line-height:22px;padding-top:15px;padding-bottom:15px">'.$row2['addon_name']. ' X ' .$row2['qty'].'</td>
                                                                                                                 </tr>
                                                                                                              </tbody>
                                                                                                           </table>
                                                                                                        </td>
                                                                                                        <td width="25%" align="right" valign="top">';
                                                                                                        
                                                                                                        
                                                                                                        if($row1['comment'] == "   add-on price including")
                                                                                                        {
                                                                                                             $msg.='<table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                              <tbody>
                                                                                                                 <tr>
                                                                                                                    <td align="right" style="font-family:Poppins,arial;font-size:16px;color:#53565a;font-weight:600;line-height:22px;padding-top:15px;padding-bottom:15px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                                                                                 </tr>
                                                                                                              </tbody>
                                                                                                           </table>';
                                                                                                        }
                                                                                                        else
                                                                                                        {
                                                                                                             $msg.='<table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                              <tbody>
                                                                                                                 <tr>
                                                                                                                    <td align="right" style="font-family:Poppins,arial;font-size:16px;color:#53565a;font-weight:600;line-height:22px;padding-top:15px;padding-bottom:15px">&#163;'.$row2['amount'] * $row2['qty'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                                                                                 </tr>
                                                                                                              </tbody>
                                                                                                           </table>';
                                                                                                        }
                                                                                                           
                                                                                                        
                                                                                                        
                                                                                                        
                                                                                                        
                                                                                                        
                                                                                                           
                                                                                                           
                                                                                                           
                                                                                                        $msg.='</td>
                                                                                                     </tr>';
                                                                                                     
                                                                                                    }
                                                                                                      }
                                                                                                    }
       
                                                                                                     }
                                                                                                    }
                                                                                                          

                                                                                                 $msg.='</tbody>
                                                                                              </table>
                                                                                           </td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                           <td align="left" bgcolor="#8dbc23" style="border-bottom:1px solid #c4dd90;padding-bottom:10px;background-color: #ff6308cc;">
                                                                                              <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                 <tbody>
                                                                                                    <tr>
                                                                                                       <td align="center" style="padding-right:25px;padding-left:25px">
                                                                                                          <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                             <tbody>
                                                                                                                
                                                                                                                <tr>
                                                                                                                   <td width="50%" align="left">
                                                                                                                      <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                                         <tbody>
                                                                                                                            <tr>
                                                                                                                               <td align="left" style="font-family:Poppins,arial;font-size:16px;color:#ffffff;font-weight:600;line-height:22px;padding-top:5px;padding-bottom:5px">Delivery charge:</td>
                                                                                                                            </tr>
                                                                                                                         </tbody>
                                                                                                                      </table>
                                                                                                                   </td>
                                                                                                                   <td width="50%" align="right">
                                                                                                                      <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                                         <tbody>
                                                                                                                            <tr>
                                                                                                                               <td align="right" style="font-family:Poppins,arial;font-size:16px;color:#ffffff;font-weight:600;line-height:22px;padding-top:5px;padding-bottom:5px">&#163; '.$row['ordersdelivery_charges'].'</td>
                                                                                                                            </tr>
                                                                                                                         </tbody>
                                                                                                                      </table>
                                                                                                                   </td>
                                                                                                                </tr>
                                                                                                           
                                                                                                                <tr>
                                                                                                                   <td width="50%" align="left">
                                                                                                                      <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                                         <tbody>
                                                                                                                            <tr>
                                                                                                                               <td align="left" style="font-family:Poppins,arial;font-size:16px;color:#ffffff;font-weight:600;line-height:22px;padding-top:5px;padding-bottom:5px">Discount:</td>
                                                                                                                            </tr>
                                                                                                                         </tbody>
                                                                                                                      </table>
                                                                                                                   </td>
                                                                                                                   <td width="50%" align="right">
                                                                                                                      <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                                         <tbody>
                                                                                                                            <tr>
                                                                                                                               <td align="right" style="font-family:Poppins,arial;font-size:16px;color:#ffffff;font-weight:600;line-height:22px;padding-top:5px;padding-bottom:5px">-&#163;'.$row['orderdiscount'].'</td>
                                                                                                                            </tr>
                                                                                                                         </tbody>
                                                                                                                      </table>
                                                                                                                   </td>
                                                                                                                </tr>
                                                                                                                 <tr>
                                                                                                                   <td width="50%" align="left">
                                                                                                                      <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                                         <tbody>
                                                                                                                            <tr>
                                                                                                                               <td align="left" style="font-family:Poppins,arial;font-size:16px;color:#ffffff;font-weight:600;line-height:22px;padding-top:5px;padding-bottom:5px"> Admin Fee:</td>
                                                                                                                            </tr>
                                                                                                                         </tbody>
                                                                                                                      </table>
                                                                                                                   </td>
                                                                                                                   <td width="50%" align="right">
                                                                                                                      <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                                         <tbody>
                                                                                                                            <tr>
                                                                                                                               <td align="right" style="font-family:Poppins,arial;font-size:16px;color:#ffffff;font-weight:600;line-height:22px;padding-top:5px;padding-bottom:5px">+&#163; '.$adminfee.'</td>
                                                                                                                            </tr>
                                                                                                                         </tbody>
                                                                                                                      </table>
                                                                                                                   </td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                   <td width="50%" align="left">
                                                                                                                      <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                                         <tbody>
                                                                                                                            <tr>
                                                                                                                               <td align="left" style="font-family:Poppins,arial;font-size:16px;color:#ffffff;font-weight:600;line-height:22px;padding-top:5px;padding-bottom:5px">Carry Bag Fee:</td>
                                                                                                                            </tr>
                                                                                                                         </tbody>
                                                                                                                      </table>
                                                                                                                   </td>
                                                                                                                   <td width="50%" align="right">
                                                                                                                      <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                                         <tbody>
                                                                                                                            <tr>
                                                                                                                               <td align="right" style="font-family:Poppins,arial;font-size:16px;color:#ffffff;font-weight:600;line-height:22px;padding-top:5px;padding-bottom:5px">+&#163; 0.05</td>
                                                                                                                            </tr>
                                                                                                                         </tbody>
                                                                                                                      </table>
                                                                                                                   </td>
                                                                                                                </tr>
                                                                                                             </tbody>
                                                                                                          </table>
                                                                                                       </td>
                                                                                                    </tr>
                                                                                                 </tbody>
                                                                                              </table>
                                                                                           </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                           <td align="left" bgcolor="#8dbc23" style="border-bottom:1px solid #c4dd90;background-color: #ff6308cc;">
                                                                                              <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                 <tbody>
                                                                                                    <tr>
                                                                                                       <td align="center" style="padding-right:25px;padding-left:25px;padding-top:30px;padding-bottom:30px">
                                                                                                          <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                             <tbody>
                                                                                                                <tr>
                                                                                                                   <td width="50%" align="left">
                                                                                                                      <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                                         <tbody>
                                                                                                                            <tr>
                                                                                                                               <td align="left" style="font-family:Poppins,arial;font-size:28px;color:#ffffff;font-weight:600;line-height:22px;padding-top:10px;padding-bottom:10px">Total:</td>
                                                                                                                            </tr>
                                                                                                                         </tbody>
                                                                                                                      </table>
                                                                                                                   </td>
                                                                                                                   <td width="50%" align="right">
                                                                                                                      <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                                         <tbody>
                                                                                                                            <tr>
                                                                                                                               <td align="right" style="font-family:Poppins,arial;font-size:28px;color:#ffffff;font-weight:600;line-height:22px;padding-top:10px;padding-bottom:10px">&#163; '.$totalpay.'</td>
                                                                                                                            </tr>
                                                                                                                         </tbody>
                                                                                                                      </table>
                                                                                                                   </td>
                                                                                                                </tr>
                                                                                                             </tbody>
                                                                                                          </table>
                                                                                                       </td>
                                                                                                    </tr>
                                                                                                 </tbody>
                                                                                              </table>
                                                                                           </td>
                                                                                        </tr>
                                                                                     </tbody>
                                                                                  </table>
                                                                               </td>
                                                                            </tr>
                                                                            <tr>
                                                                               <td style="padding-bottom:20px" bgcolor="#f5f5f5">
                                                                                  <table cellpadding="0" cellspacing="0" border="0" width="100%" bgcolor="#ffffff">
                                                                                     <tbody>
                                                                                        <tr>
                                                                                           <td align="left" style="padding-right:20px;padding-bottom:20px;padding-left:20px;padding-top:20px">
                                                                                              <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                 <tbody>
                                                                                                    <tr>
                                                                                                       <td align="left" style="text-align:center;font-size:0;padding-bottom:20px">
                                                                                                          <div style="display:inline-block;width:100%;max-width:160px;vertical-align:middle">
                                                                                                             <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                                                                                <tbody>
                                                                                                                   <tr>
                                                                                                                      <td align="left">
                                                                                                                         <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                                                                                            <tbody>
                                                                                                                               <tr>
                                                                                                                                  <td align="center"><img src="http://grill-guru.co.uk/img/clock.png" width="150" height="150" border="0" style="display:block" alt="On Delivery in Time?" ></td>
                                                                                                                               </tr>
                                                                                                                            </tbody>
                                                                                                                         </table>
                                                                                                                      </td>
                                                                                                                   </tr>
                                                                                                                </tbody>
                                                                                                             </table>
                                                                                                          </div>
                                                                                                          <div style="display:inline-block;width:100%;max-width:440px;vertical-align:middle">
                                                                                                             <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                                                                                <tbody>
                                                                                                                   <tr>
                                                                                                                      <td align="center">
                                                                                                                         <table cellspacing="0" cellpadding="0" border="0" width="95%">
                                                                                                                            <tbody>
                                                                                                                               <tr>
                                                                                                                                  <td align="left" style="font-family:Poppins,arial;font-size:28px;color:#e11726;font-weight:600;line-height:32px;padding-bottom:10px">On time?</td>
                                                                                                                               </tr>
                                                                                                                               <tr>
                                                                                                                                  <td align="left" style="font-family:Poppins,arial;font-size:16px;color:#53565a;font-weight:300;line-height:22px">If your orders late or not quite right get some more help <a href="#" style="color:#53565a;text-decoration:none" >03332075555</a>  We will be happy to help.</td>
                                                                                                                               </tr>
                                                                                                                            </tbody>
                                                                                                                         </table>
                                                                                                                      </td>
                                                                                                                   </tr>
                                                                                                                </tbody>
                                                                                                             </table>
                                                                                                          </div>
                                                                                                       </td>
                                                                                                    </tr>
                                                                                                 </tbody>
                                                                                              </table>
                                                                                           </td>
                                                                                        </tr>
                                                                                     </tbody>
                                                                                  </table>
                                                                               </td>
                                                                            </tr>
                                                                            <tr>
                                                                               <td bgcolor="#f5f5f5" style="padding-top:20px;padding-left:20px;padding-right:20px;padding-bottom:80px">
                                                                                  <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                     <tbody>
                                                                                        <tr>
                                                                                           <td align="center" style="padding-bottom:20px"><img src="http://deliveryguru.co.uk/images/Deliverygurulogo.png" alt="DeliveryGuru" width="150"  border="0" style="border-radius:6px"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                           <td align="center" style="font-family:Poppins,sans-serif;font-size:12px;color:#8d8d8d;padding-bottom:20px" colspan="5"><a href="#" target="_blank">deliveryguru&shy;.co&shy;.uk</a></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                           <td align="center" style="font-family:Poppins,sans-serif;font-size:12px;color:#8d8d8d;padding-bottom:20px;line-height:22px" colspan="5">Remember, Deliveryguru will never, ever email you asking for your bank or card details.<br>So, if you do receive something like this, delete it. We advise changing your password regularly too.</td>
                                                                                        </tr>
                                                                                     </tbody>
                                                                                  </table>
                                                                               </td>
                                                                            </tr>
                                                                         </tbody>
                                                                      </table>
                                                                   </td>
                                                                </tr>
                                                             </tbody>
                                                          </table>
                                                       </div>
                                                    </div>
                                                 </div>
                                              </td>
                                           </tr>
                                        </tbody>
                                     </table>
                                  </td>
                               </tr>
                            </tbody>
                         </table>
                      </td>
                   </tr>
                </tbody>
             </table>
          </td>
       </tr>
    </tbody>
 </table>';
$useremail=$row['email'];
$hotelemail=$row['hotel_email'];
//SMS Panel Details
$mail->From = $from;
$mail->FromName= $from_name;
$mail->Subject = $subject;
$mail->Body = $msg;
$mail->addAddress($useremail);
$mail->addAddress($reply);
$mail->AddReplyTo($reply, $replyname);
$mail->AddCC($hotelemail, 'Restaurants');
$mail->AddCC('order@deliveryguru.co.uk', 'Restaurants');
$mailstate='';
if($mail->send()){
echo "mail send";
   $result1 =   mysqli_query($conn,"UPDATE orders SET sync = 1 WHERE order_no = '$order_no'"); 
}
else{
echo "mail fail";
}
      
      
  }
}





?>