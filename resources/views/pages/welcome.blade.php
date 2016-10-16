@extends('main')

@section('title', 'Blog | Home')

@section('stylesheet')
  {!!Html::style('css/styles.css')!!}
@endsection


@section('content')
  <div class="row">
        <div class="col-md-12">
          <div class="jumbotron">
            <h1>Welcome to My Blog!</h1>
            <p class="lead">Thank you so much for visiting. This is my test website built with Laravel. Please read my popular post!</p>
            <p><a class="btn btn-primary btn-lg" href="#" role="button">Popular Post</a></p>
          </div>
        </div>
      </div>
      <!-- end of header .row -->

      <div class="row">
        <div class="col-md-8">
        @foreach ($posts as $post)
          <div class="post">
            <h3>{{ $post->title }}</h3>
            <h5><strong>লিখেছেনঃ</strong></h5>
            <p>{{substr($post->body, 0, 1200)}}{{strlen($post->body)>1200 ? "..." : " "}}</p>
            <a href="#" class="btn btn-primary btn-sm">Read More</a> <span> {{ date('F d, Y | h:i A', strtotime($post->created_at))}}</span>
            <hr>
          </div>

        @endforeach

        </div>

        <div class="col-md-3 col-md-offset-1">
          <h2>Sidebar</h2>
        </div>
      </div>
@endsection