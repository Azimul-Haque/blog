@extends('main')

@section('title', 'ব্লগ | বিষয়সমূহ')
@section('stylesheet')
	{!!Html::style('')!!}
@endsection

@section('content')

	<div class="row">
		<div class="col-md-8">
			<div class="panel" style="background: #ffe082; padding: 10px;">
				<h1><i class="fa fa-folder-open-o" aria-hidden="true"></i> বিষয়সমূহ</h1>
				<table class="table table-condensed table-bordered table-hover categoryTagTabel">
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
							<th><a href="{{url('/category/'.$category->name)}}">{{ $category->name }}</a></th>
							<th>{{ $category->posts()->count() }}</th>
						</tr>
					@endforeach
					</tbody>

				</table>	
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel" style="background: #d7ccc8; padding: 10px;">
				<h1><i class="fa fa-tag" aria-hidden="true"></i> ট্যাগসমূহ</h1>
				<table class="table table-condensed table-bordered table-hover categoryTagTabel">
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
							<th><a href="{{url('/tag/'.$tag->name)}}">{{ $tag->name }}</a></th>
							<th>{{ $tag->posts()->count() }}</th>
						</tr>
					@endforeach
					</tbody>

				</table>
			</div>
		</div>
	</div>

@endsection

@section('script')
	{!!Html::script('')!!}
@endsection
