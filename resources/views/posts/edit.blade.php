@extends('dashboard')

@section('title', 'ব্লগ | ব্লগ সম্পাদনা')
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

				{{ Form::label('title', 'শিরোনামঃ') }}
				{{ Form::text('title', null, ['class'=>'form-control input-lg postTitle', 'required' => '']) }}

				<label for="slug" class="form-spacing-top">পার্মালিংকঃ  
			 	<a href="#!" data-toggle="tooltip" title="ব্লগের ঠিকানা সামঞ্জস্যপূর্ণ করা যায়। যেমনঃ www.example.com/আমার_প্রথম_পোস্ট_২০১৭. এখানে .com/ এর পরের অংশটি হল পার্মালিংক।" data-placement="top"><i class="fa fa-question-circle" aria-hidden="true"></i></a></label>	
			 	{!! Form::text('slug', null, array('class' => 'form-control postSlug', 'required' => '', 'minlength' => '5', 'maxlength' => '255')) !!}

			 	{{ Form::label('category_id', 'বিষয়ঃ', ['class'=>'form-spacing-top']) }}
			 	{{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}

			 	{!! Form::label('tags', 'ট্যাগসমূহঃ', array('class' => 'form-spacing-top')) !!}
			 	{{ Form::select('tags[]', $tags, null, ['class' => 'form-control select2-multi', 'multiple' => 'multiple', 'required' => '']) }}

				{{ Form::label('body', 'মূল অংশঃ', ['class'=>'form-spacing-top']) }}
				{{ Form::textarea('body', null,['class'=>'form-control postBody', 'minlength' => '100']) }}
				<br/>
				@if ($post->isPublished == 'publish')
	                <label class="radio-inline">
	                	{{ Form::radio('isPublished', 'publish', true, ['checked' => 'checked']) }} প্রকাশিত
	                </label>
	                <label class="radio-inline">
	                	{{ Form::radio('isPublished', 'draft', false, ['class' => 'radio-inline']) }} ড্রাফট
	                 </label>	
	            @elseif ($post->isPublished == 'draft')
	            	<label class="radio-inline">
	                	{{ Form::radio('isPublished', 'publish', false, ['class' => 'radio-inline']) }} প্রকাশিত
	                </label>
	                <label class="radio-inline">
	                	{{ Form::radio('isPublished', 'draft', true, ['checked' => 'checked', 'class' => 'radio-inline']) }} ড্রাফট
	                 </label>
	            @endif<br/>
			
		</div><br/>
		<div class="col-md-4">
			<div class="well">
				<dl class="dl-horizontal">
					<label>URL</label>
					<p> <a style="word-wrap: break-word;" href="{{ url('article/'.$post->slug) }}">{{ url('article/'.$post->slug) }}</a> </p>
				</dl>
				<dl class="dl-horizontal">
					<label>প্রকাশের তারিখ</label>
					<p>{{ date('F d, Y h:i A', strtotime($post->created_at))}}</p>
				</dl>
				<dl class="dl-horizontal">
					<label>হালনাগাদের তারিখ</label>
					<p>{{ date('F d, Y h:i A', strtotime($post->updated_at))}}</p>
				</dl>
				<hr>
				<div class="row">
					<div class="col-sm-6">
						<a href="{{route('posts.show', $post->id)}}" class="btn btn-danger btn-block"><i class="fa fa-undo" aria-hidden="true"></i> বাতিল করুন</a>
						
					</div>
					<div class="col-sm-6">
						<button class="btn btn-success btn-block" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> সংরক্ষণ করুন</button>
						
					</div>
				</div>
			</div><br/>
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
	<script>
		$(document).ready(function(){
		    $('[data-toggle="tooltip"]').tooltip(); 
		});
	</script>
@endsection
