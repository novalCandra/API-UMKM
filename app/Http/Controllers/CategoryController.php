<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $AllCategories = category::all();
        return response()->json([
            "status" => true,
            "message" => "All Categories",
            "data" => $AllCategories
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
            "nama" => "required|string"
        ]);

        $CreateCategorie = category::create([
            "nama" => $request->nama
        ]);
        try {
            if (!$CreateCategorie) {
                return response()->json([
                    "status" => false,
                    'message' => "not create Categorie"
                ], 402);
            } else {
                return response()->json([
                    "status" => true,
                    "message" => "success Create Categorie",
                    "data" => $CreateCategorie
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
    public function show($id)
    {
        $CategorieDetail  = category::findOrFail($id);
        try {
            if (!$CategorieDetail) {
                return response()->json([
                    "status" => false,
                    'message' => "not Details Categorie"
                ], 402);
            } else {
                return response()->json([
                    "status" => true,
                    "message" => "success Detail Categorie",
                    "data" => $CategorieDetail
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
    public function edit(category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $updateCategory = category::findOrFail($id);

        $request->validate([
            "nama" => "required|string"
        ]);

        $updateCategory->update([
            "nama" => $request->nama
        ]);

        try {
            if (!$updateCategory) {
                return response()->json([
                    "status" => false,
                    'message' => "not update categorie"
                ], 402);
            } else {
                return response()->json([
                    "status" => true,
                    "message" => "success Update categorie",

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
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $DeleteCategorie = category::destroy($id);
        try {
            if (!$DeleteCategorie) {
                return response()->json([
                    "status" => false,
                    'message' => "not delete categorie"
                ], 402);
            } else {
                return response()->json([
                    "status" => true,
                    "message" => "success delete categorie",
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
