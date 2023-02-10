<?php

namespace App\Http\Controllers;

use App\LinkAddonMenu;
use Illuminate\Http\Request;
use DB;
class LinkAddonMenuController extends Controller
{

    public function showAll()
    {
        return response()->json(LinkAddonMenu::all());
    }
     
    
    public function create(Request $request)
    {
        
        $author = LinkAddonMenu::insert($request->all());

        return response()->json($author, 201);
    }

    public function update($id, Request $request)
    {
        $author = LinkAddonMenu::findOrFail($id);
        $author->update($request->all());

        return response()->json($author, 200);
    }

    public function delete($id)
    {
        LinkAddonMenu::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
 // ranjitha started from here
    public function LinkAddOnMenuBasedOnMenuId(Request $request){
      $data = $request->All();
      $res=  DB::table('link_addon_menus')
      ->where('menu_id','=', $data['menu_id'])
      ->join('addon_items', 'addon_items.id', '=', 'link_addon_menus.addon_id')
      ->get();

    return response()->json(['status'=> "success", 'result' => $res]);
  }
  
  public function updateLinkAddOnMenu($id,Request $request)
  {
    $data = $request->All();
    // print_r($data);exit;
    $linkaddonmenu = LinkAddonMenu::where('menu_id',$id)->update($data);
    // return response()->json(['status'=> "success", 'result' => $linkaddonmenu]);
      return response('Updated Successfully', 200);
  }
  public function linkaddonbasedonmenuhotelids(Request $request)
  {
    $data = $request->All();
    $res=  DB::table('link_addon_menus')
    ->where(['menu_id' => $data['menu_id'],'hotel_id' => $data['hotel_id']])
    ->join('addon_items', 'addon_items.id', '=', 'link_addon_menus.addon_id')
    ->select('link_addon_menus.menu_id', 'link_addon_menus.hotel_id','link_addon_menus.addon_id','link_addon_menus.id','addon_items.addon_name', 'addon_items.addon_price')
    ->get();

    return response()->json(['status'=> "success", 'result' => $res]);
  }
}