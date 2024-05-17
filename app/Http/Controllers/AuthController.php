<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use Session;
use App\Models\User;
use App\Models\Login;
use Illuminate\Support\Facades\Validator;

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
            $new_login_user = new Login();
            $new_login_user->id_user = Auth::id();
            $new_login_user->date_login = date('Y-m-d h:i:s');
            $new_login_user->save();
            return redirect()->intended('home');
        } else {
        	return redirect('login')
                ->withError('Error al iniciar sesión');
        }
    }

    public function register(Request $request) {
    	#return view('auth.register');
        $user_by_name = User::where('name', $request->username)->first();
        $user_by_email = User::where('email', $request->email)->first();
        if ($user_by_name || $user_by_email) {
            return redirect('register')
                ->withError('El usuario o email no está disponible');
        }
    	$user = User::create([
    		'full_name' => $request->full_name,
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $credentials = ['name' => $request->username, 'password' => $request->password];
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $new_login_user = new Login();
            $new_login_user->id_user = Auth::id();
            $new_login_user->date_login = date('Y-m-d h:i:s');
            $new_login_user->save();
            return redirect()->intended('home');
        }
    }

    public function logout(Request $request) {
        # Cierra sesión
    	Session::flush();
    	Auth::logout();
    	return redirect('login');
    }

    # Functions API
    public function createUser(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), 
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ]);
            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }
            $user = User::create([
                'full_name' => $request->full_name,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), 
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }
            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
