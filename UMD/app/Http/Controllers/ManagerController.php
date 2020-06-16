<?php

namespace App\Http\Controllers;

use App\Ngo;
use App\Manager;
use App\Donation;
use App\MedicineStock;
use App\PickupSchedule;
use Carbon\Traits\Date;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ManagerController extends Controller
{
    public function showdashboard()
    {
        return view('ngo.manager.dashboard');
    }

    public function index()
    {
        $manager = Manager::with('ngo')->get();
        return view('admin.displaymanager', ['managers' => $manager]);
    }

    public function showProfile()
    {
        $manager = Manager::where('id', Auth::user()->id)->first();
        return view('ngo.manager.profile', ['manager' => $manager]);
    }

    public function showChangePasswordForm()
    {
        return view('ngo.manager.changePassword');
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'OldPassword' => 'required|string|min:8',
            'NewPassword' => 'required|string|min:8|different:OldPassword',
            'ConfirmPassword' => 'required|string|min:8|same:NewPassword'
        ]);
        if (Hash::check($request->OldPassword, Auth::user()->password)) {
            if (Manager::where('id', Auth::user()->id)->update(['password' => Hash::make($request->NewPassword)])) {
                Auth::guard('manager')->logout();
                return redirect('/ngo/manager/login')->with('success', 'Password changed Successfully.');
            } else {
                return back()->withErrors(['errmsg' => 'Sorry. Error while updating password.']);
            }
        } else {
            return back()->withErrors(['errmsg' => 'Incorrect old password.']);
        }
    }

    public function showForgotPasswordForm()
    {
        return view('ngo.manager.forgotPassword');
    }

    public function forgotPassword(Request $request)
    {
        Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
        ])->validate();
        if ($manager = Manager::where('email', $request->email)->first()) {
            $token = Str::random(6);
            if (Manager::where('email', $request->email)->update(['token' => $token])) {
                $data = array(
                    'greeting' => 'Hey',
                    'name' => $manager['name'],
                    'token' => $token,
                    'body' => 'Here is the token for create New Password !'
                );
                Mail::send('emailLayouts.createpassword', $data, function ($message) use ($manager) {
                    $message->from('kachhadiya123viral@gmail.com', 'MedCharity');
                    $message->to($manager['email'], $manager['name']);
                    $message->subject('Token for create New Password');
                });

                return redirect()->route('Manager-CreatePassword')
                    ->with('success', 'Token for create new password sent to your email. Create new password here.');
            } else {
                return back()->withInput()->withErrors(['errmsg' => 'Internal error occured.']);
            }
        } else {
            return back()->withInput()->withErrors(['errmsg' => 'Invalid email.']);
        }
    }

    public function viewPickedUpDonations()
    {
        $ngo_id = Auth::user()->ngo_id;
        $date = date("Y-m-d");
        $donations = PickupSchedule::where([
            ['ngo_id', $ngo_id],
            ['date', $date],
            ['status', 'Picked Up'],
        ])->get();
        return view('ngo.manager.viewPickedUpDonations', ['donations' => $donations]);
    }

    public function updatePickedUpDonations($id)
    {
        $donation = PickupSchedule::where('id', $id)->first();
        if (PickupSchedule::where('id', $id)->delete()) {
            $datetime = date('Y-m-d H:i:s');
            $d = Donation::create([
                'donator_id' => $donation->donator_id,
                'ngo_id' => $donation->ngo_id,
                'pickupman_id' => $donation->pickupman_id,
                'datetime' => $datetime,
            ]);
            if ($d) {
                return response()->json(["msg" => "Yes"]);
            }
        }
        return response()->json(["msg" => "No"]);
    }
    public function showDPDForm()
    {
        $ngo = NGO::where('id', Auth::user()->ngo_id)->first();
        return view('ngo.manager.editDPD', ['ngo' => $ngo]);
    }

    public function updateDPD(Request $request)
    {
        $ngo = NGO::where('id', Auth::user()->ngo_id)->update(['dpd' => $request->dpd]);
        if ($ngo) {
            return redirect()->back()->with('success', 'DPD updated Successfully ');
        } else {
            return back()->withErrors(['errmsg' => 'Unknown error']);
        }
    }

    public function viewDonationHistory()
    {
        $today = Donation::where([['ngo_id', Auth::user()->ngo_id], ['datetime', '>=', Carbon::today()]])->orderby('datetime', 'desc')->get();
        $yesterday = Donation::where([['ngo_id', Auth::user()->ngo_id], ['datetime', '=', Carbon::yesterday()]])->orderby('datetime', 'desc')->get();
        $lastweek = Donation::where('ngo_id', Auth::user()->ngo_id)->whereBetween('datetime', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $lastmonth = Donation::where('ngo_id', Auth::user()->ngo_id)->whereBetween('datetime', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get();
        $lastyear = Donation::where('ngo_id', Auth::user()->ngo_id)->whereBetween('datetime', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();
        $all = Donation::where('ngo_id', Auth::user()->ngo_id)->orderby('datetime', 'desc')->get();
        return view('ngo.manager.viewDonationHistory', ['today' => $today, 'yesterday' => $yesterday, 'lastweek' => $lastweek, 'lastmonth' => $lastmonth, 'lastyear' => $lastyear, 'all' => $all]);
    }

    public function viewMedicineStock()
    {
        $medicinestock = MedicineStock::where('ngo_id', Auth::user()->ngo_id)->get();
        return view('ngo.manager.viewMedicineStock', ['medicinestocks' => $medicinestock]);
    }

    public function viewExpireMedicine()
    {
        $date = new DateTime();
        return $date;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ngos = Ngo::whereNotIn('id', function ($query) {
            $query->select('ngo_id')->from('managers');
        })->get();
        $manager = Manager::find($id);
        if ($manager) {
            return view('admin.manager.edit', ['manager' => $manager, 'ngos' => $ngos]);
        }
        return back()->withErrors(['errmsg' => 'Unknown error']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:managers,email,' . $id],
            'password' => ['required', 'string', 'min:8'],
            'ngo_id' => ['required', 'numeric'],
            'pimage' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
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

            //delete old image
            $manager = Manager::find($id);
            $oldImageName = $manager->profile_image_url;
            $filename = storage_path('app/public' . __('custom.managerpath') . '/' . $oldImageName);
            if (file_exists($filename)) {
                unlink($filename);
            }
            $managerUpdate = Manager::where('id', $id)
                ->update([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => $request->input('password'),
                    'ngo_id' => $request->input('ngo_id'),
                    'profileimage' => $imagename,
                ]);
        } else {
            $managerUpdate = Manager::where('id', $id)
                ->update([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => $request->input('password'),
                    'ngo_id' => $request->input('ngo_id'),
                ]);
        }
        if ($managerUpdate) {
            return redirect()->route('admin-displaymanagers')->with('success', 'NGO Manager details Updated Successfully');
        }

        return back()->withInput()->withErrors(['errmsg' => 'Unknown Error']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $findmanager = Manager::find($id);
        if ($findmanager) {
            $imagename = $findmanager->profile_image_url;
            $filename = storage_path('app/public' . __('custom.managerpath') . '/' . $imagename);
            if (file_exists($filename)) {
                unlink($filename);
            }
            if ($findmanager->delete()) {
                return redirect()->route('admin-displaymanagers')
                    ->with('success', 'NGO Manager deleted successfully');
            }
        }
        return back()->withErrors('errmsg', 'NGO Manager is not deleted');
    }
}
