<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        /* 
        *   1. start/inisiasi session
        *   2. percabangan, jika terdapat data dalam sesi maka
        *   3. akses DB dan filter database berdasarkan referensi session value
        *   4. ambil data yg matching, dan passing data tersebut ke view blade.php
        */
        $session = $request->session()->get('phone');
        if ($request->session()->has('phone')) {
            $users = Users::where('phone', $session)->get();
            // passing data user ke laman otp.blade (belum dipake)
            return view('dashboard.dashboard', [
                'users' => $users
            ]);
        } else {
            return redirect('/login');
        }
    }

    public function logout(Request $request) {
        $request->session()->flush();
        return redirect('/login');
    }
}
