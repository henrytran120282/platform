<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ITLSVN | Administrator</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{URL::to('/')}}/assets/fontawesome/css/font-awesome.min.css">
    {{--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">--}}

    <!-- Styles -->
    <link rel="stylesheet" href="{{URL::to('/')}}/assets/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/assets/sweetalert/sweetalert.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/assets/css/dashboard.css">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    @yield('style-top')
    @stack('style-top')
    <style>
        body {
            font-family: 'arial';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-blue navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Help</a></li>
          </ul>
        </div>
      </div>
    </nav>    
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
              <ul class="nav nav-sidebar">
                <li {{ Admin::requestIs('contentManager/index') ? ' class=active' : '' }}><a href="{{ Admin::route('contentManager.index') }}"><i class="fa fa-tachometer"></i> {{ trans('default.dashboard') }} <span class="sr-only">(current)</span></a></li>
                <li {{ Admin::requestIs('contentManager/post*')  ? ' class=active' : '' }}><a href="{{ Admin::route('contentManager.post.index') }}"><i class="fa fa-file"></i> {{ trans('default.post') }} </a></li>
                <li {{ Admin::requestIs('contentManager/category*')  ? ' class=active' : '' }}><a href="{{ Admin::route('contentManager.category.index') }}"><i class="fa fa-folder"></i> {{ trans('default.category') }}</a></li>
                <li {{ Admin::requestIs('contentManager/tag*')  ? ' class=active' : '' }}><a href="{{ Admin::route('contentManager.tag.index') }}"><i class="fa fa-tags"></i> {{ trans('default.tag') }}</a></li>
                <li {{ Admin::requestIs('contentManager/page*')  ? ' class=active' : '' }}><a href="{{ Admin::route('contentManager.page.index') }}"><i class="fa fa-file-text-o"></i> {{ trans('default.page') }}</a></li>
                <li {{ Admin::requestIs('contentManager/menu')  ? ' class=active' : '' }}><a href="{{ Admin::route('contentManager.menu.index') }}"><i class="fa fa-bars"></i> {{ trans('default.menu') }}</a></li>
                <li {{ Admin::requestIs('contentManager/theme')  ? ' class=active' : '' }}><a href="{{ Admin::route('contentManager.menu.index') }}"><i class="fa fa-bars"></i> {{ trans('default.theme') }}</a></li>
                <li {{ Admin::requestIs('contentManager/widget')  ? ' class=active' : '' }}><a href="{{ Admin::route('contentManager.menu.index') }}"><i class="fa fa-bars"></i> {{ trans('default.widget') }}</a></li>
                <li {{ Admin::requestIs('admin/generations')  ? ' class=active' : '' }}><a href="{!! route('admin.generations.index') !!}"><i class="fa fa-edit"></i><span>Generations</span></a></li>
              </ul>
              <ul class="nav nav-sidebar">
                <li><a href="">Nav item again</a></li>
                <li><a href="{{ url('/logout') }}"><i class="fa fa-user"></i> Logout</a></li>
              </ul>
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                @yield('content')
            </div>
        </div>
    </div>

   

    <!-- JavaScripts -->
    <script src="{{URL::to('/')}}/assets/jquery/dist/jquery.min.js"></script>
    <script src="{{URL::to('/')}}/assets/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="{{URL::to('/')}}/assets/sweetalert/sweetalert.min.js"></script>
    <script src="{{URL::to('/')}}/assets/js/dashboard.js"></script>
    @yield('scripts')
    @stack('scripts')
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
