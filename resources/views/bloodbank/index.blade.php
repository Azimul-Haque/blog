@extends('main')

@section('title', 'ব্লগ | ব্লাড ব্যাংক')

@section('stylesheet')
  <link media="all" type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
@endsection

@section('content')
      <div class="row">
            <div class="col-md-4">
                <div class="panel">
                  <div class="panel-body">
                    <p>রক্তদান একটি মহৎ কর্ম। আপনাকে আমাদের এই 'রক্তের খোঁজে' কর্মসূচিতে অন্তর্ভুক্ত করতে পেরে আমরা আনন্দিত। আমরা চাই আমাদের ঠাকুরগাঁও-এর প্রতিটি মানুষ যেন দুঃসময়ে প্রয়োজনীয় রক্ত পায়।<br/><br/>
                    
                    <b>বিশেষভাবে লক্ষণীয় যে,</b> এটি একটি জরুরী সেবা। অনুগ্রহ করে অহেতুক ব্যবহারের মাধ্যমে সেবাটির বিঘ্ন ঘটাবেন না। তারপরেও এহেন কার্যকলাপ পরিলক্ষিত হলে, কর্তৃপক্ষ যথাযথ ব্যবস্থা গ্রহণ করবে।<br/><br/>

                    <b>যোগ্যতা-</b> <br/>
                    ১. ১৮-৬০ বছর বয়সী যে কোনও সুস্থ ও নীরোগ মানুষ রক্ত দান করতে পারেন।<br/>
                    ২. মেয়েদের ক্ষেত্রে ৪৫ কেজি এবং পুরুষের ক্ষেত্রে ৪৮ কেজির অধিক ওজনের যে কোনও মানুষ রক্তদান করতে পারেন অনায়াসে। <br/>
                    ৩. প্রতি ৪ মাস অন্তর অন্তর এক ব্যাগ (৩৫০- ৪৫০ মিলি লিটার) রক্ত দান করা যায়। <br/>
                    <b>অযোগ্যতা-</b> <br/> 
                    ১) যারা হেপাটাইটিস, এইডস, ম্যালেরিয়া বা অন্য কোন রক্তবাহিত রোগে ভুগছেন, তাদের রক্তদান করা উচিত না, কারণ সেই রক্ত রোগীকে নতুন রোগে আক্রান্ত করতে পারে। <br/>
                    ২) কোন রোগের কারণে অ্যান্টিবায়োটিকজাতীয় ওষুধ খাচ্ছেন, এরকম অবস্থায়ও রক্ত দেয়া উচিত নয়। <br/>
                    ৩) মহিলাদের ক্ষেত্রে মাসিক চলাকালীন সময়ে, গর্ভবতী অবস্থায় ও সন্তান ভূমিষ্ঠ হওয়ার ১ বছর পর পর্যন্ত রক্তদান করা তাদের স্বাস্থ্যের জন্য ঝুঁকিপূর্ণ। <br/>
                    ৪) মাস ছয়েকের ভেতর বড় ধরণের দুর্ঘটনার শিকার হয়েছেন বা অপারেশন হয়েছে - এমন ব্যক্তিদেরও রক্ত দান করা উচিত নয়। <br/>
                    <b>যখন রক্তদান করা যায়-</b> <br/>
                    ১. রক্তদান ২৪ ঘণ্টার মধ্যে যে কোনো সময় করা যায়। <br/>
                    ২. ভরাপেটে খাওয়ার ৩০ থেকে ৬০ মিনিট পরে রক্ত দেয়া ভালো। <br/>
                    ৩. খালি পেটে না দিয়ে হালকা খাবার খেয়ে রক্ত দেয়া ভালো।<br/>

                    </p>

                  </div>
                </div>
            </div>

            <div class="col-md-8">
            <h2><i class="fa fa-tint" aria-hidden="true"></i> রক্তের গ্রুপের তালিকা</h2>
              <hr>
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed" id="blood_group_table">
                  <thead>
                    <tr>
                      <th>ব্লগারের নাম</th>
                      <th>রক্তের গ্রুপ</th>
                      <th>সর্বশেষ রক্তদান</th>
                      <th>বর্তমান ঠিকানা</th>
                      <th>রক্তদান অনুরোধ</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($donors as $donor)
                      <tr>
                        <td><a href="{{ url('profile/'.$donor->name) }}">{{ $donor->name }}</a></td>
                        <td>{{ $donor->blood_group }}</td>
                        <td> 
                          @if($donor->last_donated == NULL || $donor->last_donated == '0000-00-00 00:00:00')
                          <span style="color: lightgrey">তথ্য নেই</span>
                          @else
                          {{ date('F d, Y', strtotime($donor->last_donated))}}
                          @endif
                        </td>
                        <td> 
                          @if($donor->present_address_privacy == 'public')
                              @if($donor->present_upazila != '')
                              {{ $donor->present_upazila }}, {{ $donor->present_district }}
                              @else
                              {{ $donor->present_district }}
                              @endif
                          @else
                          <span style="color: lightgrey">তথ্য নেই</span>
                          @endif
                        </td>
                        <td>
                          @if(Auth::check())
                          {!! Form::open(['route' => 'message.send', 'data-parsley-validate' => '', 'files' => 'true', 'enctype' => 'multipart/form-data', 'method' => 'POST']) !!}
                            {!! Form::hidden('to_id', $donor->id) !!}
                            {!! Form::hidden('to_name', $donor->name) !!}
                            {!! Form::hidden('to_email', $donor->email) !!}
                            {!! Form::hidden('from_id', Auth::user()->id) !!}
                            {!! Form::hidden('from_name', Auth::user()->name) !!}
                            {!! Form::hidden('from_email', Auth::user()->email) !!}
                            {!! Form::hidden('message', 'একজন মুমূর্ষু রোগীর জন্য '.$donor->blood_group.' রক্ত প্রয়োজন। আপনি কি রক্তদান করতে পারবেন?') !!}
                            <button type="submit" class="btn btn-warning btn-sm btn-block"><i class="fa fa-tint" aria-hidden="true"></i> অনুরোধ করুন</button>
                          {!! Form::close() !!}
                          @else
                          <a href="#!" class="btn btn-warning btn-sm btn-block disabled"><i class="fa fa-tint" aria-hidden="true"></i> অনুরোধ করুন</a>
                          @endif
                        </td>
                      </tr>
                    @endforeach
                    
                  </tbody>
                </table>
              </div>
            </div>
      </div>
@endsection

@section('script')
  <script type="text/javascript">
    $(document).ready(function() {
      $('#blood_group_table').DataTable( {
        "order": [[ 1, "asc" ]],
        columnDefs: [ {
            targets: [ 1 ],
            orderData: [ 1, 2 ]
        }, {
            targets: [ 2 ],
            orderData: [ 1, 2 ]
        }]

      });

    });
  </script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
@endsection