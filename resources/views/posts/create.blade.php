@extends('main')

@section('title', 'Blog | Create New Post')
@section('stylesheet')
	{!!Html::style('css/styles.css')!!}
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
		<div class="col-md-8 col-md-offset-2">
			<h1>Create New Post</h1>
			<hr>
			{!! Form::open(['route' => 'posts.store', 'data-parsley-validate' => '', 'files' => 'true', 'enctype' => 'multipart/form-data', 'method' => 'POST']) !!}
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
			 	
				{!! Form::label('featured_image', 'Upload Image: (within 300KB)', ['class' => 'form-spacing-top']) !!}
				{!! Form::file('featured_image', ['data-parsley-filemaxmegabytes' => '10', 'data-parsley-trigger' => 'change', 'data-parsley-filemimetypes' => 'image/jpeg, image/png']) !!}
				
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
	<script type="text/javascript">
		var app = app || {};

// Utils
(function ($, app) {
    'use strict';

    app.utils = {};

    app.utils.formDataSuppoerted = (function () {
        return !!('FormData' in window);
    }());

}(jQuery, app));

// Parsley validators
(function ($, app) {
    'use strict';

    window.Parsley
        .addValidator('filemaxmegabytes', {
            requirementType: 'string',
            validateString: function (value, requirement, parsleyInstance) {

                if (!app.utils.formDataSuppoerted) {
                    return true;
                }

                var file = parsleyInstance.$element[0].files;
                var maxBytes = requirement * 1048576;

                if (file.length == 0) {
                    return true;
                }

                return file.length === 1 && file[0].size <= maxBytes;

            },
            messages: {
                en: 'File is to big (Select a photo within 300KB)'
            }
        })
        .addValidator('filemimetypes', {
            requirementType: 'string',
            validateString: function (value, requirement, parsleyInstance) {

                if (!app.utils.formDataSuppoerted) {
                    return true;
                }

                var file = parsleyInstance.$element[0].files;

                if (file.length == 0) {
                    return true;
                }

                var allowedMimeTypes = requirement.replace(/\s/g, "").split(',');
                return allowedMimeTypes.indexOf(file[0].type) !== -1;

            },
            messages: {
                en: 'File mime type not allowed'
            }
        });

}(jQuery, app));


// Parsley Init
(function ($, app) {
    'use strict';

    $('#js-file-validation-example').parsley();

}(jQuery, app));

	</script>
@endsection
