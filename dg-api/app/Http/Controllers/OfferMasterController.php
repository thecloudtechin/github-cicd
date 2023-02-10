<?php

namespace App\Http\Controllers;
use DB;
use App\OfferMaster;
use Illuminate\Http\Request;

class OfferMasterController extends Controller
{

  

    public function all()
    {
        return response()->json(['OfferMaster' => OfferMaster::all()], 200);
    }

}