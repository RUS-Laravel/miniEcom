<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function data()
    {
        return response()->json([
            'message' => null,
            "data" => User::where('is_user', request('is_user'))->get()
        ]);
    }
}
