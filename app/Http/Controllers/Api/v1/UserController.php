<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function store(Request $request) {
        try {
            $data = $request->validate([
                'name' => 'required',
                'email' => 'required|email:dns|unique:users',
                'password' => 'required'
            ]);
            $validatedData = User::create($data);
            return response()->json([
                'success' => true,
                'message' => 'data berhasil dibuat',
                'data' => $validatedData
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
