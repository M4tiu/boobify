<!doctype html>
<html lang="en">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Dashboard - Boobify</title>
   <!-- Favicon -->
   <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" />
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
   <!-- Typography CSS -->
   <link rel="stylesheet" href="{{ asset('css/typography.css') }}">
   <!-- Style CSS -->
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
   <!-- Responsive CSS -->
   <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
</head>

<body class="dark">
   <!-- loader Start -->
   <div id="loading">
      <div id="loading-center">
      </div>
   </div>
   <!-- loader END -->
   <!-- Wrapper Start -->
   <div class="wrapper">
      <!-- Sidebar  -->
      <div class="iq-sidebar">
         <div class="iq-sidebar-logo d-flex justify-content-between">
            <a href="{{ route('adminPanel', 'orders') }}">
               <h1 class="display-4">Boobify</h1>
            </a>
            <div class="iq-menu-bt-sidebar d-block d-md-none">
               <div class="iq-menu-bt align-self-center">
                  <div class="wrapper-menu">
                  <div class="main-circle"><i class="ri-arrow-left-s-line"></i></div>
                  <div class="hover-circle"><i class="ri-arrow-right-s-line"></i></div>
               </div>
               </div>
            </div>
         </div>
         <div id="sidebar-scrollbar">
            <nav class="iq-sidebar-menu">
               <ul id="iq-sidebar-toggle" class="iq-menu">
                  {{-- <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>Dashboard</span></li> --}}
                  <li>
                     <a href="{{ route('adminPanel', 'orders') }}" class="iq-waves-effect"><i class="ion-archive"></i><span>Orders</span></a>
                  </li>
                  <li>
                     <a href="{{ route('adminPanel', 'users') }}" class="iq-waves-effect"><i class="fa fa-user-circle"></i><span>All users</span></a>
                  </li>
                  <li>
                     <a href="{{ route('dashboard', 'chat') }}" class="iq-waves-effect"><i class="ri-message-line"></i><span>Chat</span></a>
                  </li>
                  <li>
                     <a href="{{ route('adminPanel', 'withdrawals') }}" class="iq-waves-effect"><i class="fa fa-money"></i><span>Withdrawal requests</span></a>
                  </li>
               </ul>
            </nav>
            <div class="p-3"></div>
         </div>
      </div>
      <!-- TOP Nav Bar -->
      <div class="iq-top-navbar">
         <div class="iq-navbar-custom">
            <div class="iq-sidebar-logo">
               <div class="top-logo">
                  <a href="index.html" class="logo">
                     <div class="iq-light-logo">
                        <img src="images/logo.gif" class="img-fluid" alt="">
                     </div>
                     <div class="iq-dark-logo">
                        <img src="images/logo-dark.gif" class="img-fluid" alt="">
                     </div>
                     <span>vito</span>
                  </a>
               </div>
            </div>
            <nav class="navbar navbar-expand-lg navbar-light p-0">
               <div class="navbar-left">
                  
               </div>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                  aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
                  <i class="ri-menu-3-line"></i>
               </button>
               <div class="iq-menu-bt align-self-center">
                  <div class="wrapper-menu">
                     <div class="main-circle"><i class="ri-arrow-left-s-line"></i></div>
                     <div class="hover-circle"><i class="ri-arrow-right-s-line"></i></div>
                  </div>
               </div>
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav ml-auto navbar-list">

                     
                  </ul>
               </div>
               <ul class="navbar-list">
                  <li>
                     <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center bg-primary rounded">
                        {{-- <img src="images/user/1.jpg" class="img-fluid rounded mr-3" alt="user"> --}}
                        <div class="caption">
                           <h6 class="mb-0 line-height text-white">{{ Auth::user()->name }}</h6>
                           <span class="font-size-12 text-white">Online</span>
                        </div>
                     </a>
                     <div class="iq-sub-dropdown iq-user-dropdown">
                        <div class="iq-card shadow-none m-0">
                           <div class="iq-card-body p-0 ">
                              <div class="bg-primary p-3">
                                 <h5 class="mb-0 text-white line-height">Hello {{ Auth::user()->name }}</h5>
                                 <span class="text-white font-size-12">Online</span>
                              </div>
                              <div class="d-inline-block w-100 text-center p-3">
                                 <a class="btn btn-primary dark-btn-primary" onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();" href="{{ route('logout') }}" role="button">Log
                                    out<i class="ri-login-box-line ml-2"></i></a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                       @csrf
                                   </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </li>
               </ul>
            </nav>


         </div>
      </div>
      <!-- TOP Nav Bar END -->
      <!-- Page Content  -->
      <div id="content-page" class="content-page">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-12">
                  @yield('content')
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Wrapper END -->
   <!-- Footer -->
   <footer class="iq-footer">
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-6">
               <ul class="list-inline mb-0">
                  <li class="list-inline-item"><a href="privacy-policy.html">Privacy Policy</a></li>
                  <li class="list-inline-item"><a href="terms-of-service.html">Terms of Use</a></li>
               </ul>
            </div>
            <div class="col-lg-6 text-right">
               Copyright 2020 <a href="#">Vito</a> All Rights Reserved.
            </div>
         </div>
      </div>
   </footer>
   <nav class="iq-float-menu">
      <input type="checkbox" href="#" class="iq-float-menu-open" name="menu-open" id="menu-open" />
      <label class="iq-float-menu-open-button" for="menu-open">
         <span class="lines line-1"></span>
         <span class="lines line-2"></span>
         <span class="lines line-3"></span>
      </label>
      <button class="iq-float-menu-item bg-info" data-toggle="tooltip" data-placement="top" title="Direction Mode"
         data-mode="rtl"><i class="ri-text-direction-r"></i></button>
      <button class="iq-float-menu-item bg-danger" data-toggle="tooltip" data-placement="top" title="Color Mode"
         id="dark-mode" data-active="true"><i class="ri-sun-line"></i></button>
      <button class="iq-float-menu-item bg-warning" data-toggle="tooltip" data-placement="top" title="Comming Soon"><i
            class="ri-palette-line"></i></button>
   </nav>
   <!-- Footer END -->
   <!-- Optional JavaScript -->
   <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="{{ asset('js/jquery.min.js') }}"></script>
   <!-- Rtl and Darkmode -->
   <script src="{{ asset('js/rtl.js') }}"></script>
   <script src="{{ asset('js/customizer.js') }}"></script>
   <script src="{{ asset('js/popper.min.js') }}"></script>
   <script src="{{ asset('js/bootstrap.min.js') }}"></script>
   <!-- Appear JavaScript -->
   <script src="{{ asset('js/jquery.appear.js') }}"></script>
   <!-- Countdown JavaScript -->
   <script src="{{ asset('js/countdown.min.js') }}"></script>
   <!-- Counterup JavaScript -->
   <script src="{{ asset('js/waypoints.min.js') }}"></script>
   <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
   <!-- Wow JavaScript -->
   <script src="{{ asset('js/wow.min.js') }}"></script>
   <!-- Apexcharts JavaScript -->
   <script src="{{ asset('js/apexcharts.js') }}"></script>
   <!-- Slick JavaScript -->
   <script src="{{ asset('js/slick.min.js') }}"></script>
   <!-- Select2 JavaScript -->
   <script src="{{ asset('js/select2.min.js') }}"></script>
   <!-- Owl Carousel JavaScript -->
   <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
   <!-- Magnific Popup JavaScript -->
   <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
   <!-- Smooth Scrollbar JavaScript -->
   <script src="{{ asset('js/smooth-scrollbar.js') }}"></script>
   <!-- lottie JavaScript -->
   <script src="{{ asset('js/lottie.js') }}"></script>
   <!-- core JavaScript -->
   <script src="{{ asset('js/core.js') }}"></script>
   <!-- charts JavaScript -->
   <script src="{{ asset('js/charts.js') }}"></script>
   <!-- animated JavaScript -->
   <script src="{{ asset('js/animated.js') }}"></script>
   <!-- Chart Custom JavaScript -->
   <script src="{{ asset('js/chart-custom.js') }}"></script>
   <!-- Custom JavaScript -->
   <script src="{{ asset('js/custom.js') }}"></script>

</body>

</html>