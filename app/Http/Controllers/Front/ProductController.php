<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ProductController extends Controller
{
    public function listing()
    {
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
            return view('front.products.listing', compact('categoryDetails', 'categoryProducts'));
        } else {
            abort(404);
        }
    }
}
