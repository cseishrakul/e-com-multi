<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductsAttribute;
use App\Models\ProductsFilter;
use App\Models\ProductsImage;
use App\Models\Section;
use Illuminate\Http\Request;
use Auth;
use Image;

class ProductController extends Controller
{
    public function products()
    {
        $adminType = Auth::guard('admin')->user()->type;
        $vendor_id = Auth::guard('admin')->user()->vendor_id;

        if($adminType =='vendor'){
            $vendorStatus = Auth::guard('admin')->user()->status;
            if($vendorStatus == 0){
                return redirect('admin/update-vendor-details/personal')->with('error_message','Your vendor account is not approved yet. Please make sure to fill your valid personal,business and bank details.');
            }
        }
        $products = Product::with(['section'=>function($query){$query->select('id','name');}, 'category' => function($query){$query->select('id','category_name');}]);
        
        if($adminType == 'vendor'){
            $products = $products->where('vendor_id',$vendor_id);
        }
        
        $products = $products->get()->toArray();
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
        if ($id == '') {
            $title = "Add Product";
            $product = new Product;
            $message = "Product added successfully!";
        } else {
            $title = "Edit Product";
            $product = Product::find($id);
            // dd($product);
            $message = "Product updated successfully!";
        }

        if ($request->isMethod('post')) {
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

            $this->validate($request, $rules, $customMessage);

            // Upload Product Image After Resize: small-250x250, medium-500x500 large-1000x1000
            if ($request->hasFile('product_image')) {
                $image_tmp = $request->file('product_image');
                if ($image_tmp->isValid()) {
                    // Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();

                    // Generate image name
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $largeImagePath = 'admin/photos/product_images/large/' . $imageName;
                    $mediumImagePath = 'admin/photos/product_images/medium/' . $imageName;
                    $smallImagePath = 'admin/photos/product_images/small/' . $imageName;

                    // Upload the large, medium, small images after resize
                    Image::make($image_tmp)->resize(1000, 1000)->save($largeImagePath);
                    Image::make($image_tmp)->resize(500, 500)->save($mediumImagePath);
                    Image::make($image_tmp)->resize(250, 250)->save($smallImagePath);
                    // Insert image in product table
                    $product->product_image = $imageName;
                }
            }

            // Upload product video
            if ($request->hasFile('product_video')) {
                $video_tmp = $request->file('product_video');
                if ($video_tmp->isValid()) {
                    // Upload video in videos folder
                    // $video_name = $video_tmp->getClientOriginalName();
                    $extension = $video_tmp->getClientOriginalExtension();
                    $videoName = rand(111, 99999) . '.' . $extension;
                    $videoPath = 'admin/videos/product_video/';
                    $video_tmp->move($videoPath, $videoName);
                    // Insert Video name in products table
                    $product->product_video = $videoName;
                }
            }

            // Save products details in product table
            $categoryDetails = Category::find($data['category_id']);
            $product->section_id = $categoryDetails['section_id'];
            $product->category_id = $data['category_id'];
            $product->brand_id = $data['brand_id'];
            $product->group_code = $data['group_code'];

            $productFilters = ProductsFilter::productFilters();
            foreach ($productFilters as $filter) {
                // echo $data[$filter['filter_column']]; die;
                $filterAvailable = ProductsFilter::filterAvailable($filter['id'], $data['category_id']);
                if ($filterAvailable == "Yes") {
                    if (isset($filter['filter_column']) && $data[$filter['filter_column']]) {
                        $product->{$filter['filter_column']} = $data[$filter['filter_column']];
                    }
                }
            }

            $adminType = Auth::guard('admin')->user()->type;
            $vendor_id = Auth::guard('admin')->user()->vendor_id;
            $admin_id = Auth::guard('admin')->user()->id;

            $product->admin_type = $adminType;
            $product->admin_id = $admin_id;
            if ($adminType == 'vendor') {
                $product->vendor_id = $vendor_id;
            } else {
                $product->vendor_id = 0;
            }

            if (empty($data['product_discount'])) {
                $data['product_discount'] = 0;
            }
            if (empty($data['product_weight'])) {
                $data['product_weight'] = 0;
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

            if (!empty($data['is_featured'])) {
                $product->is_featured = $data['is_featured'];
            } else {
                $product->is_featured = "No";
            }
            if (!empty($data['is_bestseller'])) {
                $product->is_bestseller = $data['is_bestseller'];
            } else {
                $product->is_bestseller = "No";
            }

            $product->status = 1;
            $product->save();
            return redirect('admin/products')->with('success_message', $message);
        }



        // Get Section for category & subcategory
        $categories = Section::with('categories')->get()->toArray();
        $brands = Brand::where('status', 1)->get()->toArray();
        // dd($categories);
        return view('admin.products.add_edit_product', compact('title', 'categories', 'brands', 'product'));
    }

    public function deleteProductImage($id)
    {
        $productImage = Product::select('product_image')->where('id', $id)->first();

        // Get product image path
        $small_image_path = 'admin/photos/product_images/small/';
        $medium_image_path = 'admin/photos/product_images/medium/';
        $large_image_path = 'admin/photos/product_images/large/';

        // Delete Product small images if exists
        if (file_exists($small_image_path . $productImage->product_image)) {
            unlink($small_image_path . $productImage->product_image);
        }

        // Delete Product medium images if exists
        if (file_exists($medium_image_path . $productImage->product_image)) {
            unlink($medium_image_path . $productImage->product_image);
        }

        // Delete Product large images if exists
        if (file_exists($large_image_path . $productImage->product_image)) {
            unlink($large_image_path . $productImage->product_image);
        }

        // delele product image from products table
        Product::where('id', $id)->update(['product_image' => '']);
        $message = "Product image has been deleted successfully!";
        return redirect()->back()->with('success_message', $message);
    }

    public function deleteProductVideo($id)
    {
        $productVideo = Product::select('product_video')->where('id', $id)->first();

        // Get product video path
        $product_video_path = 'admin/videos/product_video/';
        // Delete product video from product_video folder if exists
        if (file_exists($product_video_path . $productVideo->product_video)) {
            unlink($product_video_path . $productVideo->product_video);
        }

        // Delete product video from product table
        Product::where('id', $id)->update(['product_video' => '']);
        $message = "Product Video Has Been Deleted Successfully!";
        return redirect()->back()->with('success_message', $message);
    }

    // Product Attributes
    public function addAttributes(Request $request, $id)
    {
        $product = Product::select('id', 'product_name', 'product_code', 'product_color', 'product_price', 'product_image')->with('attributes')->find($id);
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;
            foreach ($data['sku'] as $key => $value) {
                if (!empty($value)) {
                    // SKU duplicate check
                    $skuCount = ProductsAttribute::where('sku', $value)->count();
                    if ($skuCount > 0) {
                        return redirect()->back()->with('error_message', 'SKU already exists! Please use another one.');
                    }
                    $sizeCount = ProductsAttribute::where('size', $data['size'])->count();
                    if ($sizeCount > 0) {
                        return redirect()->back()->with('error_message', 'Size already exists! Please use another one.');
                    }

                    $attribute = new ProductsAttribute;
                    $attribute->product_id = $id;
                    $attribute->sku = $value;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->status = 1;
                    $attribute->save();
                }
            }

            return redirect()->back()->with('success_message', 'Product Attributes has been successfully added!');
        }
        return view('admin.products.attributes.add_edit_attributes', compact('product'));
    }

    public function updateAttributeStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }

            ProductsAttribute::where('id', $data['attribute_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'attribute_id' => $data['attribute_id']]);
        }
    }

    public function editAttributes(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";print_r($data);die;
            foreach ($data['attributeId'] as $key => $attribute) {
                if (!empty($attribute)) {
                    ProductsAttribute::where(['id' => $data['attributeId'][$key]])->update(['price' => $data['price'][$key], 'stock' => $data['stock'][$key]]);
                }
            }

            return redirect()->back()->with('success_message', 'Product Attributes has been updated successfully!');
        }
    }

    public function multipleImage(Request $request, $id)
    {
        $product = Product::select('id', 'product_name', 'product_code', 'product_color', 'product_price', 'product_image')->with('images')->find($id);

        if ($request->isMethod('post')) {
            if ($request->hasFile('images')) {
                $images = $request->file('images');

                foreach ($images as $key => $image) {
                    $image_tmp = Image::make($image);
                    $image_name = $image->getClientOriginalName();
                    $extension = $image->getClientOriginalExtension();
                    $imageName = $image_name . rand(111, 99999) . '.' . $extension;
                    $largeImagePath = 'admin/photos/product_images/large/' . $imageName;
                    $mediumImagePath = 'admin/photos/product_images/medium/' . $imageName;
                    $smallImagePath = 'admin/photos/product_images/small/' . $imageName;

                    Image::make($image_tmp)->resize(1000, 1000)->save($largeImagePath);
                    Image::make($image_tmp)->resize(500, 500)->save($mediumImagePath);
                    Image::make($image_tmp)->resize(250, 250)->save($smallImagePath);

                    $image = new ProductsImage;
                    $image->image = $imageName;
                    $image->product_id = $id;
                    $image->status = 1;
                    $image->save();
                }
                return redirect()->back()->with('success_message', 'Product Images Has Been Added Successfully!');
            }
        }

        return view('admin.products.images.add_images', compact('product'));
    }
    public function updateImagesStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }

            ProductsImage::where('id', $data['image_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'image_id' => $data['image_id']]);
        }
    }

    public function deleteProductImages($id)
    {
        $productImage = ProductsImage::select('image')->where('id', $id)->first();

        // Get product image path
        $small_image_path = 'admin/photos/product_images/small/';
        $medium_image_path = 'admin/photos/product_images/medium/';
        $large_image_path = 'admin/photos/product_images/large/';

        // Delete Product small images if exists
        if (file_exists($small_image_path . $productImage->image)) {
            unlink($small_image_path . $productImage->image);
        }

        // Delete Product medium images if exists
        if (file_exists($medium_image_path . $productImage->image)) {
            unlink($medium_image_path . $productImage->image);
        }

        // Delete Product large images if exists
        if (file_exists($large_image_path . $productImage->image)) {
            unlink($large_image_path . $productImage->image);
        }

        // delele product image from products table
        ProductsImage::where('id', $id)->delete();
        $message = "Product image has been deleted successfully!";
        return redirect()->back()->with('success_message', $message);
    }

}
