<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SizeEditRequest;
use App\Http\Requests\Admin\SizeStoreRequest;
use Illuminate\Http\Request;
use App\Models\Size;


class SizeController extends BaseController
{
    public function index(){
        return view('admin.sizes.index');
    }

    public function data(){
        $data = Size::all();
        return response()->json([
            'data'=>$data,
            'table'=>view('admin.sizes.table', compact('data'))->render()
        ]);
    }

    public function create(){
        return view('admin.sizes.create');
    }

    public function store(SizeStoreRequest $request){ 
        //dd($request->all());
        foreach($request->name as $item=>$v){
            $data=array(
                'size_name'=>$request->name[$item],
                'size'=>$request->size[$item],
                
            ); 
            $res = Size::create($data);
        } //dd($data);
        return redirect()->route('admin.sizes.index');
    }

    public function edit($id)
    {
        $size = Size::find($id);
        return view('admin.sizes.edit', compact('size'));
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
