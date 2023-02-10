<?php
namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use DB;
class CategoryController extends Controller
{

    public function showAll()
    {
        return response()->json(Category::all());
    }
    public function categoryByHotel(Request $request)
    {
        $catlist = DB::table('hotel_categories')->where('hotel_categories.hotel_id', '=', $request->input('hotelid'))
            ->join('categories', 'hotel_categories.cat_id', '=', 'categories.id')
            ->select('categories.name', 'categories.id', 'categories.cat_desc', 'categories.status', 'categories.discount', 'hotel_categories.hotel_id')
            ->get();

        return response()
            ->json($catlist);
    }
    public function AllCat_SubCatold()
    {
        //['users' =>  User::all()], 200
        $data = [];
        foreach (Category::all() as $all_data)
        {
            $data[] = ['name' => $all_data->name, 'subcat' => Category::find($all_data->id)->subcatogeries];
        }
        return $data;
    }

    public function AllCat_ByHID($id)
    {
if($id == '62' || $id == 62){
     

        return response()
            ->json([]);
}
else
{
     $catlist = DB::table('categories')->where('hotel_id', $id)->where('status', '=', 0)
            ->orderBy('categories.orderby', 'ASC')
            ->get();

        return response()
            ->json($catlist);
}
       
    }
    public function AllSubCat_ByCatID($id)
    {
  $data = [];
         foreach (DB::table('sub_categories')->join('categories', 'sub_categories.categories_id', '=', 'categories.id')
            ->where('categories_id', $id)->where('price', '!=', '0')
            
            ->select('sub_categories.*', 'categories.discount AS discount')
            ->get() as $all_data)
            {
                 $data_ =  DB::table('sub_categories')->where('parent', $all_data->id)
                ->count();
                
                if($data_ == 0){
                $data[] = $all_data;
                }
                
                
            }
            
           
        
           

        return response()
            ->json($data);
    }

    public function AllCat_SubCat($id)
    {

        $data = [];

        foreach (DB::table('categories')->where('hotel_id', $id)->where('status', '=', 0)
            ->orderBy('orderby', 'ASC')
            ->get() as $all_data)
        {
            $data[] = ['name' => $all_data->name, 'id' => $all_data->id, 'discount' => $all_data->discount,'desc'=>$all_data->cat_desc, 'orderby' => $all_data->orderby, 'value' => DB::table('sub_categories')
                ->where('categories_id', $all_data->id)
                ->where('parent', '0')
                 ->orderBy('orderby', 'ASC')
                ->where('status', '0')
                ->get() ];
        }

        return $data;
    }
      public function AllCat_SubCat2($id)
    {

        $data = [];

        foreach (DB::table('categories')->where('hotel_id', $id)
            ->orderBy('orderby', 'ASC')
            ->get() as $all_data)
        {
            $data[] = ['name' => $all_data->name, 'id' => $all_data->id, 'discount' => $all_data->discount,'catstatus' => $all_data->status, 'orderby' => $all_data->orderby, 'value' => DB::table('sub_categories')
                ->where('categories_id', $all_data->id)
                ->where('parent', '0')
                ->where('status', '0')
                ->get() ];
        }

        return $data;
    }
     public function AllCat_SubCat1($id)
    {

        $data = [];

        foreach (DB::table('categories')->where('hotel_id', $id)->where('status', '=', 0)
            ->orderBy('orderby', 'ASC')
            ->get() as $all_data)
        {
            $data[] = ['name' => $all_data->name, 'id' => $all_data->id, 'discount' => $all_data->discount, 'orderby' => $all_data->orderby, 'orderby' => $all_data->orderby,'catdesc' => $all_data->cat_desc ,'value' => DB::table('sub_categories')
                ->where('categories_id', $all_data->id)
                ->get() ];
        }

        return $data;
    }

    public function menuDetailWeb($id)
    {

        $data = [];
           $submenudata  = array();

        foreach (DB::table('categories')->where('hotel_id', $id)->where('status', '=', 0)
            ->orderBy('orderby', 'ASC')
            ->get() as $all_data)
        {

            $submenu = DB::table('sub_categories')->where('categories_id', $all_data->id)
                ->where('parent', '0')
                ->get();
                
                foreach ($submenu as $submenuall_data)
        {
            $users = DB::table('addon_multi_select')
      ->leftjoin('customize_masters', 'customize_masters.id', '=', 'addon_multi_select.addoncatid')
      ->where('menuid',$submenuall_data->id)
      ->where('customize_masters.hotel_id',$id)
      ->select('addon_multi_select.*','customize_masters.name AS title','customize_masters.id AS cat_id')
      ->orderBy('addon_multi_select.id', 'ASC')
      ->get();
      
      
    //   echo $users->count();
      
      
      if($users->count() == 0)
      {
            array_push($submenudata,(object)[
        'submenu' => $submenuall_data,
         
    ]);
      }
      else
        {
      foreach ($users as $items_data) {
    $extra = DB::table('link_addon_menus')
      ->join('addon_items', 'addon_items.id','=', 'link_addon_menus.addon_id')
      ->where('hotel_id', $id)
      ->where('menu_id', $submenuall_data->id)
      ->where('addon_items.addoncat', $items_data->cat_id)
      ->select('*','addon_name AS label','addon_name AS addon_name',DB::raw("CONCAT(addon_items.id,',',REPLACE(addon_items.addon_name, ',', ' '),',',addon_items.addon_price,',',$items_data->cat_id)  AS value"))
      ->get();
      $extraCount = $extra->count();
      

    
    array_push($submenudata,(object)[
        'submenu' => $submenuall_data,
         'items_data' => $items_data,
 'extra'=>$extra,
  'extraCount'=>$extraCount,
    ]);
}
}
            
             
            
        }
            
                $data[] = ['name' => $all_data->name, 'id' => $all_data->id, 'discount' => $all_data->discount, 
                'orderby' => $all_data->orderby,
                'submenuwithaddon' => $submenudata
            ];
            $submenudata  = array();

           
        }

        return $data;
    }
    
    
    
    
    public function basedonCatgetalldataofmenu($id)
    {

        $data = [];
           $submenudata  = array();

        foreach (DB::table('categories')->where('id', $id)->where('status', '=', 0)
            ->orderBy('orderby', 'ASC')
            ->get() as $all_data)
        {

            $submenu = DB::table('sub_categories')->where('categories_id', $all_data->id)
                ->where('parent', '0')
                ->get();
                
                foreach ($submenu as $submenuall_data)
        {
            $users = DB::table('addon_multi_select')
      ->leftjoin('customize_masters', 'customize_masters.id', '=', 'addon_multi_select.addoncatid')
      ->where('menuid',$submenuall_data->id)
      ->where('customize_masters.hotel_id',$id)
      ->select('addon_multi_select.*','customize_masters.name AS title','customize_masters.id AS cat_id')
      ->orderBy('addon_multi_select.id', 'ASC')
      ->get();
      
      
    //   echo $users->count();
      
      
      if($users->count() == 0)
      {
            array_push($submenudata,(object)[
        'submenu' => $submenuall_data,
         
    ]);
      }
      else
        {
      foreach ($users as $items_data) {
    $extra = DB::table('link_addon_menus')
      ->join('addon_items', 'addon_items.id','=', 'link_addon_menus.addon_id')
      ->where('hotel_id', $id)
      ->where('menu_id', $submenuall_data->id)
      ->where('addon_items.addoncat', $items_data->cat_id)
      ->select('*','addon_name AS label','addon_name AS addon_name',DB::raw("CONCAT(addon_items.id,',',REPLACE(addon_items.addon_name, ',', ' '),',',addon_items.addon_price,',',$items_data->cat_id)  AS value"))
      ->get();
      $extraCount = $extra->count();
      

    
    array_push($submenudata,(object)[
        'submenu' => $submenuall_data,
         'items_data' => $items_data,
 'extra'=>$extra,
  'extraCount'=>$extraCount,
    ]);
}
}
            
             
            
        }
            
                $data[] = ['name' => $all_data->name, 'id' => $all_data->id, 'discount' => $all_data->discount, 
                'orderby' => $all_data->orderby,
                'submenuwithaddon' => $submenudata
            ];
            $submenudata  = array();

           
        }

        return $data;
    }

    public function create(Request $request)
    {

        $this->validate($request, [

        'name' => 'required|string|unique:categories', ]);
        $author = Category::create($request->all());

        return response()
            ->json($author, 201);
    }

    public function update($id, Request $request)
    {
        $author = Category::findOrFail($id);
        $author->update($request->all());

        return response()
            ->json($author, 200);
    }

    public function delete($id)
    {
        Category::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }

    public function showallmenus($id)
    {
        $author = DB::table('categories')->join('sub_categories', 'sub_categories.categories_id', '=', 'categories.id')
            ->where('hotel_id', $id)->where('categories.status', 0)
            ->where('sub_categories.price', '>', 0)
            ->orderBy('categories.id', 'ASC')
            ->get();

        return response()
            ->json($author, 200);
    }



 public function admin($id)
 {
      $author = DB::table('admin')
            ->where('hotel_id', $id)
            ->get();

        return response()
            ->json($author, 200);
     
 }
 
 //restaurants_documents
 
 public function restaurantsdocuments($id)
 {
      $author = DB::table('restaurants_documents')
            ->where('hotel_id', $id)
            ->get();

        return response()
            ->json($author, 200);
     
 }









}

