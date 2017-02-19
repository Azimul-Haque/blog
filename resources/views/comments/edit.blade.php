@extends('dashboard')

@section('title', 'Blog | Edit Comment')
@section('stylesheet')
	{!!Html::style('css/parsley.css')!!}
@endsection

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
		<h3>Edit Comment</h3>
			{!! Form::model($post, ['route' => ['comments.update', $post->comments->id], 'data-parsley-validate' => '', 'method'=>'PUT']) !!}

				<div class="row">
					<div class="col-md-6">
						{{ Form::label('name', 'Name:') }}
						{{ Form::text('name', null, ['class'=>'form-control postTitle', 'disabled' => 'disabled']) }}
					</div>	
					<div class="col-md-6">

						{{ Form::label('email', 'Email:') }}
						{{ Form::text('email', null, ['class'=>'form-control', 'disabled' => 'disabled']) }}
					</div>
				</div>


				{{ Form::label('comment', 'Comment:', ['class'=>'form-spacing-top']) }}
				{{ Form::textarea('comment', null,['class'=>'form-control postBody', 'required' => '']) }}

				{{ Form::submit('Update Comment', ['class'=>'btn btn-success btn-block form-spacing-top']) }}
			{!! Form::close() !!}	
		</div>
	</div>



@endsection

@section('script')
	{!!Html::script('js/parsley.min.js')!!}
@endsection
