@extends('main')

@section('title', 'Blog | Delete Comment?')
@section('stylesheet')
@endsection

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
		<h1>REPORT THIS COMMENT?</h1>
		<p>
			<strong>Name:</strong> {{ $comment->name }}<br/>
			<strong>Email:</strong> {{ $comment->email }}<br/>
			<strong>Comment:</strong> {{ $comment->comment }}
		</p>
			{!! Form::open(['route' => ['comments.reportconfirm', $comment->id], 'method'=>'PUT']) !!}
				{{ Form::submit('YES, REPORT THIS COMMENT', ['class'=>'btn btn-danger btn-block form-spacing-top']) }}
			{!! Form::close() !!}	
		</div>
	</div>

@endsection

@section('script')
	{!!Html::script('js/parsley.min.js')!!}
@endsection
