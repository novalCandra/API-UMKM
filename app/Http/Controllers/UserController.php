<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use PDO;

class UserController extends Controller
{
    public function index()
    {
        $AllUser = User::all();
        return response()->json([
            "status" => true,
            "message" => "success All Users",
            "data" => $AllUser
        ], 200);
    }

    public function show($id)
    {
        $DetailUser = User::findOrFail($id);
        return response()->json([
            "status" => true,
            "message" => "success All Users",
            "data" => $DetailUser
        ], 200);
    }


    public function store(Request $request)
    {
        $request->validate([
            "email" => "required|string",
            "nama" => "required|string",
            "password" => "required|string",
        ]);

        $CreateAccunt = User::create([
            "email" => $request->email,
            "nama" => $request->nama,
            "password" => bcrypt($request->password)
        ]);

        try {
            if (!$CreateAccunt) {
                return response()->json([
                    "status" => false,
                    'message' => "not create users"
                ], 402);
            } else {
                return response()->json([
                    "status" => true,
                    "message" => "success Create Users",
                    "data" => $CreateAccunt
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => $th->getMessage()
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $userUpdate = User::findOrFail($id);
        $request->validate([
            "email" => "required|string",
            "nama" => "required|string",
            "password" => "required|string",
        ]);

        $userUpdate->update([
            "email" => $request->email,
            "nama" => $request->nama,
            "password" => bcrypt($request->password)
        ]);

        try {
            if (!$userUpdate) {
                return response()->json([
                    "status" => false,
                    'message' => "not Update users"
                ], 402);
            } else {
                return response()->json([
                    "status" => true,
                    "message" => "success Update Users",
                    "data" => $userUpdate
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => $th->getMessage()
            ]);
        }
    }

    public function destory($id)
    {
        $DeleteUser = User::destroy($id);
        try {
            if (!$DeleteUser) {
                return response()->json([
                    "status" => false,
                    'message' => "not delete users"
                ], 402);
            } else {
                return response()->json([
                    "status" => true,
                    "message" => "success delete Users",
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
