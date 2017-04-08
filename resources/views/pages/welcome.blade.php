@extends('main')

@section('title', 'ব্লগ | নীড় পাতা | সভ্যতার জয়গান')

@section('stylesheet')
  {!!Html::style('css/parsley.css')!!}
  <meta property="og:title" content="ব্লগ | হিউম্যানস অব ঠাকুরগাঁও । সভ্যতার জয়গান"/>
  <meta property="og:type" content="article"/>
  <meta property="og:url" content="{{ url('/') }}"/>
  <meta property="og:image" content="{{ asset('images/aboutimage.jpg') }}"/>
  <meta property="og:site_name" content="Blog | Humans of Thakurgaon"/>
  <meta property="fb:admins" content="orbachinujbuk"/>
  <meta property="fb:app_id" content="1654451871469307"/>
  <meta name="description" property="og:description" content="
        হিউম্যানস অব ঠাকুরগাঁও-এর যাত্রা শুরু হয় ২০১৬ সালে। ফেইসবুক পেইজের মাধ্যমে যাত্রা শুরু করা হিউম্যানস অব ঠাকুরগাঁও এর ব্লগের যাত্রা শুরু হল পহেলা মার্চ, ২০১৭ তে। ঠাকুরগাঁওসহ দেশের যেকোন প্রান্তের তরুণ এবং লিখতে আগ্রহীদের জন্য প্রথম একটি অনলাইন প্লাটফর্ম Blog | Humans of Thakurgaon.
  "/>
@endsection


@section('content')
      <div class="row">
        <div class="col-md-6 col-md-push-3">
          {{--featured post--}}
          <div class="post" style="background: #e8f5e9; padding: 10px; border: 1px solid #90a4ae;">
              <p class="featuredPost"><i class="fa fa-thumb-tack" aria-hidden="true"></i> নির্দেশিত প্রবন্ধ</p>
              <p class="postTitle mainBodyPostTitle"><strong><a href="{{url('article/'.$featured->slug)}}" class="postTitle">{{ $featured->title }}</a></strong></p>
              <h5><strong>লিখেছেনঃ</strong>
              <?php
                foreach ($users as $user) {
                  if($user->id == $featured->postedBy){
                    $writtenBy = $user->name;
                  }
                }
              ?>
              <a href="{{url('profile/'.$writtenBy)}}" class="">{{ $writtenBy }} </a>

              <span>
                  <i class="fa fa-calendar" aria-hidden="true"></i> {{ bn_date(date('F d, Y', strtotime($featured->created_at)))}}
                  <i class="fa fa-clock-o" aria-hidden="true"></i> {{ bn_date(date('h:i a', strtotime($featured->created_at)))}}
                  <span class="diffForHumans">{{ bn_date($featured->created_at->diffForHumans()) }}</span>
              </span></h5>
              <span class="postBody">
                @if(strlen($featured->body)>1200)
                  {!! substr($featured->body, 0, stripos($featured->body, " ", stripos(strip_tags($featured->body), " ")+1150))." [...] " !!}
                  
                  {{-- solved the strong, em and p problem --}}
                  @if(substr_count(substr($featured->body, 0, stripos($featured->body, " ", stripos(strip_tags($featured->body), " ")+1150)), "<strong>") == substr_count(substr($featured->body, 0, stripos($featured->body, " ", stripos(strip_tags($featured->body), " ")+1150)), "</strong>"))
                  
                  @else
                    </strong>
                  @endif
                  @if(substr_count(substr($featured->body, 0, stripos($featured->body, " ", stripos(strip_tags($featured->body), " ")+1150)), "<em>") == substr_count(substr($featured->body, 0, stripos($featured->body, " ", stripos(strip_tags($featured->body), " ")+1150)), "</em>"))

                  @else
                    </em>
                  @endif
                  @if(substr_count(substr($featured->body, 0, stripos($featured->body, " ", stripos(strip_tags($featured->body), " ")+1150)), "<p>") == substr_count(substr($featured->body, 0, stripos($featured->body, " ", stripos(strip_tags($featured->body), " ")+1150)), "</p>"))

                  @else
                    </p>
                  @endif
                  {{-- solved the strong, em and p problem --}}

                @else
                  {!! $featured->body !!}
                @endif
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
                 <span style="margin-left: 5px;">[ <i class="fa fa-eye" aria-hidden="true"></i> {{ bn_date($featured->hits) }} ]</span>
                 <span style="margin-left: 5px;">[ <i class="fa fa-comments" aria-hidden="true"></i> 
                  <?php $total = 0?>
                  @foreach($featured->comments as $comment)
                  <?php
                    $total = $total + $comment->commentreplies->count();
                  ?>
                  @endforeach
                  {{ bn_date($featured->comments()->count() + $total) }}

                  ]
                 </span>
              </span>
              
            </div><hr>
          {{--featured post--}}


          @foreach ($posts as $post)
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

              <span>
                  <i class="fa fa-calendar" aria-hidden="true"></i> {{ bn_date(date('F d, Y', strtotime($post->created_at)))}}
                  <i class="fa fa-clock-o" aria-hidden="true"></i> {{ bn_date(date('h:i a', strtotime($post->created_at)))}}
                  <span class="diffForHumans">{{ bn_date($post->created_at->diffForHumans()) }}</span>
              </span></h5>
              <span class="postBody">
                @if(strlen($post->body)>1200)
                  {!! substr($post->body, 0, stripos($post->body, " ", stripos(strip_tags($post->body), " ")+1150))." [...] " !!}

                  {{-- solved the strong, em and p problem --}}
                  @if(substr_count(substr($post->body, 0, stripos($post->body, " ", stripos(strip_tags($post->body), " ")+1150)), "<strong>") == substr_count(substr($post->body, 0, stripos($post->body, " ", stripos(strip_tags($post->body), " ")+1150)), "</strong>"))
                  @else
                    </strong>
                  @endif
                  @if(substr_count(substr($post->body, 0, stripos($post->body, " ", stripos(strip_tags($post->body), " ")+1150)), "<em>") == substr_count(substr($post->body, 0, stripos($post->body, " ", stripos(strip_tags($post->body), " ")+1150)), "</em>"))

                  @else
                    </em>
                  @endif
                  @if(substr_count(substr($post->body, 0, stripos($post->body, " ", stripos(strip_tags($post->body), " ")+1150)), "<p>") == substr_count(substr($post->body, 0, stripos($post->body, " ", stripos(strip_tags($post->body), " ")+1150)), "</p>"))

                  @else
                    </p>
                  @endif
                  {{-- solved the strong, em and p problem --}}

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
                 <span style="margin-left: 5px;">[ <i class="fa fa-eye" aria-hidden="true"></i> {{ bn_date($post->hits) }} ]</span>
                 <span style="margin-left: 5px;">[ <i class="fa fa-comments" aria-hidden="true"></i>   <?php $total = 0?>
                  @foreach($post->comments as $comment)
                    <?php
                      $total = $total + $comment->commentreplies->count();
                    ?>
                  @endforeach
                  {{ bn_date($post->comments()->count() + $total) }}
                  ]
                </span>
              </span>
              
            </div><hr>
          @endforeach

          <div class="text-center">
              {!! $posts->links() !!}
          </div>

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
                    <span style="font-size: 10px; color:#42B72A ; margin-top: -6px; margin-right: 4px;"><i class="fa fa-circle" aria-hidden="true"></i></span> <a href="{{ url('profile/'.$user->name) }}" style="text-decoration: none;">{{ $user->name }}</a><br/>
                @endif
                @endforeach
              </div>
            </div>

            <div class="panel" style="background: #B0FCB0;">
              <div class="panel-body">
                <span style="font-size: 25px;"><b>সর্বাধিক পঠিত</b></span>
                @foreach ($populars->sortByDesc('hits') as $popular)
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
                  @foreach ($mostreads->sortByDesc('commentsandrepliestcount') as $mostread)
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
      
@endsection


@section('script')
  {!!Html::script('js/parsley.min.js')!!}
@endsection