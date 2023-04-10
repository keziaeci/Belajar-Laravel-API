<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{

    public function index() {
        $data = User::latest()->get();

        return response()->json([
            'message' => 'List user',
            'users' => $data
        ],200);
    }

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

    public function show(User $user)
    {
        try {
            // $data = User::firstWhere('id',$user);
            return response()->json([
                'message' => 'user ditemukan',
                'data' => $user
            ]);
        } catch (\Throwable $e) {
            return response(["error" => $e->getMessage()]);
        }
    }
    
    public function update(Request $request, User $user)
    {
        try {
            $data = $request->validate([
                'name' => 'required',
                'email' => 'required|email:dns|unique:users',
                'password' => 'required'
            ]);
            $user->update($data);
            return response()->json([
                'message' => 'data berhasil di update',
                'data' => $user
            ]);
        } catch (\Throwable $e) {
            return response([
                'error' => $e->getMessage()
            ]);
        }
    }
}