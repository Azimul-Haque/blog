@extends('main')

@section('title', 'Blog | Edit Post')
@section('stylesheet')
	{!!Html::style('css/parsley.css')!!}
	{!!Html::style('css/select2.min.css')!!}
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	 <script>
	 	tinymce.init({
			  selector: 'textarea',
			  plugins: [
			    'advlist autolink lists link image charmap print preview anchor',
			    'searchreplace visualblocks code fullscreen',
			    'insertdatetime media table contextmenu paste code'
			  ],
			  toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image table code preview',
			  menubar: 'file edit insert view ',
			  content_css: '//www.tinymce.com/css/codepen.min.css',
			  image_class_list: [
			    {title: 'Responsive', value: 'img-responsive'}
			  ],
     		  image_dimensions: false,
		});
	 </script>	
@endsection

@section('content')

	<div class="row">
		<div class="col-md-8">
			{!! Form::model($post, ['route' => ['posts.update', $post->id], 'data-parsley-validate' => '', 'method'=>'PUT']) !!}

				{{ Form::label('title', 'Title') }}
				{{ Form::text('title', null, ['class'=>'form-control input-lg postTitle', 'required' => '']) }}

				{!! Form::label('slug', 'Slug:', ['class'=>'form-spacing-top']) !!}
			 	{!! Form::text('slug', null, array('class' => 'form-control postSlug', 'required' => '', 'minlength' => '5', 'maxlength' => '255')) !!}

			 	{{ Form::label('category_id', 'Category', ['class'=>'form-spacing-top']) }}
			 	{{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}

			 	{!! Form::label('tags', 'Tags:', array('class' => 'form-spacing-top')) !!}
			 	{{ Form::select('tags[]', $tags, null, ['class' => 'form-control select2-multi', 'multiple' => 'multiple', 'required' => '']) }}

				{{ Form::label('body', 'Body', ['class'=>'form-spacing-top']) }}
				{{ Form::textarea('body', null,['class'=>'form-control postBody', 'minlength' => '100']) }}
			
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
	{!!Html::script('js/select2.min.js')!!}
	<script type="text/javascript">
		$(".select2-multi").select2(
			{maximumSelectionLength: 5
		}).val({!! json_encode($post->tags()->getRelatedIds()) !!}).trigger('change')
	</script>
@endsection
