@extends('main')

@section('title', 'Blog | Create New Post')
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
			  content_css: '//www.tinymce.com/css/codepen.min.css'
		});
	 </script>
@endsection

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Create New Post</h1>
			<hr>
			{!! Form::open(['route' => 'posts.store', 'data-parsley-validate' => '']) !!}
			 	{!! Form::label('title', 'Title:') !!}
			 	{!! Form::text('title', null, array('class' => 'form-control', 'required' => '')) !!}

			 	{!! Form::label('slug', 'Slug:', array('class' => 'form-spacing-top')) !!}
			 	{!! Form::text('slug', null, array('class' => 'form-control', 'required' => '', 'minlength' => '5', 'maxlength' => '255')) !!}
			 	
			 	{!! Form::label('category_id', 'Category:', array('class' => 'form-spacing-top')) !!}
			 	<select class="form-control" name="category_id" required="">
			 			<option value="" selected="" disabled="">বিষয় নির্বাচন করুন</option>
			 		@foreach($categories as $category)
						<option value="{{ $category->id }}">{{ $category->name }}</option>
					@endforeach
			 	</select>

			 	{!! Form::label('tags', 'Tags:', array('class' => 'form-spacing-top')) !!}
			 	<select class="form-control select2-multi" name="tags[]" multiple="multiple" required="">
			 		@foreach($tags as $tag)
						<option value="{{ $tag->id }}">{{ $tag->name }}</option>
					@endforeach
			 	</select>
			 	
			 	{!! Form::label('body', 'Body:', array('class' => 'form-spacing-top')) !!}
			 	{!! Form::textarea('body', null, array('class' => 'form-control')) !!}

			 	{!! Form::submit('Create Post', array('class' => 'btn btn-success btn-block', 'style' => 'margin-top:20px;')) !!}
			{!! Form::close() !!}
		</div>
	</div>

@endsection

@section('script')
	{!!Html::script('js/parsley.min.js')!!}
	{!!Html::script('js/select2.min.js')!!}
	<script type="text/javascript">
		$(".select2-multi").select2({
		  maximumSelectionLength: 5
		});
	</script>
@endsection
