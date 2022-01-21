<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // dashboard admin
        if (Auth::user()->role != 'pegawai'){
            return redirect()->to('dashboard/'.Auth::user()->role);
        }
        return view('pages.dashboard');
    }

    public function siswa()
    {
        // dashboard siswa approve
        return view('pages.dashboard-user-approved');
    }

    public function siswaNonApproved()
    {
        // dashboard siswa non approve
        return view('pages.dashboard-user-nonapproved');
    }
}
