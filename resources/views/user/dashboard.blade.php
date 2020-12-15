@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-lg-4 m-auto mt-5">
      <div class="card shadow">
        <div class="card-body">
          <div class="text-center">Referral Code<h4 class="mt-2">{{auth()->user()->referral_code}}</h4></div>
          @if(session('success'))
            <div class="bg-success text-white text-center m-3 p-1">
              {{ session('success') }}
            </div>
          @endif
          @if (auth()->user()->kyc_level != "1")
          <div class="mt-5">
            <p>Please provide any of the following to unlock your transaction limit beyond &#8358; 50,000</p>
            <ul>
              <li>National Identity Card</li>
              <li>Drivers licence</li>
              <li>Voters card</li>
              <li>Bank verification number</li>
              <li>International passport</li>
            </ul>
          </div>


            <div>
              <form action="{{ route('user.upgrade') }}" method="POST">
                @csrf
                <div class="mb-3">
                  <input type="text" name="identity" placeholder="National identification number e.g 1314487332" class="form-control @error('identity') border-danger @enderror">
                  @error('identity')
                    <span class="text-danger text-sm">
                      {{ $message }}
                    </span>
                  @enderror
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary btn-sm">Upgrade</button>
                </div>
              </form>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection