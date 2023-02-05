
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $general->sitename(__($pageTitle)) }}</title>
  @include('partials.seo')
  <link rel="icon" type="image/png" href="{{getImage(imagePath()['logoIcon']['path'] .'/favicon.png')}}" sizes="16x16">
  <link rel="stylesheet" href="{{asset($activeTemplateTrue.'frontend/css/lib/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset($activeTemplateTrue.'frontend/css/all.min.css')}}"> 
  <link rel="stylesheet" href="{{asset($activeTemplateTrue.'frontend/css/line-awesome.min.css')}}"> 
  <link rel="stylesheet" href="{{asset($activeTemplateTrue.'frontend/css/lightcase.css')}}"> 
  <link rel="stylesheet" href="{{asset($activeTemplateTrue.'frontend/css/lib/slick.css')}}">
  <link rel="stylesheet" href="{{asset($activeTemplateTrue.'frontend/css/main.css')}}">
  <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/custom.css')}}">
  @stack('style-lib')
  @stack('style')
  <link href="{{ asset($activeTemplateTrue . 'frontend/css/color.php') }}?color={{$general->base_color}}&secondColor={{$general->secondary_color}}" rel="stylesheet"/>
</head>
    <body> 
        @stack('fbComment')
        <div class="scroll-to-top">
            <span class="scroll-icon">
                <i class="las la-arrow-up"></i>
            </span> 
        </div> 
       <div class="preloader-holder">
              <div class="preloader">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
              </div>
        </div>
        @include($activeTemplate . 'partials.header')
        <div class="main-wrapper">
            @yield('content')
        </div>
        @include($activeTemplate . 'partials.footer')
        <script src="{{asset($activeTemplateTrue.'frontend/js/lib/jquery-3.6.0.min.js')}}"></script>
        <script src="{{asset($activeTemplateTrue.'frontend/js/lib/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset($activeTemplateTrue.'frontend/js/lib/slick.min.js')}}"></script>
        <script src="{{asset($activeTemplateTrue.'frontend/js/lib/wow.min.js')}}"></script>
        <script src="{{asset($activeTemplateTrue.'frontend/js/lib/lightcase.js')}}"></script>
        <script src="{{asset($activeTemplateTrue.'frontend/js/app.js')}}"></script>
        @stack('script-lib')
        @stack('script')
        @include('partials.plugins')
        @include('partials.notify')
        <script>
            (function ($) {
                "use strict";
                $(".langSel").on("change", function() {
                    window.location.href = "{{route('home')}}/change/"+$(this).val() ;
                });
            })(jQuery);
        </script>
    </body>
</html> 
