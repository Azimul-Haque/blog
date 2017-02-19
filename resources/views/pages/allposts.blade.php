@extends('dashboard')

@section('title')
	Blog | All Post ({{$posts->currentPage()}}/{{ceil($posts->total()/$posts->perPage())}})
@endsection
@section('stylesheet')
	{!!Html::style('')!!}
@endsection

@section('content')

	<div class="row">
		<div class="col-md-12">
			<h1>সকল পোস্ট (সকল ব্লগার)</h1>
		</div>
{{-- 		<div class="col-md-2">
			<a href="{{route('posts.create')}}" class="btn btn-primary btn btn-block btn-h1-spacing"><i class="fa fa-plus-square" aria-hidden="true"></i> নতুন ব্লগ পোস্ট করুন</a>
		</div> --}}
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
							<th>রচয়িতা</th>
							<th>প্রকাশের তারিখ</th>
							<th>হালনাগাদের তারিখ</th>
							<th></th>
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
							<td class="" style="width:35%">
								<p class="postTitle">
									<strong><a href="{{url('article/'.$post->slug)}}" class="postTitle">{{ $post->title }}</a> </strong>
									@if($post->featured == 'YES')
									<span class="label label-warning">ফিচারড পোস্ট</span>
									@endif
								</p>
							</td>	
							<td class="" style="width:15%">{{$post->postedBy}}</td>	
							<td>{{ date('F d, Y h:i A', strtotime($post->created_at))}}</td>	
							<td>{{ date('F d, Y h:i A', strtotime($post->updated_at))}}</td>
							<td style="width:10%"><a href="{{route('posts.edit', $post->id)}}" class="btn btn-info btn-sm btn-block"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> সম্পাদনা করুন</a></td>
							<td>
								<button type="button" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#modalDelete{{$post->id}}"><i class="fa fa-trash-o" aria-hidden="true"></i> মুছুন</button>
								<div class="modal fade static" id="modalDelete{{$post->id}}" role="dialog">
								    <div class="modal-dialog">
								      <div class="modal-content">
								        <div class="modal-header">
								          <button type="button" class="close" data-dismiss="modal">×</button>
								          <h4 class="modal-title">পোস্ট মুছে ফেলুন!</h4>
								        </div>
								        <div class="modal-body">
								          <p>আপনি কি নিশ্চিতভাবে এই পোস্টটি মুছে ফেলতে চান?</p>
								          <span><strong>"{{ $post->title }}"</strong></span><br/>
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
							</td>
							<td>
								{!! Form::open(['route' => ['posts.makefeatured', $post->id], 'method'=>'PUT']) !!}
									<button class="btn btn-success btn-sm btn-block"  type="submit"><i class="fa fa-thumb-tack" aria-hidden="true"></i> ফিচারড করুন</button>	
								{!! Form::close() !!}
								
							</td>
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
