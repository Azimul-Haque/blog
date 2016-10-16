@extends('main')

@section('title', 'Blog | All Post')
@section('stylesheet')
	{!!Html::style('')!!}
@endsection

@section('content')

	<div class="row">
		<div class="col-md-10">
			<h1>All Posts</h1>
		</div>
		<div class="col-md-2">
			<a href="{{route('posts.create')}}" class="btn btn-primary btn-lg btn-block btn-h1-spacing">Create New Post</a>
		</div>
		<div class="col-md-12">
			<hr>
		</div>
	</div>	

	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>শিরোনাম</th>
						<th>কলেবর</th>
						<th>প্রকাশের তারিখ</th>
						<th>হালনাগাদের তারিখ</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($posts as $post)
					<tr>
						<th>{{$post->id}}</th>	
						<td>{{$post->title}}</td>	
						<td>{{substr($post->body, 0, 60)}}{{strlen($post->body)>60 ? "..." : " "}}</td>	
						<td>{{ date('F d, Y h:i A', strtotime($post->created_at))}}</td>	
						<td>{{ date('F d, Y h:i A', strtotime($post->updated_at))}}</td>	
						<td><a href="{{route('posts.show', $post->id)}}" class="btn btn-default btn-block">View</a></td>	
						<td><a href="{{route('posts.edit', $post->id)}}" class="btn btn-default btn-block">Edit</a></td>	
					</tr>	
					@endforeach
					
				</tbody>
			</table>

			<div class="text-center">
				{!! $posts->links() !!}
			</div>

		</div>
	</div>

@stop

@section('script')
	{!!Html::script('')!!}
@endsection
