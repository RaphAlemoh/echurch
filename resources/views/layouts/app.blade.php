<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
    <meta content="text/javascript" http-equiv="Content-Script-Type" />
    <meta content="text/css" http-equiv="Content-Style-Type" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="keywords" content="design, fashion, outfits, fashion in Nigeria, cool fashion designs, male outfit, agabda, kafatn, suit" />
    <meta name="description" content="Pettacouture is the best place to get your outfit in Nigeria" />  
    <link rel="shortcut icon" href="logo.png">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

        <!-- Fonts -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" rel="stylesheet">
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">    
        @yield('customstyle')

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and
media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via
file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/
html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.
min.js"></script>
<![endif]-->
</head>
<body class="">
<div id="app">
    
    @include('partials.__navbar')

    @yield('content')

    <div class="footer-section">
        @yield('footer') 
    </div>
</div>
<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.2.2/lazysizes.min.js" async></script>
<script src="{{ asset('js/app.js') }}"></script>
<script>
$(document).ready(function(){

    $(document).on('click', '.open-overlay-search', function(){
        $('.search-overlay').css('display', 'block');
        let clone_search_form = $('#search').clone(true);
        $('.search-overlay-content').append(clone_search_form).fadeIn("fast");
        $('.search-overlay-content').find('.form-inline').attr('class', 'form-inline d-lg-none');
    });
    
    $(document).on('click', '.close-overlay-search', function(){
        $('.search-overlay-content').html('');
        $('.search-overlay').css('display', 'none');

    });

    $('.keyword_search').keyup(function(){
    var query = $(this).val();
    if(query != '' && query.length > 1)
    {
        $.ajax({
            url:"{{ url('search') }}",
            method:"GET",
            data:{query:query},
            success:function(data){
                $('#search_result').fadeIn();
                $('#search_result').html(data);
            }
        })
    }else{
        $('#search_result').fadeOut();
    }   
    })


$(document).on('click', '#search-li', function(){
    $('#keyword_search').val($(this).text());
    $('#search_result').fadeIn();
})

// $(document).on('click', '.categories', function(){
//     $.ajax({
//         type: "GET",
//         url: "/show/categories",
//         data: null,
//         success:function(data){
//             $('#append-categories').html(data).fadeIn("fast");
//         }
//     });
// });

})

$("[data-trigger]").on("click", function(){
    var trigger_id =  $(this).attr('data-trigger');
    $(trigger_id).toggleClass("show");
    $('body').toggleClass("offcanvas-active");
});

$(".btn-close").click(function(e){
    e.preventDefault();
    $(".navbar-collapse").removeClass("show");
    $("body").removeClass("offcanvas-active");
}); 

</script>
@yield('scripts')
</body>
</html>