@extends('main')

@section('title', 'Blog | Tag Based')
@section('stylesheet')
	{!!Html::style('')!!}
@endsection

@section('content')

	<div class="row">
		<div class="col-md-8">
			@foreach($tag->posts()->orderBy('id', 'desc')->get() as $post)
				<h3 class="postTitle">{{ $post->title }}</h3>
	            <h5><strong>লিখেছেনঃ</strong> {{ $post->postedBy }} | <span> {{ date('F d, Y | h:i A', strtotime($post->created_at))}}
				<i class="diffForHumans">{{ $post->created_at->diffForHumans() }}</i>
	            </span></h5>
	            <p class="postBody">
	            {!!strlen($post->body)>1200? substr($post->body, 0, strpos($post->body, " ", strpos(strip_tags($post->body), " ")+1200))." [...]" : $post->body!!}
	            </p>
	            <a href="{{url('article/'.$post->slug)}}" class="btn btn-primary btn-sm">Read More</a> 
	            <hr>

				<span>বিষয়ঃ
				<a class="" href="/category/{{$post->category->name}}/">{{ $post->category->name }}
						</a>
				</span> | 
				<span>ট্যাগসমূহঃ 
					<?php
						$labels = array('default','primary','success','info','warning','danger');
						$i = 1;
					?>
					@foreach ($post->tags as $tag)
						<a class="label label-{{$labels[$i]}}" href="/tag/{{$tag->name}}/">{{ $tag->name }}
						</a>
						<?php $i++?>
					@endforeach
				</span>
				<hr>
			@endforeach
		</div>
		<div class="col-md-4">
			<h1>ট্যাগসমূহ</h1>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>ট্যাগের নাম</th>
						<th>পোস্ট সংখ্যা</th>
					</tr>
				</thead>

				<tbody>
				@foreach ($taglist as $tag)
					<tr>
						<th>{{ $tag->id }}</th>
						<th><a href="/tag/{{$tag->name}}/">{{ $tag->name }}</a></th>
						<th>{{ $tag->posts()->count() }}</th>
					</tr>
				@endforeach
				</tbody>

			</table>
		</div>
	</div>

@endsection

@section('script')
	{!!Html::script('')!!}
@endsection
