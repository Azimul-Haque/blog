@extends('main')

@section('title', 'Blog | Contact')

@section('content')
      <div class="row">
          <div class="col-md-8">
            <h1>যোগাযোগ</h1>
              <hr>
              <form action="{{ url('contact') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                  <label name="email">ইমেইল:</label>
                  <input id="email" name="email" class="form-control">
                </div>

                <div class="form-group">
                  <label name="subject">বিষয়:</label>
                  <input id="subject" name="subject" class="form-control">
                </div>

                <div class="form-group">
                  <label name="message">বার্তা:</label>
                  <textarea id="message" name="message" class="form-control"></textarea>
                </div>
                
                <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane" aria-hidden="true"></i> বার্তা পাঠান</button>
              </form>
          </div>
          <div class="col-md-4">
            <img src="{{ asset('images/aboutimage.jpg') }}" class="img-responsive panel">
          </div>
      </div>
@endsection