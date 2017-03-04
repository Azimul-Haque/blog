@extends('dashboard')

@section('title', 'ব্লগ | ব্লগার তালিকা')

@section('stylesheet')
  <link media="all" type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
@endsection

@section('content')
      @if (Auth::user()->role == 'admin')
      <div class="row">
        <div class="col-md-12">
          <h2>ব্লগারদের তালিকা (সর্বমোট {{ $users->count() }} জন ব্লগার আছেন)</h2>
            <div class="table-responsive">
              <table class="table table-striped table-bordered" id="blogger-list">
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
                              @if($user->id == $post->postedBy)
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
      </div>
      @else
      <div class="row">
        <div class="col-md-12">
      		<p>এই পেইজটি সকলের জন্য নয়!</p>
        </div>
      </div>
      @endif
@endsection

@section('script')
  <script type="text/javascript">
    $(document).ready(function() {
      $('#blogger-list').DataTable( {
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