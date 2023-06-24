<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function post()
    {
        return response()->json([
            'message' => "Login Success",
            "data" => null,
            'status' => 404
        ], 404);
    }
}
