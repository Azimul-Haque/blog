@extends('dashboard')

@section('title')
	Blog | All Post
@endsection
@section('stylesheet')
	{!!Html::style('')!!}
@endsection

@section('content')

	<div class="row">
		<div class="col-md-12">
			<h2>রিপোর্টেড কমেন্টগুলো ({{ $totalreportedcomments }} টি)</h2>
		</div>
	</div>	

	<div class="row">
		<div class="col-md-12">				
			<div class="table-responsive">
				<table class="table table-bordered table-condensed table-striped">
					<thead>
						<tr>
							<th style="width: 15%">নাম</th>
							<th>ইমেইল এড্রেস</th>
							<th style="width: 25%">কমেন্ট</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($reportedcomments as $reportedcomment)
						<tr>
							<td>{{ $reportedcomment->name }}</td>
							<td>{{ $reportedcomment->email }}</td>
							<td>{{ $reportedcomment->comment }}</td>
							<td>
								<a href="{{route('comments.delete', $reportedcomment->id)}}" class="btn btn-xs btn-danger" title="মুছে দিন">
									<i class="fa fa-trash" aria-hidden="true"></i> মুছে দিন
								</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>	
			</div>
		</div>
	</div>

@stop

@section('script')
	{!!Html::script('')!!}
	
@endsection
