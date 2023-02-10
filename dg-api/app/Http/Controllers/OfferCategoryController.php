<?php

namespace App\Http\Controllers;
use DB;
use App\OfferCategory;
use Illuminate\Http\Request;

class OfferCategoryController extends Controller
{

  

    public function all()
    {
        return response()->json(['OfferCategory' => OfferCategory::all()], 200);
    }
    public function getdataById($id)
    {
        $author = OfferCategory::findOrFail($id);
        return response()->json($author, 200);
    }
    
    
    
    //based on hotel get all offer list  only for item no category
    
    
    public function offerCatByHotel($id)
    {
        
        $now = date('Y-m-d');
        
         $data = [];
         $data_table =DB::table('offer_categories')
            ->where('hotel_id', 'like', '%' . $id . '%')
            ->where('based_on_total', '<>', 0)
            ->get();
            
            
            foreach($data_table as $r){
                
                 $offer_lists_table =DB::table('offer_lists')
            ->where('offercategory_id', $r->id)
            ->join('sub_categories','sub_categories.id' , 'offer_lists.item_id')
                ->join('categories','categories.id' , 'categories_id')
            ->where('start_date', '<=', $now)
    ->where('end_date', '>=', $now)
     ->where('item_id', '<>', 0) // add item wise ofer then check else it will come blank
            ->get();
                
                
            
                 $data[] = [
                    
                    "menu"=> $r,
                    "childData"=>  $offer_lists_table,
                    
                    
                    ];
                
                
            }
            
              return response()->json($data, 201);
            
        
    }
    
    
    
    
        public function deals()
    {
        
        $now = date('Y-m-d');
        
         $data = [];
         $data_table =DB::table('offer_categories')
         ->join('restaurants','restaurants.id' , 'hotel_id')
         ->select('restaurants.*','offer_categories.*','offer_categories.id as id','restaurants.id as hotel_id')
            ->get();
            
              return response()->json($data_table, 201);
            
        
    }
    
    
    
    
         public function basedOnTotal($hotel_id)
    {
        
        $data = [];
        
        $author =DB::table('offer_categories')
            ->where('hotel_id', 'like', '%' . $hotel_id . '%')
            ->where('based_on_total', '=', 0)
            ->get();
            
            
            
                foreach($author as $r){
                    
                $items =DB::table('offer_lists')
                ->join('sub_categories','sub_categories.id' , 'offer_lists.item_id')
                ->join('categories','categories.id' , 'categories_id')
                ->where('offercategory_id',  $r->id)
                ->select('offer_lists.*','sub_categories.item_name','sub_categories.price','categories.name AS cat_name')
                ->get();
                
                $data[] = [
                    
                    "id"=> $r->id,
"name" => $r->name,
"delivery_fee"=> $r->delivery_fee,
"min_price"=> $r->min_price,
"discount"=>$r->discount,
"based_on_total"=> $r->based_on_total,
"hotel_id"=> $r->hotel_id,
"status"=> $r->status,
"created_at"=> $r->created_at,
"items"=> $items,
                    
                    
                    ];
                
                
                
                }
            
            
            
            
            return response()->json($data, 201);
    }

    public function create(Request $request)
    {
        $author = OfferCategory::create($request->all());

        return response()->json($author, 201);
    }

    public function update($id, Request $request)
    {
        $author = OfferCategory::findOrFail($id);
        $author->update($request->all());

        return response()->json($author, 200);
    }

  

    public function delete($id)
    {
        OfferCategory::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }

}
