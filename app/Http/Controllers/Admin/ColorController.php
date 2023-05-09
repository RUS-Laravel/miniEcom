<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ColorEditRequest;
use App\Http\Requests\Admin\ColorStoreRequest;
use Illuminate\Http\Request;
use App\Models\Color;


class ColorController extends BaseController
{
    public function index(){
        return view('admin.colors.index');
    }

    public function data(){
        $data = Color::all();
        return response()->json([
            'data'=>$data,
            'table'=>view('admin.colors.table', compact('data'))->render()
        ]);
    }

    public function create(){
        return view('admin.colors.create');
    }

    public function store(ColorStoreRequest $request){
        //$res = Color::create($request->all());
        foreach($request->name as $item=>$v){
            $data=array(
                'color_name'=>$request->name[$item],
                
            ); 
            $res = Color::create($data);
        }
        return redirect()->route('admin.colors.index');
    }

    public function edit($id)
    {
        $color = Color::find($id);
        
        return view('admin.colors.edit', compact('color'));
    }

    public function update(ColorEditRequest $request){
        //Color::where('id', $request->id)->update($request->only(app(Color::class)->getFillable()));
        $res = Color::where('id', $request->id)->update(['cat_name'=>$request->name]);
        return redirect()->route('admin.colors.index');
    }

    public function delete($id)
    {
        Color::find($id)->delete();
        return redirect()->route('admin.colors.index');
    }
}
