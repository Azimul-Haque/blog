@extends('dashboard')

@section('title', 'Blog | Profile')

@section('content')
      @if (Auth::user()->role == 'admin')
      <div class="row">
        <div class="col-md-12">
          <h1>ব্লগারদের তালিকা</h1>
          <table class="table">
          	<thead>
          		<tr>
          			<th>ব্লগারের নাম</th>
          			<th>যোগদান করেছেন</th>
          			<th>ব্লগ লিখেছেন</th>
          		</tr>
          	</thead>
          	<tbody>          		
          @foreach ($users as $user)
          	<tr>
          		<td>{{ $user->name }}</td>
          		<td>{{ date('F d, Y h:i A', strtotime($user->created_at))}}</td>
          		<td> <?php $i = 0; ?>
                  @foreach ($posts as $post)
                    {{--IT NEEDS TO BE FIXED WITH USER ID, REMEMBER--}}
                    @if($user->name == $post->postedBy)
                      <?php $i++; ?>
                    @endif
                  @endforeach
                  {{ $i }}
          		</td>
          	</tr>
          @endforeach
			</tbody>
          </table>
        </div>
      </div>
      @else
      <div class="row">
        <div class="col-md-12">
      		<p>এই পেইজটি সকলের জন্য নয়!</p>
        </div>
      </div>
      @endif
@endsection