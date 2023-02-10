<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Log;
use App\Orders;
use Illuminate\Http\Request;
use Users;

class OrderController extends Controller
{

    public function showAllOrders()
    {
        return response()->json(Orders::all());
    }
    
    
     public function showAllOrdersByONO($id)
    {
       $data = [];
       
        
       $datas = DB::table('orders')
->leftjoin('addresses', 'addresses.id', 'user_address_id')
->leftJoin('coupons', 'coupons.id', 'orders.c_id')
->join('restaurants', 'restaurants.id', 'orders.hotel_id')
->join('users', 'users.id', 'orders.user_id')
->where('orders.order_no', '=', $id)
->select('orders.id AS mainId','orders.order_no','orders.user_id','orders.day','orders.time','orders.delivery_type','orders.hotel_id',
'orders.amount','orders.discount','orders.user_address_id','orders.driver_id','orders.payment_type','orders.status AS orderStatus','addresses.*',
'restaurants.hotel_name','restaurants.address AS hotel_address','orders.number AS number','orders.delivery_charges',
'orders.created_at','orders.name','orders.number','orders.email','hotel_mob','owner_mob','owner_email','hotel_email','coupons.discount AS cDiscount','users.mobile AS umobile','users.contact AS ucontact')
->get();
foreach ($datas as $all_data) {
    
    $amount = $all_data->amount - $all_data->discount;
    
    $internaldata = [];
    $items = DB::table('order_items')
->join('sub_categories', 'sub_categories.id', 'order_items.item_id')
->where('order_no', $all_data->order_no)
->select('order_items.id AS order_items_id','order_items.*','sub_categories.item_name','sub_categories.id',
'sub_categories.item_name', 'sub_categories.item_desc',
'sub_categories.categories_id', 'sub_categories.price', 'sub_categories.discount')
->get();

foreach ($items as $items_data) {
    
    if($items_data->extraFor != null)
    {
        $extra = DB::table('extras')
       ->join('addon_items', 'extras.add_on_id','=', 'addon_items.id')
      ->where('extras.item_id', '=', $items_data->item_id)
      ->where('extras.order_no', $items_data->order_no)
      ->where('extras.for', $items_data->extraFor)
       ->select('*')
       ->get();
    }
    else
    {
        $extra = DB::table('extras')
       ->join('addon_items', 'extras.add_on_id','=', 'addon_items.id')
      ->where('extras.item_id', '=', $items_data->item_id)
      ->where('extras.order_no', $items_data->order_no)
       ->select('*')
       ->get();
    }
    
    
    

$internaldata[] = [
    
    'order_items_id'=>$items_data->order_items_id,
'id'=>$items_data->id,
'order_no'=>$items_data->order_no,
'item_id'=>$items_data->item_id,
'qty'=>$items_data->qty,
'amount'=>$items_data->amount,
'status'=>$items_data->status,
'discount'=>$items_data->discount,
'created_at'=>$items_data->created_at,
'updated_at'=>$items_data->updated_at,
'notes'=>$items_data->notes,
'item_name'=>$items_data->item_name,
'item_desc'=>$items_data->item_desc,
'categories_id'=>$items_data->categories_id,
'price'=>$items_data->price,
'extra'=>$extra,
    
    
    ];


    
    
    
}

    

     $couponMsg = "";
            if( $all_data->cDiscount != "")
            {
                $couponMsg = "You have applied coupon of " .$all_data->cDiscount . "% Discount";
            }
    
   
    
               $data[] = [
                //   'dummy' => $all_data->mainId,
         'order_no' => $all_data->order_no,
        "id" => $all_data->mainId,
        "user_id" => $all_data->user_id,
        "orderTime" => $all_data->created_at,
        "username"=>$all_data->name,
        "date&Time"=> $all_data->day .' '. $all_data->time,
        "home_address" => $all_data->home_address,
        "permanent_address" => $all_data->permanent_address,
        "user_address_id" => $all_data->user_address_id,
        "amount"=> number_format((float)$amount, 2, '.', ''),
        "delivery_charges"=> $all_data->delivery_charges,
        "landmark"=> $all_data->landmark,
        "driver_id"=> $all_data->driver_id,
        "delivery_type"=> $all_data->delivery_type,
        "payment_type"=> $all_data->payment_type,
        "day"=>$all_data->day,
        "time"=> $all_data->time,
          "email"=>$all_data->email,
        "contact"=> $all_data->number ." / " .$all_data->umobile . "(V) / " .$all_data->ucontact,
        "status" => $all_data->status,
        "discount"=> $all_data->discount,
        "hotel_id"=> $all_data->hotel_id,
         "hotel_name"=> $all_data->hotel_name,
          "hotel_address"=> $all_data->hotel_address,
          "orderStatus"=> $all_data->orderStatus,
           "cDiscount"=> $couponMsg,
           "hotel_email"=> $all_data->hotel_email,
         "owner_email"=> $all_data->owner_email,
          "owner_mobile"=> $all_data->owner_mob,
          "hotel_mobile"=> $all_data->hotel_mob,
          
          'order_details'=>$internaldata,
          
          
          
      



 
    ];
}
return $data;
    }
    
    
    

 public function showAllOrdersByHotelID($id,$status)
    {
        
        
       
       $data = [];
       
        
       $datas = DB::table('orders')
->join('users', 'users.id', 'orders.user_id')
->join('addresses', 'addresses.id', 'user_address_id')
->where('hotel_id', '=', $id)
->whereIN('orders.status', [$status])
->select('orders.id AS mainId','orders.order_no','orders.user_id','orders.day','orders.time','orders.delivery_type','orders.hotel_id',
'orders.amount','orders.discount','orders.user_address_id','orders.driver_id','orders.payment_type','orders.status',
'users.first_name','addresses.*','users.email','users.mobile','users.contact','orders.created_at AS oc','orders.updated_at AS ou')
 ->orderBy('orders.id', 'DESC')
->get();


foreach ($datas as $all_data) {
   
    
               $data[] = [
                //   'dummy' => $all_data->mainId,
         'order_no' => str_replace ('GRILLGURU20', 'GG', $all_data->order_no) ,
        "id" => $all_data->mainId,
        "user_id" => $all_data->user_id,
        "username"=>$all_data->first_name,
        "date&Time"=> $all_data->day .' '. $all_data->time,
        "home_address" => $all_data->home_address,
        "permanent_address" => $all_data->permanent_address,
        "user_address_id" => $all_data->user_address_id,
        "amount"=> $all_data->amount,
        "driver_id"=> $all_data->driver_id,
        "delivery_type"=> $all_data->delivery_type,
        "payment_type"=> $all_data->payment_type,
        "day"=>$all_data->day,
        "time"=> $all_data->time,
        "status" => $all_data->status,
        "discount"=> $all_data->discount,
        "hotel_id"=> $all_data->hotel_id,
        "oc"=> $all_data->oc,
        "ou"=> $all_data->ou,
        "useremail"=> $all_data->email,
        "usermobile"=> $all_data->mobile,
        "usercontact"=> $all_data->contact,
        
        'order_details' => DB::table('order_items')
->join('sub_categories', 'sub_categories.id', 'order_items.item_id')
->where('order_no', $all_data->order_no)
->select( 'order_items.*','sub_categories.item_name')->get(),


  'extras' => DB::table('extras')
  ->join('addon_items', 'addon_items.id', 'extras.add_on_id')
->where('extras.order_no', $all_data->order_no)
->select( 'extras.*','addon_items.*')->get(),

'sumOfItems' => DB::table('order_items')

->where('order_no', $all_data->order_no)
->select( DB::raw('SUM(qty) AS sumqty'),DB::raw('SUM(qty * amount) AS sumamount'))
->get()
    ];
}
return $data;
    }
    

    public function create(Request $request)
    {

        $this->validate($request, [
            'user_id' => 'required|string',
            'user_address_id' => 'required|string',
            'amount' => 'required|string',
            'discount' => 'required|string',
            'order_no' => 'required|string',
        ]);
        $author = Orders::create($request->all());

        return response()->json(['order_no'=> $request->input('order_no')], 201);


    }
    public function getCountOfOrder($id)
    {
return DB::table('orders')->where('hotel_id', '=', $id)->whereIn('status',[1,2])->count();
    }

    public function showAllOrdersByUID($id,$status)
    {
return
         DB::table('orders')
            ->join('users', 'users.id', 'orders.user_id')
            ->leftJoin('addresses', 'addresses.id', 'user_address_id')
            ->join('restaurants', 'restaurants.id', 'orders.hotel_id')
            ->join('status_list', 'status_list.id', 'orders.status')
            ->where('user_id', '=', $id)
            
            ->whereRaw('orders.status in (' . $status . ')')
            ->select('orders.id AS mainId', 'orders.order_no', 'orders.user_id', 'orders.day', 'orders.time', 'orders.delivery_type', 'orders.hotel_id',
                'orders.amount', 'orders.discount', 'orders.user_address_id', 'orders.driver_id', 'orders.payment_type', 'orders.status AS mainStatus',
                'users.first_name', 'addresses.*', 'restaurants.*', 'status_list.*')
            ->get();


    }
    public function showAllOrdersByUIDANDHID1($id,$hid, $status)
    {
        return
         DB::table('orders')
            ->join('users', 'users.id', 'orders.user_id')
            ->leftJoin('addresses', 'addresses.id', 'user_address_id')
            ->join('restaurants', 'restaurants.id', 'orders.hotel_id')
            ->join('status_list', 'status_list.id', 'orders.status')
            ->where('user_id', '=', $id)
            ->where('hotel_id', '=', $hid)
            ->whereRaw('orders.status in (' . $status . ')')
            ->select('orders.id AS mainId', 'orders.order_no', 'orders.user_id', 'orders.day', 'orders.time', 'orders.delivery_type', 'orders.hotel_id',
                'orders.amount', 'orders.user_address_id', 'orders.driver_id', 'orders.payment_type', 'orders.status AS mainStatus',
                'users.first_name', 'addresses.*', 'restaurants.*', 'status_list.*', 'orders.created_at AS created_at','orders.discount AS discount')
            ->orderBy('orders.id', 'DESC')->get();
    }
    
    
    public function OrderUpdate($id,Request $request)
    {
        $orderno = $request->input("orderno");
        $status = $request->input("status");
         $reason = $request->input("reason");
        $time = $request->input("time");
        $dT = date('H:i:s',strtotime('+'.$time.' minutes', strtotime(date('H:i:s'))));
        
        
        
        if($request->input("status") != '13')
        {
        $update =  DB::statement("UPDATE orders SET status= '".$status."' , delivery_time = '".$dT."' , updated_at = '".date('Y-m-d H:i:s')."' , note= '".$reason."'  WHERE order_no = '".$orderno."'" );
        }      
        else
        {
            $day = $request->input("day");
           $arra = explode("/",$day);
            $month = $arra[1];
            if(strlen($arra[1]) == 1)
            {
                $month = "0" . $arra[1];
            }
            $newFormate = $arra[2] . "-" . $month ."-". $arra[0];
            
            
             Log::channel('slack')->info('Pre-Order No : ' .$request->input("orderno") . " Accepted of " .$newFormate);
             
             
           $update =  DB::statement("UPDATE orders SET status= '".$status."' , excepted_date = '".$newFormate."'  WHERE order_no = '".$orderno."'" );
          
        }
        
        if($request->input("status") == '7')
        {
              Log::channel('slack')->info('Order No : ' .$request->input("orderno") . " Food preparing");
        }
        else if($request->input("status") == '6')
        {
              Log::channel('slack')->info('Order No : ' .$request->input("orderno") . " order rejected by Restaurants");
        }
         else if($request->input("status") == '5')
        {
             Log::channel('slack')->info('Order No : ' .$request->input("orderno") . " food prepared waiting for driver");
        }
         else if($request->input("status") == '3')
        {
             Log::channel('slack')->info('Order No : ' .$request->input("orderno") . " Order Completed");
        }
        else
        {
            
        }
        
        
        // $update =  DB::statement("INSERT INTO orderNotificationTempTable ('oid') VALUES ( '" .$orderno. "')" );
        DB::table('orderNotificationTempTable')->insert(
    ['oid' => $orderno]
);
        
        
        return  $this->OrderTab($id,$request->input('hotel_id'));
        
    }
        
    
    
       public function WithDateOrderTab($id,$hid,$date)
    {
        
        $curDate = date('Y-m-d');
        $preDate = date('d/m/Y');
        
        // echo $preDate;
        
      $data = [];
        $extra_data = [];
        $extra_data1 = [];
        $outer =  DB::table('orders')
            ->join('users', 'users.id', 'orders.user_id')
            ->leftJoin('coupons', 'coupons.id', 'orders.c_id')
            ->leftJoin('addresses', 'addresses.id', 'user_address_id')
            ->join('restaurants', 'restaurants.id', 'orders.hotel_id')
             ->whereDate('orders.excepted_date', $date)
            ->whereRaw('orders.hotel_id in (' . $hid . ')')
            ->select('orders.*', 'addresses.home_address','restaurants.id AS hotel_id','restaurants.hotel_name AS hotel_name','restaurants.address AS hotel_address','users.id AS user_id','coupons.discount AS cDiscount')
            ->orderBy('orders.id', 'ASC')
            // ->limit(30)
            ->get();
            
            
        //  echo $outer->toSql();
        //  return;
            
            // print_r($outer);
            
            
              foreach ($outer as $all_data) {
                  
                  
                  
                  
                 
    $extra_data = [];
        $extra_data1 = [];
   
    $orderDetails= DB::table('order_items')
->join('sub_categories', 'sub_categories.id', 'order_items.item_id')
->where('order_no', $all_data->order_no)
->select( 'order_items.*','sub_categories.item_name','sub_categories.price')->get();


        



 foreach ($orderDetails as $all_data1) {
    
    
     $counter = 0;
             $totalamt = 0;
    $extras=[];
    
    
   if($all_data1->extraFor != null || $all_data1->extraFor != "")
    {
        $extras = DB::table('extras')
       ->join('addon_items', 'extras.add_on_id','=', 'addon_items.id')
      ->where('extras.item_id', '=', $all_data1->item_id)
      ->where('extras.order_no', $all_data1->order_no)
      ->where('extras.for', $all_data1->extraFor)
       ->select('*')
      ->get();
    }
    else
    {
        $extras = DB::table('extras')
       ->join('addon_items', 'extras.add_on_id','=', 'addon_items.id')
      ->where('extras.item_id', '=', $all_data1->item_id)
      ->where('extras.order_no', $all_data1->order_no)
       ->select('*')
      ->get();
    }
    
      $extra_data1 = [];


foreach ($extras as $all_data11) {
    
    $totalamt += $all_data11->amount * $all_data11->qty;
    

    $extra_data1[] = [
"add_on_id"=> (string)$all_data11->add_on_id,
"item_id"=> (string)$all_data11->item_id,
"addon_name"=> (string)$all_data11->addon_name,
"qty"=> (string)$all_data11->qty,
"amount"=> (string)$all_data11->amount,
"for"=> (string)$all_data11->for,

         ];
}

$totalamt += $all_data1->price * $all_data1->qty;
$counter +=  $all_data1->qty;

    $extra_data[] = [

 "order_id"=> (string)$all_data1->order_no,
 "item_id"=> (string)$all_data1->item_id,
 "item_name"=> (string)$all_data1->item_name,
 "item_price"=> (string)$all_data1->price,
 "qty"=> (string)$all_data1->qty,
 "amount"=> (string)$all_data1->amount,
 "notes"=> (string)$all_data1->notes,
  "extraFor"=> (string)$all_data1->extraFor,
"extra"=> $extra_data1,
         ];
}

$home_address="";
$alert="";
if($all_data->home_address == null)
{
    $home_address = "";
}
else
{
    $home_address = $all_data->home_address;
}
if (strtotime(date('Y-m-d H:i:s')) > strtotime($all_data->updated_at) + (10 * 60))
            {
                $alert = "1";
            }
            else
            {
                $alert = "0";
            }
            
            
            $couponMsg = "";
            if( $all_data->cDiscount != "")
            {
                $couponMsg = "You have applied coupon of " .$all_data->cDiscount . "% Discount";
            }
            
            
            


    
              $data[] = [
        //   'dummy' => $all_data,
         'order_no' => (string)$all_data->order_no ,
        "id" => (string)$all_data->id,
        "user_id" => (string)$all_data->user_id,
        "username"=>(string)$all_data->name,
        "home_address" => (string)$home_address,
        "user_address_id" =>(string) $all_data->user_address_id,
        "amount"=> (string)number_format((float)$all_data->amount, 2, '.', ''),
        "driver_id"=> (string)$all_data->driver_id,
        "delivery_type"=> (string)$all_data->delivery_type,
        "payment_type"=> (string)$all_data->payment_type,
        "day"=>(string)$all_data->day,
        "time"=> (string)$all_data->time,
        "status" => (string)$all_data->status,
        "discount"=> (string)$all_data->discount,
        "hotel_id"=> (string)$all_data->hotel_id,
        "useremail"=> (string)$all_data->email,
        "usermobile"=> (string)$all_data->number,
        "usercontact"=> "",
        "itemqty"=> $counter,
        "itemtprice"=> number_format((float)$totalamt, 2, '.', ''),
        "sub_total"=> (string)number_format((float)$totalamt, 2, '.', ''),
         "created"=> (string)$all_data->created_at,
        "updated"=> (string)$all_data->updated_at,
          "day"=> (string)$all_data->day,
         "cDiscount"=> $couponMsg,
         "apiDT" => date('Y-m-d H:i:s'),
        "curDate" => $curDate,
         "alert"=> $alert,
        "alertTime"=> date("Y-m-d H:i:s", strtotime($all_data->updated_at) + (10 * 60)),
        "exceed"=>str_replace(':', '', str_replace('-', '', str_replace(' ', '', date("Y-m-d") . " " . $all_data->delivery_time))),
        "apiTime"=> date('H:m'),
        "order_details"=> $extra_data,
        
        
        
"hotel_id" => (string)$all_data->hotel_id,
"hotel_name" => (string)$all_data->hotel_name,
"hotel_address" => (string)$all_data->hotel_address,


"sec" => strtotime(date("Y-m-d") . " " . $all_data->delivery_time) - strtotime(date("Y-m-d H:i:s")),
"ctime"=> (string) $all_data->delivery_time,
"delivery_time"=> (string) $all_data->delivery_time,
"fcmServerKey" => "",
"token" => "",
"delivery_fee" => (string)$all_data->delivery_charges,
        
        
         ];
        
       
        
        // echo (string)$all_data->order_no;
        

   
}



return $data;
    }
    
    
    
       public function OrderTab($id,$hid)
    {
        
        $curDate = date('Y-m-d');
        $preDate = date('d/m/Y');
        
        // echo $preDate;
        
      $data = [];
        $extra_data = [];
        $extra_data1 = [];
        $outer =  DB::table('orders')
            ->join('users', 'users.id', 'orders.user_id')
            ->leftJoin('coupons', 'coupons.id', 'orders.c_id')
            ->leftJoin('addresses', 'addresses.id', 'user_address_id')
            ->join('restaurants', 'restaurants.id', 'orders.hotel_id')
             ->whereDate('orders.excepted_date', DB::raw('CURDATE()'))
            ->whereRaw('orders.hotel_id in (' . $hid . ')')
            ->select('orders.*', 'addresses.home_address','restaurants.id AS hotel_id','restaurants.hotel_name AS hotel_name','restaurants.address AS hotel_address','users.id AS user_id','users.mobile AS user_mobile','users.contact AS user_contact','coupons.discount AS cDiscount')
            ->orderBy('orders.id', 'ASC')
            // ->limit(30)
            ->get();
            
            
        //  echo $outer->toSql();
        //  return;
            
            // print_r($outer);
            
            
              foreach ($outer as $all_data) {
                  
                  
                  
                  
                 
    $extra_data = [];
        $extra_data1 = [];
   
    $orderDetails= DB::table('order_items')
->join('sub_categories', 'sub_categories.id', 'order_items.item_id')
->where('order_no', $all_data->order_no)
->select( 'order_items.*','sub_categories.item_name','sub_categories.price')->get();


        



 foreach ($orderDetails as $all_data1) {
    
    
     $counter = 0;
             $totalamt = 0;
    $extras=[];
    
    
   if($all_data1->extraFor != null || $all_data1->extraFor != "")
    {
        $extras = DB::table('extras')
       ->join('addon_items', 'extras.add_on_id','=', 'addon_items.id')
      ->where('extras.item_id', '=', $all_data1->item_id)
      ->where('extras.order_no', $all_data1->order_no)
      ->where('extras.for', $all_data1->extraFor)
       ->select('*')
      ->get();
    }
    else
    {
        $extras = DB::table('extras')
       ->join('addon_items', 'extras.add_on_id','=', 'addon_items.id')
      ->where('extras.item_id', '=', $all_data1->item_id)
      ->where('extras.order_no', $all_data1->order_no)
       ->select('*')
      ->get();
    }
    
      $extra_data1 = [];


foreach ($extras as $all_data11) {
    
    $totalamt += $all_data11->amount * $all_data11->qty;
    

    $extra_data1[] = [
"add_on_id"=> (string)$all_data11->add_on_id,
"item_id"=> (string)$all_data11->item_id,
"addon_name"=> (string)$all_data11->addon_name,
"qty"=> (string)$all_data11->qty,
"amount"=> (string)$all_data11->amount,
"for"=> (string)$all_data11->for,

         ];
}

$totalamt += $all_data1->price * $all_data1->qty;
$counter +=  $all_data1->qty;

    $extra_data[] = [

 "order_id"=> (string)$all_data1->order_no,
 "item_id"=> (string)$all_data1->item_id,
 "item_name"=> (string)$all_data1->item_name,
 "item_price"=> (string)$all_data1->price,
 "qty"=> (string)$all_data1->qty,
 "amount"=> (string)$all_data1->amount,
 "notes"=> (string)$all_data1->notes,
  "extraFor"=> (string)$all_data1->extraFor,
"extra"=> $extra_data1,
         ];
}

$home_address="";
$alert="";
if($all_data->home_address == null)
{
    $home_address = "";
}
else
{
    $home_address = $all_data->home_address;
}
if (strtotime(date('Y-m-d H:i:s')) > strtotime($all_data->updated_at) + (10 * 60))
            {
                $alert = "1";
            }
            else
            {
                $alert = "0";
            }
            
            
            $couponMsg = "";
            if( $all_data->cDiscount != "")
            {
                $couponMsg = "You have applied coupon of " .$all_data->cDiscount . "% Discount";
            }
            
            
            


    
              $data[] = [
        //   'dummy' => $all_data,
         'order_no' => (string)$all_data->order_no ,
        "id" => (string)$all_data->id,
        "user_id" => (string)$all_data->user_id,
        "username"=>(string)$all_data->name,
        "home_address" => (string)$home_address,
        "user_address_id" =>(string) $all_data->user_address_id,
        "amount"=> (string)number_format((float)$all_data->amount, 2, '.', ''),
        "driver_id"=> (string)$all_data->driver_id,
        "delivery_type"=> (string)$all_data->delivery_type,
        "payment_type"=> (string)$all_data->payment_type,
        "day"=>(string)$all_data->day,
        "time"=> (string)$all_data->time,
        "status" => (string)$all_data->status,
        "discount"=> (string)$all_data->discount,
        "hotel_id"=> (string)$all_data->hotel_id,
        "useremail"=> (string)$all_data->email,
        "usermobile"=> (string)$all_data->number . "/" . (string)$all_data->user_contact . "/" . (string)$all_data->user_mobile,
        "usercontact"=> "",
        "itemqty"=> $counter,
        "itemtprice"=> number_format((float)$totalamt, 2, '.', ''),
        "sub_total"=> (string)number_format((float)$totalamt, 2, '.', ''),
         "created"=> (string)$all_data->created_at,
        "updated"=> (string)$all_data->updated_at,
          "day"=> (string)$all_data->day,
         "cDiscount"=> $couponMsg,
         "apiDT" => date('Y-m-d H:i:s'),
        "curDate" => $curDate,
         "alert"=> $alert,
        "alertTime"=> date("Y-m-d H:i:s", strtotime($all_data->updated_at) + (10 * 60)),
        "exceed"=>str_replace(':', '', str_replace('-', '', str_replace(' ', '', date("Y-m-d") . " " . $all_data->delivery_time))),
        "apiTime"=> date('H:m'),
        "order_details"=> $extra_data,
        
        
        
"hotel_id" => (string)$all_data->hotel_id,
"hotel_name" => (string)$all_data->hotel_name,
"hotel_address" => (string)$all_data->hotel_address,


"sec" => strtotime(date("Y-m-d") . " " . $all_data->delivery_time) - strtotime(date("Y-m-d H:i:s")),
"ctime"=> (string) $all_data->delivery_time,
"delivery_time"=> (string) $all_data->delivery_time,
"fcmServerKey" => "",
"token" => "",
"delivery_fee" => (string)$all_data->delivery_charges,
        
        
         ];
        
       
        
        // echo (string)$all_data->order_no;
        

   
}



return $data;
    }
    
    
    
    
        public function ReportOrderTab($id,$hid,Request $request)
    {
        
        $curDate = date('Y-m-d');
        
      $data = [];
        $extra_data = [];
        $extra_data1 = [];
        $outer =  DB::table('orders')
            ->join('users', 'users.id', 'orders.user_id')
            ->leftJoin('coupons', 'coupons.id', 'orders.c_id')
            ->leftJoin('addresses', 'addresses.id', 'user_address_id')
            ->join('restaurants', 'restaurants.id', 'orders.hotel_id')
            ->whereBetween('orders.created_at', [$request->input('start'), $request->input('end')])
            ->where('user_id', '<>', $id)
            ->whereRaw('orders.hotel_id in (' . $hid . ')')
            ->select('orders.*', 'addresses.home_address','restaurants.id AS hotel_id','restaurants.hotel_name AS hotel_name','restaurants.address AS hotel_address','users.id AS user_id','coupons.discount AS cDiscount')
            ->orderBy('orders.id', 'ASC')
            // ->limit(30)
            ->get();
            
            
        //  echo $outer->toSql();
        //  return;
            
            // print_r($outer);
            
            
              foreach ($outer as $all_data) {
                  
                 
    $extra_data = [];
        $extra_data1 = [];
   
    $orderDetails= DB::table('order_items')
->join('sub_categories', 'sub_categories.id', 'order_items.item_id')
->where('order_no', $all_data->order_no)
->select( 'order_items.*','sub_categories.item_name','sub_categories.price')->get();


        



 foreach ($orderDetails as $all_data1) {
    
    
     $counter = 0;
             $totalamt = 0;
    
    
      $extras = DB::table('extras')
  ->join('addon_items', 'addon_items.id', 'extras.add_on_id')
->where('extras.order_no', $all_data->order_no)
->select( 'extras.*','addon_items.*')->get();


foreach ($extras as $all_data11) {
    
    $totalamt += $all_data11->amount * $all_data11->qty;
    

    $extra_data1[] = [
"add_on_id"=> (string)$all_data11->add_on_id,
"item_id"=> (string)$all_data11->item_id,
"addon_name"=> (string)$all_data11->addon_name,
"qty"=> (string)$all_data11->qty,
"amount"=> (string)$all_data11->amount,

         ];
}

$totalamt += $all_data1->price * $all_data1->qty;
$counter +=  $all_data1->qty;

    $extra_data[] = [

 "order_id"=> (string)$all_data1->order_no,
 "item_id"=> (string)$all_data1->item_id,
 "item_name"=> (string)$all_data1->item_name,
 "item_price"=> (string)$all_data1->price,
 "qty"=> (string)$all_data1->qty,
 "amount"=> (string)$all_data1->amount,
 "notes"=> (string)$all_data1->notes,
"extra"=> $extra_data1,
         ];
}

$home_address="";
$alert="";
if($all_data->home_address == null)
{
    $home_address = "";
}
else
{
    $home_address = $all_data->home_address;
}
if (strtotime(date('Y-m-d H:i:s')) > strtotime($all_data->updated_at) + (10 * 60))
            {
                $alert = "1";
            }
            else
            {
                $alert = "0";
            }
            
            
            $couponMsg = "";
            if( $all_data->cDiscount != "")
            {
                $couponMsg = "You have applied coupon of " .$all_data->cDiscount . "% Discount";
            }
            
            
            


    
              $data[] = [
        //   'dummy' => $all_data,
         'order_no' => (string)$all_data->order_no ,
        "id" => (string)$all_data->id,
        "user_id" => (string)$all_data->user_id,
        "username"=>(string)$all_data->name,
        "home_address" => (string)$home_address,
        "user_address_id" =>(string) $all_data->user_address_id,
        "amount"=> (string)number_format((float)$all_data->amount, 2, '.', ''),
        "driver_id"=> (string)$all_data->driver_id,
        "delivery_type"=> (string)$all_data->delivery_type,
        "payment_type"=> (string)$all_data->payment_type,
        "day"=>(string)$all_data->day,
        "time"=> (string)$all_data->time,
        "status" => (string)$all_data->status,
        "discount"=> (string)$all_data->discount,
        "hotel_id"=> (string)$all_data->hotel_id,
        "useremail"=> (string)$all_data->email,
        "usermobile"=> (string)$all_data->number,
        "usercontact"=> "",
        "itemqty"=> $counter,
        "itemtprice"=> number_format((float)$totalamt, 2, '.', ''),
        "sub_total"=> (string)number_format((float)$totalamt, 2, '.', ''),
         "created"=> (string)$all_data->created_at,
        "updated"=> (string)$all_data->updated_at,
         "cDiscount"=> $couponMsg,
        
         "alert"=> $alert,
        "alertTime"=> date("Y-m-d H:i:s", strtotime($all_data->updated_at) + (10 * 60)),
        "exceed"=>str_replace(':', '', str_replace('-', '', str_replace(' ', '', date("Y-m-d") . " " . $all_data->delivery_time))),
        
        "order_details"=> $extra_data,
        
        
        
"hotel_id" => (string)$all_data->hotel_id,
"hotel_name" => (string)$all_data->hotel_name,
"hotel_address" => (string)$all_data->hotel_address,


"sec" => strtotime(date("Y-m-d") . " " . $all_data->delivery_time) - strtotime(date("Y-m-d H:i:s")),
"ctime"=> (string) $all_data->delivery_time,
"delivery_time"=> (string) $all_data->delivery_time,
"fcmServerKey" => "",
"token" => "",
"delivery_fee" => (string)$all_data->delivery_charges,
        
        
         ];
        
       
        
        // echo (string)$all_data->order_no;
        

   
}



return $data;
    }
    
    
    
    

    public function update($id, Request $request)
    {
        $author = Orders::findOrFail($id);
        $author->update($request->all());

        return response()->json($author, 200);
    }


     public function showByIdorderStatus($id)
    {
        return DB::table('orders')
            ->where('order_no', '=', $id)
            ->join('restaurants', 'restaurants.id', 'orders.hotel_id')
            ->join('users', 'users.id', 'orders.user_id')
            ->join('addresses', 'addresses.id', 'orders.user_address_id')
            ->select('orders.id AS mainId','orders.*','restaurants.*'
            ,'orders.lat AS olat','orders.longt AS olongt'
            ,'addresses.lat AS ulat','addresses.longt AS ulongt','users.*','orders.created_at AS order_created')
            ->get();
    }

    public function delete($id)
    {
        Orders::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
    public function orderdetails(Request $request)
    {
        $data = $request->All();
        $order_details = DB::table('orders')->where(['hotel_id' => $data['hotel_id'],'status' => $data['status']])
        ->get();
        return response()->json(['status'=> "success", 'result' => $order_details]);
    }
     public function orderdetails1(Request $request)
    {
        $data = $request->All();
        $order_details = DB::table('orders')->where(['status' => $data['status']])
         ->orderBy('id', 'DESC')
        ->get();
        return response()->json(['status'=> "success", 'result' => $order_details]);
    }
    public function getOrderdetailsByHotelId(Request $request)
    {
        $data = $request->All();
        $order_details = DB::table('orders')->where(['hotel_id' => $data['hotel_id']])
        ->whereNotIn('status', [0,8])->orderBy('id', 'DESC')
        ->get();
        return response()->json(['status'=> "success", 'result' => $order_details]);
    }
    public function getAllOrderDetails()
    {
        $order_details = DB::table('orders')
        ->orderBy('id', 'DESC')
        ->get();
        return response()->json(['status'=> "success", 'result' => $order_details]);
    }
      public function getAllOrderDetailscustomercare()
    {
        $order_details = DB::table('orders')
        ->where('user_id', '!=', '55')
        ->orderBy('id', 'DESC')
        ->get();
        return response()->json(['status'=> "success", 'result' => $order_details]);
    }
       public function getAllOrderDetailsLimithundered()
    {
        $order_details = DB::table('orders')
        ->orderBy('id', 'DESC')
        ->limit(100)
        // ->select('*',DB::raw("CONCAT(created_at,'id') AS ID"))
        ->get();
        return response()->json(['status'=> "success", 'result' => $order_details]);
    }
       public function getAllOrderbyuser($id)
    {
        $order_details = DB::table('orders')
        ->where('user_id', $id)
        ->limit(100)
        ->get();
        return response()->json(['status'=> "success", 'result' => $order_details]);
    }

}
