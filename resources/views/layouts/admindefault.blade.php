<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="msapplication-TileColor" content="#0E0E0E">
  <meta name="template-color" content="#0E0E0E">
  <link rel="manifest" href="manifest.json" crossorigin>
  <meta name="msapplication-config" content="browserconfig.xml">
  <meta name="description" content="Index page">
  <meta name="keywords" content="index, page">
  <meta name="author" content="">
  <link rel="shortcut icon" type="image/x-icon" href="  assets/imgs/template/favicon.svg">
  <link href="assets/css/style.css?version=2.0" rel="stylesheet">
  <title>@yield('title') - Admin - Play Hub</title>
</head>

<body>
  <div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
      <div class="preloader-inner position-relative">
        <div class="text-center"><img src="assets/imgs/template/loading.gif" alt="jobBox"></div>
      </div>
    </div>
  </div>
  <header class="header sticky-bar">
    <div class="container">
      <div class="main-header">
        <div class="header-left">
          <div class="header-logo"><a class="d-flex" href="index.html"><img alt="jobBox" src="assets/imgs/page/dashboard/logo.svg"></a></div><span class="btn btn-grey-small ml-10">Admin area</span>
        </div>
        <div class="header-right">
          <div class="block-signin">
            <div class="member-login"><img alt="" src="assets/imgs/page/dashboard/profile.png">
              <div class="info-member"> <strong class="color-brand-1">{{ Auth::user()->name }}</strong>
                <p class="text-muted">Admin</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <div class="burger-icon burger-icon-white"><span class="burger-icon-top"></span><span class="burger-icon-mid"></span><span class="burger-icon-bottom"></span></div>
  <div class="mobile-header-active mobile-header-wrapper-style perfect-scrollbar">
    <div class="mobile-header-wrapper-inner">
      <div class="mobile-header-content-area">
        <div class="perfect-scroll">
          <div class="mobile-menu-wrap mobile-header-border">
            <!-- mobile menu start-->
            <nav>
              <ul class="main-menu">
                <li> <a class="dashboard2" href="{{route('admin.dashboard')}}"><img src="assets/imgs/page/dashboard/dashboard.svg" alt="jobBox"><span class="name">Dashboard</span></a>
                </li>
                <li> <a class="dashboard2" href="{{route('admin.games')}}"><img src="assets/imgs/page/dashboard/tasks.svg" alt="jobBox"><span class="name">Games List</span></a>
                </li>
                <li> <a class="dashboard2" href="{{route('admin.users')}}"><img src="assets/imgs/page/dashboard/candidates.svg" alt="jobBox"><span class="name">Our Users</span></a>
                </li>
                <div class="border-bottom mb-20 mt-20"></div>
                <li> <a class="dashboard2" href="{{route('admin.profile')}}"><img src="assets/imgs/page/dashboard/profiles.svg" alt="jobBox"><span class="name">My Profiles</span></a>
                </li>
                <li>
                  <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <a class="dashboard2" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                      <img src="assets/imgs/page/dashboard/logout.svg" alt="jobBox">
                      <span class="name">{{ __('Logout') }}</span>
                    </a>
                  </form>
                </li>

              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  <main class="main">
    <div class="nav"><a class="btn btn-expanded"></a>
      <nav class="nav-main-menu">
        <ul class="main-menu">
          <li> <a class="dashboard2 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{route('admin.dashboard')}}"><img src="assets/imgs/page/dashboard/dashboard.svg" alt="jobBox"><span class="name">Dashboard</span></a>
          </li>
          <li> <a class="dashboard2 {{ request()->routeIs('admin.games') ? 'active' : '' }}" href="{{route('admin.games')}}"><img src="assets/imgs/page/dashboard/tasks.svg" alt="jobBox"><span class="name">Games List</span></a>
          </li>
          <li> <a class="dashboard2 {{ request()->routeIs('admin.users') ? 'active' : '' }}" href="{{route('admin.users')}}"><img src="assets/imgs/page/dashboard/candidates.svg" alt="jobBox"><span class="name">Our Users</span></a>
          </li>
          <div class="border-bottom mb-20 mt-20"></div>
          <li> <a class="dashboard2 {{ request()->routeIs('admin.profile') ? 'active' : '' }}" href="{{route('admin.profile')}}"><img src="assets/imgs/page/dashboard/profiles.svg" alt="jobBox"><span class="name">My Profiles</span></a>
          </li>
          <li>
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
              @csrf
              <a class="dashboard2" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                <img src="assets/imgs/page/dashboard/logout.svg" alt="jobBox">
                <span class="name">{{ __('Logout') }}</span>
              </a>
            </form>
          </li>

        </ul>
      </nav>
    </div>
    <div class="box-content">

      @yield('content')

      <footer class="footer mt-20">
        <div class="container">
          <div class="box-footer">
            <div class="row">
              <div class="col-md-6 col-sm-12 mb-25 text-center text-md-start">
                <p class="font-sm color-text-paragraph-2">© 2024 - <a class="color-brand-2" href="#" target="_blank">Play Hub </a>Admin <span> Made by </span><a class="color-brand-2" href="#" target="_blank"> Aban Ali</a></p>
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
  <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
  <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
  <script src="assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
  <script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
  <script src="assets/js/plugins/waypoints.js"></script>
  <script src="assets/js/plugins/magnific-popup.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/select2.min.js"></script>
  <script src="assets/js/plugins/swiper-bundle.min.js"></script>
  <script src="assets/js/plugins/jquery.circliful.js"></script>
  <script src="assets/js/plugins/charts/index.js"></script>
  <script src="assets/js/plugins/charts/xy.js"></script>
  <script src="assets/js/plugins/charts/Animated.js"></script>
  <script src="assets/js/plugins/armcharts5-script.js"></script>
  <script src="assets/js/main.js?v=1.0"></script>
</body>

</html>