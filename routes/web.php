<?php

use App\Http\Controllers\ContentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;

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


Route::view('/', 'pages.index');
Route::view('/content', 'pages.content');
Route::get('/success',[StripeController::class,'success'])->name('success');

Route::view('/cancel', 'pages.content')->name('cancel');
Route::get('/test/{id}',[StripeController::class,'checkout']);

Route::middleware(['auth', 'verified'])->group(function () {

    Route::view('/dashboard', 'dashboard')->name('dashboard');
    
    Route::prefix('/create')->group(function () {
        Route::view('/upload', 'create')->name('create.upload');
        Route::get('/video', [ContentController::class, 'show'])->name('create.video');
        Route::get('/image', [ContentController::class, 'show'])->name('create.image');
        Route::get('/document', [ContentController::class, 'show'])->name('create.document');
    });
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/social', [ProfileController::class, 'update_social_account'])->name('social.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::fallback(fn()=> view('dashboard'));
});


require __DIR__ . '/auth.php';