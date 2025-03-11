@extends('layoutsss.app')

@section('content')
<div class="pagetitle">
    <h1>Semester Wise List Subject Allotment</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item">Report</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="card">
            <div class="card-header"></div>
            <div class="card-body">
                <form method="POST" action="{{ route('reports.semlist-suballot') }}">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Course</label>
                        <div class="col-sm-3">
                            <select class="form-select" name="course_id" id="course_id">
                                <option value='0'>Select Course</option>
                                @foreach ($courses as $course)
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
                                @foreach ($semesters as $semester)
                                    <option value="{{ $semester->sem_id }}" {{ isset($sem_id) && $sem_id == $semester->sem_id ? 'selected' : '' }}>
                                        {{ $semester->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Academic Year</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="acadamic_year" value="{{ $acadamic_year ?? '' }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-3">
                            <input type="submit" class="btn btn-primary" name="btn_submit" id="btn_submit" value="Generate" />
                        </div>
                    </div>
                </form>
            </div>

            @if (isset($course_id))
            <div class="card-footer">
                <div id="dpdf">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                Course: {{ $course_name ?? '' }}<br>
                                Semester: {{ $name ?? '' }}<br>
                                {{-- Academic Year: {{ $acadamic_year ?? '' }} --}}
                            </h5>
                            <!-- Bordered Table -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Subject Name</th>
                                        <th scope="col">Teacher</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($subAllotments->isEmpty())
                                        <tr><td colspan="3">No records found...</td></tr>
                                    @else
                                        @foreach ($subAllotments as $key => $subAllotment)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $subAllotment->subject->sub_name }}</td>
                                                <td>{{ $subAllotment->teacher->first_name }} {{ $subAllotment->teacher->middle_name }} {{ $subAllotment->teacher->last_name }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection
