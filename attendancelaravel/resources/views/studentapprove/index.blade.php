<!-- resources/views/students/index.blade.php -->

@extends('layoutsss.app') <!-- Ensure you have a layout file -->

@section('content')
<div class="pagetitle">
    <h1>New Registered Students Details</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item">New Students</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="card">
            {{-- <div class="card-header">Header</div> --}}
            <div class="card-body">
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Middle Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">GR. No.</th>
                            <th scope="col">En. No.</th>
                            <th scope="col">Course</th>
                            <th scope="col">Semester</th>
                            <th scope="col">Accepted</th>
                            <th scope="col">Reject</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $index => $student)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $student->first_name }}</td>
                                <td>{{ $student->middle_name }}</td>
                                <td>{{ $student->last_name }}</td>
                                <td>{{ $student->gr_no }}</td>
                                <td>{{ $student->enrollment_no }}</td>
                                <td>{{ $student->course_name }}</td>
                                <td>{{ $student->name }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('studentapprove.approve', $student->id) }}">Accepted</a>
                                </td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('studentapprove.reject', $student->id) }}">Reject</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10">No records found...</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- <div class="card-footer">
                Footer
            </div> --}}
        </div>
    </div>
</section>
@endsection
