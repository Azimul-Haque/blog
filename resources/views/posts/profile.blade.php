@extends('dashboard')

@section('title', 'ব্লগ | প্রোফাইল')

@section('stylesheet')
  {!!Html::style('css/parsley.css')!!}
  {!!Html::style('css/dtpui.css')!!}
@endsection

@section('content')
      <div class="row">
        <div class="col-md-4">
          <div class="panel">
          	<div class="panel-body">
          		<center>
                @if(!$blogger->image == NULL)
                <img class="img-responsive img-circle" src="{{ asset('images/profilepicture/'.$blogger->image) }}" style="height: 100px; width: auto; border: 5px solid lightgrey;">
                @else
                <img class="img-responsive img-circle" src="{{ asset('images/profile.png') }}" style="height: 100px; width: auto; border: 5px solid lightgrey;">
                @endif  
              </center>
          		<table class="table">
          			<thead>
          				<tr>
          					<th>নামঃ</th>
          					<td>{{ $blogger->name }}</td>
          				</tr>
          				<tr>
          					<th>ইমেইল</th>
          					<td>{{ $blogger->email }}</td>
          				</tr>
          				<tr>
          					<th>ফোনঃ</th>
          					<td>{{ $blogger->phone }}</td>
          				</tr>
                  <tr>
                    <th>ফেইসবুকঃ</th>
                    <td><a href="{{ $blogger->fb }}" target="_blank">ক্লিক করুন</a></td>
                  </tr>
                  <tr>
                    <th>রক্তের গ্রুপঃ</th>
                    <td>{{ $blogger->blood_group }}</td>
                  </tr>
                  <tr>
                    <th>সর্বশেষ রক্তদানঃ</th>
                    <td>
                      @if($blogger->last_donated == NULL || $blogger->last_donated == '0000-00-00 00:00:00')
                      <span style="color: lightgrey">তথ্য নেই</span>
                      @else
                      {{ date('F d, Y', strtotime($blogger->last_donated))}} 
                      @endif
                    </td>
                  </tr>
          				@if($blogger->permanent_address_privacy == 'public')
                  <tr>
                    <th>স্থায়ী ঠিকানাঃ</th>
                    <td>
                      @if($blogger->permanent_upazila != '')
                      {{ $blogger->permanent_upazila }}, {{ $blogger->permanent_district }}
                      @else
                      {{ $blogger->permanent_district }}
                      @endif
                    </td>
                  </tr>
                  @else
                  
                  @endif
                  @if($blogger->present_address_privacy == 'public')
                  <tr>
                    <th>বর্তমান ঠিকানাঃ</th>
                    <td>
                      @if($blogger->present_upazila != '')
                      {{ $blogger->present_upazila }}, {{ $blogger->present_district }}
                      @else
                      {{ $blogger->present_district }}
                      @endif
                    </td>
                  </tr>
                  @else

                  @endif
                  <tr>
                    <th>ব্লগে যোগদান করেছেনঃ</th>
                    <td>{{ $blogger->created_at->diffForHumans() }}</td>
                  </tr>
          			</thead>
          		</table>
          	</div>
          </div>
        </div>
        <div class="col-md-8">
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#infoChangeTab">তথ্য পরিবর্তন</a></li>
            <li><a data-toggle="tab" href="#passwordChangeTAb">পাসওয়ার্ড পরিবর্তন</a></li>
          </ul>

          <div class="tab-content">            
            <div id="infoChangeTab" class="tab-pane fade in active">
              <h3>তথ্য পরিবর্তন করুন</h3>
              {!! Form::model($blogger, ['route' => ['posts.updateProfile', $blogger->id], 'data-parsley-validate' => '', 'files' => 'true', 'enctype' => 'multipart/form-data', 'method'=>'PUT', 'class' => 'form-horizontal']) !!}
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      {{ Form::label('name', 'নামঃ', ['class' => 'control-label col-sm-2']) }}
                      <div class="col-sm-10">
                        {{ Form::text('name', null, ['class'=>'form-control', 'required' => '']) }}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      {{ Form::label('email', 'ইমেইলঃ', ['class' => 'control-label col-sm-2']) }}
                        <div class="col-sm-10">
                          {{ Form::text('email', null, ['class'=>'form-control', 'required' => '', 'disabled' => '']) }}
                        </div>
                    </div>
                  </div>  
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      {{ Form::label('phone', 'ফোনঃ', ['class' => 'control-label col-sm-2']) }}
                      <div class="col-sm-10">
                        {{ Form::text('phone', null, ['class'=>'form-control', 'required' => '']) }}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      {{ Form::label('fb', 'ফেইসবুকঃ', ['class' => 'control-label col-sm-2']) }}
                      <div class="col-sm-10">
                        {{ Form::text('fb', null, ['class'=>'form-control', 'placeholder' => 'যেমনঃ www.facebook.com/humansofthakurgaon']) }}
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('blood_group', 'রক্তের গ্রুপঃ', ['class' => 'control-label col-sm-2']) }}
                        <div class="col-sm-10">
                          {!! Form::select('blood_group', [
                           '' => 'রক্তের গ্রুপ নির্ধারণ করুন',
                           'A+' => 'এ পজিটিভ',
                           'A-' => 'এ নেগেটিভ',
                           'B+' => 'বি পজিটিভ',
                           'B-' => 'বি নেগেটিভ',
                           'AB+' => 'এবি পজিটিভ',
                           'AB-' => 'এবি নেগেটিভ',
                           'O+' => 'ও পজিটিভ',
                           'O-' => 'ও নেগেটিভ',
                           'N/A' => 'রক্তের গ্রুপ জানা নেই'], null, array('class' => 'form-control', 'required' => '', 'data-parsley-required-message' => 'রক্তের গ্রুপ নির্ধারণ করুন' )) !!}
                        </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      {!! Form::label('last_donated', 'সর্বশেষ রক্তদানঃ', array('class' => 'control-label col-sm-2')) !!}
                      <div class="col-sm-10">
                        @if($blogger->last_donated == NULL || $blogger->last_donated == '0000-00-00 00:00:00')
                        {!! Form::text('last_donated', '', array('class' => 'form-control', 'placeholder' => 'কখনও না দিলে ফাঁকা রাখুন', 'autocomplete' => 'off')) !!}
                        @else
                        {!! Form::text('last_donated', null, array('class' => 'form-control', 'placeholder' => 'কখনও না দিলে ফাঁকা রাখুন', 'autocomplete' => 'off')) !!}
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <p style="border-bottom: 1px solid lightgrey;"></p>
                  </div>
                </div>
                
                {{-- স্থায়ী ঠিকানা --}}
                <div class="row">
                  <div class="col-md-12">
                    <span><strong>স্থায়ী ঠিকানাঃ</strong></span><br/><br/>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('permanent_district', 'জেলাঃ', ['class' => 'control-label col-sm-2']) }}
                        <div class="col-sm-10">
                          {{ Form::select('permanent_district', [
                           '' => 'জেলার নাম নির্ধারণ করুন',
                           'ঠাকুরগাঁও' => 'ঠাকুরগাঁও',
                           'বগুড়া' => 'বগুড়া',
                           'বান্দরবন' => 'বান্দরবন',
                           'বরগুনা' => 'বরগুনা',
                           'বরিশাল' => 'বরিশাল',
                           'বাগেরহাট' => 'বাগেরহাট',
                           'ভোলা' => 'ভোলা',
                           'ব্রাহ্মণবাড়িয়া' => 'ব্রাহ্মণবাড়িয়া',
                           'চাঁদপুর' => 'চাঁদপুর',
                           'চিটাগাং' => 'চিটাগাং',
                           'চুয়াডাঙ্গা' => 'চুয়াডাঙ্গা',
                           'কুমিল্লা' => 'কুমিল্লা',
                           'কক্সবাজার' => 'কক্সবাজার',
                           'ঢাকা' => 'ঢাকা',
                           'দিনাজপুর' => 'দিনাজপুর',
                           'ফরিদপুর' => 'ফরিদপুর',
                           'ফেনী' => 'ফেনী',
                           'গাইবান্ধা' => 'গাইবান্ধা',
                           'গাজীপুর' => 'গাজীপুর',
                           'গোপালগঞ্জ' => 'গোপালগঞ্জ',
                           'হবিগঞ্জ' => 'হবিগঞ্জ',
                           'জয়পুরহাট' => 'জয়পুরহাট',
                           'জামালপুর' => 'জামালপুর',
                           'যশোর' => 'যশোর',
                           'ঝালকাঠী' => 'ঝালকাঠী',
                           'ঝিনাইদাহ' => 'ঝিনাইদাহ',
                           'খাগড়াছড়ি' => 'খাগড়াছড়ি',
                           'খুলনা' => 'খুলনা',
                           'কিশোরগঞ্জ' => 'কিশোরগঞ্জ',
                           'কুড়িগ্রাম' => 'কুড়িগ্রাম',
                           'কুষ্টিয়া' => 'কুষ্টিয়া',
                           'লক্ষ্মীপুর' => 'লক্ষ্মীপুর',
                           'লালমনিরহাট' => 'লালমনিরহাট',
                           'মাদারীপুর' => 'মাদারীপুর',
                           'মাগুরা' => 'মাগুরা',
                           'মানিকগঞ্জ' => 'মানিকগঞ্জ',
                           'মেহেরপুর' => 'মেহেরপুর',
                           'মৌলভীবাজার' => 'মৌলভীবাজার',
                           'মুন্সীগঞ্জ' => 'মুন্সীগঞ্জ',
                           'ময়মনসিংহ' => 'ময়মনসিংহ',
                           'নওগাঁ' => 'নওগাঁ',
                           'নারায়ণগঞ্জ' => 'নারায়ণগঞ্জ',
                           'নরসিংদী' => 'নরসিংদী',
                           'নাটোর' => 'নাটোর',
                           'নওয়াবগঞ্জ' => 'নওয়াবগঞ্জ',
                           'নেত্রকোনা' => 'নেত্রকোনা',
                           'নীলফামারী' => 'নীলফামারী',
                           'নোয়াখালী' => 'নোয়াখালী',
                           'নড়াইল' => 'নড়াইল',
                           'পাবনা' => 'পাবনা',
                           'পঞ্চগড়' => 'পঞ্চগড়',
                           'পটুয়াখালী' => 'পটুয়াখালী',
                           'পিরোজপুর' => 'পিরোজপুর',
                           'রাজবাড়ী' => 'রাজবাড়ী',
                           'রাজশাহী' => 'রাজশাহী',
                           'রাঙ্গামাটি' => 'রাঙ্গামাটি',
                           'রংপুর' => 'রংপুর',
                           'সাতক্ষীরা' => 'সাতক্ষীরা',
                           'শরীয়তপুর' => 'শরীয়তপুর',
                           'শেরপুর' => 'শেরপুর',
                           'সিরাজগঞ্জ' => 'সিরাজগঞ্জ',
                           'সুনামগঞ্জ' => 'সুনামগঞ্জ',
                           'সিলেট' => 'সিলেট',
                           'টাঙ্গাইল' => 'টাঙ্গাইল'], null, array('class' => 'form-control', 'required' => '', 'data-parsley-required-message' => 'জেলার নাম নির্ধারণ করুন' )) }}
                        </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('permanent_upazila', 'উপজেলাঃ', ['class' => 'control-label col-sm-2', 'id' => 'permanent_upazila_label']) }}
                        <div class="col-sm-10">
                          {{ Form::select('permanent_upazila', [
                           '' => 'উপজেলার নাম নির্ধারণ করুন',
                           'ঠাকুরগাঁও সদর' => 'ঠাকুরগাঁও সদর',
                           'পীরগঞ্জ' => 'পীরগঞ্জ',
                           'রানীশংকৈল' => 'রানীশংকৈল',
                           'বালিয়াডাঙ্গী' => 'বালিয়াডাঙ্গী',
                           'হরিপুর' => 'হরিপুর'], null, array('class' => 'form-control', 'data-parsley-required-message' => 'উপজেলার নাম নির্ধারণ করুন' )) }}
                        </div>
                    </div>
                  </div> 
                  <div class="col-md-12">
                    <div class="form-group">
                      <div class="col-md-10">
                        @if ($blogger->permanent_address_privacy == 'public')
                            <label class="radio-inline">
                              {{ Form::radio('permanent_address_privacy', 'public', true, ['checked' => 'checked']) }} প্রকাশ্য (Public)                           </label>
                            <label class="radio-inline">
                              {{ Form::radio('permanent_address_privacy', 'private', false, ['class' => 'radio-inline']) }} অপ্রকাশ্য (Private)
                             </label> 
                        @elseif ($blogger->permanent_address_privacy == 'private')
                            <label class="radio-inline">
                              {{ Form::radio('permanent_address_privacy', 'public', false, ['class' => 'radio-inline']) }} প্রকাশ্য (Public)                           </label>
                            <label class="radio-inline">
                              {{ Form::radio('permanent_address_privacy', 'private', true, ['checked' => 'checked', 'class' => 'radio-inline']) }} অপ্রকাশ্য (Private)
                            </label>
                        @else
                            <label class="radio-inline">
                              {{ Form::radio('permanent_address_privacy', 'public', true, ['checked' => 'checked', 'class' => 'radio-inline']) }} প্রকাশ্য (Public)                           </label>
                            <label class="radio-inline">
                              {{ Form::radio('permanent_address_privacy', 'private', false, ['class' => 'radio-inline']) }} অপ্রকাশ্য (Private)
                            </label>
                        @endif
                      </div>
                    </div>  
                    <p style="border-bottom: 1px solid lightgrey;"></p>
                  </div> 
                </div>
                {{-- স্থায়ী ঠিকানা --}}
                
                {{-- বর্তমান ঠিকানা --}}
                <div class="row">
                  <div class="col-md-12">
                    <span><strong>বর্তমান ঠিকানাঃ</strong></span><br/><br/>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('present_district', 'অবস্থানঃ', ['class' => 'control-label col-sm-2']) }}
                        <div class="col-sm-10">
                          {{ Form::select('present_district', [
                           '' => 'অবস্থান নির্ধারণ করুন',
                           'প্রবাসী' => 'প্রবাসী',
                           'ঠাকুরগাঁও' => 'ঠাকুরগাঁও',
                           'ঢাকা' => 'ঢাকা',
                           'বগুড়া' => 'বগুড়া',
                           'বান্দরবন' => 'বান্দরবন',
                           'বরগুনা' => 'বরগুনা',
                           'বরিশাল' => 'বরিশাল',
                           'বাগেরহাট' => 'বাগেরহাট',
                           'ভোলা' => 'ভোলা',
                           'ব্রাহ্মণবাড়িয়া' => 'ব্রাহ্মণবাড়িয়া',
                           'চাঁদপুর' => 'চাঁদপুর',
                           'চিটাগাং' => 'চিটাগাং',
                           'চুয়াডাঙ্গা' => 'চুয়াডাঙ্গা',
                           'কুমিল্লা' => 'কুমিল্লা',
                           'কক্সবাজার' => 'কক্সবাজার',
                           'দিনাজপুর' => 'দিনাজপুর',
                           'ফরিদপুর' => 'ফরিদপুর',
                           'ফেনী' => 'ফেনী',
                           'গাইবান্ধা' => 'গাইবান্ধা',
                           'গাজীপুর' => 'গাজীপুর',
                           'গোপালগঞ্জ' => 'গোপালগঞ্জ',
                           'হবিগঞ্জ' => 'হবিগঞ্জ',
                           'জয়পুরহাট' => 'জয়পুরহাট',
                           'জামালপুর' => 'জামালপুর',
                           'যশোর' => 'যশোর',
                           'ঝালকাঠী' => 'ঝালকাঠী',
                           'ঝিনাইদাহ' => 'ঝিনাইদাহ',
                           'খাগড়াছড়ি' => 'খাগড়াছড়ি',
                           'খুলনা' => 'খুলনা',
                           'কিশোরগঞ্জ' => 'কিশোরগঞ্জ',
                           'কুড়িগ্রাম' => 'কুড়িগ্রাম',
                           'কুষ্টিয়া' => 'কুষ্টিয়া',
                           'লক্ষ্মীপুর' => 'লক্ষ্মীপুর',
                           'লালমনিরহাট' => 'লালমনিরহাট',
                           'মাদারীপুর' => 'মাদারীপুর',
                           'মাগুরা' => 'মাগুরা',
                           'মানিকগঞ্জ' => 'মানিকগঞ্জ',
                           'মেহেরপুর' => 'মেহেরপুর',
                           'মৌলভীবাজার' => 'মৌলভীবাজার',
                           'মুন্সীগঞ্জ' => 'মুন্সীগঞ্জ',
                           'ময়মনসিংহ' => 'ময়মনসিংহ',
                           'নওগাঁ' => 'নওগাঁ',
                           'নারায়ণগঞ্জ' => 'নারায়ণগঞ্জ',
                           'নরসিংদী' => 'নরসিংদী',
                           'নাটোর' => 'নাটোর',
                           'নওয়াবগঞ্জ' => 'নওয়াবগঞ্জ',
                           'নেত্রকোনা' => 'নেত্রকোনা',
                           'নীলফামারী' => 'নীলফামারী',
                           'নোয়াখালী' => 'নোয়াখালী',
                           'নড়াইল' => 'নড়াইল',
                           'পাবনা' => 'পাবনা',
                           'পঞ্চগড়' => 'পঞ্চগড়',
                           'পটুয়াখালী' => 'পটুয়াখালী',
                           'পিরোজপুর' => 'পিরোজপুর',
                           'রাজবাড়ী' => 'রাজবাড়ী',
                           'রাজশাহী' => 'রাজশাহী',
                           'রাঙ্গামাটি' => 'রাঙ্গামাটি',
                           'রংপুর' => 'রংপুর',
                           'সাতক্ষীরা' => 'সাতক্ষীরা',
                           'শরীয়তপুর' => 'শরীয়তপুর',
                           'শেরপুর' => 'শেরপুর',
                           'সিরাজগঞ্জ' => 'সিরাজগঞ্জ',
                           'সুনামগঞ্জ' => 'সুনামগঞ্জ',
                           'সিলেট' => 'সিলেট',
                           'টাঙ্গাইল' => 'টাঙ্গাইল'], null, array('class' => 'form-control', 'required' => '', 'data-parsley-required-message' => 'জেলার নাম নির্ধারণ করুন' )) }}
                        </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('present_upazila', 'উপজেলাঃ', ['class' => 'control-label col-sm-2', 'id' => 'present_upazila_label']) }}
                        <div class="col-sm-10">
                          {{ Form::select('present_upazila', [
                           '' => 'উপজেলার নাম নির্ধারণ করুন',
                           'ঠাকুরগাঁও সদর' => 'ঠাকুরগাঁও সদর',
                           'পীরগঞ্জ' => 'পীরগঞ্জ',
                           'রানীশংকৈল' => 'রানীশংকৈল',
                           'বালিয়াডাঙ্গী' => 'বালিয়াডাঙ্গী',
                           'হরিপুর' => 'হরিপুর'], null, array('class' => 'form-control', 'data-parsley-required-message' => 'উপজেলার নাম নির্ধারণ করুন' )) }}
                        </div>
                    </div>
                  </div> 
                  <div class="col-md-12">
                                        <div class="form-group">
                      <div class="col-md-10">
                        @if ($blogger->present_address_privacy == 'public')
                            <label class="radio-inline">
                              {{ Form::radio('present_address_privacy', 'public', true, ['checked' => 'checked']) }} প্রকাশ্য (Public)                           </label>
                            <label class="radio-inline">
                              {{ Form::radio('present_address_privacy', 'private', false, ['class' => 'radio-inline']) }} অপ্রকাশ্য (Private)
                             </label> 
                        @elseif ($blogger->present_address_privacy == 'private')
                            <label class="radio-inline">
                              {{ Form::radio('present_address_privacy', 'public', false, ['class' => 'radio-inline']) }} প্রকাশ্য (Public)                           </label>
                            <label class="radio-inline">
                              {{ Form::radio('present_address_privacy', 'private', true, ['checked' => 'checked', 'class' => 'radio-inline']) }} অপ্রকাশ্য (Private)
                            </label>
                        @else
                            <label class="radio-inline">
                              {{ Form::radio('present_address_privacy', 'public', true, ['checked' => 'checked', 'class' => 'radio-inline']) }} প্রকাশ্য (Public)                           </label>
                            <label class="radio-inline">
                              {{ Form::radio('present_address_privacy', 'private', false, ['class' => 'radio-inline']) }} অপ্রকাশ্য (Private)
                            </label>
                        @endif
                      </div>
                    </div> 
                    <p style="border-bottom: 1px solid lightgrey;"></p>
                  </div> 
                </div>
                {{-- স্থায়ী ঠিকানা --}}

                  <div class="form-group">
                      {{ Form::label('image', 'ছবিঃ (400KB এর মধ্যে, দৈর্ঘ্য প্রস্থ সমান হওয়া যুতসই)', ['class' => 'control-label col-sm-2']) }}
                      <div class="col-sm-10">
                        {{ Form::file('image', ['data-parsley-filemaxmegabytes' => '0.4', 'data-parsley-trigger' => 'change', 'data-parsley-filemimetypes' => 'image/jpeg, image/png']) }}
                      </div>
                  </div>

                  <div class="form-group">
                      {{ Form::label('about', 'আমার সম্পর্কে', ['class' => 'control-label col-sm-2']) }}
                      <div class="col-sm-10">
                        {{ Form::textarea('about', null, ['class'=>'form-control', 'rows' => '3', 'required' => '']) }}

                        <button class="btn btn-success btn-block form-spacing-top" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> সংরক্ষণ করুন</button>
                      </div>
                  </div>
              {!! Form::close() !!}
            </div>
            <div id="passwordChangeTAb" class="tab-pane fade">
              <h3>পাসওয়ার্ড পরিবর্তন করুন</h3>
              {!! Form::open(['route' => ['password.change', Auth::user()->id], 'data-parsley-validate' => '', 'method'=>'PUT', 'class' => 'form-horizontal']) !!}
                  <div class="form-group">
                    {!! Form::label('password', 'নতুন পাসওয়ার্ড', ['class' => 'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                    {!! Form::password('password', array('class' => 'form-control', 'required' => '', 'placeholder' => 'নতুন পাসওয়ার্ড')) !!}
                    </div>
                  </div>
                  <div class="form-group">
                    {!! Form::label('password_confirmation', 'পাসওয়ার্ড নিশ্চিতকরণ', ['class' => 'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                    {!! Form::password('password_confirmation', array('class' => 'form-control', 'required' => '', 'placeholder' => 'পাসওয়ার্ড নিশ্চিত করুন', 'data-parsley-equalto' => '#password')) !!}

                    {!! Form::submit('পাসওয়ার্ড পরিবর্তন করুন', array('class' => 'btn btn-success btn-block', 'style' => 'margin-top:20px;')) !!}
                    </div>
                  </div>
              {!! Form::close() !!}
            </div>
          </div>
          
        </div>
      </div>
@endsection

@section('script')
  {!!Html::script('js/parsley.min.js')!!}
    {!!Html::script('js/dtpui.js')!!}
  <script>
      $(function() {
        $('#last_donated').datepicker({
              dateFormat: 'yy-mm-dd',
              onSelect: function(datetext){
                  var d = new Date(); // for now
                  var h = d.getHours();
                  h = (h < 10) ? ("0" + h) : h ;

                  var m = d.getMinutes();
                  m = (m < 10) ? ("0" + m) : m ;

                  var s = d.getSeconds();
                  s = (s < 10) ? ("0" + s) : s ;

                  datetext = datetext + " " + h + ":" + m + ":" + s;
                  $('#last_donated').val(datetext);
              },
          });
      }); 
  </script>

  <script>
      $(document).ready(function(){
        if($('#permanent_district').val() === 'ঠাকুরগাঁও') {
          $("#permanent_upazila").show();
          $("#permanent_upazila_label").show(); 
        } else {
          $("#permanent_upazila").hide();
          $("#permanent_upazila_label").hide();
        }

        if($('#present_district').val() === 'ঠাকুরগাঁও') {
          $("#present_upazila").show();
          $("#present_upazila_label").show(); 
        } else {
          $("#present_upazila").hide();
          $("#present_upazila_label").hide();
        }

               

        $("#permanent_district").change(function() {
          var permanent_district = $(this).val();
          if(permanent_district === 'ঠাকুরগাঁও') {
              $("#permanent_upazila").show('slow');
              $("#permanent_upazila").attr('required', '');
              $("#permanent_upazila_label").show();
          }
          else {
              $("#permanent_upazila").hide();
              $("#permanent_upazila").removeAttr('required');
              $("#permanent_upazila_label").hide();
          }
        });

        $("#present_district").change(function() {
          var present_district = $(this).val();
          if(present_district === 'ঠাকুরগাঁও') {
              $("#present_upazila").show('slow');
              $("#present_upazila").attr('required', '');
              $("#present_upazila_label").show();
          }
          else {
              $("#present_upazila").hide();
              $("#present_upazila").removeAttr('required');
              $("#present_upazila_label").hide();
          }
        });

      });
  </script>
  <script type="text/javascript">
    var app = app || {};

// Utils
(function ($, app) {
    'use strict';

    app.utils = {};

    app.utils.formDataSuppoerted = (function () {
        return !!('FormData' in window);
    }());

}(jQuery, app));

// Parsley validators
(function ($, app) {
    'use strict';

    window.Parsley
        .addValidator('filemaxmegabytes', {
            requirementType: 'string',
            validateString: function (value, requirement, parsleyInstance) {

                if (!app.utils.formDataSuppoerted) {
                    return true;
                }

                var file = parsleyInstance.$element[0].files;
                var maxBytes = requirement * 1048576;

                if (file.length == 0) {
                    return true;
                }

                return file.length === 1 && file[0].size <= maxBytes;

            },
            messages: {
                en: 'অনুগ্রহ করে ৪০০ কিলোবাইটের মধ্যে একটি ছবি দিন; দৈর্ঘ্য প্রস্থ সমান হওয়া যুতসই'
            }
        })
        .addValidator('filemimetypes', {
            requirementType: 'string',
            validateString: function (value, requirement, parsleyInstance) {

                if (!app.utils.formDataSuppoerted) {
                    return true;
                }

                var file = parsleyInstance.$element[0].files;

                if (file.length == 0) {
                    return true;
                }

                var allowedMimeTypes = requirement.replace(/\s/g, "").split(',');
                return allowedMimeTypes.indexOf(file[0].type) !== -1;

            },
            messages: {
                en: 'এই ফাইলটা গ্রহণযোগ্য নয়'
            }
        });

}(jQuery, app));


// Parsley Init
(function ($, app) {
    'use strict';

    $('#js-file-validation-example').parsley();

}(jQuery, app));

  </script>


@endsection