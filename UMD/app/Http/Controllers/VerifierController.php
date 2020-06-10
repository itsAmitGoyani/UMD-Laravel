<?php

namespace App\Http\Controllers;

use App\Donator;
use App\Donation;
use App\Feedback;
use App\Medicine;
use App\Verifier;
use App\BadFeedback;
use App\MedicineStock;
use App\DonationMedicine;
use App\FeedbackCategory;
use App\MedicineCategory;
use Illuminate\Http\Request;
use App\MedicineStockExpiration;
use App\DonationMedicineExpiration;
use App\PickupSchedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
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
        $tpd = Donation::where([['ngo_id',Auth::user()->ngo_id],['status','Pending']])->count();
        $pam = Donation::where([['ngo_id',Auth::user()->ngo_id],['verifier_id',Auth::user()->id],['status','Taken']])->count();
        $pgf = Donation::where([['ngo_id',Auth::user()->ngo_id],['verifier_id',Auth::user()->id],['status','Verified']])->count();
        return view('ngo.verifier.dashboard', ['tpd'=>$tpd , 'pam'=>$pam , 'pgf'=>$pgf]);
    }

    public function showProfile()
    {
        $verifier = Verifier::where('id',Auth::user()->id)->first();
        return view('ngo.verifier.profile',['verifier' => $verifier]);
    }

    public function showChangePasswordForm()
    {
        return view('ngo.verifier.changePassword');
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
            if(Verifier::where('id' , Auth::user()->id)->update(['password' => Hash::make($request->NewPassword)]))
            {
                Auth::guard('verifier')->logout();
                return redirect('/ngo/verifier/login')->with('success', 'Password changed Successfully.');
            }else{
                return back()->withErrors(['errmsg' => 'Sorry. Error while updating password.']);
            }
        }else{
            return back()->withErrors(['errmsg' => 'Incorrect old password.']);
        }
    }

    public function showForgotPasswordForm()
    {
        return view('ngo.verifier.forgotPassword'); 
    }

    public function forgotPassword(Request $request)
    {
        Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
        ])->validate();
        if($verifier = Verifier::where('email',$request->email)->first())
        {
            $token = Str::random(6);
            if(Verifier::where('email',$request->email)->update(['token' => $token]))
            {
                $data = array(
                    'greeting' => 'Hey',
                    'name' => $verifier['name'],
                    'token' => $token,
                    'body' => 'Here is the token for create New Password !'
                );
                Mail::send('emailLayouts.createpassword', $data, function ($message) use ($verifier) {
                    $message->from('kachhadiya123viral@gmail.com', 'MedCharity');
                    $message->to($verifier['email'], $verifier['name']);
                    $message->subject('Token for create New Password');
                });

                return redirect()->route('Verifier-CreatePassword')
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
        $verifier = Verifier::all();
        return view('ngo.manager.verifier.display', ['verifiers' => $verifier]);
    }

    public function showMedicineCategoryForm()
    {
        return view('ngo.verifier.addMedicineCategory');
    }

    public function addMedicineCategory(Request $request)
    {
        $this->validate($request, [
            'category' => 'required|string|unique:medicine_categories,categoryname',
        ]);
        $medicinecategory = new MedicineCategory();
        $medicinecategory->categoryname = $request->category;
        $medicinecategory->save();
        if ($medicinecategory) {
            return redirect()->route('AddMCategory-Verifier')->with('success', 'Medicine Category added successfully.');
        } else {
            return redirect()->route('AddMCategory-Verifier')->withErrors(['errmsg' => 'Sorry. Error']);
        }
    }

    public function viewPendingDonations()
    {
        $ngo_id = Auth::user()->ngo_id;
        $donations = Donation::where([['ngo_id', $ngo_id], ['status', 'Pending']])->orderBy('date', 'asc')->get();
        return view('ngo.verifier.viewPendingDonations', ['donations' => $donations]);
    }

    public function takePendingDonation($id)
    {
        if (Donation::where([['verifier_id', Auth::user()->id], ['status', 'Taken']])->exists()) {
            return redirect()->route('ViewPDs-Verifier')->withErrors(['errmsg' => 'Sorry. One donation already been taken by you.']);
        }
        $donations = Donation::where('id', $id)->update(['status' => 'Taken', 'verifier_id' => Auth::user()->id]);
        if ($donations) {
            return redirect()->route('ViewTD-Verifier')->with('success', 'Donation taken successfully.');
        } else {
            return back()->withErrors(['errmsg' => 'A problem has been occurred while taking donation.']);
        }
    }

    public function viewTakenDonation()
    {
        $ngo_id = Auth::user()->ngo_id;
        $verifier_id = Auth::user()->id;
        if ($donation = Donation::where([
            ['ngo_id', $ngo_id],
            ['status', 'Taken'],
            ['verifier_id', $verifier_id]
        ])->first()) {
            $mcategories = MedicineCategory::all();
            $dms = DonationMedicine::where('donation_id', $donation->id)->get();
            return view('ngo.verifier.viewTakenDonation', ['donation' => $donation, 'dms' => $dms, 'mcategories' => $mcategories]);
        } else {
            return redirect()->route('ViewPDs-Verifier')->withErrors(['errmsg' => 'You have not any Taken Donation. So take one from Pending Donations.']);
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
        $medicine = Medicine::firstOrNew([
            'name' => $request['name'],
            'category_id' => $request['category'],
            'brand' => $request['brand']
        ]);
        $medicine->save();
        $mid = Medicine::where([
            ['name', $request['name']],
            ['category_id', $request['category']],
            ['brand', $request['brand']],
        ])->first('id');
        $expdates = $request['expdate'];
        $qtys = $request['qty'];
        $totalqty = 0;
        foreach ($qtys as $qty) {
            $totalqty += $qty;
        }

        if (DonationMedicine::create([
            'donation_id' => $request['did'],
            'medicine_id' => $mid->id,
            'qty' => $totalqty
        ])) {
            $dmid = DonationMedicine::where([
                ['donation_id', $request['did']],
                ['medicine_id', $mid->id],
                ['qty', $totalqty],
            ])->first('id');
            foreach (array_combine($expdates, $qtys) as $expdate => $qty) {
                $res = DonationMedicineExpiration::create([
                    'expirydate' => $expdate,
                    'donation_medicine_id' => $dmid->id,
                    'qty' => $qty
                ]);
            }
            return back()->with('success', 'Medicine added successfully');
        }
        return back()->withInput()->withErrors(['errmsg' => 'Unknown error']);
    }

    public function addMedicinesToStock($id)
    {
        $records = DonationMedicine::with(['expirations'])->where('donation_id', $id)->get();
        $today =  date("Y-m-d");
        $ngo_id = Auth::user()->ngo_id;
        foreach ($records as $record) {
            foreach ($record['expirations'] as $expiration) {
                if ($expiration['expirydate'] >= $today) {
                    if ($msid = MedicineStock::where([['ngo_id', $ngo_id], ['medicine_id', $record['medicine_id']]])->first('id')) {
                        MedicineStock::find($msid['id'])->increment('qty', $expiration['qty']);
                        if ($mserecord = MedicineStockExpiration::where([['medicine_stock_id', $msid['id']], ['expirydate', $expiration['expirydate']]])->first()) {
                            $newqty = $mserecord['qty'] + $expiration['qty'];
                            MedicineStockExpiration::where('id', $mserecord['id'])->update(['qty' => $newqty]);
                        } else {
                            MedicineStockExpiration::create(['medicine_stock_id' => $msid['id'], 'expirydate' => $expiration['expirydate'], 'qty' => $expiration['qty']]);
                        }
                    } else {
                        MedicineStock::create(['ngo_id' => $ngo_id, 'medicine_id' => $record['medicine_id'], 'qty' => $expiration['qty']]);
                        $msid = MedicineStock::where([['ngo_id', $ngo_id], ['medicine_id', $record['medicine_id']]])->first('id');
                        MedicineStockExpiration::create(['medicine_stock_id' => $msid['id'], 'expirydate' => $expiration['expirydate'], 'qty' => $expiration['qty']]);
                    }
                }
            }
        }
        if (Donation::where([['verifier_id', Auth::user()->id], ['status', 'Taken']])->update(['status' => 'Verified'])) {
            return redirect()->route('GiveFeedback-Verifier')->with('success', 'Medicines added to Stock successfully.');
        }
        return back()->withErrors(['errmsg' => 'Sorry. Some errors.']);
    }

    public function showFeedbackForm()
    {
        $fcategories = FeedbackCategory::all();
        if ($res = Donation::where([['verifier_id', Auth::user()->id], ['status', 'Verified']])->first('id')) {
            return view('ngo.verifier.feedback', ['id' => $res['id'], 'fcategories' => $fcategories]);
        } else {
            return redirect()->route('ViewTD-Verifier')->withErrors(['errmsg' => 'You can not give feedback because there is not any Verified Donations.']);
        }
    }

    public function submitFeedback(Request $request)
    {
        $this->validate($request, [
            'did' => 'required|numeric',
            'category'   => 'required|numeric',
            'description' => 'required',
        ]);
        $feedback = new Feedback();
        $feedback->category_id = $request->category;
        $feedback->donation_id = $request->did;
        $feedback->description = $request->description;
        $feedback->save();
        $res = Donation::where('id', $request->did)->update(['status' => 'Success']);
        $Donation = Donation::where('id', $request->did)->first();
        if ($feedback && $res) {
            if ($request->category == 2 || $request->category == 3) {
                Donator::where('id', $Donation->donator_id)->update(['bfcount' => '0']);
                $Donatoremail = $Donation->donator->email;
                $Donatorname = $Donation->donator->name;
                $ddate = $Donation->date;
                $dngo = $Donation->ngo->name;
                $fcategoryname = $Donation->feedback->category->categoryname;
                $data = array(
                    'date' => $ddate,
                    'ngo' => $dngo,
                    'donatorname' => $Donatorname,
                    'fcategoryname' => $fcategoryname,
                    'fdescription' => $request->description,
                );
                Mail::send('emailLayouts.feedback', $data, function ($message) use ($Donatoremail, $Donatorname) {
                    $message->from('goyaniamit111@gmail.com', 'MedCharity');
                    $message->to($Donatoremail, $Donatorname);
                    $message->subject('Feedback for your Donation');
                });
            } else {
                $count = $Donation->donator->bfcount + 1;
                $donator = Donator::where('id', $Donation->donator->id)->update(['bfcount' => $count]);
                // echo $donator;
                if (BadFeedback::where('donator_id', $Donation->donator->id)->exists()) {
                    $badfeedback = BadFeedback::where('donator_id', $Donation->donator->id)->update(['donation_id' => $request->did]);
                    // echo "id exists";
                    // print_r($badfeedback);
                } else {
                    $badfeedback = new BadFeedback();
                    $badfeedback->donator_id = $Donation->donator->id;
                    $badfeedback->donation_id = $request->did;
                    $badfeedback->save();
                    // echo "new id";
                    // print_r($badfeedback);
                }
            }
            return redirect()->route('ViewPDs-Verifier')->with('success', 'Feedback added successfully.');
        } else {
            return back()->withErrors(['errmsg' => 'Sorry. Some errors.']);
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
