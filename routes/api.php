<?php

use App\Http\Controllers\SalesController;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::get('/all-product',[ProductController::class,'index']);

Route::get('/sales/all-sales',[SalesController::class,'index']);
Route::delete('/sales/delete-sales',[SalesController::class,'destroy']);
Route::post('/sales/consult-sales',[SalesController::class,'show']);
Route::post('/sales/delete-sales',[SalesController::class,'destroy']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
