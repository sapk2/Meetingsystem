<?php

namespace App\Http\Controllers;


use App\Models\agendas;
use App\Models\meeting;
use App\Models\meetingnotice;
use App\Models\User as ModelsUser;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\support\Facades\Mail;


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




   /**************************Meeting Notice*********************************************** */
   public function noticeindex(){
      $notices=meetingnotice::all();
      return view('admin.notices.index', compact('notices'));

   }
   public function noticecreate(){
      $meeting=meeting::all();
      return view('admin.notices.create',compact('meeting'));
   
   }
   public function noticestore(Request $request){
      $data=$request->validate([
         'meeting_id'=>'required',
         'message'=>'required'
      ]);
      meetingnotice::create($data);
      return redirect(route('admin.notices.index'));

   }
   public function noticeedit($id){
      $notices=meetingnotice::findorfail($id);
      $meeting=meeting::all();
      return view('admin.notices.edit', compact('notices', 'meeting'));
   }
   public function noticeupdate(Request $request,$id){
      $data=$request->validate([
         'meeting_id'=>'required',
         'message'=>'required'
      ]);
      $notices=meetingnotice::findorfail($id);
      $notices->update($data);
      return redirect()->route('admin.notices.index')->with('success', 'Meeting updated successfully');
   }
   public function noticedelete($id){
      $notices=meetingnotice::findorfail($id);
      $notices->delete();
      return redirect()->route('admin.notices.index');
   }




   // profile controller
   public function edit(Request $request):View
   {
      return view('admin.profile.edit', [
         'user' => $request->user(),
     ]);
   }
    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if ($request->hasFile('avatar')) {
         

         # code...
        }

        $request->user()->save();

        return Redirect::route('admin.profile.edit')->with('status', 'profile-updated');
      }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }




    /*******************manage users--employee--*************************************** */

 public function manageuserindex(){
   $manageuser=ModelsUser::all();
   return view('admin.manageusers.index',compact('manageuser'));
 }
 public function manageusercreate(){
   return view('admin.manageusers.create');
 }
 public function manageuserstore(Request $request){
  // dd($request->all());
   $request->validate([
      'name'=>'required',
        'email'=>'required',
        'password'=>'required',
        'roles'=>'required', 
   ]);

   $user=new ModelsUser();
   $user->name = $request->name;
   $user->email = $request->email;
   $user->password = Hash::make($request->password);
   $user->roles = $request->roles;
   //save the user

   //save the user
   $user->save();

   // Send the user a password reset email
   $token = Password::createToken($user);
   $user->sendPasswordResetNotification($token);
   return redirect()->route('admin.manageusers.index')->with('success', 'User created successfully');

 }
 public function manageuseredit(ModelsUser $id){
   return view('admin.manageusers.edit', compact('user'));
 }
 public function manageuserupdate(Request $request, ModelsUser $user){
   

   $request->validate([
      'name'=>'required',
        'email'=>'required',
        'password'=>'required',
        'roles'=>'required', 
        'avatar'=>'required'
   ]);
   $user=ModelsUser::findorfail($user->id);
   if ($request ->hasFile('avatar')) {
      $avatarname=  time() . '-' . $request->avatar->extension();
      $request->avatar->move(public_path('img'),$avatarname);
      $path="/img/".$avatarname;
      $user->avatar=$path;
   }
   $user->name = $request->name;
   $user->email = $request->email;
   if ($request->filled('password')) {
      $user->password = Hash::make($request->password);
  }

  $user->role = $request->role;
  $user->save();
  return redirect()->route('admin.manageusers.index');
 }
 public function manageuserdelete(ModelsUser $user){
   $user->delete();
   return redirect()->route('admin.manageusers.index');
 }


}

