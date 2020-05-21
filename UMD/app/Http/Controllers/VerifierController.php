<?php

namespace App\Http\Controllers;

use App\Donation;
use App\DonationMedicine;
use App\DonationMedicineExpiration;
use App\Medicine;
use App\MedicineCategory;
use App\MedicineStock;
use App\MedicineStockExpiration;
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
        $donations = Donation::where([['ngo_id', $ngo_id],['status', 'Pending']])->orderBy('datetime','asc')->get();
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
        if($donation = Donation::where([['ngo_id', $ngo_id],
                                        ['status', 'Taken'],
                                        ['verifier_id', $verifier_id]])->first())
        {
            $mcategories = MedicineCategory::all();
            $dms = DonationMedicine::where('donation_id', $donation->id)->get();
            return view('ngo.verifier.viewTakenDonation', ['donation' => $donation , 'dms' => $dms , 'mcategories' => $mcategories]);
        }else{
            return redirect()->route('ViewPDs-Verifier')->withErrors(['errmsg'=>'You have not any Taken Donation. So take one from Pending Donations.']);
        }                               
        
    }

    public function addMedicine(Request $request)
    {
        $this->validate($request, [
            'did' => 'required|numeric',
            'name'   => 'required|string',
            'category'   => 'required|numeric',
            'brand' => 'required|string',
            'expdate.*'   => 'required',
            'qty.*'   => 'required|numeric',
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
        $expdates = $request['expdate'];
        $qtys = $request['qty'];
        $totalqty = 0;
        foreach($qtys as $qty)
        {
            $totalqty += $qty;
        }
        
        if(DonationMedicine::create(['donation_id' => $request['did'],
                                    'medicine_id' => $mid->id,
                                    'qty' => $totalqty])) {
            $dmid = DonationMedicine::where([
                                    ['donation_id' , $request['did']], 
                                    ['medicine_id' ,$mid->id], 
                                    ['qty' , $totalqty],
                                ])->first('id');
            foreach(array_combine($expdates,$qtys) as $expdate => $qty)
            {
                $res = DonationMedicineExpiration::create(['expirydate' => $expdate,
                                                            'donation_medicine_id' => $dmid->id,
                                                            'qty' => $qty]);
            }
            return back()->with('success','Medicine added successfully');
            
        }
        return back()->withInput()->withErrors(['errmsg' => 'Unknown error']);
    }

    public function addMedicinesToStock($id)
    {
        $records = DonationMedicine::with(['expirations'])->where('donation_id',$id)->get();
        $today =  date("Y-m-d");
        $ngo_id = Auth::user()->ngo_id;
        foreach($records as $record)
        {
            foreach($record['expirations'] as $expiration)
            {
                if($expiration['expirydate'] >= $today)
                {
                    if($msid = MedicineStock::where([['ngo_id',$ngo_id],['medicine_id',$record['medicine_id']]])->first('id'))
                    {
                        MedicineStock::find($msid['id'])->increment('qty',$expiration['qty']);
                        if($mserecord = MedicineStockExpiration::where([['medicine_stock_id',$msid['id']],['expirydate',$expiration['expirydate']]])->first())
                        {
                            $newqty = $mserecord['qty'] + $expiration['qty'];
                            MedicineStockExpiration::where('id',$mserecord['id'])->update(['qty' => $newqty]);
                        }else{
                            MedicineStockExpiration::create(['medicine_stock_id' => $msid['id'] , 'expirydate' => $expiration['expirydate'], 'qty' => $expiration['qty']]);
                        }
                    }else{
                        MedicineStock::create(['ngo_id' => $ngo_id, 'medicine_id' => $record['medicine_id'], 'qty' => $expiration['qty']]);
                        $msid = MedicineStock::where([['ngo_id',$ngo_id],['medicine_id',$record['medicine_id']]])->first('id');
                        MedicineStockExpiration::create(['medicine_stock_id' => $msid['id'] , 'expirydate' => $expiration['expirydate'], 'qty' => $expiration['qty']]);
                    }
                }
            }
        }
        if(Donation::where([['verifier_id',Auth::user()->id],['status','Taken']])->update(['status'=>'Success']))
        {
            return redirect('/ngo/verifier/feedback/'.$id)->with('success','Medicines added to Stock successfully.');    
        }
        return back()->withErrors(['errmsg'=>'Sorry. Some errors.']);
    }

    public function showFeedbackForm($id)
    {
        return 'Here, Feedback Form for Donation id '.$id;
    }

    public function submitFeedback(Request $request)
    {
        
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
