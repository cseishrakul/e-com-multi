<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductsFilter;
use App\Models\ProductsFiltersValue;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function filters(){
        $filters = ProductsFilter::get()->toArray();
        // dd($filters); die;
        return view('admin.filters.filters',compact('filters'));
    }
    public function updateFilterStatus(Request $request){
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

    public function filterValues(){
        $filter_values = ProductsFiltersValue::get()->toArray();
        return view('admin.filters.filter_values',compact('filter_values'));
    }

    public function updateFilterValueStatus(Request $request){
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
}
