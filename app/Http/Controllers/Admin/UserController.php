<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserEditRequest;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index',compact('users'));
    }

    public function data()
    {
        $data = User::all();
        return response()->json([
            'data' => $data,
            'table' => view('admin.users.table', compact('data'))->render(),
        ]);
    }

    public function store(UserStoreRequest $request)
    {
        //dd($request->all());
        $res = User::create($request->all());
        // $res->image()->create([
        //     'name' => 'picture.jpg',
        //     'path' => 'images/users/'
        // ]);
        return response()->json([
            'message' => $res ? 'User inserted' : 'Error',
            'status' => (bool)$res
        ]);
    }

    public function edit($id)
    {
        return response()->json(User::find($id));
    }

    public function update(UserEditRequest $request)
    {
        $result = User::where('id', $request->id)->update($request->all());
        return response()->json([
            'message' => $result ? 'User updated' : 'Error',
            'status' => (bool)$result
        ]);
    }
    public function delete($id)
    {
        $del = User::find($id)->delete();
        return response()->json([
            'message' => 'User deleted',
            'status' => (bool)$del
        ]);
    }
}
