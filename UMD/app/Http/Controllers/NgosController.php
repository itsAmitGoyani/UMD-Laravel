<?php

namespace App\Http\Controllers;

use App\Ngo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NgosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $this->validate($request, [
            'name'   => 'required',
            'address'   => 'required|max:255',
            'pincode' => 'required|size:6',
            'state'   => 'required',
            'city'   => 'required',
        ]);

        if (Auth::guard('admin')) {
            $ngo = Ngo::create([
                'name' => $request['name'],
                'address' => $request['address'],
                'city' => $request['city'],
                'state' => $request['state'],
                'pincode' => $request['pincode'],
            ]);
            if($ngo) {
                return redirect()->intended('/admin-displayngos')->with('success','NGO registered successfully');
            }
            return back()->withInput()->withErrors(['errmsg' => 'Unknown error']);
        }
        return back()->withInput()->withErrors(['errmsg' => 'Invalid Email or Password']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ngo  $ngo
     * @return \Illuminate\Http\Response
     */
    public function show(Ngo $ngo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ngo  $ngo
     * @return \Illuminate\Http\Response
     */
    public function edit(Ngo $ngo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ngo  $ngo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ngo $ngo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ngo  $ngo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ngo $ngo)
    {
        //
    }
}
