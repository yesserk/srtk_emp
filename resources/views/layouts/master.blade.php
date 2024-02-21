
@extends('layouts.head')
  </head>
  <style>
#preloader {
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100%;
  width: 100%;
  position: fixed;
  z-index: 9999999;
  background: #fff;
}

#preloader img {
  width: 80px; /* Adjust the size of the loader image */
  height: auto;
}

</style>
  <body dir="rtl">

  <div id="preloader">
      <img src="{{ asset('assets/images/loading.gif') }}" alt="Loading...">
    </div>
     
    <div class="container-scroller">
     
      <!-- partial:partials/_navbar.html -->
    @include('layouts.main_headerbar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        @include('layouts.main_sidebar')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> @yield('title')
              </h3>
        
            </div>
          
         @yield('content')
           
           
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
       @include('layouts.footer')
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- Scripts -->
    @include('layouts.footer_scripts')

  </body>
  

  <script>
    var loader = document.getElementById("preloader");
    window.addEventListener("load", function(){
      loader.style.display = "none";  // Corrected variable name
    });
  </script>

</html>