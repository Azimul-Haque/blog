@if (Session::has('success'))
	<div class="alert alert-success">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>Success!</strong> {{Session::get('success')}}
	</div>	
@endif

@if (count($errors) > 0)
	<div class="alert alert-danger">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>Errors:</strong> 
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



