<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Section;
use Illuminate\Http\Request;
use Image;

class CategoryController extends Controller
{
    public function categories()
    {
        $categories = Category::with(['section', 'parentcategory'])->get()->toArray();
        // dd($categories);
        return view('admin.categories.categories', compact('categories'));
    }

    public function updateCategoryStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }

            Category::where('id', $data['category_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'category_id' => $data['category_id']]);
        }
    }

    public function addEditCategory(Request $request, $id = null)
    {
        if ($id == '') {
            // Add category
            $title = 'Add Category';
            $category = new Category;
            $getCategories = array();
            $message = "Category added successfully!";
        } else {
            // Edit category
            $title = 'Edit Category';
            $category = Category::find($id);
            $getCategories = Category::with('subcategories')->where(['parent_id' => 0, 'section_id' => $category['section_id']])->get();
            $message = "Category updated successfully!";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            
            $rules = [
                'category_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'section_id' => 'required',
                'url' => 'required'
            ];

            $customMessage = [
                'category_name.required' => 'Category name is required',
                'category_name.regex' => 'Valid name required',
                'section_id.required' => 'Section required',
                'url.required' => 'URL is required'
            ];

            $this->validate($request, $rules, $customMessage);

            if($data['category_discount'] == ''){
                $data['category_discount'] = 0;
            }
            // Upload Category Image
            if ($request->hasFile('category_image')) {
                $image_tmp = $request->file('category_image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111, 9999) . '.' . $extension;
                    $imagePath = 'admin/photos/category_images/' . $imageName;

                    Image::make($image_tmp)->save($imagePath);
                    $category->category_image = $imageName;
                }
            } else {
                $category->category_image = '';
            }

            $category->section_id = $data['section_id'];
            $category->parent_id = $data['parent_id'];
            $category->category_name = $data['category_name'];
            $category->category_discount = $data['category_discount'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->status = 1;
            $category->save();

            return redirect('admin/categories')->with('success_message',$message);
        }

        // Get All Section
        $getSections = Section::get()->toArray();
        return view('admin.categories.add_edit_category', compact('title', 'category', 'getSections','getCategories'));
    }

    public function appendCategoriesLevel(Request $request){
        if($request->ajax()){
            $data = $request->all();
            $getCategories = Category::with('subcategories')->where(['parent_id' => 0,'section_id' => $data['section_id']])->get()->toArray();

            return view('admin.categories.append_categories_level',compact('getCategories'));
        }
    }


    public function deleteCategory($id){
        Category::where('id',$id)->delete();
        $message = "Category deleted successfully!";
        return redirect()->back()->with('success_message',$message);
    }

    public function deleteCategoryImage($id){
        $categoryImage = Category::select('category_image')->where('id',$id)->first();

        // Get category image path
        $category_image_path = 'admin/photos/category_images/';

        // Delete category image from category_image folder
        if(file_exists($category_image_path.$categoryImage->category_image)){
            unlink($category_image_path.$categoryImage->category_image);
        }

        // Delete category image from categories table
        Category::where('id',$id)->update(['category_image' => '']);
        $message = "Category image has been deleted successfully!";
        return redirect()->back()->with('success_message',$message);

    }
}
