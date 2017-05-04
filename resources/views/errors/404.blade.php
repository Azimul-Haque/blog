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
    <!-- Default Bootstrap Navbar -->
    <!-- Navbar from the partials -->
    @include('partials._navbar')
    <!-- Navbar from the partials -->

    <div class="container" style="margin-top:70px"> <!--USE IT NEAR FUTURE  style="margin-top:70px" (done)-->
      <img src="{{url('images/banner.png')}}" class="img-responsive banner"><br/>
      <div class="row">
        <div class="col-md-8">
          <h1 style="color: red;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> ৪০৪ পাওয়া যায়নি<hr></h1>
          <p>
            আপনি যা খুঁজছেন তা এই URL-এ পাওয়া যায়নি! </p>
          </p>

          <br/>
            @if (Session::has('errorException'))
              <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{Session::get('errorException')}}
              </div>  
            @endif
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