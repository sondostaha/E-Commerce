<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class ProviderAuthController extends Controller
{
    public function register(Request $request)
    {
        $validateData = Validator::make($request->all(),[
            'name' => 'required|max:50',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validateData->failed())
        {
            return response()->json([ 'error' => true , 'message' => $validateData->errors() ]);
        }
        else
        {
           // dd($request->all());
          Provider::create([
                'name' => $request->name ,
                'email' => $request->email ,
                'password' => Hash::make($request->password) ,
            ]);

            $access_token = Str::random(65);

            return response()->json([
                'message' => 'Welcome Now provider',
                'access_token' => $access_token ,
            ]);
           
        }
    }
    public function login(Request $request)
    {
        $validateData = Validator::make($request->all(),[
            'email' => 'required|email',
            'passsword' => 'required'
        ]);

        if($validateData->failed())
        {
            return response()->json(['message' => 'UnAuthorized',401]);
        }else
        {
            $credentional = request(['email','password']);

            $token = auth('provider_api')->attempt($credentional);

            if(!$token)
            {
                return response()->json(['error'=>true ,'message' => 'UnAuthorized']);
            }

            return response()->json([
                'message' => 'Welcome Back Provider',
                'access_token' => $token
            ]);

        }
    }

    public function logout()
    {
        auth('provider_api')->logout();
        return response()->json(['error' => false , 'message' => 'Logout Successfully']);
    }
}
