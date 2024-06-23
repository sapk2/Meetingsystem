<?php

namespace App\Http\Controllers;

use App\Models\meetingnotice;
use Illuminate\Http\Request;

class Dashboardcontroller extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
    public function userindex()
    {
        $notices = meetingnotice::all();
        return view('user.dashboard', compact('notices'));
    }
}
