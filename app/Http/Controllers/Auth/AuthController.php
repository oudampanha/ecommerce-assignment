<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
  public function register(Request $request)
  {
    $validate = Validator::make($request->all(), [
      'name' => 'required|string',
      'username' => 'required|string|unique:users',
      'email' => 'required|email|unique:users',
      'password' => 'required|string|min:6',
      'phone' => 'required|string|unique:users',
      'confirm_password' => 'required|same:password',
    ]);
    if ($validate->fails()) {
      return response()->json([
        'status' => 'error',
        'message' => $validate->errors()->getMessages()
      ], 200);
    }
    $user = User::create([
      'name' => $request->name,
      'username' => $request->username,
      'phone' => $request->phone,
      'email' => $request->email,
      'password' => $request->password,
      'role_id' => $request->role_id
    ]);

    $token = $user->createToken('auth_token')->plainTextToken;
    return response()->json([
      'user' => $user,
      'token' => $token,
      'message' => 'Registered successfully'
    ], 201);
  }
  public function login(Request $request)
  {
    $validate = Validator::make($request->all(), [
      'email' => 'required',
      'password' => 'required',
    ]);
    if ($validate->fails()) {
      return response()->json([
        'status' => 'error',
        'message' => $validate->errors()->getMessages()
      ], 200);
    }
    $user = User::where('email', $request->email)->first();
    if (!$user || !Hash::check($request->password, $user->password)) {
      return response()->json([
        'message' => 'Invalid credentials'
      ], 401);
    }
    $token = $user->createToken('auth_token')->plainTextToken;
    return response()->json([
      'status' => 'success',
      'user' => $user,
      'token' => $token,
      'message' => 'Login successfully'
    ]);
  }

  public function logout(Request $request)
  {
    $request->user()->currentAccessToken()->delete();
    return response()->json([
      'status' => 'success',
      'message' => 'Logged out successfully'
    ]);
  }
}
