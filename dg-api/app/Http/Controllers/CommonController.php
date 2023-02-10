<?php
namespace App\Http\Controllers;

use App\Address;
use App\Usedcoupon;
use App\User;
use App\EmpLogin;
use App\Extra;
use App\Card;
use App\Orders;
use App\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\MyEmail;
use DB;
use Illuminate\Support\Facades\Log;
//  use Vluzrmos\SlackApi\Facades\SlackApi;
use Illuminate\Http\JsonResponse;

class CommonController extends Controller
{

    public  function placeOrder1(Request $request): JsonResponse
    {
        
        // return response()->json(['error' => null], 201);
    }
    
    
    public function ss()
    {
        
    //     $message = "data";
    //   Log::info('Showing user profile for user: ');
      Log::channel('slack')->info('Testing!');
    //   Log::emergency($message);
// Log::alert($message);
// Log::critical($message);
// Log::error($message);
// Log::warning($message);
// Log::notice($message);
// Log::info($message);
// Log::debug($message);
       return response()->json(['error' => null], 201);
    }
    
    
     public function SecureplaceOrder(Request $request): JsonResponse
    {

       
try{
        $order = Orders::create($request->input('order'));
        $order->created_at = date('Y-m-d H:i:s');
        $order->updated_at = date('Y-m-d H:i:s');
        
        
        

        $requestData = $request->input('orderItem');
        foreach ($requestData as $key => $val)
        {
            
            // $price = DB::table('sub_categories')->where('id', $requestData[$key]['item_id'])->select('price')->get();
            
            $requestData[$key]['order_no'] = $request->input('order') ['order_no'];
            // $requestData[$key]['amount'] = floatval($price[0]->price);
            
        }
        $orderItem = OrderItem::insert($requestData);

        if ($request->filled('extra'))
        {
            $requestData_extra = $request->input('extra');
            foreach ($requestData_extra as $key => $val)
            {
                $requestData_extra[$key]['order_no'] = $request->input('order') ['order_no'];
            }
            $extra_items = Extra::insert($requestData_extra);
        }
        
        
        
        //  if ($request->filled('coupon'))
        // {
        //     $requestData_coupon = $request->input('coupon');
            
        //     $coupon_items = Usedcoupon::insert($requestData_coupon);
        // }
        
        
        $deliverytype = "Collection";
        if($request->input('order') ['delivery_type'] == '0')
        {
            $deliverytype = "Delivery";
        }
        
         Log::channel('slack')->info('New Order Received in *'.$request->input('hotel_name') . '* made by *' .$request->input('order') ['name'] . '* number *'.$request->input('order') ['number'] .'* email *'. $request->input('order') ['email'] .'* Order NO : *' . $request->input('order') ['order_no'] .'* with discount of *' . $request->input('order') ['discount'] . '* And  Grand Total is *'. $request->input('order') ['amount']. '* Delivery Type *'. $deliverytype . '*  Payment Type *'. $request->input('order') ['payment_type'].'* ' );
        
    } catch (\Throwable $e) {
        
        
        
        Log::channel('slack')->info('Error Received in place Order '. $e );
            
            return response()->json([
                'error' => [
                    'description' => $e->getMessage()
                ]
            ], 500);
            
        }

        return response()->json(['error' => null,'order' => $order], 201);
    }
    
    public function placeOrder(Request $request): JsonResponse
    {

       
try{
        $order = Orders::create($request->input('order'));
        $order->created_at = date('Y-m-d H:i:s');
        $order->updated_at = date('Y-m-d H:i:s');
        
        
        

        $requestData = $request->input('orderItem');
        foreach ($requestData as $key => $val)
        {
            $requestData[$key]['order_no'] = $request->input('order') ['order_no'];
        }
        $orderItem = OrderItem::insert($requestData);

        if ($request->filled('extra'))
        {
            $requestData_extra = $request->input('extra');
            foreach ($requestData_extra as $key => $val)
            {
                $requestData_extra[$key]['order_no'] = $request->input('order') ['order_no'];
            }
            $extra_items = Extra::insert($requestData_extra);
        }
         if ($request->filled('coupon'))
        {
            $requestData_coupon = $request->input('coupon');
            
            $coupon_items = Usedcoupon::insert($requestData_coupon);
        }
        
        
        $deliverytype = "Collection";
        if($request->input('order') ['delivery_type'] == '0')
        {
            $deliverytype = "Delivery";
        }
        
         Log::channel('slack')->info('New Order Received in *'.$request->input('hotel_name') . '* made by *' .$request->input('order') ['name'] . '* number *'.$request->input('order') ['number'] .'* email *'. $request->input('order') ['email'] .'* Order NO : *' . $request->input('order') ['order_no'] .'* with discount of *' . $request->input('order') ['discount'] . '* And  Grand Total is *'. $request->input('order') ['amount']. '* Delivery Type *'. $deliverytype . '*  Payment Type *'. $request->input('order') ['payment_type'].'* ' );
        
    } catch (\Throwable $e) {
        
        
        
        Log::channel('slack')->info('Error Received in place Order '. $e );
            
            return response()->json([
                'error' => [
                    'description' => $e->getMessage()
                ]
            ], 500);
            
        }

        return response()->json(['error' => null,'order' => $order], 201);
    }
    

    public function mailHotelInvoice($values)
    {
        // print_r($values);exit;
        $to_name = 'DG INVOICE';
        $to_email = $values['to_email'];
        $values = ['hotel_refid' => $values];
        Mail::send(['html' => 'hotel_invoice'], $values, function ($message) use ($to_name, $to_email)
        {
            $message->to($to_email, $to_name)->subject('deliveryguru');
            $message->from('order@deliveryguru.co.uk', 'deliveryguru');
        });
        return true;
    }

}

