<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login.index');
    }

    public function login(LoginRequest $request)
    {
        if (auth()->attempt($request->only('email', 'password'), (bool)($request->remember_me == "on"))) {
            return redirect()->route('admin.index');
        } else {
            return back();
        }
    }

    public function logout()
    {
        auth()->logout();
        // session()->destroy();
        return redirect()->route('auth.login.index');
    }
}
