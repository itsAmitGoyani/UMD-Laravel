<?php

namespace App\Http\Controllers;

use App\Donation;
use App\Ngo;
use App\Donator;
use App\PickupSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
