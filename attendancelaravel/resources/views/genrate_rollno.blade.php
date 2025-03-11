@extends('layoutsss.app')

@section('content')
<div class="pagetitle">
    <h1>Assign Roll. No.</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">Assign Rollno</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="card">
            <div class="card-header"></div>
            <div class="card-body">
                <form method="POST" action="{{ route('genrate_rollno') }}">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Course</label>
                        <div class="col-sm-3">
                            <select class="form-select" name="course_id" id="course_id">
                                <option value="0">Select Course</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->course_id }}">{{ $course->course_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Semester</label>
                        <div class="col-sm-3">
                            <select class="form-select" name="sem_id" id="sem_id">
                                <option value="0">Select Semester</option>
                                @foreach($semesters as $semester)
                                    <option value="{{ $semester->sem_id }}">{{ $semester->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first('message') }}
                        @if ($errors->has('duplicates'))
                            <ul>
                                @foreach ($errors->get('duplicates') as $studentId => $rollNo)
                                    <li>Roll No {{ $rollNo }} is already assigned to another student.</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endif
{{-- @if (session('duplicates'))
    <div class="alert alert-danger">
        <strong>Error!</strong> Some roll numbers are already taken by other students:
        <ul>
            @foreach (session('duplicates') as $id => $roll_no)
                <li>Student ID: {{ $id }}, Roll Number: {{ $roll_no }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}


                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-3">
                            <input type="button" class="btn btn-primary" value="GET DATA" onclick="fillstudents();" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </div>
                    </div>

                    <div class="row" id="table-students">
                        <!-- Student Table will be populated here -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')

<script type="text/javascript">
    function fillstudents() {
        var course_id = document.getElementById("course_id").value;
        var sem_id = document.getElementById("sem_id").value;

        $.ajax({
            type: 'POST',
            url: '{{ route("partials.student-table") }}',
            data: {
                _token: '{{ csrf_token() }}',
                c_id: course_id,
                s_id: sem_id
            },
            success: function(response) {
                var ele = document.getElementById("table-students");
                if (ele) {
                    ele.innerHTML = response;
                }
            },
            error: function() {
                alert('An error occurred while fetching dynamic content.');
            }
        });
    }
    </script>


@endsection

