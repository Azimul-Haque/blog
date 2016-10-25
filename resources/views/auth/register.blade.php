@extends('main')

@section('title', 'Blog | Regiter')
@section('stylesheet')
	{!!Html::style('css/parsley.css')!!}
@endsection

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Register</h1>
			<hr>
			{!! Form::open(['data-parsley-validate' => '']) !!}
				<div class="row">
					<div class="col-md-6">
			 		{!! Form::label('name', 'Name:') !!}
			 		{!! Form::text('name', null, array('class' => 'form-control', 'required' => '')) !!}
			 		{!! Form::hidden('role', 'blogger') !!}
					</div>

					<div class="col-md-6">
			 		{!! Form::label('email', 'Email:', array('class' => '')) !!}
			 		{!! Form::email('email', null, array('class' => 'form-control', 'required' => '')) !!}
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
			 		{!! Form::label('phone', 'Phone Number:', array('class' => '')) !!}
			 		{!! Form::text('phone', null, array('class' => 'form-control', 'required' => '')) !!}
					</div>

					<div class="col-md-6">
			 		{!! Form::label('fb', 'Facebook Url:', array('class' => '')) !!}
			 		{!! Form::text('fb', null, array('class' => 'form-control', 'required' => '')) !!}
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
					{!! Form::label('about', 'About you:', array('class' => '')) !!}
			 		{!! Form::textarea('about', null, array('class' => 'form-control', 'required' => '', 'minlength' => '100')) !!}	
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
					{!! Form::label('password', 'Password:', array('class' => 'form-spacing-top')) !!}
			 		{!! Form::password('password', array('class' => 'form-control' , 'required' => '', 'minlength' => '6')) !!}	
					</div>

					<div class="col-md-6">
					{!! Form::label('password_confirmation', 'Confirm Password:', array('class' => 'form-spacing-top')) !!}
			 		{!! Form::password('password_confirmation', array('class' => 'form-control' , 'required' => '', 'data-parsley-equalto' => '#password')) !!}
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
					{!! Form::submit('Registter', array('class' => 'btn btn-primary btn-block', 'style' => 'margin-top:20px;')) !!}	
					</div>
				</div>				 	
			{!! Form::close() !!}
		</div>
	</div>

@endsection

@section('script')
	{!!Html::script('js/parsley.min.js')!!}
@endsection
