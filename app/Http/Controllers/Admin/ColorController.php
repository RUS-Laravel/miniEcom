<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ColorEditRequest;
use App\Http\Requests\Admin\ColorStoreRequest;
use Illuminate\Http\Request;
use App\Models\Color;
use App\Models\Product;

class ColorController extends BaseController
{
    public function index(){
        return view('admin.products.colors.index');
    }

    public function data(){
        $data = Color::with('product')->get();
        return response()->json([
            'data'=>$data,
            'table'=>view('admin.products.colors.table', compact('data'))->render()
        ]);
    }

    public function create(){
        $products = Product::all();
        return view('admin.products.colors.create', compact('products'));
    }

    public function store(ColorStoreRequest $request){
        //$res = Color::create($request->all());
        foreach($request->name as $item=>$v){
            $data=array(
                'color_name'=>$request->name[$item],
                'product_id'=>$request->product_id
            ); 
            $res = Color::create($data);
        }
        return redirect()->route('admin.colors.index');
    }

    public function edit($id)
    {
        $color = Color::find($id);
        $products = Product::all();
        return view('admin.products.colors.edit', compact('color', 'products'));
    }

    public function update(ColorEditRequest $request){
        Color::where('id', $request->id)->update($request->only(app(Color::class)->getFillable()));
        return redirect()->route('admin.colors.index');
    }

    public function delete($id)
    {
        Color::find($id)->delete();
        return redirect()->route('admin.colors.index');
    }
}
