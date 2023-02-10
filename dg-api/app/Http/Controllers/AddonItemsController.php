<?php

namespace App\Http\Controllers;

use App\AddonItems;
use Illuminate\Http\Request;
use DB;
class AddonItemsController extends Controller
{

    public function showAll()
    {
        return response()->json(AddonItems::all());
    }
        public function basednCatId($id)
    {
        return response()->json(AddonItems::where('addoncat', $id)->get());
    }
     
    
    public function create(Request $request)
    {
        
        $author = AddonItems::insert($request->all());

        return response()->json($author, 201);
    }

    public function update($id, Request $request)
    {
        $author = AddonItems::findOrFail($id);
        $author->update($request->all());

        return response()->json($author, 200);
    }

    public function delete($id)
    {
        AddonItems::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }

}