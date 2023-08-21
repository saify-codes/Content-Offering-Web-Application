<?php

use App\Http\Controllers\ContentController;
use App\Http\Controllers\ProfileController;
use App\Models\SocialAccounts;
use App\Models\User;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('test');
});


Route::middleware(['auth','verified'])->group(function(){
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    // Route::view('/create/video', 'create')->name('create.video');
    // Route::view('/create/image', 'create')->name('create.image');
    // Route::view('/create/document', 'create')->name('create.document');
    
    Route::view('/create/upload', 'create')->name('create.upload');
    Route::get('/create/video',[ContentController::class, 'show'])->name('create.video');
    Route::get('/create/image',[ContentController::class, 'show'])->name('create.image');
    Route::get('/create/document',[ContentController::class, 'show'])->name('create.document');
    Route::fallback(fn()=>view('/dashboard'));
});



Route::middleware('auth')->group(function () {





    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/social', [ProfileController::class, 'update_social_account'])->name('social.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
