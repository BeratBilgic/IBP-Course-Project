<?php

use App\Http\Controllers\AdminPanel\AdminUserController;
use App\Http\Controllers\AdminPanel\HomeController as AdminHomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserPanel\HomeController as UserHomeController;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// ******************** HOME PAGE ROUTES *************************
Route::view('/loginuser', 'home.login')->name('loginuser');;
Route::get('/logoutuser', [AuthController::class,'logout'])->name('logoutuser');
Route::post('/authenticate', [AuthController::class,'authenticate'])->name('authenticate');

// ******************** USER AUTH CONTROL *************************
Route::middleware('auth')->group(function () {

    // ******************** ADMIN PANEL ROUTES *************************
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/',[AdminHomeController::class,'index'])->name('index');
        // ******************** General Routes ROUTES *************************
        Route::get('/setting',[AdminHomeController::class,'setting'])->name('setting');
        Route::post('/setting',[AdminHomeController::class,'settingUpdate'])->name('setting.update');

        // ******************** ADMIN PRODUCT ROUTES *************************
        Route::prefix('product')->controller(ProductController::class)->name('product.')->group(function () {
            Route::get('/','index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}','edit')->name('edit');
            Route::post('/update/{id}','update')->name('update');
            Route::get('/destroy/{id}','destroy')->name('destroy');
            Route::get('/show/{id}','show')->name('show');
        });

        // ******************** ADMIN USER ROUTES *************************
        Route::prefix('user')->controller(AdminUserController::class)->name('user.')->group(function () {
            Route::get('/','index')->name('index');
            Route::get('/show/{id}','show')->name('show');
            Route::get('/edit/{id}','edit')->name('edit');
            Route::post('/update/{id}','update')->name('update');
            Route::get('/destroy/{id}','destroy')->name('destroy');
            Route::post('/addrole/{id}','addRole')->name('addrole');
            Route::get('/destroyrole/{uid}/{rid}','destroyRole')->name('destroyrole');
        });
    }); // Admin Panel Routes group

    // ******************** USER PANEL ROUTES *************************
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/',[UserHomeController::class,'index']);

    // ******************** USER PRODUCT ROUTES *************************
        Route::prefix('product')->controller(ProductController::class)->name('product.')->group(function () {

        });
    }); // User Panel Routes group

}); // User auth. Group





