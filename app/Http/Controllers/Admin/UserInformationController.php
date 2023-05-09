<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\UserInformationRequest;
use App\Models\UserInformation;

class UserInformationController extends BaseController
{
    public function store(UserInformationRequest $request){
        $res = UserInformation::create($request->all());
        return response()->json([
            'message' => $res ? 'User information inserted' : 'Error',
            'status' => (bool)$res
        ]);
    }

    public function detail($id)
    {
        $userInfor = UserInformation::with('user')->where('user_id',$id)->get();
        return view('admin.users.informations.detail', compact('userInfor'));
    }
}
