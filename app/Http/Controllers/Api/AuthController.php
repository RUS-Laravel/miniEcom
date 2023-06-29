<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function post(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user and app('hash')->check($request->password, $user->password)) {
            return response()->json([
                'message' => "Login Success",
                "data" => $user->createToken($request->device_name ?? "WEB")->plainTextToken,
                'status' => Response::HTTP_OK
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Login Unsuccess",
                "data" => null,
                'status' => Response::HTTP_BAD_REQUEST
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
