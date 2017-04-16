@extends('main')

<?php $titleTag = htmlspecialchars($post->title); ?>
@section('title', "ব্লগ | $titleTag")
@section('stylesheet')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	{!!Html::style('')!!}
	{!!Html::style('css/parsley.css')!!}
	{!!Html::style('css/emojionearea.min.css')!!}
	<style type="text/css">
		 @media print {
		  body * {
		    visibility: hidden;
		  }
		  #forPrintPurpose, #forPrintPurpose *, .banner {
		    visibility: visible;
		  }
		  #btnPrint{
		  	visibility: hidden;
		  }
		  #forPrintPurpose {
		    position: absolute;
		    /* left: 0;
		    top: 0; */
		  }
		  a:link:after, a:visited:after {
		    content: '' !important;
		  }
		  .shareUL, .fb-share-button {
		  	visibility: hidden !important;
		  }
		} 
	</style>
	<?php
	    foreach ($users as $user) {
	    	if($user->id == $post->postedBy){
	            $writtenBy = $user->name;
	        }
	    }
	?>
	<meta property="og:title" content="{{ $post->title.' | লিখেছেনঃ '.$writtenBy }}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="{{ url('article/'.$post->slug) }}"/>
    <?php
	    foreach ($users as $user) {
	    	if($user->id == $post->postedBy){
	            if($user->image == NULL) {
	            	$image = 'images/profile.png';
	            }else {
	            	$image = 'images/profilepicture/'.$user->image;
	            }
	        }
	    }
	?>
    <meta property="og:image" content="{{ asset($image) }}"/>
    <meta property="og:site_name" content="ব্লগ | হিউম্যানস অব ঠাকুরগাঁও"/>
	<meta property="fb:admins" content="orbachinujbuk"/>
	<meta property="fb:app_id" content="540030616188468"/>
	<meta property="fb:pages" content="humansofthakurgaon" /> 
	<meta property="og:image:width" content="255">
	<meta property="og:image:height" content="255">
    <meta name="description" property="og:description" content="{{ strip_tags($post->body) }}"/>
    <link rel="canonical"  href="{{ url('article/'.$post->slug) }}">
@endsection

@section('content')

	<div class="row">	
	        <div class="col-md-6 col-md-push-3">
	        	<div id="forPrintPurpose">
	        	{{-- @if(!$post->image== NULL)
					<img class="img-responsive" src="{{ asset('images/'. $post->image) }}">
				@endif --}}
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
				<a href="{{url('profile/'.$writtenBy)}}" class="">{{ $writtenBy }} </a>
				<span>
                  <i class="fa fa-calendar" aria-hidden="true"></i> {{ bn_date(date('F d, Y', strtotime($post->created_at)))}}
                  <i class="fa fa-clock-o" aria-hidden="true"></i> {{ bn_date(date('h:i a', strtotime($post->created_at)))}}
                  <span class="diffForHumans">{{ bn_date($post->created_at->diffForHumans()) }}</span>
                </span></h5>
				<span class="postBody">
					{!! $post->body!!} 
				</span><br/>
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
	               <span style="margin-left: 5px;">[ <i class="fa fa-eye" aria-hidden="true"></i> {{ bn_date($post->hits) }} ]</span>
	               <span style="margin-left: 5px;">[ <i class="fa fa-comments" aria-hidden="true"></i> 
						<?php $total = 0?>
						@foreach($post->comments as $comment)
							<?php
								$total = $total + $comment->commentreplies->count();
							?>
						@endforeach
						{{ bn_date($post->comments()->count() + $total) }}
	               		]
	               	</span>
	            </span> 
				<span><button id="btnPrint" class="btn btn-xs btn-default"><i class="fa fa-print" aria-hidden="true"></i></button></span>
	            <br/>	
	        	</div>

	            {{--fb, google+, twitter share links--}}
	            <?php
					$hrefShare = "blog.humansofthakurgaon.org/article/".$post->slug;
					$url = "http://blog.humansofthakurgaon.org/article/".$post->slug;
					$shareLink = "www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fblog.humansofthakurgaon.org%3B8000%2Farticle%2F".$post->slug."&amp;src=sdkpreparse
						";
				?>
	            <ul class="shareUL">
	            	<li class="shareLI"><span><i class="fa fa-share-alt" aria-hidden="true"></i> শেয়ার করুনঃ</span></li>
	            	<li><div class='fb-share-button shareLI' data-href='http://{{ $hrefShare }}' data-layout='button' data-size='small' data-mobile-iframe='true'><a class='fb-xfbml-parse-ignore' target='_blank' href='http://{{ $shareLink }}' style="margin-top: -20px !important;">Share</a></div></li>
	            	<li class="shareLI">
	            		<div class='g-plus shareLI' data-action='share' data-annotation='none' data-href='http://{{ $hrefShare }}' style="margin-top: -20px !important;"></div>
	            	</li>
	            	<li><iframe class='shareLI'
										src='https://platform.twitter.com/widgets/tweet_button.html?size=0&url={{urlencode($url)}}&via=humansoftkg&related=twitterapi%2Ctwitter&text=Blog%3A&hashtags=Blog%20%7C%20Humans%20of%20Thakurgaon'
										title='Twitter Tweet Button'
										style='border: 0; overflow: hidden;' width="90" height="34" frameborder="none">
									</iframe>
					</li>
	            </ul>
	            {{--fb, google+, twitter share links--}}


		    <div class="row ">
				<div class="col-md-12 form-spacing-top">
					<h2 class="comments-title" style="border-bottom: 1px solid #a1887f;"><i class="fa fa-comments" aria-hidden="true"></i> 
						<?php $total = 0?>
						@foreach($post->comments as $comment)
							<?php
								$total = $total + $comment->commentreplies->count();
							?>
						@endforeach
						{{ bn_date($post->comments()->count() + $total) }}
						টি মন্তব্য ও প্রতিমন্তব্য
					</h2>
					<?php $commentNum = 0; ?>
					@foreach($post->comments as $comment)
					<?php $commentNum++; ?>
						<div class="comment">
								@foreach($users as $user)
									@if($comment->email == $user->email)
									<div class="author-info">
										@if(!$user->image == NULL)
							                <img class="img-responsive img-circle author-image" src="{{ asset('images/profilepicture/'.$user->image) }}">
							            @else
							                <img class="img-responsive img-circle author-image" src="{{ asset('images/profile.png') }}">
							            @endif
										<div class="author-name">
										<h4><a href="{{ url('profile/'.$user->name) }}">{{ $user->name }}</a></h4>
										
										<span class="author-time">{{ date('F d, Y h:i A', strtotime($comment->created_at)) }}
										, <span class="diffForHumans">{{ bn_date($comment->created_at->diffForHumans()) }}</span>
										
										@if(Auth::check())
										@if($comment->email == Auth::user()->email)
											{{-- <button style="float: right; margin-left: 4px;" class="btn btn-xs btn-default editCommentBtn" id="deleteCommentBtn{{$commentNum}}"><i class="fa fa-trash-o" aria-hidden="true"></i> </button>  --}}
											<button style="float: right; margin-left: 4px;" class="btn btn-xs btn-default" id="editCommentBtn{{$commentNum}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> 
										@endif
										@endif

										</span>
										</div>
									</div>
									<div class="comment-content" id="commentText{{$commentNum}}">{{ $comment->comment }}
									</div>
									{{ Form::open(['route' => ['comments.update', $comment->id], 'method' => 'PATCH', 'data-parsley-validate' => '', 'id' => 'editCommentForm'.$commentNum, 'class' => 'comment-content']) }}

										{{ Form::textarea('comment', $comment->comment, ['class' => 'form-control',  'rows' => '3', 'required' => '', 'data-parsley-required-message' => 'কিছু তো মন্তব্যে লিখুন!', 'placeholder' => 'প্রতিমন্তব্য লিখুন', 'id' => 'commentEdit'.$commentNum]) }}
										{{ Form::submit('হালনাগাদ ও প্রকাশ করুন', ['class' => 'btn btn-success btn-sm btn-block']) }}
									{{ Form::close() }}

									<script type="text/javascript">
										$("#editCommentForm{{$commentNum}}").hide();
										$("#editCommentBtn{{$commentNum}}").click(function() {
											$("#editCommentForm{{$commentNum}}").show();
											$("#commentText{{$commentNum}}").hide();
										});
									</script>
									@endif
								@endforeach

						{{-- comment reply --}}
						{{-- post the replies --}}
						@if(Auth::check())
								<div class="row">
									<div class="col-md-12">
										<small style="float: right;">
											<button class="btn btn-success btn-xs" data-toggle="collapse" data-target="#reply{{$comment->id}}">প্রতিমন্তব্য</button>
										</small>
									</div>
								</div>
								<div id="reply{{$comment->id}}" class="collapse" style="padding-left: 65px !important;"><br/>
									{{ Form::open(['route' => ['commentreplies.store', $comment->id], 'method' => 'POST', 'data-parsley-validate' => '']) }}

										<input type="hidden" name="email" value="{{ Auth::user()->email }}">
										{{ Form::textarea('commentreply', null, ['class' => 'form-control',  'rows' => '3', 'required' => '', 'data-parsley-required-message' => 'কিছু তো মন্তব্যে লিখুন!', 'id' => 'comment'.$commentNum, 'placeholder' => 'প্রতিমন্তব্য লিখুন']) }}
										{{ Form::submit('সংরক্ষণ ও প্রকাশ করুন', ['class' => 'btn btn-success btn-sm btn-block']) }}
									{{ Form::close() }}
								</div>
						@else
						<small style="float: right;">
								<a  href="{{ url('login') }}">প্রতিমন্তব্য (লগইন)</a >
						</small>
						@endif
						{{-- post the replies --}}	
						
						{{-- print the replies --}}
						@foreach($comment->commentreplies as $commentreply)
							@foreach($users as $user)
								@if($commentreply->email === $user->email)
									<div style="padding-left: 65px !important;"><hr>
										<div class="author-info">
											@if(!$user->image == NULL)
									            <img class="img-responsive img-circle replier-image" src="{{ asset('images/profilepicture/'.$user->image) }}">
									        @else
									            <img class="img-responsive img-circle replier-image" src="{{ asset('images/profile.png') }}">
									        @endif
												<div class="replier-name">
													<span class="replier-just-name"><a href="{{ url('profile/'.$user->name) }}">{{ $user->name }}</a></span><br>
													<span class="replier-time">{{ date('M d, Y h:i A', strtotime($commentreply->created_at)) }}
													, <span clspanass="diffForHumans">{{ bn_date($commentreply->created_at->diffForHumans()) }}</span>
													@if(Auth::check())
													@if($commentreply->email == Auth::user()->email)
														{{-- <button style="float: right; margin-left: 4px;" class="btn btn-xs btn-default editCommentBtn" id="deleteCommentReplyBtn{{$commentreply->id}}"><i class="fa fa-trash-o" aria-hidden="true"></i> </button>  --}}
														<button style="float: right; margin-left: 4px;" class="btn btn-xs btn-default" id="editCommentReplyBtn{{$commentreply->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> 
													@endif
													@endif
													</span>
												</div>
										</div>
										<div class="reply-content" id="commentReplyText{{$commentreply->id}}">{{ $commentreply->commentreply }}</div>

										{{ Form::open(['route' => ['commentreplies.update', $commentreply->id], 'method' => 'PATCH', 'data-parsley-validate' => '', 'id' => 'editCommentReplyForm'.$commentreply->id, 'class' => 'reply-content']) }}

											{{ Form::textarea('commentreply', $commentreply->commentreply, ['class' => 'form-control',  'rows' => '3', 'required' => '', 'data-parsley-required-message' => 'কিছু তো মন্তব্যে লিখুন!', 'placeholder' => 'প্রতিমন্তব্য লিখুন', 'id' => 'replyEdit'.$commentreply->id]) }}
											{{ Form::submit('হালনাগাদ ও প্রকাশ করুন', ['class' => 'btn btn-success btn-sm btn-block']) }}
										{{ Form::close() }}

										<script type="text/javascript">
											$("#editCommentReplyForm{{$commentreply->id}}").hide();
											$("#editCommentReplyBtn{{$commentreply->id}}").click(function() {
												$("#editCommentReplyForm{{$commentreply->id}}").show();
												$("#commentReplyText{{$commentreply->id}}").hide();
											});
										</script>
									</div>
								@endif
							@endforeach
						@endforeach	
						{{-- print the replies --}}
						{{-- comment reply --}}

						</div><hr>
					@endforeach
				</div>
			</div>

			<div class="row ">
				<div class="col-md-12 form-spacing-top" id="comment-form">
				<h2 style="border-bottom: 1px solid #a1887f;">মন্তব্য করুন</h2>
					{{ Form::open(['route' => ['comments.store', $post->id], 'method' => 'POST', 'data-parsley-validate' => '']) }}
					<div class="row">
						@if(Auth::check())
							<div class="col-md-12">
								<h3>
									@if(!Auth::user()->image == NULL)
					                  <img class="img-responsive img-circle commentor-image" src="{{ asset('images/profilepicture/'.Auth::user()->image) }}">
					                @else
					                  <img class="img-responsive img-circle commentor-image" src="{{ asset('images/profile.png') }}">
					                @endif
									{{ Auth::user()->name }}
								</h3>
								<input type="hidden" name="name" value="{{ Auth::user()->name }} &#x2611;">
								<input type="hidden" name="email" value="{{ Auth::user()->email }}">
							</div>
						<div class="col-md-12">
							{{ Form::label('comment', 'মন্তব্যঃ', ['class' => 'form-spacing-top']) }}
							{{ Form::textarea('comment', null, ['class' => 'form-control',  'rows' => '5', 'required' => '', 'data-parsley-required-message' => 'কিছু তো মন্তব্যে লিখুন!', 'minlength' => '5', 'id' => 'comment']) }}

							{{ Form::submit('সংরক্ষণ ও প্রকাশ করুন', ['class' => 'btn btn-success btn-block form-spacing-top']) }}
						</div>	
						@else
						<div class="col-md-12">
							<strong>মন্তব্য করবার জন্য আপনাকে <a href="{{ url('login') }}">লগইন</a> করতে হবে।</strong>
						</div>
						@endif
						

						

					</div>
					{{ Form::close() }}
				</div>
			</div>   <br/>  


            
        </div>

        <div class="col-md-3 col-md-pull-6">
            <div class="panel" style="background: #6ED66E;">
              <div class="panel-body">
                <span style="font-size: 20px;"><b>ব্লগের তথ্য</b></span><br/>
                <a href="{{ url('bloggers/list') }}" class="faq"><span style="font-size: 16px;"><i class="fa fa-users" aria-hidden="true"></i> মোট ব্লগারঃ {{ bn_date($bloggers->id) }} জন </span></a><br/>
                <span style="font-size: 16px;"><i class="fa fa-clipboard" aria-hidden="true"></i> সর্বমোট ব্লগপোস্টঃ {{ bn_date($totalpost->id) }} টি</span><br/>
                <span style="font-size: 16px;"><i class="fa fa-commenting" aria-hidden="true"></i> সর্বমোট মন্তব্যঃ {{ bn_date($totalcomment->id + $totalcommentreply->id) }} টি</span>
              </div>
            </div>

            <div class="panel" style="background: #6ED66E;">
              <div class="panel-body">
                <span style="font-size: 20px;"><b>ব্লগ লিখতে চাইলে</b></span><br/>
                <a href="/about#faqs" class="faq"><span style="font-size: 16px;"><i class="fa fa-question-circle" aria-hidden="true"></i> সাধারণ প্রশ্নোত্তর</span></a><br/>
                <a href="/about#rules" class="faq"><span style="font-size: 16px;"><i class="fa fa-plug" aria-hidden="true"></i> ব্লগ ব্যাবহারের নিয়মাবলী</span></a><br/>
                <a href="/about#conditions" class="faq"><span style="font-size: 16px;"><i class="fa fa-gavel" aria-hidden="true"></i> ব্লগ ব্যবহারের শর্তাবলী</span></a>
              </div>
            </div>

            <div class="panel" style="background: #6ED66E;">
              <div class="panel-body">
                <span style="font-size: 20px;"><b>বার্তা</b></span><br/> 
                <a href="{{ url('/contact') }}" class="faq"><span style="font-size: 16px;"><i class="fa fa-flag" aria-hidden="true"></i>  সমস্যা ও পরামর্শ জানান</span></a><br/>
              </div>
            </div>

            <div class="panel" style="background: #B0FCB0;">
              <div class="panel-body">
                <span style="font-size: 25px;"><b>সাম্প্রতিক মন্তব্য</b></span>
               @foreach ($recentcomments as $recentcomment)
                    <div style="border-bottom: 1px solid #6ED66E; padding-top: 5px;">
                      <a href="{{url('article/'.$recentcomment->slug)}}" class="postTitle" style="font-size: 20px;">{{ $recentcomment->title }}</a></br>
                      <?php
                        foreach ($users as $user) {
                          if($user->id == $recentcomment->postedBy){
                            $writtenBy = $user->name;
                          }
                        }
                      ?>
                      <small><strong><i class="fa fa-user" aria-hidden="true"></i> <a href="{{url('profile/'.$writtenBy)}}" class="">{{ $writtenBy }} </a></strong>
                        <span style="color: grey; float: right;">{{ $recentcomment->commentsandrepliestcount_time ? bn_date($recentcomment->commentsandrepliestcount_time->diffForHumans()) : ''}}</span>
                      </small>
                    </div>
                @endforeach
              </div>
            </div>
			
			{{-- facebook page --}}
            <div class="fb-page panel" data-href="https://www.facebook.com/bloghumansofthakurgaon/" data-tabs="timeline" data-height="200" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/bloghumansofthakurgaon/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/bloghumansofthakurgaon/">ব্লগ I হিউম্যানস অব ঠাকুরগাঁও</a></blockquote></div><br/>
            {{-- facebook page --}}

        </div>
       
        <div class="col-md-3">

    	  <div class="panel" style="background: #B0FCB0;">
              <div class="panel-body">
                আজ {{  bn_date(date('l')) }}, সময় {{  bn_date(date('h:i a')) }}<br/>
                <script type="text/javascript" src="http://bangladate.appspot.com/index2.php"></script><br/> 
                {{  bn_date(date('d M Y')) }} খ্রিস্টাব্দ
              </div>
          </div>

          <div class="panel" style="background: #B0FCB0;">
              <div class="panel-body">
                <!-- search -->
                {!! Form::open(array('route' => 'search.search', 'class'=>'form', 'method' => 'GET', 'data-parsley-validate' => '')) !!}
                  <div class="input-group add-on">
                    <input class="form-control" placeholder="অনুসন্ধান " name="search" type="text" required="" data-parsley-required-message = "">
                    <div class="input-group-btn">
                      <button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                    </div>
                  </div>
                 {!! Form::close() !!}
                <!-- search -->
              </div>
            </div>

			<div class="panel" style="background: #B0FCB0;">
              <div class="panel-body">
                <span style="font-size: 25px;"><b>অনলাইনে আছেন</b></span><br/>
                @foreach($users as $user)
                @if($user->isOnline())
                  <div class="online-users-list">
                    <span class="online-icon" style=""><i class="fa fa-circle" aria-hidden="true"></i></span>

                    <a href="{{ url('profile/'.$user->name) }}" style="text-decoration: none;">
                      @if(!$user->image == NULL)
                      <img class="img-responsive img-circle online-user" src="{{ asset('images/profilepicture/'.$user->image) }}" style="height: 50px; width: auto; border: 2px solid #bbb;">
                      @else
                      <img class="img-responsive img-circle online-user" src="{{ asset('images/profile.png') }}" style="height: 50px; width: auto; border: 2px solid #bbb;">
                      @endif
                      <span class="online-user-name">{{ $user->name }}</span>
                    </a><br/>
                  </div>
                @endif
                @endforeach
              </div>
            </div>

            <div class="panel" style="background: #B0FCB0;">
              <div class="panel-body">
                <span style="font-size: 25px;"><b>সর্বাধিক পঠিত</b></span>
                @foreach ($populars as $popular)
                    <div style="border-bottom: 1px solid #6ED66E; padding-top: 5px;">
                      <a href="{{url('article/'.$popular->slug)}}" class="postTitle" style="font-size: 20px;">{{ $popular->title }}</a></br>
                      <?php
                        foreach ($users as $user) {
                          if($user->id == $popular->postedBy){
                            $writtenBy = $user->name;
                          }
                        }
                      ?>
                      <small><strong><i class="fa fa-user" aria-hidden="true"></i> <a href="{{url('profile/'.$writtenBy)}}" class="">{{ $writtenBy }} </a></strong></small>
                    </div>
                @endforeach
              </div>
            </div>
            


            <div class="panel" style="background: #B0FCB0;">
              <div class="panel-body">
                <span style="font-size: 25px;"><b>আলোচিত ব্লগ</b></span>
                @foreach ($mostreads as $mostread)
                      <div style="border-bottom: 1px solid #6ED66E; padding-top: 5px;">
                        <a href="{{url('article/'.$mostread->slug)}}" class="postTitle" style="font-size: 20px;">{{ $mostread->title }}</a></br>
                        <?php
                          foreach ($users as $user) {
                            if($user->id == $mostread->postedBy){
                              $writtenBy = $user->name;
                            }
                          }
                        ?>
                        <small><strong><i class="fa fa-user" aria-hidden="true"></i> <a href="{{url('profile/'.$writtenBy)}}" class="">{{ $writtenBy }} </a></strong></small>
                      </div>
                  @endforeach
              </div>
            </div>  
        </div>
      </div>	
	</div>      



@endsection

@section('script')
	{!!Html::script('js/parsley.min.js')!!}
    {!!Html::script('js/emojionearea.js')!!}	
	<script type='text/javascript'>
		(function() {
			var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			po.src = 'https://apis.google.com/js/platform.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		})();
	</script>
	<!-- Google Plus Share API -->
	<script src="https://apis.google.com/js/platform.js" async defer></script>
	<script type="text/javascript">
		$("#btnPrint").click(function () {
		    //Hide all other elements other than printarea.
		    $("#forPrintPurpose").show();
		    window.print();
		});
	</script>

	<script type="text/javascript">
	  $(document).ready(function() {
	    $("#comment").emojioneArea({
	      pickerPosition: "top",
	      filtersPosition: "bottom",
	      tonesStyle: "square"
	    });

	    // multiple replies, edit comments, edit replies
	    var i = 1;
		for(i; i<={{  $post->comments->count() }}; i++) {
			$("#comment"+i).emojioneArea({
		      pickerPosition: "top",
		      filtersPosition: "bottom",
		      tonesStyle: "square"
		    });

		    $("#commentEdit"+i).emojioneArea({
		      pickerPosition: "top",
		      filtersPosition: "bottom",
		      tonesStyle: "square"
		    });
	    }

	    var j = 1;
		for(j; j<={{  $totalcommentreply->id }}; j++) {
		    $("#replyEdit"+j).emojioneArea({
		      pickerPosition: "top",
		      filtersPosition: "bottom",
		      tonesStyle: "square"
		    });
	    }


	    // multiple replies, edit comments, edit replies

	  });

	  
	</script>
@endsection
