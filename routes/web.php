<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomRegisterController;
use App\Http\Controllers\DashboardController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::post('/custom-login',[CustomRegisterController::class,'userLogin'])->name('custom-login');
Route::post('/custom-register',[CustomRegisterController::class,'userRegister'])->name('custom-register');

Route::group(['middleware' => ['auth']], function () {
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('save/profile',[CustomRegisterController::class,'saveProfile'])->name('save.profile');
Route::post('upload/image',[CustomRegisterController::class,'saveProfileImage'])->name('profile.image');
Route::get('userlist',[DashboardController::class,'index'])->name('user.list');
});