@extends('layouts.app')

@section('content')
  <div class="row mt-5">
    <div class="col-lg-4 m-auto">
      <h3 class="text-center mb-4">Register</h3>
      <div class="card shadow">
        <div class="card-body">
          <form action="{{route('register')}}" method="POST">
            @csrf
            <div class="mb-3">
              <input type="text" value="{{ old('name') }}" placeholder="Fullname" name="name" class="form-control @error('name') border-danger @enderror">
              @error('name')
                <span class="text-danger text-sm">
                  {{ $message }}
                </span>
              @enderror
            </div>
            <div class="mb-3">
              <input type="email" value="{{ old('email') }}" placeholder="Email" name="email" class="form-control @error('email') border-danger @enderror">
              @error('email')
                <span class="text-danger text-sm">
                  {{ $message }}
                </span>
              @enderror
            </div>
            <div class="mb-3">
              <input type="text" value="{{ old('phone_number') }}" placeholder="Phone Number" name="phone_number" class="form-control @error('phone_number') border-danger @enderror">
              @error('phone_number')
                <span class="text-danger text-sm">
                  {{ $message }}
                </span>
              @enderror
            </div>
            <div class="mb-3">
              <input type="password" placeholder="Password" name="password" class="form-control @error('password') border-danger @enderror">
              @error('password')
                <span class="text-danger text-sm">
                  {{ $message }}
                </span>
              @enderror
            </div>
            <div class="mb-3">
              <input type="password" name="password_confirmation" placeholder="Confirm password" class="form-control">
            </div>
            <div class="mb-3">
              <input type="text" value="{{ old('referral_code') }}" placeholder="Referral code if any" name="referral_code" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Register</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection