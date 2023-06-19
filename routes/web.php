<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SectionController;
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
        Route::match(['get', 'post'], '/update-admin-password', [AdminController::class, 'updatePassword']);
        Route::post('/check-admin-password', [AdminController::class, 'checkAdminPassword']);

        // Update Admin Details
        Route::match(['get', 'post'], '/update-admin-details', [AdminController::class, 'updateAdminDetails']);

        // Vendor Update Details
        Route::match(['get', 'post'], 'update-vendor-details/{slug}', [AdminController::class, 'updateVendorDetails']);


        // View Admins/ Subadmins/ Vendors
        Route::get('admins/{type?}', [AdminController::class, 'admins']);

        // View vendor details
        Route::get('view-vendor-details/{id}', [AdminController::class, 'viewVendorDetails']);

        // Updata admin status
        Route::post('update-admin-status', [AdminController::class, 'updateAdminStatus']);

        // Admin Logout
        Route::get('/logout', [AdminController::class, 'logout']);

        // Section
        Route::get('sections',[SectionController::class,'sections']);
        Route::post('update-section-status',[SectionController::class,'updateSectionStatus']);
        Route::get('delete-section/{id}',[SectionController::class,'deleteSection']);
        Route::match(['get','post'],'add-edit-section/{id?}',[SectionController::class,'addEditSection']);

        // Categories
        Route::get('categories',[CategoryController::class,'categories']);
        Route::post('update-category-status',[CategoryController::class,'updateCategoryStatus']);
        Route::match(['get','post'],'add-edit-category/{id?}',[CategoryController::class,'addEditCategory']);
        Route::get('append-categories-level',[CategoryController::class,'appendCategoriesLevel']);
        Route::get('delete-category/{id}',[CategoryController::class,'deleteCategory']);
        Route::get('delete-category-image/{id}',[CategoryController::class,'deleteCategoryImage']);

        // Brands
        Route::get('brands',[BrandController::class,'brands']);
        Route::post('update-brand-status',[BrandController::class,'updateBrandStatus']);
        Route::get('delete-brand/{id}',[BrandController::class,'deleteBrand']);
        Route::match(['get','post'],'add-edit-brand/{id?}',[BrandController::class,'addEditBrand']);


        // Products
        Route::get('products',[ProductController::class,'products']);
        Route::post('update-product-status',[ProductController::class,'updateProductStatus']);
        Route::get('delete-product/{id}',[ProductController::class,'deleteProduct']);
        Route::match(['get','post'],'add-edit-product/{id?}',[ProductController::class,'addEditProduct']);



        // CMS Pages
        Route::get('cms-pages',[CmsController::class,'cmsPages']);
    });
});
