@extends('main')

@section('title', 'Blog | Category Based')
@section('stylesheet')
	{!!Html::style('')!!}
@endsection

@section('content')

	<div class="row">
		<div class="col-md-8">
			@foreach($category->posts()->orderBy('id', 'desc')->get() as $post)
				<h3 class="postTitle">{{ $post->title }}</h3>
	            <h5><strong>লিখেছেনঃ</strong> 
	            <a href="{{url('profile/'.$post->postedBy)}}" class="">{{ $post->postedBy }} </a>
	            | <span> {{ date('F d, Y | h:i A', strtotime($post->created_at))}}
					<i class="diffForHumans">{{ $post->created_at->diffForHumans() }}</i>
	            </span></h5>
	            <p class="postBody">
	            {!!strlen($post->body)>1200? substr($post->body, 0, strpos($post->body, " ", strpos(strip_tags($post->body), " ")+1200))." [...]" : $post->body!!}
	            </p>
	            <a href="{{url('article/'.$post->slug)}}" class="btn btn-primary btn-sm">Read More</a> 
	            <hr>
				
				<span>বিষয়ঃ 
				<a class="" href="/category/{{$post->category->name}}/">{{ $post->category->name }}</a>
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
			<h1>বিষয়সমূহ</h1>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>বিষয়ের নাম</th>
						<th>পোস্ট সংখ্যা</th>
					</tr>
				</thead>

				<tbody>
				@foreach ($categorylist as $category)
					<tr>
						<th>{{ $category->id }}</th>
						<th><a href="/category/{{$category->name}}/">{{ $category->name }}</a></th>
						<th>{{ $category->posts()->count() }}</th>
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
