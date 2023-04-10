<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryEditRequest;
use App\Http\Requests\Admin\CategoryStoreRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $parents = Category::all();
        
        return view('admin.categories.index', compact('parents'));
    }

    public function data()
    {
        $data = Category::with('parent')->get();
        return response()->json([
            'data' => $data,
            'parents' => Category::whereNull('parent_id')->get(),
            'table' => view('admin.categories.table', compact('data'))->render(),
        ]);
    }

    public function edit($id)
    {
        
        return response()->json(Category::find($id));
    }

    public function delete($id)
    {
        $category = Category::find($id);

        if ($category->categories()->count() == 0) {
            $category->categories()->delete();
            $category->delete();
        }
        return response()->json([
            'message' => "Data Deleted...!"
        ]);
    }

    public function store(CategoryStoreRequest $request)
    {
        Category::create($request->all());
        return back();
    }

    public function update(CategoryEditRequest $request)
    {
        $result =  Category::where('id', $request->id)->update($request->all());
        return response()->json([
            'message' => $result ? 'Category Updated' : 'Error',
            'status' => (bool)$result
        ]);
    }

    public function category_multi(){
        $parents = Category::whereNull('parent_id')->with('categories')->get();
        return view('admin.categories.cat_multi',compact('parents'));
    }

    public function category_multi_data(){
        $data = Category::whereNull('parent_id')->with('categories')->get();
        return response()->json([
            'data' => $data,
            'multicat' => view('admin.categories.multi_data_cat', compact('data'))->render(),
        ]);
    }
}
