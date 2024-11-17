<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}" sizes="16x16">
    
    <!-- remix icon font css  -->
    <link rel="stylesheet" href="{{ asset('assets/css/remixicon.css') }}">
    
    <!-- BootStrap css -->
    <link rel="stylesheet" href="{{ asset('assets/css/lib/bootstrap.min.css') }}">
    
    <!-- Apex Chart css -->
    <link rel="stylesheet" href="{{ asset('assets/css/lib/apexcharts.css') }}">
    
    <!-- Data Table css -->
    <link rel="stylesheet" href="{{ asset('assets/css/lib/dataTables.min.css') }}">
    
    <!-- Text Editor css -->
    <link rel="stylesheet" href="{{ asset('assets/css/lib/editor-katex.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/lib/editor.atom-one-dark.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/lib/editor.quill.snow.css') }}">
    
    <!-- Date picker css -->
    <link rel="stylesheet" href="{{ asset('assets/css/lib/flatpickr.min.css') }}">
    
    <!-- Calendar css -->
    <link rel="stylesheet" href="{{ asset('assets/css/lib/full-calendar.css') }}">
    
    <!-- Vector Map css -->
    <link rel="stylesheet" href="{{ asset('assets/css/lib/jquery-jvectormap-2.0.5.css') }}">
    
    <!-- Popup css -->
    <link rel="stylesheet" href="{{ asset('assets/css/lib/magnific-popup.css') }}">
    
    <!-- Slick Slider css -->
    <link rel="stylesheet" href="{{ asset('assets/css/lib/slick.css') }}">
    
    <!-- prism css -->
    <link rel="stylesheet" href="{{ asset('assets/css/lib/prism.css') }}">
    
    <!-- file upload css -->
    <link rel="stylesheet" href="{{ asset('assets/css/lib/file-upload.css') }}">
    
    <link rel="stylesheet" href="{{ asset('assets/css/lib/audioplayer.css') }}">
    
    <!-- main css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.css" rel="stylesheet">
    
    <!-- SweetAlert CSS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <!-- Make sure to include Select2's CSS and JS -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"> 
</head>

<style>
        body {
            font-family: 'Roboto', sans-serif; /* Using Roboto font */
            font-size: 18px; /* Set font size to 20px */
        }
    </style>
<body>
<aside class="sidebar">
  <button type="button" class="sidebar-close-btn">
    <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
  </button>
  <div>
    <a href="index.html" class="sidebar-logo text-white bg-primary">
    {{--<img src="{{ asset('assets/images/uralogo.png') }}" alt="site logo" class="light-logo">
   <img src="{{ asset('assets/images/logo-light.png') }}" alt="site logo" class="dark-logo">
   <img src="{{ asset('assets/images/logo-icon.png') }}" alt="site logo" class="logo-icon">
--}} <strong>MOBILE</strong>
    </a>
  </div>
  <div class="sidebar-menu-area">
    <ul class="sidebar-menu" id="sidebar-menu">
      
      <!-- Dashboard Section -->
      <li class="dropdown">
        <a href="javascript:void(0)">
          <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
          <span>Dashboard</span>
        </a>
        <ul class="sidebar-submenu">
          <li>
            <a href="{{ route('dashboard') }}"><i class="ri-home-line"></i> Dashboard</a>
          </li>
        </ul>
      </li>

      <!-- Administration Section (For Admin only) -->
      @if(auth()->user()->hasAnyRole(['admin']))
      <li class="dropdown">
        <a href="javascript:void(0)">
          <iconify-icon icon="material-symbols:admin-panel-settings" class="menu-icon"></iconify-icon>
          <span>Administration</span>
        </a>
        <ul class="sidebar-submenu">
          <li><a href="{{ route('branches.create') }}"><i class="ri-building-line"></i> Create Branch</a></li>
          <li><a href="{{ route('districts.create') }}"><i class="ri-map-pin-line"></i> Create District</a></li>
          <li><a href="{{ route('roles.create') }}"><i class="ri-task-line"></i> Create Role</a></li>
          <li><a href="{{ route('posts.create') }}"><i class="ri-briefcase-line"></i> Create Post</a></li>
          <li><a href="{{ route('users.create') }}"><i class="ri-user-add-line"></i> Create User</a></li>
          <li><a href="{{ route('employees.create') }}"><i class="ri-user-settings-line"></i> Create Employee</a></li>
          <li><a href="{{ route('payrolls.create') }}"><i class="ri-upload-line"></i> Upload Members</a></li>
        </ul>
      </li>
      @endif

      <!-- Applications Section (For Authenticated users) -->
      @if(auth()->check())
      <li class="dropdown">
        <a href="javascript:void(0)">
          <iconify-icon icon="solar:document-text-outline" class="menu-icon"></iconify-icon>
          <span>Applications</span>
        </a>
        <ul class="sidebar-submenu">
          <li><a href="{{ route('persons.create') }}"><i class="ri-user-add-line"></i> New User</a></li>
          <li><a href="{{ route('personResets.create') }}"><i class="ri-refresh-line"></i>PIN Reset</a></li>
        </ul>
      </li>
      @endif

      <!-- Applied Section (For Authenticated users) -->
      @if(auth()->check())
      <li class="dropdown">
        <a href="javascript:void(0)">
          <iconify-icon icon="carbon:checkmark" class="menu-icon"></iconify-icon>
          <span>Mobile Users</span>
        </a>
        <ul class="sidebar-submenu">
          <li><a href="{{ route('persons.index') }}"><i class="ri-list-check"></i>New Users</a></li>
          <li><a href="{{ route('personResets.index') }}"><i class="ri-refresh-line"></i>PIN Reset</a></li>
        </ul>
      </li>
      @endif


          <!-- Applied Section (For Authenticated users) -->
          @if(auth()->check())
      <li class="dropdown">
        <a href="javascript:void(0)">
        <iconify-icon icon="solar:pie-chart-outline" class="menu-icon"></iconify-icon>
          <span>Analytics</span>
        </a>
        <ul class="sidebar-submenu">
          <li><a href="{{ route('analytics.index') }}"><iconify-icon icon="solar:pie-chart-outline" class="menu-icon"></iconify-icon>General Analytics</a></li>
        </ul>
      </li>
      @endif

    </ul>
</div>
</aside>

<main class="dashboard-main">
  <div class="navbar-header shadow-4">
  <div class="row align-items-center justify-content-between">
    <div class="col-auto">
      <div class="d-flex flex-wrap align-items-center gap-4">
        <button type="button" class="sidebar-toggle">
          <iconify-icon icon="heroicons:bars-3-solid" class="icon text-2xl non-active"></iconify-icon>
          <iconify-icon icon="iconoir:arrow-right" class="icon text-2xl active"></iconify-icon>
        </button>
        <button type="button" class="sidebar-mobile-toggle">
          <iconify-icon icon="heroicons:bars-3-solid" class="icon"></iconify-icon>
        </button>
        <form class="navbar-search">
          <input type="text" name="search" placeholder="Search">
          <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
        </form>
      </div>
    </div>
    <div class="col-auto">
    <div class="d-flex flex-wrap align-items-center gap-3">
        <!-- Theme Toggle Button -->
        <button type="button" data-theme-toggle class="w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center">
            <iconify-icon icon="bi:brightness-high" class="icon text-xl text-secondary"></iconify-icon>
        </button>

        <!-- Profile Dropdown -->
<div class="col-auto">
    <div class="d-flex flex-wrap align-items-center gap-3">
        <!-- Profile Dropdown -->
        <div class="dropdown">
            <button class="d-flex justify-content-center align-items-center rounded-circle w-40-px h-40-px bg-neutral-200" type="button" data-bs-toggle="dropdown">
                <iconify-icon icon="mingcute:user-follow-fill" class="icon text-secondary text-xl"></iconify-icon>
            </button>
            <div class="dropdown-menu to-top dropdown-menu-sm">
                <!-- Profile Header -->
                <div class="py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
                    <div>
                        <h6 class="text-lg text-primary-light fw-semibold mb-2">{{ Auth::user()->email }}</h6>
                        <span class="text-secondary-light fw-medium text-sm">Role: {{ Auth::user()->employee->role->role ?? 'Role Not Assigned' }}</span>
                    </div>

                    <button type="button" class="hover-text-danger">
                        <iconify-icon icon="radix-icons:cross-1" class="icon text-secondary text-xl"></iconify-icon>
                    </button>
                </div>

                <!-- Dropdown Menu Items -->
                <ul class="to-top-list">
                    <li>
                        <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-primary d-flex align-items-center gap-3" href="{{ route('profile') }}">
                            <iconify-icon icon="solar:user-linear" class="icon text-xl text-secondary"></iconify-icon> My Profile
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-danger d-flex align-items-center gap-3" href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <iconify-icon icon="lucide:power" class="icon text-xl text-danger"></iconify-icon> Log Out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Profile Dropdown End -->
    </div>
</div>

    </div>
</div>


    </div>
  </div>
</div> 

  <div class="dashboard-main-body mt-2">
    <!--
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
  <h6 class="fw-semibold mb-0">Alerts</h6>
  <ul class="d-flex align-items-center gap-2">
    <li class="fw-medium">
      <a href="index.html" class="d-flex align-items-center gap-1 hover-text-primary">
        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
        Dashboard
      </a>
    </li>
  </ul>
</div>
-->
    {{--<div class="row gy-4 mb-3">
        <div class="col-lg-12">
            <div class="card h-100 p-0">
                <div class="card-header py-16 px-24 w-100 bg-info">
                </div>--}}
                <div class="container-fluid">
                @yield('content')
                </div>                    
                </div>
            </div>
        {{--</div>
    </div>
  </div>--}}
</main>
<footer class="d-footer text-center">
    <div class="row align-items-center justify-content-center">
        <div class="col-auto">
            <p class="mb-0">© 2024 URA SACCOS LTD. All Rights Reserved.</p>
        </div>
        <div class="col-auto">
            <p class="mb-0">Made by <span class="text-primary-600">URASACCOS ICT</span></p>
        </div>
    </div>
</footer>


 
    
    <!-- jQuery library js -->
    <script src="{{ asset('assets/js/lib/jquery-3.7.1.min.js') }}"></script>
    
    <!-- Bootstrap js -->
    <script src="{{ asset('assets/js/lib/bootstrap.bundle.min.js') }}"></script>
    
    <!-- Apex Chart js -->
    <script src="{{ asset('assets/js/lib/apexcharts.min.js') }}"></script>
    
    <!-- Data Table js -->
    <script src="{{ asset('assets/js/lib/dataTables.min.js') }}"></script>
    
    <!-- Iconify Font js -->
    <script src="{{ asset('assets/js/lib/iconify-icon.min.js') }}"></script>
    
    <!-- jQuery UI js -->
    <script src="{{ asset('assets/js/lib/jquery-ui.min.js') }}"></script>
    
    <!-- Vector Map js -->
    <script src="{{ asset('assets/js/lib/jquery-jvectormap-2.0.5.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/jquery-jvectormap-world-mill-en.js') }}"></script>
    
    <!-- Popup js -->
    <script src="{{ asset('assets/js/lib/magnific-popup.min.js') }}"></script>
    
    <!-- Slick Slider js -->
    <script src="{{ asset('assets/js/lib/slick.min.js') }}"></script>
    
    <!-- prism js -->
    <script src="{{ asset('assets/js/lib/prism.js') }}"></script>
    
    <!-- file upload js -->
    <script src="{{ asset('assets/js/lib/file-upload.js') }}"></script>
    
    <!-- audioplayer -->
    <script src="{{ asset('assets/js/lib/audioplayer.js') }}"></script>
    
    <!-- main js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    
    <!-- SweetAlert JS CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize DataTable for both #dataTable and #myTable
        let dataTable = new DataTable('#dataTable');
        let myTable = new DataTable('#myTable');
    });
</script>



    <!-- SweetAlert Success/Error Notification -->
    @if(session('success'))
        <script>
            swal("Success", "{{ session('success') }}", "success");
        </script>
    @endif

    @if(session('error'))
        <script>
            swal("Error", "{{ session('error') }}", "error");
        </script>
    @endif

    <script>
        $('.remove-button').on('click', function() {
            $(this).closest('.alert').addClass('d-none');
        }); 
    </script>
</body>
</html>
