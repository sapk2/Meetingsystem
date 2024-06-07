<?php

namespace App\Http\Controllers;

use App\Http\Middleware\user;
use App\Models\agendas;
use App\Models\meeting;
use App\Models\User as ModelsUser;
use Illuminate\Http\Request;

class Admincontroller extends Controller
{
   /**************************************Agendas*********************************************************/
   
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
      $fileName= time().'.'.$request->attachment->extension();
      $request->attachment->move(public_path('agendapdf'),$fileName);

      agendas::create([
         'meeting_id'=>$request->meeting_id,
         'agenda_title'=>$request->agenda_title,
         'attachment'=>$fileName,
      ]);
      return redirect(route('admin.agendas.index'));


   }
   public function agendaedit($id){
      $agenda=agendas::findorfail($id);
      $meetings=meeting::all();
      return view('admin.agendas.edit',compact('agenda','meetings'));

   }
   public function agendaupdate(Request $request, $id){
      $agenda=agendas::findorfail($id);
      $request->validate([
         'meeting_id'=>'required',
         'agenda_title'=>'required',
         'attachment'=>'required|mimes:pdf|max:2048'
      ]);
      if ($request->has('attachment')) {
         $fileName = time() . '.' . $request->attachment->extension();
         $request->attachment->move(public_path('agendapdf'), $fileName);
         $agenda->update(['attachment' => $fileName]);
         
      }
      $agenda->update([
         'meeting_id' => $request->meeting_id,
         'agenda_title' => $request->agenda_title,
      ]);
      return redirect(route('admin.agendas.index'));

   }
   public function agendadelete($id){
      $agenda=agendas::findorfail($id);
      $agenda->delete();
      return redirect(route('admin.agendas.index'));
   }





   /******************************Meeting dashboard******************************************** */
   public function meetingindex(){
     $meeting= meeting::all();
      return view('admin.meetings.index',compact('meeting'));
   }
   public function meetingcreate(){
      $users=ModelsUser::all();
      return view('admin.meetings.create',compact('users'));
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
         'date_time' => 'required',
         'user_id' => 'required',
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
