<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use Auth;
use Image;

class ProductController extends Controller
{
    public function products()
    {
        $products = Product::with(['section', 'category'])->get()->toArray();
        // dd($products);
        return view('admin.products.products', compact('products'));
    }

    public function updateProductStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }

            Product::where('id', $data['product_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'product_id' => $data['product_id']]);
        }
    }

    public function deleteProduct($id)
    {
        Product::where('id', $id)->delete();
        $message = "Product has been deleted successfully!";
        return redirect()->back()->with('success_message', $message);
    }

    public function addEditProduct(Request $request, $id = null)
    {
        if($id == ''){
            $title = "Add Product";
            $product = new Product;
            $message = "Product added successfully!";
        }else{
            $title = "Edit Product";
        }

        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r(Auth::guard('admin')->user()); die;
            $rules = [
                'category_id' => 'required',
                'product_name' => 'required',
                'product_code' => 'required',
                'product_price' => 'required|numeric',
                'product_color' => 'required|regex:/^[\pL\s\-]+$/u',
            ];

            $customMessage = [
                'category_id.required' => 'Category is required',
                'prouct_name.required' => 'Product name is required',
                // 'product_name.regex' => 'Valid product name needed',
                'product_code.required' => 'Product code is required',
                'product_price.required' => 'Product price is required', 
                'product_price.numeric' => 'Product price should be a number', 
                'product_color.required' => 'Product color is required',
                'product_color.regex' => 'Valid product color needed',  
            ];

            $this->validate($request,$rules,$customMessage);

            // Upload Product Image After Resize: small-250x250, medium-500x500 large-1000x1000
            if($request->hasFile('product_image')){
                $image_tmp = $request->file('product_image');
                if($image_tmp->isValid()){
                    // Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();

                    // Generate image name
                    $imageName = rand(111,99999).'.'.$extension;
                    $largeImagePath = 'admin/photos/product_images/large/'.$imageName;
                    $mediumImagePath = 'admin/photos/product_images/medium/'.$imageName;
                    $smallImagePath = 'admin/photos/product_images/small/'.$imageName;

                    // Upload the large, medium, small images after resize
                    Image::make($image_tmp)->resize(1000,1000)->save($largeImagePath);
                    Image::make($image_tmp)->resize(500,500)->save($mediumImagePath);
                    Image::make($image_tmp)->resize(250,250)->save($smallImagePath);
                    // Insert image in product table
                    $product->product_image = $imageName;
                }
            }

            // Upload product video
            if($request->hasFile('product_video')){
                $video_tmp = $request->file('product_video');
                if($video_tmp->isValid()){
                    // Upload video in videos folder
                    // $video_name = $video_tmp->getClientOriginalName();
                    $extension = $video_tmp->getClientOriginalExtension();
                    $videoName = rand(111,99999).'.'.$extension;
                    $videoPath = 'admin/videos/product_video/';
                    $video_tmp->move($videoPath,$videoName);
                    // Insert Video name in products table
                    $product->product_video = $videoName;
                }
            }

            // Save products details in product table
            $categoryDetails = Category::find($data['category_id']);
            $product->section_id = $categoryDetails['section_id'];
            $product->category_id = $data['category_id'];
            $product->brand_id = $data['brand_id'];

            $adminType = Auth::guard('admin')->user()->type;
            $vendor_id = Auth::guard('admin')->user()->vendor_id;
            $admin_id = Auth::guard('admin')->user()->id;

            $product->admin_type = $adminType;
            $product->admin_id = $admin_id;
            if($adminType == 'vendor'){
                $product->vendor_id = $vendor_id;
            }else{
                $product->vendor_id = 0;
            }

            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->product_price = $data['product_price'];
            $product->product_discount = $data['product_discount'];
            $product->product_weight = $data['product_weight'];
            $product->description = $data['description'];
            $product->meta_title = $data['meta_title'];
            $product->meta_description = $data['meta_description'];
            $product->meta_keywords = $data['meta_keywords'];

            if(!empty($data['is_featured'])){
                $product->is_featured = $data['is_featured'];
            }else{
                $product->is_featured = "No";
            }

            $product->status = 1;
            $product->save();
            return redirect('admin/products')->with('success_message',$message);
        }



        // Get Section for category & subcategory
        $categories = Section::with('categories')->get()->toArray();
        $brands = Brand::where('status',1)->get()->toArray();
        // dd($categories);

        return view('admin.products.add_edit_product',compact('title','categories','brands'));
    }
}
