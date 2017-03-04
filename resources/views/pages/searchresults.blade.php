@extends('main')

@section('title', 'ব্লগ | অনুসন্ধান ফলাফল')
@section('stylesheet')
  {!!Html::style('css/parsley.css')!!}
@endsection
@section('content')
      <div class="row">
          <div class="col-md-8">
            <h2><i class="fa fa-search" aria-hidden="true"></i> অনুসন্ধান ফলাফল</h2>
            <span>
            	@if($searchresults->count() == 0)
            	<b>'{{ $request }}'</b> এর জন্য কোন ফলাফল পাওয়া যায়নি।
            	@elseif($searchresults->count() >=1)
            	<b>'{{ $request }}'</b> এর জন্য মোট {{ $searchresults->count() }} টি ফলাফল পাওয়া গিয়েছে ({{ substr((microtime(true) - LARAVEL_START), 0, 7) }} সেকেন্ডে)
            	@endif
            </span>
              <hr>
			  @foreach ($searchresults as $post)
	            <div class="post">
	              <p class="postTitle mainBodyPostTitle"><strong><a href="{{url('article/'.$post->slug)}}" class="postTitle">{{ $post->title }}</a></strong></p>
	              <h5><strong>লিখেছেনঃ</strong>
	              <?php
	                foreach ($users as $user) {
	                  if($user->id == $post->postedBy){
	                    $writtenBy = $user->name;
	                  }
	                }
	              ?>
	              <a href="{{url('profile/'.$writtenBy)}}" class="">{{ $writtenBy }} </a>

	              | <span> {{ date('F d, Y | h:i A', strtotime($post->created_at))}}
	              <i class="diffForHumans">{{ $post->created_at->diffForHumans() }}</i>
	              </span></h5>
	              <span class="postBody">
	              <!-- {!!strlen($post->body)>1200? substr($post->body, 0, stripos($post->body, " ", stripos(strip_tags($post->body), " ")+1200))." [...] " : $post->body!!} -->
	                @if(strlen($post->body)>1200)
	                  {!! substr($post->body, 0, stripos($post->body, " ", stripos(strip_tags($post->body), " ")+1150))." [...] " !!}
	                @else
	                  {!! $post->body !!}
	                @endif
	                <a href="{{ url('article/'.$post->slug) }}">বাকিটুকু পড়ুন</a>
	                </span>
	                <p></p>
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
	                 <span style="margin-left: 5px;">[ <i class="fa fa-comments" aria-hidden="true"></i> {{ $post->comments()->count() }} ]</span>
	              </span>
	              
	            </div><hr>
	          @endforeach
              <div class="text-center">
		          {!! $searchresults->links() !!}
		      </div>
          </div>
          <div class="col-md-4">
            <img src="{{ asset('images/aboutimage.jpg') }}" class="img-responsive panel">
          </div>
      </div>
@endsection

@section('script')
  {!!Html::script('js/parsley.min.js')!!}
@endsection
