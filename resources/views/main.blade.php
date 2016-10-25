<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>@yield('title')</title>
    <!-- CHANGE THIS TITLE FOR EACH PAGE -->
    @yield('stylesheet')
    {!!Html::style('css/styles.css')!!}
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <style type="text/css">
        @font-face {
        font-family: MyAdorshoLipi;
        src: url(fonts/AdorshoLipi.ttf);
        }
        @font-face {
            font-family: MyLato;
            src: url(fonts/Lato-Regular.ttf);
        }
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
  </head>

  <body>

    <!-- Default Bootstrap Navbar -->
    <nav class="navbar navbar-default"> <!--USE IT NEAR FUTURE  navbar-fixed-top-->
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Laravel Blog</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="{{ Request::is('/') ? 'active': '' }}"><a href="/">নীড় পাতা</a></li>
            <li class="{{ Request::is('about') ? 'active': '' }}"><a href="/about">বৃত্তান্ত</a></li>
            <li class="{{ Request::is('contact') ? 'active': '' }}"><a href="/contact">যোগাযোগ</a></li>
            <li class="{{ Request::is('categories/blogs') ? 'active': '' }}"><a href="/categories/blogs">বিষয়ভিত্তিক ব্লগ</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            @if(Auth::check() && Auth::user()->role == 'admin')
            <li class="dropdown">
              <a href="/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">সুপার এডমিন <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class="{{ Request::is('superadmin/bloggers') ? 'active': '' }}"><a href="/superadmin/bloggers">ব্লগারদের তালিকা</a></li>
                <li><a href="{{ route('categories.index') }}">ক্যাটাগরি</a></li>
              </ul>
            </li>
            @else
            @endif

            @if(Auth::check())
                
            <li class="dropdown">
              <a href="/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">আমার একাউন্ট <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="/profile">{{Auth::user()->name}}</a></li>
                <li class="{{ Request::is('posts') ? 'active': '' }}"><a href="/posts">আমার লেখাগুলো</a></li>
                <li><a href="{{ route('categories.index') }}">ক্যাটাগরি</a></li>
                <li><a href="{{ route('tags.index') }}">সকল ট্যাগ</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="{{ route('logout') }}">লগ আউট</a></li>
              </ul>
            </li>
            @else
            <li class="dropdown">
              <a href="/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ব্লগ লিখুন <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{ route('login') }}" class="">লগ ইন করুন</a></li>
                <li><a href="{{ route('register') }}" class="">রেজিস্টার করুন</a></li>
              </ul>
            </li>
            @endif
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
    </nav>

    <div class="container"> <!--USE IT NEAR FUTURE  style="margin-top:50px"-->
      @include('partials._messages')
      @yield('content')

    </div>
    <!-- end of .container -->

    <div class="footer">
      <div class="container">
        <hr>
        <p class="text-muted text-center">&copy; {{date('Y')}} Copyright Reserved, Blog Humans of Thakurgaon</p>
      </div>
  </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="js/parsley.min.js"></script>
    @yield('script')
  </body>

</html>