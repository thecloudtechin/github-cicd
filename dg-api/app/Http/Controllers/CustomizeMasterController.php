<?php

namespace App\Http\Controllers;

use App\CustomizeMaster;
use Illuminate\Http\Request;
use DB;
class CustomizeMasterController extends Controller
{

    public function showAll()
    {
        return response()->json(CustomizeMaster::all());
    }
     
    
    // public function create(Request $request)
    // {


    //     $this->validate($request, [

    //         'name' => 'required|string|unique:categories',
    //     ]);
    //     $author = CustomizeMaster::create($request->all());

    //     return response()->json($author, 201);
    // }
    
    public function getHotelIdCategory (Request $request)
    {
        $data = $request->All();
        $result = array ('success' => false, 'result' => array (), 'errors' => array ());
        $errors = array();
        try {
            if (empty($data['hotel_id'])) {
                $errors[] = 'hotel id is required';
            }
            if (!count($errors)) {
                $res = DB::table('customize_masters')->where(array('hotel_id' => $data['hotel_id']))->get();
                $result['success'] = true;
                $result['result'] = $res;
            }
        } catch (Exception $e) {
            $errors[] = 'Something went wrong, Please try after some time';
        }
        $result['errors'] = $errors;
        return response()->json($result);
    }
    public function create(Request $request)
    {
        $author = new CustomizeMaster;
        $author->id = $request->input('id');
        $author->hotel_id = $request->input('hotel_id');
        $author->name = $request->input('name');
        $author->selectoption = $request->input('selectoption');
        $author->status = '0';

        $author->save();

        //return successful response
        return response()->json(['category' => $author, 'message' => 'CREATED'], 201);

        
    }

    public function update($id, Request $request)
    {
        $author = CustomizeMaster::findOrFail($id);
        $author->update($request->all());

        return response()->json($author, 200);
    }

    public function delete($id)
    {
        CustomizeMaster::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
    public function customizeMasterBasedOnHotelId (Request $request)
    {
        $data = $request->All();
      $author = DB::table('sub_categories')
                  ->where('categories_id','=',$data['categories_id'])
                  ->join('addon_multi_select','sub_categories.id','=','addon_multi_select.menuid')
                //   ->join('addon_multi_select','sub_categories.id','=','addon_multi_select.menuid')
                  ->leftJoin('customize_masters','customize_masters.id','=','addon_multi_select.addoncatid')
                  ->select('sub_categories.item_name','addon_multi_select.*','customize_masters.name')
                  ->get();
    
    
    // $author = DB::table('link_addon_menus')
    //   ->join('addon_items', 'addon_items.id','=', 'link_addon_menus.addon_id')
    //   ->where('hotel_id', '82')
    //   ->where('menu_id', '11836')
    //   ->where('addon_items.addoncat', $data['categories_id'])
    //   ->select('link_addon_menus.*','addon_name AS label','addon_name AS addon_name')
    //   ->get();
                  
        return response()->json($author);
   }
   public function getaddonItem (Request $request)
    {
        $data = $request->All();
     $author = DB::table('link_addon_menus')
      ->join('addon_items', 'addon_items.id','=', 'link_addon_menus.addon_id')
      ->where('hotel_id', $data['hotel_id'])
       ->where('menu_id', $data['menu_id'])
      ->where('addon_items.addoncat', $data['categories_id'])
      ->select('link_addon_menus.*','addon_name AS label','addon_name AS addon_name')
      ->get();
      return response()->json($author);
    }
   
   

}