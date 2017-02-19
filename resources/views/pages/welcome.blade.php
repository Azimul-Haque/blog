@extends('main')

@section('title', 'Blog | Home')

@section('stylesheet')
  {!!Html::style('css/styles.css')!!}

@endsection


@section('content')
      <div class="row">
        <div class="col-md-3">
            <div class="panel" style="background: #b2dfdb;">
              <div class="panel-body">
                <span style="font-size: 20px;"><b>ব্লগের তথ্য</b></span><br/>
                <span style="font-size: 16px;">মোট ব্লগারঃ {{ $bloggers->id }}</span><br/>
                <span style="font-size: 16px;">সর্বমোট পোস্টঃ {{ $totalpost->id }}</span><br/>
                <span style="font-size: 16px;">সর্বমোট কমেন্টঃ {{ $totalcomment->id }}</span>
              </div>
            </div>

            <div class="panel" style="background: #a5d6a7;">
              <div class="panel-body">
                <span style="font-size: 20px;"><b>ব্লগ লিখতে চাইলে</b></span><br/>
                <a href="#" class="faq"><span style="font-size: 16px;"><i class="fa fa-question-circle" aria-hidden="true"></i> সাধারণ প্রশ্নোত্তর</span></a><br/>
                <a href="#" class="faq"><span style="font-size: 16px;"><i class="fa fa-plug" aria-hidden="true"></i> ব্লগ ব্যাবহারের নিয়মাবলী</span></a><br/>
                <a href="#" class="faq"><span style="font-size: 16px;"><i class="fa fa-gavel" aria-hidden="true"></i> ব্লগ ব্যবহারের শর্তাবলী</span></a>
              </div>
            </div>

            <div class="panel" style="background: #ffe082;">
              <div class="panel-body">
                <span style="font-size: 20px;"><b>নোটিশ</b></span><br/>
                <a href="#"><span style="font-size: 16px;">মোট ব্লগারঃ {{ $bloggers->id }}</span></a><br/>
                <a href="#"><span style="font-size: 16px;">সর্বমোট পোস্টঃ {{ $totalpost->id }}</span></a><br/>
                <a href="#"><span style="font-size: 16px;">সর্বমোট কমেন্টঃ {{ $totalcomment->id }}</span></a>
              </div>
            </div>
        </div>

        <div class="col-md-6">

          {{--featured post--}}
          <div class="post" style="background: #e8f5e9; padding: 10px; border: 1px solid #90a4ae;">
              <p class="featuredPost"><i class="fa fa-thumb-tack" aria-hidden="true"></i> ফিচারড</p>
              <p class="postTitle mainBodyPostTitle"><strong><a href="{{url('article/'.$featured->slug)}}" class="postTitle">{{ $featured->title }}</a></strong></p>
              <h5><strong>লিখেছেনঃ</strong> 
              <a href="{{url('profile/'.$featured->postedBy)}}" class="">{{ $featured->postedBy }} </a>

              | <span> {{ date('F d, Y | h:i A', strtotime($featured->created_at))}}
              <i class="diffForHumans">{{ $featured->created_at->diffForHumans() }}</i>
              </span></h5>
              <span class="postBody">
                {!!strlen($featured->body)>1200? substr($featured->body, 0, strpos($featured->body, " ", strpos(strip_tags($featured->body), " ")+1200))." [...] " : $featured->body!!}
                <a href="{{ url('article/'.$featured->slug) }}">বাকিটুকু পড়ুন</a>
              </span><p></p>
              <span><i class="fa fa-folder-open-o" aria-hidden="true"></i> বিষয়ঃ <a href="/category/{{$featured->category->name}}/">{{ $featured->category->name }}</a>
              </span> | 
              <span><i class="fa fa-tags" aria-hidden="true"></i> ট্যাগসমূহঃ 
                <?php
                  $labels = array('default','primary','success','info','warning','danger');
                  $i = 1;
                ?> 
                @foreach ($featured->tags as $tag)
                  <a class="label label-{{$labels[$i]}}" href="/tag/{{$tag->name}}">{{ $tag->name }} 
                    </a>
                  <?php $i++?>
                @endforeach 
                 <span style="margin-left: 5px;">[ <i class="fa fa-eye" aria-hidden="true"></i> {{ $featured->hits }} ]</span>
                 <span style="margin-left: 5px;">[ <i class="fa fa-comments" aria-hidden="true"></i> {{ $featured->comments()->count() }} ]</span>
              </span>
              
            </div><hr>
          {{--featured post--}}

          <?php $i = 1; ?>
          @foreach ($posts as $post)
            <?php $i++; ?>
            @if($i%2 == 0)
              <?php $titleColor =  '#'; ?>
            @else
              <?php $titleColor =  '#'; ?>
            @endif
            <div class="post" style="background:{{$titleColor}};">
              <p class="postTitle mainBodyPostTitle"><strong><a href="{{url('article/'.$post->slug)}}" class="postTitle">{{ $post->title }}</a></strong></p>
              <h5><strong>লিখেছেনঃ</strong> 
              <a href="{{url('profile/'.$post->postedBy)}}" class="">{{ $post->postedBy }} </a>

              | <span> {{ date('F d, Y | h:i A', strtotime($post->created_at))}}
              <i class="diffForHumans">{{ $post->created_at->diffForHumans() }}</i>
              </span></h5>
              <span class="postBody">
              {!!strlen($post->body)>1200? substr($post->body, 0, strpos($post->body, " ", strpos(strip_tags($post->body), " ")+1200))." [...] " : $post->body!!}
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

        </div>
       
        <div class="col-md-3">
            <div class="panel" style="background: #f0f4c3;">
            <div class="panel-body">
              <span style="font-size: 25px;"><b>সর্বাধিক পঠিত</b></span>
              @foreach ($populars as $popular)
                  <div style="border-bottom: 1px solid #cddc39;">
                    <a href="{{url('article/'.$popular->slug)}}" class="postTitle" style="font-size: 20px;">{{ $popular->title }}</a></br>
                    <small><strong><i class="fa fa-user" aria-hidden="true"></i> <a href="{{url('profile/'.$popular->postedBy)}}" class="">{{ $popular->postedBy }} </a></strong></small>
                  </div><br/>
              @endforeach
            </div>
          </div>
          </div>
      </div>
      <div class="text-center">
          {!! $posts->links() !!}
      </div>
@endsection