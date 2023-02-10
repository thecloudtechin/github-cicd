<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Bookingtable;
use App\Restaurants;
use App\Invoice;
use Illuminate\Http\Request;
use DB;

class BookingtableController extends Controller
{
    

    public function showAllRestaurants()
    {
        return response()->json(Bookingtable::all());
    }
    
  
    public function create(Request $request)
    {
        
        $count = Bookingtable::where('created_date', $request->input('created_date'))
        ->where('timing', $request->input('timing'))
        ->where('table_type', $request->input('table_type'))
        ->where('hotel_id', $request->input('hotel_id'))
        ->get()->count();
        
        
        if( $request->input('table_type') == '2' && $count <= 3)
        {
            $name = $request->input('fname');
        $hotel_name = $request->input('hotel_name');
        $hotel_email = $request->input('hotel_email');
        $email = $request->input('email');
        
        
        $path  = "https://deliveryguru.co.uk/images/hotelogo/" . $request->input('hotel_id') .".png";
        

        $author = Bookingtable::create($request->all());
           $data = array('name'=>$name,'hotel_name'=>$hotel_name,'email'=>$email,'hotel_email'=>$hotel_email,'phonenumber'=>$request->input('phonenumber'), 'time'=>$request->input('time') ,'timing'=>$request->input('timing') ,'bookingtime'=>$request->input('bookingtime') ,'bookingid'=>$request->input('bookingid') ,'person'=>$request->input('person'),'created_date'=>$request->input('created_date'),'hotel_id'=>$request->input('hotel_id'),'path'=>$path);
                 
                Mail::send('mail', $data, function($message) use ($data) {
                    
                
                $message->to($data['email'], $data['name'])->subject('You have Book a table');
                $message->from($data['hotel_email'],$data['hotel_name']);
                });
                return response()->json($author, 201);
        }
        else if( $request->input('table_type') =='6' && $count <= 4)
        {
            $name = $request->input('fname');
        $hotel_name = $request->input('hotel_name');
        $hotel_email = $request->input('hotel_email');
        $email = $request->input('email');
        
        
        $path  = "https://deliveryguru.co.uk/images/hotelogo/" . $request->input('hotel_id') .".png";
        

        $author = Bookingtable::create($request->all());
           $data = array('name'=>$name,'hotel_name'=>$hotel_name,'email'=>$email,'hotel_email'=>$hotel_email,'phonenumber'=>$request->input('phonenumber'), 'time'=>$request->input('time') ,'timing'=>$request->input('timing') ,'bookingtime'=>$request->input('bookingtime') ,'bookingid'=>$request->input('bookingid') ,'person'=>$request->input('person'),'created_date'=>$request->input('created_date'),'hotel_id'=>$request->input('hotel_id'),'path'=>$path);
                 
                Mail::send('mail', $data, function($message) use ($data) {
                    
                
                $message->to($data['email'], $data['name'])->subject('You have Book a table');
                $message->from($data['hotel_email'],$data['hotel_name']);
                });
                return response()->json($author, 201);
        }
        else
        {
            return response()->json($count, 500);
        }
        
        
                
        
    }
    
    
    
    
    public function confirm($id, Request $request)
    {
        $author = Bookingtable::findOrFail($id);
         $author->update($request->all());
         
         
         $Restaurants_author = Restaurants::findOrFail($author->hotel_id);
        
        $data = array('name'=>$author->name,'email'=>$author->email,'hotel_name'=>$Restaurants_author->hotel_name,'hotel_email'=>$Restaurants_author->hotel_email,
        'phonenumber'=>$author->phonenumber, 'time'=>$author->time ,'timing'=>$author->timing ,
        'bookingtime'=>$author->bookingtime ,'bookingid'=>$author->bookingid ,'person'=>$author->person,
        'created_date'=>$author->created_date,'hotel_id'=>$author->hotel_id,'path'=>'');
                 
                Mail::send('mail', $data, function($message) use ($data) {
                    
                
                $message->to($data['email'], $data['name'])->subject('Confirmation of booking id ' . $data['bookingid']);
                $message->from($data['hotel_email'],$data['hotel_name']);
                });
                return response()->json($author, 201);
        
    }
    
    
     public function checkavalability(Request $request)
    {
        $getcheck=Bookingtable::where('created_date', $request->input('created_date'))
        ->where('timing', $request->input('timing'))
        ->where('table_type', $request->input('table_type'))
        ->where('hotel_id', $request->input('hotel_id'))
        ->get()->count();
        return $getcheck;
    }
    


    public function delete($id)
    {
        Bookingtable::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
    
     public function update($id, Request $request)
    {
        try {
        $author = Bookingtable::findOrFail($id);
        $author->update($request->all());

        return response()->json($author, 200);
        } catch (\Throwable $e) {
            
            return response()->json([
                'error' => [
                    'description' => $e->getMessage()
                ]
            ], 500);
            
        }
    }
 
   
}
