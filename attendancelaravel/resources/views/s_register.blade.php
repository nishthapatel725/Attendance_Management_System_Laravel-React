<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Student Registration</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="imagess/logo/logoaaa.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="{{ asset('img/logo/logoaaa.png') }}" rel="icon">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

</head>
<body>
<main>
    <div class="container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-10 d-flex flex-column align-items-center justify-content-center">
                <div class="d-flex justify-content-center py-4">
                    <a href="{{ url('/') }}" class="logo d-flex align-items-center w-auto">
                      <img src="imagess/logo/logoaaa.png" alt="">
                        
                        <span class="d-none d-lg-block">Attendance management</span>
                    </a>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Student Registration</h5>
                            <p class="text-center small">Enter your personal details to create an account</p>
                        </div>
                        <form class="row g-3 needs-validation" novalidate action="{{ route('register.submit') }}" method="POST">
                            @csrf
                            <div class="col-md-4">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control" id="first_name" value="{{ old('first_name') }}" required>
                                <div class="invalid-feedback">Please, enter your first name!</div>
                            </div>
                            <div class="col-md-4">
                                <label for="middle_name" class="form-label">Middle Name</label>
                                <input type="text" name="middle_name" class="form-control" id="middle_name" value="{{ old('middle_name') }}" required>
                                <div class="invalid-feedback">Please, enter your middle name!</div>
                            </div>
                            <div class="col-md-4">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control" id="last_name" value="{{ old('last_name') }}" required>
                                <div class="invalid-feedback">Please, enter your last name!</div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Gender</label>
                                <div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="rbtn_male" value="Male" {{ old('gender') == 'Male' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="rbtn_male">Male</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="rbtn_female" value="Female" {{ old('gender') == 'Female' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="rbtn_female">Female</label>
                                    </div>
                                </div>
                                <div class="invalid-feedback">Please, select your gender!</div>
                            </div>
                            <div class="col-md-4">
                                <label for="dob" class="form-label">Date Of Birth</label>
                                <input type="date" name="dob" class="form-control" id="dob" value="{{ old('dob') }}" required>
                                <div class="invalid-feedback">Please enter your birth date.</div>
                            </div>
                            <div class="col-md-4">
                                <label for="contact" class="form-label">Contact</label>
                                <input type="text" name="contact" class="form-control" id="contact" value="{{ old('contact') }}" required>
                                <div class="invalid-feedback">Please, enter your contact!</div>
                            </div>
                            <div class="col-md-4">
                                <label for="email" class="form-label">Your Email</label>
                                <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required>
                                <div class="invalid-feedback">Please enter a valid email address!</div>
                            </div>
                            <div class="col-md-4">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password" required>
                                <div class="invalid-feedback">Please enter your password!</div>
                            </div>
                            <div class="col-md-4">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                                <div class="invalid-feedback">Please confirm your password!</div>
                            </div>
                            <div class="col-md-4">
                                <label for="gr_no" class="form-label">GR No.</label>
                                <input type="text" name="gr_no" class="form-control" id="gr_no" value="{{ old('gr_no') }}" required>
                                <div class="invalid-feedback">Please, enter your GR no!</div>
                            </div>
                            <div class="col-md-4">
                                <label for="enrollment_no" class="form-label">Enrollment No.</label>
                                <input type="text" name="enrollment_no" class="form-control" id="enrollment_no" value="{{ old('enrollment_no') }}" required>
                                <div class="invalid-feedback">Please enter your Enrollment number!</div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Course</label>
                                <select class="form-select" name="course_id" id="course_id" required>
                                    <option value='0'>Select Course</option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->course_id }}" {{ old('course_id') == $course->course_id ? 'selected' : '' }}>{{ $course->course_name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Please select a course.</div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Semester</label>
                                <select class="form-select" name="sem_id" id="sem_id" required>
                                    <option value='0'>Select Semester</option>
                                    @foreach ($semesters as $semester)
                                        <option value="{{ $semester->sem_id }}" {{ old('sem_id') == $semester->sem_id ? 'selected' : '' }}>{{ $semester->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Please select a semester.</div>
                            </div>
                            <div class="col-md-12">
                                <center>
                                    <div class="col-md-4">
                                        <button class="btn btn-primary w-100" type="submit">Create Account</button>
                                    </div>
                                </center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
