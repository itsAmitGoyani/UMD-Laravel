<?php

namespace App\Http\Controllers;

use App\Donation;
use App\DonationMedicine;
use App\DonationMedicineExpiration;
use App\Medicine;
use App\MedicineCategory;
use App\Verifier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VerifierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function showDashboard()
    {
        return view('ngo.verifier.dashboard');
    }

    public function index()
    {
        $verifier = Verifier::all();
        return view('ngo.manager.verifier.display', ['verifiers' => $verifier]);
    }

    public function viewPendingDonations()
    {
        $ngo_id = Auth::user()->ngo_id;
        $donations = Donation::where([
                                        ['ngo_id', $ngo_id],
                                        ['status', 'Pending'],
                                    ])
                                ->orderBy('datetime','asc')
                                ->get();
        return view('ngo.verifier.viewPendingDonations', ['donations' => $donations]);
    }

    public function takePendingDonation($id)
    {
        if(Donation::where([['verifier_id', Auth::user()->id],['status', 'Taken']])->exists())
        {
            return redirect()->route('ViewPDs-Verifier')->withErrors(['errmsg'=>'Sorry. One donation already been taken by you.']);
        }
        $donations = Donation::where('id', $id)->update(['status' => 'Taken' , 'verifier_id' => Auth::user()->id]);
        if ($donations) {
            return redirect()->route('ViewTD-Verifier')->with('success','Donation taken successfully.');
        } else {
            return back()->withErrors(['errmsg'=>'A problem has been occurred while taking donation.']);
        }
    }
    
    public function viewTakenDonation()
    {
        $ngo_id = Auth::user()->ngo_id;
        $verifier_id = Auth::user()->id;
        $donation = Donation::where([
                                        ['ngo_id', $ngo_id],
                                        ['status', 'Taken'],
                                        ['verifier_id', $verifier_id],
                                ])->first();
        $mcategories = MedicineCategory::all();
        return view('ngo.verifier.viewTakenDonation', ['donation' => $donation , 'mcategories' => $mcategories]);
    }

    public function addMedicine(Request $request)
    {
        $this->validate($request, [
            'did' => 'required|numeric',
            'name'   => 'required|string',
            'category'   => 'required|numeric',
            'brand' => 'required|string',
            'expdate'   => 'required',
            'qty'   => 'required|numeric',
        ]);
        $medicine = Medicine::firstOrNew(['name' => $request['name'], 
                                        'category_id' => $request['category'], 
                                        'brand' => $request['brand']]);
        $medicine->save();
        $mid = Medicine::where([
                                ['name' , $request['name']], 
                                ['category_id' , $request['category']], 
                                ['brand' , $request['brand']],
                            ])->first('id');        
        
        if(DonationMedicine::create(['donation_id' => $request['did'],
                                    'medicine_id' => $mid->id,
                                    'qty' => $request['qty']])) {
            $dmid = DonationMedicine::where([
                                    ['donation_id' , $request['did']], 
                                    ['medicine_id' ,$mid->id], 
                                    ['qty' , $request['qty']],
                                ])->first('id');
            if(DonationMedicineExpiration::create(['expirydate' => $request['expdate'],
                                                    'donation_medicine_id' => $dmid->id,
                                                    'qty' => $request['qty']])) {
                return back()->with('success','Medicine added successfully');
            }
        }
        return back()->withInput()->withErrors(['errmsg' => 'Unknown error']);
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
     * @param  \App\Verifier  $verifier
     * @return \Illuminate\Http\Response
     */
    public function show(Verifier $verifier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Verifier  $verifier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $verifier = Verifier::find($id);
        if ($verifier) {
            return view('ngo.manager.verifier.edit', ['verifier' => $verifier]);
        }
        return back()->withErrors(['errmsg' => 'Unknown error']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Verifier  $verifier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:verifiers,email,' . $id],
            'pimage' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ])->validate();

        $image = $request->file('pimage');
        if ($image != null) {
            $name = $image->getClientOriginalName();
            $nameimg = explode('.', $name);
            $ext = $image->getClientOriginalExtension();
            $imagename = 'IMG_' . time() . '_' . $nameimg[0] . '.' . $ext;
            $image->storeAs('/public' . __('custom.verifierpath'), $imagename);

            //delete old image
            $verifier = Verifier::find($id);
            $oldImageName = $verifier->profileimage;
            $filename = storage_path('app/public' . __('custom.verifierpath') . '/' . $oldImageName);
            if (file_exists($filename)) {
                unlink($filename);
            }
            $verifierUpdate = Verifier::where('id', $id)
                ->update([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'profileimage' => $imagename,
                ]);
        } else {
            $verifierUpdate = Verifier::where('id', $id)
                ->update([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                ]);
        }
        if ($verifierUpdate) {
            return redirect()->route('DisplayVerifier')->with('success', 'Verifier details Updated Successfully');
        }

        return back()->withInput()->withErrors(['errmsg' => 'Unknown Error']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Verifier  $verifier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $verifier = Verifier::find($id);
        if ($verifier) {
            $imagename = $verifier->profileimage;
            $filename = storage_path('app/public' . __('custom.verifierpath') . '/' . $imagename);
            if (file_exists($filename)) {
                unlink($filename);
            }
            if ($verifier->delete()) {
                return redirect()->route('DisplayVerifier')
                    ->with('success', 'Verifier deleted successfully');
            }
        }
        return back()->withErrors('errmsg', 'Verifier is not deleted');
    }
}
