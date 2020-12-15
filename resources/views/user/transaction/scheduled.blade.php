@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-lg-4 m-auto mt-5">
      <div class="card shadow text-center">
        <div class="card-body">
          <h4 class="mb-3">Schedule Transfer</h4>
          <div>Wallet Balance: <h4 class="mt-2">&#8358; {{ auth()->user()->wallet->balance }} </h4></div>

          {{-- @if($errors->any())
            @foreach ($errors->all() as $error)
              <div class="bg-danger">
                {{ $error }}
              </div>
            @endforeach
          @endif --}}

          @if(session('status'))
            <div class="bg-danger text-white text-center m-3 p-1">
              {{ session('status') }}
            </div>
          @endif

          @if(session('invalid'))
            <div class="bg-danger text-white text-center m-3 p-1">
              {{ session('invalid') }}
            </div>
          @endif

          @if(session('info'))
            <div class="bg-info text-white text-center m-3 p-1">
              {{ session('info') }}
            </div>
          @endif

          <form action="{{ route('transaction.delay') }}" method="POST">
            @csrf
            <div class="mb-3">
              <input type="text" value="{{ old('email') }}" placeholder="Email of reciever" name="email" class="form-control @error('email') border-danger @enderror">
              @error('email')
                <span class="text-danger text-sm">
                  {{ $message }}
                </span>
              @enderror
            </div>
            <div class="mb-3">
              <input type="datetime-local" value="{{ old('scheduled_date') }}" min="0" placeholder="Scheduled Date" name="scheduled_date" class="form-control @error('scheduled_date') border-danger @enderror">
              @error('scheduled_date')
                <span class="text-danger text-sm">
                  {{ $message }}
                </span>
              @enderror
            </div>
            <button class="btn btn-primary btn-sm">Send</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection