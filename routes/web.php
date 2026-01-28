<?php

use App\Http\Controllers\LoginWithOTPController;
use App\Http\Controllers\SocialiteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use App\Http\Controllers\AboutController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\QuestionController;
// edit form
Route::get('/questions/{id}/edit', [QuestionController::class, 'edit'])
    ->name('questions.edit');

// update
Route::put('/questions/{id}', [QuestionController::class, 'update'])
    ->name('questions.update');

// delete
Route::delete('/questions/{id}', [QuestionController::class, 'destroy'])
    ->name('questions.delete');
Route::get('/admin/category/{id}/questions', [QuestionController::class, 'index'])
     ->name('admin.questions.index');

Route::post('/questions', [QuestionController::class, 'store']);


Route::get('/', function () {
    $readmePath = base_path('README.md');

    return view('welcome', [
        'readmeContent' => Str::markdown(file_get_contents($readmePath)),
    ]);
});
        Route::post('/about/{$id}',[AboutController::class,'about']);

// Login with OTP Routes
Route::prefix('/otp')->middleware('guest')->name('otp.')->controller(LoginWithOTPController::class)->group(function(){
    Route::get('/login','login')->name('login');
    Route::post('/generate','generate')->name('generate');
    Route::get('/verification/{userId}','verification')->name('verification');
    Route::post('login/verification','loginWithOtp')->name('loginWithOtp');
});

// Socialite Routes
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
