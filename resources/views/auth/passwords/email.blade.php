@extends('main')

@section('stylesheet')
	{!!Html::style('css/parsley.css')!!}
@endsection

@section('title', 'Blog | Forgot my password')

@section('content')
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div class="panel panel-default">
          	<div class="panel-heading">Reset Password</div>
          	<div class="panel-body">

          		{!! Form::open(['url' => 'password/email','data-parsley-validate' => '', 'method' => "POST"]) !!}
      				 	{!! Form::label('email', 'Email:') !!}
      				 	{!! Form::email('email', null, array('class' => 'form-control', 'required' => '')) !!}

      				 	{!! Form::submit('Reset Password', array('class' => 'btn btn-primary btn-block', 'style' => 'margin-top:20px;')) !!}
      				{!! Form::close() !!}
          	</div>
          </div>
        </div>
      </div>
@endsection

@section('script')
	{!!Html::script('js/parsley.min.js')!!}
@endsection