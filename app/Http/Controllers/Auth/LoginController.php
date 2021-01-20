<?php

namespace App\Http\Controllers\Auth;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(LoginRequest $request)
    {
        $admin = Admin::query()
            ->where('email', $request->get('email'))->first();

        if (!$admin)
            return back()->withErrors('ایمیل یا رمز عبور را اشتباه وارد کرد اید');
        elseif (!Hash::check($request->get('password'), $admin->password)) {
            return back()->withErrors('ایمیل یا رمز عبور را اشتباه وارد کرد اید');
        } else {
            \auth()->login($admin);
            return redirect('/');
        }
    }



}
