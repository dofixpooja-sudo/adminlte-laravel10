<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\AnswerController;
use App\Http\Controllers\Api\SubCategoryController;

use App\Http\Controllers\Api\OptionController;
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

Route::post('/submit-answer', [AnswerController::class, 'store']);
Route::get('/answers', [AnswerController::class, 'index']);
Route::get('/answers-list', [AnswerController::class, 'answersList']);
Route::put('/update-answer/{id}', [AnswerController::class,'update']);
Route::delete('/delete-answer/{id}', [AnswerController::class,'delete']);
Route::post('/options/create', [OptionController::class, 'store']);