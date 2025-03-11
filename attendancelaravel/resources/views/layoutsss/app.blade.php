<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Attendance Management System</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
  <link href="imagess/logo/logoaaa.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <link href="{{ asset('imagess/logo/logoaaa.png') }}" rel="icon">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <!-- Add any other CSS or JS here -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>
<body>
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
          <a href="#" class="logo d-flex align-items-center">
            <img src="imagess/logo/logoaaa.png" alt="">
            <span class="d-none d-lg-block" style="color: #012970; font-size: 35px; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);">AMS</span>
          </a>
          <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        {{-- <div class="search-bar">
          <form class="search-form d-flex align-items-center" method="POST" action="#">
            <input type="text" name="query" placeholder="Search" title="Enter search keyword">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
          </form>
        </div><!-- End Search Bar --> --}}

        <nav class="header-nav ms-auto">
          <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
              <a class="nav-link nav-icon search-bar-toggle " href="#">
                <i class="bi bi-search"></i>
              </a>
            </li><!-- End Search Icon-->

            <li class="nav-item dropdown pe-3">

              <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                <i class="ri-account-box-line"></i>
                <span class="d-none d-md-block dropdown-toggle ps-2">Admin
                    {{-- {{ session('first_name', 'Admin') }} --}}
                </span>
            </a><!-- End Profile Iamge Icon -->


            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
              {{-- <li class="dropdown-header">
                  <h6>Designation
                    {{ session('designation_id', 'Designation') }}
                </h6>
              </li>
              <li>
                  <hr class="dropdown-divider">
              </li> --}}

              {{-- <li>
                  <a class="dropdown-item d-flex align-items-center" href="{{ route('profile') }}">
                      <i class="bi bi-person"></i>
                      <span>My Profile</span>
                  </a>
              </li> --}}
              <li>
                  <hr class="dropdown-divider">
              </li>

              <li>
                  <hr class="dropdown-divider">
              </li>

              <li>
                  <a class="dropdown-item d-flex align-items-center" href="{{ route('login') }}">
                      <i class="bi bi-box-arrow-right"></i>
                      <span>Sign Out</span>
                  </a>
              </li>
          </ul><!-- End Profile Dropdown Items -->
          </li><!-- End Profile Nav -->

          </ul>

        </nav><!-- End Icons Navigation -->

      </header>

      <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

          <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('dashboard') }}">
              <i class="bi bi-grid"></i>
              <span>Dashboard</span>
            </a>
          </li><!-- End Dashboard Nav -->

          <li class="nav-item">
            <a class="nav-link collapsed"  href="{{ route('course.index') }}">
              <i class="bi bi-menu-button-wide"></i><span>Course</span>
            </a>
          </li><!-- End Components Nav -->

          <li class="nav-item">
            <a class="nav-link collapsed"  href="{{ route('semester.index') }}">
              <i class="bi bi-journal-text"></i><span>Semester</span>
            </a>
          </li><!-- End Components Nav -->

          <li class="nav-item">
            <a class="nav-link collapsed"  href="{{ route('subject.index') }}">
              <i class="bi bi-layout-text-window-reverse"></i><span>Subjects</span>
            </a>
          </li><!-- End Components Nav -->

          <li class="nav-item">
            <a class="nav-link collapsed"  href="{{ route('teachers.index') }}">
              <i class="bi bi-person"></i><span>Teachers</span>
            </a>
          </li><!-- End Components Nav -->

          <li class="nav-item">
            <a class="nav-link collapsed"  href="{{ route('allocate-subject.index') }}">
              <i class="bi bi-file-earmark"></i><span>Allocate Subject</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link collapsed"  href="{{ route('genrate_rollno') }}">
              <i class="bi bi-list-ol"></i><span>Generate Roll. No.</span>
            </a>
          </li>

          {{-- <li class="nav-item">
            <a class="nav-link collapsed"  href="#">
              <i class="bi bi-box-arrow-right"></i><span>Student Promoted</span>
            </a>
          </li> --}}

          <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="">
              <i class="bi bi-bar-chart"></i><span>Reports</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a class="nav-link collapsed" href="{{ route('reports.coursewise-subreport') }}">
                  <i class="bi bi-circle"></i><span>Course Wise Subject Reports</span>
                </a>
              </li>
              <li>
                <a class="nav-link collapsed" href="{{ route('reports.semlist-suballot') }}">
                  <i class="bi bi-circle"></i><span>Semester Wise List Subject Allotment</span>
                </a>
              </li>
              <li>
              <a class="nav-link collapsed" href="{{ route('reports.semwise-studentdetail') }}">
                  <i class="bi bi-circle"></i><span>Course and Semester Wise Students</span>
                </a>
              </li>
            </ul>
          </li>
             </ul>

      </aside>

    <main id="main" class="main">
        @yield('content')
    </main>
    @yield('scripts')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function () {
        $('.datatable').DataTable(); // Initialize the DataTable
    });
</script>

</body>
</html>
