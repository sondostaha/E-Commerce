<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        $validateData = Validator::make($request->all(),[
            'email' => 'required|max:50',
            'passsword' => 'required'
        ]);

        if($validateData->failed())
        {
            return response()->json(['message' => 'UnAuthorized Admin',401]);
        }else
        {
            $credentional = request(['email','password']);

            $token = Auth::guard('admin_api')->attempt($credentional);

            //dd($token);

            if(!$token)
            {
                return response()->json(['error'=>true ,'message' => 'UnAuthorized Admin']);
            }

            return response()->json([
                'message' => 'Welcome Back Admin',
                'access_token' => $token
            ]);

        }
    }


    public function logout()
    {
        Auth::guard('admin_api')->logout();
        return response()->json(['error' => false , 'message' => 'Logout Successfully']);
    }
}
