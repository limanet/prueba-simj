<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate( [
            'email' => 'required|email',
            'password' => 'required'
        ] );

        $remember = ( $request->remember ) ? true : false;

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended( route('users.index') );
        }

        return back()->withErrors( [ 'failed' => 'E-mail y/o contraseña incorrectos.' ] )->withInput();
    }

    public function logout( Request $request )
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
