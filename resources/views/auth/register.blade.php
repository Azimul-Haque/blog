@extends('main')

@section('title', 'ব্লগ | নিবন্ধন')
@section('stylesheet')
	{!!Html::style('css/parsley.css')!!}
	{!!Html::style('css/dtpui.css')!!}
@endsection

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1><i class="fa fa-plus-square-o" aria-hidden="true"></i> নিবন্ধন করুন</h1>
			<hr>
			* দয়া করে <a href="{{ url('about#conditions') }}">ব্লগের শর্তাবলী</a> দেখে আসুন।<br/>
			* দয়া করে একটি সক্রিয় ইমেইল এড্রেস প্রদান করুন। একাউন্ট সংক্রান্ত তথ্য এই ইমেইলে পাঠানো হবে। <br/> 
			* রক্তদানে আগ্রহী হলে একটি ভ্যালিড ফোন/ মোবাইল নম্বর প্রদান করুন।
			
			<div class="panel">
				<div class="panel-body">
					{!! Form::open(['data-parsley-validate' => '']) !!}
						<div class="row">
							<div class="col-md-6">
					 		{!! Form::label('name', 'নামঃ বাংলায় (ব্লগ নিক)') !!}
					 		{!! Form::text('name', null, array('class' => 'form-control', 'required' => '', 'data-parsley-required-message' => 'আপনার নামটি লিখুন', 'data-parsley-pattern' => '[^a-zA-Z0-9]+', 'data-parsley-pattern-message' => '*বাংলা বর্ণমালা* প্রদান করুন' )) !!}
					 		
					 		{!! Form::hidden('role', 'blogger') !!}
							</div>

							<div class="col-md-6">
					 		{!! Form::label('email', 'ইমেইল ঠিকানাঃ', array('class' => '')) !!}
					 		{!! Form::email('email', null, array('class' => 'form-control', 'required' => '', 'data-parsley-required-message' => 'আপনার ইমেইল এড্রেস দিন')) !!}
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
					 		{!! Form::label('phone', 'ফোন/ মোবাইল নম্বরঃ', array('class' => '')) !!}
					 		{!! Form::text('phone', null, array('class' => 'form-control', 'required' => '', 'data-parsley-required-message' => 'যোগাযোগের নম্বরটি দিন')) !!}
							</div>

							<div class="col-md-6">
					 		{!! Form::label('fb', 'ফেইসবুক ঠিকানাঃ (ঐচ্ছিক)', array('class' => '')) !!}
					 		{!! Form::text('fb', null, array('class' => 'form-control', 'placeholder' => 'যেমনঃ www.facebook.com/humansofthakurgaon')) !!}
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
					 		{!! Form::label('blood_group', 'রক্তের গ্রুপঃ', array('class' => '')) !!}
					 		{!! Form::select('blood_group', [
							   '' => 'রক্তের গ্রুপ নির্ধারণ করুন',
							   'A+' => 'এ পজিটিভ',
							   'A-' => 'এ নেগেটিভ',
							   'B+' => 'বি পজিটিভ',
							   'B-' => 'বি নেগেটিভ',
							   'AB+' => 'এবি পজিটিভ',
							   'AB-' => 'এবি নেগেটিভ',
							   'O+' => 'ও পজিটিভ',
							   'O-' => 'ও নেগেটিভ',
							   'N/A' => 'রক্তের গ্রুপ জানা নেই'], null, array('class' => 'form-control', 'required' => '', 'data-parsley-required-message' => 'রক্তের গ্রুপ নির্ধারণ করুন' )) !!}
							</div>

							<div class="col-md-6">
					 		{!! Form::label('last_donated', 'শেষ কবে রক্ত দিয়েছেন', array('class' => '')) !!}
					 		{!! Form::text('last_donated', null, array('class' => 'form-control', 'placeholder' => 'কখনও না দিলে ফাঁকা রাখুন', 'autocomplete' => 'off')) !!}
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
							{!! Form::label('about', 'আপনার সম্পর্কেঃ', array('class' => '')) !!}
					 		{!! Form::textarea('about', null, array('class' => 'form-control', 'required' => '', 'minlength' => '100', 'data-parsley-required-message' => 'আপনার সম্পর্কে কিছু তো বলুন', 'rows' => '3')) !!}	
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
							{!! Form::label('password', 'পাসওয়ার্ড', array('class' => 'form-spacing-top')) !!}
					 		{!! Form::password('password', array('class' => 'form-control' , 'required' => '', 'minlength' => '6', 'data-parsley-required-message' => 'পাসওয়ার্ড দিন')) !!}	
							</div>

							<div class="col-md-6">
							{!! Form::label('password_confirmation', 'Confirm Password:', array('class' => 'form-spacing-top')) !!}
					 		{!! Form::password('password_confirmation', array('class' => 'form-control' , 'required' => '', 'data-parsley-equalto' => '#password', 'data-parsley-required-message' => 'পাসওয়ার্ড আবার লিখুন')) !!}
							</div>
						</div>

						<br/>
						<div class="row">
						  <div class="col-md-12">
						  	<label>ক্যাপচা</label>
							  	<div class="row">
							  		<div class="col-md-12">
							  			{!! app('captcha')->display(); !!}
							  		</div>
							  	</div>
						  </div>
						</div>

						<div class="row">
							<div class="col-md-12">
							{!! Form::submit('সংরক্ষণ করুন', array('class' => 'btn btn-primary btn-block', 'style' => 'margin-top:20px;')) !!}	
							</div>
						</div>				 	
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>

@endsection

@section('script')
	{!!Html::script('js/parsley.min.js')!!}
	{!!Html::script('js/dtpui.js')!!}
	    <script>
			$(function() {
				$('#last_donated').datepicker({
			        dateFormat: 'yy-mm-dd',
			        onSelect: function(datetext){
			            var d = new Date(); // for now
			            var h = d.getHours();
			        		h = (h < 10) ? ("0" + h) : h ;

			        		var m = d.getMinutes();
			            m = (m < 10) ? ("0" + m) : m ;

			            var s = d.getSeconds();
			            s = (s < 10) ? ("0" + s) : s ;

			        		datetext = datetext + " " + h + ":" + m + ":" + s;
			            $('#last_donated').val(datetext);
			        },
			    });
			}); 
	    </script>
@endsection
