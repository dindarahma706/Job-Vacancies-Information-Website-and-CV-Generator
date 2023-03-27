<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Jobs - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link rel="shortcut icon" href="{{asset('assets/img/jobsicon.png')}}"/>
  <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
  <link href="{{asset('assets/css/cvform.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Ninestars - v4.10.0
  * Template URL: https://bootstrapmade.com/ninestars-free-bootstrap-3-theme-for-creative/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <a href="{{route('home')}}"><img src="{{asset('assets/img/logojobs.png')}}" alt="Image" class="img-fluid" style="width: auto;height:50px;"></a>
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link " href="{{route('home')}}">Home</a></li>
          <li><a class="nav-link scrollto" href="#findjobs">Find Jobs</a></li>
          @auth
            @if(Auth::user()->role=='A')
              <li><a class="nav-link " href="{{route('myjobshistory')}}">My Jobs</a></li>
            @endif
          @endauth
          <li><a class="nav-link" href="{{route('cvawal')}}">CV</a></li>
          <!--
          <li><a class="nav-link scrollto" href="#team">Login</a></li>
          -->
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          @guest
          <li><a class="getstarted scrollto" href="{{route('loginView')}}">Get Started</a></li>
          @else
          <li class="dropdown">
            <button class="getstarted dropdown-toggle btn" type="button" id="dropdownButton" data-bs-toggle="dropdown" aria-expanded="false">
              Hi, {{Auth::user()->name}}</button>
            <ul class="dropdown-menu" aria-labelledby="dropdownButton">
                @if(Auth::user()->role=='A')
                <a href="{{route('profileapplicant',['id'=>Auth::user()->id])}}"  class="dropdown-item"><i class="bi bi-person-fill mr-2"></i>My{{route('profileapplicant',['id'=>Auth::user()->id])}} Profile</a>
                @elseif(Auth::user()->role=='B')
								<a href="{{route('view.company.dashboard')}}"  class="dropdown-item"><i class="bi bi-building-fill-check mr-2"></i>Company Page</a>
                @endif
                <a class="dropdown-item "  href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" ><i class="bi bi-box-arrow-right"></i>{{ __('Logout') }}</a>
                <form action="{{ route('logout') }}" method="POST" id="logout-form" class="d-none">@csrf</form>
						</ul>


          </li>
          @endguest
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
    </header><!-- End Header -->

        @yield('content')


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

      {{-- Jquery --}}
        <script src="{{asset('js/jquery-3.6.3.min.js')}}"></script>

      <!-- Vendor JS Files -->
      <script src="{{asset('assets/vendor/aos/aos.js')}}"></script>
      <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
      <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
      <script src="{{asset('assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
      <script src="{{asset('assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
      <script src="{{asset('assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
      <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>
      <!-- Template Main JS File -->
      <script src="{{asset('assets/js/main.js')}}"></script>


    @yield('layout_script')
</body>

</html>

