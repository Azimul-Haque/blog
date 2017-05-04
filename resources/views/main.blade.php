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

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    @yield('stylesheet')

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

    <div class="container" style="margin-top:70px"> <!--USE IT NEAR FUTURE  style="margin-top:70px" (done)-->
      <img src="{{url('images/banner.png')}}" class="img-responsive banner"><br/>
      @include('partials._messages')
      @yield('content')
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