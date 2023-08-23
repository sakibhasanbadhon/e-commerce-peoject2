<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    public function redirectTo(){
        if (Auth::check() && Auth::user()->is_admin==1) {
            return route('admin.dashboard');
            // return "This is Admin";
        }elseif(Auth::check() && Auth::user()->is_admin==2) {
            return route('customer.dashboard');
        }else{
            return route('login');
        }

    }



    /**
     * user signup
     */

    //  public function signup(Request $request){
    //     return view('auth.register');

    // }

    /**
     * Signup store
     */

    // public function signupStore(Request $request) {
    //     $request->validate([
    //         'name'     => 'required',
    //         'email'    => 'required'|'email',
    //         'password' => 'required|min:8'|'max:55'|'confirmed',
    //     ]);

    //     $signup = User::create([
    //         'name'=> $request->name,
    //         'email'=> $request->email,
    //         'password'=> $request->password,
    //     ]);

    //     if ($signup) {
    //         return redirect()->route('login')->with('error','Signup Success');
    //     }
    // }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    // public function login(Request $request)
    // {
    //     $validate = $request->validate([
    //         'email' =>'required|email',
    //         'password' =>'required',
    //     ]);

    //     if (auth()->attempt(array('email' => $request->email,'password' => $request->password))) {

    //         if (auth()->user()->is_admin==1) {
    //             return redirect()->route('admin.dashboard');
    //         }elseif(auth()->user()->is_admin==2) {
    //             return redirect()->route('customer.dashboard');
    //         }
    //     }else {
    //         return redirect()->back()->with('error','Invalid email or password');
    //     }


    // }


    // public function adminLogin()
    // {
    //     return view('auth.login');
    // }

}
