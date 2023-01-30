<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\API\ProdukController;


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
Route::post('login', [App\Http\Controllers\API\AuthController::class, 'login']);
Route::post('register', [App\Http\Controllers\API\AuthController::class, 'register']);
Route::resource('produk', ProdukController::class);
Route::get('users', [App\Http\Controllers\API\AuthController::class, 'users']);
Route::post('/payment-handler', [App\Http\Controllers\API\SecurityController::class, 'payment_handler']);
Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
});



