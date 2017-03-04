@extends('main')

@section('title', 'ব্লগ | যোগাযোগ')
@section('stylesheet')
  {!!Html::style('css/parsley.css')!!}
@endsection
@section('content')
      <div class="row">
          <div class="col-md-8">
            <h2><i class="fa fa-envelope" aria-hidden="true"></i> যোগাযোগ</h2>
              <hr>
              <form action="{{ url('contact') }}" method="POST" data-parsley-validate>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                  <label name="email">ইমেইল:</label>
                  <input id="email" name="email" class="form-control" required="" data-parsley-required-message="আপনার ইমেইল এড্রেসটি দিন">
                </div>

                <div class="form-group">
                  <label name="subject">বিষয়:</label>
                  <input id="subject" name="subject" class="form-control" required="" data-parsley-required-message="বার্তার একটি বিষয় বলুন">
                </div>

                <div class="form-group">
                  <label name="message">বার্তা:</label>
                  <textarea id="message" name="message" class="form-control" required="" data-parsley-required-message="কিছু তো লিখুন" minlength="5"></textarea>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <label>ক্যাপচা</label>
                      <div class="row">
                        <div class="col-md-12">
                          {!! app('captcha')->display(); !!}
                        </div>
                      </div>
                  </div>
                </div><br/>
                
                <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane" aria-hidden="true"></i> বার্তা পাঠান</button>
              </form><br/>
          </div>
          <div class="col-md-4">
            <img src="{{ asset('images/aboutimage.jpg') }}" class="img-responsive panel">
          </div>
      </div>
@endsection

@section('script')
  {!!Html::script('js/parsley.min.js')!!}
@endsection