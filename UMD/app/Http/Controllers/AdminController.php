<?php

namespace App\Http\Controllers;

use App\Admin;
use App\BadFeedback;
use App\Donation;
use App\Donator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    public function showProfile()
    {
        $admin = Admin::where('id',Auth::user()->id)->first();
        return view('admin.profile',['admin' => $admin]);
    }

    public function showChangePasswordForm()
    {
        return view('admin.changePassword');
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'OldPassword' => 'required|string|min:6',
            'NewPassword' => 'required|string|min:6|different:OldPassword',
            'ConfirmPassword' => 'required|string|min:6|same:NewPassword'
        ]);
        if(Hash::check($request->OldPassword, Auth::user()->password))
        {
            if(Admin::where('id' , Auth::user()->id)->update(['password' => Hash::make($request->NewPassword)]))
            {
                Auth::guard('admin')->logout();
                return redirect('/admin/login')->with('success', 'Password changed Successfully.');
            }else{
                return back()->withErrors(['errmsg' => 'Sorry. Error while updating password.']);
            }
        }else{
            return back()->withErrors(['errmsg' => 'Incorrect old password.']);
        }
    }

    public function showBlockDonatorsForm()
    {
        $records = BadFeedback::all();
        return view('admin.manageDonators', ['records' => $records]);
    }

    public function blockDonator($id)
    {
        if(Donator::where('id',$id)->update(['blocked' => true]))
        {
            $recdid = BadFeedback::where('donator_id',$id)->first('donation_id');
            $did = $recdid['donation_id'];
            $donation = Donation::with(['feedback'],['donator'],['ngo'])->where('id', $did)->first();
            $donatoremail = $donation['donator']['email'];
            $donatorname = $donation['donator']['name'];
            $data = array(
                'date' => $donation['datetime'],
                'ngoname' => $donation['ngo']['name'],
                'donatorname' => $donatorname,
                'fcategoryname' => 'Bad',
                'fdescription' => $donation['feedback']['description'],
            );
            Mail::send('emailLayouts.blockDonatorWithFeedback', $data, function ($message) use ($donatoremail, $donatorname) {
                $message->from('goyaniamit111@gmail.com', 'UMD');
                $message->to($donatoremail, $donatorname);
                $message->subject('You were Blocked to Donate at UMD');
            });
            if(BadFeedback::where('donator_id',$id)->delete())
            {
                return back()->with('success','Donator blocked successfully.');
            }else{
                return back()->withErrors(['errmsg' => 'Sorry. Error.']);
            }
        }else{
            return back()->withErrors(['errmsg' => 'Sorry. Error.']);
        }
    }

    public function warnDonator($id)
    {
            $recdid = BadFeedback::where('donator_id',$id)->first('donation_id');
            $did = $recdid['donation_id'];
            $donation = Donation::with(['feedback'],['donator'],['ngo'])->where('id', $did)->first();
            $donatoremail = $donation['donator']['email'];
            $donatorname = $donation['donator']['name'];
            $data = array(
                'date' => $donation['datetime'],
                'ngoname' => $donation['ngo']['name'],
                'donatorname' => $donatorname,
                'fcategoryname' => 'Bad',
                'fdescription' => $donation['feedback']['description'],
            );
            Mail::send('emailLayouts.warnDonatorWithFeedback', $data, function ($message) use ($donatoremail, $donatorname) {
                $message->from('goyaniamit111@gmail.com', 'UMD');
                $message->to($donatoremail, $donatorname);
                $message->subject('You are Warned to Donate at UMD');
            });
            if(BadFeedback::where('donator_id',$id)->delete())
            {
                return back()->with('success','Warning mail sent to donator successfully.');
            }else{
                return back()->withErrors(['errmsg' => 'Sorry. Error.']);
            }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }

    // public function showForgotPasswordForm()
    // {
    //     return view('admin.forgotPassword'); 
    // }

    // public function forgotPassword(Request $request)
    // {
    //     Validator::make($request->all(), [
    //         'email' => ['required', 'string', 'email', 'max:255'],
    //     ])->validate();
    //     if($admin = Admin::where('email',$request->email)->first())
    //     {
    //         $token = Str::random(6);
    //         if(Admin::where('email',$request->email)->update(['token' => $token]))
    //         {
    //             $data = array(
    //                 'greeting' => 'Hey',
    //                 'name' => $admin['name'],
    //                 'token' => $token,
    //                 'body' => 'Here is the token for create New Password !'
    //             );
    //             Mail::send('emailLayouts.createpassword', $data, function ($message) use ($admin) {
    //                 $message->from('kachhadiya123viral@gmail.com', 'MedCharity');
    //                 $message->to($admin['email'], $admin['name']);
    //                 $message->subject('Token for create New Password');
    //             });

    //             return redirect()->route('CreatePassword-Admin')
    //                 ->with('success', 'Token for create new password sent to your email. Create new password here.');
    //         }else{
    //             return back()->withInput()->withErrors(['errmsg' => 'Internal error occured.']);
    //         }
    //     }else{
    //         return back()->withInput()->withErrors(['errmsg' => 'Invalid email.']);
    //     }
    // }

    // public function showCreatePasswordForm()
    // {
    //     return view('admin.createPassword');
    // }

    // public function createPassword(Request $request)
    // {
    //     $this->validate($request, [
    //         'email' => 'required|email|exists:managers,email',
    //         'token' => 'required|string|size:6',
    //         'password' => 'required|min:8',
    //         'confirmpassword' => 'required|min:8|same:password'
    //     ]);
    //     $admin = Admin::where(['email' => $request->email, 'token' => $request->token])
    //         ->update(['password' => Hash::make($request->password)]);
    //     if ($admin) {
    //         return redirect()->route('admin-login')->with('success', 'Password created Successfully.');
    //     }
    //     return back()->withInput()->withErrors(['errmsg' => 'Invalid Email or Token.']);
    // }

}
