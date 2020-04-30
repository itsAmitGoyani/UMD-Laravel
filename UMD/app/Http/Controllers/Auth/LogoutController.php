<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    //
    public function adminLogout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }

    public function managerLogout()
    {
        Auth::guard('manager')->logout();
        return redirect('/ngo/manager/login');
    }

    public function pickupmanLogout()
    {
        Auth::guard('pickupman')->logout();
        return redirect('/ngo/pickupman/login');
    }
}
