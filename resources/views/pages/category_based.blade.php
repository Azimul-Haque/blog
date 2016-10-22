@extends('main')

@section('title', 'Blog | Category Based')
@section('stylesheet')
	{!!Html::style('')!!}
@endsection

@section('content')

	<div class="row">
		<div class="col-md-8">
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
				@foreach ($categories as $category)
					<tr>
						<th>{{ $category->id }}</th>
						<th><a href="/category/{{$category->name}}/">{{ $category->name }}</a></th>
						<th>{{ $category->posts()->count() }}</th>
					</tr>
				@endforeach
				</tbody>

			</table>
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
				@foreach ($tags as $tag)
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
