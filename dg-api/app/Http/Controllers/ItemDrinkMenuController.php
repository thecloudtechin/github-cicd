<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;


// use App\LinkAddonMenu;
use Illuminate\Http\Request;

class ItemDrinkMenuController extends Controller
{

   public function addon_list($id,$hotelid)
  {
      
      $users = DB::table('addon_multi_select')
      ->leftjoin('customize_masters', 'customize_masters.id', '=', 'addon_multi_select.addoncatid')
      ->where('menuid',$id)
      ->where('customize_masters.hotel_id',$hotelid)
      ->select('addon_multi_select.*','customize_masters.name AS title','customize_masters.id AS cat_id')
      ->orderBy('addon_multi_select.orderby', 'ASC')
      ->get();
      $internaldata = [];
      
      foreach ($users as $items_data) {
    $extra = DB::table('link_addon_menus')
      ->join('addon_items', 'addon_items.id','=', 'link_addon_menus.addon_id')
      ->where('hotel_id', $hotelid)
      ->where('menu_id', $id)
      ->where('addon_items.addoncat', $items_data->cat_id)
      ->select('*','link_addon_menus.id AS link_addon_menus_id','addon_name AS label','addon_name AS addon_name',DB::raw("CONCAT(addon_items.id,',',REPLACE(addon_items.addon_name, ',', ' '),',',addon_items.addon_price,',',$items_data->cat_id)  AS value"))
       ->orderBy('link_addon_menus.orderby', 'ASC')
      ->get();
      $extraCount = $extra->count();
      
$internaldata[] = [
'id'=> $items_data->id,
'menuid'=> $items_data->menuid,
'hotelid'=> $items_data->hotelid,
'count'=> $items_data->count,
'maxcount'=>$items_data->maxcount,
'add_on_desc'=> $items_data->add_on_desc,
'status'=> $items_data->status,
'title'=> $items_data->title,
'cat_id'=> $items_data->cat_id,
'orderby'=> $items_data->orderby,
 'extra'=>$extra,
  'extraCount'=>$extraCount,
    ];
}
        return response()->json(['addon'=> $internaldata ],201);
    }
    
    
    
    
     public function basedOnCatId($id,$hotelid)
  {
      $items = [];
      $basedoncatid = DB::table('sub_categories')
      ->where('parent',$id)
      ->get();
      
      
      if(count($basedoncatid) > 0)
{   
    
    foreach($basedoncatid as $basedoncatid_data)
      {
          $users = DB::table('addon_multi_select')
      ->leftjoin('customize_masters', 'customize_masters.id', '=', 'addon_multi_select.addoncatid')
      ->where('menuid',$basedoncatid_data->id)
      ->where('customize_masters.hotel_id',$hotelid)
      ->select('addon_multi_select.*','customize_masters.name AS title','customize_masters.id AS cat_id')
      ->orderBy('addon_multi_select.orderby', 'ASC')
      ->get();
      $internaldata = [];
      

      
      foreach ($users as $items_data) {
    $extra = DB::table('link_addon_menus')
      ->join('addon_items', 'addon_items.id','=', 'link_addon_menus.addon_id')
      ->where('hotel_id', $hotelid)
      ->where('menu_id', $basedoncatid_data->id)
      ->where('addon_items.addoncat', $items_data->cat_id)
      ->select('*','link_addon_menus.id AS link_addon_menus_id','addon_name AS label','addon_name AS addon_name',DB::raw("CONCAT(addon_items.id,',',REPLACE(addon_items.addon_name, ',', ' '),',',addon_items.addon_price,',',$items_data->cat_id)  AS value"))
       ->orderBy('link_addon_menus.orderby', 'ASC')
      ->get();
      $extraCount = $extra->count();
      
$internaldata[] = [
'id'=> $items_data->id,
'menuid'=> $items_data->menuid,
'hotelid'=> $items_data->hotelid,
'count'=> $items_data->count,
'maxcount'=>$items_data->maxcount,
'add_on_desc'=> $items_data->add_on_desc,
'status'=> $items_data->status,
'title'=> $items_data->title,
'cat_id'=> $items_data->cat_id,
'orderby'=> $items_data->orderby,
 'extra'=>$extra,
  'extraCount'=>$extraCount,
    ];
}


      $items[] = [
          'child'=> true,
'menu'=> $basedoncatid_data,
'menu_addon'=> $internaldata,
];
      }
    
    
}
else
{
    
              $users = DB::table('addon_multi_select')
      ->leftjoin('customize_masters', 'customize_masters.id', '=', 'addon_multi_select.addoncatid')
      ->where('menuid',$id)
      ->where('customize_masters.hotel_id',$hotelid)
      ->select('addon_multi_select.*','customize_masters.name AS title','customize_masters.id AS cat_id')
      ->orderBy('addon_multi_select.orderby', 'ASC')
      ->get();
      $internaldata = [];
      

      
      foreach ($users as $items_data) {
    $extra = DB::table('link_addon_menus')
      ->join('addon_items', 'addon_items.id','=', 'link_addon_menus.addon_id')
      ->where('hotel_id', $hotelid)
      ->where('menu_id', $id)
      ->where('addon_items.addoncat', $items_data->cat_id)
      ->select('*','link_addon_menus.id AS link_addon_menus_id','addon_name AS label','addon_name AS addon_name',DB::raw("CONCAT(addon_items.id,',',REPLACE(addon_items.addon_name, ',', ' '),',',addon_items.addon_price,',',$items_data->cat_id)  AS value"))
       ->orderBy('link_addon_menus.orderby', 'ASC')
      ->get();
      $extraCount = $extra->count();
      
$internaldata[] = [
'id'=> $items_data->id,
'menuid'=> $items_data->menuid,
'hotelid'=> $items_data->hotelid,
'count'=> $items_data->count,
'maxcount'=>$items_data->maxcount,
'add_on_desc'=> $items_data->add_on_desc,
'status'=> $items_data->status,
'title'=> $items_data->title,
'cat_id'=> $items_data->cat_id,
'orderby'=> $items_data->orderby,
 'extra'=>$extra,
  'extraCount'=>$extraCount,
    ];
}


      $items[] = [
           'child'=> false,
'menu_addon'=> $internaldata,
];
    
    
    
}
      
      
      



        return response()->json($items,201);
    }
    
    
    

    //based on menu id get drinkmenu
    public function showAll($id)
  {
        $addon = DB::table('link_addon_menus')
            ->join('addon_items', 'addon_items.id', '=', 'link_addon_menus.addon_id')
            ->join('customize_masters', 'customize_masters.id', '=', 'addon_items.addoncat')
              ->where('menu_id', '=', $id)
            ->select('link_addon_menus.*','customize_masters.name','addon_items.addon_name','addon_items.addon_price', DB::raw("CONCAT(addon_items.addon_name,'  (£',addon_items.addon_price,')')  AS label"),DB::raw("CONCAT(addon_items.id,',',addon_items.addon_name,',',addon_items.addon_price)  AS value"))
              ->orderBy('addon_items.addoncat', 'ASC') // id from "rows" table
            ->get();
        return response()->json(['addon'=> $addon ],201);
    }
    public function foodItemAddOn($id)
    {
      $addon = DB::table('link_addon_menus')
      ->join('addon_items', 'addon_items.id', '=', 'link_addon_menus.addon_id')
      ->join('customize_masters', 'customize_masters.id', '=', 'addon_items.addoncat')
        ->where('menu_id', '=', $id)
      ->select('link_addon_menus.*','customize_masters.name','addon_items.addon_name','addon_items.addon_price', DB::raw("CONCAT(addon_items.addon_name,'  (£',addon_items.addon_price,')')  AS label"),DB::raw("CONCAT(addon_items.id,',',addon_items.addon_name,',',addon_items.addon_price)  AS value"))
        ->orderBy('addon_items.addoncat', 'ASC') // id from "rows" table
      ->get();
      $res_arr = [];
      foreach ($addon as $objAddon)
      {
        $childs = array('id' => $objAddon->id,
          'addon_id' => $objAddon->addon_id,
          'menu_id' => $objAddon->menu_id,
          'hotel_id' => $objAddon->hotel_id,
          'created_at' => $objAddon->created_at,
          'updated_at' => $objAddon->updated_at,
          'addon_name' => $objAddon->addon_name,
          'addon_price' => $objAddon->addon_price,
          'label' => $objAddon->label,
          'sideName' => $objAddon->name,
          'value' => $objAddon->value
        );
        $res_arr[$objAddon->name][] = (object)$childs;
      }
      return array_values($res_arr);// response()->json(['addon'=> $res_arr ],201);
    // return response()->json(array('totalResult' => $res_arr), 200);

    }
   

}

