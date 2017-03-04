@if (Session::has('success'))
	<div class="alert alert-success">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>সফল!</strong> {{Session::get('success')}}
	</div>	
@endif

@if (count($errors) > 0)
	<div class="alert alert-danger">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>ত্রুটি:</strong> 
	    <ul>
	    	@foreach ($errors->all() as $error)
	    		<li>{{ $error }}</li>
	    	@endforeach

	    </ul>
	</div>	
@endif

@if(session('status'))
	<div class="alert alert-success">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session('status') }}
    </div>
@endif

<div class="flash-message">
	@foreach (['danger', 'warning', 'success', 'info'] as $msg)
		@if(Session::has('alert-' . $msg))
			<div class="alert alert-{{ $msg }}">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    {{ Session::get('alert-' . $msg) }}
			</div>
		@endif
	@endforeach
</div>



