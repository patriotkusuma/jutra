<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\Admin\BrokerController;
use App\Http\Controllers\Admin\DepositController;
use App\Http\Controllers\Admin\EmitenController;
use App\Models\Deposit;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {return redirect('/dashboard');})->middleware('auth');
Route::get('/migrate', function(){
    Artisan::call('migrate');
});

Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'broker'], function(){
        Route::get('/',[BrokerController::class,'index'])->name('list-broker');
        Route::match(['get','post'],'/add',[BrokerController::class,'add'])->name('add-broker');
        Route::match(['get','post'],'/{id}',[BrokerController::class,'edit'])->name('edit-broker');
        Route::get('/remove',[BrokerController::class,'remove'])->name('remove-broker');
    });

    Route::group(['prefix' => 'stock'], function(){
        Route::get('/',[EmitenController::class,'index'])->name('list-emiten');
        Route::match(['get','post'],'/add',[EmitenController::class,'add'])->name('add-emiten');
        Route::match(['get','post'],'/{id}',[EmitenController::class,'edit'])->name('edit-emiten');
    });

    Route::group(['prefix' => 'wallet'], function(){
        Route::group(['prefix' => 'deposit'], function(){
            Route::get('/',[DepositController::class,'index'])->name('list-deposit');
            Route::match(['get','post'],'/add',[DepositController::class,'add'])->name('add-deposit');
            Route::match(['get','post'],'/{id}',[DepositController::class,'edit'])->name('edit-deposit');
        });

        Route::group(['prefix' => 'withdraw'], function(){
            Route::get('/',);
        });
    });
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static');
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static');
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');


});
