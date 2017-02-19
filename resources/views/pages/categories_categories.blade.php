@extends('main')

@section('title', 'Blog | Category Based')
@section('stylesheet')
	{!!Html::style('')!!}
@endsection

@section('content')

	<div class="row">
		<div class="col-md-8">
			@foreach($category->posts()->orderBy('id', 'desc')->get() as $post)
				<p class="postTitle mainBodyPostTitle"><strong><a href="{{url('article/'.$post->slug)}}" class="postTitle">{{ $post->title }}</a></strong></p>
	            <h5><strong>লিখেছেনঃ</strong> 
	            <a href="{{url('profile/'.$post->postedBy)}}" class="">{{ $post->postedBy }} </a>
	            <span> {{ date('F d, Y | h:i A', strtotime($post->created_at))}}
					<i class="diffForHumans">{{ $post->created_at->diffForHumans() }}</i>
	            </span></h5>
	            <span class="postBody">
	            	{!!strlen($post->body)>1200? substr($post->body, 0, strpos($post->body, " ", strpos(strip_tags($post->body), " ")+1200))." [...] " : $post->body!!}
	            	<a href="{{ url('article/'.$post->slug) }}">বাকিটুকু পড়ুন</a>
	            </span>
	            <p></p>
				
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
