@extends('layouts.app')
@section('content')

<div class="p-4 sm:ml-64">

    <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-100 mt-14">
        <h2 class="font-bold text-3xl text-aqua-600">Meetings</h2>
        <hr class="h-1 bg-gray-600">
        <br>
        <form action="{{route('admin.meetings.store')}}" method="post" class="max-w-md mx-auto">
            @csrf
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="title" id="title" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-dark dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="Title " required />
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="description" id="description" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-dark dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="description " required />
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="datetime-local" name="date_time" id="date_time" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-dark dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required />
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <select name="user_id" id="user_id" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-dark dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
                    <option value="" disabled selected> organizers</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="location" id="location" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-dark dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="location" required />
            </div>
            <div class="flex justify-center mt-6">
                <input class="bg-blue-600 text-white px-4 py-2 rounded mx-2 hover:cursor-pointer" type="submit" value="submit">
                <a href="{{route('admin.meetings.index')}}" class="bg-red-500 text-white px-4 py-2 rounded mx-2">cancel</a>
            </div>
        </form>




    </div>
</div>
@endsection