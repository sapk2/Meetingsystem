<?php

namespace App\Http\Controllers;

use App\Models\agendas;
use App\Models\meeting;
use App\Models\meetingnotice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class usersController extends Controller
{
  public function meetingindex()
  {

    $today = Carbon::today();
    $tomorrow = Carbon::tomorrow();
    $yesterday = Carbon::yesterday();

    $meeting = Meeting::whereBetween('date_time', [$yesterday->startOfDay(), $tomorrow->endOfDay()])->get();

    return view('user.meeting.index', compact('meeting'));
  }


  public function agenda()
  {
    $agenda = agendas::all();
    return view('user.agenda', compact('agenda'));
  }



  public function notice()
  {
    $notices = meetingnotice::all();
    return redirect()->route('user.dashboard',compact('notices'));
  }









  /**user profile */
  public function show()
  {
    $user = Auth::user();
    return view('user.profile.show', compact('user'));
  }
  public function edituserprofile()
  {
    $user = auth::user();
    return view('user.profile.edit', compact('user'));
  }

  //updateuser 
  public function update(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
    ]);

    $user = Auth::user();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->save();

    return redirect()->route('user.profile.show')->with('success', 'Profile updated');
}

  public function changepassword(Request $request)
  {
    $request->validate([
      'current_password' => 'required',
      'new_password' => 'required'
    ]);
    $user = Auth::user();
    if (!Hash::check($request->current_password, $user->password)) {
      return back()->withErrors(['current_password' => 'password does not matched']);
    }
    $user->password = Hash::make($request->new_password);
    $user->save();
    return redirect()->route('user.profile.show')->with('sucess', 'password change sucessfully');
  }
  public function uploadphoto(Request $request)
  {
    $request->validate([
      'avatar' => 'required|image', // Validate that the uploaded file is an image
    ]);

    $user = Auth::user();

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

    return redirect()->route('user.profile.show')->with('success', 'Profile photo updated successfully.');
  }

  public function delete(Request $request)
  {
    $user = Auth::user();
    if ($user->avatar) {
      Storage::delete('public/img/' . $user->avatar);
    }
    Auth::logout();
    $request->$user->delete();
    redirect('/register')->with('sucess', 'Account has been deleted sucessfully');
  }
}
