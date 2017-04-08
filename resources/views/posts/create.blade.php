@extends('dashboard')

@section('title', 'ব্লগ | নতুন ব্লগ')
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
     		  extended_valid_elements : 'iframe[src|frameborder|style|scrolling|class|width|height|n
     		  ame|align|allowfullscreen]', 
		});
	 </script>
@endsection

@section('content')

	<div class="row">
		<div class="col-md-8">
			<h1>নতুন ব্লগ লিখুন</h1>
			<hr>
			{!! Form::open(['route' => 'posts.store', 'data-parsley-validate' => '', 'files' => 'true', 'enctype' => 'multipart/form-data', 'method' => 'POST']) !!}
			 	{!! Form::label('title', 'শিরোনামঃ') !!}
			 	{!! Form::text('title', null, array('class' => 'form-control', 'required' => '')) !!}

			 	<label for="slug" class="form-spacing-top">পার্মালিংকঃ  
			 	<a href="#!" data-toggle="tooltip" title="ব্লগের ঠিকানা সামঞ্জস্যপূর্ণ করা যায়। যেমনঃ www.example.com/আমার_প্রথম_পোস্ট_২০১৭. এখানে .com/ এর পরের অংশটি হল পার্মালিংক।" data-placement="top"><i class="fa fa-question-circle" aria-hidden="true"></i></a></label>	
			 	{!! Form::text('slug', Auth::user()->id.'_blog_'.date('Y_m_d_h_i_s'), array('class' => 'form-control', 'required' => '', 'minlength' => '5', 'maxlength' => '255')) !!}
			 	
			 	{!! Form::label('category_id', 'বিষয়ঃ', array('class' => 'form-spacing-top')) !!}
			 	<select class="form-control" name="category_id" required="">
			 			<option value="" selected="" disabled="">বিষয় নির্বাচন করুন</option>
			 		@foreach($categories as $category)
						<option value="{{ $category->id }}">{{ $category->name }}</option>
					@endforeach
			 	</select>

			 	{!! Form::label('tags', 'ট্যাগসমূহঃ', array('class' => 'form-spacing-top')) !!}
			 	<select class="form-control select2-multi" name="tags[]" multiple="multiple" required="">
			 		@foreach($tags as $tag)
						<option value="{{ $tag->id }}">{{ $tag->name }}</option>
					@endforeach
			 	</select>
			 	
				{{-- {!! Form::label('featured_image', 'Upload Image: (within 300KB)', ['class' => 'form-spacing-top']) !!}
				{!! Form::file('featured_image', ['data-parsley-filemaxmegabytes' => '0.3', 'data-parsley-trigger' => 'change', 'data-parsley-filemimetypes' => 'image/jpeg, image/png']) !!} --}}
				
			 	{!! Form::label('body', 'মূল অংশঃ', array('class' => 'form-spacing-top')) !!}
			 	{!! Form::textarea('body', null, array('class' => 'form-control','minlength' => '100')) !!}
			 	<br/>
				<label class="radio-inline"><input type="radio" name="isPublished" value="publish" checked="true">প্রকাশ করুন</label>
				<label class="radio-inline"><input type="radio" name="isPublished" value="draft">ড্রাফট করুন</label>
			 	{!! Form::submit('সংরক্ষণ করুন', array('class' => 'btn btn-success btn-block', 'style' => 'margin-top:20px;')) !!}
			{!! Form::close() !!}
		</div>
		<div class="col-md-4">
			<div class="well">
				Youtube ভিডিও যোগ করবার জন্যঃ <br/>
				মূল অংশ-এর &lt;&gt; (Source code ) বাটনে ক্লিক করে HTML-এর iframe অ্যাট্রিবিউট ব্যবহার করে ইউটউব ভিডিও যোগ করুন। কোড ফরম্যাটটি হবে এরকমঃ <br/><br/>
				<div class="panel">
					<div  class="panel-body" style="font-family: courier !important; word-wrap: break-word !important;">
						&lt;div class="youtibecontainer"&gt;<br/>
							&lt;iframe src="https://www.youtube.com/embed/1234...90" frameborder="0" class="youtubeiframe"&gt;&lt;/iframe&gt;<br/>
						&lt;/div&gt;
					</div>
				</div>
			</div>
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

	<script>
		$(document).ready(function(){
		    $('[data-toggle="tooltip"]').tooltip(); 
		});
	</script>
@endsection
