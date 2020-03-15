@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col mt-5">
            <div class="button-group mt-5">
                <div class="btn btn-lg btn-block">
                    <a href="{{ url('ontlenen') }}"><div class="button-text">{{ __('Ontlenen') }}</div></a>
                </div>
            </div>
        </div>
        <div class="col mt-5">
            <div class="button-group mt-5">
                <div class="btn btn-lg btn-block">
                    <a href="{{ url('indienen') }}"><div class="button-text">{{ __('Indienen') }}</div></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
