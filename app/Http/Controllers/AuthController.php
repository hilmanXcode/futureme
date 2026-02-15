<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.auth.login');
    }

    public function register()
    {
        return view('pages.auth.register');
    }

    public function createuser(Request $request)
    {
        $data = $request->validate([
            'name'      => ['required', 'string'],
            'email'     => ['required', 'email', 'unique:users,email'],
            'password'  => ['required', 'min:8']
        ]);

        $user = new User();

        $user->name     = $data['name'];
        $user->email    = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();

        return redirect()->route('login')->with('success', 'Berhasil membuat akun, silahkan login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function auth(Request $request)
    {
        $data = $request->validate([
            'email'     => ['required', 'email'],
            'password'  => ['required']
        ]);

        if(Auth::attempt($data)){
            
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');

    }
}
