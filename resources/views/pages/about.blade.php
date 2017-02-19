@extends('main')

@section('title', 'Blog | Author')

@section('content')
      <div class="row">
        <div class="col-md-8">
          <h1><i class="fa fa-book" aria-hidden="true"></i> ব্লগ সম্পর্কে<hr></h1>
          <p>
          	হিউম্যানস অব ঠাকুরগাঁও-এর যাত্রা শুরু হয় ২০১৬ সালে। ফেইসবুক পেইজের মাধ্যমে যাত্রা শুরু করা হিউম্যানস অব ঠাকুরগাঁও এর ব্লগের যাত্রা শুরু হল ফেব্রুয়ারি, ২০১৭ তে। ঠাকুরগাঁও-এর তরুণ এবং লিখতে আগ্রহীদের জন্য প্রথম একটি অনলাইন প্লাটফর্ম Blog | Humans of Thakurgaon.</p>
          </p>
          	
          </p>
        </div>
        <div class="col-md-4">
        	<img src="{{ asset('images/aboutimage.jpg') }}" class="img-responsive panel">
        </div>
      </div>
@endsection