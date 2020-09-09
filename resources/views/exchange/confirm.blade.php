@extends('layouts.app')

@section('content')
<div class="container">
    <div class="px-3 py-3 pt-md-5 pb-md-4 mx-auto">
      <h1 class="display-4">{{ __('messages.exchange') }}</h1>
      <p class="lead">{{ __('messages.prizeExchangeConfirm', ['number' => $number, 'name' => $name]) }}</p>
    </div>

    <form method="POST" action="/exchange/exchange" class="text-center">
        {{ csrf_field() }}
        <input name="id" type="hidden" value="{{ encrypt($id) }}">
        <input name="number" type="hidden" value="{{ encrypt($number) }}">
        <div class="row">
            <div class="col-sm">
                <a href="/exchange" class="btn btn-secondary my-2 btn-block">{{ __('messages.no') }}</a>
            </div>
            <div class="col-sm">
                <button type="submit" class="btn btn-primary my-2 btn-block">{{ __('messages.yes') }}</button>
            </div>
        </div>
    </form>
</div>

@endsection
