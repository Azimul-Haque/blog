@extends('dashboard')

@section('title')
	Blog | All Post ({{$posts->currentPage()}}/{{ceil($posts->total()/$posts->perPage())}})
@endsection
@section('stylesheet')
	{!!Html::style('')!!}
@endsection

@section('content')

	<div class="row">
		<div class="col-md-10">
			<h1>সকল পোস্ট</h1>
		</div>
		<div class="col-md-2">
			<a href="{{route('posts.create')}}" class="btn btn-primary btn btn-block btn-h1-spacing"><i class="fa fa-plus-square" aria-hidden="true"></i> নতুন ব্লগ পোস্ট করুন</a>
		</div>
		<div class="col-md-12">
			<hr>
		</div>
	</div>	

	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
				<table class="table table-bordered table-condensed table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>শিরোনাম</th>
							<th>মূল অংশ</th>
							<th>প্রকাশের তারিখ</th>
							<th>হালনাগাদের তারিখ</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>

					@if(count($posts) == '0')
						<h3>স্বাগতম <strong>{{Auth::user()->name}}</strong>!  আপনি এখনও কোন ব্লগ প্রকাশ করেন নি। ব্লগ লিখুন</h3>
						<h4>ব্লগের নিয়মকানুন।</h4>
						<h4>কীভাবে ব্লগ লিখব?</h4>
					@endif
						@foreach ($posts as $post)
						<tr>
							<th>{{$post->id}}</th>	
							<td class="postTitle">{{$post->title}}</td>	
							<td class="postBody" style="width:40%">
							{{substr_count(strip_tags($post->body), " ")>70 ? substr(strip_tags($post->body), 0, strpos(strip_tags($post->body), " ", strpos(strip_tags($post->body), " ")+65))." [...]" : strip_tags($post->body)}}
							</td>	
							<td>{{ date('F d, Y h:i A', strtotime($post->created_at))}}</td>	
							<td>{{ date('F d, Y h:i A', strtotime($post->updated_at))}}</td>	
							<td style="width:10%"><a href="{{route('posts.show', $post->id)}}" class="btn btn-warning btn-sm btn-block"><i class="fa fa-file-text" aria-hidden="true"></i> দেখুন</a></td>	
							<td style="width:10%"><a href="{{route('posts.edit', $post->id)}}" class="btn btn-info btn-sm btn-block"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> সম্পাদনা করুন</a></td>	
						</tr>	
						@endforeach
						
					</tbody>
				</table>	
			</div>

			<div class="text-center">
				{!! $posts->links() !!}
			</div>

		</div>
	</div>

@stop

@section('script')
	{!!Html::script('')!!}
@endsection
