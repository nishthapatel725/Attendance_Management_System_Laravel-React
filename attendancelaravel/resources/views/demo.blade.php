@extends('layoutsss.app')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<!-- jQuery (required for DataTables) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
@section('content')
    <table class="table datatable">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Course Name</th>
                <th scope="col">Course Type</th>
                <th scope="col">No of Sem</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Demo</td>
                <td>Demo</td>
                <td>Demo</td>
                <td>Demo</td>
                <td>Demo</td>
                <td>Demo</td>
            </tr>
        </tbody>
    </table>

    <script>
        $(document).ready(function () {
            $('.datatable').DataTable(); // Initialize the DataTable
        });
    </script>
@endsection
