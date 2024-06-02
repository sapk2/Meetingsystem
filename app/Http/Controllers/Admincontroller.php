<?php

namespace App\Http\Controllers;

use App\Http\Middleware\user;
use App\Models\agendas;
use App\Models\meeting;
use App\Models\User as ModelsUser;
use Illuminate\Http\Request;

class Admincontroller extends Controller
{
   public function agendaindex() {
      $agenda=agendas::all();
      return view('admin.agendas.index',compact('agenda'));
    
   }
   public function agendacreate(){
      $meetings=meeting::all();
      return view('admin.agendas.create',compact('meetings'));
   }
   public function agendastore(Request $request){
      $request->validate([
         'meeting_id'=>'required',
         'agenda_title'=>'required',
         'attachment'=>'required|mimes:pdf|max:2048'
      ]);
      

   }
   public function agendaedit($id){}
   public function agendaupdate(Request $request){}
   public function agendadelete($id){}





   /*******Meeting dashboard********* */
   public function meetingindex(){
     $meeting= meeting::all();
      return view('admin.meetings.index',compact('meeting'));
   }
   public function meetingcreate(){
      /*$user=user::all();*/
      return view('admin.meetings.create');
   }
   public function meetingstore(Request $request){
      $data=$request->validate([
         'title'=>'required',
         'description'=>'required',
         'date_time'=>'required',
         'user_id'=>'required',
         'location'=>'required'

      ]);
      meeting::create($data);
      return redirect(route('admin.meetings.index'));

      
   }

    public function meetingedit($id){
      $meeting=meeting::findorfail($id);
      $user=ModelsUser::all();
      return view('admin.meetings.edit', compact('meeting', 'user'));
    }
   public function meetingupdate(Request $request,$id){
      $data = $request->validate([
         'title' => 'required',
         'description' => 'required',
         'date_time' => 'required|date',
         'user_id' => 'required|exists:users,id',
         'location' => 'required'
     ]);

     $meeting = Meeting::findOrFail($id);
     $meeting->update($data);

     return redirect()->route('admin.meetings.index')->with('success', 'Meeting updated successfully');

   }
   public function meetingdelete($id){
      $meeting=meeting::findorfail($id);
      $meeting->delete();
      return redirect()->route('admin.meetings.index')->with('sucess','Meeting deleted sucessfully');
   }
}
