<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

    public function login(Request $request){
        $request->validate([
            'email'    => 'required',
            'password' => 'required|min:5',
        ]);

        if(is_numeric($request->email)){
            if(Auth::attempt(['no_telp' => $request->email, 'password' => $request->password])){
                if(Auth::user()->role == 'admin'){
                    Session::flash('success', 'Berhasil login!');
                    return redirect()->route('dashboard');
                }elseif(Auth::user()->role == 'user'){
                    Session::flash('success', 'Berhasil login!');
                    return redirect()->route('landing.home');
                }
            }else{
                return back()->with('error', 'Maaf No Telpon / Password Salah!');
            }
        }elseif(filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                if(Auth::user()->role == 'admin'){
                    Session::flash('success', 'Berhasil login!');
                    return redirect()->route('dashboard');
                }elseif(Auth::user()->role == 'user'){
                    Session::flash('success', 'Berhasil login!');
                    return redirect()->route('landing.home');
                }
            }else{
                return back()->with('error', 'Maaf Email / Password Salah!');
            }
        }
    }
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
