<!DOCTYPE html>
<!-- Microdata markup added by Google Structured Data Markup Helper. -->
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
    <title>@yield('title')</title>
    <!-- CHANGE THIS TITLE FOR EACH PAGE -->
    @yield('stylesheet')
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    {!!Html::style('css/styles.css')!!}
    {!!Html::style('css/device-wise.css')!!}


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
  </head>

  <body>

    <!-- Navbar from the partials -->
    @include('partials._navbar')
    <!-- Navbar from the partials -->

    <div class="container-fluid" style="margin-top:70px"> <!--USE IT NEAR FUTURE  style="margin-top:70px"-->
      <div class="row">
        <div class="col-md-2">
          @if(Auth::user()->role == 'admin')
            <div class="row">
              <div class="btn-group-vertical col-md-12">
                <button type="button" class="btn btn-info btn-block"><i class="fa fa-lock" aria-hidden="true"></i> সুপার এডমিন ড্যাশবোর্ড</button>
                <a type="button" class="btn btn-default btngroup btn-block" href="/superadmin/blog/allposts"><i class="fa fa-clipboard" aria-hidden="true"></i> সকল ব্লগপোস্ট</a>
                <a type="button" class="btn btn-default btngroup btn-block" href="/superadmin/bloggers"><i class="fa fa-list-ol" aria-hidden="true"></i> ব্লগারদের তালিকা</a>
                <a type="button" class="btn btn-default btngroup btn-block" href="{{ route('categories.index') }}"><i class="fa fa-folder-open-o" aria-hidden="true"></i> ক্যাটাগরি</a>
                <a type="button" class="btn btn-default btngroup btn-block" href="{{ route('tags.index') }}"><i class="fa fa-tags" aria-hidden="true"></i> ট্যাগসমূহ</a>
                <a type="button" class="btn btn-default btngroup btn-block" href="{{ route('posts.reportedComments') }}"><i class="fa fa-ban" aria-hidden="true"></i> রিপোর্টেড কমেন্টগুলো</a> 
                <a type="button" class="btn btn-default btngroup btn-block" href="{{ route('adminnotifications.index') }}"><i class="fa fa-paper-plane" aria-hidden="true"></i> ব্লগ বিজ্ঞপ্তি</a> 
                <br/>
              </div>
            </div>
          @endif
          @if(Auth::check())
            <div class="row">
              <div class="btn-group-vertical col-md-12">
                <button type="button" class="btn btn-success btn-block"><i class="fa fa-pencil-square" aria-hidden="true"></i> ব্লগার ড্যাশবোর্ড</button>
                <a type="button" class="btn btn-default btngroup btn-block" href="/profile"><i class="fa fa-wrench" aria-hidden="true"></i> প্রোফাইল</a>
                <a type="button" class="btn btn-default btngroup btn-block" href="/posts"><i class="fa fa-pencil" aria-hidden="true"></i> প্রকাশিত ব্লগ</a>
                <a type="button" class="btn btn-default btngroup btn-block" href="/drafts"><i class="fa fa-folder" aria-hidden="true"></i> ড্রাফট</a>
                <a type="button" class="btn btn-default btngroup btn-block" href="/notifications"><i class="fa fa-globe" aria-hidden="true"></i> নোটিফিকেশন</a>
                <a type="button" class="btn btn-default btngroup btn-block" href="/messages"><i class="fa fa-comments-o" aria-hidden="true"></i> আমার চিরকুট</a>
                <a type="button" class="btn btn-default btngroup btn-block" href="{{ route('logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i> <b>লগ আউট</b></a>
              </div> 
            </div> 
          @endif
          <br/>
        </div>
        <div class="col-md-10">
          @include('partials._messages')
          @yield('content')
        </div>
      </div>

    </div>
    <!-- end of .container -->

    <!-- Navbar from the partials -->
    @include('partials._footer')
    <!-- Navbar from the partials -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/5dda4c7cc1.js"></script>
    
    @yield('script')
  </body>

</html>