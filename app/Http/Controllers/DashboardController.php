<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // dashboard admin
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
