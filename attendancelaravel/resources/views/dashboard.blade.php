<!-- resources/views/dashboard.blade.php -->

@extends('layoutsss.app')

@section('content')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item">Dashboard</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <!-- Course -->
        <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title"><a href="{{ route('course.index') }}">Course</a></h5>
                    <div class="d-flex align-items-center">
                        <div class="icon rounded-circle justify-content-center">
                            <i class="bi bi-menu-button-wide"></i>
                        </div>
                        <div class="ps-3">
                            <h2>{{ $course_count }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End Course -->

        <!-- Semester -->
        <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title"><a href="{{ route('semester.index') }}">Semester</a></h5>
                    <div class="d-flex align-items-center">
                        <div class="icon rounded-circle justify-content-center">
                            <i class="bi bi-journal-text"></i>
                        </div>
                        <div class="ps-3">
                            <h2>{{ $sem_count }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End Semester -->

        <!-- Teacher -->
         <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title"><a href="{{ route('teachers.index') }}">Teacher</a></h5>
                    <div class="d-flex align-items-center">
                        <div class="icon rounded-circle justify-content-center">
                            <i class="bi bi-person"></i>
                        </div>
                        <div class="ps-3">
                            <h2>{{ $tea_count }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End Teacher -->

        <!-- New Students -->
        <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title"><a href="{{ route('studentapprove.index') }}">New Students</a></h5>
                    <div class="d-flex align-items-center">
                        <div class="icon rounded-circle justify-content-center">
                            <i class="bi bi-person-check"></i>
                        </div>
                        <div class="ps-3">
                            <h2>{{ $student_count }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End New Students -->
    </div>
</section>
@endsection
