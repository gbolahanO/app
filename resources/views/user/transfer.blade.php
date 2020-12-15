@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-lg-4 m-auto mt-5">
      <div class="card shadow text-center">
        <div class="card-body">
          <h4 class="text-center mb-3">Make a Transfer</h4>
          @if(session('status'))
            <div class="bg-info text-white text-center m-3 p-1">
              {{ session('status') }}
            </div>
          @endif
          <div class="list-group list-group-horizontal">
            <a href="{{ route('transaction.instant')}}" class="list-group-item list-group-item-action">Instant Transfer</a>
            <a href="{{ route('transaction.scheduled') }}" class="list-group-item list-group-item-action">Schedule Transfer</a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection