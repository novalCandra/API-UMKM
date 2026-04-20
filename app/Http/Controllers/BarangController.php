<?php

namespace App\Http\Controllers;

use App\Models\barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $AllBarang = barang::all();

        return response()->json([
            "status" => true,
            "message" => "Success All data",
            "data" => $AllBarang
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
        DB::beginTransaction();
        try {
            $request->validate([
                "id_inventory" => "required|exists:inventories,id",
                "id_category" => "required|exists:categories,id",
                "nama_barang" => "required|string",
                "harga_barang" => "required|numeric",
                "image" => "required|image|mimes:jpeg,jpg,png"
            ]);
            $imagePath = $request->file('image')->store('image', 'public');
            $CreateImage = barang::create([
                "id_inventory" => $request->id_inventory,
                "id_category" => $request->id_category,
                "nama_barang" => $request->nama_barang,
                "harga_barang" => $request->harga_barang,
                "image" => $imagePath,
                "image_url" => asset('storage/' . $imagePath)
            ]);
            DB::commit();
            return response()->json([
                "status" => true,
                "message" => "success Create Barang",
                "data" => $CreateImage
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                "status" => false,
                "message" => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $DetailBarang = barang::findOrFail($id);

        try {
            if (!$DetailBarang) {
                return response()->json([
                    "status" => false,
                    'message' => "not Detail Barang"
                ], 402);
            } else {
                return response()->json([
                    "status" => true,
                    "message" => "success Detail Barang",
                    "data" => $DetailBarang
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
     * Show the form for editing the specified resource.
     */
    public function edit(barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $UpdateBarang = barang::findOrFail($id);

        $request->validate([
            "id_inventory" => "required|exists:inventories,id",
            "id_category" => "required|exists:categories,id",
            "nama_barang" => "required|string",
            "harga_barang" => "required|numeric",
            "image" => "required|image|mimes:jpeg,jpg,png"
        ]);

        $imagePath = $request->file('image')->store('image', 'public');
        $UpdateBarang->update([
            "id_inventory" => $request->id_inventory,
            "id_category" => $request->id_category,
            "nama_barang" => $request->nama_barang,
            "harga_barang" => $request->harga_barang,
            "image" => $imagePath,
            "image_url" => asset('storage/' . $imagePath)
        ]);

        return response()->json([
            "status" => true,
            "message" => "success Update barang",
            "data" => $UpdateBarang
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $DeleteBarang = barang::destroy($id);

        try {
            if (!$DeleteBarang) {
                return response()->json([
                    "message" => "tidak bisa delete data"
                ], 402);
            } else {
                return response()->json([
                    "status" => true,
                    "message" => "Succcess delete Barang"
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => $th->getMessage()
            ], 500);
        }
    }
}
