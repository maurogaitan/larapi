<?php

namespace App\Http\Controllers\API;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();

        return response()->json([
            'error' => false,
            'orders'  => $orders,
        ], 200);
    }

    public function store(Request $request)
    {
        $order = Order::create($request->all());

        return response()->json([
            'error' => false,
            'order'  => $order,
        ], 200);
    }

    public function show($id)
    {
        $order = Order::find($id);
        
        return response()->json([
            'error' => false,
            'order'  => $order,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        $order->order_notes = $request->input('order_notes');

        $order->save();
        
        return response()->json([
            'error' => false,
            'order'  => $order,
        ], 200);
    }

    public function destroy($id)
    {
        $orders = Order::find($id);
        $orders->delete();

        return response()->json([
            'error' => false,
            'message'  => "The Order with the id $orders->id has successfully been deleted.",
        ], 200);
    }
}