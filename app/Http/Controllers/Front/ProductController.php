<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductsAttribute;
use App\Models\ProductsFilter;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Session;
use DB;

class ProductController extends Controller
{
    public function listing(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>";
            // print_r($data);
            // die;
            $url = $data['url'];
            $_GET['sort'] = $data['sort'];
            $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
            if ($categoryCount > 0) {
                $categoryDetails = Category::categoryDetails($url);
                $categoryProducts = Product::with('brand')->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);

                // Checking for dynamic filters
                $productFilters = ProductsFilter::productFilters();
                foreach ($productFilters as $key => $filter) {
                    if (isset($filter['filter_column']) && isset($data[$filter['filter_column']]) && !empty($filter['filter_column']) && !empty($data[$filter['filter_column']])) {
                        $categoryProducts->whereIn($filter['filter_column'], $data[$filter['filter_column']]);
                    }
                }
                // Checking the sort
                if (isset($_GET['sort']) && !empty($_GET['sort'])) {
                    if ($_GET['sort'] == 'product_latest') {
                        $categoryProducts->orderby('products.id', 'Desc');
                    } else if ($_GET['sort'] == 'price_lowest') {
                        $categoryProducts->orderby('products.product_price', 'Asc');
                    } else if ($_GET['sort'] == 'price_highest') {
                        $categoryProducts->orderby('products.product_price', 'Desc');
                    } else if ($_GET['sort'] == 'name_z_a') {
                        $categoryProducts->orderby('products.product_name', 'Desc');
                    } else if ($_GET['sort'] == 'name_a_z') {
                        $categoryProducts->orderby('products.product_name', 'Asc');
                    }
                }

                // Checking the size
                if (isset($data['size']) && !empty($data['size'])) {
                    $productIds = ProductsAttribute::select('product_id')->whereIn('size', $data['size'])->pluck('product_id')->toArray();
                    $categoryProducts->whereIn('products.id', $productIds);
                }

                // Checking the color
                if (isset($data['color']) && !empty($data['color'])) {
                    $productIds = Product::select('id')->whereIn('product_color', $data['color'])->pluck('id')->toArray();
                    $categoryProducts->whereIn('products.id', $productIds);
                }

                // Checking the price
                if (isset($data['price']) && !empty($data['price'])) {
                    foreach ($data['price'] as $key => $price) {
                        $priceArr = explode('-', $price);
                        $productIds[] = Product::select('id')->whereBetween('product_price', [$priceArr[0], $priceArr[1]])->pluck('id')->toArray();
                    }
                    $productIds = call_user_func_array('array_merge', $productIds);
                    // echo "<pre>";print_r($productIds);die;
                    $categoryProducts->whereIn('products.id', $productIds);
                }

                // Checking the brand
                if (isset($data['brand']) && !empty($data['brand'])) {
                    $productIds = Product::select('id')->whereIn('brand_id', $data['brand'])->pluck('id')->toArray();
                    $categoryProducts->whereIn('products.id', $productIds);
                }

                $categoryProducts = $categoryProducts->paginate(30);
                // dd($categoryDetails);
                return view('front.products.ajax_products_listing', compact('categoryDetails', 'categoryProducts', 'url'));
            } else {
                abort(404);
            }
        } else {
            $url = Route::getFacadeRoot()->current()->uri();
            $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
            if ($categoryCount > 0) {
                $categoryDetails = Category::categoryDetails($url);
                $categoryProducts = Product::with('brand')->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);

                // Checking the sort
                if (isset($_GET['sort']) && !empty($_GET['sort'])) {
                    if ($_GET['sort'] == 'product_latest') {
                        $categoryProducts->orderby('products.id', 'Desc');
                    } else if ($_GET['sort'] == 'price_lowest') {
                        $categoryProducts->orderby('products.product_price', 'Asc');
                    } else if ($_GET['sort'] == 'price_highest') {
                        $categoryProducts->orderby('products.product_price', 'Desc');
                    } else if ($_GET['sort'] == 'name_z_a') {
                        $categoryProducts->orderby('products.product_name', 'Desc');
                    } else if ($_GET['sort'] == 'name_a_z') {
                        $categoryProducts->orderby('products.product_name', 'Asc');
                    }
                }

                $categoryProducts = $categoryProducts->paginate(30);
                // dd($categoryDetails);
                return view('front.products.listing', compact('categoryDetails', 'categoryProducts', 'url'));
            } else {
                abort(404);
            }
        }
    }

    public function details($id)
    {
        $productDetails = Product::with(['section', 'category', 'brand', 'vendor', 'attributes' => function ($query) {
            $query->where("stock", ">", 0)->where("status", 1);
        }, 'images'])->find($id)->toArray();
        $categoryDetails = Category::categoryDetails($productDetails['category']['url']);

        // dd($productDetails);
        // Get Similar Products
        $similarProduct = Product::with('brand')->where('category_id', $productDetails['category']['id'])->where('id', '!=', $id)->limit(4)->inRandomOrder()->get()->toArray();

        // Set Session for Recently Viewed Products
        if (empty(Session::get('session_id'))) {
            $session_id = md5(uniqid(rand(), true));
        } else {
            $session_id = Session::get('session_id');
        }

        Session::put('session_id', $session_id);

        // Insert product in table if not already exists
        $countRecentlyViewedProducts = DB::table('recently_viewed_products')->where(['product_id' => $id, 'session_id' => $session_id])->count();

        if ($countRecentlyViewedProducts == 0) {
            DB::table('recently_viewed_products')->insert(['product_id' => $id, 'session_id' => $session_id]);
        }

        // Get Recently Viewed Products Ids
        $recentlyProductsIds = DB::table('recently_viewed_products')->select('product_id')->where('product_id', '!=', $id)->where('session_id', $session_id)->inRandomOrder()->get()->take(4)->pluck('product_id');

        // Get Recently Viewed Products
        $recentlyProducts = Product::with('brand')->whereIn('id',$recentlyProductsIds)->get()->toArray();

        // Get Group Products (Product color)
        $groupProducts = array();
        if(!empty($productDetails['group_code'])){
            $groupProducts = Product::select('id','product_image')->where('id','!=',$id)->where(['group_code' => $productDetails['group_code'],'status' => 1])->get()->toArray();
        }

        // dd($groupProducts);

        $totalStock = ProductsAttribute::where('product_id', $id)->sum('stock');
        // dd($recentlyProducts);
        return view('front.products.detail', compact('productDetails', 'categoryDetails', 'totalStock', 'similarProduct','recentlyProducts','groupProducts'));
    }

    public function getProductPrice(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>";print_r($data);die;
            $getDiscountAttributePrice = Product::getDiscountAttributePrice($data['product_id'], $data['size']);

            return $getDiscountAttributePrice;
        }
    }


    public function vendorListing($vendorid)
    {
        // Get Vendor Shop Name
        $getVendorShop = Vendor::getVendorShop($vendorid);
        // Get Vendor Products
        // $vendorProducts = Product::with('brand')->where('vendor_id',$vendorid)->where('status',1);
        // $vendorProducts->paginate(30);
        $vendorProducts = Product::with('brand')->where('vendor_id', $vendorid)->where('status', 1)->paginate(30);
        // dd($vendorProducts);
        return view('front.products.vendor_listing', compact('getVendorShop', 'vendorProducts'));
    }
}
