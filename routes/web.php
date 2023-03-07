<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TransactionController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//for users
Route::resource('/home/transactions', 'App\Http\Controllers\TransactionController')->middleware('auth:web');
Route::post('/home/transactions/create',[TransactionController::class,'store'])->name('home.addmoney')->middleware('auth:web');
// for admin
Route::get('/admin',[LoginController::class,'showAdminLoginForm'])->name('admin.login-view');
Route::post('/admin',[LoginController::class,'adminLogin'])->name('admin.login');

Route::get('/admin/register',[RegisterController::class,'showAdminRegisterForm'])->name('admin.register-view');
Route::post('/admin/register',[RegisterController::class,'createAdmin'])->name('admin.register');


Route::get('/admin/dashboard',function(){
    return view('admin');
})->middleware('auth:admin');

Route::resource('/admin/affiliates', 'App\Http\Controllers\AffiliateController')->middleware('auth:admin');
Route::resource('/admin/users', 'App\Http\Controllers\UserController')->middleware('auth:admin');
Route::resource('/admin/transactions', 'App\Http\Controllers\TransactionController')->middleware('auth:admin');

//for affiliates
Route::get('/affiliate',[LoginController::class,'showAffiliateLoginForm'])->name('affiliate.login-view');
Route::post('/affiliate',[LoginController::class,'affiliateLogin'])->name('affiliate.login');

// Route::get('/affiliate/register',[RegisterController::class,'showAffiliateRegisterForm'])->name('affiliate.register-view');
// Route::post('/affiliate/register',[RegisterController::class,'createAffiliate'])->name('affiliate.register');

Route::get('/affiliate/dashboard',function(){
    return view('affiliate');
})->middleware('auth:affiliate');

Route::resource('/affiliate/subaffiliates', 'App\Http\Controllers\SubaffiliateController')->middleware('auth:affiliate');
