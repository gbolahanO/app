@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-lg-4 m-auto mt-5">
      <div class="card shadow text-center">
        <div class="card-body">
          <div>Wallet Balance: <h4 class="mt-2">&#8358; {{ auth()->user()->wallet->balance }} </h4></div>
        </div>
      </div>
    </div>
  </div>
@endsection