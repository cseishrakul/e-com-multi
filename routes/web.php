<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\FilterController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Front\AddressController;
use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\Front\OrderController;
use App\Http\Controllers\Front\ProductController as FrontProductController;
use App\Http\Controllers\Front\UserController;
use App\Http\Controllers\Front\VendorController;
use App\Models\Category;
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
    Route::match(['get', 'post'], '/login', [AdminController::class, 'login'])->name('admin.login');

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
        Route::get('sections', [SectionController::class, 'sections']);
        Route::post('update-section-status', [SectionController::class, 'updateSectionStatus']);
        Route::get('delete-section/{id}', [SectionController::class, 'deleteSection']);
        Route::match(['get', 'post'], 'add-edit-section/{id?}', [SectionController::class, 'addEditSection']);

        // Categories
        Route::get('categories', [CategoryController::class, 'categories']);
        Route::post('update-category-status', [CategoryController::class, 'updateCategoryStatus']);
        Route::match(['get', 'post'], 'add-edit-category/{id?}', [CategoryController::class, 'addEditCategory']);
        Route::get('append-categories-level', [CategoryController::class, 'appendCategoriesLevel']);
        Route::get('delete-category/{id}', [CategoryController::class, 'deleteCategory']);
        Route::get('delete-category-image/{id}', [CategoryController::class, 'deleteCategoryImage']);

        // Brands
        Route::get('brands', [BrandController::class, 'brands']);
        Route::post('update-brand-status', [BrandController::class, 'updateBrandStatus']);
        Route::get('delete-brand/{id}', [BrandController::class, 'deleteBrand']);
        Route::match(['get', 'post'], 'add-edit-brand/{id?}', [BrandController::class, 'addEditBrand']);


        // Products
        Route::get('products', [ProductController::class, 'products']);
        Route::post('update-product-status', [ProductController::class, 'updateProductStatus']);
        Route::get('delete-product/{id}', [ProductController::class, 'deleteProduct']);
        Route::match(['get', 'post'], 'add-edit-product/{id?}', [ProductController::class, 'addEditProduct']);
        Route::get('delete-product-image/{id}', [ProductController::class, 'deleteProductImage']);
        Route::get('delete-product-video/{id}', [ProductController::class, 'deleteProductVideo']);

        // Multiple Image add in products
        Route::match(['get', 'post'], 'add-images/{id}', [ProductController::class, 'multipleImage']);
        Route::post('update-images-status', [ProductController::class, 'updateImagesStatus']);
        Route::get('delete-image/{id}', [ProductController::class, 'deleteProductImages']);

        // Attributs
        Route::match(['get', 'post'], 'add-edit-attributes/{id}', [ProductController::class, 'addAttributes']);
        Route::post('update-attribute-status', [ProductController::class, 'updateAttributeStatus']);
        Route::match(['get', 'post'], 'edit-attributes/{id}', [ProductController::class, 'editAttributes']);

        // Product Filter
        Route::get('filters', [FilterController::class, 'filters']);
        Route::post('update-filter-status', [FilterController::class, 'updateFilterStatus']);
        Route::get('filter-values', [FilterController::class, 'filterValues']);
        Route::post('update-filter-value-status', [FilterController::class, 'updateFilterValueStatus']);
        Route::match(['get', 'post'], 'add-edit-filter/{id?}', [FilterController::class, 'addEditFilter']);
        Route::match(['get', 'post'], 'add-edit-filter-value/{id?}', [FilterController::class, 'addEditFilterValue']);
        Route::post('category-filters', [FilterController::class, 'categoryFilters']);

        // Banner
        Route::get('banners', [BannerController::class, 'banners']);
        Route::post('update-banner-status', [BannerController::class, 'updateBannerStatus']);
        Route::get('delete-banner/{id}', [BannerController::class, 'deleteBanner']);
        Route::match(['get', 'post'], 'add-edit-banner/{id?}', [BannerController::class, 'addEditBanner']);

        // CMS Pages
        Route::get('cms-pages', [CmsController::class, 'cmsPages']);

        // Coupon
        Route::get('coupons', [CouponController::class, 'coupons']);
        Route::post('update-coupon-status', [CouponController::class, 'updateCouponStatus']);
        Route::get('delete-coupon/{id}', [CouponController::class, 'deleteCoupon']);
        Route::match(['get', 'post'], 'add-edit-coupon/{id?}', [CouponController::class, 'addEditCoupon']);

        // User
        Route::get('users', [AdminUserController::class, 'users']);
        Route::post('update-user-status', [AdminUserController::class, 'updateUserStatus']);

        // Orders
        Route::get('orders',[AdminOrderController::class,'orders']);
        Route::get('orders/{id}',[AdminOrderController::class,'orderDetails']);

    });
});
// End Admin Route Group

// Frontend Route Group
Route::namespace('App\Http\Controllers\Front')->group(function () {
    Route::get('/', [IndexController::class, 'index']);

    $catUrls = Category::select('url')->where('status', 1)->get()->pluck('url')->toArray();
    // dd($catUrls);die;
    foreach ($catUrls as $key => $url) {
        Route::match(['get', 'post'], '/' . $url, [FrontProductController::class, 'listing']);
    }

    // Vendor Products
    Route::get('products/{vendorid}', [FrontProductController::class, 'vendorListing']);

    // Product Details Page
    Route::get('/product/{id}', [FrontProductController::class, 'details']);
    Route::post('get-product-price', [FrontProductController::class, 'getProductPrice']);

    // Vendor Login register
    Route::get('/vendor/login-register', [VendorController::class, 'loginRegister']);

    Route::post('vendor/register', [VendorController::class, 'vendorRegister']);

    // Confirm vendor account
    Route::get('vendor/confirm/{code}', [VendorController::class, 'confirmVendor']);


    // Add to cart
    route::post('cart/add', [FrontProductController::class, 'cartAdd']);
    // Cart page
    route::get('/cart', [FrontProductController::class, 'cart']);
    // Cart Update
    Route::post('cart/update', [FrontProductController::class, 'cartUpdate']);
    // Cart Delete
    Route::post('cart/delete', [FrontProductController::class, 'cartDelete']);


    // User Controller
    Route::get('user/login-register', [UserController::class, 'loginRegister'])->name('login');

    // User Register
    Route::post('user/register', [UserController::class, 'userRegister']);

    // User email confirmation
    Route::get('user/confirm/{code}', [UserController::class, 'confirmAccount']);

    // User Login
    Route::post('user/login', [UserController::class, 'userLogin']);


    Route::group(['middleware' => ['auth']], function () {
        // User Account
        Route::match(['get', 'post'], 'user/account', [UserController::class, 'userAccount']);

        // User Password Update
        Route::post("user/update-password", [UserController::class, 'userUpdatePassword']);

        // Apply Coupon
        Route::post('/apply-coupon', [FrontProductController::class, 'applyCoupon']);


        // Checkout
        Route::match(['get', 'post'], '/checkout', [FrontProductController::class, 'checkout']);

        // Delivery Address
        Route::post('/get-delivery-address', [AddressController::class, 'getDeliveryAddress']);

        Route::post('/save-delivery-address', [AddressController::class, 'saveDeliveryAddress']);
        Route::post('/remove-delivery-address', [AddressController::class, 'removeDeliveryAddress']);

        // Thanks
        Route::get('thanks', [FrontProductController::class, 'thanks']);
        // Users Orders
        Route::get('user/orders/{id?}', [OrderController::class, 'orders']);
    });

    // User logout
    Route::get('user/logout', [UserController::class, 'userLogout']);

    // User forgot password
    Route::match(['get', 'post'], 'user/forgot-password', [UserController::class, 'userForgotPassword']);
});
// End Frontend Route Group