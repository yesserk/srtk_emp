<style>
    .dropdown-item:hover {
      color:black !important
}
.nav-logout{
 margin-right: 80% !important
}
</style>

<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
         
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
        
          <ul class="navbar-nav navbar-nav-left" style="margin-right:75% !important">
            <li class="nav-item nav-profile dropdown header-top nav-logout">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                  <img src="/auth/images/user.png" alt="image">
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black">{{ Auth::user()->name }}</p>
                </div>
              </a>
  

<div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="mdi mdi-logout me-2 text-primary"></i> خروج 
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>
            </li>
          
           
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>


      </nav>

      
 