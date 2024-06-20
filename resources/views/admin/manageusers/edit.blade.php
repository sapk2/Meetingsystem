@extends('layouts.app')
@section('content')

<div class="p-4 sm:ml-64">
   <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-300 mt-14">
   <h2 class="font-bold text-3xl text-aqua-600">Users Edit</h2>
        <hr class="h-1 bg-gray-600">
        <br>
   <form method="post" action="{{ route('admin.manageusers.update',$user->id) }}" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="name">Name</label>
        <input id="name" name="name" type="text" value="{{$user->name}}"  class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-dark dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="ramlal" required>
        @error('name')
            <div>{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="email">Email</label>
        <input id="email" name="email" value="{{ $user->email }}" type="email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-dark dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="man@gmail.com" required>
        @error('email')
            <div>{{ $message }}</div>
        @enderror
    </div>
   
    <div>
    <label for="role" class="block text-gray-700 text-sm font-bold mb-2">Role:</label>
        <input type="radio" name="roles" id="roles" value="admin"> Admin
        <input type="radio" name="roles" id="roles" value="user"> users
        @error('roles')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <div class="flex justify-center mt-6">
                <input class="bg-blue-600 text-white px-4 py-2 rounded mx-2 hover:cursor-pointer" type="submit" value="submit">
                <a href="{{route('admin.manageusers.index')}}" class="bg-red-500 text-white px-4 py-2 rounded mx-2">cancel</a>
            </div>
</form>



</div>
</div>
@endsection