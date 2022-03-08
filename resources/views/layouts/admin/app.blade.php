<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<html lang="en" itemscope itemtype="https://">
<meta charset="utf-8">
<meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
<meta content="text/javascript" http-equiv="Content-Script-Type" />
<meta content="text/css" http-equiv="Content-Style-Type" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="{{ asset('logo.png') }}">

    <title>@yield('title')</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" rel="stylesheet">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">


    <link href="{{ asset('css/admin-layout.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    @yield('customstyle')

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="sb-nav-fixed">
<div id="app">
@include('partials.admin.nav')
<div id="layoutSidenav">
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Home</div>
                <a class="nav-link" href="/admin/dashboard"><div class="sb-nav-link-icon"><i class="fa fa-tachometer-alt"></i></div>
                    Dashboard</a>
                <div class="sb-sidenav-menu-heading">Menu</div>
@if (Auth::user()->hasRole('admin'))
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts"
                    ><div class="sb-nav-link-icon"><i class="fa fa-columns"></i></div>
                    Users
                    <div class="sb-sidenav-collapse-arrow"><i class="fa fa-angle-down"></i></div
                ></a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ url('users/') }}">{{ __('Users') }}</a>
                        <a class="nav-link" href="{{ url('users/create') }}">Add User</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                        <div class="sb-nav-link-icon"><i class="fa fa-cart-plus" aria-hidden="true"></i></div>
                    Blog
                        <div class="sb-sidenav-collapse-arrow"><i class="fa fa-angle-down"></i></div
                    ></a>
                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{ url('posts') }}">{{ __('Posts') }}</a>
                        </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseMedia" aria-expanded="false" aria-controls="pagesCollapseError">
                        <div class="sb-nav-link-icon"><i class="fa fa-camera" aria-hidden="true"></i></div>
                    Media
                        <div class="sb-sidenav-collapse-arrow"><i class="fa fa-angle-down"></i></div
                    ></a>
                    <div class="collapse" id="pagesCollapseMedia" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ url('medias') }}">{{ __('Media') }}</a>
                        </nav>
                    </div>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseTv" aria-expanded="false" aria-controls="pagesCollapseError">
                    <div class="sb-nav-link-icon"><i class="fa fa-television" aria-hidden="true"></i></div>
                TV
                    <div class="sb-sidenav-collapse-arrow"><i class="fa fa-angle-down"></i></div
                ></a>
                <div class="collapse" id="pagesCollapseTv" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{ url('tvs') }}">{{ __('TV') }}</a>
                    </nav>
                </div>


@elseif (Auth::user()->hasRole('admin') || Auth::user()->hasRole('staff') )
<a class="nav-link" href="{{ route('media.index') }}">{{ __('Media') }}</a>
@endif
    </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ Auth::user()->roles[0]['name'] }}
        </div>
    </nav>
</div>
    <div id="layoutSidenav_content">
        <main>
        @yield('content')
        </main>
    @include('partials.admin.footer')
    </div>
    </div>
    </div>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="{{ asset('js/jquery.easing.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.5.1/parsley.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script>

    $(document).ready(function() {
        $('#dataTable').DataTable({
        "bJQueryUI" : true,
        paging: true,
        ordering:  false,
        searching: true,
        scrollY: 400
        });


    $('#current_pwd').keyup(function(){
        let current_pwd = $('#current_pwd').val();
        if(current_pwd.length >= 8){
		$.ajax({
			type:'get',
			url: 'check-pwd',
			data:{current_pwd:current_pwd},
			success:function(resp){
				if(resp == false){
					$('#chkPwd').html("<font color='red'>Current Password is incorrect</font>");
				}else if(resp == true){
                    $('#chkPwd').html("<font color='green'>Current Password is correct</font>");
                    $('.admin-password-update-btn').css('display', 'block');
				}
			}, error:function(){
				alert('Error');
			}
		})
        }else{
            $('.admin-password-update-btn').css('display', 'none');
        }

	})


    });

    </script>
        @yield('scripts')
</body>
</html>
