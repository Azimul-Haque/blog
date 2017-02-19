@extends('main')

@section('title', 'Blog | Author')

@section('content')
      <div class="row">
        <div class="col-md-4">
          <dir class="well">
           	  <h3>ব্লগারঃ {{ $user->name }}</h3>
	          <p>ফেইসবুক লিঙ্কঃ {{ $user->fb }}</p>
	          <p>আমার সম্পর্কেঃ {{ $user->about }}</p>
	          <p>ব্লগ লিখেছেনঃ {{ $posts->count() }} টি</p>
	          <p>ব্লগে যোগদান করেছেনঃ {{ date('F d, Y', strtotime($user->created_at))}}</p>
          </dir>
        </div>
      	<div class="col-md-8">
      		<h2>{{ $user->name }}-এর ব্লগগুলো...</h2>
      		  @foreach ($posts as $post)
	          <div class="post">
	            <h3 class="postTitle">{{ $post->title }}</h3>
	            <h5><strong>লিখেছেনঃ</strong> 
	            <a href="{{url('profile/'.$post->postedBy)}}" class="">{{ $post->postedBy }} </a> 
	            {{ $post->postedBy }} 

	            | <span> {{ date('F d, Y | h:i A', strtotime($post->created_at))}}
	            <i class="diffForHumans">{{ $post->created_at->diffForHumans() }}</i>
	            </span></h5>
	            <p class="postBody">

	            {!!substr_count(strip_tags($post->body), " ")>200? substr($post->body, 0, strpos($post->body, " ", strpos(strip_tags($post->body), " ")+190))." [...]" : $post->body!!} 
	            </p>
	            <a href="{{url('article/'.$post->slug)}}" class="btn btn-primary btn-sm">Read More</a> 
	            <hr>
	          </div>
      		  @endforeach
      	</div>	
      </div>
@endsection