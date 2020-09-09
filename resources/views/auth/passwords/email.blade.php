@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="title">Reset Password</h1>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="email">{{ __('messages.registeredMail') }}</label>

            <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">{{ __('messages.sendPasswordLink') }}</button>
    </form>
</div>
@endsection
