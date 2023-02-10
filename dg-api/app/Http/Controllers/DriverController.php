<?php

namespace App\Http\Controllers;

use App\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function all()
    {
        return response()->json(['drivers' => Driver::all()], 200);
    }
    public function getdataById($id)
    {
        $author = Driver::findOrFail($id);
        return response()->json($author, 200);
    }

    public function create(Request $request)
    {
        $author = Driver::create($request->all());

        return response()->json($author, 201);
    }

    public function update($id, Request $request)
    {
        $author = Driver::findOrFail($id);
        $author->update($request->all());

        return response()->json($author, 200);
    }

    public function getBasedOnDeliveryAssignCode($code)
    {
        $author = Driver::where('delivery_assign',$code)->get();

        return response()->json($author, 200);
    }

    public function delete($id)
    {
        Driver::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }

}
