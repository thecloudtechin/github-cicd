<?php

namespace App\Http\Controllers;

use App\AddonMultiSelect;
use Illuminate\Http\Request;
use DB;
class AddOnMultiSelectController extends Controller
{
    public function createaddonmultiselect (Request $request)
    {

        $addon = new AddonMultiSelect;
        $addon->id = $request->input('id');
        $addon->addoncatid = $request->input('addoncatid');
        $addon->menuid = $request->input('menuid');
        $addon->hotelid = $request->input('hotelid');
        $addon->count = $request->input('count');
        $addon->add_on_desc = $request->input('add_on_desc');
        $addon->status = $request->input('status');

        $addon->save();

        //return successful response
        return response()->json(['addon' => $addon, 'message' => 'CREATED'], 201);
    }
    public function addonmultiselectBasedOnMenuIdAndHotelId (Request $request)
    {
        $data = $request->All();
        $result = array ('success' => false, 'result' => array (), 'errors' => array ());
        $errors = array();
        try {
            if (empty($data['menuid'])) {
                $errors[] = 'Menu Id is required';
            }
            if (empty($data['hotelid'])) {
                $errors[] = 'Hotel Id is required';
            }
            if (!count($errors)) {
                
                $res = DB::table('addon_multi_select')->where(['menuid' => $data['menuid'], 'hotelid' => $data['hotelid']])->get();
                $result['success'] = true;
                $result['result'] = $res;
            }
        } catch (Exception $e) {
            $errors[] = 'Something went wrong, Please try after some time';
        }
        $result['errors'] = $errors;
        return response()->json($result);
    }
    
    public function addonmultiselectBasedOnHotelId (Request $request)
    {
        $data = $request->All();
        $result = array ('success' => false, 'result' => array (), 'errors' => array ());
        $errors = array();
        try {
            if (empty($data['hotelid'])) {
                $errors[] = 'Hotel Id is required';
            }
            if (!count($errors)) {
                $res = DB::table('addon_multi_select')->where('hotelid','=', $data['hotelid'])->get();
                $result['success'] = true;
                $result['result'] = $res;
            }
        } catch (Exception $e) {
            $errors[] = 'Something went wrong, Please try after some time';
        }
        $result['errors'] = $errors;
        return response()->json($result);
    }

    public function updateaddonmultiselect($id, Request $request)
    {
        $addonmultiselect = AddonMultiSelect::findOrFail($id);
        $data = $request->all();
        $addonmultiselect->update($data);
        // return response()->json($addonmultiselect, 200);
        return response('Updated Successfully', 200);
    }

}