<?php

namespace App\Http\Controllers;

use App\Openinghour;
use App\User;
use Illuminate\Http\Request;

class OpeninghourController extends Controller
{

    public function showAll()
    {
        return response()->json(Openinghour::all());
    }
    
    
     public function filter($hotel_id,$type)
    {
        return response()->json(Openinghour::where('hotel_id',$hotel_id)->where('type',$type)->get());
    }
    
    public function create(Request $request)
    {
      
        $author = Openinghour::create($request->all());

        return response()->json($author, 201);
    }
    public function update($id, Request $request)
    {
        $author = Openinghour::findOrFail($id);
        $author->update($request->all());

        return response()->json($author, 200);
    }

    public function delete($id)
    {
        Openinghour::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }

}