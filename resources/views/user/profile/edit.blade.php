@extends('layouts.user-app')

@section('content')
<div class="flex mb-4 py-6 justify-center">
  <div class="bg-white rounded shadow-xl w-full md:w-1/2 overflow-hidden">
    <div class="h-[140px] bg-gradient-to-r from-cyan-500 to-blue-500"></div>
    <div class="px-5 py-2 flex flex-col gap-3 pb-6">
      <div class="h-[90px] shadow-md w-[90px] rounded-full border-4 overflow-hidden -mt-14 border-white mx-auto">
        <img src="{{asset(Auth::user()->avatar)}}" class="w-full h-full object-center object-cover" alt="User Avatar">
      </div>
      
      <div class="card mb-4">
        <div class="card-header">
          <div class="flex mb-4">
            <div class="flex-1 bg-red-200 h-12 rounded-lg shadow-lg flex items-center justify-center">
              <h1 class="text-xl text-red-800">Profile Update</h1>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form action="{{ route('user.profile.update') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control">
            </div>
            <br>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control">
            </div>
            <input type="submit" value="Update" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-2">
          </form>
        </div>
      </div>

      <div class="card mb-4">
        <div class="card-header">
          <div class="flex mb-4">
            <div class="flex-1 bg-green-200 h-12 rounded-lg shadow-lg flex items-center justify-center">
              <h1 class="text-xl text-white-800">Change Password</h1>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form action="{{ route('user.profile.changepassword') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="current_password">Current Password</label>
              <input type="password" name="current_password" id="current_password" class="form-control">
            </div>
            <br>
            <div class="form-group">
              <label for="new_password">New Password</label>
              <input type="password" name="new_password" id="new_password" class="form-control">
            </div>
            <br>
            <div class="form-group">
              <label for="new_password_confirmation">Confirm New Password</label>
              <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control">
            </div>
            <input type="submit" value="Change Password" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-2">
          </form>
        </div>
      </div>

      <div class="card mb-4">
        <div class="card-header">
          <div class="flex mb-4">
            <div class="flex-1 bg-green-200 h-12 rounded-lg shadow-lg flex items-center justify-center">
              <h1 class="text-xl text-white-800">Update Profile Picture</h1>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form action="{{ route('user.profile.uploadphoto') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <input type="file" name="avatar" id="avatar" class="form-control-file">
            </div>
            <input type="submit" value="Update" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-2">
          </form>
        </div>
      </div>

      <div class="flex justify-center">
        <a href="{{ route('user.profile.show') }}">
          <button type="button" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-full border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
             Cancel
          </button>
        </a>
      </div>
    </div>
  </div>
</div>
@endsection
