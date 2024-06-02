<?php

namespace App\Http\Controllers;

use App\Models\agendas;
use App\Models\meeting;
use Illuminate\Http\Request;

class Admincontroller extends Controller
{
   public function agendaindex() {
      $agenda=agendas::all();
      return view('admin.agendas.index',compact('agenda'));
    
   }
   public function agendacreate(){
      return view('admin.agendas.create');
   }
   public function agendastore(Request $request){}
   public function agendaedit($id){}
   public function agendaupdate(Request $request){}
   public function agendadelete($id){}
   
}
