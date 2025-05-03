<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    @if(empty($seo))
    <title> {{ $general->sitename}} - {{__(@$page_title)}} </title>
    <link rel="shortcut icon" href="{{getImage(imagePath()['logoIcon']['path'] .'/favicon.png')}}" type="image/x-icon">
    @endif
    @include('partials.seo')
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{asset($activeTemplateTrue . 'css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue . 'css/home.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue . 'css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue . 'css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue . 'css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue . 'css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue . 'css/aos.css')}}">
     @stack('style-lib')
    @stack('css')
    <link rel="stylesheet" href='{{ asset($activeTemplateTrue."css/color.php?color=".$general->base_color.'&secondColor='.$general->secondary_color)}}'>
    @stack('style')
  </head>
  <body>
    <div class="preloader">
        <div class="loader">
            <span class="loader-block"></span>
            <span class="loader-block"></span>
            <span class="loader-block"></span>
            <span class="loader-block"></span>
            <span class="loader-block"></span>
            <span class="loader-block"></span>
            <span class="loader-block"></span>
            <span class="loader-block"></span>
            <span class="loader-block"></span>
        </div>
    </div>
    <div class="overlay"></div>

    @yield('panel')
    <script src="{{asset($activeTemplateTrue . 'js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue . 'js/all.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue . 'js/jquery.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue . 'js/owl.carousel.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue . 'js/aos.js')}}"></script>
    <script src="{{asset($activeTemplateTrue . 'js/app.js')}}"></script>
    @stack('script-lib')
    <script src="{{asset($activeTemplateTrue . 'js/main.js')}}"></script>
    @stack('js')
    @include('partials.notify')
    @include('partials.plugins')
    <script>
      AOS.init();
    </script>
    @stack('js')
  </body>
</html>