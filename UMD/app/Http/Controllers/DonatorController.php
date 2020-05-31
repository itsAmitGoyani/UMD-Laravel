<?php

namespace App\Http\Controllers;

use App\Donation;
use App\Ngo;
use App\Donator;
use App\PickupSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DonatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('donator.home');
    }

    public function showProfile()
    {
        if($donator = Donator::where('id',Auth::user()->id)->first())
            return view('donator.profile',['donator' => $donator]);
        else
            return back()->withErrors(['errmsg' => 'Unknown error.']);
    }

    public function showChangePasswordForm()
    {
        return view('donator.changePassword');
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'OldPassword' => 'required|string|min:8',
            'NewPassword' => 'required|string|min:8|different:OldPassword',
            'ConfirmPassword' => 'required|string|min:8|same:NewPassword'
        ]);
        if(Hash::check($request->OldPassword, Auth::user()->password))
        {
            if(Donator::where('id' , Auth::user()->id)->update(['password' => Hash::make($request->NewPassword)]))
            {
                Auth::guard('donator')->logout();
                return redirect('/login')->with('success', 'Password changed Successfully.');
            }else{
                return back()->withErrors(['errmsg' => 'Sorry. Error while updating password.']);
            }
        }else{
            return back()->withErrors(['errmsg' => 'Incorrect old password.']);
        }
    }

    public function showForgotPasswordForm()
    {
        return view('donator.forgotPassword'); 
    }

    public function forgotPassword(Request $request)
    {
        Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
        ])->validate();
        if($donator = Donator::where('email',$request->email)->first())
        {
            $token = Str::random(6);
            if(Donator::where('email',$request->email)->update(['token' => $token]))
            {
                $data = array(
                    'greeting' => 'Hey',
                    'name' => $donator['name'],
                    'token' => $token,
                    'body' => 'Here is the token for create New Password !'
                );
                Mail::send('emailLayouts.createpassword', $data, function ($message) use ($donator) {
                    $message->from('kachhadiya123viral@gmail.com', 'MedCharity');
                    $message->to($donator['email'], $donator['name']);
                    $message->subject('Token for create New Password');
                });

                return redirect()->route('CreatePassword-Donator')
                    ->with('success', 'Token for create new password sent to your email. Create new password here.');
            }else{
                return back()->withInput()->withErrors(['errmsg' => 'Internal error occured.']);
            }
        }else{
            return back()->withInput()->withErrors(['errmsg' => 'Invalid email.']);
        }
    }
    
    public function showCreatePasswordForm()
    {
        return view('donator.createPassword');
    }

    public function createPassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:donators,email',
            'token' => 'required|string|size:6',
            'password' => 'required|min:8',
            'confirmpassword' => 'required|min:8|same:password'
        ]);
        $manager = Donator::where(['email' => $request->email, 'token' => $request->token])
            ->update(['password' => Hash::make($request->password)]);
        if ($manager) {
            return redirect('/login')->with('success', 'Password created Successfully.');
        }
        return back()->withInput()->withErrors(['errmsg' => 'Invalid Email or Token.']);
    }

    public function disabledates(Request $request)
    {
        $i = 0;
        $date = [];
        $id = $request->id;
        $dpd = NGO::select('dpd')->where('id', $id)->first();
        $disabledaterecord = PickupSchedule::select('date', DB::raw('count(*) as count'))->where('ngo_id', $id)->groupBy('date')->get();
        foreach ($disabledaterecord as $disabledaterecord) {
            if ($disabledaterecord->count >= $dpd->dpd) {
                $date[$i] = $disabledaterecord->date;
                $i++;
            }
        }
        return response($date);
    }

    public function showDonateForm()
    {
        // $disabledaterecord = PickupSchedule::select('date', DB::raw('count(*) as count'))->groupBy('date')->get();
        // for ($i = 0; $i < count($disabledaterecord); $i++) {
        //     $disabledate[$i] = $disabledaterecord[$i]->date;
        // }
        $data = array();
        $ngoids = PickupSchedule::where('donator_id',Auth::user()->id)->get('ngo_id');
        foreach ($ngoids as $ngoid) {
            $data[] = $ngoid->ngo_id;
        }
        $ngos = Ngo::select('id', 'name')->whereNotIn('id',$data)->get();
        return view('donator.donate', ['ngos' => $ngos]);
    }

    public function donate(Request $request)
    {
        $donator = Donator::where('id', Auth::user()->id)->first();
        $pickupschedule = new PickupSchedule();
        $pickupschedule->donator_id = $donator->id;
        $pickupschedule->ngo_id = $request->ngo_id;
        $pickupschedule->date = $request->date;
        $pickupschedule->save();
        //return $pickupschedule;
        if ($pickupschedule) {
            return back()->with('success', 'Request for donate sent successfully.');
        } else {
            return back()->withInput()->withErrors(['errmsg' => 'Unknown error']);
        }
    }

    public function viewDonations()
    {
        $pendingdonations = PickupSchedule::where('donator_id',Auth::user()->id)->get();
        $donations = Donation::where('donator_id', Auth::user()->id)->get();
        return view('donator.viewDonations', ['donations' => $donations,'pendingdonations' => $pendingdonations]);
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
     * @param  \App\Donator  $donator
     * @return \Illuminate\Http\Response
     */
    public function show(Donator $donator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Donator  $donator
     * @return \Illuminate\Http\Response
     */
    public function edit(Donator $donator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Donator  $donator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Donator $donator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Donator  $donator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donator $donator)
    {
        //
    }
}
