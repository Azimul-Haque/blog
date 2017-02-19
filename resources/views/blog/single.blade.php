@extends('main')

<?php $titleTag = htmlspecialchars($post->title); ?>
@section('title', "Blog | $titleTag")
@section('stylesheet')
	{!!Html::style('css/styles.css')!!}
	{!!Html::style('css/font-awesome.min.css')!!}
	{!!Html::style('css/parsley.css')!!}
@endsection

@section('content')

	<div class="row">

	        <div class="col-md-6 col-md-push-3">
	        	@if(!$post->image== NULL)
					<img class="img-responsive" src="{{ asset('images/'. $post->image) }}">
				@endif
				<p class="postTitle mainBodyPostTitle"><strong><a href="{{url('article/'.$totalpost->slug)}}" class="postTitle">{{ $totalpost->title }}</a></strong></p>
				<h5><strong>লিখেছেনঃ</strong> 
				<a href="{{url('profile/'.$post->postedBy)}}" class="">{{ $post->postedBy }} </a>
				| <span> {{ date('F d, Y | h:i A', strtotime($post->created_at))}} 
				<i class="diffForHumans">{{ $post->created_at->diffForHumans() }}</i>	
				</span></h5>
				<span class="postBody">
					{!! $post->body!!} 
				</span>
				<span><i class="fa fa-folder-open-o" aria-hidden="true"></i> বিষয়ঃ <a href="/category/{{$post->category->name}}/">{{ $post->category->name }}</a>
	            </span> | 
	            <span><i class="fa fa-tags" aria-hidden="true"></i> ট্যাগসমূহঃ 
	              <?php
	                $labels = array('default','primary','success','info','warning','danger');
	                $i = 1;
	              ?>
	              @foreach ($post->tags as $tag)
	                <a class="label label-{{$labels[$i]}}" href="/tag/{{$tag->name}}">{{ $tag->name }} 
	                  </a>
	                <?php $i++?>
	              @endforeach 
	               <span style="margin-left: 5px;">[ <i class="fa fa-eye" aria-hidden="true"></i> {{ $post->hits }} ]</span>
	               <span style="margin-left: 5px;">[ <i class="fa fa-comments" aria-hidden="true"></i> {{ $post->comments()->count() }} ]</span>
	            </span>
		    <div class="row ">
				<div class="col-md-12 form-spacing-top">
					<h2 class="comments-title" style="border-bottom: 1px solid #a1887f;"><i class="fa fa-comments" aria-hidden="true"></i> {{ $post->comments()->count() }} টি কমেন্ট</h2>
					@foreach($post->comments as $comment)
						<div class="comment">
							<div class="author-info">
								<img src="{{"https://www.gravatar.com/avatar/". md5(strtolower(trim($comment->email))) . "?s=50&d=monsterid"}}" class="author-image img-circle">
								<div class="author-name">
								<h4>{{ $comment->name }}</h4>
								<span class="author-time">{{ date('F d, Y h:i A', strtotime($comment->created_at)) }}
								, <i class="diffForHumans">{{ $comment->created_at->diffForHumans() }}</i>	
								</span>
								</div>
							</div>
							<div class="comment-content">{{ $comment->comment }}</div>

							
						</div><hr>
					@endforeach
				</div>
			</div>

			<div class="row ">
				<div class="col-md-12 form-spacing-top" id="comment-form">
				<h2 style="border-bottom: 1px solid #a1887f;">কমেন্ট করুন</h2>
					{{ Form::open(['route' => ['comments.store', $post->id], 'method' => 'POST', 'data-parsley-validate' => '']) }}
					<div class="row">
						
						@if(Auth::check())
							<div class="col-md-12">
								<h3><b>আপনার নামঃ</b> {{ Auth::user()->name }}</h3>
								<input type="hidden" name="name" value="{{ Auth::user()->name }} &#x2611;">
								<input type="hidden" name="email" value="{{ Auth::user()->email }}">
							</div> 
						@else
						<div class="col-md-6">
							{{ Form::label('name', 'Name:') }}
							{{ Form::text('name', null, ['class' => 'form-control', 'required' => '']) }}
						</div>

						<div class="col-md-6">
							{{ Form::label('email', 'Email:') }}
							{{ Form::email('email', null, ['class' => 'form-control', 'required' => '']) }}
						</div>
						@endif
						

						<div class="col-md-12">
							{{ Form::label('comment', 'Comment:', ['class' => 'form-spacing-top']) }}
							{{ Form::textarea('comment', null, ['class' => 'form-control',  'rows' => '5', 'required' => '', 'data-parsley-required-message' => 'কমেন্টে কিছু তো লিখুন!' ]) }}

							{{ Form::submit('Add Comment', ['class' => 'btn btn-success btn-block form-spacing-top']) }}
						</div>

					</div>
					{{ Form::close() }}
				</div>
			</div>   <br/>  
            
        </div>

        <div class="col-md-3 col-md-pull-6">
            <div class="panel" style="background: #b2dfdb;">
              <div class="panel-body">
                <span style="font-size: 25px;"><b>ব্লগের তথ্য</b></span><br/>
                <h4>মোট ব্লগারঃ {{ $bloggers->id }}</h4>
                <h4>সর্বমোট পোস্টঃ {{ $totalpost->id }}</h4>
              </div>
            </div>

            <div class="panel" style="background: #a5d6a7;">
              <div class="panel-body">
                <span style="font-size: 25px;"><b>ব্লগের তথ্য</b></span><br/>
                <h4>মোট ব্লগারঃ {{ $bloggers->id }}</h4>
                <h4>সর্বমোট পোস্টঃ {{ $totalpost->id }}</h4>
              </div>
            </div>

            <div class="panel" style="background: #ffe082;">
              <div class="panel-body">
                <span style="font-size: 25px;"><b>ব্লগের তথ্য</b></span><br/>
                <h4>মোট ব্লগারঃ {{ $bloggers->id }}</h4>
                <h4>সর্বমোট পোস্টঃ {{ $totalpost->id }}</h4>
              </div>
            </div>
        </div>
       
        <div class="col-md-3">
            <div class="panel" style="background: #f0f4c3;">
            <div class="panel-body">
              <span style="font-size: 25px;"><b>সর্বাধিক পঠিত</b></span>
              @foreach ($populars as $popular)
                  <div style="border-bottom: 1px solid #cddc39;">
                    <a href="{{url('article/'.$popular->slug)}}" class="postTitle" style="font-size: 20px;">{{ $popular->title }}</a></br>
                    <small><strong><i class="fa fa-user" aria-hidden="true"></i> <a href="{{url('profile/'.$popular->postedBy)}}" class="">{{ $popular->postedBy }} </a></strong></small>
                  </div><br/>
              @endforeach
            </div>
          </div>
          </div>
      </div>	
	</div>      


	



@endsection

@section('script')
	{!!Html::script('js/parsley.min.js')!!}
@endsection
