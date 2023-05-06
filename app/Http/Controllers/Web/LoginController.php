<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login.index');
    }

    public function account()
    {
        return view('auth.login.user_index');
    }

    public function client(LoginRequest $request)
    {
        if (
            auth("client")->attempt($request->only('email', 'password'), (bool)($request->remember_me == "on"))
            and (User::firstWhere($request->only('email'))->is_user == 2)
        ) {
            return redirect()->route('client.index');
        } else {
            return back();
        }
        return view('auth.login.user_index');
    }

    public function login(LoginRequest $request)
    {
        if (auth()->attempt($request->only('email', 'password'), (bool)($request->remember_me == "on"))) {
            return redirect()->route('admin.index');
        } else {
            return back();
        }
    }

    public function signuout()
    {
        auth("client")->logout();
        // session()->destroy();
        return redirect()->route('login.client');
    }

    public function logout()
    {
        auth()->logout();
        // session()->destroy();
        return redirect()->route('auth.login.index');
    }
}
