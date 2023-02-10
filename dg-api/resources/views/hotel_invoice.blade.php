<?php 
$installment_count = $hotel_refid['installment_count'];


$paidby = $hotel_refid['paidby'];
$paidamount = $hotel_refid['paidamount'];
$pendingamount = $hotel_refid['pendingamount'];



$invoice_ref_id = $hotel_refid['invoice_ref_id'];
$pending_amount = floatval($hotel_refid['hotel_details'][0]->device_Cost) - (floatval($hotel_refid['hotel_details'][0]->mininstallment_cost) * floatval($installment_count));

$total_cod_orders = $hotel_refid['total_cod_orders'];
$total_paypal_orders = $hotel_refid['total_paypal_orders'];

$total_amount = $hotel_refid['total_amount'];

$total_cod_amount = $hotel_refid['total_cod_amount'];
$total_paypal_amount = $hotel_refid['total_paypal_amount'];

$total_rejected_orders = $hotel_refid['total_rejected_orders'];
$total_rejected_amount = $hotel_refid['total_rejected_amount'];

$admin_fee = 0.50*($total_paypal_orders + $total_cod_orders);
$payable_amount =  $total_amount - $admin_fee;

$commission_value = $hotel_refid['hotel_details'][0]->commission;
$vat_value = $hotel_refid['hotel_details'][0]->vat;

$commission =  ($payable_amount)*( $commission_value /100);
$vat = ($admin_fee + $commission + $hotel_refid['hotel_details'][0]->mininstallment_cost)*( $vat_value /100);
$after_sales_amount = $commission + $vat +$admin_fee;

$number_of_orders = $hotel_refid['delivery_order_count'] + $hotel_refid['collection_order_count'];

$subtotal = $payable_amount - ($payable_amount - $commission) + $admin_fee + $hotel_refid['hotel_details'][0]->mininstallment_cost; 
$total_inc_VAT = $subtotal + $vat;
$dg_pay = $total_paypal_amount - $total_inc_VAT;



if($paidby == "1" || $paidby == 1)
{
    $dg_pay = floatval($dg_pay) - floatval($pendingamount);
}
else
{
     $dg_pay = floatval($dg_pay) + floatval($pendingamount);
}






$start_date = $hotel_refid['start_date'];
$end_date = $hotel_refid['end_date'];

$values = $hotel_refid['dg_orders'];
// print_r($values);exit;

?>
<table width="600" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
   <tbody>
      <tr>
         <td>
            <table width="600" style="background-color:#F5F5F5;width: 100%;" border="0" cellpadding="0" cellspacing="0">
               <tbody>
                  <tr>
                     <td style="border-bottom:3px solid #fa0029">
                        <table width="600" id="logobg" style="height:65px;background-color: #000;width: 100%;">
                           <tbody>
                              <tr>
                                 <td style="text-align: center;"><img src="http://deliveryguru.org.uk/img/dgmainlogo.png" alt="DG Logo" style="width: 156px;"></td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <table width="600" style="height:155px;background-image:url(images/banner.png);background-color:#ee742b;background-size:cover;width: 100%;">
                           <tbody>
                              <tr>
                                 <td style="height:130px;text-align:center"><span style="font-weight:500;font-size:56px;color:#fff;font-style:bold;font-family:Ubuntu,sans-serif">Your invoice</span> <br><span style="color:#fff;font-size:20px;font-family:Ubuntu,sans-serif"> <?php echo date("d M Y",strtotime($start_date));?> &nbsp; TO &nbsp; <?php echo date("d M Y",strtotime($end_date));?></span></td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td style="padding:20px;font-size:20px;font-family:Ubuntu,sans-serif;font-weight:500;background-color:#fff;color:#333">   <br><span>Partner ID:</span> <span style="color:#ef604a"><?php echo $hotel_refid['hotel_details'][0]->hotel_refid;?></span>   </td>
                  </tr>
                  <tr>
                     <td style="padding:20px;padding-bottom:0;text-align:center;color:#cacaca;font-size:14px"><a href="#summary" style="color:#2771CD;text-decoration:none">Summary</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; <a href="#invoice" style="color:#2771CD;text-decoration:none">Your invoice</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; <a href="#statement" style="color:#2771CD;text-decoration:none">Account statement</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; <a href="#orders" style="color:#2771CD;text-decoration:none">All orders</a>&nbsp;&nbsp;&nbsp;</td>
                  </tr>
                  <tr>
                     <td style="padding:20px">
                        <a name="summary"></a>
                        <table width="560" style="background-color:#fff;padding:20px 20px 0 20px;font-size:12px;color:#535353;width: 100%;" border="0" cellpadding="0" cellspacing="0">
                           <tbody>
                              <tr>
                                 <td style="border-bottom:1px solid #CACACA;margin-bottom:10px;padding-bottom:14px" colspan="2"><span style="color:#333;font-style:bold;font-weight:500;font-size:20px;font-family:Ubuntu,sans-serif">Your summary...</span></td>
                              </tr>
                             
                              <tr style="height:80px">
                                 <td style="padding-left:15px;border-bottom:1px solid #CACACA">Number of orders<br><span style="font-size:34px;color:#ef604a;font-weight:500;font-family:Ubuntu,sans-serif"><?php echo $number_of_orders; ?></span></td>
                                 <td style="border-bottom:1px solid #CACACA"><span style="color:#ef604a;font-weight:600"><?php echo $hotel_refid['delivery_order_count']; ?></span> orders for delivery<br><span style="color:#ef604a;font-weight:600"><?php echo $hotel_refid['collection_order_count']; ?></span> orders for collection</td>
                              </tr>
                              <tr style="height:80px;background-color:#F5F5F5">
                                 <td style="padding-left:15px;border-bottom:1px solid #CACACA">Total sales <br><span style="font-size:32px;color:#ef604a;font-weight:500;font-family:Ubuntu,sans-serif">£<?php echo number_format($total_amount,2); ?></span></td>
                                 <td style="border-bottom:1px solid #CACACA"><span style="color:#ef604a;font-weight:600"></span> card orders totalling <span style="color:#ef604a;font-weight:600">£<?php echo number_format($total_paypal_amount,2); ?></span><br><span style="color:#ef604a;font-weight:600"></span> cash orders totalling <span style="color:#ef604a;font-weight:600">£<?php echo number_format($total_cod_amount,2); ?></span></td>
                              </tr>
                              <tr style="height:80px">
                                 <td style="padding-left:15px" colspan="2">You rejected <span style="color:#ef604a;font-weight:600"><?php echo $total_rejected_orders; ?></span> orders, with a total sales value of    <br><span style="color:#ef604a;font-weight:500;font-size:32px;font-family:Ubuntu,sans-serif">£0.00
                                 <!-- <?php echo $total_rejected_amount; ?> -->
                                 </span></td>
                              </tr>
                               <tr style="height:80px;background-color:#F5F5F5">
                                 <td style="padding-left:15px;border-bottom:1px solid #CACACA">You will receive from Delivery Guru<br><span style="font-size:32px;color:#ef604a;font-weight:500;font-family:Ubuntu,sans-serif">£<?php echo number_format($dg_pay,2); ?></span></td>
                                 <td style="border-bottom:1px solid #CACACA">This will be paid on <span style="color:#ef604a;font-weight:600"><?php echo $end_date; ?></span><br>This will be paid into account ending <span style="color:#ef604a;font-weight:600">xxxxxxxxx</span></td>
                              </tr>
                           </tbody>
                        </table>
                        <p style="PAGE-BREAK-AFTER:always">&nbsp;</p>
                        <a name="invoice"></a>
                        <table width="560" style="background-color:#fff;padding:20px;font-size:12px;width: 100%;" border="0" cellpadding="10" cellspacing="0" id="invoice">
                           <tbody>
                              <tr>
                                 <td style="padding:15px 0 10px 0"><span style="color:#333;font-weight:500;font-size:20px;font-style:bold;font-family:Ubuntu,sans-serif">Your Delivery Guru invoice</span></td>
                                 <td style="text-align:right" colspan="2"><a href="#top" style="color:#535353;text-decoration:none">Back to top</a></td>
                              </tr>
                              <tr>
                                 <td colspan="3">
                                    <hr style="border:none;height:1px;color:#CACACA;background-color:#CACACA">
                                 </td>
                              </tr>
                              <tr style="height:30px">
                                 <td colspan="2"><span style="font-size:14px;font-weight:600">Invoice no. <?php echo sprintf('%06d', $invoice_ref_id); ?></span></td>
                                 <td style="text-align:right;font-size:14px;font-weight:600">DELIVERY GURU<span>&#8203;</span></td>
                              </tr>
                              <tr>
                                 <td style="vertical-align:top"><?php echo $hotel_refid['hotel_details'][0]->hotel_name;?><br><?php echo $hotel_refid['hotel_details'][0]->address; ?><br><?php echo $hotel_refid['hotel_details'][0]->hotel_mob; ?></td>
                                 <td style="vertical-align:top;text-align:right" colspan="2"> THE MAXWELL BUILDING<br>55 NASMYTH AVENUE<br>EAST KILBRIDE<br>G75 0QR<br><br>Tel 03332075555<br><br>VAT No&nbsp;&nbsp;363641691<br><br>Invoice Date: &nbsp;&nbsp; <?php echo date("D d M Y",strtotime($end_date));?><br></td>
                              </tr>
                              <tr style="height:20px">
                                 <td colspan="4">&nbsp;</td>
                              </tr>
                              <tr>
                                 <td style="font-weight:600;font-size:14px"></td>
                                 <td style="text-align:right" colspan="2"></td>
                              </tr>
                              <tr style="height:16px;vertical-align:middle">
                                 <td colspan="3">
                                    <hr style="border:none;height:1px;color:#CACACA;background-color:#CACACA">
                                 </td>
                              </tr>
                              <tr style="height:40px;background-color:#F5F5F5;">
                                 <td style="padding:10px 4px 0px">Admin Fee </td>
                                 <td style="text-align:right;padding-right:4px" colspan="2">£<?php echo number_format($admin_fee,2)?></td>
                              </tr>
                              <tr style="height:40px;background-color:#F5F5F5;">
                                 <td style="padding:10px 4px 0px">Total Orders Value for Commission = Total Sale-Admin fee</td>
                                 <td style="text-align:right;padding-right:4px" colspan="2"> £<?php echo number_format($payable_amount,2)?>&nbsp;</td>
                              </tr>
                              <tr style="height:40px;">
                                 <td style="padding:10px 4px 0px"> <?php echo $hotel_refid['hotel_details'][0]->commission;?>% Commission on total sales of £<?php echo number_format($payable_amount,2)?>&nbsp;</td>
                                 <td style="text-align:right;padding-right:4px" colspan="2">£<?php echo number_format($commission,2)?></td>
                              </tr>
                              
                              <?php      if($hotel_refid['hotel_details'][0]->device_Cost == '0')
                              {
                                  
                              }
                              else
                              { ?>
                              
                                 <tr style="height:40px;">
                                 <td style="padding:10px 4px 0px"> Device Cost is £<?php echo $hotel_refid['hotel_details'][0]->device_Cost;?>, Paid in minimum installment of £10 per week<br>( Balance amount £<?php echo $pending_amount;?>)</td>
                                 <td style="text-align:right;padding-right:4px" colspan="2">£<?php   echo number_format((float)$hotel_refid['hotel_details'][0]->mininstallment_cost, 2, '.', ''); ?> </td>
                              </tr> 
                              <?php }?>
                              
                              
                              
                              
                              <tr style="height:30px">
                                 <td></td>
                                 <td style="padding-top:10px">Subtotal</td>
                                 <td style="padding-top:10px;padding-right:4px;text-align:right">(Commission + adminfee + installment fee) £<?php echo number_format($subtotal,2)?></td>
                              </tr>
                              <tr style="height:30px">
                                 <td></td>
                                 <td style="border-bottom:1px solid #cacaca">VAT(<?php echo $hotel_refid['hotel_details'][0]->vat;?>%)</td>
                                 <td style="padding-right:4px;border-bottom:1px solid #cacaca;text-align:right">£<?php echo number_format($vat,2);?></td>
                              </tr>
                              <tr style="height:30px;font-weight:600">
                                 <td></td>
                                 <td>Total inc. VAT</td>
                                 <td style="text-align:right;padding-right:4px">£<?php echo number_format($total_inc_VAT,2); ?></td>
                              </tr>
                              <tr style="height:16px;vertical-align:middle">
                                 <td colspan="3">
                                    <hr style="border:none;height:1px;color:#CACACA;background-color:#CACACA">
                                 </td>
                              </tr>
                              <tr>
                                 <td style="text-align:center" colspan="3">
                                    <div style="margin:10px 90px;color:#535353">You don’t need to do anything. This is automatically deducted in your Delivery Guru account statement below.</div>
                                 </td>
                              </tr>
                              <tr style="height:16px;vertical-align:middle">
                                 <td colspan="3">
                                    <hr style="border:none;height:1px;color:#CACACA;background-color:#CACACA">
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                        <p style="PAGE-BREAK-AFTER:always">&nbsp;</p>
                        <a name="statement"></a>
                        <table width="560" style="background-color:#fff;padding:20px;font-size:12px;width: 100%;" border="0" cellpadding="0" cellspacing="0">
                           <tbody>
                              <tr>
                                 <td><span style="color:#333;font-weight:500;font-size:20px;font-style:bold;font-family:Ubuntu,sans-serif">Your Delivery Guru account statement</span></td>
                                 <td style="text-align:right"><a href="#top" style="color:#535353;text-decoration:none">Back to top</a></td>
                              </tr>
                              <tr style="height:30px">
                                 <td colspan="2"><span style="font-size:14px;font-weight:600;"> <?php echo date("d M Y",strtotime($start_date));?> &nbsp; TO &nbsp; <?php echo date("d M Y",strtotime($end_date));?></span></td>
                              </tr>
                              <tr>
                                 <td colspan="2">
                                    <hr style="border:none;height:1px;color:#CACACA;background-color:#CACACA">
                                 </td>
                              </tr>
                              <tr>
                                 <td colspan="2">
                                    <table width="100%" style="font-size:12px" border="0" cellpadding="0" cellspacing="0">
                                        
                                        
                                    
                                       
                                       
                                       
                                       <tbody>
                                           
                                           
                                              <tr style="height:40px;">   
                                       <td style="padding:10px 4px 0px">Balance from previous account statement</td> 
                                          <td ></td>
                                       <td style=text-align:right;padding-right:4px align=right>&#163;<?php echo $pendingamount;?></td>
                                       </tr>
                                       
                                       <?php    
                                       if($paidby == "0") { ?>
                                          <tr style="height:40px;background-color:#F5F5F5;">  
                                       <td style="padding:10px 4px 0px">Delivery Guru paid you</td> 
                                          <td ></td>
                                       <td style=text-align:right;padding-right:4px align=right>-&#163;<?php echo $paidamount;?></td>
                                       </tr>
                                          <?php }
                                       else
                                       { ?>
                                          <tr style="height:40px;background-color:#F5F5F5;">  
                                       <td style="padding:10px 4px 0px">You need to pay Delivery Guru</td> 
                                         <td ></td>
                                        
                                       <td style=text-align:right;padding-right:4px align=right>-&#163;<?php echo $pendingamount;?></td>
                                       </tr>
                                          <?php 
                                       }
                                       
                                       
                                       
                                       ?>
                                       
                                       
                                           
                                          <tr style="height:40px;">
                                             <td style="padding:10px 4px 0px">Total sales this period</td>
                                             <td> &nbsp; TO &nbsp; </td>
                                             <td style="text-align:right;padding-right:4px" align="right">£<?php echo number_format($total_amount,2);?></td>
                                          </tr>
                                          <tr style="height:40px;background-color:#F5F5F5;">
                                             <td style="padding:10px 4px 0px">Cash orders collected by you</td>
                                             <td> &nbsp; TO &nbsp; </td>
                                             <td style="text-align:right;padding-right:4px" align="right">-£<?php echo number_format($total_cod_amount,2);?></td>
                                          </tr>
                                          <tr style="height:40px;">
                                             <td style="padding:10px 4px 0px">Delivery Guru invoice (inc VAT)</td>
                                             <td></td>
                                             <td style="text-align:right;padding-right:4px" align="right">-£<?php echo number_format($total_inc_VAT,2);?></td>
                                          </tr>
                                          <tr style="height:32px">
                                             <td style="padding:10px 4px 0px;font-weight:600;border-top:1px solid #cacaca">Your account balance</td>
                                             <td style="border-top:1px solid #cacaca"></td>
                                             <td style="text-align:right;font-weight:600;padding-right:4px;border-top:1px solid #cacaca" align="right">£<?php echo number_format($dg_pay,2);?></td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>
                              <tr style="height:16px;vertical-align:middle">
                                 <td colspan="3">
                                    <hr style="border:none;height:1px;color:#CACACA;background-color:#CACACA">
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                        <p style="PAGE-BREAK-AFTER:always">&nbsp;</p>
                        <a name="orders"></a>
                        <table width="560" style="background-color:#fff;padding:20px;font-size:12px;width: 100%;" border="0" cellpadding="0" cellspacing="0">
                           <tbody>
                              <tr>
                                 <td><span style="color:#333;font-size:20px;font-weight:500;font-style:bold;font-family:Ubuntu,sans-serif;">Your Delivery Guru orders</span></td>
                                 <td style="text-align:right"><a href="#top" style="color:#535353;text-decoration:none;">Back to top</a></td>
                              </tr>
                              <tr style="height:30px">
                                 <td colspan="2"><span style="font-size:14px;font-weight:600;"></span></td>
                              </tr>
                              <tr>
                                 <td colspan="2">
                                    <hr style="border:none;height:1px;color:#CACACA;background-color:#CACACA;">
                                 </td>
                              </tr>
                              <tr>
                                 <td colspan="2">
                                    <table width="100%" style="text-align:center;font-size:12px;" border="0" cellpadding="4" cellspacing="0">
                                       <tbody>
                                          <tr>
                                             <th>#</th>
                                             <th style="text-align:center;padding-top: 10px;">Date</th>
                                             <th style="text-align:center;padding-top: 10px;">Order No.</th>
                                             <th style="text-align:center;padding-top: 10px;">Type</th>
                                             <th style="text-align:center;padding-top: 10px;">Payment</th>
                                             <th style="text-align:center;padding-top: 10px;">Total</th>
                                          </tr>
                                          
                                          <?php $length = count($values);
                                           for( $i=0; $i< $length; $i++){
                                             
                                           
                                           ?>
                                          <tr style="height:40px;background-color:#F5F5F5;">
                                             <td><?php echo $i+1; ?></td>
                                             <td><?php echo  $values[$i] -> created_at; ?></td>
                                             <td style="text-align:center;padding-top: 10px;"><?php echo  $values[$i] -> order_no; ?></td>
                                             <td style="text-align:center;padding-top: 10px;"><?php echo  ($values[$i] -> delivery_type == 0) ? 'Delivery' : 'Collection'; ?></td>
                                             <td style="text-align:center;padding-top: 10px;"><?php echo  ($values[$i] -> payment_type == 'COD') ? 'CASH' : 'CARD'; ?></td>
                                             <td style="text-align:center;padding-top: 10px;">£<?php echo number_format(($values[$i] -> amount) - ($values[$i] -> discount),2); ?></td>
                                          </tr>
                                          <?php
                                          }
                                          ?>
                                          <tr style="height:36px">
                                             <td style="border-top:1px solid #cacaca;border-bottom:1px solid #cacaca" colspan="3"></td>
                                             <td style="border-top:1px solid #cacaca;border-bottom:1px solid #cacaca;font-weight:600;padding-top: 10px;"></td>
                                             <td style="border-top:1px solid #cacaca;border-bottom:1px solid #cacaca;font-weight:600;padding-top: 10px;"></td>
                                             <td style="border-top:1px solid #cacaca;border-bottom:1px solid #cacaca;font-weight:600;padding-top: 10px;">£<?php echo number_format($total_amount,2);?></td>
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
                     <td style="background-color: #EE742B ;color: #ffff !important;text-align:center;padding:20px;color:#333;font-size:20px;font-weight:500;font-family:Ubuntu,sans-serif" colspan="2">Thank you for being a valuable partner</td>
                  </tr>
                  <tr>
                     <!--<td style="padding:10px 10px 30px 10px;text-align:center"><a href="" style="color:#2771CD;text-decoration:none;font-size:14px" target=_blank>Visit Partner Portal for more information</a></td>-->
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>