<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Manager;

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
        return view('auth.login', ['url' => 'donator']);
    }

    public function donatorLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('donator')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/donator');
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    //This is manager functionality

    public function showManagerLoginForm()
    {
        return view('ngo.manager.login', ['url' => 'manager']);
    }

    public function showManagerPasswordForm()
    {
        return view('ngo.manager.createpassword');
    }

    public function managerPassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'code' => 'min:6|max:6',
            'password' => 'required|min:8',
            'confirmpassword' => 'required|min:8'
        ]);
        if ($request->password == $request->confirmpassword) {
            $manager = Manager::where(['email' => $request->email, 'token' => $request->code])->update(['password' => Hash::make($request->confirmpassword)]);
            if ($manager) {
                return redirect('/ngo/manager/login')->with('success', 'Password created Successfully');
            }

            return back()->withInput()->withErrors(['errmsg' => 'Unknown Error']);
        }
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
        return back()->withInput()->withErrors(['errmsg' => 'Invalid Email or Password manager']);
    }

    //This is pickupman functionality

    public function showPickupmanLoginForm()
    {
        return view('ngo.pickupman.login');
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
        return back()->withInput($request->only('email', 'remember'));
    }

    //This is verifier functionality

    public function showVerifierLoginForm()
    {
        return view('ngo.verifier.login');
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
        return back()->withInput($request->only('email', 'remember'));
    }
}
