<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserEditRequest;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function data()
    {
        return response()->json([
            'message' => null,
            "data" => User::all()
        ]);
    }

    public function insert(UserStoreRequest $request)
    {
        if(User::create($request->all())){
            return response()->json([
                'message' => 'User inserted',
                "data" => User::where('id', request('id'))->first(),
                'status' => Response::HTTP_OK
            ], Response::HTTP_OK);
        }else{
            return response()->json([
                'message' => 'User UnInserted',
                "data" => null,
                'status' => Response::HTTP_BAD_REQUEST
            ], Response::HTTP_BAD_REQUEST);
        }
        
    }

    public function edit(){
        $user = User::where('id', request('id'))->first();
        return response()->json([
            'message' => null,
            'data' => $user
        ]);
    }

    public function update(UserEditRequest $request){
        $user = User::where('id', $request->id)->first();
        if($user->update($request->all())){
            return response()->json([
                'message' => 'User Updated',
                'data' => $user,
                'status' => Response::HTTP_OK
            ], Response::HTTP_OK);
        }else{
            return response()->json([
                'message' => 'User UnUpdated',
                'data' => null,
                'status' => Response::HTTP_BAD_REQUEST
            ], Response::HTTP_BAD_REQUEST);
        }
         
    }

    public function delete(Request $request){
        $user = User::find(request('id'));
        if( $user == $request->user()){
            return response()->json([
                'message' => 'This user cannot be deleted',
                'data' => User::where('id', request('id'))->first()
            ]);
        }else{
            $user->delete();
            return response()->json([
                'message' => 'User deleted',
                'data' => null,
                'status' => Response::HTTP_OK
            ], Response::HTTP_OK);
        }
        
    }
}
