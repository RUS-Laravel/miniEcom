<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserInformation;
use App\Models\User;
use App\Http\Requests\Web\UserEditRequest;
use App\Http\Requests\Web\InformationRequest;
use Illuminate\Support\Facades\Auth;

class ProfileController extends BaseController
{
    public function index(){
        
        return view('client.profile.index');
    }

    public function store(InformationRequest $request)
    {
        $res = UserInformation::create($request->all());
        return response()->json([
            'message' => $res ? 'User information inserted' : 'Error',
            'status' => (bool)$res
        ]);
    }

    public function data(){
        $user = User::where('id', Auth::user('client')->id)->first();
        $userInformations = UserInformation::with('user:id')->where('user_id', Auth::user('client')->id)->get();
        return response()->json([
            'user' => $user,
            'userInformations' => $userInformations,
            'table' => view('client.profile.table', compact('userInformations','user'))->render(),
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
}
