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
		<div class="col-md-8 col-md-offset-2">
			<h1 class="postTitle">{{ $post->title}}</h1>
			<h5><strong>লিখেছেনঃ</strong> {{ $post->postedBy }} | <span> {{ date('F d, Y | h:i A', strtotime($post->created_at))}} 
			<i class="diffForHumans">{{ $post->created_at->diffForHumans() }}</i>	
			</span></h5>
			<p class="lead postBody">
				{!! $post->body!!} 
			</p>
			<hr>
			<span>বিষয়ঃ <a href="/category/{{$post->category->name}}/">{{ $post->category->name }}</a>
			</span> | 
			<span>ট্যাগসমূহঃ 
				<?php
					$labels = array('default','primary','success','info','warning','danger');
					$i = 1;
				?>
				@foreach ($post->tags as $tag)
					<a class="label label-{{$labels[$i]}}" href="/tag/{{$tag->name}}">{{ $tag->name }}
						</a>
					<?php $i++?>
				@endforeach
			</span>
		</div>
	</div>

	<div class="row ">
		<div class="col-md-8 col-md-offset-2 form-spacing-top">
		<h2 class="comments-title"><i class="fa fa-comments" aria-hidden="true"></i></span> {{ $post->comments()->count() }} Comments</h2>
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
		<div class="col-md-8 col-md-offset-2 form-spacing-top" id="comment-form">
		<h2>Comments Here</h2>
			{{ Form::open(['route' => ['comments.store', $post->id], 'method' => 'POST', 'data-parsley-validate' => '']) }}
			<div class="row">

				<div class="col-md-6">
					{{ Form::label('name', 'Name:') }}
					{{ Form::text('name', null, ['class' => 'form-control', 'required' => '']) }}
				</div>

				<div class="col-md-6">
					{{ Form::label('email', 'Email:') }}
					{{ Form::email('email', null, ['class' => 'form-control', 'required' => '']) }}
				</div>

				<div class="col-md-12">
					{{ Form::label('comment', 'Comment:', ['class' => 'form-spacing-top']) }}
					{{ Form::textarea('comment', null, ['class' => 'form-control',  'rows' => '5', 'required' => '']) }}

					{{ Form::submit('Add Comment', ['class' => 'btn btn-success btn-block form-spacing-top']) }}
				</div>

			</div>
			{{ Form::close() }}
		</div>
	</div>



@endsection

@section('script')
	{!!Html::script('js/parsley.min.js')!!}
@endsection
