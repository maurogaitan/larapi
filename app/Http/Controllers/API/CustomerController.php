<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();

        return response()->json([
            'error' => false,
            'customers'  => $customers,
        ], 200);
    }

    public function store(Request $request)
    {
        $customer = Customer::create($request->all());

        return response()->json([
            'error' => false,
            'customer'  => $customer,
        ], 200);
    }

    public function show($id)
    {
        $customer = Customer::with('orders')
            ->with('orders.details')
            ->find($id);
        
        return response()->json([
            'error' => false,
            'customer'  => $customer,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);

        $customer->first_name = $request->input('first_name');
        $customer->last_name = $request->input('last_name');
        $customer->email = $request->input('email');
        $customer->physical_address = $request->input('physical_address');

        $customer->save();
        
        return response()->json([
            'error' => false,
            'customer'  => $customer,
        ], 200);
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();

        return response()->json([
            'error' => false,
            'message'  => "The customer with the id $customer->id has successfully been deleted.",
        ], 200);
    }

    public function order(Request $request, $id){
        $customer = Customer::find($id);

        $order = $customer->orders()->create([
            'order_date' => Carbon::now(),
            'order_notes' => $request->input('order_notes'),
        ]);
        
        $items = $request->input('items');

        foreach($items as $item){
            $order->details()->create([
                'inventory_id' => $item['inventory_id'],
                'quantity' => $item['quantity'],
            ]);
        }
        
        return response()->json([
            'error' => false,
            'order'  => $order,
        ], 200);
    }
}