<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductsFilter;
use App\Models\ProductsFiltersValue;
use App\Models\Section;
use Session;
use DB;
use Illuminate\Support\Facades\Schema;

class FilterController extends Controller
{
    public function filters() {
        Session::put('page', 'filters');
        $filters = ProductsFilter::get()->toArray();
        return view('admin.filters.filters')->with(compact('filters'));
    }

    public function updateFilterStatus(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status'] == "Active") {
                $status = 0;
            }else {
                $status = 1;
            }
            ProductsFilter::where('id', $data['filter_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'filter_id'=>$data['filter_id']]);
        }
    }

    public function deleteFilter($id) {
        $filter_column = ProductsFilter::select('filter_column')->where('id', $id)->first();
        $decode = json_decode(json_encode($filter_column), true);

        if(Schema::hasColumn('products', $decode['filter_column'])) {
            DB::statement('Alter table products drop '.$decode['filter_column']);
        }

        ProductsFilter::where('id', $id)->delete();
        ProductsFiltersValue::where('filter_id', $id)->delete();
        $message = "Filter has been deleted successfully!";
        return redirect()->back()->with('success_message', $message);
    }

    public function addEditFilter(Request $request, $id=null) {
        Session::put('page', 'filters');
        if($id=="") {
            $title = "Add Filter Column";
            $filter = new ProductsFilter;
            $message = "Filter has been added successfully!";   
        }else {
            $title = "Edit Filter Column";
            $filter = ProductsFilter::find($id);
            $message = "Filter has been updated successfully!"; 
        }

        // Get Sections with Categories and Sub-Categories
        $getCategories = Section::with('categories')->get()->toArray();

        if($request->isMethod('post')) {
            $data = $request->all();
            
            $validated = $request->validate([
                'filter_name' => 'required|regex:/^[\pL\s\-\'\&]+$/u',
            ]);

            sort($data['category_ids']);
            $category_ids = implode(',', $data['category_ids']);
            
            // Save Filter Column Details in products_filters table
            $filter->category_ids = $category_ids;
            $filter->filter_name = $data['filter_name'];
            $filter->filter_column = $data['filter_column'];
            $filter->status = 1;
            $filter->save();

            if(!Schema::hasColumn('products', $data['filter_column'])) {
                DB::statement('Alter table products add '.$data['filter_column'].' varchar(255) after product_description');
            }

            return redirect('admin/catalogue-manage/filters')->with('success_message', $message);
        }
        return view('admin.filters.add_edit_filter')->with(compact('title','filter','getCategories'));
    }

    public function filtersValues() {
        Session::put('page', 'filters');
        $filtersValues = ProductsFiltersValue::with('filter')->get()->toArray();
        return view('admin.filters.filters_values')->with(compact('filtersValues'));
    }

    public function updateFiltersValueStatus(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status'] == "Active") {
                $status = 0;
            }else {
                $status = 1;
            }
            ProductsFiltersValue::where('id', $data['filtersValue_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'filtersValue_id'=>$data['filtersValue_id']]);
        }
    }

    public function deleteFilterValues($id) {
        ProductsFiltersValue::where('id', $id)->delete();
        $message = "Filter has been deleted successfully!";
        return redirect()->back()->with('success_message', $message);
    }

    public function addEditFilterValues(Request $request, $id=null) {
        Session::put('page', 'filters');
        if($id=="") {
            $title = "Add Filter Values";
            $filterValue = new ProductsFiltersValue;
            $message = "Filter has been added successfully!";   
        }else {
            $title = "Edit Filter Values";
            $filterValue = ProductsFiltersValue::find($id);
            $message = "Filter has been updated successfully!"; 
        }

        //Get Filters
        $filters = ProductsFilter::where('status', 1)->get()->toArray();

        if($request->isMethod('post')) {
            $data = $request->all();
            
            $validated = $request->validate([
                'filter_value' => 'required',
            ]);

            $filterValue->filter_id = $data['filter_id'];
            $filterValue->filter_value = $data['filter_value'];
            $filterValue->status = 1;
            $filterValue->save();

            return redirect('admin/catalogue-manage/filters-values')->with('success_message', $message);
        }
        return view('admin.filters.add_edit_filter_values')->with(compact('title','filterValue', 'filters'));
    }

    public function categoryFilters(Request $request) {
        if($request->ajax()) {
            $data = $request->all();

            $category_id = $data['category_id'];
            return response()->json([
                'view'=>(String)View::make('admin.filters.category_filters')->with(compact('category_id'))
            ]);
        }
    }
}
