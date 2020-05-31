<?php

namespace App\Http\Controllers;

use App\Ngo;
use App\Admin;
use App\Donator;
use App\Donation;
use App\BadFeedback;
use App\MedicineStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
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

    public function showBlockDonatorsForm()
    {
        $records = BadFeedback::all();
        return view('admin.manageDonators', ['records' => $records]);
    }

    public function blockDonator($id)
    {
        if (Donator::where('id', $id)->update(['blocked' => true])) {
            $recdid = BadFeedback::where('donator_id', $id)->first('donation_id');
            $did = $recdid['donation_id'];
            $donation = Donation::with(['feedback'], ['donator'], ['ngo'])->where('id', $did)->first();
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
            if (BadFeedback::where('donator_id', $id)->delete()) {
                return back()->with('success', 'Donator blocked successfully.');
            } else {
                return back()->withErrors(['errmsg' => 'Sorry. Error.']);
            }
        } else {
            return back()->withErrors(['errmsg' => 'Sorry. Error.']);
        }
    }

    public function warnDonator($id)
    {
        $recdid = BadFeedback::where('donator_id', $id)->first('donation_id');
        $did = $recdid['donation_id'];
        $donation = Donation::with(['feedback'], ['donator'], ['ngo'])->where('id', $did)->first();
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
        if (BadFeedback::where('donator_id', $id)->delete()) {
            return back()->with('success', 'Warning mail sent to donator successfully.');
        } else {
            return back()->withErrors(['errmsg' => 'Sorry. Error.']);
        }
    }
    public function viewMedicineStock()
    {
        $ngo = Ngo::all();
        return view('admin.viewMedicineStock', ['ngos' => $ngo]);
    }
    public function selectMedicineCategory(Request $request)
    {
        $medicinestock = MedicineStock::where('ngo_id', $request->ngo_id)->get();
        return redirect()->back()->with(['medicinestocks' => $medicinestock]);
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
}
