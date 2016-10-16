@extends('main')

@section('title', 'Blog | Edit Post')
@section('stylesheet')
	{!!Html::style('css/styles.css')!!}
	{!!Html::style('css/parsley.css')!!}
@endsection

@section('content')

	<div class="row">
		<div class="col-md-8">
			{!! Form::model($post, ['route' => ['posts.update', $post->id], 'data-parsley-validate' => '', 'method'=>'PUT']) !!}

				{{ Form::label('title', 'Title') }}
				{{ Form::text('title', null, ['class'=>'form-control input-lg postTitle', 'required' => '']) }}

				{!! Form::label('slug', 'Slug:', ['class'=>'form-spacing-top']) !!}
			 	{!! Form::text('slug', null, array('class' => 'form-control postSlug', 'required' => '', 'minlength' => '5', 'maxlength' => '255')) !!}

				{{ Form::label('body', 'Body', ['class'=>'form-spacing-top']) }}
				{{ Form::textarea('body', null,['class'=>'form-control postBody', 'required' => '']) }}
			
		</div>
		<div class="col-md-4">
			<div class="well">
				<dl class="dl-horizontal">
					<label>URL</label>
					<p> <a href="{{ url('article/'.$post->slug) }}">{{ url('article/'.$post->slug) }}</a> </p>
				</dl>
				<dl class="dl-horizontal">
					<label>Created at</label>
					<p>{{ date('F d, Y h:i A', strtotime($post->created_at))}}</p>
				</dl>
				<dl class="dl-horizontal">
					<label>Last updated</label>
					<p>{{ date('F d, Y h:i A', strtotime($post->updated_at))}}</p>
				</dl>
				<hr>
				<div class="row">
					<div class="col-sm-6">
						{!! Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class'=>'btn btn-danger btn-block')) !!}
						
					</div>
					<div class="col-sm-6">
						{{ Form::submit('Save Changes', ['class'=>'btn btn-success btn-block']) }}
						
					</div>
				</div>
			</div>
		</div>
		{!! Form::close() !!}
	</div>



@endsection

@section('script')
	{!!Html::script('js/parsley.min.js')!!}
@endsection
