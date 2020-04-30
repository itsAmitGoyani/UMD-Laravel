<?php

namespace App\Http\Controllers;

use App\Manager;
use App\Ngo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function showdashboard()
    {
        return view('ngo_manager.dashboard');
    }

    public function index()
    {

        $manager = Manager::with('ngo')->get();
        return view('admin.displaymanager', ['managers' => $manager]);
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
                    'profile_image_url' => $imagename,
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
