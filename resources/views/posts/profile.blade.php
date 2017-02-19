@extends('dashboard')

@section('title', 'Blog | Profile')

@section('content')
      <div class="row">
        <div class="col-md-12">
          <h1>আমার সম্পর্কে</h1>
          <p>{{ Auth::user()->name }}</p>
        </div>
      </div>
@endsection