<?php

namespace App\Http\Controllers;

use App\Ngo;
use App\Manager;
use App\Donation;
use App\MedicineStock;
use App\MedicineStockExpiration;
use App\PickupSchedule;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\MedicineCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ManagerController extends Controller
{
    public function showdashboard()
    {
        $td = Donation::where('ngo_id', Auth::user()->ngo_id)->count();
        $tpd = PickupSchedule::where('ngo_id', Auth::user()->ngo_id)->count();
        $yd = Donation::where([['ngo_id', Auth::user()->ngo_id], ['date', '=', Carbon::yesterday()]])->count();
        $pvd = Donation::where([['ngo_id', Auth::user()->ngo_id], ['status', 'Pending']])->count();
        return view('ngo.manager.dashboard', ['td' => $td, 'tpd' => $tpd, 'yd' => $yd, 'pvd' => $pvd]);
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
            $date = date('Y-m-d');
            $d = Donation::create([
                'donator_id' => $donation->donator_id,
                'ngo_id' => $donation->ngo_id,
                'pickupman_id' => $donation->pickupman_id,
                'date' => $date,
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
        $today = Donation::where([['ngo_id', Auth::user()->ngo_id], ['date', '=', Carbon::today()]])->orderby('date', 'desc')->get();
        $yesterday = Donation::where([['ngo_id', Auth::user()->ngo_id], ['date', '=', Carbon::yesterday()]])->orderby('date', 'desc')->get();
        $lastweek = Donation::where('ngo_id', Auth::user()->ngo_id)->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $lastmonth = Donation::where('ngo_id', Auth::user()->ngo_id)->whereBetween('date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get();
        $lastyear = Donation::where('ngo_id', Auth::user()->ngo_id)->whereBetween('date', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();
        $all = Donation::where('ngo_id', Auth::user()->ngo_id)->orderby('date', 'desc')->get();
        return view('ngo.manager.viewDonationHistory', ['today' => $today, 'yesterday' => $yesterday, 'lastweek' => $lastweek, 'lastmonth' => $lastmonth, 'lastyear' => $lastyear, 'all' => $all]);
    }

    public function viewMedicineStock()
    {
        $medicinestock = MedicineStock::where('ngo_id', Auth::user()->ngo_id)->get();
        return view('ngo.manager.viewMedicineStock', ['medicinestocks' => $medicinestock]);
    }

    public function manageMedicineStock()
    {
        $mids = MedicineStock::where('ngo_id', Auth::user()->ngo_id)->get('medicine_id');
        return view('ngo.manager.manageMedicineStock', ['mids' => $mids]);
    }

    public function fetchQty($id)
    {
        $rec = MedicineStock::where([['ngo_id', Auth::user()->ngo_id],['medicine_id', $id]])->first();
        $mc = $rec->medicine->category->categoryname;
        $mn = $rec->medicine->name;
        $qty = $rec['qty'];
        $brand = $rec->medicine->brand;
        $id = $rec['id'];
        return response()->json(["mc" => $mc , "mn"=>$mn , "qty"=>$qty , "brand"=>$brand , "id"=>$id ]);
    }

    public function removeMedicineStock($id,$qtyr)
    {
        if($recs = MedicineStockExpiration::where([['medicine_stock_id',$id],['expirydate','>',Carbon::yesterday()]])->orderby('expirydate','asc')->get()) {
            foreach($recs as $rec)
            {
                if($rec['qty']>$qtyr) {
                    MedicineStockExpiration::find($rec['id'])->decrement('qty',$qtyr);
                    MedicineStock::find($id)->decrement('qty',$qtyr);
                    return response()->json(["msg"=>"Yes"]);
                } else {
                    MedicineStockExpiration::find($rec['id'])->delete();
                    MedicineStock::find($id)->decrement('qty',$rec['qty']);
                    $qtyr-=$rec['qty'];
                    if($qtyr==0) {
                        $remainQty = MedicineStock::where('id',$id)->first('qty');
                        if($remainQty['qty']==0) {
                            MedicineStock::find($id)->delete();
                        }
                        return response()->json(["msg"=>"Yes"]);
                    }
                }
            }
        }
        return response()->json(["msg"=>"No"]);        
    }
    public function viewExpireMedicine()
    {
        $expiremedicine = MedicineStock::join('medicine_stock_expirations', 'medicine_stocks.id', '=', 'medicine_stock_expirations.medicine_stock_id')
            ->where('ngo_id', Auth::user()->ngo_id)
            ->where('expirydate', '<=', Carbon::today())->orderby('expirydate', 'desc')->get();
        return view('ngo.manager.viewExpireMedicine', ['expiremedicines' => $expiremedicine]);
    }

    public function removeExpireMedicine()
    {
        $expiremedicine = MedicineStock::join('medicine_stock_expirations', 'medicine_stocks.id', '=', 'medicine_stock_expirations.medicine_stock_id')
            ->where('ngo_id', Auth::user()->ngo_id)
            ->where('expirydate', '<=', Carbon::today())->orderby('expirydate', 'desc')->get();

        foreach ($expiremedicine as $expiremedicines) {
            $removemedicine = MedicineStockExpiration::where('id', $expiremedicines->id)->delete();
            if ($removemedicine) {
                $stockqty = MedicineStock::select('qty')->where('id', $expiremedicines->medicine_stock_id)->first();
                $newqty = $stockqty->qty - $expiremedicines->qty;
                if ($newqty > 0) {
                    $medicinestock = MedicineStock::where('id', $expiremedicines->medicine_stock_id)->update(['qty' => $newqty]);
                } else {
                    $medicinestock = MedicineStock::where('id', $expiremedicines->medicine_stock_id)->delete();
                }
            }
        }

        return redirect()->back()->with('success', 'Expired medicines removed from stock Successfully.');
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
