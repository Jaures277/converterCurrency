<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request -> validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);
        $user = new User();

        $user->name = $request->name;

        $user->email = $request->email;

        $user->password = Hash::make($request->password);

        $user->save();

        return response()->json([
            'status' => 1,
            'message' => 'User create'
        ]);
    }
    /**
     * Login
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request -> validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        //verifier si l'utilisateur existe
        $user = User::where('email', $request->email)->first();

        if($user){
            //si l'utilisateur existe on verifie le mot de passe saisie et celle qui est dans la base de donnée
            if(Hash::check($request->password, $user->password))
            {
                //on crée un token
                $token = $user->createToken('auth_token')->plainTextToken;
                return response()->json([
                    'status' => 1,
                    'message' => 'connexion sucessful',
                    'access_token' => $token
                ]);
            }else{
                return response()->json([
                    'status' => 0,
                    'message' => 'password inccorect'
                ]);
            }
        }else{

            return response()->json([
                'status' => 0,
                'message' => 'Undefind User'
            ],404);
        }

    }
    /**
     * Logout
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['msg' => 'Logout Successfull']);

    }
    public function profile(Request $resquest)
    {
        //cette methode nous donne les informations de l'utilisateur
        return response()->json([
            'status' => 1,
            'message' => 'profile information',
            "datas" => Auth::user()
        ]);
    }
}
