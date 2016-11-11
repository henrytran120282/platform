<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{Helper::appTitle($appTitle)}}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{URL::to('/')}}/assets/fontawesome/css/font-awesome.min.css">
    {{--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">--}}

    <!-- Styles -->
    <link rel="stylesheet" href="{{URL::to('/')}}/assets/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{URL::to('/themes/smallpine')}}/css/style.css">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('style-top')
    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout" class="home blog custom-background hfeed CStyle8 HStyle1 boxed">
    <div id="page" class="site">
    <header id="sr-header">
        <div class="topbar fixed">
            <div class="container">
                <div class="pull-left">
                    <nav class="nav-wrapper">
                        <div class="mobile-menu">
                            <a class="togole-mainmenu" href="javascript:void(0)"><i class="fa fa-bars"></i></a>
                        </div>
                        <ul id="menu-main-menu" class="sr-mainmenu">
                            {!!html_entity_decode(Theme::menu("menu-top"))!!}
                        </ul>
                    </nav>
                </div>
                <div class="pull-right">
                    <div class="social">
                        <a href="{{((Theme::option('social_media','facebook') != "")?Theme::option('social_media','facebook'):'#')}}" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a href="{{((Theme::option('social_media','twitter') != "")?Theme::option('social_media','twitter'):'#')}}" target="_blank"><i class="fa fa-twitter"></i></a>
                        <a href="{{((Theme::option('social_media','instagram') != "")?Theme::option('social_media','instagram'):'#')}}" target="_blank"><i class="fa fa-instagram"></i></a>
                        <a href="{{((Theme::option('social_media','youtube') != "")?Theme::option('social_media','youtube'):'#')}}" target="_blank"><i class="fa fa-youtube-play"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="logo-ads">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="site-branding">
                            <h1 class="site-logo">
                                <a href="{{ url('/') }}">
                                    @if(Theme::option('general','logo') != "")
                                        <img src="{{Theme::option('general','logo')}}" alt="qsoftvietnam" width="300">
                                    @else
                                        {{ Helper::option("site_title") }}
                                        <p class="site-description">{{ Helper::option("site_tagline") }}</p>
                                    @endif
                                </a>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div id="content" class="site-content">
        <div class="container">
