<?php

namespace App\Http\Controllers;

use App\Models\agendas;
use App\Models\meeting;
use App\Models\meetingnotice;
use Carbon\Carbon;
use Illuminate\Http\Request;

class usersController extends Controller
{
   public function meetingindex() {
      
      $today = Carbon::today();
      $tomorrow = Carbon::tomorrow();
      $yesterday = Carbon::yesterday();
  
      $meeting = Meeting::whereBetween('date_time', [$yesterday->startOfDay(), $tomorrow->endOfDay()])->get();
  
      return view('user.meeting.index', compact('meeting'));
  }
  public function agenda(){
   $agenda=agendas::all();
   return view('user.agenda',compact('agenda'));
  }
  public function notice(){
   $notices=meetingnotice::all();
   return redirect()->route('user.dashboard');
  }
}
