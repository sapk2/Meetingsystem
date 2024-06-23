@extends('layouts.user-app')
@section('content')

<div class="flex mb-4 py-6 justify-center">
  <div class="bg-white rounded shadow-xl w-full md:w-1/2 overflow-hidden">
    <div class="h-[140px] bg-gradient-to-r from-cyan-500 to-blue-500"></div>
    <div class="px-5 py-2 flex flex-col gap-3 pb-6">
      <div class="h-[90px] shadow-md w-[90px] rounded-full border-4 overflow-hidden -mt-14 border-white mx-auto">
        <img src="{{asset(Auth::user()->avatar)}}" class="w-full h-full object-center object-cover" alt="User Avatar">

      </div>
      <div class="text-center">
        <h3 class="text-xl text-slate-900 font-bold leading-6">{{ Auth::user()->name }}</h3>
        <p class="text-sm text-gray-600">{{ Auth::user()->email }}</p>
      </div>
      <div class="flex gap-3 flex-wrap justify-center">
        @foreach(['Developer' => 'yellow', 'Design' => 'green', 'Management' => 'blue', 'Projects' => 'indigo'] as $role => $color)
          <span class="rounded-sm bg-{{ $color }}-100 px-3 py-1 text-xs font-medium text-{{ $color }}-800">{{ $role }}</span>
        @endforeach
      </div>
      <div class="flex gap-2 justify-center">
        <a href="mailto:{{ Auth::user()->email }}" class="inline-flex items-center justify-center rounded border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-800 transition hover:border-gray-300 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-300" aria-label="Send Message">Send Message</a>
        <a href="{{route('user.profile.edit')}}" class="inline-flex items-center justify-center rounded border border-gray-200 bg-blue-700 px-3 py-2 text-sm font-medium text-white transition hover:border-blue-300 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300" aria-label="Edit Profile">Edit</a>
      </div>
    </div>
    <div class="px-5 pb-6">
      <form action="{{route('user.profile.delete')}}" method="POST" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">
        @csrf
        
        <div class="flex mb-4">
          <div class="flex-1 bg-red-200 h-12 rounded-lg shadow-lg flex items-center justify-center">
            <h1 class="text-xl text-red-800">Delete Account</h1>
          </div>
        </div>
        <p>Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</p>
        <div class="mt-4 text-center">
          <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete Account</button>
        </div>
      </form>
    </div>
  </div>
</div> 

@endsection
