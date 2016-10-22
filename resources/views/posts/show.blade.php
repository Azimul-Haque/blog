@extends('main')

@section('title', 'Blog | View Post')
@section('stylesheet')
	{!!Html::style('css/styles.css')!!}
	{!!Html::style('css/font-awesome.min.css')!!}
@endsection

@section('content')

	<div class="row">
		<div class="col-md-8">
			<h1 class="postTitle">{{ $post->title}}</h1>
			<p class="lead postBody">{!! $post->body!!}</p>
			<hr>
			<div class="tags">
				
				<?php
					$labels = array('default','primary','success','info','warning','danger');
					$i = 1;
				?>

				ট্যাগসমূহঃ
				@foreach ($post->tags as $tag)
					<span class="label label-{{$labels[$i]}}">{{ $tag->name }}</span>
					<?php $i++?>
				@endforeach
			</div>
			<div class="backend-comments" style="margin-top: 40px;">
				<h3>কমেন্ট: <small>মোট {{ $post->comments()->count() }} টি কমেন্ট</small></h3>
				
				<table class="table">
					<thead>
						<tr>
							<th>নাম</th>
							<th>ইমেইল এড্রেস</th>
							<th>কমেন্ট</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($post->comments as $comment)
						<tr>
							<td>{{ $comment->name }}</td>
							<td>{{ $comment->email }}</td>
							<td>{{ $comment->comment }}</td>
							<td>
								<a href="{{route('comments.report', $comment->id)}}" class="btn btn-xs btn-danger" title="রিপোর্ট করুন (Report the comment)">
									<i class="fa fa-trash" aria-hidden="true"></i>
								</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				
			</div>
		</div>
		<div class="col-md-4">
			<div class="well">
				<dl class="dl-horizontal">
					<label>URL</label>
					<p> <a href="{{ url('article/'.$post->slug) }}">{{ url('article/'.$post->slug) }}</a> </p>
				</dl>
				<dl class="dl-horizontal">
					<label>Category:</label>
					<p>{{ $post->category->name}}</p>
				</dl>
				<dl class="dl-horizontal">
					<label>Created at</label>
					<p>{{ date('F d, Y h:i A', strtotime($post->created_at))}}</p>
				</dl>
				<dl class="dl-horizontal">
					<label>Last updated</label>
					<p>{{ date('F d, Y h:i A', strtotime($post->updated_at))}}</p>
				</dl>
				<hr>
				<div class="row">
					<div class="col-sm-6">
						{!! Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class'=>'btn btn-primary btn-block')) !!}
						
					</div>
					<div class="col-sm-6">
					{!! Form::open(['route' => ['posts.destroy', $post->id], 'method'=>'DELETE']) !!}
						{!! Form::submit('Delete', ['class'=>'btn btn-danger btn-block']) !!}
					{!! Form::close() !!}	
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						{!! Html::linkRoute('posts.index', '<< Show All Posts', array(), array('class'=>'btn btn-default btn-block btn-h1-spacing')) !!}
					</div>
				</div>
			</div>
		</div>

	</div>



@endsection

@section('script')
	{!!Html::script('')!!}
@endsection
