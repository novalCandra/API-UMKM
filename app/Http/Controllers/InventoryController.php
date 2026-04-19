<?php

namespace App\Http\Controllers;

use App\Models\inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $AllInventory = inventory::all();
        return response()->json([
            "status" => true,
            "message" => "All Inventory data",
            "data" => $AllInventory
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "total_barang" => "required|number",
            "stok_barang" => "required|number"
        ]);

        $CreateInventory = inventory::create([
            "total_barang" => $request->total_barang,
            "stok_barang" => $request->stok_barang
        ]);

        try {
            if (!$CreateInventory) {
                return response()->json([
                    "status" => false,
                    "message" => "no Create Inventory"
                ]);
            } else {
                return response()->json([
                    "status" => true,
                    "message" => "Success Create Inventory"
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $DetailInventory = inventory::findOrFail($id);

        try {
            if (!$DetailInventory) {
                return response()->json([
                    "status" => false,
                    "message" => "no Detail Iventory"
                ]);
            } else {
                return response()->json([
                    "status" => true,
                    "message" => "Success Details order",
                    "data" => $DetailInventory
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "total_barang" => "required|number",
            "stok_barang" => "required|number"
        ]);

        $UpdateInventory = inventory::findOrFail($id);
        $UpdateInventory->update([
            "total_barang" => $request->total_barang,
            "stok_barang" => $request->stok_barang
        ]);
        try {
            if (!$UpdateInventory) {
                return response()->json([
                    "status" => false,
                    "message" => "no Update Order"
                ]);
            } else {
                return response()->json([
                    "status" => true,
                    "message" => "Success Update order"
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $DeleteInventory = inventory::destroy($id);
        try {
            if (!$DeleteInventory) {
                return response()->json([
                    "status" => false,
                    "message" => "no delete Inventory"
                ]);
            } else {
                return response()->json([
                    "status" => true,
                    "message" => "Success delete Inventory"
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th->getMessage()
            ], 500);
        }
    }
}
