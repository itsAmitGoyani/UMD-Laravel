<?php

namespace App\Http\Controllers;

use App\Donator;
use App\Ngo;
use Illuminate\Http\Request;

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

    public function showDonateForm()
    {
        $ngos = Ngo::all('id','name');
        return view('donator.donate', ['ngos' => $ngos]);
    }

    public function donate(Request $request)
    {
        return 0;
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
