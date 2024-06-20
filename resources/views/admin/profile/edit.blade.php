@extends('layouts.app')
@section('content')

<div class="p-4 sm:ml-64">

    <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-100 mt-14">
        <h2 class="font-bold text-3xl text-aqua-600">profile</h2>
        <hr class="h-1 bg-gray-600">
        <br>
        <form action="{{ route('admin.profile.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('post')
            <div class="mb-3">
           
           <label for="code" class="form-label">Full Name *</label>
           <input type="text" class="form-control w-full " id="code" name="name" value="{{$user->name}}">
       </div>
       
       <div class="mb-3">
           <label for="description" class="form-label">Email *</label>
           <input class="form-control w-full" id="description" name="email" rows="10" required value="{{$user->email}}">
       </div>
       <input type="file" name="avatar" class="block w-full my-4 p-2 rounded">
       <div class="flex justify-center mt-6">
           <input class="bg-blue-600 text-white px-4 py-2 rounded mx-2 hover:cursor-pointer" type="submit" value="update">
           <a href="{{ route('admin.dashboard') }}" class="bg-red-500 text-white px-4 py-2 rounded mx-2">cancel</a>
       </div>

        </form>
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
    </div>
</div>
@endsection