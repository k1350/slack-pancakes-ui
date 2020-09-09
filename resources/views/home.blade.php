@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="card-deck mb-3 text-center">
        <div class="card mb-4 box-shadow">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">{{ __('messages.received') }}</h4>
            </div>
            <div class="card-body">
                <p class="lead">{{ $total->received }}</p>
                <!--
                <button type="button" class="btn btn-lg btn-block btn-primary">{{ __('messages.receivedRanking') }}</button>
                -->
            </div>
        </div>
        <div class="card mb-4 box-shadow">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">{{ __('messages.sent') }}</h4>
            </div>
            <div class="card-body">
                <p class="lead">{{ $total->sent }}</p>
                <!--
                <button type="button" class="btn btn-lg btn-block btn-primary">{{ __('messages.sentRanking') }}</button>
                -->
            </div>
        </div>
        <div class="card mb-4 box-shadow">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">{{ __('messages.used') }}</h4>
            </div>
            <div class="card-body">
                <p class="lead">{{ $total->used }}</p>
                <a href='{{ url("/exchange") }}' class="btn btn-lg btn-block btn-primary">{{ __('messages.exchange') }}</a>
            </div>
        </div>
    </div>

@endsection
