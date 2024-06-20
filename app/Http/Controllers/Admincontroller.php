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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\support\Facades\Mail;


class Admincontroller extends Controller
{
   /**************************************Agendas*********************************************************/

   public function agendaindex()
   {
      $agenda = agendas::all();
      return view('admin.agendas.index', compact('agenda'));
   }
   public function agendacreate()
   {
      $meetings = meeting::all();
      return view('admin.agendas.create', compact('meetings'));
   }
   public function agendastore(Request $request)
   {
      $request->validate([
         'meeting_id' => 'required',
         'agenda_title' => 'required',
         'attachment' => 'required|mimes:pdf|max:2048'
      ]);
      $fileName = time() . '.' . $request->attachment->extension();
      $request->attachment->move(public_path('agendapdf'), $fileName);

      agendas::create([
         'meeting_id' => $request->meeting_id,
         'agenda_title' => $request->agenda_title,
         'attachment' => $fileName,
      ]);
      return redirect(route('admin.agendas.index'));
   }
   public function agendaedit($id)
   {
      $agenda = agendas::findorfail($id);
      $meetings = meeting::all();
      return view('admin.agendas.edit', compact('agenda', 'meetings'));
   }
   public function agendaupdate(Request $request, $id)
   {
      $agenda = agendas::findorfail($id);
      $request->validate([
         'meeting_id' => 'required',
         'agenda_title' => 'required',
         'attachment' => 'required|mimes:pdf|max:2048'
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
   public function agendadelete($id)
   {
      $agenda = agendas::findorfail($id);
      $agenda->delete();
      return redirect(route('admin.agendas.index'));
   }





   /******************************Meeting dashboard******************************************** */
   public function meetingindex()
   {
      $meeting = meeting::all();
      return view('admin.meetings.index', compact('meeting'));
   }
   public function meetingcreate()
   {
      $users = ModelsUser::all();
      return view('admin.meetings.create', compact('users'));
   }
   public function meetingstore(Request $request)
   {
      $data = $request->validate([
         'title' => 'required',
         'description' => 'required',
         'date_time' => 'required',
         'user_id' => 'required',
         'location' => 'required'

      ]);
      meeting::create($data);
      return redirect(route('admin.meetings.index'));
   }

   public function meetingedit($id)
   {
      $meeting = meeting::findorfail($id);
      $user = ModelsUser::all();
      return view('admin.meetings.edit', compact('meeting', 'user'));
   }
   public function meetingupdate(Request $request, $id)
   {
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
   public function meetingdelete($id)
   {
      $meeting = meeting::findorfail($id);
      $meeting->delete();
      return redirect()->route('admin.meetings.index')->with('sucess', 'Meeting deleted sucessfully');
   }




   /**************************Meeting Notice*********************************************** */
   public function noticeindex()
   {
      $notices = meetingnotice::all();
      return view('admin.notices.index', compact('notices'));
   }
   public function noticecreate()
   {
      $meeting = meeting::all();
      return view('admin.notices.create', compact('meeting'));
   }
   public function noticestore(Request $request)
   {
      $data = $request->validate([
         'meeting_id' => 'required',
         'message' => 'required'
      ]);
      meetingnotice::create($data);
      return redirect(route('admin.notices.index'));
   }
   public function noticeedit($id)
   {
      $notices = meetingnotice::findorfail($id);
      $meeting = meeting::all();
      return view('admin.notices.edit', compact('notices', 'meeting'));
   }
   public function noticeupdate(Request $request, $id)
   {
      $data = $request->validate([
         'meeting_id' => 'required',
         'message' => 'required'
      ]);
      $notices = meetingnotice::findorfail($id);
      $notices->update($data);
      return redirect()->route('admin.notices.index')->with('success', 'Meeting updated successfully');
   }
   public function noticedelete($id)
   {
      $notices = meetingnotice::findorfail($id);
      $notices->delete();
      return redirect()->route('admin.notices.index');
   }




   // profile controller
   public function edit(Request $request): View
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
      $user = $request->user();

      // Fill user data with validated request data
      $user->fill($request->validated());

      // Check if email is dirty and reset email_verified_at if necessary
      if ($user->isDirty('email')) {
         $user->email_verified_at = null;
      }

      // Handle avatar upload
      if ($request->hasFile('avatar')) {
         // Generate a unique filename
         $avatarName = time() . '.' . $request->avatar->extension();

         // Move the uploaded file to the public/img directory
         $request->avatar->move(public_path('img'), $avatarName);

         // Construct the path and set it to the user's avatar attribute
         $path = "/img/" . $avatarName;
         $user->avatar = $path;
      }

      // Save the user data to the database
      $user->save();

      // Redirect back with a success status
      return Redirect::route('admin.profile.edit')->with('status', 'profile-updated');
   }


   /**
    * Delete the user's account.
    */
   public function destroy(Request $request): RedirectResponse
   {
      // Validate the password
      $request->validateWithBag('userDeletion', [
         'password' => ['required', 'current_password'],
      ]);

      $user = $request->user();

      // Check if user exists
      if ($user) {
         // Log the user out
         Auth::logout();

         // Try to delete the user and check if the deletion was successful
         if ($user->delete()) {
            // Invalidate the session
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return Redirect::to('/');
         } else {
            // If deletion failed, log the issue
            Log::error('User deletion failed', ['user_id' => $user->id]);
            return Redirect::back()->withErrors(['userDeletion' => 'User deletion failed.']);
         }
      }

      // If user doesn't exist for some reason, log the issue
      Log::error('User not found for deletion', ['user_id' => $user->id ?? 'unknown']);
      return Redirect::back()->withErrors(['userDeletion' => 'User not found.']);
   }




   /*******************manage users--employee--*************************************** */
   public function manageuserindex()
   {
      $manageuser = ModelsUser::all();
      return view('admin.manageusers.index', compact('manageuser'));
   }
   public function manageusercreate()
   {
      return view('admin.manageusers.create');
   }
   public function manageuserstore(Request $request)
   {
      // dd($request->all());
      $request->validate([
         'name' => 'required',
         'email' => 'required',
         'roles' => 'required'
      ]);
      $user = ModelsUser::create([
         'name' => $request->name,
         'email' => $request->email,
         'password' => Hash::make($request->password),
         'roles' => $request->roles,

      ]);
      $token = password::createToken($user);
      $user->sendpasswordresetnotification($token);
      return redirect()->route('admin.manageusers.index');
   }
   public function manageuseredit($id)
   
   {
      $user =ModelsUser::findOrFail($id);
      return view('admin.manageusers.edit',compact('user'));
   }
   public function manageuserupdate(Request $request, $id)
   {
      $request->validate([
         'name' => 'required',
         'email' => 'required',
         
         'roles' => 'required',
         'avatar' => 'required'
      ]);
      $user = ModelsUser::findorfail($id);
      if ($request->hasFile('avatar')) {
         $avatarname =  time() . '-' . $request->avatar->extension();
         $request->avatar->move(public_path('img'), $avatarname);
         $path = "/img/" . $avatarname;
         $user->avatar = $path;
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
   public function manageruserdelete($id)
   {
      $id->delete();
      return redirect()->route('admin.manageusers.index');
   }
}
