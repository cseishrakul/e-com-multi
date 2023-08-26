<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductsFilter;
use App\Models\ProductsFiltersValue;
use App\Models\Section;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\View;

class FilterController extends Controller
{
    public function filters()
    {
        $filters = ProductsFilter::get()->toArray();
        // dd($filters); die;
        return view('admin.filters.filters', compact('filters'));
    }
    public function updateFilterStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            ProductsFilter::where('id', $data['filter_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'filter_id' => $data['filter_id']]);
        }
    }

    public function filterValues()
    {
        $filter_values = ProductsFiltersValue::get()->toArray();
        return view('admin.filters.filter_values', compact('filter_values'));
    }

    public function updateFilterValueStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            ProductsFiltersValue::where('id', $data['filter_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'filter_id' => $data['filter_id']]);
        }
    }

    public function addEditFilter(Request $request, $id = null)
    {
        if ($id == "") {
            $title = "Add Filter";
            $filter = new ProductsFilter;
            $message = "Filter added successfully!";
        } else {
            $title = "Edit Filter";
            $filter = ProductsFilter::find($id);
            $message = "Filter Updated successfully!";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";print_r($data); die;
            $cat_ids = implode(',', $data['cat_ids']);

            // Save Filter Column details in products_filter table
            $filter->cat_ids = $cat_ids;
            $filter->filter_name = $data['filter_name'];
            $filter->filter_column = $data['filter_column'];
            $filter->status = 1;
            $filter->save();

            // Add filter column in products table
            DB::statement('Alter table products add ' . $data['filter_column'] . ' varchar(255) after description');

            return redirect()->back()->with('success_message', $message);
        }

        // Get section with categorties and subcategories
        $categories = Section::with('categories')->get()->toArray();
        // dd($categories);
        return view('admin.filters.add_edit_filter')->with(compact('title', 'categories', 'filter'));
    }

    public function addEditFilterValue(Request $request, $id = null)
    {
        if ($id == "") {
            $title = "Add Filter Value";
            $filter = new ProductsFiltersValue;
            $message = "Filter value added successfully!";
        } else {
            $title = "Edit Filter Value";
            $filter = ProductsFiltersValue::find($id);
            $message = "Filter value updated successfully!";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();

            // Save Filter Column Values details in products_filter_values table
            $filter->filter_id = $data['filter_id'];
            $filter->filter_value = $data['filter_value'];
            $filter->status = 1;
            $filter->save();

            return redirect()->back()->with('success_message', $message);
        }

        $filters = ProductsFilter::where('status', 1)->get()->toArray();

        return view('admin.filters.add_edit_filter_value')->with(compact('title', 'filters', 'filter'));
    }

    public function categoryFilters(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>";print_r($data);die;
            $category_id = $data['category_id'];
            return response()->json(['view' => (string)View::make('admin.filters.category_filter', compact('category_id'))]);
        }
    }
}
