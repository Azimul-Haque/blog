@extends('dashboard')

@section('title', 'ব্লগ | মন্তব্য রিপোর্ট')
@section('stylesheet')

@endsection

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
		<h1>নিম্নলিখিত মন্তব্যটি রিপোর্ট করুন</h1>
		<p>
			<strong>মন্তব্যকারীঃ</strong> {{ $comment->name }}<br/>
			<strong>ইমেইলঃ</strong> {{ $comment->email }}<br/>
			<strong>মন্তব্যঃ</strong> {{ $comment->comment }}
		</p>
			{!! Form::open(['route' => ['comments.reportconfirm', $comment->id], 'method'=>'PUT']) !!}
				{{ Form::submit('রিপোর্ট করুন', ['class'=>'btn btn-danger btn-block form-spacing-top']) }}
			{!! Form::close() !!}	
		</div>
	</div>

@endsection

@section('script')
	{!!Html::script('')!!}
@endsection
