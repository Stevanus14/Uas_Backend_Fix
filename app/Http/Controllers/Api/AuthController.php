<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Validator;
use Exception;
use Illuminate\Validation\Rule;
use App\Mail\UserMail;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function register(Request $request) 
    {
        $registrationData = $request->all();
        $validate = Validator::make($registrationData, [
            'name' => 'required|max:60',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required|numeric|regex:/(08)/|digits_between:8,13'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);
        
        $temp = $registrationData['password'];
        $registrationData['password'] = bcrypt($request->password);
        $user=User::create($registrationData);

        try {
            $date = Carbon::now();
            $detail = [
                'email' => $registrationData['email'],
                'password' => $temp,
                'date' => $date
            ];
            Mail::to($registrationData['email'])->send(new UserMail($detail));
            return response([
                'message' => 'Register success.',
                'user' => $user
            ], 200);

        } catch (exception $e) {
            return response([
                'message' => 'Register success but cannot send email.',
                'user' => $user
            ], 200);
        }

        // return response([
        //     'message' => 'Register Success',
        //     'user' => $user
        // ], 200);
    }

    public function verify(Request $request, $id) {
        $user = User::find($id);
        if (is_null($user)) {
            return response([
                'message' => 'User Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'date' => 'required|date',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $user->email_verified_at = $updateData['date'];

        if ($user->save()) {
            return response([
                'message' => 'Email Verification Success',
                'data' => $user
            ], 200);
        }

        return response([
            'message' => 'Email Verification Failed',
            'data' => null
        ], 400);
    }

    public function login(Request $request)
    {
        $loginData=$request->all();
        $validate = Validator::make($loginData, [
            'email' => 'required|email:rfc,dns',
            'password' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        if(!Auth::attempt($loginData))
            return response(['message' => 'Invalid Credentials'], 401);

        $user = Auth::user();
        $token = $user->createToken('Authentication Token')->accessToken;

        return response([
            'message' => 'Authenticated',
            'user' => $user,
            'token_type' => 'Bearer',
            'access_token' => $token
        ]);
    }
}
