@extends('layouts.user-app')
@section('content')
<div class="flex mb-4">
        <div class="w-full bg-gray-300 h-12">
            <div class="flex justify-between items-center mb-4">
                <div></div> <!-- Placeholder for alignment -->
                <input type="text" id="searchInput" class="border p-2 rounded" placeholder="Search...">
            </div>
            <table id="meetingTable" class="w-full border">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border p-3">SN</th>
                        <th class="border p-3">Meeting Title</th>
                        <th class="border p-3">Meeting time</th>
                        <th class="border p-3">Organizer</th>
                        <th class="border p-3">Location</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($meeting as $meetings)
                        <tr class="bg-white-200 border-b  dark:border-gray-300 hover:bg-gray-100 dark:hover:bg-gray-200">
                            <td class="p-3 text-center">{{$loop->index + 1}}</td>
                            <td class="p-3 text-center">{{$meetings->title}}</td>
                            <td class="p-3 text-center">{{$meetings->date_time}}</td>
                            <td class="p-3 text-center">{{$meetings->user->name}}</td>
                            <td class="p-3 text-center">{{$meetings->location}}</td>
                        </tr>
                    @empty
                        <tr class="bg-white-200 border-b dark:bg-gray-200 dark:border-gray-400 hover:bg-gray-100 dark:hover:bg-gray-300">
                            <td colspan="5" class="p-3 text-center">No data available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div id="pagination" class="flex justify-center mt-4"></div>
        </div>
    </div>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const rowsPerPage = 5;
    const table = document.getElementById('meetingTable');
    const pagination = document.getElementById('pagination');
    const rows = Array.from(table.querySelectorAll('tbody tr'));
    const searchInput = document.getElementById('searchInput');
    let filteredRows = rows;
    let currentPage = 1;

    function displayRows(rowsToDisplay, page) {
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        rows.forEach(row => row.style.display = 'none');
        rowsToDisplay.slice(start, end).forEach(row => row.style.display = 'table-row');
    }

    function createPagination(rowsToDisplay) {
        const pageCount = Math.ceil(rowsToDisplay.length / rowsPerPage);
        pagination.innerHTML = '';
        for (let i = 1; i <= pageCount; i++) {
            const button = document.createElement('button');
            button.className = 'mx-1 px-3 py-1 bg-gray-200 text-gray-700 rounded';
            button.textContent = i;
            button.addEventListener('click', () => {
                currentPage = i;
                displayRows(filteredRows, currentPage);
                updatePaginationButtons(pageCount);
            });
            pagination.appendChild(button);
        }
    }

    function updatePaginationButtons(pageCount) {
        const buttons = pagination.querySelectorAll('button');
        buttons.forEach((button, index) => {
            button.classList.toggle('bg-blue-500', index + 1 === currentPage);
            button.classList.toggle('text-white', index + 1 === currentPage);
        });
    }

    function filterRows() {
        const query = searchInput.value.toLowerCase();
        filteredRows = rows.filter(row => 
            Array.from(row.cells).some(cell => 
                cell.textContent.toLowerCase().includes(query)
            )
        );
        currentPage = 1;
        displayRows(filteredRows, currentPage);
        createPagination(filteredRows);
        updatePaginationButtons(Math.ceil(filteredRows.length / rowsPerPage));
    }

    searchInput.addEventListener('input', filterRows);

    displayRows(filteredRows, currentPage);
    createPagination(filteredRows);
    updatePaginationButtons(Math.ceil(filteredRows.length / rowsPerPage));
});
</script>

@endsection