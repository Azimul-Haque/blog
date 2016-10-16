@extends('main')

@section('title', "Blog | $post->title")
@section('stylesheet')
	{!!Html::style('css/styles.css')!!}
@endsection

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1 class="postTitle">{{ $post->title}}</h1>
			<h5><strong>লিখেছেনঃ</strong> 'লেখকের নাম' | <span> {{ date('F d, Y | h:i A', strtotime($post->created_at))}}</span></h5>
			<p class="lead postBody">{{ $post->body}}</p>
		</div>
	</div>



@endsection

@section('script')
	{!!Html::script('')!!}
@endsection
