<?php
namespace App\Http\Controllers;

use App\Address;
use App\User;
use App\EmpLogin;
use App\Coupon;
use App\Card;
use App\Orders;
use App\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\MyEmail;
use DB;


use Illuminate\Http\JsonResponse;

class CouponController extends Controller
{
    
      public function showAll()
    {
        return response()->json(Coupon::all());
    }
    
    
      public function verify($id,$secKey,$uid)
    {
        //  echo $id;
        
        // $users = [];
        
        
        $users = DB::table('coupons')->where('hotel_id', $id)->where('secKey', $secKey)->where('validity', '>=',date('Y-m-d'))->first();
        
        
    
        
        
        
        if ($users === null) {
         
       return response()->json(['response' => 'fail']);
}
else
{
   $counter = DB::table('orders')->where('user_id', $uid)->where('c_id', $users->id)->get();
       
     
         if($users->usage  == 0)
         {
              return response()->json(['response' => 'success','data' => $users]);
         }
         else if($users->usage  <= $counter->count())
         {
             return response()->json(['response' => 'fail']);
         }
         else
         {
            return response()->json(['response' => 'success','data' => $users]); 
         }  
}
        
         
        
       
    }
      public function getAllcoupons()
    {
         $order_details = DB::table('coupons')
      ->leftjoin('restaurants', 'restaurants.id', '=', 'coupons.hotel_id')
      ->orderBy('coupons.id', 'ASC')
      ->select('coupons.*','restaurants.hotel_name')
      ->get();
        // $order_details = DB::table('coupons')
        // ->orderBy('id', 'DESC')
        // ->get();
        return response()->json(['status'=> "success", 'result' => $order_details]);
    }
    
    
    
    public function create(Request $request)
    {
        // Validate the request...

        $Coupon = new Coupon;
//secKey,discount,amount,validity,status,hotel_id,usage
        $Coupon->secKey = $request->secKey;
         $Coupon->discount = $request->discount;
          $Coupon->amount = $request->amount;
           $Coupon->validity = $request->validity;
            $Coupon->status = $request->status;
             $Coupon->hotel_id = $request->hotel_id;
             $Coupon->usage = $request->usage;

        $Coupon->save();
    }
    
    
    
    public function getmetaData($id,$name)
    {
        
        $data = DB::table('meta_tags')->where('hotel_id', $id)->where('page', $name)->get();
        return response()->json(['status'=> "success", 'result' => $data]);
        
    }
    
      public function getmetaDatah($id)
    {
        
        $data = DB::table('meta_tags')->where('hotel_id', $id)->get();
        return response()->json(['status'=> "success", 'result' => $data]);
        
    }

   
}

