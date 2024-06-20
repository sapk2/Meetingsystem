@extends('layouts.user-app')
@section('content')

<div class="grid grid-cols-6 gap-4 py-4">
    @foreach($agenda as $item)
    <div class="bg-blue-800 px-4 m-2 py-4 drop-shadow-md text-white rounded-xl hover:drop-shadow-lg hover:bg-blue-900">
        <p class="text-center text-xs md:text-lg my-2">{{$item->agenda_title}}</p>
        <a target="_blank" href="../agendapdf/{{$item->attachment}}"><p class="text-center bg-blue-700 hover:bg-blue-800 rounded-lg p-4 mx-auto"><i class="fa-solid fa-file-pdf fa-2x"></i></p></a>
    </div>
    @endforeach
</div>



@endsection