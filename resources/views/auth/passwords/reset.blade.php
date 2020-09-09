@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="title">Reset Password</h1>
    <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
        {{ csrf_field() }}

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group">
            <label for="email">{{ __('messages.registeredMail') }}</label>
            <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email or old('email') }}" required autofocus>
            @if ($errors->has('email'))
                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="password">{{ __('messages.password') }}</label>
            <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
            @if ($errors->has('password'))
                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="password-confirm">{{ __('messages.cPassword') }}</label>
            <input id="password-confirm" type="password" class="form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required>

            @if ($errors->has('password_confirmation'))
                <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">{{ __('messages.resetPassword') }}</button>
    </form>
</div>
@endsection
