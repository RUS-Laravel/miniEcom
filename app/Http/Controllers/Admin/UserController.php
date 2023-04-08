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
        $data = User::all();

        return view('admin.users.index', compact('data'));
    }

    public function edit($id)
    {
        return response()->json(User::find($id));
    }

    public function delete($id)
    {
        User::whereId($id)->delete();
        return back();
    }

    public function store(UserStoreRequest $request)
    {
        User::create($request->all());
        return back();
    }

    public function update(UserEditRequest $request)
    {
        $result =  User::where('id', $request->id)->update($request->all());
        return response()->json([
            'message' => $result ? 'User Updated' : 'Error',
            'status' => (bool)$result
        ]);
    }
}
