@extends('main')

@section('title', 'Blog | All Tags')
@section('stylesheet')
	{!!Html::style('css/parsley.css')!!}
@endsection

@section('content')

	<div class="row">
		<div class="col-md-8">
			<h1>সকল ট্যাগ</h1>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
					</tr>
				</thead>

				<tbody>
				@foreach ($tags as $tag)
					<tr>
						<th>{{ $tag->id }}</th>
						<th>{{ $tag->name }}</th>
					</tr>
				@endforeach
				</tbody>

			</table>
		</div>
		<div class="col-md-4">
			<div class="well">
			{!! Form::open(['route' => 'tags.store', 'method' => 'POST', 'data-parsley-validate' => '']) !!}
				<h2>নতুন ট্যাগ যোগ করুন</h2>
			 	{!! Form::label('name', 'ট্যাগ নাম:') !!}
			 	{!! Form::text('name', null, array('class' => 'form-control', 'required' => '')) !!}


			 	{!! Form::submit('ট্যাগ যোগ করুন', array('class' => 'btn btn-success btn-block', 'style' => 'margin-top:20px;')) !!}
			{!! Form::close() !!}
			</div>
		</div>
	</div>

@endsection

@section('script')
	{!!Html::script('js/parsley.min.js')!!}
@endsection
