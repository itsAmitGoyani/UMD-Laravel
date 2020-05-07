<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Manager;
use App\Pickupman;
use App\Verifier;

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
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:donator')->except('logout');
        $this->middleware('guest:manager')->except('logout');
        $this->middleware('guest:pickupman')->except('logout');
        $this->middleware('guest:verifier')->except('logout');
    }

    //This is admin login functionality

    public function showAdminLoginForm()
    {
        return view('admin.login', ['url' => 'admin']);
    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/admin');
        }
        return back()->withInput()->withErrors(['errmsg' => 'Invalid Email or Password']);
    }

    //This is donator login functionality

    public function showDonatorLoginForm()
    {
        return view('donator.login', ['url' => 'ldonator']);
    }

    public function donatorLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('donator')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/');
        }
        return back()->withInput($request->only('email', 'remember'))->withErrors(['errmsg' => 'Invalid Email or Password']);
    }

    //This is manager functionality

    public function showManagerLoginForm()
    {
        return view('ngo.manager.login');
    }

    public function showManagerCreatePasswordForm()
    {
        return view('ngo.manager.createpassword');
    }

    public function managerCreatePassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:managers,email',
            'token' => 'required|string|size:6',
            'password' => 'required|min:8',
            'confirmpassword' => 'required|min:8|same:password'
        ]);
        $manager = Manager::where(['email' => $request->email, 'token' => $request->token])
            ->update(['password' => Hash::make($request->password)]);
        if ($manager) {
            return redirect('/ngo/manager/login')->with('success', 'Password created Successfully.');
        }
        return back()->withInput()->withErrors(['errmsg' => 'Invalid Email or Token.']);
    }

    public function managerLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('manager')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/ngo/manager');
        }
        return back()->withInput($request->only('email', 'remember'))->withErrors(['errmsg' => 'Invalid Email or Password.']);
    }

    //This is pickupman functionality

    public function showPickupmanLoginForm()
    {
        return view('ngo.pickupman.login');
    }

    public function showPickupmanCreatePasswordForm()
    {
        return view('ngo.pickupman.createpassword');
    }

    public function pickupmanCreatePassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:pickupmen,email',
            'token' => 'required|string|size:6',
            'password' => 'required|min:8',
            'confirmpassword' => 'required|min:8|same:password'
        ]);
        $pickupman = Pickupman::where(['email' => $request->email, 'token' => $request->token])
            ->update(['password' => Hash::make($request->password)]);
        if ($pickupman) {
            return redirect('/ngo/pickupman/login')->with('success', 'Password created Successfully.');
        }
        return back()->withInput()->withErrors(['errmsg' => 'Invalid Email or Token.']);
    }

    public function pickupmanLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('pickupman')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/ngo/pickupman');
        }
        return back()->withInput($request->only('email', 'remember'))->withErrors(['errmsg' => 'Invalid Email or Password.']);
    }

    //This is verifier functionality

    public function showVerifierLoginForm()
    {
        return view('ngo.verifier.login');
    }

    public function showVerifierCreatePasswordForm()
    {
        return view('ngo.verifier.createpassword');
    }

    public function verifierCreatePassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:verifiers,email',
            'token' => 'required|string|size:6',
            'password' => 'required|min:8',
            'confirmpassword' => 'required|min:8|same:password'
        ]);
        $verifier = Verifier::where(['email' => $request->email, 'token' => $request->token])
            ->update(['password' => Hash::make($request->password)]);
        if ($verifier) {
            return redirect('/ngo/verifier/login')->with('success', 'Password created Successfully.');
        }
        return back()->withInput()->withErrors(['errmsg' => 'Invalid Email or Token.']);
    }

    public function verifierLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('verifier')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/ngo/verifier');
        }
        return back()->withInput($request->only('email', 'remember'))->withErrors(['errmsg' => 'Invalid Email or Password.']);
    }
}
