<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // endpoint para registrar usuarios
    public function store(Request $request)
    {
        $validacion = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required'
        ]);

        if ($validacion->fails()) {
            return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
            ], 400);
        } else {
            // Aplica hashing a la contraseña antes de crear el usuario
            $request['password'] = Hash::make($request['password']);

            $usuario = User::create($request->all());
            return response()->json([
                'code' => 200,
                'data' => $usuario,
                'token' => $usuario->createToken('token')->plainTextToken
            ], 200);
        }
    }

    // endpoint para login
    public function login(Request $request)
    {
        $validacion = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);
        if ($validacion->fails()) {
            return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
            ], 400);
        } else {
            //si no falla la certificacion
            if (Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ])) {
                $usuario = User::where('email', $request->email)->first();
                return response()->json([
                    'code' => 200,
                    'data' => $usuario,
                    'token' => $usuario->createToken('token')->plainTextToken
                ]);
            } else {
                return response()->json([
                    'code' => 401,
                    'data' => 'Usuario no autorizado'
                ], 401);
            }
        }
    }
}
