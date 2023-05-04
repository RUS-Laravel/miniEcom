<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SizeEditRequest;
use App\Http\Requests\Admin\SizeStoreRequest;
use Illuminate\Http\Request;
use App\Models\Size;
use App\Models\Product;

class SizeController extends BaseController
{
    public function index(){
        return view('admin.products.sizes.index');
    }

    public function data(){
        $data = Size::with('product')->get();
        return response()->json([
            'data'=>$data,
            'table'=>view('admin.products.sizes.table', compact('data'))->render()
        ]);
    }

    public function create(){
        $products = Product::all();
        return view('admin.products.sizes.create', compact('products'));
    }

    public function store(SizeStoreRequest $request){ 
        //dd($request->all());
        foreach($request->name as $item=>$v){
            $data=array(
                'size_name'=>$request->name[$item],
                'size'=>$request->size[$item],
                'product_id'=>$request->product_id
            ); 
            $res = Size::create($data);
        } //dd($data);
        return redirect()->route('admin.sizes.index');
    }

    public function edit($id)
    {
        $size = Size::find($id);
        $products = Product::all();
        return view('admin.products.sizes.edit', compact('size', 'products'));
    }

    public function update(SizeEditRequest $request){
        Size::where('id', $request->id)->update($request->only(app(Size::class)->getFillable()));
        return redirect()->route('admin.sizes.index');
    }

    public function delete($id)
    {
        Size::find($id)->delete();
        return redirect()->route('admin.sizes.index');
    }
}
