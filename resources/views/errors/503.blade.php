@extends('main')

@section('title', 'ব্লগ | ৫০৩ ত্রুটি')
@section('stylesheet')
  {!!Html::style('css/parsley.css')!!}
@endsection
@section('content')
      <div class="row">
          <div class="col-md-8">
            আবার আসছি!
          </div>
          <div class="col-md-4">
            <img src="{{ asset('images/aboutimage.jpg') }}" class="img-responsive panel">
          </div>
      </div>
@endsection

@section('script')
  {!!Html::script('js/parsley.min.js')!!}
@endsection