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
            <h3 class="postTitle"><a href="{{url('article/'.$post->slug)}}" class="postTitle">{{ $post->title }}</a></h3>
            <h5><strong>লিখেছেনঃ</strong> 
            <a href="{{url('profile/'.$post->postedBy)}}" class="">{{ $post->postedBy }} </a>

            | <span> {{ date('F d, Y | h:i A', strtotime($post->created_at))}}
            <i class="diffForHumans">{{ $post->created_at->diffForHumans() }}</i>
            </span></h5>
            <p class="postBody">

            {!!substr_count(strip_tags($post->body), " ")>200? substr($post->body, 0, strpos($post->body, " ", strpos(strip_tags($post->body), " ")+190))." [...]" : $post->body!!} 
            </p>
            <a href="{{url('article/'.$post->slug)}}" class="btn btn-primary btn-sm">Read More</a>
            <span>[{{ $post->hits }} বার পঠিত]</span>
            <hr>
          </div> 

        @endforeach

        </div>
       
        <div class="col-md-4">
          <div class="panel panel-primary">
            <div class="panel-heading"><span style="font-size: 25px;">সর্বাধিক পঠিত</span></div>
            <div class="panel-body">
              @foreach ($populars as $popular)
                  <a href="{{url('article/'.$popular->slug)}}" class="">{{ $popular->title }}</a></br>
                  <small><strong>লিখেছেনঃ <a href="{{url('profile/'.$popular->postedBy)}}" class="">{{ $popular->postedBy }} </a></strong></small><hr>
              @endforeach
            </div>
          </div>
        </div>
      </div>
      <div class="text-center">
          {!! $posts->links() !!}
      </div>
@endsection