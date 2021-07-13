<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use Session;
use App\Models\User;

class AuthController extends Controller
{
    public function do_login(Request $request) {
    	$credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);
        $fieldType = filter_var($request->name, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        if (Auth::attempt([$fieldType => $request->name, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('home');
        } else {
        	return redirect('login')
                ->withError('Error al iniciar sesión');
        }
    }

    public function register(Request $request) {
    	#return view('auth.register');
    	$user = User::create([
    		'full_name' => $request->full_name,
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $credentials = ['name' => $request->username, 'password' => $request->password];
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('home');
        }
    }

    public function logout(Request $request) {
    	Session::flush();
    	Auth::logout();
    	return redirect('login');
    }
}
