<?php

namespace App\Http\Controllers;

use App\Models\order_barang;
use App\Models\OrderBarang;
use Illuminate\Http\Request;

class OrderBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            "id_order" => "required|exists:orders,id",
            "id_barang" => "required|exists:barangs,id"
        ]);

        $CreataeOrderBarang = OrderBarang::create([
            "id_order" => $request->id_order,
            "id_barang" => $request->id_barang,
            "status" => 'running'
        ]);
        try {
            if (!$CreataeOrderBarang) {
                return response()->json([
                    "status" => false,
                    "message" => "not create Order"
                ], 403);
            } else {
                return response()->json([
                    "status" => true,
                    "message" => "success Create Order barang",
                    "data" => $CreataeOrderBarang
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => $th->getMessage()
            ]);
        }
    }
}
