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
Route::controller(UserController::class)->group(function () {
    Route::get('/v1/users', 'index');
    Route::get('/v1/users/{user}', 'show');
    Route::post('/v1/users', 'store');
    Route::put('/v1/users/{user}', 'update');
});
