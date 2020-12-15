@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-lg-4 m-auto mt-5">
      <div class="card shadow text-center">
        <div class="card-body">
          <h4 class="mb-3">Instant Transfer</h4>
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

          <form action="{{ route('transaction.send') }}" method="POST">
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
              <input type="number" value="{{ old('amount') }}" min="0" placeholder="Amount" name="amount" class="form-control @error('amount') border-danger @enderror">
              @error('amount')
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