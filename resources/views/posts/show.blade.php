@extends('dashboard')

@section('title', 'Blog | View Post')
@section('stylesheet')
	{!!Html::style('css/styles.css')!!}
	{!!Html::style('css/font-awesome.min.css')!!}
@endsection

@section('content')

	<div class="row">
		<div class="col-md-8">
			<h1 class="postTitle">{{ $post->title}}</h1>
			<span class="lead postBody">{!! $post->body!!}</span>
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
				<span>[{{ $post->hits }} বার পঠিত]</span>
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
					<p><a style="word-wrap: break-word;" href="{{ url('article/'.$post->slug) }}">{{ url('article/'.$post->slug) }}</a> </p>
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
						<a href="{{url('posts/'.$post->id.'/edit')}}" class="btn btn-primary btn-block"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> সম্পাদনা করুন</a>
					</div>
					<div class="col-sm-6">
					<button type="button" class="btn btn-danger btn-block" id="modalDeleteClick"><i class="fa fa-trash-o" aria-hidden="true"></i> মুছুন</button>
					<div class="modal fade" id="modalDelete" role="dialog">
					    <div class="modal-dialog">
					      <div class="modal-content">
					        <div class="modal-header">
					          <button type="button" class="close" data-dismiss="modal">×</button>
					          <h4 class="modal-title">পোস্ট মুছে ফেলুন!</h4>
					        </div>
					        <div class="modal-body">
					          <p>আপনি কি নিশ্চিতভাবে এই পোস্টটি মুছে ফেলতে চান?</p>
					          <p><strong>Note:</strong> মুছে ফেলা পোস্ট আর ফিরে পাওয়া যাবে না!</p>         
							{!! Form::open(['route' => ['posts.destroy', $post->id], 'method'=>'DELETE']) !!}
								{!! Form::submit('Delete', ['class'=>'btn btn-danger btn-block']) !!}
							{!! Form::close() !!}
					        </div>
					        <div class="modal-footer">
					          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					        </div>
					      </div>
					    </div>
					  </div>	
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						{!! Html::linkRoute('posts.index', '<< সকল পোস্ট দেখুন', array(), array('class'=>'btn btn-default btn-block btn-h1-spacing')) !!}
					</div>
				</div>
			</div>
		</div>

	</div>
@endsection

@section('script')
	{!!Html::script('')!!}
	<script>
		$(document).ready(function(){
		    $("#modalDeleteClick").click(function(){
		        $("#modalDelete").modal({backdrop: "static"});
		    });
		});
	</script>
@endsection
