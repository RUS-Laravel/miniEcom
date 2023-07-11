<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
//        $response = Http::post(
//            url: 'http://127.0.0.1:8001/api/v1/login',
//            data: json_decode('{"email":"mahammad@iflingo.com","password":"1234"}')
//        );
//
////        dd(
////            $response->body(),
////            $response->json(),
////            $response->object(),
////            $response->collect(),
////            $response->status(),
////            $response->successful(),
////            $response->redirect(),
////            $response->failed(),
////            $response->clientError(),
////            $response->headers(),
////        );
//
//        if ($response->successful() and $response->status() == 200 and $token = $response->collect('data')->first)
//            $response = Http::withToken("Bearear $token")
//                ->get('http://localhost:8001/api/v1/users');
//        if ($response->status() == 200) {
//            dd($response->body(), $response->collect());
//        }
        return view('admin.dashboard.index');
    }
}
