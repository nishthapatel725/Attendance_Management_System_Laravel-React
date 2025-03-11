@extends('layoutsss.app')

@section('content')
<div class="pagetitle">
  <h1>Semester Details</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Admin</a></li>
      <li class="breadcrumb-item active">Semester</li>
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
            <button class="{{ isset($semester) ? 'nav-link' : 'nav-link active' }}" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Semester</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="{{ isset($semester) ? 'nav-link active' : 'nav-link' }}" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">New</button>
          </li>
        </ul>

        <div class="tab-content pt-2" id="borderedTabContent">
          <div class="{{ isset($semester) ? 'tab-pane fade' : 'tab-pane fade show active' }}" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Semester Name</th>
                  <th scope="col">Edit</th>
                  <th scope="col">Delete</th>
                </tr>
              </thead>
              <tbody>
                @forelse($semesters as $key => $semesterItem)
                  <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $semesterItem->name }}</td>
                    <td>
                      <a class="btn btn-primary" href="{{ route('semester.edit', $semesterItem->sem_id) }}">
                        <i class='ri-edit-fill'></i>
                      </a>
                    </td>
                    <td>
                      <form action="{{ route('semester.destroy', $semesterItem->sem_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this course?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary"><i class='ri-delete-bin-fill'></i></button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="4">No records found...</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
            <!-- End Table with stripped rows -->
          </div>

          <div class="{{ isset($semester) ? 'tab-pane fade show active' : 'tab-pane fade' }}" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
            <form method="POST" action="{{ isset($semester) ? route('semester.update', $semester->sem_id) : route('semester.store') }}">
              @csrf
              @if(isset($semester))
                @method('PUT')
              @endif
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Semester Name</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" name="name" value="{{ $semester->name ?? '' }}" required>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-3">
                  <input type="submit" class="btn btn-primary" value="{{ isset($semester) ? 'Update' : 'Add' }}">
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
