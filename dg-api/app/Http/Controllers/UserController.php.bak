<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class UserController extends Controller
{


   
    public function showAllUsers()
    {
        // return response()->json(User::all());
        return response()->json(['users' =>  User::all()], 200);
    }
    public function getdataById($id)
    {
        $author = User::findOrFail($id);
        return response()->json($author, 200);
    }

    public function create(Request $request)
    {
        $author = User::create($request->all());

        return response()->json($author, 201);
    }

    public function update($id, Request $request)
    {
        try {
        $author = User::findOrFail($id);
        $author->update($request->all());

        return response()->json($author, 200);
        } catch (\Throwable $e) {
            
            return response()->json([
                'error' => [
                    'description' => $e->getMessage()
                ]
            ], 500);
            
        }
    }
    
     public function verifyotp($id)
    {
        $author =DB::table('users')
            ->where('mobile', '=', $id)
            ->get();
        return response()->json($author, 200);
    }
    
    public function delete($id)
    {
        User::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
    public function updateToken (Request $request)
    {
        $data = $request->All();
        $user = User::where(['mobile' => $data['mobile']])->update(['token' => $data['token']]);
        return response()->json(['status'=> "success", 'result' => $user]);
    }
}
