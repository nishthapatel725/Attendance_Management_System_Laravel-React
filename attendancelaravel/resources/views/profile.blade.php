@extends('profilelayout.app') <!-- Extend your layout here -->

@section('content')
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-10 d-flex flex-column align-items-center justify-content-center">
                <div class="d-flex justify-content-center py-4">
                    <a href="{{ url('/') }}" class="logo d-flex align-items-center w-auto">
                        <img src="{{ asset('img/logo/logoaaa.png') }}" alt="">
                        <span class="d-none d-lg-block">Academic Activity</span>
                    </a>
                </div>

                @if(session('alert_msg'))
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        {{ session('alert_msg') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card mb-3">
                    <div class="card-body">
                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Profile</h5>
                        </div>

                        <form class="row g-3 needs-validation" novalidate action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="col-md-4">
                                <label for="yourName" class="form-label">First Name</label>
                                <input type="text" name="txt_tfn" class="form-control" id="txt_tfn" value="{{ old('txt_tfn', $user->first_name) }}" required>
                                <div class="invalid-feedback">Please, enter your first name!</div>
                            </div>

                            <div class="col-md-4">
                                <label for="yourName" class="form-label">Middle Name</label>
                                <input type="text" name="txt_tmn" class="form-control" id="txt_tmn" value="{{ old('txt_tmn', $user->middle_name) }}">
                                <div class="invalid-feedback">Please, enter your middle name!</div>
                            </div>

                            <div class="col-md-4">
                                <label for="yourName" class="form-label">Last Name</label>
                                <input type="text" name="txt_tln" class="form-control" id="txt_tln" value="{{ old('txt_tln', $user->last_name) }}" required>
                                <div class="invalid-feedback">Please, enter your last name!</div>
                            </div>

                            <div class="col-md-4">
                                <label for="yourUsername" class="form-label">Date Of Birth</label>
                                <input type="date" name="txt_dob" class="form-control" id="txt_dob" value="{{ old('txt_dob', $user->date_of_birth) }}" required>
                                <div class="invalid-feedback">Please enter your birth date.</div>
                            </div>

                            <div class="col-md-4">
                                <label for="yourName" class="form-label">Contact</label>
                                <input type="text" name="txt_contact" class="form-control" id="txt_contact" value="{{ old('txt_contact', $user->contact) }}" required>
                                <div class="invalid-feedback">Please, enter your contact!</div>
                            </div>

                            <div class="col-md-4">
                                <label for="yourEmail" class="form-label">Your Email</label>
                                <input type="email" name="txt_email" class="form-control" id="txt_email" value="{{ old('txt_email', $user->email) }}" required>
                                <div class="invalid-feedback">Please enter a valid Email address!</div>
                            </div>

                            <div class="col-md-4">
                                <label for="yourPassword" class="form-label">Old Password</label>
                                <input type="password" name="txt_opwd" class="form-control" id="txt_opwd" required>
                                <div class="invalid-feedback">Please enter your old password!</div>
                            </div>

                            <div class="col-md-4">
                                <label for="yourPassword" class="form-label">New Password</label>
                                <input type="password" name="txt_pwd" class="form-control" id="txt_pwd" required>
                                <div class="invalid-feedback">Please enter your new password!</div>
                            </div>

                            <div class="col-md-4">
                                <label for="yourPassword" class="form-label">Confirm Password</label>
                                <input type="password" name="txt_cpwd" class="form-control" id="txt_cpwd" required>
                                <div class="invalid-feedback">Please confirm your new password!</div>
                            </div>

                            <div class="col-md-12">
                                <center>
                                    <div class="col-md-4">
                                        <button class="btn btn-primary w-100" type="submit">Update</button>
                                    </div>
                                </center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
