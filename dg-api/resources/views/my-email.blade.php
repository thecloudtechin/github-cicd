<?php 
	if($delivery_type == '0'){
		$delvierymode="Delivery";
		$Minutes = 45;
		$imgurl="http://grill-guru.co.uk/img/bike.gif";
		$outxt="Your Order will Reach you";
	}
	else {
		$delvierymode="Collection";
		$Minutes = 15;
		$imgurl="http://mrbasraiedinburgh.co.uk/old/img/cooking.gif";
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
$adminfee="0.00";
?>

<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#f5f5f5">
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
                                                                                                          <img src="<?php echo $imgurl;?>" style="width:450px;">
                                                                                                       </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                       <td align="center">
                                                                                                          <div style="max-width:455px;width:100%">
                                                                                                             <table cellpadding="0" cellspacing="0" width="100%" bgcolor="#ffffff">
                                                                                                                <tbody>
                                                                                                                   <tr>
                                                                                                                      <td align="center" style="font-family:Poppins,arial;font-size:28px;color: #ff6308cc;font-weight:600;line-height:32px"><?php echo $outxt; ?>@</td>
                                                                                                                   </tr>
                                                                                                                   <tr>
                                                                                                                      <td align="center" style="font-family:Poppins,arial;font-size:64px;color: #143a0d;font-weight:600;line-height:70px;padding: 11px;"><?php echo $Totime; ?></td>
                                                                                                                   </tr>
                                                                                                                   <tr>
                                                                                                                      <td align="center" style="font-family:Poppins,arial;font-size:16px;color: #ff6308cc;font-weight:300;line-height:22px;padding-bottom:20px"><?php echo $hotel_name; ?> have received your order. Get ready for Fresh. Fast. Tasty!<br><br><strong>Your order number is:</strong></td>
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
                                                                                                                                                 <a style="color: #fff;font-size: 23px;"><?php echo $order_no?></a></td>
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
                                                                                                                   <td align="center" style="padding-bottom:20px"><img src="https://deliveryguru.co.uk/images/hotelogo/<?php echo $logo . ".png";?>" alt="<?php echo $hotel_name;?>"  width="150"  border="0" style="border-radius:6px"></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                   <td align="center" style="font-family:Poppins,arial;font-size:16px;color:#53565a;font-weight:300;line-height:22px;padding-bottom:20px"><?php echo $hotel_add?></td>
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
                                                                                                                               <td align="left" style="font-family:Poppins,arial;font-size:16px;color:#53565a;font-weight:600;line-height:22px;padding-top:15px;padding-bottom:5px">Payment : <?php echo $paytxt;?> </td>
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
                                                                                                                               <td align="left" style="font-family:Poppins,arial;font-size:16px;color:#53565a;font-weight:600;line-height:22px;padding-top:15px;padding-bottom:5px">Order Type : <?php echo $delvierymode;?> </td>
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
                                                                                                                               <td align="left" style="font-family:Poppins,arial;font-size:16px;color:#53565a;font-weight:600;line-height:22px;padding-top:15px;padding-bottom:5px"><?php echo $user_name?></td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                               <td align="left" style="font-family:Poppins,arial;font-size:16px;color:#53565a;font-weight:300;line-height:22px;padding-bottom:15px">Mobile : <?php echo $user_mob?>, Email: <?php echo $user_email?> </td>
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
                                                                                        <?php if($delivery_type== '0'){?>
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
                                                                                                                                  <img src="http://grill-guru.co.uk/img/mappin.png"  alt="Location" style="width: 27px;height: 27px;">
                                                                                                                               </td>
                                                                                                                            </tr>
                                                                                                                         </tbody>
                                                                                                                      </table>
                                                                                                                   </td>
                                                                                                                   <td align="left" valign="top">
                                                                                                                      <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                                         <tbody>
                                                                                                                            <tr>
                                                                                                                               <td align="left" style="font-family:Poppins,arial;font-size:16px;color:#53565a;font-weight:600;line-height:22px;padding-top:15px;padding-bottom:5px">Delivering to</td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                               <td align="left" style="font-family:Poppins,arial;font-size:16px;color:#53565a;font-weight:300;line-height:22px;padding-bottom:15px"><?php echo $user_add?></td>
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
                                                                                        <?php } ?>
                                                                                        <tr>
                                                                                           <td align="left" style="border-bottom:1px solid #e3e3e3;">
                                                                                              <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                 <tbody>


                                                                                                    <?php $length = count($items);
                                                                                                  for ($i = 0; $i < $length; $i++) {?>
                                                                                                    <tr>
                                                                                                        <td width="75%" align="left">
                                                                                                           <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                              <tbody>
                                                                                                                 <tr>
                                                                                                                    <td align="left" valign="top" width="40" style="font-family:Poppins,arial;font-size:16px;color:#53565a;font-weight:600;line-height:22px;padding-top:15px;padding-bottom:15px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo $items[$i]['qty']; ?></td>
                                                                                                                    <td align="left" style="font-family:Poppins,arial;font-size:16px;color:#53565a;font-weight:600;line-height:22px;padding-top:15px;padding-bottom:15px"><?php  $user = DB::table('sub_categories')->where('id',$items[$i]['item_id'])->select('item_name')->pluck('item_name');  echo  str_replace('"',"",str_replace('[',"",str_replace(']',"",$user)))?></td>
                                                                                                                 </tr>
                                                                                                              </tbody>
                                                                                                           </table>
                                                                                                        </td>
                                                                                                        <td width="25%" align="right" valign="top">
                                                                                                           <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                              <tbody>
                                                                                                                 <tr>
                                                                                                                    <td align="right" style="font-family:Poppins,arial;font-size:16px;color:#53565a;font-weight:600;line-height:22px;padding-top:15px;padding-bottom:15px">&#163;<?php echo $items[$i]['amount'] *  $items[$i]['qty'] ;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                                                                                 </tr>
                                                                                                              </tbody>
                                                                                                           </table>
                                                                                                        </td>
                                                                                                     </tr>
                                                                                                     <?php
                                                                                                     if($items[$i]['notes']!=""){
                                                                                                        ?>
                                                                                                      <tr>
                                                                                                        <td width="75%" align="left">
                                                                                                           <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                              <tbody>
                                                                                                                 <tr>
                                                                                                                    <td align="left" valign="top" width="40" style="font-family:Poppins,arial;font-size:16px;color:#53565a;font-weight:600;line-height:22px;padding-top:15px;padding-bottom:15px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Note :  &nbsp;<?php  echo $items[$i]['notes']; ?></td>
                                                                                                                    </tr>
                                                                                                              </tbody>
                                                                                                           </table>
                                                                                                        </td>
                                                                                                        
                                                                                                     </tr>
                                                                                                     
                                                                                                     <?php
                                                                                                  }
                                                                                                     
                                                                                                  if (is_array($extra) ) { $length1 = count($extra); for ($j = 0; $j < $length1; $j++) {
                                                                                                  if($extra[$j]['item_id'] == $items[$i]['item_id'] && $extra[$j]['for'] == $items[$i]['extraFor'] && $items[$i]['extraFor'] != null) {?>
                                                                                                    
                                                                                                     <tr>
                                                                                                        <td width="75%" align="left">
                                                                                                           <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                              <tbody>
                                                                                                                 <tr>
                                                                                                                    <td align="left" valign="top" width="40" style="font-family:Poppins,arial;font-size:16px;color:#53565a;font-weight:600;line-height:22px;padding-top:15px;padding-bottom:15px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                                                                                    <td align="left" style="font-family:Poppins,arial;font-size:16px;color:#53565a;font-weight:600;line-height:22px;padding-top:15px;padding-bottom:15px"><?php echo $extra[$j]['qty'];?> X <?php  $user = DB::table('addon_items')->where('id',$extra[$j]['add_on_id'])->select('addon_name')->pluck('addon_name');  echo  str_replace('"',"",str_replace('[',"",str_replace(']',"",$user)))?></td>
                                                                                                                 </tr>
                                                                                                              </tbody>
                                                                                                           </table>
                                                                                                        </td>
                                                                                                        <td width="25%" align="right" valign="top">
                                                                                                           <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                              <tbody>
                                                                                                                 <tr>
                                                                                                                    <td align="right" style="font-family:Poppins,arial;font-size:16px;color:#53565a;font-weight:600;line-height:22px;padding-top:15px;padding-bottom:15px">&#163;<?php echo ($extra[$j]['amount']*$extra[$j]['qty']);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                                                                                 </tr>
                                                                                                              </tbody>
                                                                                                           </table>
                                                                                                        </td>
                                                                                                     </tr>
                                                                                                      <?php  } }?>
                                                                                                    <?php  }?>
                                                                                                     
                                                                                                    <?php  }?>
                                                                                                          

                                                                                                 </tbody>
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
                                                                                                                               <td align="right" style="font-family:Poppins,arial;font-size:16px;color:#ffffff;font-weight:600;line-height:22px;padding-top:5px;padding-bottom:5px">&#163;<?php echo $delivery_charges?></td>
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
                                                                                                                               <td align="left" style="font-family:Poppins,arial;font-size:16px;color:#ffffff;font-weight:600;line-height:22px;padding-top:15px;padding-bottom:5px">Subtotal:</td>
                                                                                                                            </tr>
                                                                                                                         </tbody>
                                                                                                                      </table>
                                                                                                                   </td>
                                                                                                                   <td width="50%" align="right">
                                                                                                                      <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                                                         <tbody>
                                                                                                                            <tr>
                                                                                                                               <td align="right" style="font-family:Poppins,arial;font-size:16px;color:#ffffff;font-weight:600;line-height:22px;padding-top:15px;padding-bottom:5px">&#163;<?php echo $sub_total  - $discount - $delivery_charges?></td>
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
                                                                                                                               <td align="right" style="font-family:Poppins,arial;font-size:16px;color:#ffffff;font-weight:600;line-height:22px;padding-top:5px;padding-bottom:5px">-&#163;<?php echo $discount?></td>
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
                                                                                                                               <td align="right" style="font-family:Poppins,arial;font-size:16px;color:#ffffff;font-weight:600;line-height:22px;padding-top:5px;padding-bottom:5px">+&#163;<?php echo "0.50";?></td>
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
                                                                                                                               <td align="right" style="font-family:Poppins,arial;font-size:16px;color:#ffffff;font-weight:600;line-height:22px;padding-top:5px;padding-bottom:5px">+&#163;<?php echo "0.05";?></td>
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
                                                                                                                               <td align="right" style="font-family:Poppins,arial;font-size:28px;color:#ffffff;font-weight:600;line-height:22px;padding-top:10px;padding-bottom:10px">&#163;<?php echo $sub_total - $discount  ?></td>
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
                                                                                                                                  <td align="left" style="font-family:Poppins,arial;font-size:16px;color:#53565a;font-weight:300;line-height:22px">If your order's late or not quite right get some more help <a href="#" style="color:#53565a;text-decoration:none" >03332075555</a>  We will be happy to help.</td>
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
 </table>
