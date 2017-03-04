@extends('main')

@section('title', 'ব্লগ | ব্লগারদের তালিকা')

@section('stylesheet')
  <link media="all" type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
@endsection

@section('content')
      <div class="row">
            <div class="col-md-8">
            <h2><i class="fa fa-users" aria-hidden="true"></i> ব্লগারদের তালিকা</h2>
              <hr>
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="blood_group_table">
                  <thead>
                    <tr>
                      <th>ব্লগারের নাম</th>
                      <th>ব্লগে যোগদান করেছেন</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $user)
                      <tr>
                        <td><a href="{{ url('profile/'.$user->name) }}">{{ $user->name }}</a></td>
                        <td> 
                          {{ date('F d, Y', strtotime($user->created_at))}}
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