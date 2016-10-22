@extends('main')

@section('title', 'Blog | Home')

@section('stylesheet')
  {!!Html::style('css/styles.css')!!}

@endsection


@section('content')
  <div class="row">
        <div class="col-md-12">
          <div class="jumbotron">
            <h1>Blog Humans of Thakurgaon</h1>
            <p class="lead">Thank you so much for visiting.</p>
          </div>
        </div>
      </div>
      <!-- end of header .row -->

      <div class="row">
        <div class="col-md-8">
        @foreach ($posts as $post)
          <div class="post">
            <h3 class="postTitle">{{ $post->title }}</h3>
            <h5><strong>লিখেছেনঃ</strong> {{ $post->postedBy }} | <span> {{ date('F d, Y | h:i A', strtotime($post->created_at))}}
            <i class="diffForHumans">{{ $post->created_at->diffForHumans() }}</i>
            </span></h5>
            <p class="postBody">

            {!!strlen($post->body)>1200? substr($post->body, 0, strpos($post->body, " ", strpos(strip_tags($post->body), " ")+1200))." [...]" : $post->body!!} 
            </p>
            <a href="{{url('article/'.$post->slug)}}" class="btn btn-primary btn-sm">Read More</a> 
            <hr>
          </div>

        @endforeach

        </div>

        <div class="col-md-3 col-md-offset-1">
          <h2>Sidebar</h2>
        </div>
      </div>
      <div class="text-center">
          {!! $posts->links() !!}
      </div>
@endsection