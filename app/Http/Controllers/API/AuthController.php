<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Auth;

class AuthController extends Controller
{
    public function users() {
        $users = User::all();
        return response()->json([
            'data' => $users
        ]);
    }
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => ' required',
            'confirm_password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ada Kesalahan',
                'data' =>$validator->errors()
            ], 401);
        }

        $input = $request = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] = $user->createToken('auth_token')->plainTextToken;
        $success['name'] = $user->name;

        return response()->json([
            'success' => true,
            'message' => 'Sukses Register',
            'data' => $success
        ], 201);
    }
    public function login(Request $request) {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $auth = Auth::user();
            $success['token'] = $auth->createToken('auth_token')->plainTextToken;
            $success['name'] = $auth->name;
            $success['email'] = $auth->email;
            $success['password'] = $auth->password;

            return response()->json([
                'success' => true,
                'data' => $success,
                'message' => 'Login Sukses'
            ], 200
        );
        }else {
            return response()->json([
                'success' => false,
                'data' => null, 
                'message' => 'Cek Email dan Password'
            ], 400
        );
        }
    }

    public function logout() {
        $logout = auth()->user()->currentAccessToken()->delete();
        $this->response['message'] = 'success';
        return response()->json($this->response, 200);
    }
}
