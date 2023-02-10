<?php

namespace App\Http\Controllers;

use App\Cuisines;
use Illuminate\Http\Request;
use DB;

class CuisinesController extends Controller
{

    public function createCuisines(Request $request)
    {
        $cuisine = new Cuisines;
        $cuisine->id = $request->input('id');
        $cuisine->hotelid = $request->input('hotelid');
        $cuisine->name = $request->input('name');
        $cuisine->status = $request->input('status');
        
        $cuisine->save();

        //return successful response
        return response()->json(['cuisine' => $cuisine, 'message' => 'CREATED'], 201);
    }

    public function updateCuisines($id, Request $request)
    {
        $cuisine = Cuisines::findOrFail($id);
        $data = $request->all();
        $cuisine->update($data);
        // return response()->json($cuisine, 200);
        return response('Updated Successfully', 200);
    }
        
    public function deleteCuisines($id)
    
    {
        Cuisines::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
    
    public function selectCuisines(Request $request)
    {
        $data = $request->All();
        $result = array ('success' => false, 'result' => array (), 'errors' => array ());
        $errors = array();
        try {
            if (!count($errors)) {
                $res = DB::table('cuisines')->get();
                $result['success'] = true;
                $result['result'] = $res;
            }
        } catch (Exception $e) {
            $errors[] = 'Something went wrong, Please try after some time';
        }
        $result['errors'] = $errors;
        return response()->json($result);
    }
}