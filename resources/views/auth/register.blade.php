@extends('main')

@section('title', 'Blog | Regiter')
@section('stylesheet')
	{!!Html::style('css/parsley.css')!!}
@endsection

@section('content')

	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<h1>Register</h1>
			<hr>
			{!! Form::open(['data-parsley-validate' => '']) !!}
			 	{!! Form::label('name', 'Name:') !!}
			 	{!! Form::text('name', null, array('class' => 'form-control', 'required' => '')) !!}

			 	{!! Form::hidden('role', 'blogger') !!}

			 	{!! Form::label('email', 'Email:', array('class' => 'form-spacing-top')) !!}
			 	{!! Form::email('email', null, array('class' => 'form-control', 'required' => '')) !!}

			 	{!! Form::label('password', 'Password:', array('class' => 'form-spacing-top')) !!}
			 	{!! Form::password('password', array('class' => 'form-control' , 'required' => '', 'minlength' => '6')) !!}
				
				{!! Form::label('password_confirmation', 'Confirm Password:', array('class' => 'form-spacing-top')) !!}
			 	{!! Form::password('password_confirmation', array('class' => 'form-control' , 'required' => '', 'data-parsley-equalto' => '#password')) !!}

			 	{!! Form::submit('Registter', array('class' => 'btn btn-primary btn-block', 'style' => 'margin-top:20px;')) !!}
			{!! Form::close() !!}
		</div>
	</div>

@endsection

@section('script')
	{!!Html::script('js/parsley.min.js')!!}
@endsection
