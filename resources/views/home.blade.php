<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->
@extends('layouts.head')
  </head>
  <body dir="rtl">
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
</html>