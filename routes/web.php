<?php

use App\Http\Controllers\LoginWithOTPController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
Route::get('/admin/subcategory/{subcategoryId}/questions', [QuestionController::class, 'index'])
    ->name('admin.questions.index');

Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');

Route::get('/questions/{id}/edit', [QuestionController::class, 'edit'])->name('questions.edit');

Route::put('/questions/{id}', [QuestionController::class, 'update'])->name('questions.update');

Route::delete('/questions/{id}', [QuestionController::class, 'destroy'])->name('questions.delete');
Route::post('/admin/category/{id}/toggle-status', [CategoryController::class, 'toggleStatus'])
    ->name('admin.category.toggleStatus');


// // Show edit form
// Route::get('/questions/{id}/edit', [QuestionController::class, 'edit'])
//     ->name('questions.edit');

// // Update question
// Route::put('/questions/{id}', [QuestionController::class, 'update'])
//     ->name('questions.update');

// // Show questions for a category
// Route::get('/admin/subcategory/{subcategoryId}/questions', [QuestionController::class, 'index'])
//      ->name('admin.questions.index');

// // Add question
// Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');

// // Edit question
// Route::get('/questions/{id}/edit', [QuestionController::class, 'edit'])
//     ->name('questions.edit');

// // Update question
// Route::put('/questions/{id}', [QuestionController::class, 'update'])
//     ->name('questions.update');

// // Delete question
// Route::delete('/questions/{id}', [QuestionController::class, 'destroy'])
//     ->name('questions.delete');


// -------------------- HOME / ABOUT --------------------
Route::get('/', function () {
    $readmePath = base_path('README.md');

    return view('welcome', [
        'readmeContent' => Str::markdown(file_get_contents($readmePath)),
    ]);
});

Route::post('/about/{id}', [AboutController::class,'about'])->name('about.submit');


// -------------------- LOGIN WITH OTP --------------------
Route::prefix('/otp')->middleware('guest')->name('otp.')->controller(LoginWithOTPController::class)->group(function(){
    Route::get('/login','login')->name('login');
    Route::post('/generate','generate')->name('generate');
    Route::get('/verification/{userId}','verification')->name('verification');
    Route::post('login/verification','loginWithOtp')->name('loginWithOtp');
});


// -------------------- SOCIALITE --------------------
Route::prefix('oauth/')->group(function(){

    Route::prefix('/github/login')->name('github.')->group(function(){
        Route::get('/',[SocialiteController::class,'redirectToGithub'])->name('login');
        Route::get('/callback',[SocialiteController::class,'HandleGithubCallBack'])->name('callback');
    });

    Route::prefix('/google/login')->name('google.')->group(function(){
        Route::get('/',[SocialiteController::class,'redirectToGoogle'])->name('login');
        Route::get('/callback',[SocialiteController::class,'HandleGoogleCallBack'])->name('callback');        
    });

    Route::prefix('/facebook/login')->name('facebook.')->group(function(){
        Route::get('/',[SocialiteController::class,'redirectToFaceBook'])->name('login');
        Route::get('/callback',[SocialiteController::class,'HandleFaceBookCallBack'])->name('callback');
    });
});

require __DIR__.'/auth.php';
require('admin.php');
