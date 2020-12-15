@extends('layouts.app')

@section('content')
  <div class="row mt-5">
    <div class="col-lg-4 m-auto">
      <h3 class="text-center mb-4">Login</h3>
      <div class="card shadow">
        <div class="card-body">
          @if(session('status'))
            <div class="bg-danger text-center">
              {{ session('status') }}
            </div>
          @endif

          <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
              <input type="text" placeholder="Email" name="email" class="form-control @error('email') border-danger @enderror">
              @error('email')
                <div class="text-danger">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <input type="password" placeholder="Password" name="password" class="form-control @error('password') border-danger @enderror">
              @error('password')
                <div class="text-danger">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <input type="checkbox" name="remember" id="remember" class="mr-2">
              <label for="remember">Remember me</label>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection