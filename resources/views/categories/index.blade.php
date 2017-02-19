@extends('dashboard')

@section('title', 'Blog | All Categories')
@section('stylesheet')
	{!!Html::style('css/parsley.css')!!}
@endsection

@section('content')

	<div class="row">
		<div class="col-md-8">
			<h1><i class="fa fa-folder-open-o" aria-hidden="true"></i> বিষয়সমূহ</h1>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
					</tr>
				</thead>

				<tbody>
				@foreach ($categories as $category)
					<tr>
						<th>{{ $category->id }}</th>
						<th>{{ $category->name }}</th>
					</tr>
				@endforeach
				</tbody>

			</table>
		</div>
		<div class="col-md-4">
			<div class="well">
			{!! Form::open(['route' => 'categories.store', 'method' => 'POST', 'data-parsley-validate' => '']) !!}
				<h2>নতুন বিষয় যোগ করুন</h2>
			 	{!! Form::label('name', 'বিষয়ের নাম:') !!}
			 	{!! Form::text('name', null, array('class' => 'form-control', 'required' => '')) !!}


			 	{!! Form::submit('বিষয় যোগ করুন', array('class' => 'btn btn-success btn-block', 'style' => 'margin-top:20px;')) !!}
			{!! Form::close() !!}
			</div>
		</div>
	</div>

@endsection

@section('script')
	{!!Html::script('js/parsley.min.js')!!}
@endsection
