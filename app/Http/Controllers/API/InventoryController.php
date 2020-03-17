<?php

namespace App\Http\Controllers\API;

use App\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::all();

        return response()->json([
            'error' => false,
            'inventories'  => $inventories,
        ], 200);
    }

    public function store(Request $request)
    {
        $inventory = Inventory::create($request->all());

        return response()->json([
            'error' => false,
            'inventory'  => $inventory,
        ], 200);
    }

    public function show($id)
    {
        $inventory = Inventory::find($id);
        
        return response()->json([
            'error' => false,
            'inventory'  => $inventory,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $inventory = Inventory::find($id);

        $inventory->item = $request->input('item');
        $inventory->description = $request->input('description');
        $inventory->quantity_at_hand = $request->input('quantity_at_hand');
        $inventory->price = $request->input('price');

        $inventory->save();
        
        return response()->json([
            'error' => false,
            'inventory'  => $inventory,
        ], 200);
    }

    public function destroy($id)
    {
        $inventory = Inventory::find($id);
        $inventory->delete();

        return response()->json([
            'error' => false,
            'message'  => "The Inventory with the id $inventory->id has successfully been deleted.",
        ], 200);
    }
}