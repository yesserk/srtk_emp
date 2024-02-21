<nav class="sidebar sidebar-offcanvas" id="sidebar" style="z-index:999999 !important;margin-top:-3%;">
          <ul class="nav"  >
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="/auth/images/user.png" alt="profile">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2"> {{ Auth::user()->name }}</span>
                </div>
                <i class=" syr mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link link_syr" href="{{ route('home') }}">

                <span class="menu-title">الرئيسية</span>
                <i class=" syr mdi mdi-home menu-icon"></i>

              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link link_syr" href="{{ route('users') }}">
                <span class="menu-title">مستخدمين</span>
                <i class=" syr mdi mdi-account-plus menu-icon"></i>

              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link link_syr" href="{{ route('employees') }}">
                <span class="menu-title">موظفين</span>
                <i class=" syr mdi mdi mdi-account-multiple menu-icon"></i>

              </a>
            </li>
          
            <li class="nav-item">
              <a class="nav-link link_syr" href="{{ route('type_employees') }}">
                <span class="menu-title">الوظائف</span>
                <i class=" syr mdi mdi mdi-minus-network menu-icon"></i>

              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link link_syr" href="{{ route('etat_employees') }}">
                <span class="menu-title">الحالات</span>
                <i class=" syr mdi mdi mdi-account-convert menu-icon"></i>

              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link link_syr" href="{{ route('etat') }}">
                <span class="menu-title">حالة الموظف</span>
                <i class=" syr mdi mdi mdi-account-convert menu-icon"></i>

              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link link_syr" href="{{ route('gare') }}">
                <span class="menu-title">النيابة</span>
                <i class=" syr mdi mdi-desktop-tower menu-icon"></i>

              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link link_syr" href="{{ route('bus') }}">
                <span class="menu-title">حافلات</span>
                <i class=" syr mdi mdi mdi mdi-bus menu-icon"></i>

              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link link_syr" href="{{ route('ligne') }}">
                <span class="menu-title">الخطوط</span>
                <i class=" syr mdi mdi mdi mdi-road menu-icon"></i>

              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link link_syr" href="{{ route('station') }}">
                <span class="menu-title">المحطات</span>
                <i class=" syr mdi mdi-glass-stange menu-icon"></i>

              </a>
            </li>

           <!-- <li class="nav-item">
              <a class="nav-link link_syr" href="{{ route('ticket') }}">
                <span class="menu-title">التذاكر</span>
                <i class=" syr mdi mdi mdi-ticket menu-icon"></i>

              </a>
            </li>-->


            <li class="nav-item">
              <a class="nav-link link_syr" href="{{ route('voyage') }}">
                <span class="menu-title">الرحلات</span>
                <i class=" syr mdi mdi-road-variant menu-icon"></i>

              </a>
            </li>
       <!--     <li class="nav-item">
              <a class="nav-link link_syr" href="{{ route('reservation') }}">
                <span class="menu-title">حجز الحافلات</span>
                <i class=" syr mdi mdi-ticket-account menu-icon"></i>

              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link link_syr" href="{{ route('resume') }}">
                <span class="menu-title">حوصلة النشاط اليومي </span>
                <i class="mdi mdi-file-document-box menu-icon"></i>

              </a>
            </li>-->
          </ul>
        </nav>
        <style>
          .syr{margin-left:0px !important;
         } 
          .menu-title{
width:160px;
          }
        </style>