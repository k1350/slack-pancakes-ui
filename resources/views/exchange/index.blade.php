@extends('layouts.app')

@section('content')
<div class="container">
    <div class="px-3 py-3 pt-md-5 pb-md-4 mx-auto">
      <h1 class="display-4">{{ __('messages.exchange') }}</h1>
      <p class="lead">{{ __('messages.prizeExchangeDesc') }} <br /> {{ __('messages.yourPancakes', ['number' => $number]) }}</p>
    </div>
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="card-deck mb-3 text-center">
        @foreach ($prizes as $prize)
        <div class="card mb-4 box-shadow">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">{{ $prize->name }}</h4>
            </div>
            <div class="card-body">
                <p class="lead">{{ $prize->description }}</p>
                @if ($prize->url)
                    <img border="0" src="{{ $prize->url }}" class="img-thumbnail" alt="景品のイメージ">
                @else
                    <img border="0" src="{{ '/storage/image/no-image.jpg' }}" class="img-thumbnail" alt="景品のイメージ">
                @endif
                <form method="POST" action="/exchange/confirm">
                    {{ csrf_field() }}
                    <input name="id" type="hidden" value="{{ encrypt($prize->id) }}">
                    <input name="name" type="hidden" value="{{ encrypt($prize->name) }}">
                    <input name="number" type="hidden" value="{{ encrypt($prize->number) }}">
                    <button type="submit" class="btn btn-lg btn-block btn-primary" {{ $number < $prize->number ? ' disabled' : '' }} >
                        {{ $prize->number }}
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
