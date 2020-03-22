<?php

namespace App\Http\Controllers;

use App\user;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function singup(Request $request)
    {
        $request->validate([
            'id'        =>   'required',
            'name'      =>   'required|string',
            'email'     =>   'required|string|email|unique:users',
            'password'  =>   'required|string|confirmed',
        ]);

        $user = new User([
            'id'        =>  $request->id,
            'status'    =>  $request->status,
            'name'      =>  $request->name,
            'email'     =>  $request->email,
            'password'  =>  bcrypt($request->password),
        ]);

        $user->save();

        return response()->json([
            'message' => 'successfully created user!'
        ],201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'         =>  'required|string|email',
            'password'      =>  'required|string',
            'remember_me'   =>  'boolean',
        ]);

        $credenciales = request(['email','password']);

        if(!Auth::attempt($credenciales))
        {
            return response()->json([
                'message'   =>  'No autorizado'
            ], 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Token de acceso personal');
        $token = $tokenResult->token;

        if($request->remember_me)
        {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();

        return  response()->json([
            'access_token'      =>  $tokenResult->accessToken,
            'token_type'        =>  'Bearer',
            'expires_at'        =>  Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json(['message'  =>  'Salio con exito']);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
