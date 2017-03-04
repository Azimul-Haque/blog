@extends('main')

@section('stylesheet')
  {!!Html::style('css/parsley.css')!!}
@endsection

@section('title', 'Blog | Forgot my password')

@section('content')
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div class="panel panel-default">
          	<div class="panel-heading">পাসওয়ার্ড হালনাগাদ করুন</div>
          	<div class="panel-body">
          		{!! Form::open(['url' => 'password/reset','data-parsley-validate' => '', 'method' => 'PUT ']) !!}
                {!! Form::hidden('token', $token) !!}
      				 	{!! Form::label('email', 'ইমেইলঃ') !!}
      				 	{!! Form::email('email', $email, array('class' => 'form-control', 'required' => '')) !!}
                {!! Form::label('password', 'নতুন পাসওয়ার্ড', array('class' => 'form-spacing-top')) !!}
                {!! Form::password('password', array('class' => 'form-control' , 'required' => '', 'minlength' => '6')) !!}
                
                {!! Form::label('password_confirmation', 'পাসওয়ার্ড নিশ্চিত করুন', array('class' => 'form-spacing-top')) !!}
                {!! Form::password('password_confirmation', array('class' => 'form-control' , 'required' => '', 'data-parsley-equalto' => '#password')) !!}

      				 	{!! Form::submit('হালনাগাদ সম্পন্ন করুন', array('class' => 'btn btn-primary btn-block', 'style' => 'margin-top:20px;')) !!}
    				{!! Form::close() !!}
          	</div>
          </div>
        </div>
      </div>
@endsection

@section('script')
  {!!Html::script('js/parsley.min.js')!!}
@endsection