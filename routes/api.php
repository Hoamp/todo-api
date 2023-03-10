<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/tes', function () {
    return response()->json([
        'message' => 'hello world'
    ]);
});

// todo
Route::get('/todo', [ApiController::class, 'getDataApi']);
Route::post('/todo', [ApiController::class, 'postDataApi']);
Route::put('/todo/{id}', [ApiController::class, 'updateDataApi']);
Route::delete('/todo/{id}', [ApiController::class, 'deleteDataApi']);

// registration
Route::post('/registration', [AuthController::class, 'registration']);
