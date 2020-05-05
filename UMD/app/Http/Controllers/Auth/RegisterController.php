<?php

namespace App\Http\Controllers\Auth;

use App\Ngo;
use App\User;
use App\Donator;
use App\Manager;
use App\Verifier;
use App\Pickupman;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Providers\RouteServiceProvider;
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
        //$this->middleware('guest:donator');
        //$this->middleware('guest:manager');
        //$this->middleware('guest:pickupman');
        //$this->middleware('guest:verifier');
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
        return view('donator.register', ['url' => 'rdonator']);
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
            //'password' => ['required', 'string', 'min:8'],
            'ngo_id' => ['required', 'numeric'],
            'pimage' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ])->validate();

        //upload image

        $image = $request->file('pimage');
        if ($image != null) {
            $name = $image->getClientOriginalName();
            $nameimg = explode('.', $name);
            $ext = $image->getClientOriginalExtension();
            $imagename = 'IMG_' . time() . '_' . $nameimg[0] . '.' . $ext;
            $image->storeAs('/public' . __('custom.managerpath'), $imagename);
            //$destinationPath = url(__('custom.managerpath'));
            //$image->move($destinationPath, $imagename);
            //$profileimgurl = url('/') . '/images/manager/' . $imagepath;

            //register image  
            $token = Str::random(6);
            $manager = Manager::create([
                'name' => $request['name'],
                'email' => $request['email'],
                //'password' => Hash::make($request['password']),
                'token' => $token,
                'ngo_id' => $request['ngo_id'],
                'profileimage' => $imagename,
            ]);
            if ($manager) {
                $data = array('name' => $request->name, 
                                'token' => $token, 
                                'body' => 'The above token is for Create Your Password!!'
                            );
                Mail::send('emailLayouts.createpassword', $data, function ($message) use ($request) {
                    $message->from('goyaniamit111@gmail.com', 'UMD');
                    $message->to($request->email, $request->name);
                });

                return redirect()->route('admin-registermanager')
                    ->with('success', 'NGO Manager registerd successfully');
            } else {
                return back()->withInput()->withErrors(['errmsg' => 'Unknown error']);
            }
        } else {
            return back()->withInput()->withErrors(['errmsg' => 'Image not found.']);
        }
    }

    //this is pickerman funcationality

    public function showPickupmanRegisterForm()
    {
        $ngovar = Manager::select('ngo_id')->where('id', Auth::user()->id)->get();
        $ngo_id = $ngovar[0]->ngo_id;
        return view('ngo.manager.pickupman.register', ['ngo_id' => $ngo_id]);
    }

    protected function createPickupman(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:pickupmen'],
            //'password' => ['required', 'string', 'min:8'],
            'contact' => ['required', 'string', 'size:10', 'unique:pickupmen'],
            'ngo_id' => ['required', 'numeric'],
            'pimage' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ])->validate();

        //upload image

        $image = $request->file('pimage');
        if ($image != null) {
            $name = $image->getClientOriginalName();
            $nameimg = explode('.', $name);
            $ext = $image->getClientOriginalExtension();
            $imagename = 'IMG_' . time() . '_' . $nameimg[0] . '.' . $ext;
            $image->storeAs('/public' . __('custom.pickupmanpath'), $imagename);

            $token = Str::random(6);
            $pickupman = Pickupman::create([
                'name' => $request['name'],
                'email' => $request['email'],
                //'password' => Hash::make($request['password']),
                'token' => $token,
                'contact' => $request['contact'],
                'ngo_id' => $request['ngo_id'],
                'profileimage' => $imagename,
            ]);
            if ($pickupman) {
                $data = array('name' => $request->name, 
                                'token' => $token, 
                                'body' => 'The above token is for Create Your Password!!'
                            );
                Mail::send('emailLayouts.createpassword', $data, function ($message) use ($request) {
                    $message->from('goyaniamit111@gmail.com', 'UMD');
                    $message->to($request->email, $request->name);
                });

                return redirect()->route('DisplayPickupmen')
                    ->with('success', 'Pickupman registerd successfully');
            } else {
                return back()->withInput()->withErrors(['errmsg' => 'Unknown error']);
            }
        } else {
            return back()->withInput()->withErrors(['errmsg' => 'Image not found.']);
        }
    }

    //This is verifier funcationality

    public function showVerifierRegisterForm()
    {
        $ngovar = Manager::select('ngo_id')->where('id', Auth::user()->id)->get();
        $ngo_id = $ngovar[0]->ngo_id;
        return view('ngo.manager.verifier.register', ['ngo_id' => $ngo_id]);
    }

    protected function createVerifier(Request $request)
    {
        //$this->validator($request->all())->validate();
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:donators'],
            //'password' => ['required', 'string', 'min:8'],
            'ngo_id' => ['required'],
            'pimage' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ])->validate();

        $image = $request->file('pimage');
        if ($image != null) {
            $name = $image->getClientOriginalName();
            $nameimg = explode('.', $name);
            $ext = $image->getClientOriginalExtension();
            $imagename = 'IMG_' . time() . '_' . $nameimg[0] . '.' . $ext;
            $image->storeAs('/public' . __('custom.verifierpath'), $imagename);

            $token = Str::random(6);
            $verifier = Verifier::create([
                'name' => $request['name'],
                'email' => $request['email'],
                //'password' => Hash::make($request['password']),
                'token' => $token,
                'ngo_id' => $request['ngo_id'],
                'profileimage' => $imagename,
            ]);
            if ($verifier) {
                $data = array('name' => $request->name, 
                                'token' => $token, 
                                'body' => 'The above token is for Create Your Password!!'
                            );
                Mail::send('emailLayouts.createpassword', $data, function ($message) use ($request) {
                    $message->from('goyaniamit111@gmail.com', 'UMD');
                    $message->to($request->email, $request->name);
                });

                return redirect()->route('DisplayVerifier')
                    ->with('success', 'Verifier registerd successfully');
            } else {
                return back()->withInput()->withErrors(['errmsg' => 'Unknown error']);
            }
        } else {
            return back()->withInput()->withErrors(['errmsg' => 'Image not found.']);
        }

        // $verifier = Verifier::create([
        //     'name' => $request['name'],
        //     'email' => $request['email'],
        //     'password' => Hash::make($request['password']),
        //     'ngo_id' => $request['ngo_id'],
        // ]);
        // return redirect()->intended('login/verifier');
    }
}
