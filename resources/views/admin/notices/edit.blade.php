@extends('layouts.app')
@section('content')

<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-100 mt-14">

       <h2 class="font-bold text-3xl text-amber-600">Notices</h2>
       <hr class="h-1 bg-amber-600">

        <form action="{{route('admin.notices.update',$notices->id)}}" method="post" class="max-w-md mx-auto" enctype="multipart/form-data">
            @csrf
            <div class="relative z-0 w-full mb-5 group">
                <select name="meeting_id" id="meeting_id" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-dark dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
                   <option value="" disabled selected> Title</option>
                     @foreach($meeting as $meeting)
                       <option value="{{ $meeting->id }}">{{ $meeting->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="relative z-0 w-full mb-5 group ">

                <label for="Agenda">Description</label>
                <textarea id="default-editor" name="message">{{$notices->message}}</textarea>
                @error('message')
                <div class="text-red-500 mt-2 text-sm">
                    {{$message}}
                </div>
                @enderror
            </div>
            
            <div class="flex justify-center mt-6" >
            <input class="bg-blue-600 text-white px-4 py-2 rounded mx-2 hover:cursor-pointer" type="submit" value="update">
                <a href="{{route('admin.notices.index')}}" class="bg-red-500 text-white px-4 py-2 rounded mx-2">cancel</a>

            </div>

        </form>
    </div>
</div>
<script src="https://cdn.tiny.cloud/1/zt4xqikf31pavctxjft9ccar7c2fdsvwwzj6h98trxjj7wup/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea#default-editor'
    });
</script>
@endsection