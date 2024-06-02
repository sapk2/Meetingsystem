@extends('layouts.app')
@section('content')

<div class="p-4 sm:ml-64">
   <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-100 mt-14">

<h2 class="font-bold text-3xl text-amber-600">Agendas</h2>
<hr class="h-1 bg-amber-600">

<form action="{{route('admin.agendas.store')}}" class="max-w-md mx-auto">
    <div class="relative z-0 w-full mb-5 group">

        <input type="text" name="title" id="meeting_id"  class="block py-2.5 px-0 w-full text-sm text-black-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-dark dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="meeting title " required />
        <input type="text" name="title" id="agenda_title"  class="block py-2.5 px-0 w-full text-sm text-black-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-dark dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="Agendas title " required />
        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" id="user_avatar" type="file">
    </div>
    <a href="admin.agendas.index"><input type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"></a>
</form>
</div>
</div>
@endsection