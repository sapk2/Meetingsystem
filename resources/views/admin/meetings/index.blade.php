@extends('layouts.app')

@section('content')
<div class="p-4 sm:ml-64">
   <div class="p-4 border-2 border-gray-200 mt-14">
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
         <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
            <div class="mt-10 text-left">
               <a href="{{route('admin.meetings.create')}}" class="bg-amber-600 text-white p-3 rounded-lg">Add $meeting</a>
            </div>
            <div>
               <button id="dropdownRadioButton" data-dropdown-toggle="dropdownRadio" class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-600 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" type="button">
                  <svg class="w-3 h-3 text-gray-500 dark:text-gray-400 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                     <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z"/>
                  </svg>
                  Last 30 days
                  <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
               </button>
               <!-- Dropdown menu -->
               <div id="dropdownRadio" class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
                  <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownRadioButton">
                     @php
                        $filterOptions = [
                           ['id' => 'filter-radio-example-1', 'value' => 1, 'label' => 'Last day'],
                           ['id' => 'filter-radio-example-2', 'value' => 7, 'label' => 'Last 7 days'],
                           ['id' => 'filter-radio-example-3', 'value' => 30, 'label' => 'Last 30 days'],
                           ['id' => 'filter-radio-example-4', 'value' => 30, 'label' => 'Last month'],
                           ['id' => 'filter-radio-example-5', 'value' => 365, 'label' => 'Last year'],
                        ];
                     @endphp
                     
                     @foreach($filterOptions as $option)
                        <li>
                           <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                              <input id="{{ $option['id'] }}" type="radio" value="{{ $option['value'] }}" name="filter-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                              <label for="{{ $option['id'] }}" class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">{{ $option['label'] }}</label>
                           </div>
                        </li>
                     @endforeach
                  </ul>
               </div>
            </div>
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
               <div class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                  <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
               </div>
               <input type="text" id="table-search" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-200 focus:border-blue-500 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
            </div>
         </div>
         <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($meeting as $meetings)
               <div class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 p-4">
                  <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{$meetings->title}}</h3>
                  <p class="text-sm text-gray-700 dark:text-gray-400 mb-2">{{$meetings->agenda_title}}</p>
                  <p class="text-sm text-gray-500 dark:text-gray-300 mb-4">{{$meetings->attachment}}</p>
                  <div class="flex justify-between">
                     <a href="{{ route('admin.meetings.edit',$meetings->id) }}" class="bg-blue-500 text-white p-2 rounded-lg">Edit</a>
                     <a href="{{ route('admin.meetings.delete',$meetings->id) }}" class="bg-red-500 text-white p-2 rounded-lg" onclick="event.preventDefault(); document.getElementById('delete-form-{{$meetings->id }}').submit();">Delete</a>
                     <form id="delete-form-{{$meetings->id }}" action="{{ route('meeting.delete',$meetings->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                     </form>
                  </div>
               </div>
            @endforeach
         </div>
      </div>
   </div>
</div>

<script>
   document.addEventListener('DOMContentLoaded', function () {
      const dropdownButton = document.getElementById('dropdownRadioButton');
      const dropdownMenu = document.getElementById('dropdownRadio');
      const checkboxes = document.querySelectorAll('input[type="checkbox"]');
      const searchInput = document.getElementById('table-search');

      dropdownButton.addEventListener('click', function () {
         dropdownMenu.classList.toggle('hidden');
      });

      document.addEventListener('click', function (event) {
         if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
         }
      });

      checkboxes.forEach(checkbox => {
         checkbox.addEventListener('change', function () {
            if (this.id === 'checkbox-all-search') {
               checkboxes.forEach(cb => cb.checked = this.checked);
            } else if (!this.checked) {
               document.getElementById('checkbox-all-search').checked = false;
            }
         });
      });

      searchInput.addEventListener('input', function () {
         const filter = searchInput.value.toLowerCase();
         const cards = document.querySelectorAll('.grid > div');
         cards.forEach(card => {
            const cardText = card.textContent.toLowerCase();
            card.style.display = cardText.includes(filter) ? '' : 'none';
         });
      });
   });
</script>
@endsection
