<?php

namespace App\Http\Controllers;

use App\Pickupman;
use App\PickupSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PickupmanController extends Controller
{
    public function showDashboard()
    {
        return view('ngo.pickupman.dashboard');
    }

    public function showProfile()
    {
        $pickupman = Pickupman::where('id',Auth::user()->id)->first();
        return view('ngo.pickupman.profile',['pickupman' => $pickupman]);
    }

    public function showChangePasswordForm()
    {
        return view('ngo.pickupman.changePassword');
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
            if(Pickupman::where('id' , Auth::user()->id)->update(['password' => Hash::make($request->NewPassword)]))
            {
                Auth::guard('pickupman')->logout();
                return redirect('/ngo/pickupman/login')->with('success', 'Password changed Successfully.');
            }else{
                return back()->withErrors(['errmsg' => 'Sorry. Error while updating password.']);
            }
        }else{
            return back()->withErrors(['errmsg' => 'Incorrect old password.']);
        }
    }

    public function showForgotPasswordForm()
    {
        return view('ngo.pickupman.forgotPassword'); 
    }

    public function forgotPassword(Request $request)
    {
        Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
        ])->validate();
        if($pickupman = Pickupman::where('email',$request->email)->first())
        {
            $token = Str::random(6);
            if(Pickupman::where('email',$request->email)->update(['token' => $token]))
            {
                $data = array(
                    'greeting' => 'Hey',
                    'name' => $pickupman['name'],
                    'token' => $token,
                    'body' => 'Here is the token for create New Password !'
                );
                Mail::send('emailLayouts.createpassword', $data, function ($message) use ($pickupman) {
                    $message->from('kachhadiya123viral@gmail.com', 'MedCharity');
                    $message->to($pickupman['email'], $pickupman['name']);
                    $message->subject('Token for create New Password');
                });

                return redirect()->route('Pickupman-CreatePassword')
                    ->with('success', 'Token for create new password sent to your email. Create new password here.');
            }else{
                return back()->withInput()->withErrors(['errmsg' => 'Internal error occured.']);
            }
        }else{
            return back()->withInput()->withErrors(['errmsg' => 'Invalid email.']);
        }
    }

    public function index()
    {
        $ngo_id = Auth::user()->ngo_id;
        $pickupmen = Pickupman::where('ngo_id', $ngo_id)->get();
        return view('ngo.manager.pickupman.display', ['pickupmen' => $pickupmen]);
    }

    public function viewPendingDonations()
    {
        $ngo_id = Auth::user()->ngo_id;
        $date = date("Y-m-d");
        $donations = PickupSchedule::where([
            ['ngo_id', $ngo_id],
            ['date', $date],
            ['status', 'Pending'],
        ])->get();
        return view('ngo.pickupman.viewPendingDonations', ['donations' => $donations]);
    }

    public function viewTakenDonations()
    {
        $ngo_id = Auth::user()->ngo_id;
        $date = date("Y-m-d");
        $donations = PickupSchedule::where([
            ['ngo_id', $ngo_id],
            ['date', $date],
            ['status', 'Taken'],
        ])->get();
        return view('ngo.pickupman.viewTakenDonations', ['donations' => $donations]);
    }


    public function updatePendingDonation($id)
    {
        $pickupman_id = Auth::user()->id;
        $donations = PickupSchedule::where('id', $id)->update(['pickupman_id' => $pickupman_id, 'status' => 'Taken']);
        if ($donations) {
            $record = PickupSchedule::with(['ngo', 'donator'])->where('id', $id)->first();
            $data = array(
                'ngo_name' => $record['ngo']['name'],
                'donator_name' => $record['donator']['name'],
            );
            Mail::send('emailLayouts.outForPickup', $data, function ($message) use ($record) {
                $message->from('goyaniamit111@gmail.com', 'MedCharity');
                $message->to($record['donator']['email'], $record['donator']['name']);
                $message->subject('Out for Pickup!');
            });
            return response()->json(["msg" => "Yes"]);
        } else {
            return response()->json(["msg" => "No"]);
        }
    }

    public function UpdateTakenDonation($id)
    {

        $donations = PickupSchedule::where('id', $id)->update(['status' => 'Picked Up']);
        if ($donations) {
            $record = PickupSchedule::with(['ngo', 'donator', 'pickupman'])->where('id', $id)->first();
            $data = array(
                'ngo_name' => $record['ngo']['name'],
                'donator_name' => $record['donator']['name'],
                'pickupman_name' => $record['pickupman']['name'],
            );
            Mail::send('emailLayouts.pickedUp', $data, function ($message) use ($record) {
                $message->from('goyaniamit111@gmail.com', 'MedCharity');
                $message->to($record['donator']['email'], $record['donator']['name']);
                $message->subject('Donation Picked Up!');
            });
            return response()->json(["msg" => "Yes"]);
        } else {
            return response()->json(["msg" => "No"]);
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
     * @param  \App\Pickupman  $pickupman
     * @return \Illuminate\Http\Response
     */
    public function show(Pickupman $pickupman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pickupman  $pickupman
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pickupman = Pickupman::find($id);
        if ($pickupman) {
            return view('ngo.manager.pickupman.edit', ['pickupman' => $pickupman]);
        }
        return back()->withErrors(['errmsg' => 'Unknown error']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pickupman  $pickupman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:pickupmen,email,' . $id],
            'contact' => ['required', 'string', 'size:10', 'unique:pickupmen,contact,' . $id],
            'pimage' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ])->validate();
        //upload image
        $image = $request->file('pimage');
        if ($image != null) {
            $name = $image->getClientOriginalName();
            $nameimg = explode('.', $name);
            $ext = $image->getClientOriginalExtension();
            $imagename = 'IMG_' . time() . '_' . $nameimg[0] . '.' . $ext;
            $image->storeAs('/public' . __('custom.pickupmanpath'), $imagename);

            //delete old image
            $pickupman = Pickupman::find($id);
            $oldImageName = $pickupman->profileimage;
            $filename = storage_path('app/public' . __('custom.pickupmanpath') . '/' . $oldImageName);
            if (file_exists($filename)) {
                unlink($filename);
            }
            $pickupmanUpdate = Pickupman::where('id', $id)
                ->update([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'contact' => $request->input('contact'),
                    'profileimage' => $imagename,
                ]);
        } else {
            $pickupmanUpdate = Pickupman::where('id', $id)
                ->update([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'contact' => $request->input('contact'),
                ]);
        }
        if ($pickupmanUpdate) {
            return redirect()->route('DisplayPickupmen')->with('success', 'Pickupman details Updated Successfully');
        }

        return back()->withInput()->withErrors(['errmsg' => 'Unknown Error']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pickupman  $pickupman
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pickupman = Pickupman::find($id);
        if ($pickupman) {
            $imagename = $pickupman->profileimage;
            $filename = storage_path('app/public' . __('custom.pickupmanpath') . '/' . $imagename);
            if (file_exists($filename)) {
                unlink($filename);
            }
            if ($pickupman->delete()) {
                return redirect()->route('DisplayPickupmen')
                    ->with('success', 'Pickupman deleted successfully');
            }
        }
        return back()->withErrors('errmsg', 'Pickupman is not deleted');
    }
}
