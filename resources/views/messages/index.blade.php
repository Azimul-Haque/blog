@extends('dashboard')

@section('title')
	ব্লগ | চিরকুট
@endsection
@section('stylesheet')
	{!!Html::style('')!!}
@endsection

@section('content')

	<div class="row">
		<div class="col-md-12">
			<h1>চিরকুটগুলো</h1>
		</div>
	</div>	

	<div class="row">
		<div class="col-md-8">
			@foreach($users as $user)
				@foreach($messages as $message)
					@if($user->id == $message->from_id)
						<div class="panel panel-success">
							<div class="panel-body">
							
								<strong><i class="fa fa-user" aria-hidden="true"></i> {{ $user->name }}</strong>
								<small style="color: #8BC34A;"><i class="fa fa-clock-o" aria-hidden="true"></i> {{ date('F d, Y h:i A', strtotime($message->created_at))}}</small>
								<br/>
								<a href="{{ route('conversation.read', $user->name) }}">ফিরতি চিরকুট পাঠান</a>
							</div>
						</div>
					@endif
				@endforeach
			@endforeach

			<div class="text-center">
				{!! $messages->links() !!}
			</div>
		</div>

		<div class="col-md-4">
			
		</div>
	</div>

@stop

@section('script')
	{!!Html::script('')!!}
@endsection
