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
				{{ Form::text('title', null, ['class'=>'form-control input-lg', 'required' => '']) }}

				{{ Form::label('body', 'Body', ['class'=>'form-spacing-top']) }}
				{{ Form::textarea('body', null,['class'=>'form-control', 'required' => '']) }}
			
		</div>
		<div class="col-md-4">
			<div class="well">
				<dl class="dl-horizontal">
					<dt>Created at</dt>
					<dd>{{ date('F d, Y h:i A', strtotime($post->created_at))}}</dd>
				</dl>
				<dl class="dl-horizontal">
					<dt>Last updated</dt>
					<dd>{{ date('F d, Y h:i A', strtotime($post->updated_at))}}</dd>
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
	<p>Test Test</p>



@endsection

@section('script')
	{!!Html::script('js/parsley.min.js')!!}
@endsection
