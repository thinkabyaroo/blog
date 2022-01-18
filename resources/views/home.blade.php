@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

{{--                    {{ __('You are logged in!') }}--}}

{{--                    {{request()->url()}}--}}

{{--                    {!! '<h1>Test </h1>' !!}--}}
                    {{auth()->user()->photos}}
{{--                    {{$my->name}}--}}

                    <x-alert class="p-5" type="danger">hello world</x-alert>
                        <x-alert class="p-1">hello hello</x-alert>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
