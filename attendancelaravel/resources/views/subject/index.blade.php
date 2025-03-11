@extends('layoutsss.app')

@section('content')
<div class="pagetitle">
    <h1>Subject Details</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item">Subject</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="{{ isset($subject) ? 'nav-link' : 'nav-link active' }}" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Subjects</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="{{ isset($subject) ? 'nav-link active' : 'nav-link' }}" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">New</button>
                      </li>
                </ul>
                <div class="tab-content pt-2" id="borderedTabContent">
          <div class="{{ isset($subject) ? 'tab-pane fade' : 'tab-pane fade show active' }}" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                        
                        <!-- Table with stripped rows -->
                 
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Course</th>
                                    <th>Semester</th>
                                    <th>Subject Code</th>
                                    <th>Subject Name</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($subjects as $index => $subjectI)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $subjectI->course->course_name }}</td>
                                        <td>{{ $subjectI->semester->name }}</td>
                                        <td>{{ $subjectI->sub_code }}</td>
                                        <td>{{ $subjectI->sub_name }}</td>
                                        <td>
                                            <a class="btn btn-primary" href="{{ route('subject.edit', $subjectI->sub_id) }}">
                                              <i class='ri-edit-fill'></i>
                                            </a>
                                          </td>
                                        <td>
                                            <form action="{{ route('subject.destroy', $subjectI->sub_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this subject?');">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button type="submit" class="btn btn-primary"><i class='ri-delete-bin-fill'></i></button>
                                                </form>
                                          </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan='7'>No records found...</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        
                        <!-- End Table with stripped rows -->
                    </div>
          <div class="{{ isset($subject) ? 'tab-pane fade show active' : 'tab-pane fade' }}" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
                    
            <form method="POST" action="{{ isset($subject) ? route('subject.update', $subject->sub_id) : route('subject.store') }}">
                        
                            @csrf
                            @if(isset($subject))
                            @method('PUT')
                        @endif
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Course</label>
                                <div class="col-sm-3">
                                    <select class="form-select" name="course_id" id="course_id" required>
                                        <option value=''>Select Course</option>
                                        @foreach($courses as $course)
                                            <option value="{{ $course->course_id }}" {{ isset($subject) && $subject->course_id == $course->course_id ? 'selected' : '' }}>{{ $course->course_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Semester</label>
                                <div class="col-sm-3">
                                    <select class="form-select" name="sem_id" id="sem_id" required>
                                        <option value=''>Select Semester</option>
                                        @foreach($semesters as $semester)
                                            <option value="{{ $semester->sem_id }}" {{ isset($subject) && $subject->sem_id == $semester->sem_id ? 'selected' : '' }}>{{ $semester->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Subject Code</label>
                                <div class="col-sm-3">
                                    <input type="text" name="sub_code" class="form-control" value="{{ $subject->sub_code ?? '' }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Subject Name</label>
                                <div class="col-sm-3">
                                    <input type="text" name="sub_name" class="form-control" value="{{ $subject->sub_name ?? '' }}" required>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-3">
                                  <input type="submit" class="btn btn-primary" value="{{ isset($subject) ? 'Update' : 'Add' }}">
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
