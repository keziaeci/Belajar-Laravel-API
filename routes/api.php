<?php

use App\Http\Controllers\Api\BarangController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\api\v1\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('posts', )

// api restfull
Route::apiResource('/posts' , PostController::class );
Route::apiResource('/barangs' , BarangController::class );

// api v1
Route::post('/v1/users/store', [UserController::class, 'store']);
