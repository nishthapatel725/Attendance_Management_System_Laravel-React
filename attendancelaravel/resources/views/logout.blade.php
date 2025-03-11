{{-- <!-- resources/views/logout.blade.php -->

@extends('layouts.app') <!-- Use your main layout file -->

@section('content')
<div class="container">
    <h1>Logout</h1>
    <p>Are you sure you want to log out?</p>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <li>
            <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">
              <i class="bi bi-box-arrow-right"></i>
              <span>Sign Out</span>
            </a>
          </li>
    </form>
    
</div>
@endsection --}}
