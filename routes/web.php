<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MainUserController;
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


Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function(){
        Route::get('/login',[AdminController::class, 'loginForm'])->name('user');
        Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
});


Route::middleware([
    'auth:sanctum,admin',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});


Route::middleware([
    'auth:sanctum,web',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('user.index');
    })->name('dashboard');
});

//user profile
Route::get('/user/profile',[MainUserController::class, 'userProfile'])->name('user.profile');
Route::get('/user/logout',[MainUserController::class, 'logout'])->name('user.logout');

Route::get('/admin/logout',[AdminController::class, 'destroy'])->name('admin.logout');
