<?php

namespace App\Http\Controllers;

use App\Address;
use App\User;
use Illuminate\Http\Request;

class AddressController extends Controller
{

    public function showAll()
    {
        return response()->json(Address::all());
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'u_id'=>'required',
            'home_address' => 'required|string',
            'permanent_address' => 'required|string',
            'pincode' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
        ]);
        $author = Address::create($request->all());

        return response()->json($author, 201);
    }
    public function showAllAddressByUID($id)
    {
        $author = Address::where('u_id',$id)->orderBy('id', 'DESC')->get();
        // array_reverse()
        return response()->json(['address' => $author ], 200);
    }
    
     public function showAllAddressByUIDbyPincode($id,$pincode)
    {
        $internaldata = [];
        //EH11 1AF
        //aray appensd below 7 miles or upto 7 miles
        $addressDetails = User::find($id)->addresses;
        foreach ($addressDetails as $data) {
            
            
            $ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".$pincode."&destinations=".$data->pincode."&key=AIzaSyDY2j1NE12MzJYS7t-dVay1lXooOpzxZsY");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
// echo  $output;
$obj = json_decode($output);
            
            $internaldata[] = [
'id'=> $data->id,
'u_id'=> $data->u_id,
'home_address'=> $data->home_address,
'permanent_address'=> $data->permanent_address,
'pincode'=> $data->pincode,
'city'=> $data->city,
'status'=> $data->status,
'state'=> $data->state,
'name'=> $data->name,
'contact'=> $data->contact,
'created_at'=> $data->created_at,
'updated_at'=>$data->updated_at,
'landmark'=> $data->landmark,
'lat'=> $data->lat,
'longt'=> $data->longt,
'miles'=> $obj
];

        }
        
        
        
        return response()->json(['address' =>  $internaldata], 200);
    }
    
     public function getaddressById($id)
    {
        $author = Address::findOrFail($id);
        return response()->json($author, 200);
    }
    public function update($id, Request $request)
    {
        $author = Address::findOrFail($id);
        $author->update($request->all());

        return response()->json($author, 200);
    }

    public function delete($id)
    {
        Address::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }

}
