@extends('dashboard')

@section('title')
	ব্লগ | নোটিফিকেশন
@endsection
@section('stylesheet')
	{!!Html::style('')!!}
@endsection

@section('content')

	<div class="row">
		<div class="col-md-12">
			<h1>নোটিফিকেশনসমূহ</h1>
		</div>
	</div>	

	<div class="row">
		<div class="col-md-8">
			@foreach($pagenotifications  as $notification)
                @if($notification->type == 'comment')
                    @foreach($usersMandN  as $userMandN)
                        @if(($notification->setter_id == $userMandN->id) && ($notification->setter_id != Auth::user()->id))
                        <div class="panel">
                    		<div class="panel-body">
                            <a href="{{ url('article/'.$notification->slug) }}" style="float: left; display: inline-flex;">
                              {{-- image --}}
                              @if(!$userMandN->image == NULL)
                              <img class="img-responsive img-circle navDropDownMandNimg" src="{{ asset('images/profilepicture/'.$userMandN->image) }}">
                              @else
                              <img class="img-responsive img-circle navDropDownMandNimg" src="{{ asset('images/profile.png') }}">
                              @endif
                              {{-- image --}}
                              <span class="navDropDownMandNtextNotify">
                                <b>{{ $userMandN->name}}</b> আপনার ব্লগপোস্ট <b>{{ $notification->post_title }}</b>-এ মন্তব্য করেছেন।<br/>
                                <small>{{ bn_date(date('F d, Y h:i a', strtotime($notification->created_at))) }}</small>
                              </span>
                            </a>
                            </div>
                        </div>
                        @endif
                    @endforeach
               	@elseif($notification->type == 'reply')
                    @foreach($usersMandN  as $userMandN)
                        @if(($notification->setter_id == $userMandN->id) && ($notification->setter_id != Auth::user()->id))
                        <div class="panel">
                    		<div class="panel-body">
                            <a href="{{ url('article/'.$notification->slug) }}" style="float: left; display: inline-flex;">
                              {{-- image --}}
                              @if(!$userMandN->image == NULL)
                              <img class="img-responsive img-circle navDropDownMandNimg" src="{{ asset('images/profilepicture/'.$userMandN->image) }}">
                              @else
                              <img class="img-responsive img-circle navDropDownMandNimg" src="{{ asset('images/profile.png') }}">
                              @endif
                              {{-- image --}}
                              <span class="navDropDownMandNtextNotify">
                                <b>{{ $userMandN->name}}</b> আপনার ব্লগপোস্ট <b>{{ $notification->post_title }}</b>-এ প্রতিমন্তব্য করেছেন।<br/>
                                <small>{{ bn_date(date('F d, Y h:i a', strtotime($notification->created_at))) }}</small>
                              </span>
                            </a>
                            </div>
                        </div>
                        @endif
                    @endforeach
                @elseif($notification->type == 'hits')
                	<div class="panel">
                        <div class="panel-body">
                        <a href="{{ url('article/'.$notification->slug) }}" style="float: left; display: inline-flex;">
                          {{-- image --}}
                            @if(!Auth::user()->image == NULL)
                              <img class="img-responsive img-circle navDropDownMandNimg" src="{{ asset('images/profilepicture/'.Auth::user()->image) }}">
                            @else
                              <img class="img-responsive img-circle navDropDownMandNimg" src="{{ asset('images/profile.png') }}">
                            @endif
                          {{-- image --}}
                          <span class="navDropDownMandNtextNotify"> 
                              <b>{{ $notification->post_title }}</b> ব্লগপোস্টটি ১০০ বারের অধিক পঠিত হয়েছে!
                              <br/>
                              <small>{{ bn_date(date('F d, Y h:i a', strtotime($notification->created_at))) }}</small>
                          </span>
                        </a> 
                        </div>
                    </div>
                @elseif($notification->type == 'news')
                  <div class="panel">
                        <div class="panel-body">
                        <a href="{{ $notification->slug }}" target="_blank" style="float: left; display: inline-flex;">
                          {{-- image --}}
                              <img class="img-responsive img-circle navDropDownMandNimg" src="{{ asset('images/map_thakurgaon.jpg') }}">
                          <span class="navDropDownMandNtextNotify"> 
                              <b>{{ $notification->post_title }}</b>
                              <br/>
                              <small>{{ bn_date(date('F d, Y h:i a', strtotime($notification->created_at))) }}</small>
                          </span>
                        </a> 
                        </div>
                    </div>
                @endif    
            @endforeach

			<div class="text-center">
				{!! $pagenotifications->links() !!}
			</div>
		</div>

		<div class="col-md-4">
			
		</div>
	</div>

@stop

@section('script')
	{!!Html::script('')!!}
@endsection
