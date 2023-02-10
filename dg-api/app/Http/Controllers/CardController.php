<?php

namespace App\Http\Controllers;

use App\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function allCards()
    {
        // return response()->json(User::all());
        return response()->json(['cards' =>  Card::all()], 200);
    }


    public function create(Request $request)
    {
        $author = Card::create($request->all());

        return response()->json($author, 201);
    }

    public function update($id, Request $request)
    {
        $author = Card::findOrFail($id);
        $author->update($request->all());

        return response()->json($author, 200);
    }

    public function delete($id)
    {
        Card::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }

}
