@extends('layouts.app')

@section('content')
<div class="p-4 sm:ml-64">
   <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-200 mt-14">
       <div class="container">
            <div class="grid grid-cols-4 gap-10 mt-5">
                <div class="px-2 py-4 flex justify-between bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition duration-300">
                    <p>Total Users</p>
                    <p class="text-5xl font-bold">{{$totalUsers}}</p>
                </div>
                <div class="px-2 py-4 flex justify-between bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition duration-300">
                    <p>Total Meetings</p>
                    <p class="text-5xl font-bold">{{$totalMeetings}}</p>
                </div>
                <div class="px-2 py-4 flex justify-between bg-yellow-600 text-white rounded-lg shadow hover:bg-yellow-700 transition duration-300">
                    <p>Total Meeting Notices</p>
                    <p class="text-5xl font-bold">{{$totalMeetingNotices}}</p>
                </div>
                <div class="px-2 py-4 flex justify-between bg-red-600 text-white rounded-lg shadow hover:bg-red-700 transition duration-300">
                    <p>Total Agendas</p>
                    <p class="text-5xl font-bold">{{$totalAgendas}}</p>
                </div>
            </div>
         </div>
         <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
         <div class="font-sana leading-normal tracking-normal mt-2">
            <canvas id="myChart"></canvas>
            <script>
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                  type: 'pie',
                  data: {
                     labels: ['Users', 'Meetings', 'Agendas'],
                     datasets: [{
                        data: [{{$totalUsers}}, {{ $totalMeetings}},  {{$totalAgendas}}],
                        backgroundColor: [
                           'rgba(255, 99, 132, 0.7)', // Blue
                           'rgba(75, 192, 192, 0.7)', // Green
                           'rgba(255, 205, 86, 0.7)' // Yellow
                        ],
                        borderColor: [
                           'rgba(255, 99, 132, 1)', // Blue
                           'rgba(75, 192, 192, 1)', // Green
                           'rgba(255, 205, 86, 1)' // Yellow
                        ],
                        borderWidth: 1
                     }]
                  },
                  options: {
                     responsive: true,
                     maintainAspectRatio: false,
                     legend: {
                        position: 'bottom',
                        labels: {
                           fontColor: 'black',
                           fontSize: 14,
                           padding: 20
                        }
                     }
                  }
                });
            </script>
         </div>
    </div>
</div>
@endsection
