@extends('dashboard')

@section('title')
	ব্লগ | চিরকুট ({{ $messages->count() }})
@endsection
@section('stylesheet')
  {!!Html::style('css/parsley.css')!!}
  {!!Html::style('css/emojionearea.min.css')!!}
@endsection

@section('content')

	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-success">
				<div class="panel-heading">
				<span style="font-size: 20px;"><b>{{ $otherone->name }}-এর সাথে আপনার চিরকুটগুলো</b></span>
				</div>
				<div class="panel-body tab-pane-conversation" id="tab-pane-conversation">
					@foreach($messages as $message)
						@foreach($users as $user)
							@if($user->id == $message->from_id)
						<div class="row" >	
							<div class="col-md-12">
							@if($user->id == $otherone->id)
							<span style="float: left;">
								<span style="color: #3c763d;">{{ $user->name }}
								</span> <small style="color: #8BC34A;"><i class="fa fa-clock-o" aria-hidden="true"></i> {{ date('M d, h:i a', strtotime($message->created_at))}}</small></span> 
							@elseif($user->id == Auth::user()->id)
							<span style="float: right;">
								<small style="color: #8BC34A;"><i class="fa fa-clock-o" aria-hidden="true"></i> {{ date('M d, h:i a', strtotime($message->created_at))}}</small> 
								<span style="color: #3c763d;">{{ $user->name }}</span></span>
							@endif
							<br/>

							@if($user->id == $otherone->id)
							<span style="float: left; display: inline-flex;">
                @if(!$otherone->image == NULL)
                  <img class="img-responsive img-circle" src="{{ asset('images/profilepicture/'.$otherone->image) }}" style="float: left; height: 50px; width: 50px; border: 2px solid lightgrey; margin-top: -3px; margin-right: 10px;">
                @else
                  <img class="img-responsive img-circle" src="{{ asset('images/profile.png') }}" style="float: left; height: 50px; width: 50px; border: 2px solid lightgrey; margin-top: -3px; margin-right: 10px;">
                @endif
								
								<i class="fa fa-caret-left" style="font-size:15px; color: #e3f2fd; margin-top: 5px;"></i><span class="conversationTexts" style="background-color: #e3f2fd ;">{{ $message->message }}
                 

              </span>
							</span>
							@elseif($user->id == Auth::user()->id)
							<span style="float: right; display: inline-flex;">
								<span class="conversationTexts" style="background-color: #f0f4c3;">{{ $message->message }}</span><i class="fa fa-caret-right" style="font-size:15px; color: #f0f4c3;  margin-top: 5px;"></i>
                @if(!Auth::user()->image == NULL)
                <img class="img-responsive img-circle" src="{{ asset('images/profilepicture/'.Auth::user()->image) }}" style="float: right; height: 50px; width: 50px; border: 2px solid lightgrey; margin-top: -3px; margin-left: 10px;">
                @else
                <img class="img-responsive img-circle" src="{{ asset('images/profile.png') }}" style="float: right; height: 50px; width: 50px; border: 2px solid lightgrey; margin-top: -3px; margin-left: 10px;">
                @endif
              </span>
							@endif	
							</div>
						</div>
							@endif
						@endforeach
					@endforeach
				</div>
              {!! Form::open(['route' => 'conversation.send', 'data-parsley-validate' => '', 'files' => 'true', 'enctype' => 'multipart/form-data', 'method' => 'POST']) !!}
                  {!! Form::hidden('to_id', $otherone->id) !!}
                  {!! Form::hidden('to_name', $otherone->name) !!}
                  {!! Form::hidden('to_email', $otherone->email) !!}
                  {!! Form::hidden('from_id', Auth::user()->id) !!}
                  {!! Form::hidden('from_name', Auth::user()->name) !!}
                  {!! Form::hidden('from_email', Auth::user()->email) !!}
                  {!! Form::textarea('message', null, array('class' => 'form-control', 'required' => '', 'data-parsley-required-message' => 'কিছু তো লিখুন', 'placeholder' => 'আপনার বার্তা লিখুন এবং নিচের সবুজ বাটনে ক্লিক করুন', 'rows' => '2', 'id' => 'message')) !!}
                  <div id="messagecontainer"></div>
                  <button type="submit" class="btn btn-success btn-block"><i class="fa fa-paper-plane" aria-hidden="true"></i> চিরকুট প্রেরণ করুন</button>
                 {!! Form::close() !!}  
			</div><br/>

                
		</div>

		<div class="col-md-4">
			<div class="panel">
           	  <div class="panel-body">
                  <center>
                    @if(!$otherone->image == NULL)
                    <img class="img-responsive img-circle" src="{{ asset('images/profilepicture/'.$otherone->image) }}" style="height: 100px; width: auto; border: 5px solid lightgrey;">
                    @else
                    <img class="img-responsive img-circle" src="{{ asset('images/profile.png') }}" style="height: 100px; width: auto; border: 5px solid lightgrey;">
                    @endif  
                  </center>
           	  	  <table class="table">
           	  	  	<thead>
           	  	  		<tr>
           	  	  			<th style="width: 30%">ব্লগারঃ</th>
           	  	  			<td>{{ $otherone->name }}</td>
           	  	  		</tr>
           	  	  		<tr>
           	  	  			<th>ফেইসবুক লিঙ্কঃ</th>
           	  	  			<td><a href="{{ $otherone->fb }}">ক্লিক করুন</a></td>
           	  	  		</tr>
           	  	  		<tr>
           	  	  			<th>আমার সম্পর্কেঃ</th>
           	  	  			<td style="word-wrap: break-word !important; white-space: pre-line; text-align: justify !important;">{{ $otherone->about }}</td>
           	  	  		</tr>
                      <tr>
                        <th>রক্তের গ্রুপঃ</th>
                        <td>{{ $otherone->blood_group }}</td>
                      </tr>
                      <tr>
                        <th>সর্বশেষ রক্তদানঃ</th>
                        <td>
                          @if($otherone->last_donated == NULL || $otherone->last_donated == '0000-00-00 00:00:00')
                          <span style="color: lightgrey">তথ্য নেই</span>
                          @else
                          {{ date('F d, Y', strtotime($otherone->last_donated))}} 
                          @endif
                        </td>
                      </tr>
                      @if($otherone->permanent_address_privacy == 'public')
                      <tr>
                        <th>স্থায়ী ঠিকানাঃ</th>
                        <td>
                          @if($otherone->permanent_upazila != '')
                          {{ $otherone->permanent_upazila }}, {{ $otherone->permanent_district }}
                          @else
                          {{ $otherone->permanent_district }}
                          @endif
                        </td>
                      </tr>
                      @else
                      
                      @endif
                      @if($otherone->present_address_privacy == 'public')
                      <tr>
                        <th>বর্তমান ঠিকানাঃ</th>
                        <td>
                          @if($otherone->present_upazila != '')
                          {{ $otherone->present_upazila }}, {{ $otherone->present_district }}
                          @else
                          {{ $otherone->present_district }}
                          @endif
                        </td>
                      </tr>
                      @else

                      @endif
                      <tr>
                        <th>ব্লগ লিখেছেনঃ</th>
                        <td>{{ $otheroneposts->count() }} টি</td>
                      </tr>
                      <tr>
                        <th>ব্লগে যোগদান করেছেনঃ</th>
                        <td>{{ $otherone->created_at->diffForHumans() }}</td>
                      </tr>
           	  	  	</thead>
           	  	  </table>
              </div>
          </div>
		</div>
	</div>

@stop

@section('script')
  {!!Html::script('js/parsley.min.js')!!}
  {!!Html::script('js/emojionearea.js')!!}

  <script type="text/javascript">
  	$(document).ready(function(){
      $('#tab-pane-conversation').scrollTop($('#tab-pane-conversation')[0].scrollHeight);
	});
  </script>

<script type="text/javascript">
  $(document).ready(function() {
    $("#message").emojioneArea({
      pickerPosition: "top",
      filtersPosition: "bottom",
      tonesStyle: "square"
    });
  });
</script>
@endsection
