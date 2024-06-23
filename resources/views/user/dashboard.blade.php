@extends('layouts.user-app')
@section('content')


@if(request()->routeIs('user.dashboard'))
<marquee class="bg-yellow-300 py-2 text-center text-white text-xl" scrollamount="10" width="100%">
    <span class="blink">
    @foreach($notices as $item)
    {{$item->message}} ~
    @endforeach
    </span>
</marquee>
@endif

@endsection