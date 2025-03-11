@extends('layoutsss.app')

@section('content')
<div class="pagetitle">
    <h1>Teacher Details</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item">Details</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="{{ isset($teacher) ? 'nav-link' : 'nav-link active' }}" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Teacher</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="{{ isset($teacher) ? 'nav-link active' : 'nav-link' }}" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">New</button>
                    </li>
                </ul>

                <div class="tab-content pt-2" id="borderedTabContent">
                    <!-- Teachers List Tab -->
                    <div class="{{ isset($teacher) ? 'tab-pane fade' : 'tab-pane fade show active' }}" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">DOB</th>
                                    <th scope="col">Qualification</th>
                                    <th scope="col">Designation</th>
                                    <th scope="col">DOJ</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                        @forelse($teachers as $index => $teacherI)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $teacherI->first_name }} {{ $teacherI->middle_name }} {{ $teacherI->last_name }}</td>
                                            <td>{{ $teacherI->date_of_birth }}</td>
                                            <td>{{ $teacherI->qualification }}</td>
                                            <td>{{ $teacherI->designation->name }}</td>
                                            <td>{{ $teacherI->date_of_joining }}</td>
                                            <td>{{ $teacherI->contact }}</td>
                                            <td>{{ $teacherI->email }}</td>
                                        <td>
                                            <a class="btn btn-primary" href="{{ route('teachers.edit', $teacherI->id) }}">
                                                <i class="ri-edit-fill"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route('teachers.destroy', $teacherI->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this teacher?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-primary">
                                                    <i class='ri-delete-bin-fill'></i>
                                                </button>
                                            </form>
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

                    <!-- New/Edit Teacher Form Tab -->
                    <div class="{{ isset($teacher) ? 'tab-pane fade show active' : 'tab-pane fade' }}" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
                        <form method="POST" action="{{ isset($teacher) ? route('teachers.update', $teacher->id) : route('teachers.store') }}">
                            @csrf
                            @if(isset($teacher))
                                @method('PUT')
                            @endif

                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-1">User's Type</legend>
                                <div class="col-sm-3">
                                    <select class="form-select" name="u_type">
                                        <option value="0" {{ (isset($teacher) && $teacher->u_type == 0) ? 'selected' : '' }}>Teacher</option>
                                        {{-- <option value="1" {{ (isset($teacher) && $teacher->u_type == 1) ? 'selected' : '' }}>Admin</option> --}}
                                    </select>
                                </div>
                            </fieldset>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">First Name</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="first_name" value="{{ $teacher->first_name ?? '' }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Middle Name</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="middle_name" value="{{ $teacher->middle_name ?? '' }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Last Name</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="last_name" value="{{ $teacher->last_name ?? '' }}" required>
                                </div>
                            </div>

                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-1">Gender</legend>
                                <div class="col-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" value="Male" {{ (isset($teacher) && $teacher->gender == 'Male') ? 'checked' : '' }} required>
                                        <label class="form-check-label">Male</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" value="Female" {{ (isset($teacher) && $teacher->gender == 'Female') ? 'checked' : '' }} required>
                                        <label class="form-check-label">Female</label>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Date Of Birth</label>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control" name="date_of_birth" value="{{ $teacher->date_of_birth ?? '' }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Qualification</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="qualification" value="{{ $teacher->qualification ?? '' }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Designation</label>
                                <div class="col-sm-3">
                                    <select class="form-select" name="designation_id" required>
                                        <option value="">Select Designation</option>
                                        @foreach($designations as $designation)
                                            <option value="{{ $designation->id }}" {{ (isset($teacher) && $teacher->designation_id == $designation->id) ? 'selected' : '' }}>
                                                {{ $designation->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Date Of Joining</label>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control" name="date_of_joining" value="{{ $teacher->date_of_joining ?? '' }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Contact</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="contact" value="{{ $teacher->contact ?? '' }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-3">
                                    <input type="email" class="form-control" name="email" value="{{ $teacher->email ?? '' }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-3">
                                    <input type="password" class="form-control" name="password" {{ isset($teacher) ? '' : 'required' }}>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3 offset-sm-2">
                                    <button type="submit" class="btn btn-primary">{{ isset($teacher) ? 'Update' : 'Add' }}</button>
                                    {{-- <button type="submit" class="btn btn-primary">Role</button> --}}
                                    {{-- <input type="hidden" name="roleid" value="{{ isset($teacher) ? 'Role' : '' }}"> --}}

                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- End Bordered Tabs -->
            </div>
        </div>
    </div>
</section>
@endsection
