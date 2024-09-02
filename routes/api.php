<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

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
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('/getProducts', [ProductController::class, 'getProducts']);
Route::post('/createProducts', [ProductController::class, 'createProducts']);
Route::put('/updateProducts/{id}', [ProductController::class, 'updateProducts']);
Route::post('/deleteProducts', [ProductController::class, 'deleteProducts']);

Route::get('/getCategory', [CategoryController::class, 'getCategory']);
Route::post('/createCategory', [CategoryController::class, 'createCategory']);
Route::put('/updateCategory/{id}', [CategoryController::class, 'updateCategory']);
Route::post('/deleteCategory', [CategoryController::class, 'deleteCategory']);





