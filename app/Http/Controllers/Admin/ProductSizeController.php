<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductSizeRequest;
use App\Models\Color_Products;
use Illuminate\Http\Request;
use App\Models\Size;
use App\Models\Product_Size;

class ProductSizeController extends BaseController
{
    public function index(){
        return view('admin.products.sizes.index');
    }

    public function data(){
        $data = Product_Size::with('size:id,size,size_name')->get();
        $products_color = Color_Products::with('color:id,color_name')->with('product:id,title')->get();
        return response()->json([
            'data'=>$data,
            'table'=>view('admin.products.sizes.table', compact('data','products_color'))->render()
        ]);
    }

    public function create(){
        //$products = Product_Size::with('product:id,title')->get();
        $products_color = Color_Products::with('color:id,color_name')->with('product:id,title')->get();
        $sizes = Size::all();
        return view('admin.products.sizes.create', compact('products_color','sizes'));
    }

    public function store(ProductSizeRequest $request){ 
        //dd($request->all());
        foreach($request->size_id as $item=>$v){
            $data=array(
                'size_id'=>$request->size_id[$item],
                'product_color_id'=>$request->product_id
            ); 
            $res = Product_Size::create($data);
        } //dd($data);
        return redirect()->route('admin.products.sizes.index');
    }

    public function edit($id)
    {
        $p_size = Product_Size::find($id);
        $products_color = Color_Products::with('product:id,title')->with('color:id,color_name')->get();
        $sizes = Size::all();
        return view('admin.products.sizes.edit', compact('p_size', 'products_color','sizes'));
    }

    public function update(ProductSizeRequest $request){
        Product_Size::where('id', $request->id)->update($request->only(app(Product_Size::class)->getFillable()));
        return redirect()->route('admin.products.sizes.index');
    }

    public function delete($id)
    {
        Product_Size::find($id)->delete();
        return redirect()->route('admin.products.sizes.index');
    }
}
