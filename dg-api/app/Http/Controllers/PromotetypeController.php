<?php

namespace App\Http\Controllers;

use App\Promotetype;
use Illuminate\Http\Request;

class PromotetypeController extends Controller
{

    public function createPromoteType(Request $request)
    {
        $promotetype = new Promotetype;
        $promotetype->id = $request->input('id');
        $promotetype->hotelid = $request->input('hotelid');
        $promotetype->promote_title = $request->input('promote_title');
        $promotetype->promote_desc = $request->input('promote_desc');
        $promotetype->cost = $request->input('cost');
        $promotetype->from_date = $request->input('from_date');
        $promotetype->end_date = $request->input('end_date');
        $promotetype->status = $request->input('status');
        
        $promotetype->save();

        //return successful response
        return response()->json(['promotetype' => $promotetype, 'message' => 'CREATED'], 201);
    }

    public function updatePromoteType($id, Request $request)
    {
        $promotetype = Promotetype::findOrFail($id);
        $data = $request->all();
        $promotetype->update($data);
        // return response()->json($promotetype, 200);
        return response('Updated Successfully', 200);
    }
        
    public function deletePromoteType($id)
    
    {
        Promotetype::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
    
    public function selectPromoteType($id)
    {
        $promotetype = Promotetype::where(['id' => $id])->get();
        // echo $promotetype->toSql();
        return response()->json($promotetype, 200);
    }
}