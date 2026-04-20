<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\order_barang;
use App\Models\OrderBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $AllOrder = OrderBarang::with(['orders', 'barang'])->get();
        return response()->json([
            "status" => true,
            "message" => "success All Order",
            "data" => $AllOrder
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
            "total_harga" => "required|number",
            "total_barang" => "required|number",
            "decription" => "nullable|string"
        ]);

        $user = Auth::user();
        $Createorder = order::create([
            "id_user" => $user,
            "total_harga" => $request->total_harga,
            "total_barang" => $request->total_barang,
            "decription" => $request->decription
        ]);

        try {
            if (!$Createorder) {
                return response()->json([
                    "status" => false,
                    'message' => "not create Order"
                ], 402);
            } else {
                return response()->json([
                    "status" => true,
                    "message" => "success Create Order",
                    "data" => $Createorder
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => $th->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $DeleteOrder = order::destroy($id);

        try {
            if (!$DeleteOrder) {
                return response()->json([
                    "status" => false,
                    "message" => "no delete Order"
                ]);
            } else {
                return response()->json([
                    "status" => true,
                    "message" => "Success delete order"
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th->getMessage()
            ], 500);
        }
    }
}
