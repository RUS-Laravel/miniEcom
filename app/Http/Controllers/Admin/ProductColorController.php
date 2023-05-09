<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductColorRequest;
use Illuminate\Http\Request;
use App\Models\Color;
use App\Models\Product;
use App\Models\Color_Products;

class ProductColorController extends BaseController
{
    public function index(){
        return view('admin.products.colors.index');
    }

    public function data(){
        $data = Color_Products::with('product:id,title')->with('color:id,color_name')->get();
        return response()->json([
            'data'=>$data,
            'table'=>view('admin.products.colors.table', compact('data'))->render()
        ]);
    }

    public function create(){
        $products = Product::all();
        $colors = Color::all();
        return view('admin.products.colors.create', compact('products','colors'));
    }

    public function store(ProductColorRequest $request){
        //$res = Color_Products::create($request->all());
        foreach($request->color_id as $item=>$v){
            $data=array(
                'color_id'=>$request->color_id[$item],
                'product_id'=>$request->product_id
            ); 
            $res = Color_Products::create($data);
        }
        return redirect()->route('admin.products.colors.index');
    }

    public function edit($id)
    {
        $p_color = Color_Products::find($id);
        $products = Product::all();
        $colors = Color::all();
        return view('admin.products.colors.edit', compact('p_color', 'products','colors'));
    }

    public function update(ProductColorRequest $request){
        Color_Products::where('id', $request->id)->update($request->only(app(Color::class)->getFillable()));
        return redirect()->route('admin.products.colors.index');
    }

    public function delete($id)
    {
        Color_Products::find($id)->delete();
        return redirect()->route('admin.products.colors.index');
    }
}
