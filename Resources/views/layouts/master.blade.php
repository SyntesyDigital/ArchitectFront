<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="{{App::getLocale()}}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=11" />
        <meta http-equiv="Content-Language" content="{{App::getLocale()}}"/>

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{!! $htmlTitle or env('APP_NAME') !!}</title>
        <meta name="description" content="{!! $metaDescription or '' !!}">
        <meta property="og:url" content="{{ Request::url() }}" />
        <meta property="og:title" content="{!! $htmlTitle or '' !!}"/>
        <meta property="og:description" content="{!! $socialDescription or '' !!}"/>
        <meta property="og:image" content="{!! $socialImage or asset('images/header-logo.jpg') !!}"/>
        <meta property="og:type" content="website"/>
        <meta name="robots" content="noindex,nofollow">

        <!-- twitter -->
        <meta name="twitter:card" content="summary_large_image"/>
    		<meta name="twitter:site" content="{{ Request::url() }}"/>
    		<meta name="twitter:title" content="{!! $htmlTitle or 'Front Interim' !!}"/>
    		<meta name="twitter:description" content="{!! $metaDescription or '' !!}"/>


        <link href="{{asset('modules/front/css/app.css')}}" rel="stylesheet" type="text/css" />
        <!--<link rel="stylesheet" media="all" href="{{ asset('modules/front/css/font-awesome/css/font-awesome.min.css')}}" />-->
        <link rel="stylesheet" media="all" href="{{ asset('modules/front/fonts/iconmoon/iconmoon.css')}}" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

        @stack('styles')

    </head>

    <body class="{{$mainClass or ''}}">


        @include ('front::partials.header')

        @yield('content')

        <!-- Footer blade important to add JavasCript variables from Controller -->
        @include ('front::partials.footer')
        <script>
          const WEBROOT = '{{route("home")}}';
          const ASSETS = '{{asset('')}}';
          const LOCALE = '{{App::getLocale()}}';
          const app = {};
          var csrf_token = "{{csrf_token()}}";
        </script>
        <script type="text/javascript" src="{{route('localization.js', App::getLocale())}}" ></script>

        <!-- Select2 -->

        <script src="{{asset('modules/architect/plugins/dropzone/dropzone.min.js')}}"></script>
        @stack('javascripts-libs')

        <script type="text/javascript" src="{{asset('modules/front/js/app.js')}}" ></script>
        <script src="{{asset('modules/front/js/jquery.imageUploader.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

        @stack('javascripts')
    </body>
</html>
