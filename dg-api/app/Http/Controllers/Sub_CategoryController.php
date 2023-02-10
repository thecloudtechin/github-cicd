<?php

namespace App\Http\Controllers;

use App\SubCategory;
use Illuminate\Http\Request;
use DB;
class Sub_CategoryController extends Controller
{

    public function showAll()
    {
        return response()->json(SubCategory::all());
    }

//   public function menuBundle($id)
//     {
//         $cat_array = [];
//         $sub_cat_array = [];
//         $extra_array = [];
//         $categories =DB::table('categories')
//             ->where('hotel_id', '=', $id)
//             ->where('status', '=', 0)
//             ->orderBy('orderby', 'ASC')
//             ->get();


//             foreach ($categories as $all_data) {
                
                
//                 $subcat_details = DB::table('sub_categories')->where(['categories_id' => $all_data->id])
//             ->get();
            
            
//                         foreach ($subcat_details as $subcat_details_data) {
                        
                        
//                         $customize_masters = DB::table('addon_multi_select')
//                         ->join('customize_masters', 'customize_masters.id', 'addon_multi_select.addoncatid')
//                         ->select('addon_multi_select.*','customize_masters.name','customize_masters.id AS cat_id')->get();
                        
                        
//                         foreach ($customize_masters as $customize_masters_data) {
//                              $extra_array[] = [
                                 
//                                  'id' => $customize_masters_data->id,
//                         'cat_id' => $customize_masters_data->cat_id,
//                         'count' => $customize_masters_data->count,
//                         'maxcount' => $customize_masters_data->maxcount,
//                         'add_on_desc' => $customize_masters_data->add_on_desc,
//                         'name' => $customize_masters_data->name
                                 
//                                  ];
//                         }
                        
                        
                        
                        
                        
                        
                        
//                         $sub_cat_array []= [
                        
//                         'id'=> $subcat_details_data->id,
//                         'item_name'=> $subcat_details_data->item_name,
//                         'item_desc'=> $subcat_details_data->item_desc,
//                         'price'=> $subcat_details_data->price,
//                         'categories_id'=> $subcat_details_data->categories_id,
//                         'image'=> $subcat_details_data->image,
//                         'discount'=> $subcat_details_data->discount,
//                         'parent'=> $subcat_details_data->parent,
                        
//                         ];
                        
//                         }
            
   
    
//                     $cat_array[] = [
                    
//                     'id'=> $all_data->id,
//                     'name'=> $all_data->name,
//                     'cat_desc'=> $all_data->cat_desc,
//                     'discount'=>$all_data->discount,
//                     'sub_menu'=>$sub_cat_array
//                     ];
               
               
               
//             }
//             return response()->json($cat_array, 200);
           
//     }
    public function addSubCategory(Request $request)
    {
        $sub_categories = new SubCategory;
        $sub_categories->item_name = $request->input('item_name');
        $sub_categories->item_desc = $request->input('item_desc');
        $sub_categories->categories_id = $request->input('categories_id');
        $sub_categories->price = $request->input('price');
        $sub_categories->status = $request->input('status');
        $sub_categories->discount = $request->input('discount');
        $sub_categories->image = $request->file('image');
        $image = $request->file('image');

        $fileName = $sub_categories->image->getClientOriginalName();
        $destinationPath = 'public/uploads';
        $sub_categories->image->move($destinationPath,$sub_categories->image->getClientOriginalName());
        $sub_categories->image = $fileName;

        $sub_categories->save();
        return response()->json(['sub_categories' => $sub_categories, 'message' => 'CREATED'], 201);
    }

   public function updateSubCategory($id, Request $request)
    {
        // print_r($id);exit;
        $author = SubCategory::findOrFail($id);
        $data = $request->all();
        $file = $request->file('image');
        if (!empty($file)) {
            $destinationPath = 'public/uploads';
            $file->move($destinationPath,$file->getClientOriginalName());
            $data['image'] = $file->getClientOriginalName();
        }        
        $images=array();
        // print_r($data);exit;
        $author->update($data);
        return response()->json($author, 200);
        return response('Updated Successfully', 200);

    }

    public function showById($id)
    {
        $author = SubCategory::where(['categories_id' => $id])->where('status', '=', 0)->get();
        // echo $author->toSql();
        return response()->json($author, 200);
    }
     public function showChildData($id)
    {
        $author = SubCategory::where(['parent' => $id])->orderBy('orderby', 'ASC')->get();
        // echo $author->toSql();
        return response()->json($author, 200);
    }
    
    
     public function showallmenus($id)
    {
        $author =DB::table('categories')
            ->join('sub_categories', 'sub_categories.categories_id', '=', 'categories.id')
            ->where('hotel_id', '=', $id)
            ->where('status', '=', 0)
            ->get();
            return response()->json($author, 200);
    }

    public function delete($id)
    {
        SubCategory::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
     public function randomSearchByFood (Request $request)
    {
        $data = $request->All();
        $res = SubCategory::select("sub_categories.*")
                ->where("item_name","LIKE","%{$data['item_name']}%")
                ->get();
        return response()->json($res);
    }
    public function getDetailsBasedOnCatId (Request $request)
        {
            $data = $request->All();
            
            $subcat_details = DB::table('sub_categories')->where(['categories_id' => $data['categories_id']])
            ->get();
            
            return response()->json($subcat_details);
        }
        public function getDetailsBasedOnCatId1 (Request $request)
        {
            $data = $request->All();
            
            $subcat_details = DB::table('sub_categories')->where(['categories_id' => $data['categories_id'],'status' => '1'])
            ->get();
            
            return response()->json($subcat_details);
        }
}
