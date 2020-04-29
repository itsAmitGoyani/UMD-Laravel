<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Admin;
use App\Donator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Manager;
use App\Ngo;
use App\Pickupman;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use App\Verifier;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        // $this->middleware('guest');
        //$this->middleware('guest:admin');
        $this->middleware('guest:donator');
        $this->middleware('guest:manager');
        $this->middleware('guest:pickupman');
        $this->middleware('guest:verifier');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    //This is admin register functionality

    // public function showAdminRegisterForm()
    // {
    //     return view('auth.register', ['url' => 'admin']);
    // }

    // protected function createAdmin(Request $request)
    // {
    //     //$this->validator($request->all())->validate();
    //     Validator::make($request->all(), [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
    //         'password' => ['required', 'string', 'min:6', 'confirmed'],
    //     ])->validate();
    //     $admin = Admin::create([
    //         'name' => $request['name'],
    //         'email' => $request['email'],
    //         'password' => Hash::make($request['password']),
    //     ]);
    //     return redirect()->intended('login/admin');
    // }

    //This is donator functinality

    public function showDonatorRegisterForm()
    {
        return view('auth.register', ['url' => 'donator']);
    }

    protected function createDonator(Request $request)
    {
        //$this->validator($request->all())->validate();
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:donators'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'contact' => ['required', 'string', 'max:10', 'unique:donators'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'pincode' => ['required', 'string', 'max:6'],
        ])->validate();

        $donator = Donator::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'contact' => $request['contact'],
            'address' => $request['address'],
            'city' => $request['city'],
            'state' => $request['state'],
            'pincode' => $request['pincode'],
        ]);
        return redirect()->intended('login/donator');
    }

    //This is Manager functinality

    public function showManagerRegisterForm()
    {
        $ngos = Ngo::whereNotIn('id', function ($query) {
            $query->select('ngo_id')->from('managers');
        })->get();
        return view('admin.registerManager', ['ngos' => $ngos]);
    }

    protected function createManager(Request $request)
    {
        //$this->validator($request->all())->validate();
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:managers'],
            'password' => ['required', 'string', 'min:8'],
            'ngo_id' => ['required', 'numeric'],
        ])->validate();

        //upload image

        $image = $request->file('pimage');
        if ($image != null) {
            $name = $image->getClientOriginalName();
            $nameimg = explode('.', $name);
            $ext = $image->getClientOriginalExtension();
            $imagepath = $nameimg[0] . '_' . time() . '.' . $ext;
            $destinationPath = public_path('\images\manager');
            $image->move($destinationPath, $imagepath);
            $profileimgurl = url('/') . '/images/manager/' . $imagepath;

            //register image 

            $manager = Manager::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'ngo_id' => $request['ngo_id'],
                'profile_image_url' => $profileimgurl
            ]);
            if ($manager) {
                return redirect()->intended('/admin-registermanager')
                    ->with('success', 'NGO Manager registerd successfully');
            } else {
                return back()->withInput()->withErrors(['errmsg' => 'Unknown error']);
            }
        } else {
            echo "image not";
        }
    }

    //this is pickerman funcationality

    public function showPickermanRegisterForm()
    {
        return view('auth.register', ['url' => 'pickerman']);
    }

    protected function createPickerman(Request $request)
    {
        //$this->validator($request->all())->validate();
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:donators'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'contact' => ['required', 'string', 'max:10', 'unique:donators'],
            'ngo_id' => ['required'],
        ])->validate();
        $pickerman = Pickupman::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'contact' => $request['contact'],
            'ngo_id' => $request['ngo_id'],
        ]);
        return redirect()->intended('login/pickerman');
    }

    //This is verifier funcationality

    public function showVerifierRegisterForm()
    {
        return view('auth.register', ['url' => 'verifier']);
    }

    protected function createVerifier(Request $request)
    {
        //$this->validator($request->all())->validate();
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:donators'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'ngo_id' => ['required'],
        ])->validate();
        $verifier = Verifier::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'ngo_id' => $request['ngo_id'],
        ]);
        return redirect()->intended('login/verifier');
    }
}
