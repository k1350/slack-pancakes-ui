@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="title">Admin Login</h1>
    <form method="POST" action="{{ route('admin::login') }}">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="email">{{ __('messages.name') }}</label>
            <input id="name" type="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

            @if ($errors->has('name'))
                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="password">{{ __('messages.password') }}</label>
            <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

            @if ($errors->has('password'))
                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">{{ __('messages.login') }}</button>

        <a class="btn btn-link" href="{{ route('admin::password.request') }}">
            {{ __('messages.forgotPassword' )}}
        </a>
    </form>
</div>
@endsection
