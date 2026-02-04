<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;

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
use App\Http\Controllers\Api\SubCategoryController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

    return $request->user();
});
//Route::('/subcategories/{id}', [SubCategoryController::class, 'show']);

 Route::get('/categories', [CategoryController::class, 'index']);
 
Route::get(
    '/categories/{category_id}/subcategories',
    [SubCategoryController::class, 'categoryWiseSubcategories']
);

Route::get(
    '/category/{id}/subcategories-questions',
    [SubCategoryController::class, 'categoryWiseSubcategories']
);

// Route::get(
//     '/categories/{category_id}/subcategories',
//     [SubCategoryController::class, 'categoryWiseSubcategories']
// // );
//    Route::get('/subcategories/{id}', [SubCategoryController::class, 'show']);



