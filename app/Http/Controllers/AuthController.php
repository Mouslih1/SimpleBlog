<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function doLogin(LoginRequest $request)
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('blog.index'));
        }

        return to_route('login')->with('error', 'Incorrect credentials !');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('error', 'Vous étes déconnecter');
    }

    public function inscrire()
    {
        return view('auth.inscrire');
    }

    public function doInscrire(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:4',
            'password_confirmation' => 'required|same:password'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);


        return redirect()->route('login')->with('success', 'Vous avez enregistrer dans le system');
    }
}
