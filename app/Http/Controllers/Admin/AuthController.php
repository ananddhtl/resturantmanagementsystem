<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Admin\RegisterRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginPage()
    {
        $registration = RouteServiceProvider::ADMIN_REGISTRATION;
        return view('auth.login', ['registration' => $registration]);
    }

    public function showRegisterPage()
    {
        return view('auth.register');
    }

    public function login(LoginRequest $request)
    {
        $validated_data = $request->validated();

        if (!Auth::attempt($validated_data, true)) {
            return redirect()->back()->with('loginError', 'The email or password field is invalid.');
        }

        return redirect('/');
    }

    public function register(RegisterRequest $request)
    {
        $validated_data = $request->validated();
        $validated_data['role'] = 'admin';
        User::query()->create($validated_data);
        return redirect()->route('auth.show.login', ['rdt' => route('auth.show.register')]);
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect()->route('auth.show.login', ['msg' => 'logged-out']);
    }
}
