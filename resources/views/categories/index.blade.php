@extends('main')

@section('title', 'Blog | All Categories')
@section('stylesheet')
	{!!Html::style('css/parsley.css')!!}
@endsection

@section('content')

	<div class="row">
		<div class="col-md-8">
			<h1>বিষয়সমূহ</h1>
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

			<hr>
			{!! Form::open(['route' => 'posts.store', 'data-parsley-validate' => '']) !!}
			 	{!! Form::label('title', 'Title:') !!}
			 	{!! Form::text('title', null, array('class' => 'form-control', 'required' => '')) !!}

			 	{!! Form::label('slug', 'Slug:', array('class' => 'form-spacing-top')) !!}
			 	{!! Form::text('slug', null, array('class' => 'form-control', 'required' => '', 'minlength' => '5', 'maxlength' => '255')) !!}

			 	{!! Form::label('body', 'Body:', array('class' => 'form-spacing-top')) !!}
			 	{!! Form::textarea('body', null, array('class' => 'form-control' , 'required' => '')) !!}

			 	{!! Form::submit('Create Post', array('class' => 'btn btn-success btn-block', 'style' => 'margin-top:20px;')) !!}
			{!! Form::close() !!}
		</div>
	</div>

@endsection

@section('script')
	{!!Html::script('js/parsley.min.js')!!}
@endsection
