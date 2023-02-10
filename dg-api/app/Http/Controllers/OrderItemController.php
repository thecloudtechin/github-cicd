<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{

    public function showAll()
    {
        return response()->json(OrderItem::all());
    }

   public function create($id ,Request $request)
    {

         $requestData = json_decode($request->getContent(), true);
        foreach($requestData as $key=>$val) {
            $requestData[$key]['order_no'] = $id;
        }
        $author = OrderItem::insert($requestData);
        return response()->json($author, 201);
    }
    public function getOrderDetailsByOID($id)
    {
return DB::table('order_items')
->join('sub_categories', 'sub_categories.id', 'order_items.item_id')
->where('order_no', $id)
->select('order_items.id AS mainId','order_items.item_id AS mainItem_id','order_items.*','sub_categories.*')
->get();

    }
    public function update($id, Request $request)
    {
        $author = OrderItem::findOrFail($id);
        $author->update($request->all());

        return response()->json($author, 200);
    }

    public function delete($id)
    {
        OrderItem::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }

}
