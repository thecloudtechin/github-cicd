<?php

namespace App\Http\Controllers;
use App\EmpLogin;
use App\User;
use App\Orders;
use Illuminate\Http\Request;
use Users;

class EmpLoginController extends Controller
{
   public function showAll()
    {
        return response()->json(EmpLogin::all());
    }
    
    
      public function editEmpLogin($id, Request $request)
    {
        
    //   $request->input('password') =  app('hash')->make($request->input('password'));
        
         $author = EmpLogin::findOrFail($id);
        $author->update($request->all());
    }

}
