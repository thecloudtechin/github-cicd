<?php

namespace App\Http\Controllers;
use DB;
use App\DeliveryCharge;
use App\User;
use Illuminate\Http\Request;

class DeliveryChargeController extends Controller
{

    public function showAll()
    {
        return response()->json(DeliveryCharge::all());
    }

    public function create(Request $request)
    {
        
        $author = DeliveryCharge::create($request->all());

        return response()->json($author, 201);
    }
    
    
    
    
       public function getDC($hid)
    {
        
       $price = DB::table('delivery_charges')
            ->where('hotel_id',$hid)
            ->get();
            return $price;
    }
    
    
    
  
    public function update($id, Request $request)
    {
        $author = DeliveryCharge::findOrFail($id);
        $author->update($request->all());

        return response()->json($author, 200);
    }

    public function delete($id)
    {
        DeliveryCharge::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }

}