<?php


function app_response($data = null, $message = null, $status = 200): \Illuminate\Http\JsonResponse
{
    return response()->json([
        'message' => $message,
        'data' => $data,
        'status' => $status,
    ], $status);
}
