<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\UserLoginRequest;
use App\Http\Resources\User\AuthUserResource;
use App\Http\Requests\Auth\UserRegisterRequest;

class AuthController extends Controller
{
    public function register(UserRegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'user_name' => $request->user_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'is_active' => 1
        ]);

        return ResponseHelper::created();
    }

    public function login(UserLoginRequest $request)
    {
        try{
            $credentials = $request->only('email', 'password');
    
            if (Auth::attempt($credentials) && Auth::user()->is_active) {
                $user = Auth::user();
                $token = $user->createToken('authToken')->plainTextToken;
                $user['token'] = $token;

                return response()->json($user);
                // return new AuthUserResource($user);
            } else {
                return response()->json([
                    'message' => 'Invalid credentials',
                    'status' => Response::HTTP_UNAUTHORIZED
                ]);
            }
        }catch (Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
            // return ResponseHelper::serverError([], $e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        try{
            $request->user()->tokens()->delete();   
            return response()->json([
                'message' => 'Logout successfully.',
                'status' => 200
            ]);
        }catch (Exception $e){
            return response()->json($e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
