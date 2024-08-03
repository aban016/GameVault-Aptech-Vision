<!DOCTYPE html>
<html lang="en">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <title>@yield('title') - Play Hub - Join now and play mighty games!</title>
    <meta content="Templines" name="author">
    <meta content="TeamHost" name="description">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="HandheldFriendly" content="true">
    <meta name="format-detection" content="telephone=no">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('user/assets/bs/css/bootstrap.min.css') }}">
    <script src="{{ asset('user/assets/bs/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ENd Bootstrap -->
    <link rel="shortcut icon" href="{{ asset('user/assets/img/logo/ph.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('user/assets/css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('user/assets/fonts/simple-line-icons/css/simple-line-icons.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link href="{{ asset('admin/assets/css/style.css?version=2.0') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&amp;display=swap" rel="stylesheet">
    <script src="{{ asset('user/assets/js/libs.js') }}"></script>
    <script src="{{ asset('user/assets/js/main.js') }}"></script>


</head>


<body class="page-community">

    <!-- Loader-->
    <div id="page-preloader">
        <div class="preloader-1">
            <div class="loader-text">Loading</div>
            <span class="line line-1"></span>
            <span class="line line-2"></span>
            <span class="line line-3"></span>
            <span class="line line-4"></span>
            <span class="line line-5"></span>
            <span class="line line-6"></span>
            <span class="line line-7"></span>
            <span class="line line-8"></span>
            <span class="line line-9"></span>
        </div>

    </div>
    <!-- Loader end-->


    <div class="page-wrapper">
        <header class="page-header">
            <div class="page-header__inner">
                <div class="page-header__sidebar">

                    <div class="page-header__menu-btn">

                        <button class="menu-mobile-button visible-xs-block js-toggle-mobile-slidebar toggle-menu-button menu-btn">
                            <span class="toggle-menu-button-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </button>
                    </div>
                    <div class="page-header__logo"><img src="{{ asset('user/assets/img/logo/playhub.png') }}" alt="logo"></div>
                </div>
                <div class="page-header__content">
                    <div class="page-header__search">
                    </div>

                    <div class="page-header__action">

                        <ul class="uk-subnav uk-subnav-pill" uk-margin>

                            @if (Route::has('login'))
                            <li>
                                @auth
                                <a href="#">
                                    @php
                                    $profilePic = Auth::user()->profile_pic;
                                    $profilePicUrl = '';

                                    if ($profilePic) {
                                    if (Str::startsWith($profilePic, 'data:image')) {
                                    // Base64 encoded image
                                    $profilePicUrl = $profilePic;
                                    } elseif (filter_var($profilePic, FILTER_VALIDATE_URL)) {
                                    // URL (from Google OAuth)
                                    $profilePicUrl = $profilePic;
                                    } else {
                                    // Local storage path
                                    $profilePicUrl = asset('storage/' . $profilePic);
                                    }
                                    } else {
                                    // Default profile picture
                                    $profilePicUrl = asset('user/assets/img/profile.png');
                                    }
                                    @endphp

                                    <img src="{{ $profilePicUrl }}" alt="profile" class="profile">

                                    Hi, {{ Auth::user()->name }}
                                    <span uk-icon="icon: triangle-down"></span>
                                </a>
                                <div uk-dropdown="mode: click">
                                    <ul class="uk-nav uk-dropdown-nav">
                                        <!-- Authentication -->
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                                @csrf
                                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                                    {{ __('Log Out') }}
                                                </a>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                                @else
                                <a href="{{ route('login') }}" class="fw-bold" style="font-size: medium;">
                                   <img src="{{ asset('user/assets/img/svgico/profile-user.png') }}" style="width: 24px;" alt="user"> Sign in
                                </a>
                                @endauth
                            </li>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <div class="page-content">
            <aside class="sidebar" id="sidebar">

                <div class="sidebar-hider">
                    <i class="icon-arrow-left"></i>
                    <i class="icon-arrow-right"></i>
                </div>

                <div class="sidebar-box">
                    <ul class="uk-nav">
                        <li class="{{ request()->routeIs('/') ? 'uk-active' : '' }}"><a href="{{ route('/') }}"><i class="ico_home"></i><span>Home</span></a></li>
                        @auth
                        <li class="uk-nav-header"><i class="uk-nav-devider"></i><span>Account</span></li>
                        <li class="{{ request()->routeIs('user.profile') ? 'uk-active' : '' }}"><a href="{{ route('user.profile') }}"><i class="ico_profile"></i><span>{{ __('Profile') }}</span></a></li>
                        <li class="{{ request()->routeIs('user.favourite') ? 'uk-active' : '' }}"><a href="{{ route('user.favourite') }}"><i class="ico_favourites"></i><span class="uk-nav-text">Favourites</span></a></li>
                        <li class="{{ request()->routeIs('user.wallet') ? 'uk-active' : '' }}"><a href="{{ route('user.wallet') }}"><i class="ico_wallet"></i><span>Wallet</span></a></li>
                        @endauth

                        <li class="uk-nav-header"><i class="uk-nav-devider"></i><span>Store</span></li>
                        <li class="{{ request()->routeIs('freeGames') ? 'uk-active' : '' }}"><a href="{{ route('freeGames') }}"><i class="ico_store"></i><span>Free Games</span></a></li>
                        <li class="{{ request()->routeIs('premiumGames') ? 'uk-active' : '' }}"><a href="{{ route('premiumGames') }}"><i class="ico_market"></i><span>Premium Games</span></a></li>

                        <li class="uk-nav-header"><i class="uk-nav-devider"></i><span>Others</span></li>
                        <li class="{{ request()->routeIs('gameplays') ? 'uk-active' : '' }}"><a href="{{ route('gameplays') }}"><i class="ico_streams"></i><span>GamePlays</span></a></li>
                                    
                        <li class="uk-nav-header"><i class="uk-nav-devider"></i><span>Support</span></li>
                            <li><a href="#modal-report" data-uk-toggle><i class="ico_report"></i><span>Report</span></a></li>
                    </ul>
                </div>
            </aside>


            <main class="page-main">
                @yield('content')
            </main>




        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('admin/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    
    @stack('scripts')

</body>


</html>