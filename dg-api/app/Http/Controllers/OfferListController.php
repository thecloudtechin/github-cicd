<?php

namespace App\Http\Controllers;
use DB;
use App\OfferList;
use Illuminate\Http\Request;

class OfferListController extends Controller
{

  

    public function all()
    {
        return response()->json(['OfferList' => OfferList::all()], 200);
    }
    
     public function basedOnItemOffer($id,$hotel_id)
    {
        $author =DB::table('offer_categories')
            ->join('offer_lists', 'offer_lists.offercategory_id', '=', 'offer_categories.id')
            ->where('item_id', '=', $id)
            ->where('hotel_id', '=', $hotel_id)
            ->where('offer_lists.status', '=', 0)
            ->get();
            return response()->json($author, 200);
    }
    
     public function basedOnItemOfferWithOutItem($hotel_id)
    {
        
        $innternalData = [];
        $author =DB::table('offer_categories')
            ->where('hotel_id', '=', $hotel_id)
            ->where('status', '=', 0)
            ->where('based_on_total', 1)
            ->get();
            
            if(count($author) > 0)
            {
                
                foreach($author as $author_data)
                {
                    
                   $data = DB::table('offer_lists')
            ->where('offercategory_id', '=', $author_data->id)
            ->where('status', '=', 0)
            ->get(); 
            
             $innternalData []= [
                 
                 "id"=>$author_data->id,
         "name"=>$author_data->name,
         "delivery_fee"=>$author_data->delivery_fee,
         "min_price"=>$author_data->min_price,
         "discount"=>$author_data->discount,
         "based_on_total"=>$author_data->based_on_total,
         "hotel_id"=>$author_data->hotel_id,
         "status"=>$author_data->status,
         "created_at"=>$author_data->id,
         "master_id"=>$author_data->master_id,
                 'list'=>$data
                 
                 
                 ];
            
            
            
                }
                
                
                
            }
            
            
            
            return response()->json($innternalData, 200);
    }

    
    public function getdataById($id)
    {
        $author = OfferList::findOrFail($id);
        return response()->json($author, 200);
    }

    public function create(Request $request)
    {
        $author = OfferList::create($request->all());

        return response()->json($author, 201);
    }

    public function update($id, Request $request)
    {
        $author = OfferList::findOrFail($id);
        $author->update($request->all());

        return response()->json($author, 200);
    }

  

    public function delete($id)
    {
        OfferList::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }

}
