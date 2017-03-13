@extends('main')

@section('title', 'ব্লগ | বিষয়ভিত্তিক')
@section('stylesheet')
	{!!Html::style('')!!}
@endsection

@section('content')

	<div class="row">
		<div class="col-md-8">
			@if($category->posts()->count() == 0)
				<div class="alert alert-info">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    	এই বিষয়ে কোন ব্লগপোস্ট পাওয়া যায়নি।
				</div>
			@endif
			@foreach($category->posts()->orderBy('id', 'desc')
							->where('category_id', '=', $category->id)
							->where('isDeleted', '!=', '0')
                            ->where('isPublished', '=', 'publish')
							->get() as $post)
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
				
				<span><i class="fa fa-folder-open-o" aria-hidden="true"></i> বিষয়ঃ <a href="{{ url('/category/'.$post->category->name) }}">{{ $post->category->name }}</a>
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
	               <span style="margin-left: 5px;">[ <i class="fa fa-comments" aria-hidden="true"></i> 	  <?php $total = 0?>
	                  @foreach($post->comments as $comment)
	                    <?php
	                      $total = $total + $comment->commentreplies->count();
	                    ?>
	                  @endforeach
	                  {{ bn_date($post->comments()->count() + $total) }}
	               ]</span>
	            </span>
				<hr>
			@endforeach
		</div>
		<div class="col-md-4">
			<h1>বিষয়সমূহ</h1>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>বিষয়ের নাম</th>
						<th>পোস্ট সংখ্যা</th>
					</tr>
				</thead>

				<tbody>
				@foreach ($categorylist as $categoryeach)
					<tr>
						<th>{{ bn_date($categoryeach->id) }}</th>
						<th><a href="/category/{{$categoryeach->name}}/">{{ $categoryeach->name }}</a></th>
						<th>{{ bn_date($categoryeach->posts()->count()) }}</th>
					</tr>
				@endforeach
				</tbody>

			</table>
		</div>
	</div>

@endsection

@section('script')
	{!!Html::script('')!!}
@endsection
