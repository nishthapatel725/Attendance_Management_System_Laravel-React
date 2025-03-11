
@extends('layoutsss.app')

@section('content')
<div class="pagetitle">
    <h1>Allotment Subject</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item">Allotment Subject</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="{{ isset($subAllotment) ? 'nav-link' : 'nav-link active' }}" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Allocate Subject</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="{{ isset($subAllotment) ? 'nav-link active' : 'nav-link' }}" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">New</button>
                    </li>
                </ul>
                <div class="tab-content pt-2" id="borderedTabContent">
                    <div class="{{ isset($subAllotment) ? 'tab-pane fade' : 'tab-pane fade show active' }}" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Course</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Teacher</th>
                                    <th scope="col">Academic Year</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($subAllotments as $index => $subAllot)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $subAllot->course->course_name }}</td>
                                        <td>{{ $subAllot->semester->name }}</td>
                                        <td>{{ $subAllot->subject->sub_name }}</td>
                                        <td>{{ $subAllot->teacher ? $subAllot->teacher->first_name . ' ' . $subAllot->teacher->middle_name . ' ' . $subAllot->teacher->last_name : 'Teacher not found' }}</td>
                                        <td>{{ $subAllot->academic_year }}</td>
                                        <td>
                                            <a class="btn btn-primary" href="{{ route('allocate-subject.edit', $subAllot->id) }}">
                                                <i class="ri-edit-fill"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route('allocate-subject.destroy', $subAllot->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-primary">
                                                    <i class='ri-delete-bin-fill'></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="8">No records found...</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="{{ isset($subAllotment) ? 'tab-pane fade show active' : 'tab-pane fade' }}" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
                        <form method="POST" action="{{ isset($subAllotment) ? route('allocate-subject.update', $subAllotment->id) : route('allocate-subject.store') }}">
                            @csrf
                            @if(isset($subAllotment))
                                @method('PUT')
                            @endif
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Course</label>
                                <div class="col-sm-3">
                                    <select class="form-select" aria-label="Default select example" name="course_id" id="cmb_course">
                                        <option value='0'>Select Course</option>
                                        @foreach($courses as $course)
                                            <option value="{{ $course->course_id }}" {{ (isset($subAllotment) && $subAllotment->course_id == $course->course_id) ? 'selected' : '' }}>{{ $course->course_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Semester</label>
                                <div class="col-sm-3">
                                    <select class="form-select" aria-label="Default select example" name="sem_id" id="cmb_sem">
                                        <option value='0'>Select Semester</option>
                                        @foreach($semesters as $semester)
                                            <option value="{{ $semester->sem_id }}" {{ (isset($subAllotment) && $subAllotment->sem_id == $semester->sem_id) ? 'selected' : '' }}>{{ $semester->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Subject</label>
                                <div class="col-sm-3">
                                    <select class="form-select" aria-label="Default select example" name="sub_id" id="cmb_sub">
                                        <option value='0'>Select Subject</option>
                                        @foreach($subjects as $subject)
                                            <option value="{{ $subject->sub_id }}" {{ (isset($subAllotment) && $subAllotment->sub_id == $subject->sub_id) ? 'selected' : '' }}>{{ $subject->sub_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Teacher</label>
                                <div class="col-sm-3">
                                    <select class="form-select" aria-label="Default select example" name="t_id" id="cmb_tea">
                                        <option value='0'>Select Teacher</option>
                                        @foreach($teachers as $teacher)
                                            <option value="{{ $teacher->id }}" {{ (isset($subAllotment) && $subAllotment->t_id == $teacher->id) ? 'selected' : '' }}>{{ $teacher->first_name }} {{ $teacher->middle_name }} {{ $teacher->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Academic Year</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="academic_year" name="academic_year" value="{{ $subAllotment->academic_year ?? '' }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-3">
                                    <input type="submit" class="btn btn-primary" value="{{ isset($subAllotment) ? 'Update' : 'Add' }}" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
