@extends('dashboard')

@section('title')
	ব্লগ | ব্লগ বিজ্ঞপ্তি
@endsection
@section('stylesheet')
	{!!Html::style('css/parsley.css')!!}
@endsection

@section('content')

	<div class="row">
		<div class="col-md-12">
			<h1>ব্লগ বিজ্ঞপ্তি</h1>
		</div>
	</div>	

	<div class="row">
		<div class="col-md-7">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-condensed">
          <thead>
            <tr>
              <th>#</th>
              <th>প্রকাশিত বিজ্ঞপ্তি</th>
              <th>প্রকাশের তারিখ</th>
              <th></th>
              <th></th>
            </tr>
          </thead>

          <tbody>
            @foreach($adminnotifications as $adminnotification)
              <tr>
                <td></td>
                <td>{{ $adminnotification->post_title }}</td>
                <td>{{ date('F d, Y h:i A', strtotime($adminnotification->created_at)) }}</td>
                <td style="width: 12%"><a href="{{route('adminnotifications.edit', $adminnotification->id)}}" class="btn btn-primary btn-xs btn-block"><i class="fa fa-pencil" aria-hidden="true"></i> সম্পাদন</a></td>
                <td style="width: 12%">
                  <button type="button" class="btn btn-danger btn-xs btn-block" data-toggle="modal" data-target="#modalDelete{{$adminnotification->id}}"><i class="fa fa-trash-o" aria-hidden="true"></i> মুছুন</button>
                  <div class="modal fade static" id="modalDelete{{$adminnotification->id}}" role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h4 class="modal-title">বিজ্ঞপ্তি মুছে ফেলুন!</h4>
                          </div>
                          <div class="modal-body">
                            <p>আপনি কি নিশ্চিতভাবে এই বিজ্ঞপ্তিটি মুছে ফেলতে চান?</p>
                            <span><strong>"{{ $adminnotification->post_title }}"</strong></span><br/>
                            <p><strong>Note:</strong> মুছে ফেলা বিজ্ঞপ্তি আর ফিরে পাওয়া যাবে না!</p>         
                      {!! Form::open(['route' => ['adminnotifications.destroy', $adminnotification->id], 'method'=>'DELETE']) !!}
                        {!! Form::submit('Delete', ['class'=>'btn btn-danger btn-block']) !!}
                      {!! Form::close() !!}
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                          </div>
                        </div>
                      </div>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
			
		</div>

		<div class="col-md-5">

    <div class="panel">
      <div class="panel-body">
        @if($routename == 'adminnotifications')
        {!! Form::open(['route' => 'adminnotifications.store', 'data-parsley-validate' => '', 'files' => 'true', 'enctype' => 'multipart/form-data', 'method' => 'POST']) !!}
        @elseif($routename == 'adminnotifications/{adminnotifications}/edit')
        {!! Form::model($editadminnotification, ['route' => ['adminnotifications.update', $editadminnotification->id], 'data-parsley-validate' => '', 'method'=>'PUT']) !!}
        @endif

            {!! Form::label('post_title', 'মূল অংশঃ', array('class' => '')) !!}
            {!! Form::textarea('post_title', null, array('class' => 'form-control', 'minlength' => '10', 'rows' => '3', 'required' => '')) !!}

            {!! Form::label('slug', 'লিংক', array('class' => 'form-spacing-top')) !!}
            {!! Form::text('slug', null, array('class' => 'form-control', 'required' => '')) !!}

            {!! Form::submit('সংরক্ষণ ও প্রকাশ করুন', array('class' => 'btn btn-success btn-block', 'style' => 'margin-top:20px;')) !!}

        {!! Form::close() !!}
      </div>
    </div>
			
		</div>
	</div>

@stop

@section('script')
	{!!Html::script('js/parsley.min.js')!!}

  <script type="text/javascript">
    
  </script>
@endsection
