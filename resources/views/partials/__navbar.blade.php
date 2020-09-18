<nav class="navbar navbar-expand-md sticky-top shadow-sm mb-0 bg-faded" role="navigation">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" 
        data-trigger="#main_nav" data-toggle="collapse"  aria-controls="main_nav" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand mb-0 d-none d-lg-block" href="{{ url('/') }}">
        <img src="{{ URL::to('images/nav-brand.jpg' ) }}" alt="eChurch Logo" width="30" height="30" 
        title="eChurch Logo" class="img-fluid mt-0 mb-0 d-inline-block align-top">
    </a>
    
    <ul class="nav navbar-nav d-lg-none ml-auto visible-xs navbar-icons d-flex flex-row">  
        <a class="navbar-brand mb-0 d-lg-none" href="{{ url('/') }}">
            <img src="{{ URL::to('images/nav-brand.jpg' ) }}" alt="eChurch Logo" width="30" height="30" 
            title="eChurch Logo" class="img-fluid mt-0 mb-0 d-inline-block align-top">
        </a>
    </ul>
    
    <ul class="nav navbar-nav d-lg-none visible-xs ml-auto navbar-icons d-flex flex-row">    
        <li class="nav-item"><a class="nav-link"><i class="fa fa-search fa-lg open-overlay-search"></i></a></li>
        <div id="myOverlay" class="search-overlay">
            <span class="closebtn close-overlay-search" title="Close Overlay">×</span>
            <div class="search-overlay-content">
            </div>
          </div>
    </ul>
    
<div class="collapse navbar-collapse justify-content-between align-items-center w-100" id="main_nav">
        <div class="offcanvas-header mt-3">  
            <button class="btn btn-outline-danger btn-close pull-right btn-style"> &times Close </button>
            <h5 class="py-2 text-white"><a class="nav-link m-0 p-0" href="{{ url('/') }}">
                <img src="{{ URL::to('images/nav-brand.jpg' ) }}" alt="eChurch Logo" width="30" height="30" 
                    title="eChurch Logo" class="img-fluid mt-0 mb-0 d-inline-block align-top">
                eChurch</a></h5>
          </div>
    

<ul id="search" class="navbar-nav abs-center-x">
    <form class="form-inline d-none d-lg-block" action="{{ url('search') }}" method="GET"> 
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text btn-style" id="basic-addon1"><i class="fa fa-search fa-lg"></i></span>
                </div>                        
                <input type="text" name="keyword" id="keyword-search" 
                class="form-control py-4 keyword_search" placeholder="Search................"
                aria-label="keyword-search" aria-describedby="basic-addon1">
                <div id="search_result" class="dropdown-menu search_result_dropdown"></div>                        
            </div>
    </form>    
</ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('media') }}">
                    Media
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('blog') }}">
                    Blog
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('tv') }}">
                    TV
            </a>
        </li>
        @guest
        @if (Route::has('register'))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
        @endif
        <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @else
        <li class="nav-item bell-dropdown dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <span class="fa fa-bell fa-lg">
                        {{-- @if (auth()->user()->unReadNotifications->count() > 0) --}}
                        {{-- <sup class="text-success bg-white border-0 rounded" style="margin-left:-9px; padding:3px;"></sup> --}}
                        {{-- @endif --}}
                </span>
                </a>    
            <div class="dropdown-menu">
                {{-- @if (auth()->user()->notifications->count() == 0)
                <a class="dropdown-item">No Notification(s)</a>
                @endif
                @php
                    $k = 0;
                @endphp
                @foreach (auth()->user()->unReadNotifications as $notification)
                @php
                    $k++;
                @endphp
                <a href="{{ url('view/notification/order/'.$notification->id ) }}" class="dropdown-item text-primary">{{ __('#'.$k . ' View Order status') }}</a>
                @endforeach --}}
            </div>
        </li>
    
    <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>
    
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('home') }}"> {{ __('Profile') }}</a>
                @if (Auth::user()->hasRole('admin'))
                <a class="dropdown-item" href="{{ route('admin.dashboard') }}"> {{ __('Admin Dashboard') }}</a>
                @endif
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
    
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>