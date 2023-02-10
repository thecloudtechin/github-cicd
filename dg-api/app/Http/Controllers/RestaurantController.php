<?php

namespace App\Http\Controllers;

use App\Restaurants;
use App\Invoice;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\CommonController;

class RestaurantController extends Controller
{
    protected $commonController;
    public function __construct(CommonController $commonController)
    {
        $this->commonController = $commonController;
    }

    public function showAllRestaurants()
    {
        return response()->json(Restaurants::all());
    }
    
    
     public function restaurentByPin(Request $request)
    {
        return response()->json(Restaurants::where('pin', $request->input('pin'))->get());
    }
      public function restaurentByPin1(Request $request)
    {
        return response()->json(Restaurants::where('pin', $request->input('pin'))->get());
    }
    
        public function restaurentByPinandType(Request $request)
    {
        //->where('type', 'LIKE', "% $request->input('type') %")
        $type = $request->input('type');
        $pin = $request->input('pin');
        // echo "SELECT * FROM restaurants WHERE type LIKE '%$type%' AND pin = '.$pin.' ";
        return response()->json(DB::select("SELECT * FROM restaurants WHERE type LIKE '%$type%' AND pin = '$pin' "));
    }
    
  public function getDetail($id)
    {
        return response()->json(Restaurants::where('id', $id)->get());

    }

    public function create(Request $request)
    {
        $author = Restaurants::create($request->all());

        return response()->json($author, 201);
    }

    public function update($id, Request $request)
    {
        $author = Restaurants::findOrFail($id);
        $author->update($request->all());



 $url = 'https://hooks.slack.com/services/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';
// Create a new cURL resource
$ch = curl_init($url);


$res_status = '';

if($author->rest_status == '0')
{
   $res_status = 'OPEN'; 
}else
{
    $res_status = 'CLOSED';
}


$del_status = '';

if($author->delivery_status == '0')
{
   $del_status = 'Delivery'; 
}else
{
    $del_status = 'Collection';
}



$payload = json_encode(array (
  'text' => 'New Order Status.',
  'blocks' => 
  array (
     
    0 => 
    array (
      'type' => 'section',
      'text' => 
      array (
        'type' => 'mrkdwn',
        'text' => "Restaurants name is `".$author->hotel_name."` delivery Status. `".$del_status ."` Order Status : `".$res_status."` ",
      ),
    ),
  ),
));

// Attach encoded JSON string to the POST fields
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

// Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

// Return response instead of outputting
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the POST request
$result = curl_exec($ch);

// Close cURL resource
curl_close($ch);




        return response()->json($author, 200);
    }

    public function delete($id)
    {
        Restaurants::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
    // ranjitha starts from here
    public function hotelInvoice (Request $request)
    {
        
        try{
        
         $this->validate($request, [
        'hotel_id' => 'required',
        'start_date' => 'required',
         'end_date' => 'required',
          'invoice' => 'required',
    ]);
        
        
        
        $data = $request->All();
        $result = array ('success' => false, 'result' => array (), 'errors' => array ());
        $errors = array();
        try {
            

            $invoice = DB::table('invoice')->where('hotel_id','=', $data['hotel_id'])
            ->where('start_date' ,'=', $data['start_date'])
            ->where('end_date','=', $data['end_date'])
            ->get();
            
          
            
            
            
            
            
            $installment_count = DB::table('invoice')
                    ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('installment_status', [1])
                    ->whereIn('status', [1])
                    ->where('end_date', '>=', '1990-01-01')
                           ->where('end_date', '<=', $data['end_date'])
                    ->count();
                    
                    
                    
                    
$invoice_no_second_last = DB::table('invoice')->where(['hotel_id' => $data['hotel_id'],'installment_status' => 1])
->where('invoice_id','<>', $data['invoice'])
->orderBy('id', 'DESC')
->get();



if(count($invoice_no_second_last) > 0)
{
       $result['result']['paidamount'] = $invoice_no_second_last[0]->paidamount;
                    $result['result']['pendingamount'] = $invoice_no_second_last[0]->pendingamount;
                    $result['result']['paidby'] = $invoice_no_second_last[0]->paidby;
}
else
{
    $result['result']['paidamount'] = 0;
                    $result['result']['pendingamount'] = 0;
                    $result['result']['paidby'] = 0;
}

                    
                    
                    
                    
                      

            if(empty($invoice[0]->hotel_id) == $data['hotel_id'] && empty($invoice[0]->start_date)== $data['start_date'] && empty($invoice[0]->end_date)== $data['end_date'])
            {
                
                
              
                
                if (!count($errors)) {
                    
                    
                    
                    //  $invoice_ref_id_count = DB::table('invoice')
                    // ->get();
            
                    $hotel_details = DB::table('restaurants')->where(array('id' => $data['hotel_id']))
                    ->get();
    
                    $total_cod_orders = DB::table('orders')
                    ->where('payment_type' , 'COD')
                     ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [5, 7, 3])
                    ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                    ->get();
    
                    $total_paypal_orders = DB::table('orders')
                    ->where('payment_type' , 'ECOM')
                     ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [5, 7, 3])
                    ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                    ->get();
    
                    $total_amount = DB::table('orders')
                    ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [5, 7, 3])
                    ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                    ->sum('amount'); 
    
                    $total_discount_amount = DB::table('orders')->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [5, 7, 3])
                    ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                    ->sum('discount'); 
                    
                 
                    $total_cod_amount = DB::table('orders')
                    ->where('payment_type' , 'COD')
                    ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [5, 7, 3])
                    ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                    ->sum('amount');
                    
    
                    $total_cod_discount_amount = DB::table('orders')
                     ->where('payment_type' , 'COD')
                    ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [5, 7, 3])
                    ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                    ->sum('discount'); 
                    
    
                    $total_paypal_amount = DB::table('orders')
                     ->where('payment_type' , 'ECOM')
                    ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [5, 7, 3])
                    ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                    ->sum('amount');
                    
                    $total_paypal_discount_amount = DB::table('orders')
                    ->where('payment_type' , 'ECOM')
                    ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [5, 7, 3])
                    ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                    ->sum('discount'); 
                    
                    $delivery_order_count = DB::table('orders')->where('delivery_type' , 0)
                    ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [5, 7, 3])
                    ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                    ->count();
    
                    $collection_order_count = DB::table('orders')->where( 'delivery_type' , 1)
                    ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [5, 7, 3])
                    ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                    ->count();
    
                    $total_rejected_orders = DB::table('orders')
                     ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [6])
                    ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                    ->get();
    
                    $total_rejected_amount = DB::table('orders')
                     ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [6])
                    ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                    ->sum('amount');
    
                    $dg_detals = DB::table('dgdetails')
                    ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                    ->get();
    
                    $dg_orders = DB::table('orders')
                     ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [5, 7, 3])
                    ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                    ->orderBy('id', 'ASC')
                    ->get();
                    // print_r($total_paypal_amount);exit;
                    $invoiceId =  date("YmdHis");//.rand(9999999,99999999); date("YmdHis")
                    
                    
                    
                    if($total_cod_amount == 0){
                        $total_cod_amount_1 = $total_cod_amount;
                    } else {
                        $total_cod_amount_1 = $total_cod_amount - $total_cod_discount_amount;
                    }
                    if($total_paypal_amount == 0){
                        $total_paypal_amount_1 = $total_paypal_amount;
                    } else {
                        $total_paypal_amount_1 = $total_paypal_amount - $total_paypal_discount_amount;
                    }
                    if($total_rejected_amount == 0){
                        $total_rejected_amount_1 = $total_rejected_amount;
                    } else {
                        $total_rejected_amount_1 = $total_rejected_amount - $total_discount_amount;
                    }
                    
                    
                    

                    
                    
                    
                    $result['success'] = true;
                    $result['result']['hotel_details'] = $hotel_details;
                    $result['result']['total_cod_orders'] = count($total_cod_orders);
                    $result['result']['total_paypal_orders'] = count($total_paypal_orders);
                    $result['result']['total_amount'] = $total_amount - $total_discount_amount;
                    $result['result']['total_cod_amount'] = $total_cod_amount_1;
                    $result['result']['total_paypal_amount'] = $total_paypal_amount_1;
                    $result['result']['total_rejected_orders'] = count($total_rejected_orders);
                    $result['result']['total_rejected_amount'] = $total_rejected_amount_1;
                    $result['result']['delivery_order_count'] = $delivery_order_count;
                    $result['result']['collection_order_count'] = $collection_order_count;
                    $result['result']['dg_detals'] = $dg_detals;
                    $result['result']['dg_orders'] = $dg_orders;
                    $result['result']['invoiceId'] = $invoiceId;
                    $result['result']['start_date'] = $data['start_date'];
                    $result['result']['end_date'] = $data['end_date'];
                    $result['result']['installment_count'] = $installment_count;
                    //  $result['result']['invoice_ref_id'] = $invoice_ref_id;
                    
                    
                    
                }
                
                $invoice = new invoice;
                $invoice->invoice_id = $result['result']['invoiceId'];
                $invoice->hotel_id = $result['result']['hotel_details'][0] -> id;
                $invoice->start_date = $result['result']['start_date'];
                $invoice->end_date = $result['result']['end_date'];
                $invoice->total_amount = $result['result']['total_amount'];
                $invoice->status = '0';
                
                $invoice->save();
                
                $invoice_ref_id = $invoice->id;
                $result['result']['invoice_ref_id'] = sprintf('%06d', $invoice_ref_id);

            }
            else{
                if (!count($errors)) {
            
                    $hotel_details = DB::table('restaurants')->where(array('id' => $data['hotel_id']))
                    ->get();
    
                    $total_cod_orders = DB::table('orders')->where( 'payment_type' , 'COD')
                    ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [5, 7, 3])
                    ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                    ->get();
    
                    $total_paypal_orders = DB::table('orders')->where( 'payment_type' , 'ECOM')
                    ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [5, 7, 3])
                    ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                    ->get();
    
                    $total_amount = DB::table('orders')->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [5, 7, 3])
                    ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                    ->sum('amount'); 
    
                    $total_discount_amount = DB::table('orders')->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [5, 7, 3])
                    ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                    ->sum('discount'); 
                    
                 
                    $total_cod_amount = DB::table('orders')->where( 'payment_type' , 'COD')
                    ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [5, 7, 3])
                    ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                    ->sum('amount');
                    
    
                    $total_cod_discount_amount = DB::table('orders')->where('payment_type' , 'COD')
                    ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [5, 7, 3])
                    ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                    ->sum('discount'); 
                    
    
                    $total_paypal_amount = DB::table('orders')->where( 'payment_type' , 'ECOM')
                    ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [5, 7, 3])
                    ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                    ->sum('amount');
                    
                    $total_paypal_discount_amount = DB::table('orders')->where('payment_type' , 'ECOM')
                    ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [5, 7, 3])
                    ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                    ->sum('discount'); 
                    
                    $delivery_order_count = DB::table('orders')->where( 'delivery_type' , 0)
                    ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [5, 7, 3])
                    ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                    ->count();
                    
                    $collection_order_count = DB::table('orders')->where( 'delivery_type' , 1)
                    ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [5, 7, 3])
                    ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                    ->count();
    
                    $total_rejected_orders = DB::table('orders')
                    ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [6])
                    ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                    ->get();
    
                    $total_rejected_amount = DB::table('orders')
                    ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [6])
                    ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                    ->sum('amount');
    
                    $dg_detals = DB::table('dgdetails')
                    ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                    ->get();
    
                    $dg_orders = DB::table('orders')
                    ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [5, 7, 3])
                    ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                    ->orderBy('id', 'ASC')
                    ->get();
                    
                    if($total_cod_amount == 0){
                        $total_cod_amount_1 = $total_cod_amount;
                    } else {
                        $total_cod_amount_1 = $total_cod_amount - $total_cod_discount_amount;
                    }
                    if($total_paypal_amount == 0){
                        $total_paypal_amount_1 = $total_paypal_amount;
                    } else {
                        $total_paypal_amount_1 = $total_paypal_amount - $total_paypal_discount_amount;
                    }
                    if($total_rejected_amount == 0){
                        $total_rejected_amount_1 = $total_rejected_amount;
                    } else {
                        $total_rejected_amount_1 = $total_rejected_amount - $total_discount_amount;
                    }
                $invoice_no = DB::table('invoice')->where(['hotel_id' => $invoice[0]->hotel_id,'start_date' => $data['start_date'],'end_date' => $data['end_date']])->update(['invoice_id' => $invoice[0]->invoice_id]);

// $invoice_no_second_last = DB::table('invoice')->where(['hotel_id' => $invoice[0]->hotel_id,'installment_status' => 1])
// ->orderBy('id', 'DESC')
// ->get();


// if(count($invoice_no_second_last) == 1)

// {
//       $result['result']['paidamount'] = $invoice_no_second_last[0]->paidamount;
//                     $result['result']['pendingamount'] = $invoice_no_second_last[0]->pendingamount;
//                     $result['result']['paidby'] = $invoice_no_second_last[0]->paidby;
// }
// else if(count($invoice_no_second_last) > 1)

// {
//       $result['result']['paidamount'] = $invoice_no_second_last[1]->paidamount;
//                     $result['result']['pendingamount'] = $invoice_no_second_last[1]->pendingamount;
//                     $result['result']['paidby'] = $invoice_no_second_last[1]->paidby;
// }

                    

                    $result['success'] = true;
                    $result['result']['hotel_details'] = $hotel_details;
                    $result['result']['total_cod_orders'] = count($total_cod_orders);
                    $result['result']['total_paypal_orders'] = count($total_paypal_orders);
                    $result['result']['total_amount'] = $total_amount - $total_discount_amount;
                    $result['result']['total_cod_amount'] = $total_cod_amount_1;
                    $result['result']['total_paypal_amount'] = $total_paypal_amount_1;
                    $result['result']['total_rejected_orders'] = count($total_rejected_orders);
                    $result['result']['total_rejected_amount'] = $total_rejected_amount_1;
                    $result['result']['delivery_order_count'] = $delivery_order_count;
                    $result['result']['collection_order_count'] = $collection_order_count;
                    $result['result']['dg_detals'] = $dg_detals;
                    $result['result']['dg_orders'] = $dg_orders;
                    $result['result']['invoiceId'] = $invoice[0]->invoice_id;
                 
                    $result['result']['invoice_ref_id'] = sprintf('%06d', $invoice[0]->id);
                    
                   
                }
                
                 $result['result']['installment_count'] = $installment_count;
                return response()->json($result);
            }
        } catch (Exception $e) {
            $errors[] = 'Something went wrong, Please try after some time';
        }
        $result['errors'] = $errors;
        
        
        
        } catch (Exception $e) {
           echo $e;
        }
        return response()->json($result);
    }
    public function randomSearchByPostalcode (Request $request)
    {
        $data = $request->All();
        $res = Restaurants::select("restaurants.*")
                ->where("pin","LIKE","%{$data['pin']}%")
                ->get();
        return response()->json($res);
    }
    
    public function searchBasedOnCity (Request $request)
    {
        $data = $request->All();
        $result = array ('success' => false, 'result' => array (), 'errors' => array ());
        $errors = array();
        try {
            if (empty($data['city'])) {
                $errors[] = 'city is required';
            }
            if (!count($errors)) {
                $res = DB::table('restaurants')->where(array('city' => $data['city']))->get();
                $result['success'] = true;
                $result['result'] = $res;
            }
        } catch (Exception $e) {
            $errors[] = 'Something went wrong, Please try after some time';
        }
        $result['errors'] = $errors;
        return response()->json($result);
    }
    public function randomSearchByType (Request $request)
    {
        $data = $request->All();
        $res = Restaurants::select("restaurants.*")
                ->where("pin","LIKE","%{$data['type']}%")
                ->get();
        return response()->json($res);
    }
    public function randomSearchByDelivery (Request $request)
    {
        $data = $request->All();
        $res = Restaurants::select("restaurants.*")
                ->where("delivery","LIKE","%{$data['delivery']}%")
                ->get();
        return response()->json($res);
    }
    public function searchBasedOnName (Request $request)
    {
        $data = $request->All();
        $result = array ('success' => false, 'result' => array (), 'errors' => array ());
        $errors = array();
        try {
            if (empty($data['hotel_name'])) {
                $errors[] = 'Hotel Name is required';
            }
            if (!count($errors)) {
                $res = DB::table('restaurants')->where(array('hotel_name' => $data['hotel_name']))->get();
                $result['success'] = true;
                $result['result'] = $res;
            }
        } catch (Exception $e) {
            $errors[] = 'Something went wrong, Please try after some time';
        }
        $result['errors'] = $errors;
        return response()->json($result);
    }
    public function searchBasedOnTake_away (Request $request)
    {
        $data = $request->All();
        $res = Restaurants::select("restaurants.*")
                ->where("take_away","LIKE","%{$data['take_away']}%")
                ->get();
        return response()->json($res);
    }
    
    public function send_email_for_hotel_invoice (Request $request)
    {
        $data = $request->All();
        $result = array ('success' => false, 'result' => array (), 'errors' => array ());
        $errors = array();
        try {
            if (empty($data['hotel_id'])) {
                $errors[] = 'hotel id is required';
            }
            if (empty($data['start_date'])) {
                $errors[] = 'Start date is required';
            }
            if (empty($data['end_date'])) {
                $errors[] = 'End date is required';
            }
            
            
             $installment_count = DB::table('invoice')
                    ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('installment_status', [1])
                    ->whereIn('status', [1])
                    ->where('end_date', '>=', '1990-01-01')
                           ->where('end_date', '<=', $data['end_date'])
                    ->count();
            
            if (!count($errors)) {
            
                $hotel_details = DB::table('restaurants')->where(array('id' => $data['hotel_id']))
                ->get();

                $total_cod_orders = DB::table('orders')->where( 'payment_type' , 'COD')
                ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [5, 7, 3])
                ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                ->get();

                $total_paypal_orders = DB::table('orders')->where( 'payment_type', 'ECOM')
                ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [5, 7, 3])
                ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                ->get();

                $total_amount = DB::table('orders')
                ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [5, 7, 3])
                ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                ->sum('amount'); 

                $total_discount_amount = DB::table('orders')
                ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [5, 7, 3])
                ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                ->sum('discount'); 


                $total_cod_amount = DB::table('orders')
                ->where( 'payment_type' , 'COD')
                ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [5, 7, 3])
                ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                ->sum('amount');
                
                
                $total_cod_discount_amount = DB::table('orders')
                ->where( 'payment_type' , 'COD')
                ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [5, 7, 3])
                    ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                    ->sum('discount'); 

                $total_paypal_amount = DB::table('orders')
                ->where( 'payment_type' , 'ECOM')
                ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [5, 7, 3])
                ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                ->sum('amount');
                
                $total_paypal_discount_amount = DB::table('orders')->where('payment_type' , 'ECOM')
                ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [5, 7, 3])
                    ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                    ->sum('discount'); 

                $delivery_order_count = DB::table('orders')->where( 'delivery_type' , 0)
                 ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [5, 7, 3])
                ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                ->count();

                $collection_order_count = DB::table('orders')->where( 'delivery_type' , 1)
                 ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [5, 7, 3])
                ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                ->count();

                $total_rejected_orders = DB::table('orders')
                 ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [6])
                ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                ->get();

                $total_rejected_amount = DB::table('orders')
                 ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [6])
                ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                ->sum('amount');

                $dg_detals = DB::table('dgdetails')
                ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                ->get();

                $dg_orders = DB::table('orders')
                 ->where('hotel_id' , $data['hotel_id'])
                    ->whereIn('status', [5, 7, 3])
                ->whereBetween('created_at',[$data['start_date'].' '.'00:00:00',$data['end_date'].' '.'23:59:59'])
                ->orderBy('id', 'ASC')
                ->get();
                $invoice = DB::table('invoice')->where('hotel_id','=', $data['hotel_id'])
                ->where('start_date' ,'=', $data['start_date'])
                ->where('end_date','=', $data['end_date'])
                ->get();
                
                
                

              
                // $total_amount > 0 && count($invoice) > 0
                if(true )
                {
                    
                     $invoiceId = $invoice[0]->invoice_id;

                $to_email =  explode(',', $data['to_email']);
                
                if($total_cod_amount == 0){
                    $total_cod_amount_1 = $total_cod_amount;
                } else {
                    $total_cod_amount_1 = $total_cod_amount - $total_cod_discount_amount;
                }
                if($total_paypal_amount == 0){
                    $total_paypal_amount_1 = $total_paypal_amount;
                } else {
                    $total_paypal_amount_1 = $total_paypal_amount - $total_paypal_discount_amount;
                }
                if($total_rejected_amount == 0){
                    $total_rejected_amount_1 = $total_rejected_amount;
                } else {
                    $total_rejected_amount_1 = $total_rejected_amount - $total_discount_amount;
                }
                
                
                $invoice_no_second_last = DB::table('invoice')->where(['hotel_id' => $invoice[0]->hotel_id,'installment_status' => 1])
->orderBy('id', 'DESC')
->get();


if(count($invoice_no_second_last) == 1)

{
       $result['result']['paidamount'] = $invoice_no_second_last[0]->paidamount;
                    $result['result']['pendingamount'] = $invoice_no_second_last[0]->pendingamount;
                    $result['result']['paidby'] = $invoice_no_second_last[0]->paidby;
}
else if(count($invoice_no_second_last) > 1)

{
       $result['result']['paidamount'] = $invoice_no_second_last[1]->paidamount;
                    $result['result']['pendingamount'] = $invoice_no_second_last[1]->pendingamount;
                    $result['result']['paidby'] = $invoice_no_second_last[1]->paidby;
}
                
                

                $result['success'] = true;
                $result['result']['hotel_details'] = $hotel_details;
                $result['result']['total_cod_orders'] = count($total_cod_orders);
                $result['result']['total_paypal_orders'] = count($total_paypal_orders);
                $result['result']['total_amount'] = $total_amount - $total_discount_amount;
                $result['result']['total_cod_amount'] = $total_cod_amount_1;
                $result['result']['total_paypal_amount'] = $total_paypal_amount_1;
                $result['result']['total_rejected_orders'] = count($total_rejected_orders);
                $result['result']['total_rejected_amount'] = $total_rejected_amount_1;
                $result['result']['delivery_order_count'] = $delivery_order_count;
                $result['result']['collection_order_count'] = $collection_order_count;
                $result['result']['dg_detals'] = $dg_detals;
                $result['result']['dg_orders'] = $dg_orders;
                $result['result']['start_date'] = $data['start_date'];
                $result['result']['end_date'] = $data['end_date'];
                $result['result']['invoiceId'] = $invoiceId;
                $result['result']['to_email'] = $to_email;
                $result['result']['installment_count'] = $installment_count;
                $result['result']['invoice_ref_id'] = $invoice[0]->id;
                
                

                $this->commonController->mailHotelInvoice($result['result']);}

            }
        } catch (Exception $e) {
            $errors[] = 'Something went wrong, Please try after some time';
        }
        
        
         if( $total_amount > 0 && count($invoice) > 0)
                {
                    $result['errors'] = $errors;
        $invoice = new invoice;
        $invoice->invoice_id = $result['result']['invoiceId'];
        $invoice->hotel_id = $result['result']['hotel_details'][0] -> id;
        $invoice->start_date = $result['result']['start_date'];
        $invoice->end_date = $result['result']['end_date'];
        $invoice->total_amount = $result['result']['total_amount'];
        $invoice->status = '0';
        
        $invoice->save();
                    return response()->json(['invoice' => $invoice, 'message' => 'CREATED'], 201);
                    
                }
else{
        //return successful response
        return response()->json([ 'message' => 'Total is Zero'], 201);
        // return response()->json($result);
}



    }
        
    public function updateInvoice($id, Request $request)
    {
        $invoice = Invoice::findOrFail($id);
        $data = $request->all();
        $invoice->update($data);
        // return response()->json($invoice, 200);
        return response('Updated Successfully', 200);
    }
        
    public function deleteInvoice($id)
    
    {
        Invoice::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
    public function updateRestaurantDiscount($id, Request $request)
    {
        
        $data = $request->All();
        $rest_data = Restaurants::where(['id' => $id])->update(['discount' => $data['discount']]);
        return response()->json(['status'=> "success", 'result' => $rest_data]);
    }
    
       public function InvoiceStartDate($id)
    {
        
        $dg_orders = DB::table('invoice')
                     ->where('hotel_id' , $id)
                    ->orderBy('id', 'DESC')
                    ->limit(1)
                    ->get();
                     return response()->json(['date'=> $dg_orders]);
    }
       public function nearByPopular(Request $request)
    {
        
          $data = $request->All();
$pin = $data['pin'];
          //$data['hotel_id'])

        
        $list = DB::table('restaurants')
        ->join('openinghours', 'restaurants.id', '=', 'openinghours.hotel_id')
                     ->where('delivery', 'LIKE', "%$pin%")
                     ->where('openinghours.type', 'delivery')
                     ->select('restaurants.*' , 'openinghours.openingtime')
                    ->get();
                     return response()->json($list);
    }
    
           public function basedonname(Request $request)
    {


          $data = $request->All();
$name = $data['name'];
           
                     return response()->json(DB::select("SELECT restaurants.* , openinghours.openingtime  FROM restaurants Inner join openinghours On restaurants.id = openinghours.hotel_id
WHERE 
      hotel_name like '%$name%'
      OR owner_name like '%$name%'
      OR hotel_refid like '%$name%'
      OR hotel_name like '%$name%'
      OR delivery like '%$name%'
      OR pin like '%$name%'
      OR city like '%$name%'
      "));
    }
    
}
