<?php

use App\Http\Controllers\Admin\AdminController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';


// Admin Route Group

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function () {
    // Admin Login
    Route::match(['get', 'post'], '/login', [AdminController::class, 'login']);

    Route::group(['middleware' => ['admin']], function () {
        // Admin dashborar route
        Route::get('/dashboard', [AdminController::class, 'dashboard']);
        // Update Admin Password
        Route::match(['get','post'],'/update-admin-password',[AdminController::class,'updatePassword']);
        Route::post('/check-admin-password',[AdminController::class,'checkAdminPassword']);

        // Update Admin Details
        Route::match(['get','post'],'/update-admin-details',[AdminController::class,'updateAdminDetails']);

        // Vendor Update Details
        Route::match(['get','post'],'update-vendor-details/{slug}',[AdminController::class,'updateVendorDetails']);


        // View Admins/ Subadmins/ Vendors
        Route::get('admins/{type?}',[AdminController::class,'admins']);


        // Admin Logout
        Route::get('/logout',[AdminController::class,'logout']);
    });
});
