@extends('main')

@section('title', 'Blog | Login')
@section('stylesheet')
	{!!Html::style('css/parsley.css')!!}
@endsection

@section('content')

	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<h1>Login</h1>
			<hr>
			{!! Form::open(['data-parsley-validate' => '']) !!}
			 	{!! Form::label('email', 'Email:') !!}
			 	{!! Form::email('email', null, array('class' => 'form-control', 'required' => '')) !!}

			 	{!! Form::label('password', 'Password:', array('class' => 'form-spacing-top')) !!}
			 	{!! Form::password('password', array('class' => 'form-control' , 'required' => '')) !!}

			 	{!! Form::label('remember', 'Remember me:', array('class' => 'form-spacing-top')) !!}
			 	{!! Form::checkbox('remember') !!}

			 	{!! Form::submit('Login', array('class' => 'btn btn-primary btn-block', 'style' => 'margin-top:20px;')) !!}

				<p><a href="{{ url('password/reset') }}">Forgot My Password</a></p>

			{!! Form::close() !!}
		</div>
	</div>

@endsection

@section('script')
	{!!Html::script('js/parsley.min.js')!!}
@endsection
