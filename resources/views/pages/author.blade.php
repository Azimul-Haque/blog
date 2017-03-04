@extends('main')

@section('title', 'ব্লগ | ব্লগার পরিচিতি')

@section('stylesheet')
  {!!Html::style('css/parsley.css')!!}
  {!!Html::style('css/emojionearea.min.css')!!}
@endsection

@section('content')
      <div class="row">
        <div class="col-md-4">
          <div class="panel">
           	  <div class="panel-body">
                  <center>
                    @if(!$user->image == NULL)
                    <img class="img-responsive img-circle" src="{{ asset('images/profilepicture/'.$user->image) }}" style="height: 100px; width: auto; border: 5px solid lightgrey;">
                    @else
                    <img class="img-responsive img-circle" src="{{ asset('images/profile.png') }}" style="height: 100px; width: auto; border: 5px solid lightgrey;">
                    @endif  
                  </center>
           	  	  <table class="table">
           	  	  	<thead>
           	  	  		<tr>
           	  	  			<th style="width: 30%">ব্লগারঃ</th>
           	  	  			<td>{{ $user->name }}</td>
           	  	  		</tr>
           	  	  		<tr>
           	  	  			<th>ফেইসবুক লিঙ্কঃ</th>
           	  	  			<td><a href="{{ $user->fb }}" target="_blank">ক্লিক করুন</a></td>
           	  	  		</tr>
           	  	  		<tr>
           	  	  			<th>আমার সম্পর্কেঃ</th>
           	  	  			<td style="word-wrap: break-word !important; white-space: pre-line; text-align: justify !important;">{{ $user->about }}</td>
           	  	  		</tr>
                      <tr>
                        <th>রক্তের গ্রুপঃ</th>
                        <td>{{ $user->blood_group }}</td>
                      </tr>
                      <tr>
                        <th>সর্বশেষ রক্তদানঃ</th>
                        <td>
                          @if($user->last_donated == NULL || $user->last_donated == '0000-00-00 00:00:00')
                          <span style="color: lightgrey">তথ্য নেই</span>
                          @else
                          {{ date('F d, Y', strtotime($user->last_donated))}} 
                          @endif
                        </td>
                      </tr>
                      @if($user->permanent_address_privacy == 'public')
                      <tr>
                        <th>স্থায়ী ঠিকানাঃ</th>
                        <td>
                          @if($user->permanent_upazila != '')
                          {{ $user->permanent_upazila }}, {{ $user->permanent_district }}
                          @else
                          {{ $user->permanent_district }}
                          @endif
                        </td>
                      </tr>
                      @else
                      
                      @endif
                      @if($user->present_address_privacy == 'public')
                      <tr>
                        <th>বর্তমান ঠিকানাঃ</th>
                        <td>
                          @if($user->present_upazila != '')
                          {{ $user->present_upazila }}, {{ $user->present_district }}
                          @else
                          {{ $user->present_district }}
                          @endif
                        </td>
                      </tr>
                      @else

                      @endif
                      <tr>
                        <th>ব্লগ লিখেছেনঃ</th>
                        <td>{{ $posts->count() }} টি</td>
                      </tr>
                      <tr>
                        <th>ব্লগে যোগদান করেছেনঃ</th>
                        <td>{{ $user->created_at->diffForHumans() }}</td>
                      </tr>
           	  	  	</thead>
           	  	  </table>
                  @if(Auth::check())
                    <button data-toggle="collapse" data-target="#sendMessageCollapse" class="btn btn-info btn-block"><i class="fa fa-pencil" aria-hidden="true"></i> চিরকুট পাঠান</button>
                    <div id="sendMessageCollapse" class="collapse">
                      {!! Form::open(['route' => 'message.send', 'data-parsley-validate' => '', 'files' => 'true', 'enctype' => 'multipart/form-data', 'method' => 'POST']) !!}
                        {!! Form::hidden('to_id', $user->id) !!}
                        {!! Form::hidden('to_name', $user->name) !!}
                        {!! Form::hidden('to_email', $user->email) !!}
                        {!! Form::hidden('from_id', Auth::user()->id) !!}
                        {!! Form::hidden('from_name', Auth::user()->name) !!}
                        {!! Form::hidden('from_email', Auth::user()->email) !!}
                        {!! Form::textarea('message', null, array('class' => 'form-control', 'required' => '', 'data-parsley-required-message' => 'কিছু তো লিখুন', 'placeholder' => 'আপনার বার্তা লিখুন এবং নিচের সবুজ বাটনে ক্লিক করুন', 'rows' => '4', 'id' => 'message')) !!}
                        <button type="submit" class="btn btn-success btn-block"><i class="fa fa-paper-plane" aria-hidden="true"></i> চিরকুট প্রেরণ করুন</button>
                      {!! Form::close() !!}  
                    </div>
                  @else
                  <span>বার্তা পাঠাতে চাইলে লগইন করুন</span>
                  @endif
              </div>
          </div>
        </div>
      	<div class="col-md-8">
      		<h2>{{ $user->name }}-এর ব্লগগুলো...</h2>
      		  @foreach ($posts as $post)
	          <div class="post">
                <p class="postTitle mainBodyPostTitle">
                  <strong><a href="{{url('article/'.$post->slug)}}" class="postTitle">{{ $post->title }}</a></strong>
                  @if($post->featured == 'YES')
                    <small style="color: lightgrey; font-size: 18px;">নির্দেশিত প্রবন্ধ</small>
                  @endif
                </p>
	            <h5><strong>লিখেছেনঃ</strong> 
	            <?php
                    foreach ($users as $user) {
                        if($user->id == $post->postedBy){
                          $writtenBy = $user->name;
                        }
                    }
                ?>
	            <a href="{{url('/profile/'.$writtenBy)}}" class="">{{ $writtenBy }} </a> 

	            | <span> {{ date('F d, Y | h:i A', strtotime($post->created_at))}}
	            <i class="diffForHumans">{{ $post->created_at->diffForHumans() }}</i>
	            </span></h5>
	            <p class="postBody">

	            {!!strlen($post->body)>1200? substr($post->body, 0, strpos($post->body, " ", strpos(strip_tags($post->body), " ")+1150))." [...] " : $post->body!!}
	            <a href="{{ url('article/'.$post->slug) }}">বাকিটুকু পড়ুন</a>
	            </p>
	            <span><i class="fa fa-folder-open-o" aria-hidden="true"></i> বিষয়ঃ <a href="/category/{{$post->category->name}}/">{{ $post->category->name }}</a>
	              </span> | 
	              <span><i class="fa fa-tags" aria-hidden="true"></i> ট্যাগসমূহঃ 
	                <?php
	                  $labels = array('default','primary','success','info','warning','danger');
	                  $i = 1;
	                ?>
	                @foreach ($post->tags as $tag)
	                  <a class="label label-{{$labels[$i]}}" href="/tag/{{$tag->name}}">{{ $tag->name }} 
	                    </a>
	                  <?php $i++?>
	                @endforeach 
	                 <span style="margin-left: 5px;">[ <i class="fa fa-eye" aria-hidden="true"></i> {{ $post->hits }} ]</span>
	                 <span style="margin-left: 5px;">[ <i class="fa fa-comments" aria-hidden="true"></i> <?php $total = 0?>
                    @foreach($post->comments as $comment)
                      <?php
                        $total = $total + $comment->commentreplies->count();
                      ?>
                    @endforeach
                    {{ $post->comments()->count() + $total }} 

                    ]</span>
	              </span>
	           	 <hr>
	          </div>
      		  @endforeach
      	</div>	
      </div>
@endsection

@section('script')
  {!!Html::script('js/parsley.min.js')!!}
  {!!Html::script('js/emojionearea.js')!!}
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