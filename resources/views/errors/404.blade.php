<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="{{ asset('images/favicon.png') }}">
    <meta name="theme-color" content="#33AA33">
    <meta name="msapplication-navbutton-color" content="#33AA33">
    <meta name="apple-mobile-web-app-status-bar-style" content="#33AA33">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>404 Not Found</title>
    <!-- CHANGE THIS TITLE FOR EACH PAGE -->
    @yield('stylesheet')
    {!!Html::style('css/styles.css')!!}
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <style type="text/css">
        /*
        @font-face {
        font-family: MyAdorshoLipi;
        src: url(fonts/AdorshoLipi.ttf);
        }
        @font-face {
            font-family: MyLato;
            src: url(fonts/Lato-Regular.ttf);
        }
        */
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
  </head>

  <body>
    <!--facebook sharer code-->
      <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
        FB.init({
          appId      : '540030616188468',
          xfbml      : true,
          version    : 'v2.7'
        });
        };

        (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
         }(document, 'script', 'facebook-jssdk'));
      </script>
    <!--facebook sharer code-->
    <!-- Default Bootstrap Navbar -->
    <nav class="navbar navbar-default navbar-fixed-top"> <!--USE IT NEAR FUTURE  navbar-fixed-top-->
      {{-- <img src="{{url('images/banner.png')}}" class="img-responsive"> --}}
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ url('/') }}"><b>Blog</b> | Humans of <b>Thakurgaon</b></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="{{ Request::is('/') ? 'active': '' }}"><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> নীড় পাতা</a></li>
            <li class="{{ Request::is('about') ? 'active': '' }}"><a href="{{ url('/about') }}"><i class="fa fa-question-circle-o" aria-hidden="true"></i> বৃত্তান্ত</a></li>
            <li class="{{ Request::is('contact') ? 'active': '' }}"><a href="{{ url('/contact') }}"><i class="fa fa-envelope-o" aria-hidden="true"></i> যোগাযোগ</a></li>
            <li class="{{ Request::is('categories/blogs') ? 'active': '' }}"><a href="{{ url('/categories/blogs') }}"><i class="fa fa-folder-open-o" aria-hidden="true"></i> বিষয়ভিত্তিক ব্লগ</a></li>
          </ul>
          @if(Auth::check())
            <a href="{{route('posts.create')}}" class="btn btn-primary btn-sm navbar-btn newPost"><i class="fa fa-plus-square" aria-hidden="true"></i> নতুন ব্লগ পোস্ট লিখুন</a>
          @endif
          <ul class="nav navbar-nav navbar-right">
            @if(Auth::check() && Auth::user()->role == 'admin')
              <li class="{{ Request::is('superadmin/blog/allposts') ? 'active': '' }}"><a href="{{ url('/superadmin/blog/allposts') }}"><i class="fa fa-lock" aria-hidden="true"></i> সুপার এডমিন</a></li>
            @else
            @endif

            @if(Auth::check())
            <li class="dropdown">
              <a href="/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle" aria-hidden="true"></i> {{Auth::user()->name}}<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{ url('/posts') }}"><i class="fa fa-user" aria-hidden="true"></i> ব্লগার ড্যাশবোর্শ</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i> <b>লগ আউট</b></a></li>
              </ul>
            </li>
            @else
              <li class="{{ Request::is('auth/login') ? 'active': '' }}"><a href="{{ route('login') }}" class=""><i class="fa fa-sign-in" aria-hidden="true"></i> লগ ইন করুন</a></li>
              <li class="{{ Request::is('auth/register') ? 'active': '' }}"><a href="{{ route('register') }}" class=""><i class="fa fa-plus" aria-hidden="true"></i> রেজিস্টার করুন</a></li>
            </li>
            @endif
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
    </nav>

    <div class="container" style="margin-top:70px"> <!--USE IT NEAR FUTURE  style="margin-top:70px" (done)-->
      <img src="{{url('images/banner.png')}}" class="img-responsive banner"><br/>
      <div class="row">
        <div class="col-md-8">
          <h1 style="color: red;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> ৪০৪ পাওয়া যায়নি<hr></h1>
          <p>
            আপনি যা খুঁজছেন তা এই URL-এ পাওয়া যায়নি! </p>
          </p>

          <br/>
          <a href="{{ url('/') }}" class="btn btn-sm btn-primary"><i class="fa fa-undo" aria-hidden="true"></i> ফিরে যান</a>
          <br/>
            
          </p>
        </div>
        <div class="col-md-4">
            <img src="{{ asset('images/aboutimage.jpg') }}" class="img-responsive panel">
        </div>
      </div>

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
    <script src="https://use.fontawesome.com/5dda4c7cc1.js"></script>
    @yield('script')
  </body>

</html>