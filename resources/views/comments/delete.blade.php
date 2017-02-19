@extends('dashboard')

@section('title', 'Blog | Delete Comment?')
@section('stylesheet')
@endsection

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
		<h1>DELETE THIS COMMENT?</h1>
		<p>
			<strong>Name:</strong> {{ $comment->name }}<br/>
			<strong>Email:</strong> {{ $comment->email }}<br/>
			<strong>Comment:</strong> {{ $comment->comment }}
		</p>
			{!! Form::open(['route' => ['comments.destroy', $comment->id], 'method'=>'DELETE']) !!}
				{{ Form::submit('YES DELETE THIS COMMENT', ['class'=>'btn btn-danger btn-block form-spacing-top']) }}
			{!! Form::close() !!}	
		</div>
	</div>



@endsection

@section('script')
	{!!Html::script('js/parsley.min.js')!!}
@endsection
