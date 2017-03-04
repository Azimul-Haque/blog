@extends('main')

@section('title', 'ব্লগ | লগইন')
@section('stylesheet')
	{!!Html::style('css/parsley.css')!!}
@endsection

@section('content')

	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<h1><i class="fa fa-sign-in" aria-hidden="true"></i> লগইন</h1>
			<hr>
			<div class="panel">
				<div class="panel-body">
					{!! Form::open(['data-parsley-validate' => '']) !!}
					 	<i class="fa fa-envelope-o" aria-hidden="true"></i> {!! Form::label('email', 'ইমেইলঃ') !!}
					 	{!! Form::email('email', null, array('class' => 'form-control', 'required' => '', 'data-parsley-required-message' => 'আপনার ইমেইল এড্রেসটি লিখুন')) !!}

					 	<i class="fa fa-unlock-alt" aria-hidden="true"></i> {!! Form::label('password', 'পাসওয়ার্ডঃ', array('class' => 'form-spacing-top')) !!}
					 	{!! Form::password('password', array('class' => 'form-control' , 'required' => '', 'data-parsley-required-message' => 'আপনার পাসওয়ার্ডটি লিখুন')) !!}

					 	{!! Form::label('remember', 'মনে রেখ আমায়', array('class' => 'form-spacing-top')) !!}
					 	{!! Form::checkbox('remember') !!}

					 	{!! Form::submit('প্রবেশ করুন', array('class' => 'btn btn-primary btn-block', 'style' => 'margin-top:20px;')) !!}

						<p><a href="{{ url('password/reset') }}">পাসওয়ার্ড ভুলে গেছেন?</a></p>

					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>

@endsection

@section('script')
	{!!Html::script('js/parsley.min.js')!!}
@endsection
