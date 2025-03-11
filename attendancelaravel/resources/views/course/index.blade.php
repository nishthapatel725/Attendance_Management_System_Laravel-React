@extends('layoutsss.app')

@section('content')
<div class="pagetitle">
    <h1>Course Details</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item">Course</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="{{ isset($course) ? 'nav-link' : 'nav-link active' }}" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Course</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="{{ isset($course) ? 'nav-link active' : 'nav-link' }}" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">New</button>
                      </li>
                </ul>

                <div class="tab-content pt-2" id="borderedTabContent">

          <div class="{{ isset($course) ? 'tab-pane fade' : 'tab-pane fade show active' }}" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">

                        <!-- Course List Table -->
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
            @forelse($courses as $index => $courseItem)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $courseItem->course_name }}</td>
                    <td>{{ $courseItem->course_type }}</td>
                    <td>{{ $courseItem->course_sem }}</td>
                    <td><a class="btn btn-primary edit-course-btn" href="{{ route('course.edit', $courseItem->course_id) }}">
                        <i class='ri-edit-fill'></i>
                    </a></td>
                    <td>
                        <form action="{{ route('course.destroy', $courseItem->course_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this course?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-primary">
                                <i class='ri-delete-bin-fill'></i>
                            </button>
                        </form>
                    </td>

                </tr>
            @empty
                <tr><td colspan='6'>No records found...</td></tr>
            @endforelse
        </tbody>
    </table>
                    </div>

            <div class="{{ isset($course) ? 'tab-pane fade show active' : 'tab-pane fade' }}" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">

                        <form id="courseForm" method="POST" action="{{ isset($course) ? route('course.update', $course->course_id) : route('course.store') }}">
                            @csrf
                            @if(isset($course))
                                @method('PUT')
                                <input type="hidden" name="course_id" value="{{ $course->course_id }}">
                            @endif

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Course Name</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="course_name" name="course_name" value="{{ isset($course) ? $course->course_name : '' }}" required>
                                </div>
                            </div>
                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-1">Course Type</legend>
                                <div class="col-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="course_type" value="UG" id="course_type_ug" {{ isset($course) && $course->course_type == 'UG' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="course_type_ug">Under Graduate</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="course_type" value="PG" id="course_type_pg" {{ isset($course) && $course->course_type == 'PG' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="course_type_pg">Post Graduate</label>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">No of Semester</label>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control" id="course_sem" name="course_sem" value="{{ isset($course) ? $course->course_sem : '' }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-3">
                                    <input type="submit" class="btn btn-primary" value="{{ isset($course) ? 'Update' : 'Add' }}">
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
