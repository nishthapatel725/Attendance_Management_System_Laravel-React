@extends('layoutsss.app')

@section('content')
<div class="pagetitle">
    <h1>Course Wise Subject Reports</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item">Report</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="card">
            <div class="card-header"></div>
            <div class="card-body">
                <form method="POST" action="{{ route('reports.coursewise-subreport') }}">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Course</label>
                        <div class="col-sm-3">
                            <select class="form-select" name="course_id" id="course_id">
                                <option value='0'>Select Course</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->course_id }}" {{ isset($course_id) && $course_id == $course->course_id ? 'selected' : '' }}>
                                        {{ $course->course_name }}
                                    </option>
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Semester</label>
                        <div class="col-sm-3">
                            <select class="form-select" name="sem_id" id="sem_id">
                                <option value='0'>Select Semester</option>
                                @foreach($semesters as $semester)
                                    <option value="{{ $semester->sem_id }}" {{ $sem_id == $semester->sem_id ? 'selected' : '' }}>
                                        {{ $semester->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 offset-sm-2">
                            <input type="submit" class="btn btn-primary" value="Generate" />
                        </div>
                    </div>
                </form>
{{-- 
                @if(isset($subjects) && count($subjects) > 0)
                <div class="card-footer">
                    <h5 class="card-title">
                        Course: {{ $course_name }}<br>
                        Semester: {{ $name }}
                    </h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Subject Code</th>
                                <th>Subject Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subjects as $index => $subject)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $subject->sub_code }}</td>
                                    <td>{{ $subject->sub_name }}</td>
                                </tr>
                                
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="card-footer">
                    <p>No records found.</p>
                </div>
                @endif --}}
                @if(isset($subjects))
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                Course: {{ $course_name }}<br>
                                Semester: {{ $name }}
                            </h5>

                            <!-- Bordered Table -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Subject Code</th>
                                        <th>Subject Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($subjects as $index => $subject)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $subject->sub_code }}</td>
                                            <td>{{ $subject->sub_name }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">No records found...</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <!-- End Bordered Table -->
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
