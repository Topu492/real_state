<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [FrontendController::class, 'index'])->name('home');


Route::middleware('admin')->prefix('admin')->group(function(){
   
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');
   
    
});

Route::prefix('admin')->group(function(){
   
    Route::get('/login', [AdminController::class, 'login'])->name('admin_login');
    Route::post('/login', [AdminController::class, 'login_submit'])->name('admin_login_submit');
    
});