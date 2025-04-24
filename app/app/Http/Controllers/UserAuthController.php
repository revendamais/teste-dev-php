<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    public function register(Request $request){
        try{
            $registerUserData = $request->validateWithBag('validation',[
                'name'=>'required|string',
                'email'=>'required|string|email|unique:users',
                'password'=>'required|min:8'
            ]);
        }catch(\Exception $e){
            return response()->json(['message'=> 'User Already exists'],409);
        }

        $user = User::create([
            'name' => $registerUserData['name'],
            'email' => $registerUserData['email'],
            'password' => Hash::make($registerUserData['password']),
        ]);
        return response()->json([
            'message' => 'User Created ',
        ],201);
    }

    public function login(Request $request){
        $loginUserData = $request->validate([
            'email'=>'required|string|email',
            'password'=>'required|min:8'
        ]);
        $user = User::where('email',$loginUserData['email'])->first();
        if(!$user || !Hash::check($loginUserData['password'],$user->password)){
            return response()->json([
                'message' => 'Invalid Credentials'
            ],401);
        }
        $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;
        return response()->json([
            'access_token' => $token,
        ]);
    }

    public function logout(Request $request){

        auth()->user()->tokens()->delete();

        return response()->json([
          "message"=>"logged out"
        ],200);
    }
}
